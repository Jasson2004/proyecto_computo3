<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['category', 'authors', 'images'])
            ->published()
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function drafts(): View
    {
        $drafts = Post::with(['category', 'authors', 'images'])
            ->draft()
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('admin.posts.drafts', compact('drafts'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('id')->get();
        $admins = User::where('role', 'admin')->orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'admins'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $status = $data['action'];

        $post = DB::transaction(function () use ($request, $data, $status) {
            $featuredPath = null;
            if ($request->hasFile('featured_image')) {
                $featuredPath = $request->file('featured_image')->store('posts/featured', 'public');
            }

            $post = Post::create([
                'user_id' => $request->user()->id,
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'slug' => Str::slug($data['title']) . '-' . Str::random(5),
                'activity_date' => $data['activity_date'],
                'excerpt' => $data['excerpt'] ?? Str::limit(strip_tags($data['content']), 160),
                'content' => $data['content'],
                'featured_image' => $featuredPath,
                'status' => $status,
                'published_at' => $status === 'published' ? now() : null,
            ]);

            $post->authors()->sync($data['authors']);

            if ($request->has('evidences')) {
                foreach ($request->file('evidences', []) as $index => $evidenceFiles) {
                    if (isset($evidenceFiles['file'])) {
                        $meta = $data['evidences'][$index];
                        $path = $evidenceFiles['file']->store('posts/evidences', 'public');
                        $post->images()->create([
                            'image_path' => $path,
                            'participant_name' => $meta['participant_name'],
                            'evidence_type' => $meta['evidence_type'],
                            'caption' => $meta['caption'] ?? null,
                        ]);
                    }
                }
            }

            return $post;
        });

        $route = $post->status === 'published' ? 'admin.posts.index' : 'admin.posts.drafts';
        $message = $post->status === 'published'
            ? 'Publicación creada y publicada exitosamente.'
            : 'Borrador guardado en MySQL correctamente.';

        return redirect()->route($route)->with('success', $message);
    }

    public function edit(Post $post): View
    {
        $post->load(['authors', 'images']);
        $categories = Category::orderBy('id')->get();
        $admins = User::where('role', 'admin')->orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'admins'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        $status = $data['action'];

        DB::transaction(function () use ($request, $data, $post, $status) {
            if ($request->hasFile('featured_image')) {
                if ($post->featured_image) {
                    Storage::disk('public')->delete($post->featured_image);
                }
                $post->featured_image = $request->file('featured_image')->store('posts/featured', 'public');
            }

            $publishedAt = $post->published_at;
            if ($status === 'published' && is_null($publishedAt)) {
                $publishedAt = now();
            } elseif ($status === 'draft') {
                $publishedAt = null;
            }

            $post->update([
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'activity_date' => $data['activity_date'],
                'excerpt' => $data['excerpt'] ?? Str::limit(strip_tags($data['content']), 160),
                'content' => $data['content'],
                'featured_image' => $post->featured_image,
                'status' => $status,
                'published_at' => $publishedAt,
            ]);

            $post->authors()->sync($data['authors']);

            if ($request->has('evidences')) {
                foreach ($request->file('evidences', []) as $index => $evidenceFiles) {
                    if (isset($evidenceFiles['file'])) {
                        $meta = $data['evidences'][$index];
                        $path = $evidenceFiles['file']->store('posts/evidences', 'public');
                        $post->images()->create([
                            'image_path' => $path,
                            'participant_name' => $meta['participant_name'],
                            'evidence_type' => $meta['evidence_type'],
                            'caption' => $meta['caption'] ?? null,
                        ]);
                    }
                }
            }
        });

        $route = $status === 'published' ? 'admin.posts.index' : 'admin.posts.drafts';
        return redirect()->route($route)->with('success', 'Entrada actualizada correctamente.');
    }

    public function publish(Post $post): RedirectResponse
    {
        $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', "La entrada \"{$post->title}\" ahora es pública.");
    }

    public function unpublish(Post $post): RedirectResponse
    {
        $post->update([
            'status' => 'draft',
            'published_at' => null,
        ]);

        return redirect()->route('admin.posts.drafts')
            ->with('success', "La entrada \"{$post->title}\" ha pasado a borradores.");
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        foreach ($post->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $wasDraft = $post->status === 'draft';
        $post->delete();

        $route = $wasDraft ? 'admin.posts.drafts' : 'admin.posts.index';
        return redirect()->route($route)->with('success', 'Entrada y evidencias eliminadas correctamente.');
    }

    public function destroyImage(PostImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Evidencia fotográfica eliminada.');
    }
}