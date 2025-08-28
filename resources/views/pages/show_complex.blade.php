@extends('layouts.app')

@section('title', $complex->name . ' | Сказокнет')

@section('content')
    <?php
    $const_complex = $complex;
    ?>
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
                <h1 class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
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
                {{-- @if ($averageRating > 0) --}}
                {{-- <x-star-rating :rating="$averageRating" size="large" /> --}}
                @include('inc.star_rating', [
                    'type' => 'complex',
                    'main' => 'true',
                    'width' => '40px',
                    'height' => '40px',
                    'star_count_class' => 'pr-1',
                ])
                {{-- @else --}}
                {{-- <span class="text-gray-500 text-sm">Нет оценок</span> --}}
                {{-- @endif --}}
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
    </script>

    <div class="my-20 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:block hidden">
        <div class="flex justify-between flex-col lg:flex-row gap-8 lg:gap-12 h-full">
            <div class="max-w-full lg:max-w-[calc(55%-1.5rem)] w-full h-full">
                <div class="swiper mySwiper relative">
                    <div class="swiper-wrapper">
                        @if ($complex->images()->count() > 0)
                            @foreach ($complex->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('complex-images/' . $image->image) }}"
                                        class="rounded-xl w-full h-auto" alt="" style="height: 368px;" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="my-swiper-button-prev absolute left-4 top-1/2 z-10 cursor-pointer">
                        <button class="bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg">
                            <i class="mdi mdi-chevron-left"></i>
                        </button>
                    </div>
                    <div class="my-swiper-button-next absolute right-4 top-1/2 z-10 cursor-pointer">
                        <button class="bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg">
                            <i class="mdi mdi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-[calc(45%-1.5rem)] h-[25rem] lg:h-auto">
                <div class="rounded-xl w-full h-full bg-gray-300 flex items-center justify-center">
                    {{-- map --}}
                    @if ($complex->map_x && $complex->map_y)
                        <div id="map" style="width: 100%; height: 368px; border-radius: 12px;"></div>
                    @else
                        <img src="{{ asset('images/map.png') }}" class="w-full rounded-xl" alt=""
                            style="height: 368px; object-fit: cover;" />
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="md:hidden block">
        <div class="swiper mySwiper relative">
            <div class="swiper-wrapper">
                @if ($complex->images()->count() > 0)
                    @foreach ($complex->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('complex-images/' . $image->image) }}" class="w-full h-full object-cover"
                                style="height: 300px;" alt="{{ $complex->name }}" />
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="swiper-pagination bg-white !w-auto !left-[40%] md:!left-[45%] rounded-lg px-2 !bottom-12"></div>
            <div class="absolute right-4 top-4 z-10">
                <img src="{{ asset('complex-small/' . $complex->image) }}" alt=""
                    style="width: 100px;border-radius:10px;" />
            </div>
        </div>
        <div class="bg-white rounded-tl-3xl rounded-tr-3xl -mt-8 relative z-10">
            <div class="p-8">
                <h1 class="font-bold text-lg tracking-wider">
                    @if ($complex->type == 'residential')
                        Жилой комплекс
                    @endif
                    @if ($complex->type == 'hotel')
                        Гостиничные комплекс
                    @endif «{{ $complex->name }}», {{ $city->text }}
                </h1>
                <h4 class="text-sm font-medium mt-3 text-text3">
                    {{ $complex->address }}
                </h4>
                <div class="font-semibold text-sm tracking-wide mt-3">
                    Застройщик: <span class="text-primary">{{ $complex->developer->name }}</span>
                </div>
                <hr class="border-auth-input-border-color my-4" />
                <p class="text-sm">
                    {!! $complex->content !!}
                </p>
                <div class="flex items-center justify-between my-4">
                    {{-- <div class="text-xl flex items-center w-full">
                        @if ($averageRating > 0)
                            <x-star-rating :rating="$averageRating" size="normal" />
                        @else
                            <span class="text-gray-500 text-sm">Нет оценок</span>
                        @endif
                    </div> --}}
                    @include('inc.star_rating', [
                        'type' => 'complex',
                        'main' => 'true',
                        'width' => '27px',
                        'height' => '27px',
                        'star_count_class' => 'pr-1',
                    ])
                    <div>
                        @if ($complex->popular == '1')
                            <span
                                style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
                        @endif
                    </div>
                    <span class="bg-primary text-white py-2 px-3 rounded-lg text-sm whitespace-nowrap">
                        {{ $totalReviews }} Отзывов
                    </span>
                </div>
            </div>
            <div class="h-[20rem] w-full flex items-center justify-center" style="margin-bottom: 10px;">
                @if ($complex->map_x && $complex->map_y)
                    <div id="map-mobile" style="width: 100%; height: 20rem;"></div>
                @else
                    <div class="text-gray-500">Карта недоступна</div>
                @endif
            </div>
            @if ($userHasReview)
                <div class="w-full flex items-center justify-center">
                    <button onclick="showReviewExistsModal()"
                        class="md:w-auto w-[90%] border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Оставить отзыв
                    </button>
                </div>
            @else
                <div class="w-full flex items-center justify-center">
                    <a href="{{ route('review.create', ['type' => 'complex', 'id' => $complex->id]) }}"
                        class="md:w-auto w-[90%] border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer inline-block text-center">
                        <i class="mdi mdi-plus"></i>
                        Оставить отзыв
                    </a>
                </div>
            @endif
            {{-- <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0 flex justify-center items-center text-center">
                    <a href="#"
                        class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                        Оставить отзыв
                    </a>
                </div> --}}
            <div
                class="text-xs 2xl:text-sm tracking-wide order-4 md:order-none md:w-auto w-full md:mt-0 mt-4 md:text-left text-center">
                Ваша компания? <a href="{{ route('gainingaccess', ['company_id' => $complex->developer->id]) }}"
                    class="text-primary">Оставьте заявку</a>
            </div>
        </div>
    </div>

    <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-20">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                Отзывы @if ($complex->type == 'residential')
                    ЖК
                @endif
                @if ($complex->type == 'hotel')
                    ГК
                @endif «{{ $complex->name }}» {{ $city->text }}
            </h1>
            <div class="hidden items-center gap-x-2 md:flex">
                <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                    {{ $totalReviews }}</span>
                <span class="text-sm tracking-wide">Отзывов</span>
            </div>
        </div>
        @if ($totalReviews > 0)
            <div class="hidden sm:flex gap-8 flex-wrap">
                @foreach ($reviews as $review)
                    @include('inc.review_card', ['review' => $review])
                @endforeach
            </div>
            <div class="mt-8 block sm:hidden">
                <div class="swiper krasnodor3Swiper relative">
                    <div class="swiper-wrapper">
                        @foreach ($reviews as $review)
                            @include('inc.mb_review_card', ['review' => $review])
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="flex itemx-center justify-center">
                Нет отзывы
            </div>
        @endif

    </section>


    @if ($residential_complexes->count() > 0)
        <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-20">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                    Другие жилые комплексы «{{ $complex->developer->name }}»
                </h1>
                {{-- <a href="{{ route('complexes', 'residential') }}?developer_slug={{ $complex->developer->slug }}"
                    class="md:inline-block hidden">Все жилые комплексы</a> --}}
            </div>
            <div class="hidden sm:flex gap-8 flex-wrap">
                @foreach ($residential_complexes as $complex)
                    @include('inc.pc_card_complex')
                @endforeach
            </div>
            <div class="mt-8 block sm:hidden">
                <div class="swiper krasnodorSwiper relative">
                    <div class="swiper-wrapper">
                        @foreach ($residential_complexes as $complex)
                            @include('inc.mobile_card_complex')
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0 flex justify-center items-center text-center">
                <a href="{{ route('complexes', 'residential') }}?developer_slug={{ $complex->developer->slug }}"
                    class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                    Все жилые комплексы
                </a>
            </div> --}}
        </section>
    @endif

    @if ($hotel_complexes->count() > 0)
        <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-20">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                    Другие гостиничные комплексы «{{ $complex->developer->name }}»
                </h1>
                {{-- <a href="{{ route('complexes', 'hotel') }}?developer_slug={{ $complex->developer->slug }}"
                    class="md:inline-block hidden">Все гостиничные комплексы</a> --}}
            </div>
            <div class="hidden sm:flex gap-8 flex-wrap">
                @foreach ($hotel_complexes as $complex)
                    @include('inc.pc_card_complex')
                @endforeach
            </div>
            <div class="mt-8 block sm:hidden">
                <div class="swiper krasnodorSwiper relative">
                    <div class="swiper-wrapper">
                        @foreach ($hotel_complexes as $complex)
                            @include('inc.mobile_card_complex')
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0 flex justify-center items-center text-center">
                <a href="{{ route('complexes', 'hotel') }}?developer_slug={{ $complex->developer->slug }}"
                    class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                    Все гостиничные комплексы
                </a>
            </div> --}}
        </section>
    @endif
@endsection

@section('script')
    {{-- @if ($complex->map_x && $complex->map_y) --}}
    <script src="https://api-maps.yandex.ru/2.1/?apikey=533e70a2-eeb0-4f97-95e4-e6f35dda4aed&lang=ru_RU"
        type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(function() {
            // Desktop map
            if (document.getElementById('map')) {
                // Eğer harita zaten varsa temizle
                document.getElementById('map').innerHTML = '';

                var myMap = new ymaps.Map("map", {
                    center: [`{{ $const_complex->map_x }}`, `{{ $const_complex->map_y }}`],
                    zoom: 16,
                    controls: ['zoomControl', 'fullscreenControl', 'typeSelector']
                });

                var myPlacemark = new ymaps.Placemark([`{{ $const_complex->map_x }}`,
                    `{{ $const_complex->map_y }}`
                ], {
                    balloonContent: '<div style="padding: 10px; font-family: Arial, sans-serif;"><strong style="color: #333;">{{ $const_complex->name }}</strong><br><small style="color: #666;">{{ $const_complex->address }}</small></div>',
                    hintContent: '{{ $const_complex->name }}'
                }, {
                    preset: 'islands#redBuildingIcon',
                    iconColor: '#dc2626'
                });

                myMap.geoObjects.add(myPlacemark);
            }

            // Mobile map
            if (document.getElementById('map-mobile')) {
                // Eğer harita zaten varsa temizle
                document.getElementById('map-mobile').innerHTML = '';

                var myMapMobile = new ymaps.Map("map-mobile", {
                    center: [`{{ $const_complex->map_x }}`, `{{ $const_complex->map_y }}`],
                    zoom: 16,
                    controls: ['zoomControl', 'typeSelector']
                });

                var myPlacemarkMobile = new ymaps.Placemark([`{{ $const_complex->map_x }}`,
                    `{{ $const_complex->map_y }}`
                ], {
                    balloonContent: '<div style="padding: 10px; font-family: Arial, sans-serif;"><strong style="color: #333;">{{ $const_complex->name }}</strong><br><small style="color: #666;">{{ $const_complex->address }}</small></div>',
                    hintContent: '{{ $const_complex->name }}'
                }, {
                    preset: 'islands#redBuildingIcon',
                    iconColor: '#dc2626'
                });

                myMapMobile.geoObjects.add(myPlacemarkMobile);
            }
        });
    </script>
    {{-- @endif --}}
@endsection
