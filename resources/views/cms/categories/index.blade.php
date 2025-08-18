@extends('cms.layouts.app')

@section('title', 'Categories')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="index.html"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Category
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List Category</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Category Management</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Formulir Buat Kategori -->
            <div class="lg:col-span-1 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md h-fit">
                <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Create a New Category</h3>
                <form id="create-category-form" action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="category-name"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Category Name</label>
                        <input type="text" id="category-name" name="name" value="{{ old('name') }}"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan nama kategori, cth: Teknologi" required>

                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category-slug"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Slug</label>
                        <input type="text" id="category-slug" name="slug" value="{{ old('slug') }}"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                            placeholder="Slug otomatis dibuat" readonly>
                    </div>

                    <div class="mb-6">
                        <label for="category-description"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description
                            (Opsional)</label>
                        <textarea id="category-description" name="description" rows="3"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                            placeholder="Deskripsi singkat kategori">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full px-5 py-2.5 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Add Category
                    </button>
                </form>
            </div>

            <!-- Kolom Kanan: Tabel Kategori -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Category List</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">NO</th>
                                <th scope="col" class="px-6 py-3">Category Name</th>
                                <th scope="col" class="px-6 py-3">Slug</th>
                                <th scope="col" class="px-6 py-3">Description</th>
                                <th scope="col" class="px-6 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody id="category-table-body">
                            @foreach ($categories as $key => $category)
                                <tr
                                    class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                        {{ $categories->firstItem() + $key }}
                                    </td>
                                    <td class="px-6 py-4">{{ $category->name }}</td>
                                    <td class="px-6 py-4">{{ $category->slug }}</td>
                                    <td class="px-6 py-4">{{ $category->description ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <!-- tombol Edit -->
                                        <button onclick="openModal('modal-{{ $category->id }}')"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            Edit
                                        </button>

                                        <!-- tombol Hapus -->
                                        <button type="button" onclick="openModal('delete-modal-{{ $category->id }}')"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- modal edit khusus kategori ini -->
                                @include('cms.categories.modal-edit', ['category' => $category])
                                <!-- modal delete khusus kategori ini -->
                                @include('cms.categories.modal-delete', ['category' => $category])
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $categories->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script>
        // Fungsi helper untuk membuat slug
        function slugify(text) {
            return text
                .toString() // pastikan string
                .normalize('NFD') // pecah aksen (contoh é → e)
                .replace(/[\u0300-\u036f]/g, '') // hapus tanda aksen
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '') // hapus karakter spesial
                .replace(/[\s_-]+/g, '-') // ganti spasi/underscore jadi "-"
                .replace(/^-+|-+$/g, ''); // hapus "-" di awal/akhir
        }

        // ===== Form Tambah Kategori =====
        const categoryNameInput = document.getElementById('category-name');
        const categorySlugInput = document.getElementById('category-slug');

        if (categoryNameInput && categorySlugInput) {
            categoryNameInput.addEventListener('input', () => {
                categorySlugInput.value = slugify(categoryNameInput.value);
            });
        }

        // Cari semua input edit category name
        document.querySelectorAll("[id^='edit-category-name-']").forEach(input => {
            input.addEventListener('input', function() {
                const id = this.id.replace('edit-category-name-', '');
                const slugInput = document.getElementById(`edit-category-slug-${id}`);
                if (slugInput) {
                    slugInput.value = slugify(this.value);
                }
            });
        });

        // ===== Form Edit Kategori (jika ada modal edit) =====
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteCategoryForm');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

            if (!deleteModal || !deleteForm || !cancelDeleteBtn) return; // stop jika ada yang null

            document.querySelectorAll('.open-delete-modal').forEach(btn => {
                btn.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    deleteForm.setAttribute('action', `/cms/categories/${categoryId}`);
                    deleteModal.classList.remove('hidden');
                });
            });

            cancelDeleteBtn.addEventListener('click', () => {
                deleteModal.classList.add('hidden');
            });

            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) deleteModal.classList.add('hidden');
            });
        });
    </script>
@endpush
