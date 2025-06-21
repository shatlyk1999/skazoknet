<section class="xl:container px-0 sm:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
    <div class="px-8 xs:px-12 sm:px-0 flex items-center justify-between mb-8">
        <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
            Жилые комплексы в Краснодаре
        </h1>
        <a href="#" class="md:inline-block hidden">Все жилые комплексы</a>
    </div>
    <div class="hidden sm:flex gap-8 flex-wrap">
        <div onclick="handleCardClick(event, this)"
            class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
            <div>
                <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]" alt="" />
            </div>
            <div
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                <p>г. Краснодар, ул.Западный обход,33</p>
                <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                    <span> Узнать подробнее</span>
                    {{-- <button
                                onclick="handleOverlayButtonClick(event, '11')"
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button> --}}
                </div>
            </div>
        </div>
        <div
            class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
            <div>
                <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]" alt="" />
            </div>
            <div onclick="handleCardClick(event, this)"
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                <p>г. Краснодар, ул.Западный обход,33</p>
                <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                    <span> Узнать подробнее</span>
                    {{-- <button
                            onclick="handleOverlayButtonClick(event, '12')"
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button> --}}
                </div>
            </div>
        </div>
        <div onclick="handleCardClick(event, this)"
            class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
            <div>
                <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]" alt="" />
            </div>
            <div
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                <p>г. Краснодар, ул.Западный обход,33</p>
                <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                    <span> Узнать подробнее</span>
                    {{-- <button
                                onclick="handleOverlayButtonClick(event, '13')"
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button> --}}
                </div>
            </div>
        </div>
        <div onclick="handleCardClick(event, this)"
            class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
            <div>
                <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]" alt="" />
            </div>
            <div
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                <p>г. Краснодар, ул.Западный обход,33</p>
                <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                    <span> Узнать подробнее</span>
                    {{-- <button
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button> --}}
                </div>
            </div>
        </div>
        <div onclick="handleCardClick(event, this)"
            class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
            <div>
                <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]" alt="" />
            </div>
            <div
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                <p>г. Краснодар, ул.Западный обход,33</p>
                <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                    <span> Узнать подробнее</span>
                    {{-- <button
                            onclick="handleOverlayButtonClick(event, '15')"
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button> --}}
                </div>
            </div>
        </div>
        <div onclick="handleCardClick(event, this)"
            class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
            <div>
                <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]" alt="" />
            </div>
            <div
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                <p>г. Краснодар, ул.Западный обход,33</p>
                <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                                    lass="border-primary border text-xs xl:text-sm rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                    <span> Узнать подробнее</span>
                    {{-- <button
                                onclick="handleOverlayButtonClick(event, '16')"
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 block sm:hidden">
        <div class="swiper krasnodorSwiper relative !px-8 xs:!px-12 sm:!px-0">
            <div class="swiper-wrapper">
                <div class="swiper-slide" onclick="handleCardClick(event, this)">
                    <div
                        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                        <div>
                            <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                                alt="" />
                        </div>
                        <div
                            class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                            <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                            <p>г. Краснодар, ул.Западный обход,33</p>
                            <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                                <span> Узнать подробнее</span>
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
                <div class="swiper-slide" onclick="handleCardClick(event, this)">
                    <div
                        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                        <div>
                            <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                                alt="" />
                        </div>
                        <div
                            class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                            <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                            <p>г. Краснодар, ул.Западный обход,33</p>
                            <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                        <div data-id="overlay" data-card-overlay-id="11"
                            class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all pointer-events-none group-hover:pointer-events-auto">
                            <div class="flex flex-col gap-2 items-center">
                                <span> Узнать подробнее</span>
                                {{-- <button
                                            onclick="handleOverlayButtonClick(event, '2')"
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" onclick="handleCardClick(event, this)">
                    <div
                        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                        <div>
                            <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                                alt="" />
                        </div>
                        <div
                            class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                            <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                            <p>г. Краснодар, ул.Западный обход,33</p>
                            <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                        <div data-id="overlay" data-card-overlay-id="3"
                            class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all pointer-events-none group-hover:pointer-events-auto">
                            <div class="flex flex-col gap-2 items-center">
                                <span> Узнать подробнее</span>
                                {{-- <button
                                            onclick="handleOverlayButtonClick(event, '3')"
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" onclick="handleCardClick(event, this)">
                    <div
                        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                        <div>
                            <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                                alt="" />
                        </div>
                        <div
                            class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                            <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                            <p>г. Краснодар, ул.Западный обход,33</p>
                            <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                        <div data-id="overlay" data-card-overlay-id="4"
                            class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all pointer-events-none group-hover:pointer-events-auto">
                            <div class="flex flex-col gap-2 items-center">
                                <span> Узнать подробнее</span>
                                {{-- <button
                                            onclick="handleOverlayButtonClick(event, '4')"
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" onclick="handleCardClick(event, this)">
                    <div
                        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                        <div>
                            <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                                alt="" />
                        </div>
                        <div
                            class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                            <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                            <p>г. Краснодар, ул.Западный обход,33</p>
                            <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                        <div data-id="overlay" data-card-overlay-id="5"
                            class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all pointer-events-none group-hover:pointer-events-auto">
                            <div class="flex flex-col gap-2 items-center">
                                <span> Узнать подробнее</span>
                                {{-- <button
                                            onclick="handleOverlayButtonClick(event, '5')"
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
                        <div>
                            <img src="{{ asset('image.png') }}" class="w-full h-auto min-h-[10.625rem]"
                                alt="" />
                        </div>
                        <div
                            class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                            <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                            <p>г. Краснодар, ул.Западный обход,33</p>
                            <p class="mt-8">Застройщик: ЮгСтройИнвест</p>
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
                                        class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                        <div
                            class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="flex flex-col gap-2 items-center">
                                <span> Узнать подробнее</span>
                                {{-- <button
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0">
        <button
            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
            Все застройщики
        </button>
    </div>
</section>
