@extends('cms.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Dasbor</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Total Pengguna</p>
                    <p class="text-3xl font-bold">10,240</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900/50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.975 5.975 0 0112 13a5.975 5.975 0 013 5.197M15 21a6 6 0 00-9-5.197" />
                    </svg>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Tampilan Halaman</p>
                    <p class="text-3xl font-bold">1,345,678</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900/50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Pendapatan</p>
                    <p class="text-3xl font-bold">$25,680</p>
                </div>
                <div class="bg-indigo-100 dark:bg-indigo-900/50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01" />
                    </svg>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Total Postingan</p>
                    <p class="text-3xl font-bold">893</p>
                </div>
                <div class="bg-amber-100 dark:bg-amber-900/50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Analitik Situs Web</h3>
                <div class="h-80 rounded-lg">
                    <canvas id="analyticsChart"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Pembaruan Terbaru</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-primary-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <div>
                            <p class="font-semibold text-sm">Pengguna baru terdaftar: <span
                                    class="font-normal text-slate-600 dark:text-slate-300">john.doe@example.com</span>
                            </p>
                            <p class="text-xs text-slate-400">5 menit yang lalu</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <div>
                            <p class="font-semibold text-sm">Server #3 berhasil dimulai ulang.</p>
                            <p class="text-xs text-slate-400">30 menit yang lalu</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <div>
                            <p class="font-semibold text-sm">Postingan diterbitkan: <span
                                    class="font-normal text-slate-600 dark:text-slate-300">"Memulai dengan
                                    Tailwind"</span></p>
                            <p class="text-xs text-slate-400">1 jam yang lalu</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <div>
                            <p class="font-semibold text-sm">Pencadangan database gagal.</p>
                            <p class="text-xs text-slate-400">2 jam yang lalu</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

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
                            <th scope="col" class="px-6 py-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                Pengantar CSS modern</th>
                            <td class="px-6 py-4">Jane Doe</td>
                            <td class="px-6 py-4">2025-08-10</td>
                            <td class="px-6 py-4"><span
                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Diterbitkan</span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <button
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline open-delete-modal">Hapus</button>
                            </td>
                        </tr>
                        <tr
                            class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                Praktik Terbaik JavaScript</th>
                            <td class="px-6 py-4">John Smith</td>
                            <td class="px-6 py-4">2025-08-09</td>
                            <td class="px-6 py-4"><span
                                    class="bg-amber-100 text-amber-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-amber-900 dark:text-amber-300">Draf</span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <button
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline open-delete-modal">Hapus</button>
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                Membangun Aplikasi Web yang Aksesibel</th>
                            <td class="px-6 py-4">Alice Johnson</td>
                            <td class="px-6 py-4">2025-08-08</td>
                            <td class="px-6 py-4"><span
                                    class="bg-slate-100 text-slate-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-slate-700 dark:text-slate-300">Diarsipkan</span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <button
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline open-delete-modal">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
