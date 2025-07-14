<footer class="bg-primary py-8 sm:py-15">
    <div class="xl:container px-12 xl:px-4 mx-0 xl:mx-auto w-full">
        <div class="flex items-center flex-col lg:flex-row justify-between gap-16 xl:gap-24 text-white">
            <a href="#" class="w-full max-w-[15rem] xl:max-w-[18.125rem]">
                <img src="{{ asset('images/footer_logo.png') }}" class="w-full h-auto" alt="" />
            </a>
            <div
                class="basis-full lg:w-[calc(100%-19rem)] xl:w-[calc(100%-24.125rem)] hidden sm:flex flex-wrap gap-x-18">
                <div class="w-[calc((100%/3)-3rem)] gap-y-4 xl:gap-y-6">
                    <h2 class="font-semibold text-lg xl:text-xl mb-4 xl:mb-6">
                        Полезная информация
                    </h2>
                    <div class="flex flex-col gap-y-4 xl:gap-y-6 pl-2">
                        <a href="{{ route('about_us') }}" class="text-sm">О проекте</a>
                        <a href="{{ route('developers') }}" class="text-sm">Застройщики</a>
                        <a href="{{ route('complexes', 'residential') }}" class="text-sm">Жилые комплексы</a>
                        {{-- <a href="{{ route('complexes', 'hotel') }}" class="text-sm">Гостиничные комплексы</a> --}}
                    </div>
                </div>
                <div class="w-[calc((100%/3)-3rem)] gap-y-4 xl:gap-y-6">
                    <h2 class="font-semibold text-lg xl:text-xl mb-4 xl:mb-6">
                        Условия пользования
                    </h2>
                    <div class="flex flex-col gap-y-4 xl:gap-y-6 pl-2">
                        <a href="#" class="text-sm">Пользовательское соглашение</a>
                        <a href="#" class="text-sm">Обработка персональных данных</a>
                        <a href="#" class="text-sm">Публикация</a>
                    </div>
                </div>
                <div class="w-[calc((100%/3)-3rem)] gap-y-4 xl:gap-y-6">
                    <h2 class="font-semibold text-lg xl:text-xl mb-4 xl:mb-6">
                        Компаниям
                    </h2>
                    <div class="flex flex-col gap-y-4 xl:gap-y-6 pl-2">
                        <a href="#" class="text-sm">Получение доступа</a>
                        <a href="#" class="text-sm">Реклама на сайте</a>
                        <a href="#" class="text-sm">Обратная связь</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->

<div id="modalOverlay"
    class="fixed inset-0 bg-black/50 bg-opacity-50 z-40 hidden transition-opacity duration-300 ease-out opacity-0 backdrop-blur-md">
</div>

<div id="reusableModal"
    class="fixed inset-0 h-auto sm:h-full top-0 sm:top-[6rem] z-50 items-center justify-center p-0 sm:p-4 hidden transition-all duration-300 ease-out transform opacity-0 scale-95 -translate-y-5">
    <div
        class="bg-white rounded-lg shadow-xl xl:container px-0 sm:px-8 lg:px-12 xl:px-4 mx-0 xl:mx-auto w-full max-h-full h-full sm:h-auto overflow-y-auto">
        <div class="p-4 lg:p-6">
            <div class="flex justify-end items-center pb-3">
                <button onclick="closeModal('reusableModal')"
                    class="text-gray-500 hover:text-gray-800 focus:outline-none rounded-full border p-1 sm:p-2 cursor-pointer">
                    <svg class="sm:size-6 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div id="modalBody">
                <h1
                    class="tracking-widest text-lg sm:text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                    Выберите ваш город
                </h1>
                <div
                    class="mt-4 sm:mt-8 flex items-center gap-x-2 rounded-3xl border border-input-border-color px-4 h-10 w-full md:w-[80%]">
                    <img src="{{ asset('icons/search 1.svg') }}" alt="" />
                    <input type="text" class="border-none outline-none h-10 w-full"
                        placeholder="Введите название для быстрого поиска" />
                </div>

                <div id="cityListContainer" class="flex flex-col gap-4 mt-8 pl-2 sm:pl-8 max-h-[300px] overflow-y-auto">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
</div>

<script src="{{ asset('js/component.js') }}" defer></script>
<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('swiper/swiper-bundle.min.js') }}" defer></script>
<script src="{{ asset('js/swiper.js') }}" defer></script>
<script src="{{ asset('js/card.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}" defer></script>
@yield('script')
</body>

</html>
