<?php

namespace App\Http\Controllers\Front;

use App\Models\Cms\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function show($slug)
    {
        if ($slug === 'contact') {
            return redirect()->route('contact.index');
        }

        if ($slug === 'about') {
            return redirect()->route('about.index');
        }

        $page = Page::where('slug', $slug)->firstOrFail();
        return view('front.pages.show', compact('page'));
    }
}
