<?php

namespace App\Http\Controllers\Front;

use App\Models\Cms\Post;
use App\Models\Cms\Landing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $landing = Landing::first();
        // Ambil hanya artikel yang published, terbaru, maksimal 3
        $posts = Post::with(['user', 'category'])
            ->where('status', 'published') // 🔹 filter published
            ->latest()
            ->take(3)
            ->get();
        return view('front.home.index', compact('landing', 'posts'));
    }
}
