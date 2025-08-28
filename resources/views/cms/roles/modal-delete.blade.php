{{-- Modal Delete --}}
<div id="deleteModal"
    class="hidden fixed inset-0 bg-slate-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Confirm Role Delete</h3>
        <p class="text-sm text-slate-600 dark:text-slate-300 mb-6">
            Are you sure you want to delete the role <span id="deleteRoleTitle"
                class="font-semibold text-red-600"></span>?
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelDeleteBtn"
                    class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
</div>
