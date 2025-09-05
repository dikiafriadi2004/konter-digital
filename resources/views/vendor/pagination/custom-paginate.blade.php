@if ($paginator->hasPages())
    <div class="flex justify-center items-center space-x-2 mt-12">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="px-5 py-3 rounded-full border border-primary text-primary opacity-50 cursor-not-allowed shadow-sm">
                Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="px-5 py-3 rounded-full border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 shadow-sm">
                Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span
                    class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-400 cursor-default shadow-sm">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white font-semibold shadow-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 shadow-sm">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="px-5 py-3 rounded-full border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 shadow-sm">
                Next
            </a>
        @else
            <span
                class="px-5 py-3 rounded-full border border-primary text-primary opacity-50 cursor-not-allowed shadow-sm">
                Next
            </span>
        @endif
    </div>
@endif
