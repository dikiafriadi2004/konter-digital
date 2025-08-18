<div id="delete-modal-{{ $category->id }}"
    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg w-96 p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Confirm Delete</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6">
            Are you sure you want to delete the category <b>{{ $category->name }}</b>?
        </p>

        <div class="flex justify-end space-x-3">
            <!-- tombol batal -->
            <button type="button"
                onclick="closeModal('delete-modal-{{ $category->id }}')"
                class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-100 hover:bg-gray-400">
                Cancel
            </button>

            <!-- tombol hapus -->
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>
