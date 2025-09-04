@extends('layouts.app')

@section('title', $review->title . ' | Сказокнет')

@section('content')
    @php
        $userHasReview =
            Auth::check() &&
            \App\Models\Review::where('user_id', Auth::id())
                ->where('reviewable_id', $review->reviewable->id)
                ->where('reviewable_type', get_class($review->reviewable))
                ->exists();
    @endphp
    <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden">
        <a href="{{ route('home') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</a>
        <span class="px-2">|</span>
        @if ($review->reviewable_type === 'App\Models\Developer')
            <a href="{{ route('developers') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Застройщики</a>
        @else
            <a href="{{ route('complexes', $review->reviewable->type) }}"
                class="text-sm xl:text-xs tracking-widest cursor-pointer">
                @if ($review->reviewable->type == 'residential')
                    Жилые комплексы
                @else
                    Гостиничные комплексы
                @endif
            </a>
        @endif
        <span class="px-2">|</span>
        <span class="text-sm xl:text-xs tracking-widest text-primary">
            {{ $review->reviewable->name }}
        </span>
    </div>

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative">
        {{-- <div class="md:hidden flex items-start justify-between">
            <div>
                <h1 class="text-xl font-bold tracking-widest text-text">
                    Отзыв
                </h1>
                <span class="text-sm text-text">
                    Отзыв: <span class="text-primary">№{{ $review->id }}</span>
                </span>
            </div>
            <span class="text-sm text-text">{{ $review->created_at->format('Y/m/d') }}</span>
        </div> --}}

        <div class="flex items-start justify-between gap-x-8 lg:gap-x-12 flex-col md:flex-row">
            <div
                class="h-[12.5rem] mx-auto md:mx-0 max-w-[18.125rem] md:max-w-[15.625rem] lg:max-w-[19.375rem] size-full border-transparent border rounded-xl md:border-custom-gray flex items-center justify-center">
                @if ($review->reviewable->image)
                    <img src="{{ asset($review->reviewable_type === 'App\Models\Developer' ? 'developer/' . $review->reviewable->image : 'complex/' . $review->reviewable->image) }}"
                        class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-full" alt=""
                        style="width:100%;max-height:100%;" />
                @else
                    <img src="{{ asset('images/zaglushka.svg') }}"
                        class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-auto" alt="" />
                @endif
            </div>

            <div class="w-full md:w-[calc(100%-17.625rem)] lg:w-[calc(100%-22.375rem)] flex flex-col gap-2 lg:gap-4">
                <h1 class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                    @if ($review->reviewable_type === 'App\Models\Developer')
                        Строительная компания «{{ $review->reviewable->name }}», {{ $city->developer_text }}
                    @else
                        @if ($review->reviewable->type == 'residential')
                            Жилой комплекс «{{ $review->reviewable->name }}», {{ $city->text ?? '' }}
                        @else
                            Гостиничный комплекс «{{ $review->reviewable->name }}», {{ $city->text ?? '' }}
                        @endif
                    @endif
                </h1>

                @if ($review->reviewable_type === 'App\Models\Developer')
                    <div class="font-semibold text-sm tracking-wide">
                        Застройщик: <span class="text-primary">{{ $review->reviewable->name }}</span>
                    </div>
                    <div
                        class="hidden sm:flex items-start xs:items-center gap-3 lg:gap-6 w-full xl:w-[80%] mr-0 xl:mr-auto xs:flex-row flex-col">
                        <h4 class="text-sm lg:text-base font-semibold tracking-wider">
                            Год основания: {{ $review->reviewable->year_establishment }} г.
                        </h4>
                        <div class="xs:inline-block hidden">|</div>
                        <div class="text-sm lg:text-base font-semibold">
                            Количество объектов: {{ $review->reviewable->complexes()->count() }}
                        </div>
                    </div>
                @else
                    <div
                        class="hidden sm:flex items-start xs:items-center gap-3 lg:gap-6 w-full xl:w-[80%] mr-0 xl:mr-auto xs:flex-row flex-col">
                        <h4 class="text-sm lg:text-base font-semibold tracking-wider">
                            {{ $review->reviewable->address }}
                        </h4>
                        <div class="xs:inline-block hidden">|</div>
                        <div class="text-sm lg:text-base font-semibold">
                            Застройщик: {{ $review->reviewable->developer->name }}
                        </div>
                    </div>
                    <hr class="md:hidden border-auth-input-border-color" />
                    <div class="hidden sm:block text-xs lg:text-sm tracking-wide w-full xl:w-[80%] mr-0 xl:mr-auto">
                        {!! $review->reviewable->content !!}
                    </div>
                @endif

                {{-- <hr class="md:hidden md:mt-0 mt-4 border-auth-input-border-color" />

                <div class="md:hidden flex sm:hidden flex-col gap-1 mt-2">
                    <label class="text-input-divider text-xs font-medium tracking-wide pl-2">Тип отзыва:</label>
                    <span
                        class="md:hidden bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white rounded-3xl px-5 py-2 font-medium text-sm text-center">
                        {{ $review->type === 'positive' ? 'Положительный отзыв' : 'Отрицательный отзыв' }}
                    </span>
                </div> --}}

                {{-- mobile --}}

                <div class="flex sm:hidden flex-row gap-1 mt-2">
                    {{-- <label class="text-input-divider text-xs font-medium tracking-wide pl-2">Моя оценка:</label> --}}
                    <div class="text-xl lg:text-3xl pl-2 flex items-center w-[50%] md:w-auto order-1 md:order-0">
                        <span class="pr-1">{{ $review->rating }}</span>
                        <div class="flex items-center space-x-px xs:space-x-1"
                            aria-label="{{ $review->rating }} out of 5 stars" role="img">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                        alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}"
                                        class="min-[51.875rem]:hidden inline-block" alt="" />
                                @else
                                    <img src="{{ asset('icons/Stargray.svg') }}"
                                        class="min-[51.875rem]:inline-block hidden" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}"
                                        class="min-[51.875rem]:hidden inline-block" alt="" />
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-x-2 w-[50%] md:w-auto order-2 md:order-none md:justify-start justify-end">
                        <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                            {{ $review->reviewable->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->count() }}
                        </span>
                        <span class="text-sm tracking-wide">Отзывов</span>
                    </div>
                </div>

                {{-- <div class="flex sm:hidden items-center justify-between gap-x-6 mt-2 pl-2">
                    <form action="{{ route('review.like', $review) }}" method="POST"
                        class="flex lg:hidden items-center gap-x-1">
                        @csrf
                        <button type="submit" class="flex items-center gap-x-1"
                            style="background: none; border: none; padding: 0;">
                            <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                            <span>{{ $review->total_likes }}</span>
                        </button>
                    </form>
                    <form action="{{ route('review.dislike', $review) }}" method="POST"
                        class="flex lg:hidden items-center gap-x-1">
                        @csrf
                        <button type="submit" class="flex items-center gap-x-1"
                            style="background: none; border: none; padding: 0;">
                            <img src="{{ asset('dislike.png') }}" alt="" class="h-5 w-6" />
                            <span>{{ $review->total_dislikes }}</span>
                        </button>
                    </form>
                    <div class="flex lg:hidden items-center gap-x-1">
                        <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                        <span>{{ $review->comments ?? 0 }}</span>
                    </div>
                    @if ($review->images->count() > 0)
                        <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm inline-block lg:hidden">
                            {{ $review->images->count() }} фото
                        </span>
                    @endif

                </div> --}}
                <div id="mobileReviewActions" class="block md:hidden">
                    @if ($userHasReview)
                        <div>
                            <button onclick="showReviewExistsModal()"
                                class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                                <i class="mdi mdi-plus"></i>
                                Оставить отзыв
                            </button>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('review.create', ['type' => $review->reviewable_type === 'App\Models\Developer' ? 'developer' : 'complex', 'id' => $review->reviewable->id]) }}"
                                class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer inline-block text-center">
                                <i class="mdi mdi-plus"></i>
                                Оставить отзыв
                            </a>
                        </div>
                    @endif
                    <div
                        class="text-xs 2xl:text-sm tracking-wide order-4 md:order-none md:w-auto w-full md:mt-0 mt-4 md:text-left text-center">
                        Ваша компания? <a {{-- href="{{ route('gainingaccess', ['company_id' => $review->reviewable->developer->id ? $review->reviewable->developer->id : $review->reviewable->complex->developer->id]) }}"  --}}
                            href="{{ route('gainingaccess', ['company_id' => $review->reviewable_type === 'App\Models\Developer' ? $review->reviewable->id : $review->reviewable->developer->id]) }}"
                            {{-- href="#" --}} class="text-primary">Оставьте заявку</a>
                    </div>
                </div>
                {{-- /mobile --}}

                {{-- <p class="text-xs lg:text-sm tracking-wide w-full xl:w-[80%] mr-0 xl:mr-auto sm:block hidden">
                    {!! $review->reviewable->content ?? $review->reviewable->description !!}
                </p> --}}
            </div>
        </div>

        <div
            class="mt-8 w-full xl:w-[80%] mr-0 xl:mr-auto hidden sm:flex items-center justify-between md:flex-nowrap flex-wrap">
            <div
                class="text-xs 2xl:text-sm tracking-wide order-4 md:order-none md:w-auto w-full md:mt-0 mt-4 md:text-left text-center">
                Ваша компания? <a
                    href="{{ route('gainingaccess', ['company_id' => $review->reviewable_type === 'App\Models\Developer' ? $review->reviewable->id : $review->reviewable->developer->id]) }}"
                    class="text-primary">Оставьте заявку</a>
            </div>
            <div class="text-xl lg:text-3xl flex items-center w-[50%] md:w-auto order-1 md:order-0">
                <span class="pr-1">{{ $review->rating }}</span>
                <div class="flex items-center space-x-px xs:space-x-1" aria-label="{{ $review->rating }} out of 5 stars"
                    role="img">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->rating)
                            <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                                alt="" />
                        @else
                            <img src="{{ asset('icons/Stargray.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                alt="" />
                            <img src="{{ asset('icons/Stargraymini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                                alt="" />
                        @endif
                    @endfor
                </div>
            </div>
            <div class="flex items-center gap-x-2 w-[50%] md:w-auto order-2 md:order-none md:justify-start justify-end">
                <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                    {{ $review->reviewable->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->count() }}
                </span>
                <span class="text-sm tracking-wide">Отзывов</span>
            </div>
            <div class="order-3 md:order-none md:mt-0 mt-4 md:w-auto w-full">

                @if ($userHasReview)
                    <button onclick="showReviewExistsModal()"
                        class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Оставить отзыв
                    </button>
                @else
                    <a href="{{ route('review.create', ['type' => $review->reviewable_type === 'App\Models\Developer' ? 'developer' : 'complex', 'id' => $review->reviewable->id]) }}"
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

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto hidden md:flex flex-col gap-y-4">
        <div
            class="flex flex-col gap-8 px-0 py-8 md:px-8 w-full border-y lg:border border-custom-gray rounded-none lg:rounded-3xl">
            <div class="flex items-center justify-between gap-x-6">
                <div class="flex items-center gap-x-6">
                    <div class="text-xl lg:text-3xl hidden lg:flex items-center">
                        <span class="pr-1">{{ $review->rating }}</span>
                        <div class="flex items-center space-x-px xs:space-x-1"
                            aria-label="{{ $review->rating }} out of 5 stars" role="img">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                        alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}"
                                        class="min-[51.875rem]:hidden inline-block" alt="" />
                                @else
                                    <img src="{{ asset('icons/Stargray.svg') }}"
                                        class="min-[51.875rem]:inline-block hidden" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}"
                                        class="min-[51.875rem]:hidden inline-block" alt="" />
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div
                        class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white rounded-4xl px-7 py-3 text-xs tracking-wide font-bold">
                        {{ $review->type === 'positive' ? 'Положительный отзыв' : 'Негативный отзыв' }}
                    </div>
                </div>
                <div class="flex items-center gap-x-6">
                    @php
                        $userLikeStatus = Auth::check() ? $review->userLikeStatus(Auth::id()) : null;
                    @endphp
                    <div class="hidden lg:flex items-center gap-x-1">
                        <button type="button" onclick="handleLike({{ $review->id }}, 'like')"
                            class="like-btn flex items-center gap-x-1 {{ $userLikeStatus === 'like' ? 'text-green-600' : 'text-gray-600' }} hover:text-green-600 transition-colors"
                            style="background: none; border: none; padding: 0;" data-status="{{ $userLikeStatus }}">
                            <img src="{{ asset('images/like.png') }}" alt=""
                                class="cursor-pointer like-icon size-5 {{ $userLikeStatus === 'like' ? 'brightness-0 saturate-100' : '' }}"
                                style="{{ $userLikeStatus === 'like' ? 'filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);' : '' }}" />
                            <span class="like-count">{{ $review->total_likes }}</span>
                        </button>
                    </div>
                    <div class="hidden lg:flex items-center gap-x-1">
                        <button type="button" onclick="handleLike({{ $review->id }}, 'dislike')"
                            class="dislike-btn flex items-center gap-x-1 {{ $userLikeStatus === 'dislike' ? 'text-red-600' : 'text-gray-600' }} hover:text-red-600 transition-colors"
                            style="background: none; border: none; padding: 0;" data-status="{{ $userLikeStatus }}">
                            <img src="{{ asset('images/dislike.png') }}" alt=""
                                class="cursor-pointer dislike-icon h-5 w-6 {{ $userLikeStatus === 'dislike' ? 'brightness-0 saturate-100' : '' }}"
                                style="{{ $userLikeStatus === 'dislike' ? 'filter: invert(17%) sepia(90%) saturate(7471%) hue-rotate(3deg) brightness(90%) contrast(135%);' : '' }}" />
                            <span class="dislike-count">{{ $review->total_dislikes }}</span>
                        </button>
                    </div>
                    <div class="hidden lg:flex items-center gap-x-1">
                        <img src="{{ asset('images/comment.png') }}" alt="" class="size-5" />
                        <span>{{ $review->comments ?? 0 }}</span>
                    </div>
                    @if ($review->images->count() > 0)
                        <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm hidden lg:inline-block">
                            {{ $review->images->count() }} фото
                        </span>
                    @endif
                    <span class="text-sm text-text">{{ $review->created_at->format('Y/m/d') }}</span>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <div class="flex items-center gap-x-6">
                    <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                        class="size-6 md:size-20" alt="" style="border-radius: 25px;object-fit:cover" />
                    <span class="text-base font-bold text-text2">{{ $review->user->name }}</span>
                </div>
                <div class="text-xl lg:text-3xl flex lg:hidden items-center">
                    <span class="pr-1">{{ $review->rating }}</span>
                    <div class="flex items-center space-x-px xs:space-x-1"
                        aria-label="{{ $review->rating }} out of 5 stars" role="img">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                                    alt="" />
                            @else
                                <img src="{{ asset('icons/Stargray.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}"
                                    class="min-[51.875rem]:hidden inline-block" alt="" />
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

            <div class="flex lg:hidden items-center justify-between gap-x-6">
                @php
                    $userLikeStatus = Auth::check() ? $review->userLikeStatus(Auth::id()) : null;
                @endphp
                <div class="flex lg:hidden items-center gap-x-1">
                    <button type="button" onclick="handleLike({{ $review->id }}, 'like')"
                        class="like-btn flex items-center gap-x-1 {{ $userLikeStatus === 'like' ? 'text-green-600' : 'text-gray-600' }} hover:text-green-600 transition-colors"
                        style="background: none; border: none; padding: 0;" data-status="{{ $userLikeStatus }}">
                        <img src="{{ asset('images/like.png') }}" alt=""
                            class="cursor-pointer like-icon size-5 {{ $userLikeStatus === 'like' ? 'brightness-0 saturate-100' : '' }}"
                            style="{{ $userLikeStatus === 'like' ? 'filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);' : '' }}" />
                        <span class="like-count">{{ $review->total_likes }}</span>
                    </button>
                </div>
                <div class="flex lg:hidden items-center gap-x-1">
                    <button type="button" onclick="handleLike({{ $review->id }}, 'dislike')"
                        class="dislike-btn flex items-center gap-x-1 {{ $userLikeStatus === 'dislike' ? 'text-red-600' : 'text-gray-600' }} hover:text-red-600 transition-colors"
                        style="background: none; border: none; padding: 0;" data-status="{{ $userLikeStatus }}">
                        <img src="{{ asset('images/dislike.png') }}" alt=""
                            class="cursor-pointer dislike-icon h-5 w-6 {{ $userLikeStatus === 'dislike' ? 'brightness-0 saturate-100' : '' }}"
                            style="{{ $userLikeStatus === 'dislike' ? 'filter: invert(17%) sepia(90%) saturate(7471%) hue-rotate(3deg) brightness(90%) contrast(135%);' : '' }}" />
                        <span class="dislike-count">{{ $review->total_dislikes }}</span>
                    </button>
                </div>
                <div class="flex lg:hidden items-center gap-x-1">
                    <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                    <span>{{ $review->comments ?? 0 }}</span>
                </div>
                @if ($review->images->count() > 0)
                    <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm inline-block lg:hidden">
                        {{ $review->images->count() }} фото
                    </span>
                @endif
            </div>

            <h1 class="text-2xl font-bold tracking-widest text-text2">
                {{ $review->title }}
            </h1>

            <p class="text-sm font-normal text-text2">
                {{ $review->text }}
            </p>

            @if ($review->images->count() > 0)
                <div class="flex items-center gap-x-4">
                    <button
                        class="my-tocno-swiper-button-prev bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg cursor-pointer md:block hidden">
                        <i class="mdi mdi-chevron-left"></i>
                    </button>
                    <div class="swiper myTocnoSwiper relative">
                        <div class="swiper-wrapper">
                            @foreach ($review->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('reviews/' . $image->image_path) }}"
                                        class="rounded-xl w-full max-h-[18.75rem] h-auto" alt="" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button
                        class="my-tocno-swiper-button-next bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg cursor-pointer md:block hidden">
                        <i class="mdi mdi-chevron-right"></i>
                    </button>
                </div>
            @endif

            <div class="text-xs font-normal tracking-wider text-text xl:text-sm text-right">
                {{ $review->approval_status }}
            </div>
        </div>
    </div>

    <!-- Mobile version -->
    <div class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto flex sm:hidden flex-col gap-y-8">
        <div class="border rounded-2xl border-custom-gray p-4">
            <div class="font-bold text-[1rem] tracking-wide text-text">
                {{ $review->title }}
            </div>
            <hr class="my-2 border-custom-gray" />
            <p class="text-sm text-text2">
                {{ $review->text }}
            </p>
            <hr class="my-2 border-custom-gray" />

            @if ($review->images->count() > 0)
                <div class="my-4">
                    @foreach ($review->images as $image)
                        <img src="{{ asset('storage/reviews/' . $image->image_path) }}" class="rounded-xl w-full mb-2"
                            alt="" />
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Mobile Review Button -->
        <div class="text-center">
            @php
                $userHasReview =
                    Auth::check() &&
                    \App\Models\Review::where('user_id', Auth::id())
                        ->where('reviewable_id', $review->reviewable->id)
                        ->where('reviewable_type', get_class($review->reviewable))
                        ->exists();
            @endphp

            @if ($userHasReview)
                <button onclick="showReviewExistsModal()"
                    class="w-full border-primary text-sm border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                    <i class="mdi mdi-plus"></i>
                    Оставить отзыв
                </button>
            @else
                <a href="{{ route('review.create', ['type' => $review->reviewable_type === 'App\Models\Developer' ? 'developer' : 'complex', 'id' => $review->reviewable->id]) }}"
                    class="w-full border-primary text-sm border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer inline-block text-center">
                    <i class="mdi mdi-plus"></i>
                    Оставить отзыв
                </a>
            @endif
        </div>
    </div>

    <!-- Review Exists Modal -->
    @include('inc.reviewExistsModal')

    <script>
        function showReviewExistsModal() {
            const modal = document.getElementById('reviewExistsModal');
            const modalContent = document.getElementById('reviewExistsModalContent');

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling

            requestAnimationFrame(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeReviewExistsModal() {
            const modal = document.getElementById('reviewExistsModal');
            const modalContent = document.getElementById('reviewExistsModalContent');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = ''; // Restore scrolling
            }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('reviewExistsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReviewExistsModal();
            }
        });

        // Close modal when pressing ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('reviewExistsModal').classList.contains('hidden')) {
                closeReviewExistsModal();
            }
        });

        // Handle like/dislike with fetch
        async function handleLike(reviewId, type) {
            try {
                const response = await fetch(`/review/${reviewId}/${type}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Update all like buttons
                    const likeButtons = document.querySelectorAll('.like-btn');
                    const dislikeButtons = document.querySelectorAll('.dislike-btn');

                    likeButtons.forEach(btn => {
                        const icon = btn.querySelector('.like-icon');
                        const count = btn.querySelector('.like-count');

                        // Update count
                        count.textContent = data.totalLikes;

                        // Update visual state
                        if (data.userLikeStatus === 'like') {
                            btn.classList.remove('text-gray-600');
                            btn.classList.add('text-green-600');
                            icon.classList.add('brightness-0', 'saturate-100');
                            icon.style.filter =
                                'invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%)';
                        } else {
                            btn.classList.remove('text-green-600');
                            btn.classList.add('text-gray-600');
                            icon.classList.remove('brightness-0', 'saturate-100');
                            icon.style.filter = '';
                        }

                        btn.setAttribute('data-status', data.userLikeStatus || '');
                    });

                    dislikeButtons.forEach(btn => {
                        const icon = btn.querySelector('.dislike-icon');
                        const count = btn.querySelector('.dislike-count');

                        // Update count
                        count.textContent = data.totalDislikes;

                        // Update visual state
                        if (data.userLikeStatus === 'dislike') {
                            btn.classList.remove('text-gray-600');
                            btn.classList.add('text-red-600');
                            icon.classList.add('brightness-0', 'saturate-100');
                            icon.style.filter =
                                'invert(17%) sepia(90%) saturate(7471%) hue-rotate(3deg) brightness(90%) contrast(135%)';
                        } else {
                            btn.classList.remove('text-red-600');
                            btn.classList.add('text-gray-600');
                            icon.classList.remove('brightness-0', 'saturate-100');
                            icon.style.filter = '';
                        }

                        btn.setAttribute('data-status', data.userLikeStatus || '');
                    });

                    // Show success message (optional)
                    // You can add a toast notification here if needed
                    console.log(data.message);

                } else {
                    // Handle error
                    if (response.status === 401) {
                        // Redirect to login
                        window.location.href = '/login';
                    } else {
                        alert(data.message || 'Произошла ошибка');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Произошла ошибка при обработке запроса');
            }
        }
    </script>
@endsection
