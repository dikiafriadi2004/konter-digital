@extends('cms.layouts.app')

@section('title', 'Menus')

@push('css')
    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.3s ease-out;
        }
    </style>
@endpush

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        {{-- Breadcrumb --}}
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cms.dashboard.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Menu Builder
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">
                            Menu Builder
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Menu Builder</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Kolom Kiri: Tambah Item Menu Baru -->
            <div class="lg:col-span-4 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md h-fit">
                <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Add New Menu Item</h3>
                <form action="{{ route('menus.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="label" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                            Menu Labels
                        </label>
                        <input type="text" id="label" name="title"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                            placeholder="Contoh: Beranda, Tentang Kami" required>
                    </div>
                    <div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                            URL / Page
                        </label>
                        <input type="text" id="url" name="url"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:outline-none focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white p-3"
                            placeholder="Contoh: /about-us atau https://example.com" required>
                    </div>
                    <button type="submit"
                        class="w-full px-5 py-2.5 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Menu Item
                    </button>
                </form>
            </div>

            <!-- Kolom Kanan: Struktur Menu -->
            <div class="lg:col-span-8 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-6">Menu Structure</h3>
                <div id="menu-list" class="space-y-2">
                    @forelse($menus as $menu)
                        <div class="menu-item flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700 rounded-lg cursor-move"
                            data-id="{{ $menu->id }}">
                            <div>
                                <p class="font-semibold text-slate-800 dark:text-white">{{ $menu->title }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-300">{{ $menu->url }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <!-- Tombol Edit -->
                                <button type="button"
                                    onclick="openEditModal({{ $menu->id }}, '{{ $menu->title }}', '{{ $menu->url }}')"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-700 dark:bg-blue-900/40 dark:text-blue-400 dark:hover:bg-blue-900/60">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                                    </svg>
                                    Edit
                                </button>

                                <!-- Tombol Delete -->
                                <button type="button"
                                    onclick="openDeleteMenuModal({{ $menu->id }}, '{{ $menu->title }}')"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-600 hover:bg-red-200 hover:text-red-700 dark:bg-red-900/40 dark:text-red-400 dark:hover:bg-red-900/60">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14" />
                                    </svg>
                                    Delete
                                </button>
                            </div>

                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-300">Belum ada menu</p>
                    @endforelse
                </div>
            </div>
            @include('cms.menus.modal-delete')
            @include('cms.menus.modal-edit')
        </div>
    </main>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        function openEditModal(id, title, url) {
            document.getElementById('edit_menu_id').value = id;
            document.getElementById('edit_menu_title').value = title;
            document.getElementById('edit_menu_url').value = url;

            let form = document.getElementById('editMenuForm');
            form.action = "/cms/menus/" + id; // sesuaikan route update

            document.getElementById('editMenuModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editMenuModal').classList.add('hidden');
        }

        // AJAX submit edit
        document.getElementById("editMenuForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let id = document.getElementById("edit_menu_id").value;
            let formData = new FormData(this);
            formData.append('_method', 'PUT'); // untuk Laravel

            fetch("/cms/menus/" + id, {
                    method: "POST", // tetap POST karena spoof method
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(async res => {
                    if (!res.ok) {
                        let text = await res.text();
                        throw new Error(text); // biar kelihatan error asli
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.status === "success") {
                        showToast("Menu updated successfully ✅");
                        closeEditModal();
                        setTimeout(() => window.location.reload(), 800);
                    } else {
                        showToast(data.message || "Failed to update menu ❌", "error");
                    }
                })
                .catch(err => {
                    console.error("Update error:", err);
                    showToast("A server error occurred ❌", "error");
                });
        });
    </script>

    <script>
        function openDeleteMenuModal(id, name) {
            document.getElementById("deleteMenuModal").classList.remove("hidden");
            document.getElementById("deleteMenuName").textContent = name;
            document.getElementById("deleteMenuForm").action = "/cms/menus/" + id;
        }

        function closeDeleteMenuModal() {
            document.getElementById("deleteMenuModal").classList.add("hidden");
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let el = document.getElementById("menu-list");
            new Sortable(el, {
                animation: 150,
                onEnd: function() {
                    let order = [];
                    document.querySelectorAll("#menu-list .menu-item").forEach((el, index) => {
                        order.push({
                            id: el.dataset.id,
                            position: index + 1
                        });
                    });

                    fetch("{{ route('menus.updateOrder') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                order: order
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === "success") {
                                showToast("Menu order updated successfully ✅");
                            } else {
                                showToast("Failed to update sequence ❌", "error");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            showToast("A server error occurred ❌", "error");
                        });
                }
            });
        });

        // 🔔 Fungsi notifikasi (posisi TOP-RIGHT)
        function showToast(message, type = "success") {
            let bg = type === "success" ? "bg-green-600" : "bg-red-600";

            let toast = document.createElement("div");
            toast.className =
                `fixed top-5 right-5 px-4 py-2 text-white text-sm rounded-lg shadow-lg ${bg} animate-fade-in-down z-50`;
            toast.innerText = message;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add("opacity-0");
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    </script>
@endpush
