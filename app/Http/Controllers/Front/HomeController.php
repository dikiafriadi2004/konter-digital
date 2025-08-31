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
         $posts = Post::latest()->take(3)->get();
        return view('front.home.index', compact('landing', 'posts'));
    }
}
