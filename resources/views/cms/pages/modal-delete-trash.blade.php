<!-- Modal Force Delete -->
<div id="force-delete-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 w-96">
        <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Delete Page Permanently</h3>
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
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
            </form>
        </div>
    </div>
</div>
