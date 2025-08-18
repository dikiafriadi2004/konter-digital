<!-- Modal Delete Post -->
<div id="delete-post-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white dark:bg-slate-800 p-6 rounded-lg w-96">
        <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Confirm Delete Post</h3>
        <p class="text-sm text-slate-600 dark:text-slate-300 mb-6">
            Are you sure you want to delete this post <span id="post-title-name" class="font-semibold"></span>?
        </p>
        <div class="flex justify-end space-x-3">
            <button id="cancel-delete-post"
                class="px-4 py-2 bg-gray-200 dark:bg-slate-700 rounded hover:bg-gray-300 dark:hover:bg-slate-600">Cancel</button>
            <form id="delete-post-form" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Yes, Delete</button>
            </form>
        </div>
    </div>
</div>
