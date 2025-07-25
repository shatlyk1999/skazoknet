<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <x-seo-head />

    {{-- Fallback title if SEO not set --}}
    @if (!app('seo')->getTitle())
        <title>@yield('title', 'Skazoknet - Проекты недвижимости')</title>
    @endif

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.svg') }}">
    <link href="{{ asset('styles/output.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles/menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('swiper/swiper-bundle.css') }}" />
    <link rel="stylesheet" href="{{ asset('@mdi/font/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles/custom.css') }}" />
    @yield('css')
    @yield('script')

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="size-full">
    <div class="size-full relative">
        <header
            class="h-[6.25rem] left-0 top-0 z-10 w-full @if (isset($index_page)) bg-transparent absolute @else bg-primary @endif">
            <div class="flex items-center xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto justify-between h-full">
                <div class="flex items-center gap-x-12 h-10">
                    <div class="flex items-center gap-2">
                        <div class="lg:hidden flex">
                            <div class="cursor-pointer flex items-center justify-center pt-4 leading-10" id="menuToggle"
                                aria-label="Toggle menu"
                                onclick="toggleSidebar('menuToggle', 'sidebar', 'sidebarOverlay', 'closeSidebar')">
                                <img src="{{ asset('icons/menu.svg') }}" alt="" />
                            </div>
                        </div>
                        <a href="{{ route('home') }}">
                            <img class="w-[8.125rem]" src="{{ asset('images/logo.png') }}" alt="skazoknet.com" />
                        </a>
                    </div>
                    <div class="hidden items-center gap-x-8 lg:flex">
                        <a href="#" class="text-white text-lg leading-10 pt-4">Оставить отзыв</a>
                        {{-- <a href="#" class="text-white text-lg leading-10 pt-4">Пользователям</a> --}}
                    </div>
                </div>
                <div class="flex items-center gap-x-6 lg:gap-x-12 text-white h-10">
                    @if (isset($city))
                        <div class="flex gap-x-1 lg:gap-x-2 items-center leading-10 pt-4">
                            <span class="hidden lg:inline-block text-lg">Ваш город:</span>

                            <div onclick="openModal('reusableModal')"
                                class="flex items-center justify-between gap-x-2 cursor-pointer leading-10 pt-1">
                                <div class="relative">
                                    <span id="selectedCityDisplay">
                                        {{ $city->name }}
                                    </span>
                                    <div class="absolute bottom-2 left-0 w-full h-[1px] bg-white/50"></div>
                                </div>
                                <img src="{{ asset('icons/down-arrow 1.svg') }}" alt="" />
                            </div>
                        </div>
                    @endif
                    <div class="leading-10 pt-0 lg:pt-4 hidden lg:block">
                        @if (auth()->user())
                            {{-- <div class="dropdown dropdown-custom">
                                <button onclick="myFunction()"
                                    class="dropbtn cursor-pointer border-none bg-transparent outline-none hover:bg-black/5 transition-colors p-2 rounded-lg text-lg flex items-center gap-x-2">
                                    <img src="{{ asset('images/user 7.png') }}" class="size-7" alt="" />
                                    {{ auth()->user()->name }}
                                </button>
                                <div id="myDropdown" class="dropdown-content dropdown-content-custom">
                                    <form action="{{ route('logout') }}" class="" method="post">
                                        @csrf
                                        <button type="submit" class="cursor-pointer text-text">
                                            Выйти
                                        </button>
                                    </form>
                                </div>
                            </div> --}}
                            @if (auth()->user()->role == 'developer')
                                <a href="#" class="flex justify-center items-center gap-2">
                                    <img src="{{ asset('images/user 7.png') }}" class="size-7" alt="" />
                                    {{ auth()->user()->name }}
                                </a>
                            @endif
                            @if (auth()->user()->role == 'user')
                                <a href="{{ route('userProfile', auth()->user()->id) }}"
                                    class="flex justify-center items-center gap-2">
                                    <img src="{{ asset('images/user 7.png') }}" class="size-7" alt="" />
                                    {{ auth()->user()->name }}
                                </a>
                            @endif
                            @if (auth()->user()->role == 'superadmin')
                                <a href="{{ route('userProfile', auth()->user()->id) }}"
                                    class="flex justify-center items-center gap-2">
                                    <img src="{{ asset('images/user 7.png') }}" class="size-7" alt="" />
                                    {{ auth()->user()->name }}
                                </a>
                            @endif
                        @else
                            <a href="{{ route('registration') }}"
                                class="cursor-pointer border-none bg-transparent outline-none hover:bg-black/5 transition-colors p-2 rounded-lg text-lg flex items-center gap-x-2">
                                <img src="{{ asset('icons/add 1.svg') }}" alt="" />
                                Войти
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </header>
