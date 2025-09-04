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
                <div class="text-xl lg:text-3xl flex items-center">
                    <span class="text-sm xl:text-base pr-1">{{ $review->rating }}</span>
                    <div class="flex items-center space-x-px xs:space-x-1"
                        aria-label="{{ $review->rating }} out of 5 stars" role="img">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <img src="{{ asset('icons/Star.svg') }}" class="xl:inline-block hidden"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="xl:hidden inline-block"
                                    alt="" />
                            @else
                                <img src="{{ asset('icons/Stargray.svg') }}" class="xl:inline-block hidden"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="xl:hidden inline-block"
                                    alt="" />
                            @endif
                        @endfor
                    </div>
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

            <div class="mt-6 flex items-center gap-x-2">
                <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                    class="size-6 rounded-full object-cover" alt="" />
                <span class="text-sm text-gray-600">{{ $review->user->name }}</span>
            </div>

            <div class="flex items-end justify-between mt-4">
                <div class="flex items-center gap-x-4">
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/like.png') }}" alt="" class="size-5" />
                        <span>{{ $review->total_likes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/dislike.png') }}" alt="" class="h-5 w-6" />
                        <span>{{ $review->total_dislikes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/comment.png') }}" alt="" class="size-5" />
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
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm pr-1">{{ $review->rating }}</span>
                    <div class="flex items-center space-x-px">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            @else
                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

            <h4 class="text-2xl font-bold tracking-tight text-text mt-3 line-clamp-1">
                "{{ $review->title }}"
            </h4>

            <p class="text-sm text-gray-600">{{ Str::limit($review->text, 100) }}</p>

            <div class="flex items-center gap-x-2">
                <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                    class="size-5 rounded-full object-cover" alt="" />
                <span class="text-sm text-gray-600">{{ $review->user->name }}</span>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-4">
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/like.png') }}" alt="" class="size-4" />
                        <span class="text-sm">{{ $review->total_likes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/dislike.png') }}" alt="" class="h-4 w-5" />
                        <span class="text-sm">{{ $review->total_dislikes }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <img src="{{ asset('images/comment.png') }}" alt="" class="size-4" />
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
        </div>
    </div>
@endforeach
