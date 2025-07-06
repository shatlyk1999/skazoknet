<section class="xl:container px-0 sm:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
    <div class="px-8 xs:px-12 sm:px-0 flex items-center justify-between mb-8">
        <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
            Жилые комплексы в {{ $city->name }}(е)
        </h1>
        <a href="#" class="md:inline-block hidden">Все жилые комплексы</a>
    </div>
    <div class="hidden sm:flex gap-8 flex-wrap">
        @foreach ($complexes as $key => $complex)
            <div onclick="handleCardClick(event, this)"
                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                <div>
                    @if ($complex->image != null)
                        <img src="{{ asset('complex/' . $complex->image) }}" class="w-full h-auto min-h-[10.625rem]"
                            alt="" style="border-top-left-radius: 10px;border-top-right-radius:10px;" />
                    @else
                        <img src="{{ asset('images/image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                            alt="" />
                    @endif
                </div>
                <div
                    class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                    <h2 class="font-semibold text-lg">
                        {{ $complex->name }}
                    </h2>
                    <p>
                        {{ $complex->address }}
                    </p>
                    <p class="mt-8">Застройщик: {{ $complex->city->name }}</p>
                    <div class="flex items-center justify-between gap-x-2">
                        <div class="flex md:flex-col gap-2 flex-row justify-between w-full md:w-auto">
                            <div class="flex items-center space-x-px xs:space-x-px" aria-label="3 out of 5 stars"
                                role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                            </div>
                            <div class="text-primary text-sm">
                                115/<span class="text-red-500">15</span>
                            </div>
                        </div>
                        {{-- <div class="group-hover:hidden">
                                    <button
                                    class="border-primary border text-xs xl:text-sm rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
                                    <!-- <i class="mdi mdi-plus"></i> -->
                                    <img src="../public/icons/Vector.svg" alt="" />
                                    <span>Оставить отзыв</span>
                                </button>
                            </div> --}}
                    </div>
                </div>
                <div class="absolute top-4 right-4 z-10">
                    <span class="bg-primary text-white py-2 px-3 rounded-lg text-xs xs:text-sm">
                        115 Отзывов
                    </span>
                </div>
                <div data-id="overlay" data-card-overlay-id="11"
                    class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all pointer-events-none group-hover:pointer-events-auto">
                    <div class="flex flex-col gap-2 items-center">
                        <a href="#"> Узнать подробнее</a>
                        {{-- <button
                                onclick="handleOverlayButtonClick(event, '11')"
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-8 block sm:hidden">
        <div class="swiper krasnodorSwiper relative !px-8 xs:!px-12 sm:!px-0">
            <div class="swiper-wrapper">
                @foreach ($complexes as $key => $complex)
                    <div class="swiper-slide" onclick="handleCardClick(event, this)">
                        <div
                            class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                            <div>
                                @if ($complex->image != null)
                                    <img src="{{ asset('complex/' . $complex->image) }}"
                                        class="w-full h-auto min-h-[10.625rem]" alt=""
                                        style="border-top-left-radius: 10px;border-top-right-radius:10px;" />
                                @else
                                    <img src="{{ asset('images/image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                                        alt="" />
                                @endif
                            </div>
                            <div
                                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                                <h2 class="font-semibold text-lg">
                                    {{ $complex->name }}
                                </h2>
                                <p>
                                    {{ $complex->address }}
                                </p>
                                <p class="mt-8">Застройщик: {{ $complex->city->name }}</p>
                                <div class="flex items-center justify-between gap-x-2">
                                    <div class="flex md:flex-col gap-2 flex-row justify-between w-full md:w-auto">
                                        <div class="flex items-center space-x-px xs:space-x-1"
                                            aria-label="3 out of 5 stars" role="img">
                                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                        </div>
                                        <div class="text-primary text-sm">
                                            115/<span class="text-red-500">15</span>
                                        </div>
                                    </div>
                                    <div class="group-hover:hidden">
                                        <button
                                            class="border-primary border text-xs xl:text-sm rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
                                            {{-- <!-- <i class="mdi mdi-plus"></i> --> --}}
                                            <img src="{{ asset('icons/Vector.svg') }}" alt="" />
                                            <span>Оставить отзыв</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 z-10">
                                <span class="bg-primary text-white py-2 px-3 rounded-lg text-xs xs:text-sm">
                                    115 Отзывов
                                </span>
                            </div>
                            <div class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all pointer-events-none group-hover:pointer-events-auto"
                                data-id="overlay" data-card-overlay-id="1">
                                <div class="flex flex-col gap-2 items-center">
                                    <a href="#"> Узнать подробнее</a>
                                    {{-- <button
                                        onclick="handleOverlayButtonClick(event, '1')"
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0">
        <button
            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
            Все жилые комплексы
        </button>
    </div>
</section>
