@extends('cms.layouts.app')

@section('title', 'Edit Post')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.posts.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Posts
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List Posts</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Edit Post</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Postingan</h2>
        </div>

        <form action="{{ route('cms.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Post Details -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Post Details</h3>

                    <div class="mb-4">
                        <label for="post-title"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Title</label>
                        <input type="text" id="post-title" name="title" value="{{ old('title', $post->title) }}"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 @error('title') border-red-500 @enderror"
                            placeholder="Masukkan judul postingan..." required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="post-slug"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Slug</label>
                        <input type="text" id="post-slug" name="slug" value="{{ old('slug', $post->slug) }}"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 @error('slug') border-red-500 @enderror"
                            placeholder="Slug otomatis dibuat dari judul..." readonly>
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="post-description"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                            Meta Description Singkat <span class="text-xs text-slate-500">(50–160 karakter)</span>
                        </label>

                        <textarea id="post-description" name="meta_description" rows="3" maxlength="160" oninput="updateSeoDescCounter()"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 @error('meta_description') border-red-500 @enderror"
                            placeholder="Masukkan deskripsi singkat atau ringkasan postingan...">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>

                        <p id="seo-desc-counter" class="text-xs mt-1 text-slate-500">0 / 160 karakter</p>

                        @error('meta_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="post-content"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Body</label>
                        <textarea id="post-content" name="body" rows="15"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 @error('body') border-red-500 @enderror"
                            placeholder="Tulis konten postingan Anda di sini..." required>{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="meta-keywords"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meta Keyword</label>
                        <textarea id="meta-keywords" name="meta_keywords" rows="2"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 @error('meta_keywords') border-red-500 @enderror"
                            placeholder="Pisahkan dengan koma, cth: teknologi, web, css">{{ old('meta_keywords', $post->meta_keywords) }}</textarea>
                        @error('meta_keywords')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Post Settings -->
                <div class="lg:col-span-1 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Post Settings</h3>

                    <div class="mb-4">
                        <label for="post-status"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                        <select id="post-status" name="status"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 @error('status') border-red-500 @enderror"
                            required>
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                                Published</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="post-category"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Category</label>
                        <select id="post-category" name="category_id"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 @error('category_id') border-red-500 @enderror"
                            required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-4">
                        <label for="post-thumbnail"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Thumbnail</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-md dark:border-slate-600">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12-4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-slate-600 dark:text-slate-400">
                                    <label for="file-upload"
                                        class="relative cursor-pointer bg-white dark:bg-slate-800 rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                        <span>Upload file</span>
                                        <input id="file-upload" name="thumbnail" type="file" class="sr-only"
                                            accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">PNG, JPG, GIF hingga 2MB</p>
                                <img id="thumbnail-preview"
                                    src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '#' }}"
                                    alt="Pratinjau Thumbnail"
                                    class="{{ $post->thumbnail ? '' : 'hidden' }} mt-4 mx-auto max-h-48 rounded-md shadow-md object-cover">
                                @error('thumbnail')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('cms.posts.index') }}"
                    class="px-5 py-2.5 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg font-semibold hover:bg-slate-300 dark:hover:bg-slate-600">Batal</a>
                <button type="submit"
                    class="px-5 py-2.5 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700">Simpan
                    Perubahan</button>
            </div>
        </form>
    </main>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#post-content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount fullscreen preview code insertdatetime advlist autosave save directionality help nonbreaking pagebreak quickbars searchreplace table visualchars template toc wordcount image link media',
            toolbar: `
            undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor |
            alignleft aligncenter alignright alignjustify | outdent indent lineheight |
            numlist bullist | link image media table | removeformat | preview code fullscreen
        `,
            menubar: false,
            height: 500,

            // ✅ FIX masalah URL hilang
            document_base_url: "{{ url('/') }}/",
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,

            // ✅ Tambahan konfigurasi image
            image_dimensions: true,
            image_caption: true,
            image_title: true,

            // ✅ Font dan ukuran default
            font_family_formats: "Arial=arial,helvetica,sans-serif;" +
                "Courier New=courier new,courier,monospace;" +
                "Georgia=georgia,palatino;" +
                "Tahoma=tahoma,arial,helvetica,sans-serif;" +
                "Times New Roman=times new roman,times;" +
                "Verdana=verdana,geneva;" +
                "Roboto=roboto,system-ui,sans-serif;" +
                "Open Sans=open sans,sans-serif;" +
                "Poppins=poppins,sans-serif;" +
                "Lato=lato,sans-serif;" +
                "Montserrat=montserrat,sans-serif",
            fontsize_formats: "10px 12px 14px 16px 18px 24px 36px 48px",

            forced_root_block: 'p',
            valid_elements: '*[*]',

            content_style: `
            body { font-family: system-ui, sans-serif; line-height: 1.6; }
            h1,h2,h3,h4,h5,h6 { font-weight: 700; margin: 1.2em 0 0.5em; }
            p { margin: 0 0 1em; }
            ul,ol { margin: 0 0 1em 1.5em; }
            img { max-width: 100%; height: auto; }
        `,

            // ✅ Integrasi dengan filemanager
            file_picker_types: 'file image media',
            file_picker_callback: function(callback, value, meta) {
                let w = 900;
                let h = 600;
                let x = (window.innerWidth / 2) - (w / 2);
                let y = (window.innerHeight / 2) - (h / 2);

                let fm = window.open(
                    '{{ route('cms.filemanager.popup') }}',
                    'FileManager',
                    `width=${w},height=${h},left=${x},top=${y},resizable=yes,scrollbars=yes,status=no`
                );

                window.SetUrl = function(url) {
                    callback(url);
                    fm.close();
                };
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileUpload = document.getElementById('file-upload');
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            const postTitle = document.getElementById('post-title');
            const postSlug = document.getElementById('post-slug');

            if (fileUpload && thumbnailPreview) {
                fileUpload.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            thumbnailPreview.src = e.target.result;
                            thumbnailPreview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        thumbnailPreview.src =
                            '{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '#' }}';
                        if (!thumbnailPreview.src) thumbnailPreview.classList.add('hidden');
                    }
                });
            }

            if (postTitle && postSlug) {
                postTitle.addEventListener('input', () => {
                    const title = postTitle.value;
                    const slug = title.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g,
                        '-').replace(/^-+|-+$/g, '');
                    postSlug.value = slug;
                });
            }
        });

        function updateSeoDescCounter() {
            const textarea = document.getElementById('post-description');
            const counter = document.getElementById('seo-desc-counter');
            const length = textarea.value.length;

            counter.textContent = length + " / 160 karakter";

            // Status warna sesuai SEO best practice
            if (length < 50) {
                counter.classList.add("text-yellow-500");
                counter.classList.remove("text-slate-500", "text-green-500", "text-red-500");
            } else if (length <= 160) {
                counter.classList.add("text-green-500");
                counter.classList.remove("text-slate-500", "text-yellow-500", "text-red-500");
            } else {
                counter.classList.add("text-red-500");
                counter.classList.remove("text-slate-500", "text-green-500", "text-yellow-500");
            }
        }

        // Jalankan saat halaman diload
        document.addEventListener("DOMContentLoaded", updateSeoDescCounter);
    </script>
@endpush
