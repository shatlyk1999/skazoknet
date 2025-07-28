@extends('layouts.app')

@section('title', ' Получение доступа | Сказокнет')

@section('content')

    <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden items-center">
        <a href="{{ route('home') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</a>
        <span class="px-2">|</span>
        <span class="text-sm xl:text-xs tracking-widest text-primary">Получение доступа к аккаунту</span>
    </div>

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative">
        <div class="flex gap-4">
            <div class="w-full md:w-[60%] flex flex-col gap-10">
                <h1 class="font-bold text-xl md:text-2xl lg:text-4xl tracking-widest text-text w-[80%]">
                    Получение доступа
                </h1>
                <span class="text-sm md:text-base text-text2 tracking-wide">После короткого обзора, наш ответ будет отправлен
                    вам по электронной почте.</span>
                <div class="flex items-center w-full justify-between md:flex-row flex-col">
                    <div class="flex items-center md:flex-row flex-col gap-4 mt-6">
                        <img src="{{ asset('icons/check.svg') }}" alt="" />
                        <p class="font-semibold text-base md:text-left text-center tracking-wider">
                            Заявка принята
                        </p>
                    </div>
                    <a href="{{ route('home') }}"
                        class="w-full lg:w-[calc(50%-1.5rem)] text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-6.5 flex justify-center items-center">
                        Перейти на главную
                    </a>
                </div>
            </div>
            <div class="md:w-[40%] hidden md:flex items-center justify-center">
                <img class="w-full h-auto max-w-[26.25rem] max-h-[25rem] min-h-[21.875rem]"
                    src="{{ asset('images/Group 456.png') }}" alt="" />
            </div>
        </div>

        {{-- <button onclick="window.history.back()"
            class="absolute right-12 top-4 z-10 rounded-full px-2 py-1 bg-custom-gray-2 cursor-pointer text-white md:hidden block">
            <i class="mdi mdi-chevron-left"></i>
        </button> --}}
        <div class="md:hidden absolute left-0 top-0 z-[-1] size-full flex justify-center">
            <img src="{{ asset('images/Group 2344.png') }}" class="w-full max-w-[25rem] h-auto max-h-[31rem] min-h-[31rem]"
                alt="" />
        </div>
    </div>


@endsection
