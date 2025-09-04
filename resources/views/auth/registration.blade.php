<x-auth.auth-layout>
    <div class="my-0 md:my-12 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto h-full md:h-[calc(100dvh-7.5rem)]">
        <div class="flex items-center gap-8 md:items-start justify-between h-full md:flex-row flex-col">
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <h1 class="inline-block font-bold tracking-widest text-3xl md:hidden text-primary mb-4">
                    Добро пожаловать!
                </h1>
                <h1 class="text-text font-bold text-2xl tracking-wider">
                    Вход / Регистрация
                </h1>
                <div class="flex flex-col w-full gap-4 mt-6">
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer">
                        Войти
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer">
                        Зарегистрироваться
                    </a>
                </div>
            </div>
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <img src="{{ asset('images/registerimage.png') }}" class="w-full h-auto" alt="" />

                <a href="{{ route('home') }}" class="pt-8 flex items-center justify-center md:hidden">
                    <img src="{{ asset('images/registerlogo.png') }}" class="h-10 w-37.5" alt="" />
                </a>
            </div>
        </div>
    </div>
</x-auth.auth-layout>
