@extends('cms.layouts.app')

@section('title', 'File Manager')

@section('content')
    <main class="flex-grow p-6 bg-slate-50 dark:bg-slate-900">
        <h1 class="text-2xl font-bold mb-6 text-slate-800 dark:text-slate-100">📁 File Manager</h1>

        <!-- Upload Area -->
        <div id="dropzone"
            class="border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-lg p-10 text-center bg-white dark:bg-slate-800 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition">
            <p class="text-slate-600 dark:text-slate-300">Drag & Drop file di sini atau klik untuk upload</p>
            <input type="file" id="fileInput" multiple class="hidden" />
        </div>

        <!-- Progress -->
        <div id="progressWrapper" class="hidden mt-4">
            <div class="w-full bg-slate-200 rounded-full h-4 dark:bg-slate-700">
                <div id="progressBar" class="bg-blue-600 h-4 rounded-full" style="width: 0%"></div>
            </div>
            <p id="progressText" class="text-sm text-slate-600 dark:text-slate-300 mt-1">0%</p>
        </div>

        <!-- Files Grid -->
        <div id="fileGrid" class="mt-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach ($files as $file)
                <div class="file-item group relative bg-white dark:bg-slate-800 rounded-lg shadow hover:shadow-lg overflow-hidden"
                    data-id="{{ $file['id'] }}">
                    <img src="{{ $file['url'] }}"
                        class="previewImg w-full h-32 object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                        data-url="{{ $file['url'] }}">
                    <div
                        class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <button data-url="{{ $file['url'] }}"
                            class="copyUrl px-3 py-1.5 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">
                            Copy URL
                        </button>
                        <button data-id="{{ $file['id'] }}"
                            class="deleteFile ml-2 px-3 py-1.5 text-xs bg-red-500 text-white rounded hover:bg-red-600">
                            Delete
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-lg p-6 max-w-3xl w-full relative">
            <button id="closePreview"
                class="absolute top-3 right-3 text-slate-500 hover:text-red-600 text-2xl">&times;</button>
            <img id="previewImage" src="" class="w-full max-h-[70vh] object-contain mb-4 rounded-lg">
            <div class="flex justify-end">
                <button id="copyUrlBtn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Copy URL</button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-lg p-6 max-w-md w-full relative">
            <h2 class="text-lg font-semibold mb-4 text-slate-800 dark:text-slate-100">Hapus File</h2>
            <p class="text-slate-600 dark:text-slate-300 mb-6">Apakah Anda yakin ingin menghapus file ini?</p>
            <div class="flex justify-end gap-2">
                <button id="cancelDelete"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-4 right-4 bg-gray-800 text-white px-4 py-2 rounded shadow hidden z-50"></div>
@endsection

@push('js')
    <script>
        const dropzone = document.getElementById("dropzone");
        const fileInput = document.getElementById("fileInput");
        const progressWrapper = document.getElementById("progressWrapper");
        const progressBar = document.getElementById("progressBar");
        const progressText = document.getElementById("progressText");
        const fileGrid = document.getElementById("fileGrid");

        const previewModal = document.getElementById("previewModal");
        const previewImage = document.getElementById("previewImage");
        const closePreview = document.getElementById("closePreview");
        const copyUrlBtn = document.getElementById("copyUrlBtn");
        let currentPreviewUrl = "";

        const deleteModal = document.getElementById("deleteModal");
        const cancelDelete = document.getElementById("cancelDelete");
        const confirmDelete = document.getElementById("confirmDelete");
        let deleteFileId = null;

        const toast = document.getElementById("toast");

        function showToast(message, type = 'success') {
            toast.textContent = message;
            toast.className = "fixed bottom-4 right-4 px-4 py-2 rounded shadow z-50";
            toast.classList.add(type === 'success' ? 'bg-green-600' : 'bg-red-600');
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // Drag & Drop
        dropzone.addEventListener("click", () => fileInput.click());
        dropzone.addEventListener("dragover", e => {
            e.preventDefault();
            dropzone.classList.add("bg-slate-100", "dark:bg-slate-700");
        });
        dropzone.addEventListener("dragleave", e => {
            e.preventDefault();
            dropzone.classList.remove("bg-slate-100", "dark:bg-slate-700");
        });
        dropzone.addEventListener("drop", e => {
            e.preventDefault();
            dropzone.classList.remove("bg-slate-100", "dark:bg-slate-700");
            handleUpload(e.dataTransfer.files);
        });
        fileInput.addEventListener("change", e => handleUpload(e.target.files));

        function handleUpload(files) {
            if (!files.length) return;
            let formData = new FormData();
            for (let file of files) formData.append("files[]", file);
            progressWrapper.classList.remove("hidden");

            fetch("{{ route('cms.filemanager.upload') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    progressWrapper.classList.add("hidden");
                    if (res.success) {
                        res.files.forEach(addFileToGrid);
                        showToast('Upload berhasil');
                    } else showToast(res.message || 'Upload gagal', 'error');
                })
                .catch(() => {
                    progressWrapper.classList.add("hidden");
                    showToast('Upload gagal', 'error');
                });
        }

        function addFileToGrid(file) {
            let item = document.createElement("div");
            item.className =
                "file-item group relative bg-white dark:bg-slate-800 rounded-lg shadow hover:shadow-lg overflow-hidden";
            item.dataset.id = file.id;
            item.innerHTML = `
        <img src="${file.url}" data-url="${file.url}" class="previewImg w-full h-32 object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer">
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
            <button data-url="${file.url}" class="copyUrl px-3 py-1.5 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">Copy URL</button>
            <button data-id="${file.id}" class="deleteFile ml-2 px-3 py-1.5 text-xs bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
        </div>`;
            fileGrid.prepend(item);
        }

        // Event Delegation
        document.addEventListener("click", e => {
            const copyBtn = e.target.closest(".copyUrl");
            const deleteBtn = e.target.closest(".deleteFile");
            const previewImg = e.target.closest(".previewImg");

            if (previewImg) {
                currentPreviewUrl = previewImg.dataset.url;
                previewImage.src = currentPreviewUrl;
                previewModal.classList.remove("hidden");
                previewModal.classList.add("flex");
            }
            if (copyBtn) copyToClipboard(copyBtn.dataset.url);
            if (deleteBtn) {
                deleteFileId = deleteBtn.dataset.id;
                deleteModal.classList.remove("hidden");
                deleteModal.classList.add("flex");
            }
        });

        copyUrlBtn.addEventListener("click", () => copyToClipboard(currentPreviewUrl));
        closePreview.addEventListener("click", () => {
            previewModal.classList.add("hidden");
            previewModal.classList.remove("flex");
        });
        cancelDelete.addEventListener("click", () => {
            deleteModal.classList.add("hidden");
            deleteModal.classList.remove("flex");
            deleteFileId = null;
        });
        confirmDelete.addEventListener("click", () => {
            if (!deleteFileId) return;
            fetch("{{ route('cms.filemanager.delete') }}", {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: deleteFileId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`.file-item[data-id="${deleteFileId}"]`)?.remove();
                        showToast('File dihapus');
                    } else showToast('Gagal menghapus file', 'error');
                })
                .finally(() => {
                    deleteModal.classList.add("hidden");
                    deleteModal.classList.remove("flex");
                    deleteFileId = null;
                });
        });

        function copyToClipboard(text) {
            navigator.clipboard?.writeText(text).then(() => showToast('URL copied')).catch(() => {
                let ta = document.createElement("textarea");
                ta.value = text;
                document.body.appendChild(ta);
                ta.select();
                try {
                    document.execCommand('copy');
                    showToast('URL copied');
                } catch {}
                document.body.removeChild(ta);
            });
        }
    </script>
@endpush
