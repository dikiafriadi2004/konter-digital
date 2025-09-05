<?php

namespace App\Http\Controllers\Front;

use App\Models\Cms\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil hanya post dengan status published, terbaru, 6 per halaman
        $posts = Post::with(['user', 'category'])
            ->where('status', 'published') // 🔹 filter published
            ->latest()
            ->paginate(6);

        // Tambahkan SEO default untuk halaman Blog
        $title = 'Blog';
        $meta_description = 'Kumpulan artikel, tips, trik, dan berita terbaru seputar bisnis pulsa.';
        $meta_keywords = 'blog, artikel, tips pulsa, berita';
        $meta_image = asset('front/asset/img/default-blog.jpg');

        return view('front.blog.index', [
            'posts'            => $posts,
            'title'            => $title,
            'meta_description' => $meta_description,
            'meta_keywords'    => $meta_keywords,
            'meta_image'       => $meta_image,
        ]);
    }

    public function show($slug)
    {
        // Ambil hanya postingan dengan status published sesuai slug
        $post = Post::with(['user', 'category'])
            ->where('slug', $slug)
            ->where('status', 'published') // 🔹 filter published
            ->firstOrFail();

        // Tambah jumlah view (visitor counter)
        $post->increment('views');

        // Ambil popular posts (hanya published, exclude post ini)
        $popularPosts = Post::with('category')
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->orderByDesc('views')
            ->take(4)
            ->get();

        // Ambil artikel terkait (kategori sama, hanya published, exclude post ini)
        $relatedPosts = Post::with('category')
            ->where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        // 🔹 SEO meta data
        $title = $post->meta_title ?? $post->title;
        $meta_description = $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->body), 160);
        $meta_keywords = $post->meta_keywords ?? ($post->category->name ?? 'Blog');
        $meta_image = $post->thumbnail
            ? asset('storage/' . $post->thumbnail)
            : asset('front/asset/img/default-blog.jpg');

        return view('front.blog.show', [
            'post'             => $post,
            'popularPosts'     => $popularPosts,
            'relatedPosts'     => $relatedPosts,

            // SEO ke blade
            'title'            => $title,
            'meta_description' => $meta_description,
            'meta_keywords'    => $meta_keywords,
            'meta_image'       => $meta_image,
        ]);
    }
}
