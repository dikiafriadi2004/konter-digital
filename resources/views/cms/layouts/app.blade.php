<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Diperbaiki</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('back/assets/css/app.css') }}">
    @stack('css')

</head>

<body class="bg-slate-100 dark:bg-slate-900 text-slate-800 dark:text-slate-200">

    @if (session('success') || session('error') || $errors->any())
        <div id="flashModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div
                class="bg-white rounded-2xl shadow-xl p-6 w-96 text-center animate-fade-in 
            {{ session('success') ? 'border-green-600' : 'border-red-600' }} border-2">

                {{-- Judul modal --}}
                <h2
                    class="text-xl font-semibold mb-4
                {{ session('success') ? 'text-green-600' : 'text-red-600' }}">
                    {{ session('success') ? 'Success!' : 'There is an error!' }}
                </h2>

                {{-- Pesan untuk success / error --}}
                @if (session('success'))
                    <p class="text-gray-700">{{ session('success') }}</p>
                @elseif (session('error'))
                    <p class="text-gray-700">{{ session('error') }}</p>
                @elseif ($errors->any())
                    <ul class="text-gray-700 list-disc list-inside text-left">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {{-- Tombol OK --}}
                <div class="mt-6 flex justify-center space-x-4">
                    <button id="closeFlashModal"
                        class="px-4 py-2 rounded-lg text-white 
                    {{ session('success') ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif




    <div class="flex min-h-screen">
        @include('cms.layouts.sidebar')

        <div class="flex-1 flex flex-col lg:ml-64 transition-all duration-300 ease-in-out">
            @include('cms.layouts.navbar')

            @yield('content')

            @include('cms.layouts.footer')
        </div>
    </div>

    <!-- Backdrop sidebar untuk menutup sidebar saat diklik di luar -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/30 z-20 lg:hidden hidden"></div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="delete-modal" class="fixed inset-0 z-40 flex items-center justify-center bg-black/50 hidden"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl p-6 w-full max-w-md m-4">
            <div class="flex items-start">
                <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/50 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white" id="modal-title">Hapus
                        Postingan</h3>
                    <div class="mt-2">
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Anda yakin ingin menghapus postingan ini? Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button"
                    class="close-delete-modal w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button type="button"
                    class="close-delete-modal mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-700 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('back/assets/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
