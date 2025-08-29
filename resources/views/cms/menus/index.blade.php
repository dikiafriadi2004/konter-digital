@extends('cms.layouts.app')

@section('content')
    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        {{-- breadcrumb --}}
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('menus.index') }}"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white">
                        <!-- icon -->
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
                        <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2 dark:text-slate-400">List Menu</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Menu Management</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- LEFT: FORM --}}
            <div class="lg:col-span-1">
                <div class="bg-white shadow-md rounded-xl p-6">
                    <h2 class="text-lg font-semibold mb-4">Add Menu</h2>

                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Menu Title</label>
                            <input type="text" name="title" id="title" class="w-full mt-1 p-2 border rounded-md"
                                required>
                        </div>

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

                        <div id="urlField" class="mb-4 hidden">
                            <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                            <input type="text" name="url" id="url" placeholder="/custom-url"
                                class="w-full mt-1 p-2 border rounded-md">
                        </div>

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
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RIGHT: LIST --}}
            <div class="lg:col-span-2">
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold">Menu Builder</h2>
                        <p class="text-sm text-slate-500">Drag & drop untuk mengatur urutan / parent</p>
                    </div>

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
    <!-- Sortable + jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Toggle URL field jika type=custom
        (function() {
            const typeEl = document.getElementById('type');
            const urlField = document.getElementById('urlField');
            if (!typeEl) return;

            function sync() {
                urlField.classList.toggle('hidden', typeEl.value !== 'custom');
            }
            typeEl.addEventListener('change', sync);
            sync();
        })();

        // Ambil struktur nested menu (mengembalikan plain JS array)
        function getMenuStructure(container, parentId = null) {
            const items = [];
            const $container = $(container);
            $container.children("li.menu-item").each(function(index) {
                const $li = $(this);
                const $childUl = $li.children("ul.children");
                const id = $li.data("id");

                items.push({
                    id: id,
                    parent_id: parentId,
                    order: index + 1,
                    children: $childUl.length ? getMenuStructure($childUl, id) : []
                });
            });
            return items;
        }

        // Simpan via AJAX JSON (kirim nested JSON agar controller bisa update parent_id)
        function saveMenuOrder() {
            const menus = getMenuStructure($("#menu-list"));

            // debug: tampilkan struktur di console
            console.log('saving menus structure:', menus);

            $.ajax({
                url: "{{ route('menus.reorder') }}",
                type: "POST",
                data: JSON.stringify({
                    menus: menus
                }),
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        // optional: notifikasi kecil
                        console.info('Menu order saved.');
                    } else {
                        alert(res.message || "Failed to save order.");
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert("Server error: " + (xhr.responseJSON?.message || xhr.statusText));
                }
            });
        }

        // Init Sortable di semua <ul> (root dan children)
        function initSortable(container) {
            // container = DOM Node or jQuery; ensure DOM node passed to Sortable
            const el = container instanceof jQuery ? container[0] : container;

            new Sortable(el, {
                group: "nested",
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                // allow putting into empty children lists
                onEnd: function(evt) {
                    // After a drop, we must ensure every <li> that now has children contains an <ul.children>.
                    // Our partial renders <ul class="children"> for each <li>, so normally not necessary.
                    saveMenuOrder();
                }
            });

            // init nested lists
            $(el).children("li.menu-item").children("ul.children").each(function() {
                initSortable(this);
            });
        }

        $(document).ready(function() {
            initSortable(document.getElementById("menu-list"));
        });

        // Delete Modal (global)
        function openDeleteModal(actionUrl, title) {
            $("#delete-form").attr("action", actionUrl);
            $("#delete-modal-text").html(`Are you sure you want to delete the menu <b>${title}</b>?`);
            $("#delete-modal").removeClass("hidden");
        }

        function closeModal() {
            $("#delete-modal").addClass("hidden");
        }

        // Simpan via AJAX JSON (kirim nested JSON agar controller bisa update parent_id)
        function saveMenuOrder() {
            const menus = getMenuStructure($("#menu-list"));

            $.ajax({
                url: "{{ route('menus.reorder') }}",
                type: "POST",
                data: JSON.stringify({
                    menus: menus
                }),
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        showFlashModal("Menu saved successfully!", "success");
                    } else {
                        showFlashModal(res.message || "Failed to save order.", "error");
                    }
                },
                error: function(xhr) {
                    showFlashModal("Server error: " + (xhr.responseJSON?.message || xhr.statusText), "error");
                }
            });
        }

        // Flash modal helper
        function showFlashModal(message, type = "success") {
            const modal = $(`
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-2xl shadow-xl p-6 w-96 text-center border-2 ${type === 'success' ? 'border-green-600' : 'border-red-600'}">
                <h2 class="text-xl font-semibold mb-4 ${type === 'success' ? 'text-green-600' : 'text-red-600'}">
                    ${type === 'success' ? 'Success!' : 'Error!'}
                </h2>
                <p class="text-gray-700">${message}</p>
                <div class="mt-6 flex justify-center">
                    <button class="px-4 py-2 rounded-lg text-white ${type === 'success' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'}">OK</button>
                </div>
            </div>
        </div>
    `);

            modal.find("button").on("click", () => modal.remove());
            $("body").append(modal);
            setTimeout(() => modal.remove(), 4000);
        }
    </script>
@endpush
