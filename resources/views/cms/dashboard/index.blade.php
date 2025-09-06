@extends('cms.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        {{-- Breadcrumb --}}
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.dashboard.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
                            aria-hidden="true">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10" aria-hidden="true">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Dashboard</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- Statistik Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Pengguna --}}
            <div class="p-5 bg-white dark:bg-slate-800 rounded-xl shadow-md flex items-center space-x-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-6a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Pengguna</p>
                    <p class="text-xl font-semibold text-slate-800 dark:text-white">{{ $totalUsers }}</p>
                </div>
            </div>

            {{-- Total Views Blog --}}
            <div class="p-5 bg-white dark:bg-slate-800 rounded-xl shadow-md flex items-center space-x-4">
                <div class="p-3 bg-green-100 text-green-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Views Blog</p>
                    <p class="text-xl font-semibold text-slate-800 dark:text-white">{{ number_format($totalViews) }}</p>
                </div>
            </div>

            {{-- Total Kategori --}}
            <div class="p-5 bg-white dark:bg-slate-800 rounded-xl shadow-md flex items-center space-x-4">
                <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Kategori</p>
                    <p class="text-xl font-semibold text-slate-800 dark:text-white">{{ number_format($totalCategories) }}
                    </p>
                </div>
            </div>

            {{-- Total Postingan --}}
            <div class="p-5 bg-white dark:bg-slate-800 rounded-xl shadow-md flex items-center space-x-4">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v12a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Postingan</p>
                    <p class="text-xl font-semibold text-slate-800 dark:text-white">{{ $totalPosts }}</p>
                </div>
            </div>
        </div>

        {{-- Analytics --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Analitik Situs Web</h3>

                @if ($analyticsData['hasData'])
                    <div class="rounded-lg" style="height:320px;">
                        <canvas id="analyticsChart"></canvas>
                    </div>
                @else
                    <div class="flex items-center justify-center h-80 text-slate-500 dark:text-slate-400">
                        Belum ada data views untuk ditampilkan
                    </div>
                @endif
            </div>

            {{-- Info tambahan --}}
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Status Postingan</h3>
                <ul class="space-y-2 text-sm">
                    <li><span class="font-semibold text-green-600">{{ $publishedPosts }}</span> Published</li>
                    <li><span class="font-semibold text-amber-600">{{ $draftPosts }}</span> Draft</li>
                </ul>
            </div>
        </div>

        {{-- Postingan Terbaru --}}
        <div class="mt-8 bg-white dark:bg-slate-800 p-4 sm:p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold mb-4">Postingan Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Penulis</th>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Views</th>
                            <th scope="col" class="px-6 py-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestPosts as $post)
                            <tr class="border-b dark:border-slate-700">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $post->title }}</td>
                                <td class="px-6 py-4">{{ $post->user->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $post->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    @if ($post->status === 'published')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">Published</span>
                                    @elseif ($post->status === 'draft')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-600">Draft</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-200 text-slate-600">{{ ucfirst($post->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ number_format($post->views) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('cms.posts.edit', $post->id) }}"
                                        class="text-primary-600 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-slate-500">Belum ada postingan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Top Posts (Berdasarkan Views) --}}
        <div class="mt-8 bg-white dark:bg-slate-800 p-4 sm:p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold mb-4">Top Posts</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Penulis</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topPosts as $post)
                            <tr class="border-b dark:border-slate-700">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $post->title }}</td>
                                <td class="px-6 py-4">{{ $post->user->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $post->category->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ number_format($post->views) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-slate-500">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('analyticsChart');
    if (!ctx) return; // kalau canvas tidak ada (data kosong)

    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#e2e8f0' : '#475569';
    const gridColor = isDark ? 'rgba(148,163,184,0.2)' : 'rgba(148,163,184,0.3)';

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($analyticsData['labels']),
            datasets: [{
                label: 'Total Views per Bulan',
                data: @json($analyticsData['data']),
                borderColor: 'rgb(59,130,246)',
                backgroundColor: 'rgba(59,130,246,0.2)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: 'rgb(59,130,246)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: textColor }
                }
            },
            scales: {
                x: {
                    ticks: { color: textColor },
                    grid: { color: gridColor }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: textColor },
                    grid: { color: gridColor }
                }
            }
        }
    });
});
</script>
@endpush