<div class="dropdown relative inline-block">
    <button
        class="flex items-center gap-2 bg-transparent hover:bg-black/5 px-3 py-2 transition-colors rounded-lg cursor-pointer">
        @if (empty($query))
            <span>По умолчанию</span>
        @elseif(!empty($query) && (isset($query['popular']) && $query['popular'] == '1'))
            <span>Популярные</span>
        @endif
        <img src="{{ asset('icons/Group 334.svg') }}" alt="" />
    </button>
    <div class="dropdown-content absolute hidden bg-white min-w-[200px] shadow-lg rounded-lg z-10 right-0">
        <div class="dropdown-item cursor-pointer px-4 py-2">
            <a href="{{ route('developers') }}">
                По умолчанию
            </a>
            @if (empty($query))
                <span class="check-icon">✔</span>
            @endif
        </div>
        <div class="dropdown-item cursor-pointer px-4 py-2">
            Сначала с высоким рейтингом
            {{-- <span class="check-icon hidden">✔</span> --}}
        </div>
        <div class="dropdown-item cursor-pointer px-4 py-2">
            Сначала с низким рейтингом
            {{-- <span class="check-icon hidden">✔</span> --}}
        </div>
        <div class="dropdown-item cursor-pointer px-4 py-2">
            <a href="{{ route('developers') }}?popular=on">
                Популярные
            </a>
            @if (!empty($query) && (isset($query['popular']) && $query['popular'] == '1'))
                <span class="check-icon">✔</span>
            @endif
        </div>
    </div>
</div>
