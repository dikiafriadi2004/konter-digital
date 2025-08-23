<!-- Delete Modal -->
<div id="deleteMenuModal"
    class="fixed inset-0 z-50 hidden flex items-center justify-center 
            bg-black/50 backdrop-blur-sm">
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md 
                p-6 animate-fade-in-down mx-4">

        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                Confirm Delete
            </h2>
            <button type="button" onclick="closeDeleteMenuModal()"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                ✕
            </button>
        </div>

        <!-- Body -->
        <p class="mb-6 text-gray-600 dark:text-gray-300">
            Are you sure you want to delete the menu
            <span id="deleteMenuName" class="font-semibold text-red-600 dark:text-red-400"></span>?
        </p>

        <!-- Footer -->
        <form id="deleteMenuForm" method="POST" class="flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteMenuModal()"
                class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                Cancel
            </button>
            <button type="submit"
                class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-medium shadow">
                Yes, Delete
            </button>
        </form>
    </div>
</div>
