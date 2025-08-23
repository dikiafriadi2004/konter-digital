<div id="editMenuModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-96 p-6 relative">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Edit Menu</h2>

        <form id="editMenuForm" method="POST">
            @csrf
            @method('PUT') {{-- penting untuk update di Laravel --}}
            <input type="hidden" id="edit_menu_id" name="id">

            <div class="mb-3">
                <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Judul</label>
                <input type="text" id="edit_menu_title" name="title"
                    class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-3">
                <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">URL</label>
                <input type="text" id="edit_menu_url" name="url"
                    class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
