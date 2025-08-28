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
                <h1
                    class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto mt-2">
                    @if ($review->reviewable_type === 'App\Models\Developer')
                        Строительная компания «{{ $review->reviewable->name }}», {{ $city->developer_text }}
                    @else
                        @if ($review->reviewable->type == 'residential')
                            Жилой комплекс «{{ $review->reviewable->name }}», {{ $city->text }}
                        @else
                            Гостиничный комплекс «{{ $review->reviewable->name }}», {{ $city->text }}
                        @endif
                    @endif
                </h1>
                @if ($review->reviewable_type === 'App\Models\Developer')
                    @php
                        $developer = $review->reviewable;
                    @endphp
                    {{-- <div class="font-semibold text-sm tracking-wide">
                        Застройщик: <span class="text-primary">{{ $review->reviewable->name }}</span>
                    </div> --}}
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
                    <hr class="md:hidden border-auth-input-border-color" />
                    <div class="hidden sm:block text-xs lg:text-sm tracking-wide w-full xl:w-[80%] mr-0 xl:mr-auto">
                        {!! $review->reviewable->content !!}
                    </div>
                @else
                    @php
                        $developer = $review->reviewable->developer;
                    @endphp
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
            </div>
        </div>
        <div class="mt-8 w-full xl:w-[80%] mr-0 xl:mr-auto flex items-center justify-between md:flex-nowrap flex-wrap">
            <div
                class="text-xs 2xl:text-sm tracking-wide order-4 md:order-none md:w-auto w-full md:mt-0 mt-4 md:text-left text-center">
                Ваша компания?
                <a href="{{ route('gainingaccess', ['company_id' => $review->reviewable_type === 'App\Models\Developer' ? $review->reviewable->id : $review->reviewable->developer->id]) }}"
                    class="text-primary">Оставьте заявку</a>
            </div>
            <div class="text-xl lg:text-3xl pl-2 flex items-center w-[50%] md:w-auto order-1 md:order-0">
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
                    {{ $review->reviewable->reviews()->where('is_approved', true)->count() }}
                </span>
                <span class="text-sm tracking-wide">Отзывов</span>
            </div>
            {{-- <div class="order-3 md:order-none md:mt-0 mt-4 md:w-auto w-full">
                <button
                    class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                    <i class="mdi mdi-plus"></i>
                    Оставить отзыв
                </button>
            </div> --}}
            @if ($userHasReview)
                <div class="order-3 md:order-none md:mt-0 mt-4 md:w-auto w-full">
                    <button onclick="showReviewExistsModal()"
                        class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Оставить отзыв
                    </button>
                </div>
            @else
                <div class="order-3 md:order-none md:mt-0 mt-4 md:w-auto w-full">
                    <a href="{{ route('review.create', ['type' => $review->reviewable_type === 'App\Models\Developer' ? 'developer' : 'complex', 'id' => $review->reviewable->id]) }}"
                        class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer inline-block text-center">
                        <i class="mdi mdi-plus"></i>
                        Оставить отзыв
                    </a>
                </div>
            @endif
        </div>

        <button onclick="window.history.back()"
            class="absolute right-12 top-4 z-10 rounded-full px-2 py-1 bg-custom-gray-2 cursor-pointer text-white md:hidden block">
            <i class="mdi mdi-chevron-left"></i>
        </button>
    </div>

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto flex flex-col gap-y-4">
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
                        <span>{{ $review->comments()->count() ?? 0 }}</span>
                    </div>
                    {{-- @if ($review->images->count() > 0)
                        <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm hidden lg:inline-block">
                            {{ $review->images->count() }} фото
                        </span>
                    @endif --}}
                    <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm hidden lg:inline-block">
                        17 Дополнений
                    </span>
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

            <div class="flex items-center justify-between gap-x-6">
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
                    <img src="{{ asset('images/comment.png') }}" alt="" class="size-5" />
                    <span>{{ $review->comments()->count() ?? 0 }}</span>
                </div>
                {{-- @if ($review->images->count() > 0)
                    <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm hidden lg:inline-block">
                        {{ $review->images->count() }} фото
                    </span>
                @endif --}}
                <span class="bg-primary text-white py-1 px-3 rounded-2xl text-sm inline-block lg:hidden">
                    17 Дополнений
                </span>
            </div>

            <h1 class="text-2xl font-bold tracking-widest text-text2">
                Отзыв:
                @if ($review->reviewable_type === 'App\Models\Developer')
                    Строительная компания «{{ $review->reviewable->name }}»
                @else
                    @if ($review->reviewable->type == 'residential')
                        Жилой комплекс «{{ $review->reviewable->name }}»
                    @else
                        Гостиничный комплекс «{{ $review->reviewable->name }}»
                    @endif
                @endif
                — {{ $review->title }}
            </h1>

            <p class="text-sm font-normal text-text2">
                {{ $review->text }}
            </p>

            @if ($review->images->count() > 0)
                <div class="flex items-center gap-x-4 max-w-full">
                    <button
                        class="my-tocno-swiper-button-prev bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg cursor-pointer md:block hidden">
                        <i class="mdi mdi-chevron-left"></i>
                    </button>
                    <div class="swiper myTocnoSwiper relative">
                        <div class="swiper-wrapper">
                            @foreach ($review->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('reviews/' . $image->image_path) }}"
                                        class="rounded-xl w-full max-h-[18.75rem] max-w-[19rem] h-auto" alt="" />
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('images/image6.png') }}"
                                    class="rounded-xl w-full max-h-[18.75rem] h-auto" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/image6.png') }}"
                                    class="rounded-xl w-full max-h-[18.75rem] h-auto" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/image6.png') }}"
                                    class="rounded-xl w-full max-h-[18.75rem] h-auto" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/image6.png') }}"
                                    class="rounded-xl w-full max-h-[18.75rem] h-auto" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/image6.png') }}"
                                    class="rounded-xl w-full max-h-[18.75rem] h-auto" alt="" />
                            </div>
                        </div> --}}
                    </div>

                    <button
                        class="my-tocno-swiper-button-next bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg cursor-pointer md:block hidden">
                        <i class="mdi mdi-chevron-right"></i>
                    </button>
                </div>
            @endif
            <div class="text-xs font-normal tracking-wider text-text xl:text-sm text-right">
                {{ $review->is_approved ? 'Одобрен' : 'На модерации' }}
            </div>
        </div>

        @include('inc.reviewExistsModal')



        @if (isset($review->official_response))
            @php
                $official_response = $review->official_response;
            @endphp
            <div
                class="rounded-2xl border-2 border-custom-gray hover:border-primary hover:shadow-md transition-all duration-300 ease-in-out p-4">
                <div class="flex items-center justify-between sm:flex-row flex-col gap-4">
                    <div class="flex items-center gap-x-4">
                        <div class="w-15 h-9 border border-custom-gray flex items-center justify-center">
                            <img src="{{ isset($official_response->user->developer->image) ? asset('developer-small/' . $official_response->user->developer->image) : asset('images/tocnomini.png') }}"
                                class="w-[70%] mx-auto h-auto" alt="" />
                        </div>
                        <div
                            class="text-xs font-medium tracking-wider text-text2 sm:inline-block sm:flex-row flex flex-col">
                            <span>Официальный ответ</span>
                            <span class="px-2 sm:inline hidden">|</span>
                            <span>Застройщик: <a
                                    href="{{ route('show.developer', $official_response->user->developer->slug) }}"
                                    class="text-primary">{{ $official_response->user->developer->name }}</a></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-4 text-sm tracking-wide">
                        <span
                            class="text-text">{{ $official_response->user->developer->created_at->format('Y/m/d') }}</span>
                        <div class="flex items-center gap-x-1">
                            <img src="{{ asset('images/like.png') }}" alt="" class="size-5" />
                            <span>{{ $official_response->likes }}</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="{{ asset('images/dislike.png') }}" alt="" class="h-5 w-6" />
                            <span>{{ $official_response->dislikes }}</span>
                        </div>
                    </div>
                </div>
                <hr class="mt-6 sm:hidden flex border-custom-gray" />
                <p class="text-sm font-normal mt-6 text-text2 h-[2.5rem] overflow-hidden transition-all duration-300 ease-in-out"
                    id="collapse-content-100">
                    {{ $official_response->text }}
                    @if ($official_response->images->count() > 0)
                        <div class="flex items-center gap-x-4 max-w-full mt-3">
                            <button
                                class="my-tocno-swiper-button-prev bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg cursor-pointer md:block hidden">
                                <i class="mdi mdi-chevron-left"></i>
                            </button>
                            <div class="swiper myTocnoSwiper relative">
                                <div class="swiper-wrapper">
                                    @foreach ($official_response->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('reviews/' . $image->image) }}"
                                                class="rounded-xl w-full max-h-[18.75rem] max-w-[19rem] h-auto"
                                                alt="" />
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
                </p>
                <hr class="mt-6 sm:hidden flex border-custom-gray" />

                <button class="mt-4 float-right tracking-wide text-xs flex items-center gap-x-2 cursor-pointer"
                    id="collapse-button-100" onclick="toggleCollapse('#collapse-content-100', '#collapse-button-100')">
                    <span>Развернуть</span>
                    <img src="{{ asset('icons/down.svg') }}" alt="" />
                </button>
            </div>
        @endif

        @if (!isset($review->official_response) && $developer->user_id == @auth()->user()->id)
            <form action="{{ route('post.official_response', $review) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="rounded-2xl border-primary border-2 p-6 shadow-md">
                    <div class="flex flex-col gap-4">
                        <h1
                            class="tracking-widest text-xl lg:text-2xl xl:text-3xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto __web-inspector-hide-shortcut__">
                            Официальный ответ
                        </h1>
                        <div class="flex flex-col gap-2">
                            <span class="text-input-divider text-xs font-normal tracking-wide">Текст ответа:</span>
                            <textarea rows="6" name="text"
                                class="rounded-2xl w-full border border-auth-input-border-color outline-none p-4"></textarea>

                            <div class="w-full" id="imagePreviewContainer">
                                <!-- Image previews will be added here -->
                            </div>

                            <div class="flex items-center w-full justify-end">
                                <input type="file" name="images[]" class="hidden" id="imageInput" multiple
                                    accept="image/*">
                                <button type="button" onclick="document.getElementById('imageInput').click()"
                                    class="border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                                    <i class="mdi mdi-plus"></i>
                                    Загрузить изображение
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="w-full text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-6.5">
                    Опубликовать ответ
                </button>
            </form>
        @endif
    </div>

    <div class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto flex flex-col gap-y-8">
        <div class="flex flex-col gap-y-6">
            <div class="flex items-center sm:justify-start justify-between gap-x-2">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wider">
                    Дополнения к отзыву
                </h1>
                <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                    {{ $review->additions()->approved()->count() }}</span>
                <span class="text-sm tracking-wide sm:inline hidden">Дополнений</span>
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($review->additions()->approved()->get() as $addition)
                    @include('inc.addition_item')
                @endforeach
            </div>
        </div>
    </div>

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto flex flex-col gap-y-8">
        <div class="flex flex-col gap-y-6">
            <div class="flex items-center sm:justify-start justify-between gap-x-2">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wider">
                    Комментарии к отзыву
                </h1>
                <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                    {{ $review->comments()->count() }}</span>
                {{-- <span class="text-sm tracking-wide sm:inline hidden">Дополнений</span> --}}
            </div>

            <div class="flex flex-col gap-4">
                @foreach ($review->comments()->get() as $comment)
                    @include('inc.review_comment_item')
                @endforeach
            </div>
            <div id="rc-input" style="display:none;">
                <input id="rc-text" type="text" placeholder="Введите текст комментария"
                    class="w-full rounded-3xl border border-primary px-4 py-3 outline-none focus:outline-none focus:ring-0 focus:border-primary" />
            </div>
            <div class="flex items-center justify-start sm:justify-end">
                <button id="rc-btn" data-auth="{{ auth()->check() ? '1' : '0' }}"
                    data-login-url="{{ route('login') }}" data-post-url="{{ route('reviews.comments.store', $review) }}"
                    type="button"
                    class="flex items-center sm:justify-start justify-center gap-x-2 px-10 w-full group py-3.5 rounded-3xl border border-primary text-primary sm:w-max text-sm hover:bg-primary hover:text-white transition-all duration-300 ease-in-out cursor-pointer hover:shadow-lg">
                    <img src="{{ asset('icons/comment_blue.svg') }} " class="group-hover:hidden block" alt="" />
                    <img src="{{ asset('icons/comment_white.svg') }}" class="hidden group-hover:block" alt="" />

                    <span>Оставить свой комментарий</span>
                </button>
            </div>
        </div>
    </div>
    <style>
        .review-type-btn.active.positive {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }

        .review-type-btn.active.negative {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .star.inactive {
            filter: grayscale(100%);
        }

        .image-preview {
            position: relative;
            display: inline-block;
            margin: 5px;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e5e7eb;
        }

        .image-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image upload preview
            const imageInput = document.getElementById('imageInput');
            const previewContainer = document.getElementById('imagePreviewContainer');

            imageInput.addEventListener('change', function() {
                const files = Array.from(this.files);

                files.forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.createElement('div');
                            preview.className = 'image-preview';
                            preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-btn" onclick="removeImage(this)">×</button>
                    `;
                            previewContainer.appendChild(preview);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });

        function removeImage(btn) {
            btn.parentElement.remove();
            // Reset file input to allow re-selection
            const imageInput = document.getElementById('imageInput');
            imageInput.value = '';
        }
    </script>
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

    {{-- <script>
        (function() {
            const btn = document.getElementById('rc-btn');
            const wrap = document.getElementById('rc-input');
            const input = document.getElementById('rc-text');
            if (!btn || !wrap || !input) return;

            // Yorum listesinin kapsayıcısı: rc-input'ın bir önceki kardeşi
            const list = wrap.previousElementSibling;

            const TEXT_DEFAULT = 'Оставить свой комментарий';
            const TEXT_SEND = 'Отправить';

            // Butondaki <span> metnini değiştir (ikonlara dokunma)
            function setBtnLabel(label) {
                const span = btn.querySelector('span');
                if (span) span.textContent = label;
            }

            function csrf() {
                const el = document.querySelector('meta[name="csrf-token"]');
                return el ? el.getAttribute('content') : '';
            }

            async function postJson(url, body) {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrf(),
                    },
                    body: JSON.stringify(body),
                    credentials: 'same-origin',
                });
                const ctype = res.headers.get('content-type') || '';
                if (!ctype.includes('application/json')) {
                    // HTML döndüyse hata ver (login/redirect/validation vb.)
                    const text = await res.text();
                    throw new Error('JSON bekleniyordu. ' + res.status + ': ' + text.slice(0, 200));
                }
                const data = await res.json();
                if (!res.ok || !data?.success) {
                    throw new Error(data?.message || ('Hata (' + res.status + ')'));
                }
                return data;
            }

            // İlk hal
            setBtnLabel(TEXT_DEFAULT);
            wrap.style.display = 'none';

            // Buton davranışı
            btn.addEventListener('click', async () => {
                const hidden = wrap.style.display === 'none' || wrap.style.display === '';

                // Kapalıysa: aç ve "Отправить" yap
                if (hidden) {
                    wrap.style.display = 'block';
                    setBtnLabel(TEXT_SEND);
                    input.focus();
                    return;
                }

                // Açıksa: gönder
                const text = (input.value || '').trim();

                // Boşsa: iptal et, kapat, metni geri al
                if (!text) {
                    wrap.style.display = 'none';
                    setBtnLabel(TEXT_DEFAULT);
                    return;
                }

                btn.disabled = true;
                try {
                    const url = btn.dataset.postUrl;
                    const data = await postJson(url, {
                        text
                    });

                    // Geri dönen HTML'i (inc.review_comment_item) en üste ekle
                    if (data.html && list) {
                        list.insertAdjacentHTML('afterbegin', data.html);
                    }

                    // Temizle ve kapat
                    input.value = '';
                    wrap.style.display = 'none';
                    setBtnLabel(TEXT_DEFAULT);
                } catch (e) {
                    alert(e.message || 'Ошибка');
                } finally {
                    btn.disabled = false;
                }
            });

            // Enter ile gönder
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') btn.click();
            });
        })();
    </script> --}}
    <script>
        (function() {
            const btn = document.getElementById('rc-btn');
            const wrap = document.getElementById('rc-input');
            const input = document.getElementById('rc-text');
            if (!btn || !wrap || !input) return;

            const TEXT_DEFAULT = 'Оставить свой комментарий';
            const TEXT_SEND = 'Отправить';

            function setBtnLabel(t) {
                const s = btn.querySelector('span');
                if (s) s.textContent = t;
            }

            function csrf() {
                const el = document.querySelector('meta[name="csrf-token"]');
                return el ? el.getAttribute('content') : '';
            }
            async function postJson(url, body) {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrf()
                    },
                    body: JSON.stringify(body),
                    credentials: 'same-origin'
                });
                const ctype = res.headers.get('content-type') || '';
                if (!ctype.includes('application/json')) {
                    const text = await res.text();
                    throw new Error('JSON bekleniyordu. ' + res.status + ': ' + text.slice(0, 200));
                }
                const data = await res.json();
                if (!res.ok || !data?.success) throw new Error(data?.message || ('Hata (' + res.status + ')'));
                return data;
            }

            setBtnLabel(TEXT_DEFAULT);
            wrap.style.display = 'none';

            btn.addEventListener('click', async () => {
                // 1) Auth değilse login’e git
                if (btn.dataset.auth !== '1') {
                    window.location.href = btn.dataset.loginUrl;
                    return;
                }

                // 2) Toggle + gönderim
                const hidden = wrap.style.display === 'none' || wrap.style.display === '';
                if (hidden) {
                    wrap.style.display = 'block';
                    setBtnLabel(TEXT_SEND);
                    input.focus();
                    return;
                }

                const text = (input.value || '').trim();
                if (!text) {
                    wrap.style.display = 'none';
                    setBtnLabel(TEXT_DEFAULT);
                    return;
                }

                btn.disabled = true;
                try {
                    const data = await postJson(btn.dataset.postUrl, {
                        text
                    });
                    // yorum parçasını liste başına ekle (mevcut liste wrapper’ınız rc-input’ın üstündeki div)
                    const list = wrap.previousElementSibling;
                    if (data.html && list) list.insertAdjacentHTML('afterbegin', data.html);
                    input.value = '';
                    wrap.style.display = 'none';
                    setBtnLabel(TEXT_DEFAULT);
                } catch (e) {
                    alert(e.message || 'Ошибка');
                } finally {
                    btn.disabled = false;
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') btn.click();
            });
        })();
    </script>
@endsection
