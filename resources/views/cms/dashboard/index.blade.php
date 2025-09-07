@extends('cms.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8 space-y-6">

        {{-- Statistik Ringkas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6">
            {{-- Total User --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center gap-4">
                <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                    <!-- SVG Icon -->
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-500">Total User</h3>
                    <p class="text-2xl font-bold mt-1">{{ $totalUsers }}</p>
                </div>
            </div>

            {{-- Total Post --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center gap-4">
                <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full"></div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-500">Total Post</h3>
                    <p class="text-2xl font-bold mt-1">{{ $totalPosts }}</p>
                    <p class="text-xs mt-1 text-slate-500">
                        {{ $publishedPosts }} published • {{ $draftPosts }} draft
                    </p>
                </div>
            </div>

            {{-- Total Category --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center gap-4">
                <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full"></div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-500">Total Category</h3>
                    <p class="text-2xl font-bold mt-1">{{ $totalCategories }}</p>
                </div>
            </div>

            {{-- Total Views --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center gap-4">
                <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full"></div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-500">Total Views</h3>
                    <p class="text-2xl font-bold mt-1">{{ $totalViews }}</p>
                </div>
            </div>

            {{-- Unique Visitors Hari Ini --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center gap-4">
                <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-full"></div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-500">Unique Visitors Hari Ini</h3>
                    <p class="text-2xl font-bold mt-1">{{ $uniqueVisitors }}</p>
                </div>
            </div>

            {{-- Total Hits Hari Ini --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center gap-4">
                <div class="p-3 bg-pink-100 dark:bg-pink-900 rounded-full"></div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-500">Total Hits Hari Ini</h3>
                    <p class="text-2xl font-bold mt-1">{{ $totalHits }}</p>
                </div>
            </div>
        </div>

        {{-- Grafik & Statistik --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Analytics Post --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Analitik Post (Views per Bulan)</h3>
                <div class="h-80 rounded-lg">
                    <canvas id="analyticsChart"></canvas>
                </div>
            </div>

            {{-- Visitor --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Statistik Visitor (7 Hari Terakhir)</h3>
                <div class="h-80 rounded-lg">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Visitor Terbaru --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold mb-4">Visitor Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-slate-200 dark:border-slate-700 rounded-lg">
                    <thead class="bg-slate-100 dark:bg-slate-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold">IP</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Browser</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Platform</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Device</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Location</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Page</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse ($visitors as $v)
                            <tr class="text-sm">
                                <td class="px-4 py-2">{{ $v->ip }}</td>
                                <td class="px-4 py-2">{{ $v->browser }}</td>
                                <td class="px-4 py-2">{{ $v->platform }}</td>
                                <td class="px-4 py-2">{{ $v->device }}</td>
                                <td class="px-4 py-2">{{ $v->location ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $v->page }}</td>
                                <td class="px-4 py-2 text-xs">{{ $v->visit_date->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center text-slate-500">Belum ada data visitor</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Halaman yang Dikunjungi Hari Ini --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold mb-4">Halaman yang Dikunjungi Hari Ini</h3>
            <div class="overflow-y-auto max-h-96 border rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-slate-100 dark:bg-slate-700 sticky top-0">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Page</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Hits</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Unique Visitor</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">%</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @php
                            $totalHitsToday = $visitorPages->sum('hits');
                        @endphp
                        @forelse ($visitorPages as $vp)
                            @php
                                $percentage = $totalHitsToday > 0
                                    ? round(($vp->hits / $totalHitsToday) * 100, 1)
                                    : 0;
                            @endphp
                            <tr class="text-sm">
                                <td class="px-4 py-2 font-medium">{{ $vp->page ?? '/' }}</td>
                                <td class="px-4 py-2">{{ $vp->hits }}</td>
                                <td class="px-4 py-2">{{ $vp->unique_visitors }}</td>
                                <td class="px-4 py-2 w-1/3">
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                                        <div class="h-3 rounded-full bg-blue-500" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-xs text-slate-500">{{ $percentage }}%</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-slate-500">Belum ada data halaman hari ini</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Latest Posts --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold mb-4">Latest Posts</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-slate-200 dark:border-slate-700 rounded-lg">
                    <thead class="bg-slate-100 dark:bg-slate-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Title</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Author</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse ($latestPosts as $post)
                            <tr class="text-sm">
                                <td class="px-4 py-2">{{ $post->title }}</td>
                                <td class="px-4 py-2">{{ $post->user->name }}</td>
                                <td class="px-4 py-2">
                                    @if ($post->status === 'published')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200">Published</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200">Draft</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-xs">{{ $post->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-slate-500">Belum ada post terbaru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Top Posts --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold mb-4">Top Posts</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-slate-200 dark:border-slate-700 rounded-lg">
                    <thead class="bg-slate-100 dark:bg-slate-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Title</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Author</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Category</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold">Views</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse ($topPosts as $post)
                            <tr class="text-sm">
                                <td class="px-4 py-2">{{ $post->title }}</td>
                                <td class="px-4 py-2">{{ $post->user->name }}</td>
                                <td class="px-4 py-2">{{ $post->category->name ?? 'Uncategorized' }}</td>
                                <td class="px-4 py-2">{{ $post->views }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-slate-500">Belum ada post populer</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection

{{-- ChartJS --}}
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Post Analytics Chart
        const analyticsCtx = document.getElementById('analyticsChart').getContext('2d');
        new Chart(analyticsCtx, {
            type: 'line',
            data: {
                labels: @json($analyticsData['labels']),
                datasets: [{
                    label: 'Views',
                    data: @json($analyticsData['data']),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Visitor Analytics Chart
        const visitorCtx = document.getElementById('visitorChart').getContext('2d');
        new Chart(visitorCtx, {
            type: 'bar',
            data: {
                labels: @json($visitorAnalytics['labels']),
                datasets: [{
                    label: 'Visitors',
                    data: @json($visitorAnalytics['data']),
                    backgroundColor: 'rgba(16, 185, 129, 0.7)'
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
@endpush
