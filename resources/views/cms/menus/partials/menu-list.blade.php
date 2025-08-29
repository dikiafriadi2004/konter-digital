@foreach ($menus as $menu)
    <li class="menu-item p-2 border rounded-md bg-gray-50" data-id="{{ $menu->id }}">
        <div class="flex justify-between items-center">
            <span>{{ $menu->title }}</span>
            <div class="flex space-x-2">
                <button type="button" onclick="openDeleteModal('{{ route('menus.destroy', $menu->id) }}')"
                    class="px-2 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>

        @if ($menu->children->count())
            <ul class="children ml-4 mt-2 space-y-2">
                @include('cms.menus.partials.menu-list', ['menus' => $menu->children])
            </ul>
        @endif
    </li>
@endforeach
