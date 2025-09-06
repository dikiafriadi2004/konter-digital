<?php

namespace App\Http\Controllers\Cms;

use App\Models\User;
use App\Models\Cms\Post;
use App\Models\Cms\Category;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers      = User::count();
        $totalPosts      = Post::count();
        $publishedPosts  = Post::where('status', 'published')->count();
        $draftPosts      = Post::where('status', 'draft')->count();
        $totalCategories = Category::count();
        $totalViews      = Post::sum('views');

        $latestPosts = Post::with('user')->latest()->take(5)->get();
        $topPosts    = Post::with(['user', 'category'])->orderByDesc('views')->take(5)->get();

        // --- Analytics ---
        $rawAnalytics = Post::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, SUM(views) as total_views")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $monthKey = now()->subMonths($i)->format('Y-m');
            $months->push($monthKey);
        }

        $labels = $months->map(fn($m) => date("M Y", strtotime($m . "-01")))->values();
        $data   = $months->map(fn($m) => (int) ($rawAnalytics[$m]->total_views ?? 0))->values();

        $analyticsData = [
            'labels' => $labels,
            'data'   => $data,
            'hasData' => $data->sum() > 0, // buat indikator ada data
        ];

        return view('cms.dashboard.index', compact(
            'totalUsers',
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'latestPosts',
            'totalCategories',
            'totalViews',
            'topPosts',
            'analyticsData'
        ));
    }
}
