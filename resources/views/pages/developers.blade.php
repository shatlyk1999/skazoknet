@extends('layouts.app')

@section('title', 'Застройщики | Сказокнет')

@section('css')
    <link rel="stylesheet" href="{{ asset('styles/collapse.css') }}" />
@endsection

@section('content')

    <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden">
        <a href="{{ route('home') }}" class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</a>
        <span class="px-2">|</span>
        <span class="text-sm xl:text-xs tracking-widest text-primary">
            Застройщики , {{ $city->name }}</span>
    </div>

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative">
        <div class="flex flex-col gap-y-8">
            <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wider text-text">
                Застройщики , {{ $city->name }}
            </h1>
            <div class="flex items-start md:items-center md:flex-row flex-col justify-between gap-4">
                <div class="px-8 rounded-3xl h-12 flex items-center gap-x-2 w-full md:w-[70%] border border-input-border-color"
                    style="
                background: linear-gradient(to right, #fcfdff 10%, #f0f0f0 90%);
              ">
                    <img src="{{ asset('icons/search 1.svg') }}" alt="" />
                    {{-- <input type="text" class="h-12 border-none outline-none w-full" /> --}}
                    <input type="text" name="search" class="h-12 border-none outline-none w-full"
                        hx-get="{{ route('developers') }}" hx-trigger="keyup changed delay:1s" hx-target="#results"
                        hx-push-url="true" hx-swap="innerHTML" />
                </div>
                <div>
                    {{-- <button
                        class="flex items-center gap-x-2 bg-transparent hover:bg-black/5 px-3 py-2 transition-colors rounded-lg cursor-pointer">
                        <span>По умолчанию</span>
                        <img src="../public/icons/Group 334.svg" alt="" />
                    </button> --}}
                    @include('inc.developer_sort')
                </div>
            </div>
            <div class="flex flex-wrap gap-8" id="results">
                @include('inc.developer_search_result')
            </div>
        </div>
        <div class="flex justify-center items-center">
            {{ $developers->links('vendor.pagination.custom') }}
        </div>
        <button onclick="window.history.back()"
            class="absolute right-12 -top-8 z-10 rounded-full px-2 py-1 bg-custom-gray-2 cursor-pointer text-white md:hidden block">
            <i class="mdi mdi-chevron-left"></i>
        </button>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/unpkg.com-htmx.org@1.9.2.js') }}"></script>
@endsection
