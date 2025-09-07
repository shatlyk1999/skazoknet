@extends('layouts.app')

@section('title', ' Контакт | Сказокнет')

@section('content')

    <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden items-center">
        <a href="{{ route('home') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</a>
        <span class="px-2">|</span>
        <span class="text-sm xl:text-xs tracking-widest text-primary">Контакт</span>
    </div>

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative">
        <div class="flex gap-4">
            <div class="w-full md:w-[60%] flex flex-col gap-10">
                <h1 class="font-bold text-xl md:text-2xl lg:text-3xl tracking-widest text-text w-[80%]">
                    Вы можете связаться с нами
                </h1>
                <div class="w-full mt-8">
                    <form class="flex flex-wrap gap-6 form" action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? null }}">
                            <label for="company_name"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Введите
                                почту::</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <input type="email" required
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Введите вашу почту" id="email" name="email" />
                            </div>
                        </div>
                        <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                            <label for="tel_number"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Телефонный номер::</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                                <input type="number" name="tel_number" required
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Введите Телефонный номер" />
                            </div>
                        </div>

                        <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                            <label for="email"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Заметка:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <textarea required class=" text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Введите Заметка" id="note" name="note"></textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full lg:w-[calc(50%-1.5rem)] text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-6.5">
                            Отправить
                        </button>
                    </form>
                </div>
            </div>
            <div class="md:w-[40%] hidden md:flex items-center justify-center">
                <img class="w-full h-auto max-w-[26.25rem] max-h-[25rem] min-h-[21.875rem]"
                    src="{{ asset('images/Group 456.png') }}" alt="" />
            </div>
        </div>

        <button onclick="window.history.back()"
            class="absolute right-12 top-4 z-10 rounded-full px-2 py-1 bg-custom-gray-2 cursor-pointer text-white md:hidden block">
            <i class="mdi mdi-chevron-left"></i>
        </button>

        <div class="md:hidden absolute left-0 top-0 z-[-1] size-full flex justify-center">
            <img src="{{ asset('images/Group 2344.png') }}" class="w-full max-w-[25rem] h-auto max-h-[31rem] min-h-[31rem]"
                alt="" />
        </div>
    </div>

@endsection
