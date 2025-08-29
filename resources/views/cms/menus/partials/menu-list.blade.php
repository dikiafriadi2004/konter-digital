@foreach ($menus as $menu)
    <li class="menu-item p-2 border rounded-md bg-gray-50" data-id="{{ $menu->id }}">
        <div class="flex justify-between items-center">
            <span class="font-medium text-gray-800">{{ $menu->title }}</span>

            <div class="flex space-x-2">
                <button type="button"
                    onclick="openDeleteModal('{{ route('menus.destroy', $menu->id) }}', '{{ addslashes($menu->title) }}')"
                    class="px-2 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>

        {{-- always render children UL so it can accept drops even when empty --}}
        <ul class="children ml-4 mt-2 space-y-2">
            @if ($menu->childrenRecursive->count())
                @include('cms.menus.partials.menu-list', ['menus' => $menu->childrenRecursive])
            @endif
        </ul>
    </li>
@endforeach
