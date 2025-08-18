@extends('cms.layouts.app')

@section('title', 'Trash Posts')

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
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List Post</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Trash Posts</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Trash Posts</h2>
            <a href="{{ route('cms.posts.index') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg shadow-md hover:bg-primary-700">
                &larr; Back to Posts
            </a>
        </div>

        <div class="bg-white dark:bg-slate-800 p-4 sm:p-6 rounded-xl shadow-md overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $key => $post)
                        <tr
                            class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                            <td class="p-4">{{ $posts->firstItem() + $key }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $post->title }}</td>
                            <td class="px-6 py-4">{{ $post->user->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $post->category->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">

                                <!-- Restore Button -->
                                <form action="{{ route('cms.posts.restore', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 text-slate-500 hover:text-green-600 rounded"
                                        title="Restore">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10v6h6M21 4l-6 6 6 6" />
                                        </svg>
                                    </button>
                                </form>

                                <!-- Force Delete Button -->
                                <button type="button" data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                    class="force-delete-btn p-2 text-slate-500 hover:text-red-600 rounded"
                                    title="Delete Permanently">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-slate-500 dark:text-slate-400">
                                Trash kosong.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- Modal Force Delete -->
        <div id="force-delete-modal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 w-96">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Delete Post Permanently</h3>
                <p class="text-slate-600 dark:text-slate-300 mb-4">
                    Are you sure you want to delete <span id="force-delete-title" class="font-bold"></span> permanently?
                </p>
                <div class="flex justify-end gap-3">
                    <button id="cancel-force-delete"
                        class="px-4 py-2 bg-slate-200 dark:bg-slate-700 rounded hover:bg-slate-300 dark:hover:bg-slate-600">
                        Cancel
                    </button>
                    <form id="force-delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('force-delete-modal');
            const titleSpan = document.getElementById('force-delete-title');
            const form = document.getElementById('force-delete-form');
            const cancelBtn = document.getElementById('cancel-force-delete');
            const buttons = document.querySelectorAll('.force-delete-btn');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const postId = btn.dataset.id;
                    const postTitle = btn.dataset.title;

                    titleSpan.textContent = postTitle;
                    form.action = `/cms/posts/${postId}/force-delete`;

                    modal.classList.remove('hidden');
                });
            });

            cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
            modal.addEventListener('click', e => {
                if (e.target === modal) modal.classList.add('hidden');
            });
        });
    </script>
@endpush
