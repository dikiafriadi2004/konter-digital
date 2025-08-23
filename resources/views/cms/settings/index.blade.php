@extends('cms.layouts.app')

@section('title', 'Settings')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.dashboard.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Settings
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Site Settings</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Site Settings</h2>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md h-fit w-full">
            <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Manage Site Settings</h3>
            <form action="{{ route('cms.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div>
                        <div class="mb-4">
                            <label for="site-name" class="block text-sm font-medium mb-1">Site Name</label>
                            <input type="text" id="site-name" name="site_name"
                                value="{{ old('site_name', $setting->site_name) }}"
                                class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                                required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Logo</label>
                            <input type="file" name="logo" id="logo" class="w-full border p-2 rounded-md">

                            <div class="mt-2">
                                <img id="logo-preview"
                                    src="{{ $setting->logo ? asset('storage/' . $setting->logo) : 'https://via.placeholder.com/150x80?text=Logo' }}"
                                    class="h-16 rounded shadow">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Favicon</label>
                            <input type="file" name="favicon" id="favicon" class="w-full border p-2 rounded-md">

                            <div class="mt-2">
                                <img id="favicon-preview"
                                    src="{{ $setting->favicon ? asset('storage/' . $setting->favicon) : 'https://via.placeholder.com/64x64?text=Favicon' }}"
                                    class="h-12 w-12 rounded shadow">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="office-address" class="block text-sm font-medium mb-1">Office address</label>
                            <textarea id="office-address" name="office_address" rows="2"
                                class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">{{ old('office_address', $setting->office_address) }}</textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Facebook</label>
                            <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}"
                                class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Instagram</label>
                            <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}"
                                class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Telegram</label>
                            <input type="url" name="telegram" value="{{ old('telegram', $setting->telegram) }}"
                                class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Telegram Channel</label>
                            <input type="url" name="telegram_channel"
                                value="{{ old('telegram_channel', $setting->telegram_channel) }}"
                                class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}"
                                class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">
                        </div>
                    </div>
                </div>

                <hr class="my-8 border-slate-200 dark:border-slate-700">

                <h4 class="text-xl font-semibold mb-6">Pengaturan SEO</h4>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $setting->meta_title) }}"
                        class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="3"
                        class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">{{ old('meta_description', $setting->meta_description) }}</textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords"
                        value="{{ old('meta_keywords', $setting->meta_keywords) }}"
                        class="w-full rounded-md border-slate-300 shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('cms.settings.edit') }}"
                        class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">Save</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('js')
    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('logo').addEventListener('change', function() {
            previewImage(this, 'logo-preview');
        });

        document.getElementById('favicon').addEventListener('change', function() {
            previewImage(this, 'favicon-preview');
        });
    </script>
@endpush
