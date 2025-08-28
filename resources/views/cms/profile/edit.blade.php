@extends('cms.layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        {{-- Breadcrumb --}}
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.profile.edit') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Profile
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Edit Profil</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Profile</h2>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Card --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md h-fit w-full">
            <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Profile Information</h3>

            <form action="{{ route('cms.profile.edit') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Full
                        name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                        placeholder="Masukkan nama lengkap Anda" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="username"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                        required>
                    @error('username')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                        placeholder="Masukkan alamat email Anda" required>
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="mb-6">
                    <label for="role"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Role</label>
                    <input type="text" id="role"
                        value="{{ $user->roles->pluck('name')->implode(', ') ?? 'Tidak ada role' }}"
                        class="block w-full rounded-md border-slate-300 shadow-sm sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3 cursor-not-allowed"
                        readonly>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Roles cannot be changed here.</p>
                </div>

                <hr class="my-8 border-slate-200 dark:border-slate-700">

                {{-- Password --}}
                <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Change Password</h3>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">New
                        Password</label>
                    <input type="password" id="password" name="password"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                        placeholder="Masukkan kata sandi baru">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Confirm New
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                        placeholder="Konfirmasi kata sandi baru">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </main>
@endsection
