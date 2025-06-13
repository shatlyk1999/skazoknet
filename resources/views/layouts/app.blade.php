<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project</title>
    <link href="../styles/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles/menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('swiper/swiper-bundle.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('styles/materialdesignicons.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('@mdi/font/css/materialdesignicons.min.css') }}" />

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="size-full">
    <div class="size-full relative">
        <header class="h-[6.25rem] bg-transparent absolute left-0 top-0 z-10 w-full">
            <div class="flex items-center xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto justify-between h-full">
                <div class="flex items-center gap-x-12 h-10">
                    <div class="flex items-center gap-2">
                        <div class="lg:hidden flex">
                            <div class="cursor-pointer flex items-center justify-center pt-4 leading-10"
                                id="menu-toggle" aria-label="Toggle menu">
                                <img src="{{ asset('icons/menu.svg') }}" alt="" />
                            </div>
                        </div>
                        <a href="#">
                            <img class="w-[8.125rem]" src="{{ asset('logo.png') }}" alt="" />
                        </a>
                    </div>
                    <div class="hidden items-center gap-x-8 lg:flex">
                        <a href="#" class="text-white text-lg leading-10 pt-4">Оставить отзыв</a>
                        <a href="#" class="text-white text-lg leading-10 pt-4">Пользователям</a>
                    </div>
                </div>
                <div class="flex items-center gap-x-6 lg:gap-x-12 text-white h-10">
                    <div class="flex gap-x-1 lg:gap-x-2 items-center leading-10 pt-4">
                        <span class="hidden lg:inline-block text-lg">Ваш город:</span>

                        <div onclick="openModal('reusableModal')"
                            class="flex items-center justify-between gap-x-2 cursor-pointer leading-10 pt-1">
                            <div class="relative">
                                <span id="selectedCityDisplay">Краснодар</span>
                                <div class="absolute bottom-2 left-0 w-full h-[1px] bg-white/50"></div>
                            </div>
                            <img src="{{ asset('icons/down-arrow 1.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="leading-10 pt-0 lg:pt-4 hidden lg:block">
                        <button
                            class="border-none bg-transparent outline-none hover:bg-black/5 transition-colors p-2 rounded-lg text-lg flex items-center gap-x-2">
                            <img src="{{ asset('icons/add 1.svg') }}" alt="" />
                            Войти
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <section class="flex flex-row relative w-full">
            <div class="w-full md:w-[55%] bg-primary relative h-dvh md:h-auto"></div>
            <div class="w-0 hidden md:block md:w-[45%] relative">
                <img src="{{ asset('Rectangle 3.png') }}" class="w-full h-[48rem]" alt="" />
                <!--  -->
            </div>
            <div class="absolute top-[20%] md:top-[40%] left-0 leading-0 w-full z-10">
                <div class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto flex justify-between relative">
                    <div class="w-full md:w-[calc(65%-2rem)] mr-0 md:mr-8">
                        <div class="text-white mb-[5rem]">
                            <h1 class="text-3xl md:text-5xl xl:text-6xl font-bold tracking-wide mb-2 md:mb-4">
                                Отзывы без иллюзий
                            </h1>
                            <p class="text-xs md:text-lg xl:text-xl font-medium">
                                Забудьте о сказках, выбирайте с уверенностью
                            </p>
                        </div>
                        <div class="w-full text-text flex flex-wrap md:flex-nowrap gap-4 xl:gap-8 items-center">
                            <div class="bg-white w-full p-4 rounded-lg flex flex-row md:flex-col gap-4">
                                <img class="w-[5.625rem] md:w-[5rem] xl:w-[6rem] h-[4.375rem] md:h-[3rem] xl:h-[3.75rem]"
                                    src="{{ asset('1.png') }}" alt="" />
                                <h2 class="text-base md:block hidden h-12 xl:h-auto xl:text-lg font-bold">
                                    Жилые комплексы
                                </h2>
                                <p class="text-sm xl:text-base text-custom-gray hidden md:block">
                                    300
                                </p>
                                <div class="w-full md:hidden flex flex-col gap-2">
                                    <h2 class="text-base md:h-12 xl:h-auto xl:text-lg font-bold">
                                        Жилые комплексы
                                    </h2>
                                    <p class="text-sm xl:text-base text-custom-gray inline-block">
                                        300
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white w-full p-4 rounded-lg flex flex-row md:flex-col gap-4">
                                <img class="w-[5.625rem] md:w-[5rem] xl:w-[6rem] h-[4.375rem] md:h-[3rem] xl:h-[3.75rem]"
                                    src="{{ asset('2.png') }}" alt="" />

                                <h2 class="text-base md:block hidden h-12 xl:h-auto xl:text-lg font-bold">
                                    Застройщики
                                </h2>
                                <p class="text-sm xl:text-base text-custom-gray hidden md:block">
                                    250
                                </p>
                                <div class="w-full md:hidden flex flex-col gap-2">
                                    <h2 class="text-base md:h-12 xl:h-auto xl:text-lg font-bold">
                                        Застройщики
                                    </h2>
                                    <p class="text-sm xl:text-base text-custom-gray inline-block">
                                        250
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white w-full p-4 rounded-lg flex flex-row md:flex-col gap-4">
                                <img class="w-[5.625rem] md:w-[5rem] xl:w-[6rem] h-[4.375rem] md:h-[3rem] xl:h-[3.75rem]"
                                    src="{{ asset('1.png') }}" alt="" />
                                <h2 class="text-base md:block hidden h-12 xl:h-auto xl:text-lg font-bold">
                                    Застройщики
                                </h2>
                                <p class="text-sm xl:text-base text-custom-gray hidden md:block">
                                    250
                                </p>
                                <div class="w-full flex-col gap-2 md:hidden flex">
                                    <h2 class="text-base md:h-12 xl:h-auto xl:text-lg font-bold">
                                        Застройщики
                                    </h2>
                                    <p class="text-sm xl:text-base text-custom-gray inline-block">
                                        250
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="md:hidden block w-full mt-8">
                            <button
                                class="border-white border w-full text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2 justify-center">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button>
                        </div>
                    </div>
                    <div
                        class="w-full md:w-[35%] absolute right-0 z-[-1] -top-[4.25rem] md:top-auto -bottom-[2rem] md:-bottom-[3.5rem] lg:-bottom-[6.7rem] xl:-bottom-[6.2rem]">
                        <img src="{{ asset('project.png') }}" alt=""
                            class="w-[90%] md:w-full max-[90.625]:w-[80%] mx-auto h-full sm:min-h-[22.5rem] lg:min-h-[25rem] xl:min-h-[27.75rem] hidden md:block" />
                        <img src="{{ asset('Group 269.png') }}" alt=""
                            class="w-full max-h-[35rem] xs:max-h-max md:w-full max-[90.625]:w-[80%] mx-auto h-full sm:min-h-[22.5rem] lg:min-h-[25rem] xl:min-h-[27.75rem] md:hidden block" />
                    </div>
                </div>
            </div>
        </section>
        <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                    Жилые комплексы в Краснодаре
                </h1>
                <a href="#" class="md:inline-block hidden">Все жилые комплексы</a>
            </div>
            <div class="hidden sm:flex gap-8 flex-wrap">
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
                                    class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                    class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                    class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                    class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                    class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                    class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
            <div class="mt-8 block sm:hidden">
                <div class="swiper krasnodorSwiper relative">
                    <div class="swiper-wrapper">
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
            <div class="mt-8 block md:hidden">
                <button
                    class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                    Все застройщики
                </button>
            </div>
        </section>
        <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                    Застройщики в Краснодаре
                </h1>
                <a href="#" class="md:inline-block hidden">Все жилые комплексы</a>
            </div>
            <div class="hidden sm:flex gap-8 flex-wrap">
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                    <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                        <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto" alt="" />
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <h2 class="font-semibold text-lg">DOGMA</h2>
                        <p>Год основания: 2013 г.</p>
                        <p class="mt-8">Количество объектов: 11</p>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                    role="img">
                                    <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                </div>
                                <div class="text-primary text-sm">
                                    115/<span class="text-red-500">15</span>
                                </div>
                            </div>
                            <div class="group-hover:hidden">
                                <button
                                    class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                            <button
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                    <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                        <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto" alt="" />
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <h2 class="font-semibold text-lg">DOGMA</h2>
                        <p>Год основания: 2013 г.</p>
                        <p class="mt-8">Количество объектов: 11</p>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                    role="img">
                                    <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                </div>
                                <div class="text-primary text-sm">
                                    115/<span class="text-red-500">15</span>
                                </div>
                            </div>
                            <div class="group-hover:hidden">
                                <button
                                    class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                            <button
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                    <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                        <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto" alt="" />
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <h2 class="font-semibold text-lg">DOGMA</h2>
                        <p>Год основания: 2013 г.</p>
                        <p class="mt-8">Количество объектов: 11</p>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                    role="img">
                                    <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                </div>
                                <div class="text-primary text-sm">
                                    115/<span class="text-red-500">15</span>
                                </div>
                            </div>
                            <div class="group-hover:hidden">
                                <button
                                    class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                            <button
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                    <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                        <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto" alt="" />
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <h2 class="font-semibold text-lg">DOGMA</h2>
                        <p>Год основания: 2013 г.</p>
                        <p class="mt-8">Количество объектов: 11</p>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                    role="img">
                                    <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                </div>
                                <div class="text-primary text-sm">
                                    115/<span class="text-red-500">15</span>
                                </div>
                            </div>
                            <div class="group-hover:hidden">
                                <button
                                    class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                            <button
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                    <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                        <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto" alt="" />
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <h2 class="font-semibold text-lg">DOGMA</h2>
                        <p>Год основания: 2013 г.</p>
                        <p class="mt-8">Количество объектов: 11</p>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                    role="img">
                                    <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                </div>
                                <div class="text-primary text-sm">
                                    115/<span class="text-red-500">15</span>
                                </div>
                            </div>
                            <div class="group-hover:hidden">
                                <button
                                    class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                            <button
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                    <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                        <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto" alt="" />
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <h2 class="font-semibold text-lg">DOGMA</h2>
                        <p>Год основания: 2013 г.</p>
                        <p class="mt-8">Количество объектов: 11</p>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                    role="img">
                                    <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                    <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                </div>
                                <div class="text-primary text-sm">
                                    115/<span class="text-red-500">15</span>
                                </div>
                            </div>
                            <div class="group-hover:hidden">
                                <button
                                    class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                            <button
                                class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                <i class="mdi mdi-plus"></i>
                                <span>Оставить отзыв</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 block sm:hidden">
                <div class="swiper krasnodor2Swiper relative">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                                <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                                    <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto"
                                        alt="" />
                                </div>
                                <div class="p-4 flex flex-col gap-2">
                                    <h2 class="font-semibold text-lg">DOGMA</h2>
                                    <p>Год основания: 2013 г.</p>
                                    <p class="mt-8">Количество объектов: 11</p>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                            <div class="flex items-center space-x-px xs:space-x-1"
                                                aria-label="3 out of 5 stars" role="img">
                                                <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                            </div>
                                            <div class="text-primary text-sm">
                                                115/<span class="text-red-500">15</span>
                                            </div>
                                        </div>
                                        <div class="group-hover:hidden">
                                            <button
                                                class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                        <button
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                                <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                                    <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto"
                                        alt="" />
                                </div>
                                <div class="p-4 flex flex-col gap-2">
                                    <h2 class="font-semibold text-lg">DOGMA</h2>
                                    <p>Год основания: 2013 г.</p>
                                    <p class="mt-8">Количество объектов: 11</p>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                            <div class="flex items-center space-x-px xs:space-x-1"
                                                aria-label="3 out of 5 stars" role="img">
                                                <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                            </div>
                                            <div class="text-primary text-sm">
                                                115/<span class="text-red-500">15</span>
                                            </div>
                                        </div>
                                        <div class="group-hover:hidden">
                                            <button
                                                class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                        <button
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                                <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                                    <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto"
                                        alt="" />
                                </div>
                                <div class="p-4 flex flex-col gap-2">
                                    <h2 class="font-semibold text-lg">DOGMA</h2>
                                    <p>Год основания: 2013 г.</p>
                                    <p class="mt-8">Количество объектов: 11</p>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                            <div class="flex items-center space-x-px xs:space-x-1"
                                                aria-label="3 out of 5 stars" role="img">
                                                <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                            </div>
                                            <div class="text-primary text-sm">
                                                115/<span class="text-red-500">15</span>
                                            </div>
                                        </div>
                                        <div class="group-hover:hidden">
                                            <button
                                                class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                        <button
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                                <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                                    <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto"
                                        alt="" />
                                </div>
                                <div class="p-4 flex flex-col gap-2">
                                    <h2 class="font-semibold text-lg">DOGMA</h2>
                                    <p>Год основания: 2013 г.</p>
                                    <p class="mt-8">Количество объектов: 11</p>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                            <div class="flex items-center space-x-px xs:space-x-1"
                                                aria-label="3 out of 5 stars" role="img">
                                                <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                            </div>
                                            <div class="text-primary text-sm">
                                                115/<span class="text-red-500">15</span>
                                            </div>
                                        </div>
                                        <div class="group-hover:hidden">
                                            <button
                                                class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                        <button
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                                <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                                    <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto"
                                        alt="" />
                                </div>
                                <div class="p-4 flex flex-col gap-2">
                                    <h2 class="font-semibold text-lg">DOGMA</h2>
                                    <p>Год основания: 2013 г.</p>
                                    <p class="mt-8">Количество объектов: 11</p>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                            <div class="flex items-center space-x-px xs:space-x-1"
                                                aria-label="3 out of 5 stars" role="img">
                                                <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                            </div>
                                            <div class="text-primary text-sm">
                                                115/<span class="text-red-500">15</span>
                                            </div>
                                        </div>
                                        <div class="group-hover:hidden">
                                            <button
                                                class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                        <button
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
                                <div class="border-b border-custom-gray h-[13.75rem] flex items-center justify-center">
                                    <img src="{{ asset('image 3.png') }}" class="w-[75%] mx-auto h-auto"
                                        alt="" />
                                </div>
                                <div class="p-4 flex flex-col gap-2">
                                    <h2 class="font-semibold text-lg">DOGMA</h2>
                                    <p>Год основания: 2013 г.</p>
                                    <p class="mt-8">Количество объектов: 11</p>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                                            <div class="flex items-center space-x-px xs:space-x-1"
                                                aria-label="3 out of 5 stars" role="img">
                                                <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                                            </div>
                                            <div class="text-primary text-sm">
                                                115/<span class="text-red-500">15</span>
                                            </div>
                                        </div>
                                        <div class="group-hover:hidden">
                                            <button
                                                class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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
                                        <button
                                            class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                                            <i class="mdi mdi-plus"></i>
                                            <span>Оставить отзыв</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 block md:hidden">
                <button
                    class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                    Все жилые комплексы
                </button>
            </div>
        </section>
        <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                    Лучшие отзывы недели
                </h1>
                <a href="#" class="md:inline-block hidden">Все отзывы</a>
            </div>
            <div class="hidden sm:flex gap-8 flex-wrap">
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="hidden md:flex items-center gap-1">
                                <img src="{{ asset('user 7.png') }}" class="size-7" alt="" />
                                <span>User001</span>
                            </div>
                            <span class="inline-block md:hidden text-xs">
                                На модерации
                            </span>
                            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17
                                Дополнений</span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                            </div>
                            <span class="text-sm">2020/01/16</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src=".{{ asset('user 7.png') }}" class="size-8" alt="" />
                            <span>User001</span>
                        </div>
                        <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                        <p class="text-sm line-clamp-4">
                            Купили квартиру на стадии строительства у застройщика
                            ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно удивили. Ну,
                            понятное дело, на старте обычно дешевле
                        </p>
                        <div class="my-4 md:my-8">
                            <button
                                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                Читать отзыв
                            </button>
                        </div>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('dislike.png') }}" alt="" class="h-5 w-6" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <a href="" class="md:inline-block hidden text-sm">
                                На модерации
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="hidden md:flex items-center gap-1">
                                <img src="{{ asset('user 7.png') }}" class="size-7" alt="" />
                                <span>User001</span>
                            </div>
                            <span class="inline-block md:hidden text-xs">
                                На модерации
                            </span>
                            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17
                                Дополнений</span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                            </div>
                            <span class="text-sm">2020/01/16</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src="{{ asset('user 7.png') }}" class="size-8" alt="" />
                            <span>User001</span>
                        </div>
                        <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                        <p class="text-sm line-clamp-4">
                            Купили квартиру на стадии строительства у застройщика
                            ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно удивили. Ну,
                            понятное дело, на старте обычно дешевле
                        </p>
                        <div class="my-4 md:my-8">
                            <button
                                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                Читать отзыв
                            </button>
                        </div>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('dislike.png') }}" alt="" class="h-5 w-6" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <a href="" class="md:inline-block hidden text-sm">
                                На модерации
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="hidden md:flex items-center gap-1">
                                <img src="{{ asset('user 7.png') }}" class="size-7" alt="" />
                                <span>User001</span>
                            </div>
                            <span class="inline-block md:hidden text-xs">
                                На модерации
                            </span>
                            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17
                                Дополнений</span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                            </div>
                            <span class="text-sm">2020/01/16</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src=".{{ asset('user 7.png') }}" class="size-8" alt="" />
                            <span>User001</span>
                        </div>
                        <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                        <p class="text-sm line-clamp-4">
                            Купили квартиру на стадии строительства у застройщика
                            ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно удивили. Ну,
                            понятное дело, на старте обычно дешевле
                        </p>
                        <div class="my-4 md:my-8">
                            <button
                                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                Читать отзыв
                            </button>
                        </div>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('dislike.png') }}" alt="" class="h-5 w-6" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <a href="" class="md:inline-block hidden text-sm">
                                На модерации
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="hidden md:flex items-center gap-1">
                                <img src="{{ asset('user 7.png') }}" class="size-7" alt="" />
                                <span>User001</span>
                            </div>
                            <span class="inline-block md:hidden text-xs">
                                На модерации
                            </span>
                            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17
                                Дополнений</span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                            </div>
                            <span class="text-sm">2020/01/16</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src=".{{ asset('user 7.png') }}" class="size-8" alt="" />
                            <span>User001</span>
                        </div>
                        <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                        <p class="text-sm line-clamp-4">
                            Купили квартиру на стадии строительства у застройщика
                            ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно удивили. Ну,
                            понятное дело, на старте обычно дешевле
                        </p>
                        <div class="my-4 md:my-8">
                            <button
                                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                Читать отзыв
                            </button>
                        </div>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('dislike.png') }}" alt="" class="h-5 w-6" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <a href="" class="md:inline-block hidden text-sm">
                                На модерации
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="hidden md:flex items-center gap-1">
                                <img src="{{ asset('user 7.png') }}" class="size-7" alt="" />
                                <span>User001</span>
                            </div>
                            <span class="inline-block md:hidden text-xs">
                                На модерации
                            </span>
                            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17
                                Дополнений</span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                            </div>
                            <span class="text-sm">2020/01/16</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src=".{{ asset('user 7.png') }}" class="size-8" alt="" />
                            <span>User001</span>
                        </div>
                        <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                        <p class="text-sm line-clamp-4">
                            Купили квартиру на стадии строительства у застройщика
                            ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно удивили. Ну,
                            понятное дело, на старте обычно дешевле
                        </p>
                        <div class="my-4 md:my-8">
                            <button
                                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                Читать отзыв
                            </button>
                        </div>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('dislike.png') }}" alt="" class="h-5 w-6" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <a href="" class="md:inline-block hidden text-sm">
                                На модерации
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="hidden md:flex items-center gap-1">
                                <img src="{{ asset('user 7.png') }}" class="size-7" alt="" />
                                <span>User001</span>
                            </div>
                            <span class="inline-block md:hidden text-xs">
                                На модерации
                            </span>
                            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17
                                Дополнений</span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="size-4 xs:size-6"
                                    alt="" />
                            </div>
                            <span class="text-sm">2020/01/16</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src=".{{ asset('user 7.png') }}" class="size-8" alt="" />
                            <span>User001</span>
                        </div>
                        <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                        <p class="text-sm line-clamp-4">
                            Купили квартиру на стадии строительства у застройщика
                            ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно удивили. Ну,
                            понятное дело, на старте обычно дешевле
                        </p>
                        <div class="my-4 md:my-8">
                            <button
                                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                Читать отзыв
                            </button>
                        </div>
                        <div class="flex items-center justify-between gap-x-2">
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('dislike.png') }}" alt="" class="h-5 w-6" />
                                <span>1</span>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <img src="{{ asset('comment.png') }}" alt="" class="size-5" />
                                <span>1</span>
                            </div>
                            <a href="" class="md:inline-block hidden text-sm">
                                На модерации
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 block sm:hidden">
                <div class="swiper krasnodor3Swiper relative">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="hidden md:flex items-center gap-1">
                                            <img src="{{ asset('user 7.png') }}" class="size-7"
                                                alt="" />
                                            <span>User001</span>
                                        </div>
                                        <span class="inline-block md:hidden text-xs">
                                            На модерации
                                        </span>
                                        <span
                                            class="bg-primary text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">17
                                            Дополнений</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class="flex items-center space-x-px xs:space-x-1"
                                            aria-label="3 out of 5 stars" role="img">
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                        </div>
                                        <span class="text-sm">2020/01/16</span>
                                    </div>
                                    <div class="flex md:hidden items-center gap-1">
                                        <img src="{{ asset('user 7.png') }}" class="size-8" alt="" />
                                        <span>User001</span>
                                    </div>
                                    <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                                    <p class="text-sm line-clamp-4">
                                        Купили квартиру на стадии строительства у застройщика
                                        ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно
                                        удивили. Ну, понятное дело, на старте обычно дешевле
                                    </p>
                                    <div class="my-4 md:my-8">
                                        <button
                                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                            Читать отзыв
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('dislike.png') }}" alt=""
                                                class="h-5 w-6" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('comment.png') }}" alt=""
                                                class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <a href="" class="md:inline-block hidden text-sm">
                                            На модерации
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="hidden md:flex items-center gap-1">
                                            <img src="{{ asset('user 7.png') }}" class="size-7"
                                                alt="" />
                                            <span>User001</span>
                                        </div>
                                        <span class="inline-block md:hidden text-xs">
                                            На модерации
                                        </span>
                                        <span
                                            class="bg-primary text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">17
                                            Дополнений</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class="flex items-center space-x-px xs:space-x-1"
                                            aria-label="3 out of 5 stars" role="img">
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                        </div>
                                        <span class="text-sm">2020/01/16</span>
                                    </div>
                                    <div class="flex md:hidden items-center gap-1">
                                        <img src="{{ asset('user 7.png') }}" class="size-8" alt="" />
                                        <span>User001</span>
                                    </div>
                                    <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                                    <p class="text-sm line-clamp-4">
                                        Купили квартиру на стадии строительства у застройщика
                                        ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно
                                        удивили. Ну, понятное дело, на старте обычно дешевле
                                    </p>
                                    <div class="my-4 md:my-8">
                                        <button
                                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                            Читать отзыв
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('dislike.png') }}" alt=""
                                                class="h-5 w-6" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('comment.png') }}" alt=""
                                                class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <a href="" class="md:inline-block hidden text-sm">
                                            На модерации
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="hidden md:flex items-center gap-1">
                                            <img src="{{ asset('user 7.png') }}" class="size-7"
                                                alt="" />
                                            <span>User001</span>
                                        </div>
                                        <span class="inline-block md:hidden text-xs">
                                            На модерации
                                        </span>
                                        <span
                                            class="bg-primary text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">17
                                            Дополнений</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class="flex items-center space-x-px xs:space-x-1"
                                            aria-label="3 out of 5 stars" role="img">
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                        </div>
                                        <span class="text-sm">2020/01/16</span>
                                    </div>
                                    <div class="flex md:hidden items-center gap-1">
                                        <img src="{{ asset('user 7.png') }}" class="size-8" alt="" />
                                        <span>User001</span>
                                    </div>
                                    <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                                    <p class="text-sm line-clamp-4">
                                        Купили квартиру на стадии строительства у застройщика
                                        ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно
                                        удивили. Ну, понятное дело, на старте обычно дешевле
                                    </p>
                                    <div class="my-4 md:my-8">
                                        <button
                                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                            Читать отзыв
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('dislike.png') }}" alt=""
                                                class="h-5 w-6" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('comment.png') }}" alt=""
                                                class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <a href="" class="md:inline-block hidden text-sm">
                                            На модерации
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="hidden md:flex items-center gap-1">
                                            <img src="{{ asset('user 7.png') }}" class="size-7"
                                                alt="" />
                                            <span>User001</span>
                                        </div>
                                        <span class="inline-block md:hidden text-xs">
                                            На модерации
                                        </span>
                                        <span
                                            class="bg-primary text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">17
                                            Дополнений</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class="flex items-center space-x-px xs:space-x-1"
                                            aria-label="3 out of 5 stars" role="img">
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                        </div>
                                        <span class="text-sm">2020/01/16</span>
                                    </div>
                                    <div class="flex md:hidden items-center gap-1">
                                        <img src="{{ asset('user 7.png') }}" class="size-8" alt="" />
                                        <span>User001</span>
                                    </div>
                                    <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                                    <p class="text-sm line-clamp-4">
                                        Купили квартиру на стадии строительства у застройщика
                                        ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно
                                        удивили. Ну, понятное дело, на старте обычно дешевле
                                    </p>
                                    <div class="my-4 md:my-8">
                                        <button
                                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                            Читать отзыв
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('dislike.png') }}" alt=""
                                                class="h-5 w-6" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('comment.png') }}" alt=""
                                                class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <a href="" class="md:inline-block hidden text-sm">
                                            На модерации
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="hidden md:flex items-center gap-1">
                                            <img src="{{ asset('user 7.png') }}" class="size-7"
                                                alt="" />
                                            <span>User001</span>
                                        </div>
                                        <span class="inline-block md:hidden text-xs">
                                            На модерации
                                        </span>
                                        <span
                                            class="bg-primary text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">17
                                            Дополнений</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class="flex items-center space-x-px xs:space-x-1"
                                            aria-label="3 out of 5 stars" role="img">
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                        </div>
                                        <span class="text-sm">2020/01/16</span>
                                    </div>
                                    <div class="flex md:hidden items-center gap-1">
                                        <img src="{{ asset('user 7.png') }}" class="size-8" alt="" />
                                        <span>User001</span>
                                    </div>
                                    <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                                    <p class="text-sm line-clamp-4">
                                        Купили квартиру на стадии строительства у застройщика
                                        ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно
                                        удивили. Ну, понятное дело, на старте обычно дешевле
                                    </p>
                                    <div class="my-4 md:my-8">
                                        <button
                                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                            Читать отзыв
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('dislike.png') }}" alt=""
                                                class="h-5 w-6" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('comment.png') }}" alt=""
                                                class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <a href="" class="md:inline-block hidden text-sm">
                                            На модерации
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="hidden md:flex items-center gap-1">
                                            <img src="{{ asset('user 7.png') }}" class="size-7"
                                                alt="" />
                                            <span>User001</span>
                                        </div>
                                        <span class="inline-block md:hidden text-xs">
                                            На модерации
                                        </span>
                                        <span
                                            class="bg-primary text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">17
                                            Дополнений</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class="flex items-center space-x-px xs:space-x-1"
                                            aria-label="3 out of 5 stars" role="img">
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Starmini.svg') }}" class="size-4 xs:size-6"
                                                alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                            <img src="{{ asset('icons/Stargraymini.svg') }}"
                                                class="size-4 xs:size-6" alt="" />
                                        </div>
                                        <span class="text-sm">2020/01/16</span>
                                    </div>
                                    <div class="flex md:hidden items-center gap-1">
                                        <img src="{{ asset('user 7.png') }}" class="size-8" alt="" />
                                        <span>User001</span>
                                    </div>
                                    <h2 class="font-semibold text-lg">ЖК “Губернский”</h2>
                                    <p class="text-sm line-clamp-4">
                                        Купили квартиру на стадии строительства у застройщика
                                        ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно
                                        удивили. Ну, понятное дело, на старте обычно дешевле
                                    </p>
                                    <div class="my-4 md:my-8">
                                        <button
                                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                                            Читать отзыв
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between gap-x-2">
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('like.png') }}" alt="" class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('dislike.png') }}" alt=""
                                                class="h-5 w-6" />
                                            <span>1</span>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <img src="{{ asset('comment.png') }}" alt=""
                                                class="size-5" />
                                            <span>1</span>
                                        </div>
                                        <a href="" class="md:inline-block hidden text-sm">
                                            На модерации
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-primary py-8 sm:py-15">
            <div class="xl:container px-12 xl:px-4 mx-0 xl:mx-auto w-full">
                <div class="flex items-center flex-col lg:flex-row justify-between gap-16 xl:gap-24 text-white">
                    <a href="#" class="w-full max-w-[15rem] xl:max-w-[18.125rem]">
                        <img src="{{ asset('footer_logo.png') }}" class="w-full h-auto" alt="" />
                    </a>
                    <div
                        class="basis-full lg:w-[calc(100%-19rem)] xl:w-[calc(100%-24.125rem)] hidden sm:flex flex-wrap gap-x-18">
                        <div class="w-[calc((100%/3)-3rem)] gap-y-4 xl:gap-y-6">
                            <h2 class="font-semibold text-lg xl:text-xl mb-4 xl:mb-6">
                                Полезная информация
                            </h2>
                            <div class="flex flex-col gap-y-4 xl:gap-y-6 pl-2">
                                <a href="#" class="text-sm">О проекте</a>
                                <a href="#" class="text-sm">Застройщики</a>
                                <a href="#" class="text-sm">Жилые комплексы</a>
                            </div>
                        </div>
                        <div class="w-[calc((100%/3)-3rem)] gap-y-4 xl:gap-y-6">
                            <h2 class="font-semibold text-lg xl:text-xl mb-4 xl:mb-6">
                                Условия пользования
                            </h2>
                            <div class="flex flex-col gap-y-4 xl:gap-y-6 pl-2">
                                <a href="#" class="text-sm">Пользовательское соглашение</a>
                                <a href="#" class="text-sm">Обработка персональных данных</a>
                                <a href="#" class="text-sm">Публикация</a>
                            </div>
                        </div>
                        <div class="w-[calc((100%/3)-3rem)] gap-y-4 xl:gap-y-6">
                            <h2 class="font-semibold text-lg xl:text-xl mb-4 xl:mb-6">
                                Компаниям
                            </h2>
                            <div class="flex flex-col gap-y-4 xl:gap-y-6 pl-2">
                                <a href="#" class="text-sm">Получение доступа</a>
                                <a href="#" class="text-sm">Реклама на сайте</a>
                                <a href="#" class="text-sm">Обратная связь</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Sidebar -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out z-20">
        </div>
        <div id="sidebar"
            class="fixed top-0 h-full w-full sm:w-[50%] bg-primary text-white transition-all duration-300 ease-in-out z-30 rounded-r-lg shadow-lg block lg:hidden"
            role="navigation">
            <div class="flex justify-end p-4 relative">
                <button id="close-sidebar"
                    class="text-white text-2xl hover:rotate-90 hover:bg-white/10 px-1 rounded-full transition-all duration-200 border border-white"
                    aria-label="Close menu">
                    <i class="mdi mdi-close"></i>
                </button>
                <div
                    class="absolute z-[-1] top-0 left-1/2 -translate-x-1/2 h-full w-full flex items-center justify-center">
                    <img src="{{ asset('logo.png"') }} alt="" />
                </div>
            </div>
            <nav class="flex flex-col gap-2 p-4 mt-12">
                <div class="flex flex-col gap-2 border-b border-white pb-4">
                    <h2 class="text-base font-bold tracking-wide">
                        Полезная информация
                    </h2>
                    <div class="pl-4 flex flex-col gap-2">
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">О
                            проекте</a>
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Застройщики</a>
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Жилые
                            комплексы</a>
                    </div>
                </div>
                <div class="flex flex-col gap-2 border-b border-white pb-4">
                    <h2 class="text-base font-bold tracking-wide">
                        Условия пользованияя
                    </h2>
                    <div class="pl-4 flex flex-col gap-2">
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Пользовательское
                            соглашение</a>
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Обработка
                            персональных данных</a>
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Публикация
                            материалов</a>
                    </div>
                </div>
                <div class="flex flex-col gap-2 pb-4">
                    <h2 class="text-base font-bold tracking-wide">Компаниям</h2>
                    <div class="pl-4 flex flex-col gap-2">
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Получение
                            доступа</a>
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Реклама
                            на сайте</a>
                        <a href="#"
                            class="text-sm font-medium hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">Обратная
                            связь</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar -->

        <!-- Modal -->

        <div id="modalOverlay"
            class="fixed inset-0 bg-black/50 bg-opacity-50 z-40 hidden transition-opacity duration-300 ease-out opacity-0 backdrop-blur-md">
        </div>

        <div id="reusableModal"
            class="fixed inset-0 h-auto sm:h-full top-0 sm:top-[6rem] z-50 items-center justify-center p-0 sm:p-4 hidden transition-all duration-300 ease-out transform opacity-0 scale-95 -translate-y-5">
            <div
                class="bg-white rounded-lg shadow-xl xl:container px-0 sm:px-8 lg:px-12 xl:px-4 mx-0 xl:mx-auto w-full max-h-full h-full sm:h-auto overflow-y-auto">
                <div class="p-4 lg:p-6">
                    <div class="flex justify-end items-center pb-3">
                        <button onclick="closeModal('reusableModal')"
                            class="text-gray-500 hover:text-gray-800 focus:outline-none rounded-full border p-1 sm:p-2 cursor-pointer">
                            <svg class="sm:size-6 size-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div id="modalBody">
                        <h1
                            class="tracking-widest text-lg sm:text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                            Выберите ваш город
                        </h1>
                        <div
                            class="mt-4 sm:mt-8 flex items-center gap-x-2 rounded-3xl border border-input-border-color px-4 h-10 w-full md:w-[80%]">
                            <img src="{{ asset('icons/search 1.svg') }}" alt="" />
                            <input type="text" class="border-none outline-none h-10 w-full"
                                placeholder="Введите название для быстрого поиска" />
                        </div>

                        <div id="cityListContainer"
                            class="flex flex-col gap-4 mt-8 pl-2 sm:pl-8 max-h-[300px] overflow-y-auto"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
    </div>

    <script src="{{ asset('js/component.js') }}" defer></script>
    <script src="{{ asset('js/modal.js') }}" defer></script>
    <script src="{{ asset('swiper/swiper-bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/swiper.js') }}" defer></script>
</body>

</html>
