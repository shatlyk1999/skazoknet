@if ($paginator->hasPages())
    <div class="flex items-center justify-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 text-sm text-gray-400 cursor-not-allowed">
                <i class="mdi mdi-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-2 text-sm text-gray-600 hover:text-primary transition-colors">
                <i class="mdi mdi-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-2 text-sm text-gray-500">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="px-3 py-2 text-sm bg-primary text-white rounded-lg font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-2 text-sm text-gray-600 hover:text-primary transition-colors">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        @else
            <span class="px-3 py-2 text-sm text-gray-400 cursor-not-allowed">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        @endif
    </div>

    {{-- Mobile Info --}}
    <div class="mt-3 text-center">
        <p class="text-xs text-gray-500">
            Показано {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} из {{ $paginator->total() }} результатов
        </p>
    </div>
@endif
