@extends('cms.layouts.app')

@section('title', 'Trash Pages')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">

        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.pages.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        pages
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List Pages</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Trash Pages</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Trash Pages</h2>
            <a href="{{ route('cms.pages.index') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg shadow-md hover:bg-primary-700">
                &larr; Back to Pages
            </a>
        </div>

        <div class="bg-white dark:bg-slate-800 p-4 sm:p-6 rounded-xl shadow-md overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Slug</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $key => $page)
                        <tr
                            class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                            <td class="p-4">{{ $pages->firstItem() + $key }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $page->title }}</td>
                            <td class="px-6 py-4">/{{ $page->slug ?? '-' }}</td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <!-- Restore Button -->
                                <form action="{{ route('cms.pages.restore', $page->id) }}" method="POST">
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
                                <button type="button" data-id="{{ $page->id }}" data-title="{{ $page->title }}"
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
                {{ $pages->links('pagination::tailwind') }}
            </div>
        </div>

        @include('cms.pages.modal-delete-trash')

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
                    const pageId = btn.dataset.id;
                    const pageTitle = btn.dataset.title;

                    titleSpan.textContent = pageTitle;
                    form.action = `/cms/pages/${pageId}/force-delete`;

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
