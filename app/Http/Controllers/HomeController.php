<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::withCount(['posts' => fn ($q) => $q->published()])->get();

        $query = Post::with(['category', 'authors', 'images'])
            ->published()
            ->orderByDesc('activity_date')
            ->orderByDesc('published_at');

        // Búsqueda optimizada insensible a mayúsculas y multipalabra
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $operator = DB::getDriverName() === 'pgsql' ? 'ilike' : 'like';
            $terms = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);

            $query->where(function ($mainQuery) use ($terms, $operator) {
                foreach ($terms as $term) {
                    $pattern = "%{$term}%";
                    $mainQuery->where(function ($subQuery) use ($pattern, $operator) {
                        $subQuery->where('title', $operator, $pattern)
                            ->orWhere('excerpt', $operator, $pattern)
                            ->orWhere('content', $operator, $pattern)
                            ->orWhereHas('authors', fn ($q) => $q->where('name', $operator, $pattern))
                            ->orWhereHas('category', fn ($q) => $q->where('name', $operator, $pattern));
                    });
                }
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->input('category')));
        }

        $posts = $query->paginate(9)->withQueryString();

        return view('public.home', compact('posts', 'categories'));
    }

    public function show(string $slug): View
    {
        $post = Post::with(['category', 'authors', 'images', 'creator'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = Post::with('category')
            ->published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        return view('public.post-detail', compact('post', 'relatedPosts'));
    }
}