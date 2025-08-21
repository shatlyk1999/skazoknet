@extends('cabinet.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('swiper/swiper-bundle.css') }}" />
@endsection

@section('content')
    <div class="max-w-full md:max-w-[calc(100%-15.625rem)] xl:max-w-[calc(100%-21.875rem)] w-full h-full">
        <div class="py-12 px-6 h-full flex flex-col gap-12">
            <div class="flex flex-col gap-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="font-bold text-2xl lg:text-3xl tracking-widest text-text">
                            Мои отзывы
                        </h1>
                        <p class="mt-2 text-xs font-semibold">
                            Отзыв: <span class="text-primary">№1223133</span>
                        </p>
                    </div>
                    <button
                        type="button"
                        class="md:flex hidden md:w-fit w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Дополнить отзыв
                    </button>
                    <span class="text-sm md:hidden inline">2020/01/16</span>
                </div>
                <div class="flex items-center xl:items-end justify-between gap-4 xl:flex-nowrap flex-wrap">
                    <div class="flex flex-col gap-1">
                        <label class="text-input-divider text-xs font-medium tracking-wide pl-2">Тип отзыва:</label>
                        <span class="bg-primary text-white rounded-3xl px-5 py-3 font-medium text-sm">Положительный отзыв</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-input-divider text-xs font-medium tracking-wide">Моя оценка:</label>
                        <div class="text-xl lg:text-3xl flex items-center w-[50%] md:w-auto order-1 md:order-0">
                            <span class="pr-1 text-lg">4.79</span>
                            <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars" role="img">
                                <img src="{{ asset('icons/Starmini.svg') }}" class="inline-block" alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="inline-block" alt="" />
                                <img src="{{ asset('icons/Starmini.svg') }}" class="inline-block" alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="inline-block" alt="" />
                                <img src="{{ asset('icons/Stargraymini.svg') }}" class="inline-block" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="w-fit flex items-center sm:items-start gap-4 sm:flex-row flex-col xl:gap-8">
                        <div class="min-h-[8.125rem] flex items-center justify-center border rounded-xl">
                            <img src="{{ asset('images/image4.png') }}" class="w-[80%] mx-auto h-auto min-h-[6.125rem]" alt="" />
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <h2 class="text-lg font-bold text-text2 tracking-wide">ЖК “Cказка Град”</h2>
                            <p class="font-semibold text-sm tracking-wide text-text2">г. Краснодар, ул.Западный обход,33</p>
                            <div class="font-semibold text-sm tracking-wide mt-4">
                                Застройщик: <span class="text-primary">ТОЧНО</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form class="flex flex-wrap gap-8 form" id="redaktForm" novalidate>
                @csrf
                <div class="form-item w-full">
                    <label for="name" class="text-input-divider text-xs font-medium tracking-wide pl-2">Заголовок:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <input type="text" class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none" placeholder="Password" id="name" value="ЖК “Губернский”" />
                    </div>
                </div>

                <div class="form-item w-full">
                    <label for="name" class="text-input-divider text-xs font-medium tracking-wide pl-2">Текст отзыва:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 py-2 flex items-center mt-1">
                        <textarea placeholder="Введите текст" id="name" rows="5" value="Купили квартиру на стадии строительства у застройщика ЮгСтройИмпериал в ЖК Родные просторы. Цены приятно удивили. Ну, понятное дело, на старте обычно дешевле........" class="text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"></textarea>
                    </div>
                </div>

                <div class="w-full swiper md:!overflow-auto md:pr-2 pr-0" id="redaktFileContainer">
                    <div class="swiper-wrapper md:flex md:items-center md:justify-end md:flex-wrap md:gap-4 md:max-h-[14.6875rem] md:h-auto"></div>
                </div>

                <div class="form-item w-full">
                    <label for="name" class="text-input-divider text-xs font-medium tracking-wide pl-2">Дополнение к отзыву:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <input type="text" class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none" placeholder="Введите текст текст дополнения" id="name" value="ЖК “Губернский”" />
                    </div>
                </div>

                <div class="flex items-center w-full justify-end">
                    <input type="file" class="hidden" id="redaktFileInput" />
                    <button
                        type="button"
                        onclick="handleFileUpload({inputSelector: '#redaktFileInput', targetContainerSelector: '#redaktFileContainer .swiper-wrapper', targetImageSelector: null, templateCallback: downloadFileTemplate, maxFiles: 10, allowedTypes: ['image/jpeg', 'image/png', 'application/pdf'], onError: (message) => alert(message), onSuccess: (file) => console.log(`Dosya yüklendi: ${file.name}`)})"
                        class="md:w-fit w-full mt-2 md:mt-6 border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Загрузить изображение
                    </button>
                </div>

                <button type="submit" class="w-full text-center py-2 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer my-2 md:my-6.5">
                    Опубликовать дополнение
                </button>
            </form>
        </div>
    </div>
@endsection

