@extends('cms.layouts.app')

@section('title', 'Create Page')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.dashboard.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Pages
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('cms.pages.index') }}"
                            class="ms-1 text-sm font-medium text-slate-700 hover:text-primary-600 md:ms-2 dark:text-slate-400 dark:hover:text-white">List
                            Page</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Create Page</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Create a New Page</h2>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md h-fit w-full">
            <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">New Page Form</h3>
            <form action="{{ route('cms.pages.store') }}" method="POST">
                @csrf
                {{-- Title --}}
                <div class="mb-4">
                    <label for="title"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Title</label>
                    <input type="text" id="title" name="title"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                        placeholder="Masukkan judul halaman" required>
                </div>

                {{-- Slug (auto) --}}
                <div class="mb-4">
                    <label for="slug"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Slug</label>
                    <input type="text" id="slug" name="slug"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                        placeholder="slug-otomatis" readonly>
                </div>

                {{-- Body --}}
                <div class="mb-6">
                    <label for="body"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Body</label>
                    <textarea id="body" name="body" rows="12"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                        placeholder="Tulis konten halaman di sini..."></textarea>
                </div>

                {{-- Meta Title --}}
                <div class="mb-4">
                    <label for="meta_title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meta
                        Title</label>
                    <input type="text" id="meta_title" name="meta_title"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                        placeholder="Meta title halaman">
                </div>

                {{-- Meta Description --}}
                <div class="mb-4">
                    <label for="meta_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Meta Description <span class="text-xs text-slate-500">(Max 160 karakter)</span>
                    </label>
                    <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" oninput="updateMetaDescCount()"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                        placeholder="Tulis meta description untuk SEO (maksimal 160 karakter)..."></textarea>
                    <p id="meta_desc_counter" class="text-xs text-slate-500 mt-1">0 / 160 karakter</p>
                </div>

                {{-- Meta Keywords --}}
                <div class="mb-6">
                    <label for="meta_keywords"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                        placeholder="contoh: halaman, cms, laravel">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('cms.pages.index') }}"
                        class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">Buat
                        Halaman</button>
                </div>
            </form>
        </div>
    </main>

    {{-- Script untuk auto-generate slug --}}
    <script>
        document.getElementById('title').addEventListener('input', function() {
            let slug = this.value.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // hapus karakter aneh
                .trim()
                .replace(/\s+/g, '-'); // ganti spasi jadi -
            document.getElementById('slug').value = slug;
        });

        function updateMetaDescCount() {
            const textarea = document.getElementById('meta_description');
            const counter = document.getElementById('meta_desc_counter');
            counter.textContent = textarea.value.length + " / 160 karakter";
        }
    </script>
@endsection
