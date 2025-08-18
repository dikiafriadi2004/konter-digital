<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\Storage;
use App\Models\Cms\Post;
use Illuminate\Support\Str;
use App\Models\Cms\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category']);

        // Filter search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();

        return view('cms.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('cms.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('cms.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        // Handle thumbnail baru
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            // Simpan file baru
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            // Biarkan thumbnail lama tetap
            $data['thumbnail'] = $post->thumbnail;
        }

        $post->update($data);

        return redirect()->route('cms.posts.index')->with('success', 'Post berhasil diperbarui!');
    }


    // Soft delete (ke trash)
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('cms.posts.index')->with('success', 'Post moved to trash!');
    }

    // Lihat trash
    public function trash()
    {

        $posts = Post::onlyTrashed()->with('user')->paginate(10);

        return view('cms.posts.trash', compact('posts'));
    }

    // Kembalikan dari trash
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('cms.posts.trash')->with('success', 'Post restored successfully!');
    }

    // Hapus permanen
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        // Hapus thumbnail jika ada
        if ($post->thumbnail) {
            // Gunakan disk public
            if (Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);
            }
        }

        // Hapus post permanen
        $post->forceDelete();

        return redirect()->route('cms.posts.trash')
            ->with('success', 'Post successfully deleted permanently.');
    }
}
