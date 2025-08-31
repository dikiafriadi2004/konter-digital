@extends('cms.layouts.app')

@section('title', 'Trashed Users')

@section('content')
<main class="flex-grow p-4 sm:p-6 lg:p-8">
    <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Users
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List User</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">Trash Users</span>
                    </div>
                </li>
            </ol>
        </nav>

    <h1 class="text-2xl font-bold mb-6">Trashed Users</h1>

    <div class="overflow-x-auto bg-white dark:bg-slate-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
            <thead class="bg-slate-50 dark:bg-slate-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-900 dark:text-slate-200">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 text-sm text-right flex justify-end gap-2">
                            <!-- Restore -->
                            <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                    Restore
                                </button>
                            </form>

                            <!-- Force Delete -->
                            <button data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                class="open-force-delete px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Delete Permanently
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-slate-500">
                            No trashed users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</main>

@include('cms.users.modal-delete-trash')

<script>
    document.querySelectorAll('.open-force-delete').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('force-delete-title').innerText = button.dataset.name;
            document.getElementById('force-delete-form').action =
                `/cms/users/${button.dataset.id}/force-delete`;
            document.getElementById('force-delete-modal').classList.remove('hidden');
        });
    });

    document.getElementById('cancel-force-delete').addEventListener('click', () => {
        document.getElementById('force-delete-modal').classList.add('hidden');
    });
</script>
@endsection
