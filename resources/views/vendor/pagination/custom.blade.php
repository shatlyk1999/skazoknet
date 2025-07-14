{{-- @if ($paginator->hasPages())
    <nav class="pagination-wrapper" style="margin-top: 20px;">
        <ul class="pagination" style="display: flex; gap: 8px; list-style: none; padding: 0; align-items: center;">
            
            <li style="display: flex;">
                @if ($paginator->onFirstPage())
                    <span
                        style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; color: #aaa; display: flex; align-items: center;">«</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        style="text-decoration: none; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; display: flex; align-items: center;">«</a>
                @endif
            </li>

            
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li style="display: flex;">
                        <span
                            style="padding: 6px 10px; border: 1px solid #eee; border-radius: 4px; color: #999; display: flex; align-items: center;">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li style="display: flex;">
                            @if ($page == $paginator->currentPage())
                                <span class="bg-primary"
                                    style="color: white; padding: 6px 10px; border-radius: 4px; display: flex; align-items: center;">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="text-primary"
                                    style="text-decoration: none; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; display: flex; align-items: center;">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            
            <li style="display: flex;">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        style="text-decoration: none; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; display: flex; align-items: center;">»</a>
                @else
                    <span
                        style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; color: #aaa; display: flex; align-items: center;">»</span>
                @endif
            </li>
        </ul>
    </nav>
@endif --}}


@if ($paginator->hasPages())
    <nav class="pagination-wrapper" style="margin-top: 20px;">
        <ul class="pagination" style="display: flex; gap: 8px; list-style: none; padding: 0; align-items: center;">

            <li>
                @if ($paginator->onFirstPage())
                    <span style="padding: 6px 10px; border: 1px solid #ccc; color: #aaa;">«</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        @if (!empty($use_hx)) hx-get="{{ $paginator->previousPageUrl() }}"
                           hx-target="{{ $hx_target ?? '#results' }}"
                           hx-push-url="true" @endif
                        style="text-decoration: none; padding: 6px 10px; border: 1px solid #ccc;">
                        «
                    </a>
                @endif
            </li>

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span class="bg-primary"
                                    style="color: white; padding: 6px 10px;">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    @if (!empty($use_hx)) hx-get="{{ $url }}"
                                       hx-target="{{ $hx_target ?? '#results' }}"
                                       hx-push-url="true" @endif
                                    style="text-decoration: none; padding: 6px 10px; border: 1px solid #ccc;">
                                    {{ $page }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        @if (!empty($use_hx)) hx-get="{{ $paginator->nextPageUrl() }}"
                           hx-target="{{ $hx_target ?? '#results' }}"
                           hx-push-url="true" @endif
                        style="text-decoration: none; padding: 6px 10px; border: 1px solid #ccc;">
                        »
                    </a>
                @else
                    <span style="padding: 6px 10px; border: 1px solid #ccc; color: #aaa;">»</span>
                @endif
            </li>

        </ul>
    </nav>
@endif
