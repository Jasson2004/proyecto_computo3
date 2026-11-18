<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::published()->count(),
            'draft_posts' => Post::draft()->count(),
            'categories_count' => Category::count(),
            'evidences_count' => PostImage::count(),
        ];

        $recentPosts = Post::with(['category', 'authors'])
            ->latest('updated_at')
            ->limit(6)
            ->get();

        $categoriesCoverage = Category::withCount([
            'posts as published_count' => fn ($q) => $q->published(),
            'posts as draft_count' => fn ($q) => $q->draft(),
        ])->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'categoriesCoverage'));
    }
}