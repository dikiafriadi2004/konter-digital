<div id="modal-{{ $category->id }}"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Edit Category</h2>

        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="edit-category-name-{{ $category->id }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Category Name</label>
                <input type="text" id="edit-category-name-{{ $category->id }}" name="name"
                    class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                    placeholder="Masukkan nama kategori, cth: Teknologi" value="{{ $category->name }}" required>
            </div>
            <div class="mb-4">
                <label for="edit-category-slug-{{ $category->id }}"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Slug</label>
                <input type="text" id="edit-category-slug-{{ $category->id }}" name="slug"
                    class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                    placeholder="Slug otomatis dibuat" value="{{ $category->slug }}" readonly>
            </div>
            <div class="mb-6">
                <label for="category-description-{{ $category->id }}"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description
                    (Opsional)</label>
                <textarea id="category-description-{{ $category->id }}" name="description" rows="3"
                    class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                    placeholder="Deskripsi singkat kategori">{{ $category->description }}</textarea>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal('modal-{{ $category->id }}')"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Update
                </button>
            </div>
        </form>

        {{-- Tombol Close (pojok kanan atas) --}}
        <button onclick="closeModal('modal-{{ $category->id }}')"
            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">&times;</button>
    </div>
</div>
