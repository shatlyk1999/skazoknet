@php
    if ($type == 'developer') {
        $review_count = $developer->reviews()->count();
        $rating_count = $developer->reviews()->sum('rating');
        if ($review_count != 0) {
            $star_count = round($rating_count / $review_count, 2);
        } else {
            $star_count = 0;
        }
    }
    if ($type == 'complex') {
        $review_count = $complex->reviews()->count();
        $rating_count = $complex->reviews()->sum('rating');
        if ($review_count != 0) {
            $star_count = round($rating_count / $review_count, 2);
        } else {
            $star_count = 0;
        }
    }
@endphp
@php
    // Toplam yüzdelik hesaplama: $star_count * 100% / 5
    $total_percentage = ($star_count / 5) * 100;

    // Her yıldız %20'lik dilimi temsil ediyor
    $stars_data = [];
    for ($i = 1; $i <= 5; $i++) {
        $star_start = ($i - 1) * 20; // Bu yıldızın başlangıç yüzdesi
        $star_end = $i * 20; // Bu yıldızın bitiş yüzdesi

        if ($total_percentage >= $star_end) {
            // Tam sarı yıldız
            $stars_data[$i] = 100;
        } elseif ($total_percentage > $star_start) {
            // Yarım yıldız - bu yıldızın ne kadarı sarı olacak
            $fill_in_this_star = (($total_percentage - $star_start) / 20) * 100;
            $stars_data[$i] = $fill_in_this_star;
        } else {
            // Gri yıldız
            $stars_data[$i] = 0;
        }
    }
@endphp

{{-- space-x-px xs:space-x-px --}}
<div class="flex items-center " aria-label="{{ $star_count }} out of 5 stars" role="img">
    @if ($main == 'true')
        <span class="{{ $star_count_class ?? 'text-lg font-semibold' }}">
            {{ number_format($star_count, 2) }}
        </span>
    @endif
    @for ($i = 1; $i <= 5; $i++)
        @if ($stars_data[$i] >= 100)
            {{-- Tam sarı yıldız - MDI icon --}}
            <svg class=" text-yellow-400" fill="currentColor" viewBox="0 0 24 24"
                style="width:{{ $width ?? '30px' }};height:{{ $height ?? '30px' }}">
                <path
                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
            </svg>
        @elseif ($stars_data[$i] > 0)
            {{-- Yarım yıldız --}}
            <div class="relative " style="width:{{ $width ?? '30px' }};height:{{ $height ?? '30px' }}">
                {{-- Gri yıldız (arka plan) --}}
                <svg class="absolute  text-gray-300" fill="currentColor" viewBox="0 0 24 24"
                    style="width:{{ $width ?? '30px' }};height:{{ $height ?? '30px' }}">
                    <path
                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
                </svg>
                {{-- Sarı kısım (üst katman) --}}
                <div class="absolute overflow-hidden " style="width: {{ $stars_data[$i] }}%;"
                    style="width:{{ $width ?? '30px' }};height:{{ $height ?? '30px' }}">
                    <svg class=" text-yellow-400" fill="currentColor" viewBox="0 0 24 24"
                        style="width:{{ $width ?? '30px' }};height:{{ $height ?? '30px' }}">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
                    </svg>
                </div>
            </div>
        @else
            {{-- Gri yıldız --}}
            <svg class=" text-gray-300" fill="currentColor" viewBox="0 0 24 24"
                style="width:{{ $width ?? '30px' }};height:{{ $height ?? '30px' }}">
                <path
                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
            </svg>
        @endif
    @endfor
</div>
