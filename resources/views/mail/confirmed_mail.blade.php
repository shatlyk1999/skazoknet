<x-auth.auth-layout>
    <div class="my-0 md:my-12 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto h-full md:h-[calc(100dvh-7.5rem)]">
        <div class="flex items-center md:items-start justify-between h-full md:flex-row flex-col">
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto xl:mt-[10%]">
                <h1 class="text-text font-bold text-2xl tracking-wider">
                    Добро пожаловать
                </h1>
                <div class="flex items-start md:flex-row flex-col gap-8 mt-6">
                    <img src="{{ asset('icons/check.svg') }}" alt="" />
                    <div>
                        <p class="font-semibold text-base md:text-left text-center tracking-wider">
                            Ваш аккаунт подтвержден!
                            <br>
                            Теперь вы можете:
                        </p>
                        <ul class="text-left text-gray-800 list-disc list-inside space-y-1 mb-4">
                            <li>Публиковать отзывы</li>
                            <li>Обсуждать и комментировать другие отзывы</li>
                            <li>Голосавать и оценивать другие отзывы на сайте</li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('home') }}"
                    class="flex items-center justify-center mt-3 h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer">
                    Перейти на главную
                </a>
            </div>
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <img src="{{ asset('registerimage.png') }}" class="w-full h-auto" alt="Изображение регистрации" />
                <div class="pt-8 flex items-center justify-center md:hidden">
                    <img src="{{ asset('registerlogo.png') }}" class="h-10 w-37.5" alt="Логотип" />
                </div>
            </div>
        </div>
    </div>
</x-auth.auth-layout>
