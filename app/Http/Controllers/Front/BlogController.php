<?php

namespace App\Http\Controllers\Front;

use App\Models\Cms\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua post terbaru, 6 per halaman
        $posts = Post::with(['user', 'category'])
            ->latest()
            ->paginate(6);

        return view('front.blog.index', compact('posts'));
    }
    
    public function show($slug)
    {
        // Ambil postingan sesuai slug dengan relasi user & category
        $post = Post::with(['user', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Tambah jumlah view (visitor counter)
        $post->increment('views');

        // Ambil popular posts (views terbanyak, exclude post ini)
        $popularPosts = Post::with('category')
            ->where('id', '!=', $post->id)
            ->orderByDesc('views')
            ->take(4)
            ->get();

        // Ambil artikel terkait (kategori sama, exclude post ini)
        $relatedPosts = Post::with('category')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('front.blog.show', [
            'post'         => $post,
            'popularPosts' => $popularPosts,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
