<div id="deleteModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Hapus User</h3>
        <p class="text-slate-600 dark:text-slate-300 mb-6">
            Apakah Anda yakin ingin menghapus user
            <span id="deleteUserTitle" class="font-bold"></span>?
        </p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelDeleteBtn"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-slate-800 dark:text-white rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>
