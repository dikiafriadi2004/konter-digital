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

    <script src="{{ asset('back/assets/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
