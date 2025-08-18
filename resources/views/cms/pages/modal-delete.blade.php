<!-- Modal Delete -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">
            Confirm Delete
        </h3>
        <p class="text-slate-600 dark:text-slate-300 mb-6">
            Are you sure you want to delete the page <span id="deletePageTitle" class="font-bold"></span>?
        </p>

        <div class="flex justify-end space-x-3">
            <button id="cancelDeleteBtn"
                class="px-4 py-2 bg-slate-300 dark:bg-slate-600 text-slate-800 dark:text-white rounded-lg hover:bg-slate-400 dark:hover:bg-slate-500">
                Cancel
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>
