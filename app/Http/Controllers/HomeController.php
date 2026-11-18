<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
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

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
        }

        $posts = $query->paginate(9)->withQueryString();
        $featuredPost = Post::with(['category', 'authors'])->published()->latest('published_at')->first();

        return view('public.home', compact('posts', 'categories', 'featuredPost'));
    }

    public function show(string $slug): View
    {
        // Garantiza que los borradores jamás sean accesibles públicamente (retorna 404)
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