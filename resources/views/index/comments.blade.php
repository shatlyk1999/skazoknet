<section class="xl:container px-0 sm:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
    <div class="flex items-center justify-between mb-8 px-8 xs:px-12 sm:px-0">
        <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
            Лучшие отзывы недели
        </h1>
        <a href="{{ route('allWeekly') }}" class="md:inline-block hidden">Все отзывы</a>
    </div>

    <div class="hidden sm:flex gap-8 flex-wrap">
        @forelse($reviews as $review)
            {{-- <div
                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between gap-x-2">
                        <div class="hidden md:flex items-center gap-1">
                            <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                                class="size-7" alt="" style="border-radius: 25px; object-fit:cover" />
                            <span>{{ $review->user->name }}</span>
                        </div>
                        <span class="inline-block md:hidden text-xs">
                            @if ($review->images->count() > 0)
                                {{ $review->images->count() }} фото
                            @endif
                        </span>
                        <span
                            class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">
                            {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <x-star-rating :rating="$review->rating" size="small" :showNumber="false" />
                        <span class="text-sm">{{ $review->created_at->format('Y/m/d') }}</span>
                    </div>
                    <div class="flex md:hidden items-center gap-1">
                        <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                            class="size-8" alt="" style="border-radius: 25px; object-fit:cover" />
                        <span>{{ $review->user->name }}</span>
                    </div>
                    <h2 class="font-semibold text-lg line-clamp-1">
                        Объект:
                        @if ($review->reviewable_type === 'App\Models\Developer')
                            Застройщик
                            <a href="{{ route('show.developer', $review->reviewable->slug) }}"
                                class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                        @else
                            @if ($review->reviewable->type == 'residential')
                                Жилой комплекс
                            @else
                                Гостиничный комплекс
                            @endif
                            <a href="{{ route('show.complex', $review->reviewable->slug) }}"
                                class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                        @endif
                    </h2>
                    <p class="text-sm line-clamp-2" style="min-height: 50px;">
                        {{ Str::limit($review->text, 150) }}
                    </p>
                    <div class="my-4 md:my-8">
                        <a href="{{ route('review.show', $review) }}"
                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full inline-block text-center">
                            Читать отзыв
                        </a>
                    </div>
                    <div class="flex items-center justify-between gap-x-2">
                        <div class="flex items-center gap-x-1">
                            <img src="{{ asset('images/like.svg') }}" alt="" class="size-5" />
                            <span>{{ $review->likes ?? 0 }}</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="{{ asset('images/dislike.svg') }}" alt="" class="h-5 w-6" />
                            <span>{{ $review->dislikes ?? 0 }}</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="{{ asset('images/comment.svg') }}" alt="" class="size-5" />
                            <span>{{ $review->comments()->count() ?? 0 }}</span>
                        </div>
                        <span class="md:inline-block hidden text-xs text-green-600">
                            Одобрен
                        </span>
                    </div>
                </div>
            </div> --}}
            @include('inc.review_card')
        @empty
            <div class="w-full text-center py-8">
                <p class="text-gray-500">Пока нет отзывов в этом городе</p>
            </div>
        @endforelse
    </div>

    <!-- Mobile version -->
    <div class="mt-8 block sm:hidden">
        <div class="swiper krasnodor3Swiper relative !px-8 xs:!px-12 sm:!px-0">
            <div class="swiper-wrapper">
                @foreach ($reviews as $review)
                    {{-- <div class="swiper-slide">
                        <div
                            class="relative rounded-xl group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                            <div class="flex flex-col gap-4">
                                <div class="flex items-center justify-between gap-x-2">
                                    <div class="flex items-center gap-1">
                                        <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                                            class="size-7" alt=""
                                            style="border-radius: 25px; object-fit:cover" />
                                        <span>{{ $review->user->name }}</span>
                                    </div>
                                    <span
                                        class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">
                                        {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
                                    </span>
                                    <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">
                                        {{ $review->additions()->count() }} Дополнений</span>
                                </div>
                                @php
                                    if ($review->reviewable_type == 'App\Models\Complex') {
                                        $tt = 'complex';
                                    }
                                    if ($review->reviewable_type == 'App\Models\Developer') {
                                        $tt = 'developer';
                                    }
                                    // dd($tt);
                                @endphp
                                <div class="flex items-center justify-between mt-4">
                                    @include('inc.star_rating', [
                                        'type' => $tt,
                                        'main' => 'false',
                                        'width' => '27px',
                                        'height' => '27px',
                                    ])
                                    <span class="text-sm">{{ $review->created_at->format('Y/m/d') }}</span>
                                </div>
                                <h2 class="font-semibold text-lg line-clamp-1">
                                    Объект:
                                    @if ($review->reviewable_type === 'App\Models\Developer')
                                        Застройщик
                                        <a href="{{ route('show.developer', $review->reviewable->slug) }}"
                                            class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                                    @else
                                        @if ($review->reviewable->type == 'residential')
                                            Жилой комплекс
                                        @else
                                            Гостиничный комплекс
                                        @endif
                                        <a href="{{ route('show.complex', $review->reviewable->slug) }}"
                                            class="text-primary hover:underline">#{{ $review->reviewable->name }}</a>
                                    @endif
                                </h2>
                                <p class="text-sm line-clamp-2" style="min-height: 50px;">
                                    {{ Str::limit($review->text, 100) }}
                                </p>
                                <div class="my-4 md:my-8">
                                    <a href="{{ route('review.show', $review) }}"
                                        class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full inline-block text-center">
                                        Читать отзыв
                                    </a>
                                </div>
                                <div class="flex items-center justify-between gap-x-2">
                                    <div class="flex items-center gap-x-1">
                                        <img src="{{ asset('images/like.svg') }}" alt="" class="size-5" />
                                        <span>{{ $review->likes ?? 0 }}</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="{{ asset('images/dislike.svg') }}" alt="" class="h-5 w-6" />
                                        <span>{{ $review->dislikes ?? 0 }}</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="{{ asset('images/comment.svg') }}" alt="" class="size-5" />
                                        <span>{{ $review->comments()->count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @include('inc.mb_review_card')
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0 flex justify-center items-center text-center">
        <a href="{{ route('allWeekly') }}"
            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
            Все отзывы
        </a>
    </div>
</section>
