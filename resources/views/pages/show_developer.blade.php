@extends('layouts.app')

@section('title', $developer->name . ' | Сказокнет')

@section('content')
    <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden">
        <a href="{{ route('home') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</a>
        <span class="px-2">|</span>
        <a href="{{ route('developers') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Застройщики</a>
        <span class="px-2">|</span>
        <span class="text-sm xl:text-xs tracking-widest text-primary">
            Точно</span>
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
                <span class="pr-1">4.79</span>
                <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars" role="img">
                    <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden" alt="" />
                    <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden" alt="" />
                    <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden" alt="" />
                    <img src="{{ asset('icons/Stargray.svg') }}" class="min-[51.875rem]:inline-block hidden"
                        alt="" />
                    <img src="{{ asset('icons/Stargray.svg') }}" class="min-[51.875rem]:inline-block hidden"
                        alt="" />
                    <img src="{{ asset('icons/Starmini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                        alt="" />
                    <img src="{{ asset('icons/Starmini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                        alt="" />
                    <img src="{{ asset('icons/Starmini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                        alt="" />
                    <img src="{{ asset('icons/Stargraymini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                        alt="" />
                    <img src="{{ asset('icons/Stargraymini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                        alt="" />
                </div>
            </div>
            <div>
                @if ($developer->popular == '1')
                    <span
                        style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
                @endif
            </div>
            <div class="flex items-center gap-x-2 w-[50%] md:w-auto order-2 md:order-none md:justify-start justify-end">
                <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                    115</span>
                <span class="text-sm tracking-wide">Отзывов</span>
            </div>
            <div class="order-3 md:order-none md:mt-0 mt-4 md:w-auto w-full">
                <button
                    class="md:w-auto w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                    <i class="mdi mdi-plus"></i>
                    Оставить отзыв
                </button>
            </div>
        </div>
    </div>

    @if ($complexes->count() > 0)
        <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                    Жилые комплексы «{{ $developer->name }}»
                </h1>
            </div>
            <div class="hidden sm:flex gap-8 flex-wrap">
                @foreach ($complexes as $complex)
                    @include('inc.pc_card_complex')
                @endforeach
            </div>
            <div class="mt-8 block sm:hidden">
                <div class="swiper krasnodorSwiper relative">
                    <div class="swiper-wrapper">
                        @foreach ($complexes as $complex)
                            @include('inc.mobile_card_complex')
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0 flex justify-center items-center text-center">
                <a href="{{ route('developers') }}"
                    class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                    Все застройщики
                </a>
            </div>
        </section>
    @endif

    <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                Отзывы «ТОЧНО», Краснодар
            </h1>
            <a href="#" class="md:inline-block hidden">Все отзывы</a>
        </div>
        <div class="hidden sm:flex gap-8 flex-wrap">
            <div
                class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between gap-x-2">
                        <div class="hidden md:flex items-center gap-1">
                            <img src="../public/user 7.png" class="size-7" alt="" />
                            <span>User001</span>
                        </div>
                        <span class="inline-block md:hidden text-xs">
                            На модерации
                        </span>
                        <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17 Дополнений</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                        </div>
                        <span class="text-sm">2020/01/16</span>
                    </div>
                    <div class="flex md:hidden items-center gap-1">
                        <img src="../public/user 7.png" class="size-8" alt="" />
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
                            <img src="../public/like.png" alt="" class="size-5" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/comment.png" alt="" class="size-5" />
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
                            <img src="../public/user 7.png" class="size-7" alt="" />
                            <span>User001</span>
                        </div>
                        <span class="inline-block md:hidden text-xs">
                            На модерации
                        </span>
                        <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17 Дополнений</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                        </div>
                        <span class="text-sm">2020/01/16</span>
                    </div>
                    <div class="flex md:hidden items-center gap-1">
                        <img src="../public/user 7.png" class="size-8" alt="" />
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
                            <img src="../public/like.png" alt="" class="size-5" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/comment.png" alt="" class="size-5" />
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
                            <img src="../public/user 7.png" class="size-7" alt="" />
                            <span>User001</span>
                        </div>
                        <span class="inline-block md:hidden text-xs">
                            На модерации
                        </span>
                        <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17 Дополнений</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                        </div>
                        <span class="text-sm">2020/01/16</span>
                    </div>
                    <div class="flex md:hidden items-center gap-1">
                        <img src="../public/user 7.png" class="size-8" alt="" />
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
                            <img src="../public/like.png" alt="" class="size-5" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/comment.png" alt="" class="size-5" />
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
                            <img src="../public/user 7.png" class="size-7" alt="" />
                            <span>User001</span>
                        </div>
                        <span class="inline-block md:hidden text-xs">
                            На модерации
                        </span>
                        <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17 Дополнений</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                        </div>
                        <span class="text-sm">2020/01/16</span>
                    </div>
                    <div class="flex md:hidden items-center gap-1">
                        <img src="../public/user 7.png" class="size-8" alt="" />
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
                            <img src="../public/like.png" alt="" class="size-5" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/comment.png" alt="" class="size-5" />
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
                            <img src="../public/user 7.png" class="size-7" alt="" />
                            <span>User001</span>
                        </div>
                        <span class="inline-block md:hidden text-xs">
                            На модерации
                        </span>
                        <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17 Дополнений</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                        </div>
                        <span class="text-sm">2020/01/16</span>
                    </div>
                    <div class="flex md:hidden items-center gap-1">
                        <img src="../public/user 7.png" class="size-8" alt="" />
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
                            <img src="../public/like.png" alt="" class="size-5" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/comment.png" alt="" class="size-5" />
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
                            <img src="../public/user 7.png" class="size-7" alt="" />
                            <span>User001</span>
                        </div>
                        <span class="inline-block md:hidden text-xs">
                            На модерации
                        </span>
                        <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">17 Дополнений</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Starmini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                            <img src="../public/icons/Stargraymini.svg" alt="" />
                        </div>
                        <span class="text-sm">2020/01/16</span>
                    </div>
                    <div class="flex md:hidden items-center gap-1">
                        <img src="../public/user 7.png" class="size-8" alt="" />
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
                            <img src="../public/like.png" alt="" class="size-5" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                            <span>1</span>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <img src="../public/comment.png" alt="" class="size-5" />
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
                                        <img src="../public/user 7.png" class="size-7" alt="" />
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
                                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                        role="img">
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                    </div>
                                    <span class="text-sm">2020/01/16</span>
                                </div>
                                <div class="flex md:hidden items-center gap-1">
                                    <img src="../public/user 7.png" class="size-8" alt="" />
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
                                        <img src="../public/like.png" alt="" class="size-5" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/comment.png" alt="" class="size-5" />
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
                                        <img src="../public/user 7.png" class="size-7" alt="" />
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
                                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                        role="img">
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                    </div>
                                    <span class="text-sm">2020/01/16</span>
                                </div>
                                <div class="flex md:hidden items-center gap-1">
                                    <img src="../public/user 7.png" class="size-8" alt="" />
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
                                        <img src="../public/like.png" alt="" class="size-5" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/comment.png" alt="" class="size-5" />
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
                                        <img src="../public/user 7.png" class="size-7" alt="" />
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
                                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                        role="img">
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                    </div>
                                    <span class="text-sm">2020/01/16</span>
                                </div>
                                <div class="flex md:hidden items-center gap-1">
                                    <img src="../public/user 7.png" class="size-8" alt="" />
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
                                        <img src="../public/like.png" alt="" class="size-5" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/comment.png" alt="" class="size-5" />
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
                                        <img src="../public/user 7.png" class="size-7" alt="" />
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
                                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                        role="img">
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                    </div>
                                    <span class="text-sm">2020/01/16</span>
                                </div>
                                <div class="flex md:hidden items-center gap-1">
                                    <img src="../public/user 7.png" class="size-8" alt="" />
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
                                        <img src="../public/like.png" alt="" class="size-5" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/comment.png" alt="" class="size-5" />
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
                                        <img src="../public/user 7.png" class="size-7" alt="" />
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
                                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                                        role="img">
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Starmini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                        <img src="../public/icons/Stargraymini.svg" class="size-4 xs:size-6"
                                            alt="" />
                                    </div>
                                    <span class="text-sm">2020/01/16</span>
                                </div>
                                <div class="flex md:hidden items-center gap-1">
                                    <img src="../public/user 7.png" class="size-8" alt="" />
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
                                        <img src="../public/like.png" alt="" class="size-5" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/dislike.png" alt="" class="h-5 w-6" />
                                        <span>1</span>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <img src="../public/comment.png" alt="" class="size-5" />
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

        <div class="mt-8 block md:hidden">
            <button
                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                Все отзывы
            </button>
        </div>
    </section>
@endsection
