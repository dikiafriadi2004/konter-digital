<div id="force-delete-modal" tabindex="-1"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">
            Delete Permanently
        </h2>
        <p class="text-slate-600 dark:text-slate-300 mb-6">
            Are you sure you want to permanently delete
            <span class="font-semibold" id="force-delete-title"></span>?
            This action <span class="text-red-600 font-semibold">cannot be undone</span>.
        </p>

        <div class="flex justify-end gap-3">
            <button type="button" id="cancel-force-delete"
                class="px-4 py-2 bg-slate-200 text-slate-700 rounded hover:bg-slate-300 dark:bg-slate-700 dark:text-white">
                Cancel
            </button>
            <form id="force-delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete Permanently
                </button>
            </form>
        </div>
    </div>
</div>
