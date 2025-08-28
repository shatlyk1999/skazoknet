@extends('layouts.app')

@section('title', 'Оставить отзыв')

@section('content')
    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto">
        <div class="flex flex-col gap-y-8">
            <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wider text-text">
                Оставить отзыв
            </h1>
            <h4 class="xl:text-base text-sm text-black tracking-wide font-normal">
                Отзыв могут оставить только зарегистрированные пользователи
            </h4>
            <div class="flex items-center sm:flex-row flex-col gap-6">
                <a href="{{ route('login') }}"
                    class="sm:w-fit w-full border border-primary rounded-3xl text-primary text-sm font-bold tracking-wide px-8 py-3 hover:bg-primary hover:text-white transition-colors cursor-pointer text-center">
                    Войти
                </a>
                <a href="{{ route('register') }}"
                    class="sm:w-fit w-full border border-primary rounded-3xl text-primary text-sm font-bold tracking-wide px-8 py-3 hover:bg-primary hover:text-white transition-colors cursor-pointer text-center">
                    Зарегистрироваться
                </a>
            </div>
        </div>
    </div>
@endsection
