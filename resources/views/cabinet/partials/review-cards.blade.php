{{-- Desktop Reviews - 2 columns --}}
@foreach ($reviews as $review)
    <div class="hidden lg:block w-[calc(50%-.5rem)]">
        <span class="text-xs xl:text-sm font-normal tracking-wide text-text">
            {{ $review->created_at->format('Y/m/d') }}
        </span>
        <div
            class="mt-2 w-full border border-input-border-color rounded-2xl p-6 h-[400px] flex flex-col justify-between">
            <div class="flex items-center justify-between gap-2">
                <div
                    class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white rounded-4xl px-5 xl:px-7 py-2 xl:py-3 text-xs tracking-wide font-bold">
                    {{ $review->type === 'positive' ? 'Положительный отзыв' : 'Негативный отзыв' }}
                </div>
                @if (class_basename($review->reviewable_type) == 'Developer')
                    {{ $type == 'developer' }}
                @endif
                @if (class_basename($review->reviewable_type) == 'Complex')
                    {{ $type == 'complex' }}
                @endif
                <div class="text-xl lg:text-3xl flex items-center">
                    {{-- <x-star-rating :rating="$review->rating" size="normal" /> --}}
                    @include('inc.star_rating', [
                        'type' => $type,
                        'main' => 'true',
                        'width' => '40px',
                        'height' => '40px',
                        'star_count_class' => 'pr-1',
                    ])
                </div>
            </div>

            <div class="mt-2">
                <h3 class="text-lg font-bold text-text">
                    Объект:
                    @if (class_basename($review->reviewable_type) == 'Developer')
                        Застройщик
                        <a href="{{ route('show.developer', $review->reviewable->slug) }}"
                            class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                    @endif
                    @if (class_basename($review->reviewable_type) == 'Complex')
                        Комплекс
                        <a href="{{ route('show.complex', $review->reviewable->slug) }}"
                            class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                    @endif
                </h3>
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-text mt-3 line-clamp-1">
                "{{ $review->title }}"
            </h2>

            <p class="font-normal text-sm tracking-wide text-text mt-4 line-clamp-2">
                {{ Str::limit($review->text, 150) }}
            </p>

            <a href="{{ route('reviews.additions.create', $review->id) }}"
                class="w-50 mt-6 border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                <i class="mdi mdi-plus"></i>
                Дополнить отзыв
            </a>

            <div class="flex items-end justify-between mt-4">
                <div class="flex items-center gap-x-4">
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/like.svg') }}" alt="" class="size-5" />
                        <span>{{ $review->total_likes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/dislike.svg') }}" alt="" class="h-5 w-6" />
                        <span>{{ $review->total_dislikes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/comment.svg') }}" alt="" class="size-5" />
                        <span>{{ $review->comments()->count() ?? 0 }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm">
                        {{ $review->images->count() }} фото
                    </span>
                    <span class="text-text text-xs font-normal tracking-wide text-right">
                        {{ $review->approval_status }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Mobile Reviews - 1 column --}}
@foreach ($reviews as $review)
    <div
        class="w-full rounded-2xl shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8 lg:hidden">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div
                    class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white rounded-4xl px-4 py-2 text-xs tracking-wide font-bold">
                    {{ $review->type === 'positive' ? 'Положительный отзыв' : 'Негативный отзыв' }}
                </div>
                <span class="text-xs text-gray-500">{{ $review->created_at->format('Y/m/d') }}</span>
            </div>
            <div>
                <h4 class="text-lg font-bold text-text">
                    Объект:
                    @if (class_basename($review->reviewable_type) == 'Developer')
                        Застройщик
                        <a href="{{ route('show.developer', $review->reviewable->slug) }}"
                            class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                    @endif
                    @if (class_basename($review->reviewable_type) == 'Complex')
                        Комплекс
                        <a href="{{ route('show.complex', $review->reviewable->slug) }}"
                            class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                    @endif
                </h4>
            </div>
            @if (class_basename($review->reviewable_type) == 'Developer')
                {{ $type == 'developer' }}
            @endif
            @if (class_basename($review->reviewable_type) == 'Complex')
                {{ $type == 'complex' }}
            @endif
            <div class="flex items-center justify-between">
                {{-- <x-star-rating :rating="$review->rating" size="small" /> --}}
                @include('inc.star_rating', [
                    'type' => $type,
                    'main' => 'true',
                    'width' => '40px',
                    'height' => '40px',
                    'star_count_class' => 'pr-1',
                ])
            </div>

            <h4 class="text-2xl font-bold tracking-tight text-text mt-3 line-clamp-1">
                "{{ $review->title }}"
            </h4>

            <p class="text-sm text-gray-600">{{ Str::limit($review->text, 100) }}</p>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-4">
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/like.svg') }}" alt="" class="size-4" />
                        <span class="text-sm">{{ $review->total_likes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/dislike.svg') }}" alt="" class="h-4 w-5" />
                        <span class="text-sm">{{ $review->total_dislikes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/comment.svg') }}" alt="" class="size-4" />
                        <span class="text-sm">{{ $review->comments()->count() ?? 0 }}</span>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-1">
                    <span class="text-xs text-gray-500">
                        {{ $review->approval_status }}
                    </span>
                    @if ($review->images->count() > 0)
                        <span class="bg-primary text-white py-1 px-2 rounded-xl text-xs">
                            {{ $review->images->count() }} фото
                        </span>
                    @endif
                </div>
            </div>

            <a href="{{ route('reviews.additions.create', $review->id) }}"
                class="w-full border-primary text-sm border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors">
                <i class="mdi mdi-plus"></i>
                Дополнить отзыв
            </a>
        </div>
    </div>
@endforeach
