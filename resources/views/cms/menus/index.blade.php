@extends('cms.layouts.app')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('menus.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Menu Builder
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List
                            Menu</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Menu Management</h2>
        </div>

        {{-- GRID 2 CARD: kiri kecil (form), kanan lebar (list) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- LEFT: FORM (card kecil) --}}
            <div class="lg:col-span-1">
                <div class="bg-white shadow-md rounded-xl p-6">
                    <h2 class="text-lg font-semibold mb-4">Add Menu</h2>

                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf
                        <!-- Judul Menu -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Menu Title</label>
                            <input type="text" name="title" id="title" class="w-full mt-1 p-2 border rounded-md"
                                required>
                        </div>

                        <!-- Tipe Menu -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Menu Type</label>
                            <select name="type" id="type" class="w-full mt-1 p-2 border rounded-md" required>
                                <option value="custom">Custom URL</option>
                                <option value="home">Home</option>
                                <option value="blog">Blog</option>
                                <option value="contact">Contact</option>
                                <option value="privacy">Privacy Policy</option>
                                <option value="about">About Us</option>
                            </select>
                        </div>

                        <!-- URL (hanya kalau custom) -->
                        <div id="urlField" class="mb-4 hidden">
                            <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                            <input type="text" name="url" id="url" placeholder="/custom-url"
                                class="w-full mt-1 p-2 border rounded-md">
                        </div>

                        <!-- Parent (opsional submenu) -->
                        <div class="mb-4">
                            <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Menu</label>
                            <select name="parent_id" id="parent_id" class="w-full mt-1 p-2 border rounded-md">
                                <option value="">-- There isn't any --</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RIGHT: LIST (card lebar) --}}
            <div class="lg:col-span-2">
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold">Menu Builder</h2>
                        <p class="text-sm text-slate-500">Drag & drop untuk mengatur urutan / parent</p>
                    </div>

                    {{-- Penting: gunakan id="menu-list" --}}
                    <ul id="menu-list" class="space-y-2">
                        @include('cms.menus.partials.menu-list', ['menus' => $menus])
                    </ul>
                </div>
            </div>
        </div>

        @include('cms.menus.modal-delete')
    </main>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        // Toggle URL field jika type=custom
        (function initTypeToggle() {
            const typeEl = document.getElementById('type');
            const urlField = document.getElementById('urlField');

            function sync() {
                urlField.classList.toggle('hidden', typeEl.value !== 'custom');
            }
            typeEl.addEventListener('change', sync);
            sync();
        })();

        // Ambil struktur nested (hanya id + children, sesuai controller kamu)
        function getMenuStructure(container) {
            const items = [];
            container.querySelectorAll(':scope > li.menu-item').forEach((li) => {
                const childUl = li.querySelector(':scope > ul.children');
                items.push({
                    id: li.getAttribute('data-id'),
                    children: childUl ? getMenuStructure(childUl) : []
                });
            });
            return items;
        }

        // Flash modal (tetap seperti semula)
        function showFlashModal(message, type = 'success') {
            const modal = document.createElement('div');
            modal.id = 'flashModal';
            modal.className = 'fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50';
            modal.innerHTML = `
        <div class="bg-white rounded-2xl shadow-xl p-6 w-96 text-center border-2 ${type === 'success' ? 'border-green-600' : 'border-red-600'}">
            <h2 class="text-xl font-semibold mb-4 ${type === 'success' ? 'text-green-600' : 'text-red-600'}">
                ${type === 'success' ? 'Success!' : 'Error!'}
            </h2>
            <p class="text-gray-700">${message}</p>
            <div class="mt-6 flex justify-center">
                <button id="closeFlashModal" class="px-4 py-2 rounded-lg text-white ${type === 'success' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'}">OK</button>
            </div>
        </div>`;
            document.body.appendChild(modal);
            modal.querySelector('#closeFlashModal').addEventListener('click', () => modal.remove());
            setTimeout(() => modal.remove(), 4000);
        }

        // Simpan urutan (PAYLOAD: { menus: [...] } sesuai MenuController@reorder kamu)
        function saveMenuOrder() {
            const root = document.getElementById('menu-list');
            const menus = getMenuStructure(root);

            fetch("{{ route('menus.reorder') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        menus
                    })
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success) showFlashModal('Menu sorted successfully!', 'success');
                    else showFlashModal(d.message || 'Failed to save sequence.', 'error');
                })
                .catch(() => showFlashModal('Error server.', 'error'));
        }

        // Inisialisasi SortableJS (root + semua children)
        document.addEventListener("DOMContentLoaded", function() {
            const root = document.getElementById("menu-list");
            if (!root) return;

            // Root
            new Sortable(root, {
                group: "nested",
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                onEnd: saveMenuOrder
            });

            // Semua nested children (sudah ada sejak render)
            document.querySelectorAll("ul.children").forEach(function(ul) {
                new Sortable(ul, {
                    group: "nested",
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    onEnd: saveMenuOrder
                });
            });
        });

        // Modal Delete
        function openDeleteModal(menuId) {
            const form = document.getElementById('deleteForm');
            form.action = "/menus/" + menuId; // sesuaikan dengan route resource menus.destroy
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Buka modal dan set action form ke URL delete yang sudah dibangkitkan blade
        function openDeleteModal(deleteUrl) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');

            if (!modal || !form) return console.error('Delete modal/form tidak ditemukan.');

            form.action = deleteUrl;
            modal.classList.remove('hidden');

            // optional: fokus tombol "Batal" supaya keyboard-friendly
            modal.querySelector('button[type="button"]').focus();
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            if (!modal) return;
            modal.classList.add('hidden');
            // kosongkan action agar tidak keliru kalau ingin reuse
            const form = document.getElementById('deleteForm');
            if (form) form.removeAttribute('action');
        }

        // tutup modal kalau klik backdrop
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('deleteModal');
            if (!modal || modal.classList.contains('hidden')) return;
            if (e.target === modal) closeDeleteModal();
        });

        // tutup modal pakai ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
    </script>
@endpush
