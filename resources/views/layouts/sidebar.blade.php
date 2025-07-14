<div id="sidebarOverlay"
    class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out z-20">
</div>
<div id="sidebar"
    class="fixed top-0 h-full w-full sm:w-[50%] bg-primary text-white transition-all duration-300 ease-in-out z-30 rounded-r-lg shadow-lg block lg:hidden"
    role="navigation">
    <div class="flex justify-end p-4 relative">
        <button id="closeSidebar" onclick="toggleSidebar('menuToggle', 'sidebar', 'sidebarOverlay', 'closeSidebar')"
            class="text-white text-2xl hover:rotate-90 hover:bg-white/10 px-1 rounded-full transition-all duration-200 border border-white"
            aria-label="Close menu">
            <i class="mdi mdi-close"></i>
        </button>
        <div class="absolute z-[-1] top-0 left-1/2 -translate-x-1/2 h-full w-full flex items-center justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="logo" />
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
        <div class="flex justify-center items-center">
            @if (auth()->user())
                <form action="{{ route('logout') }}" class="" method="post">
                    @csrf
                    <button type="submit" class="cursor-pointer flex justify-center items-center gap-2">
                        <img src="{{ asset('icons/logout.svg') }}" alt="" />
                        Выйти
                    </button>
                </form>
            @else
                <a href="{{ route('registration') }}"
                    class="cursor-pointer border-none bg-transparent outline-none hover:bg-black/5 transition-colors p-2 rounded-lg text-lg flex items-center gap-x-2">
                    <img src="{{ asset('icons/add 1.svg') }}" alt="" />
                    Войти
                </a>
            @endif
        </div>
    </nav>
</div>
