<x-auth.auth-layout>
    <div class="my-0 md:my-12 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto h-full md:h-[calc(100dvh-7.5rem)]">
        <div class="flex items-center md:items-start justify-between h-full md:flex-row flex-col">
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto xl:mt-[10%]">
                <h1 class="text-text font-bold text-2xl tracking-wider">
                    Регистрация
                </h1>
                <div class="flex items-center md:flex-row flex-col gap-4 mt-6">
                    <img src="{{ asset('icons/check.svg') }}" alt="" />
                    <p class="font-semibold text-base md:text-left text-center tracking-wider">
                        На вашу почту отправлена
                        ссылка для подтверждения аккаунта!
                    </p>
                </div>
                {{-- <a href="{{ route('home') }}"
                    class="flex items-center justify-center mt-3 h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer">
                    Перейти на главную
                </a> --}}
            </div>
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <img src="{{ asset('images/registerimage.png') }}" class="w-full h-auto" alt="Изображение регистрации" />
                <a href="{{ route('home') }}" class="pt-8 flex items-center justify-center md:hidden">
                    <img src="{{ asset('images/registerlogo.png') }}" class="h-10 w-37.5" alt="Логотип" />
                </a>
            </div>
        </div>
    </div>
</x-auth.auth-layout>
