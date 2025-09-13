<?php

namespace App\Http\Controllers;

use App\Models\Cms\Page;
use App\Models\Cms\Post;
use App\Models\Cms\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index(): Response
    {
        // Cache sitemap selama 1 jam (3600 detik)
        $xml = Cache::remember('sitemap.xml', 3600, function () {
            $posts = Post::where('status', 'published')->latest()->get();
            $categories = Category::all();
            $pages = Page::all();

            return view('sitemap', compact('posts', 'categories', 'pages'))->render();
        });

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * Opsional: Hapus cache sitemap (misal dipanggil saat ada post baru)
     */
    public static function clearCache(): void
    {
        Cache::forget('sitemap.xml');
    }
}
