@extends('cms.layouts.app')

@section('title', 'Posts')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.posts.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Posts
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List Posts</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Post Management</h2>

            <div class="flex gap-3 flex-wrap">
                <!-- Add New Post Button -->
                <a href="{{ route('cms.posts.create') }}"
                    class="inline-flex items-center justify-center px-5 py-2 bg-primary-600 text-white rounded-lg shadow-md hover:bg-primary-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add New Post
                </a>

                <!-- Trash Posts Button -->
                <a href="{{ route('cms.posts.trash') }}"
                    class="inline-flex items-center justify-center px-5 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H3a1 1 0 100 2h1v10a2 2 0 002 2h8a2 2 0 002-2V6h1a1 1 0 100-2h-2V3a1 1 0 00-1-1H6zm2 3a1 1 0 012 0v8a1 1 0 11-2 0V5zm4 0a1 1 0 012 0v8a1 1 0 11-2 0V5z"
                            clip-rule="evenodd" />
                    </svg>
                    Trash Posts
                </a>
            </div>
        </div>


        <!-- Filter Form -->
        <form method="GET" action="{{ route('cms.posts.index') }}"
            class="mb-6 p-4 bg-white dark:bg-slate-800 rounded-xl shadow-md">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-md leading-5 bg-white dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:placeholder-slate-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                            placeholder="Cari postingan...">
                    </div>
                </div>

                <div>
                    <label for="category-filter" class="sr-only">Category</label>
                    <select id="category-filter" name="category_id"
                        class="block w-full pl-3 pr-10 py-2 text-base border-slate-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status-filter" class="sr-only">Status</label>
                    <select id="status-filter" name="status"
                        class="block w-full pl-3 pr-10 py-2 text-base border-slate-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                        <option value="">All Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Pulished</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600 font-semibold">
                        Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- Table -->
        <div class="bg-white dark:bg-slate-800 p-4 sm:p-6 rounded-xl shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
                        <tr>
                            <th scope="col" class="p-4">No</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">User</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $key => $post)
                            <tr
                                class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                                <td class="w-4 p-4">{{ $posts->firstItem() + $key }}</td>
                                <th scope="row" class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    <a href="#"
                                        class="hover:text-primary-600 open-post-detail-modal-trigger cursor-pointer">{{ $post->title }}</a>
                                </th>
                                <td class="px-6 py-4">{{ $post->user->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $post->category->name ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full
                                @if ($post->status == 'published') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                @elseif($post->status == 'draft') bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300
                                @elseif($post->status == 'archived') bg-slate-200 text-slate-800 dark:bg-slate-700 dark:text-slate-300 @endif">
                                        @switch($post->status)
                                            @case('published')
                                                Diterbitkan
                                            @break

                                            @case('draft')
                                                Draf
                                            @break

                                            @default
                                                {{ ucfirst($post->status) }}
                                        @endswitch
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $post->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('cms.posts.edit', $post->id) }}"
                                            class="p-2 text-slate-500 hover:text-primary-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>

                                        <button data-title="{{ $post->title }}"
                                            data-action="{{ route('cms.posts.destroy', $post->id) }}"
                                            class="delete-post-btn p-2 text-slate-500 hover:text-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>


                                        <a href="#"
                                            class="p-2 text-slate-500 hover:text-blue-600 open-post-detail-modal-trigger">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-slate-500 dark:text-slate-400">Tidak
                                        ada postingan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            </div>
            @include('cms.posts.modal-delete')
        </main>
    @endsection

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const deleteButtons = document.querySelectorAll('.delete-post-btn');
                const modal = document.getElementById('delete-post-modal');
                const cancelBtn = document.getElementById('cancel-delete-post');
                const postTitleSpan = document.getElementById('post-title-name');
                const deleteForm = document.getElementById('delete-post-form');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const title = button.dataset.title;
                        const action = button.dataset.action;

                        postTitleSpan.textContent = title;
                        deleteForm.action = action; // set route sesuai Laravel

                        modal.classList.remove('hidden');
                    });
                });

                cancelBtn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });
        </script>
    @endpush
