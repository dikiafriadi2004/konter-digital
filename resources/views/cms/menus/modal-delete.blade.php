<!-- Modal Konfirmasi Hapus (letakkan sekali di halaman) -->
<div id="deleteModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
        <h3 class="text-lg font-semibold mb-2">Confirm Delete</h3>
        <p class="text-sm text-slate-600 mb-6">Are you sure you want to delete this menu? <b>{{ $menu->title }}</b></p>

        <div class="flex justify-end space-x-2">
            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Cancel
            </button>

            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>
