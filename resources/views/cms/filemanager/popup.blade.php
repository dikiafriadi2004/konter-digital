<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>File Manager Popup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 dark:bg-slate-900 p-4">
    <h1 class="text-xl font-bold mb-4 text-slate-800 dark:text-slate-100">📁 Pilih Gambar</h1>

    <!-- Upload Area -->
    <div id="dropzone"
        class="border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-lg p-6 text-center bg-white dark:bg-slate-800 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition">
        <p class="text-slate-600 dark:text-slate-300">Drag & Drop file di sini atau klik untuk upload</p>
        <input type="file" id="fileInput" multiple class="hidden" />
    </div>

    <!-- Progress -->
    <div id="progressWrapper" class="hidden mt-4">
        <div class="w-full bg-slate-200 rounded-full h-3 dark:bg-slate-700">
            <div id="progressBar" class="bg-blue-600 h-3 rounded-full" style="width: 0%"></div>
        </div>
        <p id="progressText" class="text-xs text-slate-600 dark:text-slate-300 mt-1">0%</p>
    </div>

    <!-- Files Grid -->
    <div id="fileGrid" class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach ($files as $file)
            <div class="file-item bg-white dark:bg-slate-800 rounded shadow hover:shadow-lg overflow-hidden cursor-pointer"
                data-url="{{ $file['url'] }}">
                <img src="{{ $file['url'] }}" class="w-full h-28 object-cover">
            </div>
        @endforeach
    </div>

    <script>
        const dropzone = document.getElementById("dropzone");
        const fileInput = document.getElementById("fileInput");
        const progressWrapper = document.getElementById("progressWrapper");
        const progressBar = document.getElementById("progressBar");
        const progressText = document.getElementById("progressText");
        const fileGrid = document.getElementById("fileGrid");

        dropzone.addEventListener("click", () => fileInput.click());
        dropzone.addEventListener("dragover", e => {
            e.preventDefault();
            dropzone.classList.add("bg-slate-100");
        });
        dropzone.addEventListener("dragleave", e => {
            e.preventDefault();
            dropzone.classList.remove("bg-slate-100");
        });
        dropzone.addEventListener("drop", e => {
            e.preventDefault();
            dropzone.classList.remove("bg-slate-100");
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
                    if (res.success) res.files.forEach(addFileToGrid);
                    else alert(res.message || 'Upload gagal');
                })
                .catch(() => alert('Upload gagal'));
        }

        function addFileToGrid(file) {
            let div = document.createElement("div");
            div.className =
                "file-item bg-white dark:bg-slate-800 rounded shadow hover:shadow-lg overflow-hidden cursor-pointer";
            div.dataset.url = file.url;
            div.innerHTML = `<img src="${file.url}" class="w-full h-28 object-cover">`;
            div.addEventListener("click", () => selectFile(file.url));
            fileGrid.prepend(div);
        }

        document.querySelectorAll(".file-item").forEach(el => {
            el.addEventListener("click", () => selectFile(el.dataset.url));
        });

        function selectFile(url) {
            if (window.opener && typeof window.opener.SetUrl === 'function') {
                window.opener.SetUrl(url);
                window.close();
            }
        }
    </script>
</body>

</html>
