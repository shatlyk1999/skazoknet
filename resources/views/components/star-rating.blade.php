@props(['rating' => 0, 'size' => 'normal', 'showNumber' => true])

@php
    $rating = (float) $rating;
    $fullStars = floor($rating);
    $partialStar = $rating - $fullStars;
    $emptyStars = 5 - $fullStars - ($partialStar > 0 ? 1 : 0);

    $sizeClasses = [
        'small' => 'w-4 h-4',
        'normal' => 'w-5 h-5',
        'large' => 'w-6 h-6',
    ];

    $starSize = $sizeClasses[$size] ?? $sizeClasses['normal'];
@endphp

<div class="flex items-center gap-1">
    @if ($showNumber)
        <span class="text-sm font-medium mr-1">{{ number_format($rating, 2) }}</span>
    @endif

    <div class="flex items-center">
        {{-- Full stars --}}
        @for ($i = 0; $i < $fullStars; $i++)
            <svg class="{{ $starSize }} text-yellow-400 fill-current" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
        @endfor

        {{-- Partial star --}}
        @if ($partialStar > 0)
            <div class="relative {{ $starSize }}">
                {{-- Empty star background --}}
                <svg class="{{ $starSize }} text-gray-300 fill-current absolute" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                {{-- Filled portion --}}
                <div class="absolute top-0 left-0 overflow-hidden" style="width: {{ $partialStar * 100 }}%">
                    <svg class="{{ $starSize }} text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
        @endif

        {{-- Empty stars --}}
        @for ($i = 0; $i < $emptyStars; $i++)
            <svg class="{{ $starSize }} text-gray-300 fill-current" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
        @endfor
    </div>
</div>
