<?php

namespace App\Http\Controllers\Cms;

use App\Models\User;
use App\Models\Cms\Post;
use App\Models\Cms\Visitor;
use App\Models\Cms\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- Statistik umum ---
        $totalUsers      = User::count();
        $totalPosts      = Post::count();
        $publishedPosts  = Post::where('status', 'published')->count();
        $draftPosts      = Post::where('status', 'draft')->count();
        $totalCategories = Category::count();
        $totalViews      = Post::sum('views');

        // --- Postingan ---
        $latestPosts = Post::with('user')->latest()->take(5)->get();
        $topPosts    = Post::with(['user', 'category'])->orderByDesc('views')->take(5)->get();

        // --- Analytics Post (Views per Bulan) ---
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
            'labels'  => $labels,
            'data'    => $data,
            'hasData' => $data->sum() > 0,
        ];

        // --- Visitor Data (list terbaru) ---
        $visitors = Visitor::latest()->take(10)->get();

        // --- Statistik Visitor (7 Hari Terakhir) ---
        $visitorStats = Visitor::selectRaw("visit_date as tanggal, SUM(hit_count) as total")
            ->where('visit_date', '>=', now()->subDays(6)->toDateString())
            ->groupBy('visit_date')
            ->orderBy('visit_date')
            ->pluck('total', 'tanggal');

        $visitorLabels = collect();
        $visitorData   = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->toDateString();
            $visitorLabels->push(date("d M", strtotime($day)));
            $visitorData->push($visitorStats[$day] ?? 0);
        }

        $visitorAnalytics = [
            'labels' => $visitorLabels,
            'data'   => $visitorData,
            'hasData' => $visitorData->sum() > 0,
        ];

        // --- Tambahan: Visitor Hari Ini ---
        $today = now()->toDateString();

        $uniqueVisitors = Visitor::where('visit_date', $today)->distinct('ip')->count('ip'); // ✅ fix
        $totalHits      = Visitor::where('visit_date', $today)->sum('hit_count');

        // --- Visitor per Halaman Hari Ini ---
        $visitorPages = Visitor::select(
            'page',
            DB::raw('SUM(hit_count) as hits'),
            DB::raw('COUNT(DISTINCT ip) as unique_visitors') // ✅ tambah unique visitor per page
        )
            ->where('visit_date', $today)
            ->groupBy('page')
            ->orderByDesc('hits')
            ->get();

        return view('cms.dashboard.index', compact(
            'totalUsers',
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'latestPosts',
            'totalCategories',
            'totalViews',
            'topPosts',
            'analyticsData',
            'visitors',
            'visitorAnalytics',
            'uniqueVisitors',
            'totalHits',
            'visitorPages'
        ));
    }
}
