<?php

namespace App\Http\Controllers\Cms;

use App\Models\Cms\Post;
use Illuminate\Support\Str;
use App\Models\Cms\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();

        return view('cms.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('cms.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $thumbnailPath = $request->file('thumbnail')?->store('thumbnails', 'public');

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status ?? 'draft',
        ]);

        return redirect()->route('cms.posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('cms.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'meta_description' => 'nullable|string|max:500',
            'body' => 'required|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail && file_exists(storage_path('app/public/' . $post->thumbnail))) {
                @unlink(storage_path('app/public/' . $post->thumbnail));
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            $data['thumbnail'] = $post->thumbnail;
        }

        $post->update($data);
        return redirect()->route('cms.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('cms.posts.index')->with('success', 'Post moved to trash!');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->with('user')->paginate(10);
        return view('cms.posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('cms.posts.trash')->with('success', 'Post restored successfully!');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        // Cek thumbnail real-time sebelum hapus
        if ($post->thumbnail) {
            $fullPath = storage_path('app/public/' . $post->thumbnail);
            if (file_exists($fullPath)) {
                @unlink($fullPath);
                Log::info("Thumbnail {$post->thumbnail} berhasil dihapus dari disk.");
            } else {
                Log::warning("Thumbnail {$post->thumbnail} TIDAK DITEMUKAN di disk!");
            }
        }

        $post->forceDelete();
        Log::info("Post {$post->id} dihapus permanen.");

        return redirect()->route('cms.posts.trash')
            ->with('success', 'Post permanently deleted!');
    }
}
