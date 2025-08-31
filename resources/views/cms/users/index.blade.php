@extends('cms.layouts.app')

@section('title', 'Users Management')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Users
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List users</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header + Tombol Tambah -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Users Management</h2>
            <div class="flex flex-wrap gap-3">
                <!-- Tombol Trash -->
                <a href="{{ route('users.trash') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-rose-600 text-white rounded-lg shadow-md hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 7.5h12M9.75 7.5V6a1.5 1.5 0 011.5-1.5h1.5A1.5 1.5 0 0114.25 6v1.5m-6 0h7.5M9.75 10.5v6m4.5-6v6M4.5 7.5h15l-.75 12a2.25 2.25 0 01-2.25 2.25H7.5A2.25 2.25 0 015.25 19.5L4.5 7.5z" />
                    </svg>
                    Trash
                </a>

                <!-- Tombol Tambah -->
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-lg shadow-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add New User
                </a>
            </div>

        </div>

        <!-- Tabel Users -->
        <div class="bg-white dark:bg-slate-800 p-4 sm:p-6 rounded-xl shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
                        <tr>
                            <th scope="col" class="p-4">No</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse ($users as $key => $user)
                            <tr
                                class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                                <td class="w-4 p-4">
                                    {{ $users->firstItem() + $key }}
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                </td>
                                <td class="px-6 py-4 flex items-center space-x-3 justify-center">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.688-1.688a1.875 1.875 0 112.652 2.652l-9.193 9.193a4.5 4.5 0 01-1.897 1.13L6.75 16.5l.726-3.862a4.5 4.5 0 011.13-1.897l8.256-8.254zM19.5 7.125L16.875 4.5M4.5 19.5h15" />
                                        </svg>
                                    </a>

                                    <!-- Tombol Hapus (sembunyikan jika user login sendiri) -->
                                    @if (auth()->id() !== $user->id)
                                        <button type="button"
                                            class="text-red-600 hover:text-red-800 dark:text-red-400 flex items-center deleteBtn"
                                            data-id="{{ $user->id }}" data-title="{{ $user->name }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 7.5h12M9.75 7.5V6a1.5 1.5 0 011.5-1.5h1.5A1.5 1.5 0 0114.25 6v1.5m-6 0h7.5M9.75 10.5v6m4.5-6v6M4.5 7.5h15l-.75 12a2.25 2.25 0 01-2.25 2.25H7.5A2.25 2.25 0 015.25 19.5L4.5 7.5z" />
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-slate-500 dark:text-slate-400">
                                    Belum ada user dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- Modal Delete -->
        @include('cms.users.modal-delete')
    </main>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const deleteForm = document.getElementById('deleteForm');
            const deleteUserTitle = document.getElementById('deleteUserTitle');

            deleteButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const userId = btn.getAttribute('data-id');
                    const userTitle = btn.getAttribute('data-title');

                    deleteForm.action = `/cms/users/${userId}`;
                    deleteUserTitle.textContent = userTitle;
                    deleteModal.classList.remove('hidden');
                });
            });

            cancelDeleteBtn.addEventListener('click', () => {
                deleteModal.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });
        });
    </script>
@endpush
