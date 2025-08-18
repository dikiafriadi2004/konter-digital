<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('back/assets/css/app.css') }}">
</head>

<body
    class="bg-slate-100 dark:bg-slate-900 text-slate-800 dark:text-slate-200 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white dark:bg-slate-800 rounded-xl shadow-lg-custom relative">
        <div class="flex flex-col items-center mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-primary-500" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                    clip-rule="evenodd" />
            </svg>
            <h1 class="text-4xl font-extrabold mt-4 text-slate-800 dark:text-white">Konter Digital</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Masuk untuk mengelola konten Anda</p>
        </div>

        @if ($errors->any())
            <div class="mb-4">
                @foreach ($errors->all() as $error)
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif


        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-5">
                <label for="username"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Username</label>
                <input type="text" id="username" name="login" value="{{ old('login') }}"
                    class="block w-full rounded-md border-slate-300 shadow-sm transition-all duration-200 ease-in-out focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 p-3"
                    placeholder="username" required>
            </div>

            <div class="mb-5">
                <label for="password"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                    class="block w-full rounded-md border-slate-300 shadow-sm transition-all duration-200 ease-in-out focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white placeholder-slate-500 dark:placeholder-400 p-3"
                    placeholder="••••••••" required>
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox"
                        class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500 dark:bg-slate-700 dark:border-slate-600 cursor-pointer">
                    <label for="remember-me"
                        class="ml-2 block text-sm text-slate-700 dark:text-slate-300 cursor-pointer">Ingat saya</label>
                </div>
            </div>

            <button type="submit"
                class="w-full px-5 py-2.5 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transform hover:-translate-y-0.5 transition-all duration-200 ease-in-out active:scale-95">
                Masuk
            </button>
        </form>

        <div class="absolute top-4 right-4">
            <button id="dark-mode-toggle"
                class="p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-800 focus:ring-primary-500">
                <span class="sr-only">Ganti mode gelap</span>
                <svg id="sun-icon" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg id="moon-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div>
    </div>

    <script src="{{ asset('back/assets/js/main.js') }}"></script>
</body>

</html>
