@extends('layouts.app')

@section('title', 'Все отзывы | skazoknet.com')

@section('content')

    @if ($type == 'Developer')
        <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden">
            <a href="{{ route('home') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</a>
            <span class="px-2">|</span>
            <a href="{{ route('developers') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Застройщики</a>
            <span class="px-2">|</span>
            <span class="text-sm xl:text-xs tracking-widest text-primary">
                {{ $developer->name }}</span>
        </div>

        <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative">
            <div class="flex items-start justify-between gap-x-8 lg:gap-x-12 flex-col md:flex-row">
                <div
                    class="h-[12.5rem] mx-auto md:mx-0 max-w-[18.125rem] md:max-w-[15.625rem] lg:max-w-[19.375rem] size-full border-transparent border rounded-xl md:border-custom-gray flex items-center justify-center mb-2">
                    @if ($developer->image != null)
                        <img src="{{ asset('developer/' . $developer->image) }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-full" alt=""
                            style="width:100%;max-height:100%;" />
                    @else
                        <img src="{{ asset('images/zaglushka.svg') }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-auto" alt="" />
                    @endif
                </div>
                <div class="w-full md:w-[calc(100%-17.625rem)] lg:w-[calc(100%-22.375rem)] flex flex-col gap-2 lg:gap-4">
                    <h1 class="tracking-widest text-2xl lg:text-3xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                        Строительная компания «{{ $developer->name }}»
                    </h1>
                    <div
                        class="flex items-start xs:items-center gap-3 lg:gap-6 w-full xl:w-[80%] mr-0 xl:mr-auto xs:flex-row flex-col">
                        <h4 class="text-sm lg:text-base font-semibold tracking-wider">
                            Год основания: {{ $developer->year_establishment }} г.
                        </h4>
                        <div class="xs:inline-block hidden">|</div>
                        <div class="text-sm lg:text-base font-semibold">
                            Количество объектов: {{ $developer->complexes()->count() }}
                        </div>
                    </div>
                    <hr class="md:hidden border-auth-input-border-color" />
                    <p class="text-xs lg:text-sm tracking-wide w-full xl:w-[80%] mr-0 xl:mr-auto">
                        {!! $developer->content !!}
                    </p>
                </div>
            </div>
            <div class="mt-8 w-full xl:w-[80%] mr-0 xl:mr-auto flex items-center justify-between md:flex-nowrap flex-wrap">
                <div
                    class="text-xs 2xl:text-sm tracking-wide order-4 md:order-none md:w-auto w-full md:mt-0 mt-4 md:text-left text-center">
                    Ваша компания? <a href="{{ route('gainingaccess', ['company_id' => $developer->id]) }}"
                        class="text-primary">Оставьте заявку</a>
                </div>
                <div class="text-xl lg:text-3xl flex items-center w-[50%] md:w-auto order-1 md:order-0">
                    <div class="hidden md:block">
                        @include('inc.star_rating', [
                            'type' => 'developer',
                            'main' => 'true',
                            'width' => '40px',
                            'height' => '40px',
                            'star_count_class' => 'pr-1',
                        ])
                    </div>
                    <div class="md:hidden block">
                        @include('inc.star_rating', [
                            'type' => 'developer',
                            'main' => 'true',
                            'width' => '27px',
                            'height' => '27px',
                            'star_count_class' => 'pr-1',
                        ])
                    </div>
                </div>
                <div class="hidden md:block">
                    @if ($developer->popular == '1')
                        <span
                            style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
                    @endif
                </div>
                <div class="flex items-center gap-x-2 w-[50%] md:w-auto order-2 md:order-none md:justify-start justify-end">
                    <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                        {{ $developer->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->count() }}</span>
                    <span class="text-sm tracking-wide">Отзывов</span>
                </div>
                <div class="order-3 md:order-none md:mt-0 mt-4 md:w-auto w-full">
                    @php
                        $userHasReview =
                            Auth::check() &&
                            \App\Models\Review::where('user_id', Auth::id())
                                ->where('reviewable_id', $developer->id)
                                ->where('reviewable_type', \App\Models\Developer::class)
                                ->exists();
                    @endphp

                    @if ($userHasReview)
                        <button onclick="showReviewExistsModal()"
                            class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                            <i class="mdi mdi-plus"></i>
                            Оставить отзыв
                        </button>
                    @else
                        <a href="{{ route('review.create', ['type' => 'developer', 'id' => $developer->id]) }}"
                            class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer inline-block text-center">
                            <i class="mdi mdi-plus"></i>
                            Оставить отзыв
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if ($type == 'Complex')
        <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden items-center">
            <a href="{{ route('home') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</a>
            <span class="px-2">|</span>
            <a href="{{ route('complexes', $complex->type) }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">
                @if ($complex->type == 'residential')
                    Жилые комплекс
                @endif
                @if ($complex->type == 'hotel')
                    Гостиничный комплекс
                @endif
            </a>
            <span class="px-2">|</span>
            <a href="{{ route('show.developer', $complex->developer->slug) }}"
                class="text-sm xl:text-xs tracking-widest cursor-pointer">
                {{ $complex->developer->name }}
            </a>
            <span class="px-2">|</span>
            <span class="text-sm xl:text-xs tracking-widest text-primary">
                @if ($complex->type == 'residential')
                    Жилой комплекс
                @endif
                @if ($complex->type == 'hotel')
                    Гостиничные комплекс
                @endif “{{ $complex->name }}”
            </span>
        </div>

        <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative md:block hidden">
            <div class="flex items-start justify-between gap-x-8 lg:gap-x-12 flex-col md:flex-row">
                <div
                    class="h-[12.5rem] mx-auto md:mx-0 max-w-[18.125rem] md:max-w-[15.625rem] lg:max-w-[19.375rem] size-full border-transparent border rounded-xl md:border-custom-gray flex items-center justify-center">
                    @if ($complex->image != null)
                        <img src="{{ asset('complex/' . $complex->image) }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-full" alt=""
                            style="width:100%;max-height:100%;" />
                    @else
                        <img src="{{ asset('images/zaglushka.svg') }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-auto" alt="" />
                    @endif
                </div>
                <div class="w-full md:w-[calc(100%-17.625rem)] lg:w-[calc(100%-22.375rem)] flex flex-col gap-2 lg:gap-4">
                    <h1
                        class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                        @if ($complex->type == 'residential')
                            Жилой комплекс
                        @endif
                        @if ($complex->type == 'hotel')
                            Гостиничные комплекс
                        @endif «{{ $complex->name }}»
                    </h1>
                    <div
                        class="flex items-start xs:items-center gap-3 lg:gap-6 w-full xl:w-[80%] mr-0 xl:mr-auto xs:flex-row flex-col">
                        <h4 class="text-sm lg:text-base font-semibold tracking-wider">
                            {{ $complex->address }}
                        </h4>
                        <div class="xs:inline-block hidden">|</div>
                        <div class="text-sm lg:text-base font-semibold">
                            Застройщик: {{ $complex->developer->name }}
                        </div>
                    </div>
                    <hr class="md:hidden border-auth-input-border-color" />
                    <p class="text-xs lg:text-sm tracking-wide w-full xl:w-[80%] mr-0 xl:mr-auto">
                        {!! $complex->content !!}
                    </p>
                </div>
            </div>
            <div class="mt-8 w-full xl:w-[80%] mr-0 xl:mr-auto flex items-center justify-between md:flex-nowrap flex-wrap">
                <div
                    class="text-xs 2xl:text-sm tracking-wide order-4 md:order-none md:w-auto w-full md:mt-0 mt-4 md:text-left text-center">
                    Ваша компания? <a href="{{ route('gainingaccess', ['company_id' => $complex->developer->id]) }}"
                        class="text-primary">Оставьте заявку</a>
                </div>
                <div class="text-xl lg:text-3xl flex items-center w-[50%] md:w-auto order-1 md:order-0">
                    @include('inc.star_rating', [
                        'type' => 'complex',
                        'main' => 'true',
                        'width' => '40px',
                        'height' => '40px',
                        'star_count_class' => 'pr-1',
                    ])
                </div>
                <div>
                    @if ($complex->popular == '1')
                        <span
                            style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
                    @endif
                </div>
                <div class="flex items-center gap-x-2 w-[50%] md:w-auto order-2 md:order-none md:justify-start justify-end">
                    <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                        {{ $totalReviews }}</span>
                    <span class="text-sm tracking-wide">Отзывов</span>
                </div>
                <div class="order-3 md:order-none md:mt-0 mt-4 md:w-auto w-full">
                    @php
                        $userHasReview =
                            Auth::check() &&
                            \App\Models\Review::where('user_id', Auth::id())
                                ->where('reviewable_id', $complex->id)
                                ->where('reviewable_type', \App\Models\Complex::class)
                                ->exists();
                    @endphp

                    @if ($userHasReview)
                        <button onclick="showReviewExistsModal()"
                            class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                            <i class="mdi mdi-plus"></i>
                            Оставить отзыв
                        </button>
                    @else
                        <a href="{{ route('review.create', ['type' => 'complex', 'id' => $complex->id]) }}"
                            class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer inline-block text-center">
                            <i class="mdi mdi-plus"></i>
                            Оставить отзыв
                        </a>
                    @endif
                </div>
            </div>

            <button onclick="window.history.back()"
                class="absolute right-12 top-4 z-10 rounded-full px-2 py-1 bg-custom-gray-2 cursor-pointer text-white md:hidden block">
                <i class="mdi mdi-chevron-left"></i>
            </button>
        </div>
    @endif


    <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25 flex flex-col">
        <div class="flex items-center justify-between order-2 md:order-none md:my-0 my-4">
            <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                @if ($type == 'Developer')
                    Все отзывы строительная компания “{{ $developer->name }}”, {{ $city->text ?? '' }}
                @endif
                @if ($type == 'Complex')
                    Все отзывы @if ($complex->type == 'residential')
                        Жилой комплекс
                    @endif
                    @if ($complex->type == 'hotel')
                        Гостиничные комплекс
                    @endif “{{ $complex->name }}”, {{ $city->text ?? '' }}
                @endif
            </h1>
        </div>
        <div class="my-4 md:my-10 flex items-center justify-between order-1 md:order-none md:flex-nowrap flex-wrap">
            <div class="flex items-start md:items-center gap-6 md:gap-8 md:w-auto w-full md:flex-row flex-col">
                <div class="flex items-center gap-x-2">
                    <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                        {{ $reviews->where('type', 'positive')->count() }}</span>
                    <span class="text-sm tracking-wide">Положительных отзывов</span>
                </div>
                <div class="flex items-center gap-x-2">
                    <span class="bg-red-500 text-white p-1 px-2 rounded-lg text-sm">
                        {{ $reviews->where('type', 'negative')->count() }}</span>
                    <span class="text-sm tracking-wide">Отрицателных отзывов</span>
                </div>
            </div>
            {{-- filter --}}
            {{-- <div class="md:w-auto w-full md:mt-0 mt-6">
                <div class="dropdown relative inline-block">
                    <button
                        class="flex items-center gap-2 bg-transparent hover:bg-black/5 px-3 py-2 transition-colors rounded-lg cursor-pointer">
                        <span>По умолчанию</span>
                        <img src="../public/icons/Group 334.svg" alt="" />
                    </button>
                    <div class="dropdown-content absolute hidden bg-white min-w-[200px] shadow-lg rounded-lg z-10">
                        <div class="dropdown-item cursor-pointer px-4 py-2" data-value="default">
                            По умолчанию <span class="check-icon hidden">✔</span>
                        </div>
                        <div class="dropdown-item cursor-pointer px-4 py-2" data-value="client">
                            Сначала положительные
                            <span class="check-icon hidden">✔</span>
                        </div>
                        <div class="dropdown-item cursor-pointer px-4 py-2" data-value="rating">
                            Сначала отрицательные
                            <span class="check-icon hidden">✔</span>
                        </div>
                        <div class="dropdown-item cursor-pointer px-4 py-2" data-value="new">
                            По новизне <span class="check-icon hidden">✔</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- end-filter --}}
        </div>
        <div class="flex gap-8 flex-wrap order-3 md:mt-0 mt-4">
            @forelse($reviews as $review)
                {{-- @include('inc.review_card') --}}
                <div
                    class="relative rounded-xl basis-full sm:basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="hidden md:flex items-center gap-1">
                                <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                                    class="size-7" alt="" style="border-radius: 25px;object-fit:cover" />
                                <span>{{ $review->user->name }}</span>
                            </div>
                            <span class="inline-block md:hidden text-xs">
                                @if ($review->images->count() > 0)
                                    {{ $review->images->count() }} фото
                                @else
                                    Одобрен
                                @endif
                            </span>
                            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">
                                {{ $review->additions()->count() }} Дополнений</span>
                        </div>
                        @php
                            if ($review->reviewable_type == 'App\Models\Complex') {
                                $type = 'complex';
                                $complex = $review->reviewable;
                            }
                            if ($review->reviewable_type == 'App\Models\Developer') {
                                $type = 'developer';
                                $developer = $review->reviewable;
                            }
                        @endphp
                        <div class="flex items-center justify-between mt-4">
                            {{-- @include('inc.star_rating', [
                                'type' => $type,
                                'main' => 'false',
                                'width' => '27px',
                                'height' => '27px',
                                // 'star_count_class' => 'pr-1',
                            ]) --}}
                            <div class="flex items-center"
                                aria-label="{{ $review->rating }} out of 5 stars"role="rating">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <svg class=" text-yellow-400" fill="currentColor" viewBox="0 0 24 24"
                                        style="width:{{ '27px' }};height:{{ '27px' }}">
                                        <path
                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
                                    </svg>
                                @endfor
                                @for ($i = 0; $i < 5 - $review->rating; $i++)
                                    <svg class=" text-gray-300" fill="currentColor" viewBox="0 0 24 24"
                                        style="width:{{ '27px' }};height:{{ '27px' }}">
                                        <path
                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm">{{ $review->created_at->format('Y/m/d') }}</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                                class="size-7" alt="" style="border-radius: 25px;object-fit:cover" />
                            <span>{{ $review->user->name }}</span>
                        </div>
                        <h2 class="font-semibold text-lg line-clamp-2" style="min-height:56px;">
                            {{ Str::limit($review->title, 50) }}
                        </h2>
                        <p class="text-sm line-clamp-4" style="min-height: 80px;">
                            {{ Str::limit($review->text, 150) }}
                        </p>
                        <div class="my-4 md:my-8">
                            <a href="{{ route('review.show', $review) }}"
                                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full inline-block text-center">
                                Читать отзыв
                            </a>
                        </div>
                        <div class="flex items-center justify-between gap-x-2">
                            <form action="{{ route('review.like', $review) }}" method="POST"
                                class="flex items-center gap-x-1">
                                @csrf
                                <button type="submit" class="flex items-center gap-x-1"
                                    style="background: none; border: none; padding: 0;">
                                    <img src="{{ asset('images/like.svg') }}" alt="" class="size-5" />
                                    <span>{{ $review->total_likes }}</span>
                                </button>
                            </form>
                            <form action="{{ route('review.dislike', $review) }}" method="POST"
                                class="flex items-center gap-x-1">
                                @csrf
                                <button type="submit" class="flex items-center gap-x-1"
                                    style="background: none; border: none; padding: 0;">
                                    <img src="{{ asset('images/dislike.svg') }}" alt="" class="h-5 w-6" />
                                    <span>{{ $review->total_dislikes }}</span>
                                </button>
                            </form>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('images/comment.svg') }}" alt="" class="size-5" />
                                <span>{{ $review->comments()->count() ?? 0 }}</span>
                            </div>

                            <span class="md:inline-block hidden text-xs text-green-600">
                                Одобрен
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 w-full">
                    <p class="text-gray-500">Пока нет отзывов для этого застройщика</p>
                </div>
            @endforelse
        </div>
        <div class="flex justify-center items-center">
            {{ $reviews->links('vendor.pagination.custom') }}
        </div>

        {{-- <div class="mt-8 block md:hidden order-4">
            <button
                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                Все отзывы
            </button>
        </div> --}}
    </section>

@endsection
