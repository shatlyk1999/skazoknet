<section class="flex flex-row relative w-full">
    <div class="w-full md:w-[55%] bg-primary relative h-dvh md:h-auto"></div>
    <div class="w-0 hidden md:block md:w-[45%] relative">
        @if (isset($city))
            <img src="{{ asset('cities/' . $city->image) }}" class="w-full h-[48rem]" alt="{{ $city->name }}" />
        @else
            <img src="{{ asset('images/Rectangle 3.png') }}" class="w-full h-[48rem]" alt="" />
        @endif
    </div>
    <div class="absolute top-[20%] md:top-[40%] left-0 leading-0 w-full z-10">
        <div class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto flex justify-between relative">
            <div class="w-full md:w-[calc(65%-2rem)] mr-0 md:mr-8">
                <div class="text-white mb-[2rem] xs:mb-[5rem]">
                    <h1 class="text-3xl md:text-5xl xl:text-6xl font-bold tracking-wide mb-2 md:mb-4">
                        Отзывы без иллюзий
                    </h1>
                    <p class="text-xs md:text-lg xl:text-xl font-medium">
                        Забудьте о сказках, выбирайте с уверенностью
                    </p>
                </div>
                <div class="w-full text-text flex flex-wrap md:flex-nowrap gap-4 xl:gap-8 items-center">
                    <a href="{{ route('complexes', 'residential') }}"
                        class="bg-white w-full p-4 rounded-lg flex flex-row md:flex-col gap-4">
                        <img class="w-[5.625rem] md:w-[5rem] xl:w-[6rem] h-[4.375rem] md:h-[3rem] xl:h-[3.75rem]"
                            src="{{ asset('images/1.svg') }}" alt="" />
                        <h2 class="text-base md:block hidden h-12 xl:h-auto xl:text-lg font-bold">
                            Жилые комплексы
                        </h2>
                        <p class="text-sm xl:text-base text-custom-gray hidden md:block">
                            {{ $residential_count }}
                        </p>
                        <div class="w-full md:hidden flex flex-col gap-2">
                            <h2 class="text-base md:h-12 xl:h-auto xl:text-lg font-bold">
                                Жилые комплексы
                            </h2>
                            <p class="text-sm xl:text-base text-custom-gray inline-block">
                                {{ $residential_count }}
                            </p>
                        </div>
                    </a>
                    <a href="{{ route('developers') }}"
                        class="bg-white w-full p-4 rounded-lg flex flex-row md:flex-col gap-4">
                        <img class="w-[5.625rem] md:w-[5rem] xl:w-[6rem] h-[4.375rem] md:h-[3rem] xl:h-[3.75rem]"
                            src="{{ asset('images/2.svg') }}" alt="" />

                        <h2 class="text-base md:block hidden h-12 xl:h-auto xl:text-lg font-bold">
                            Застройщики
                        </h2>
                        <p class="text-sm xl:text-base text-custom-gray hidden md:block">
                            {{ $count_developers }}
                        </p>
                        <div class="w-full md:hidden flex flex-col gap-2">
                            <h2 class="text-base md:h-12 xl:h-auto xl:text-lg font-bold">
                                Застройщики
                            </h2>
                            <p class="text-sm xl:text-base text-custom-gray inline-block">
                                {{ $count_developers }}
                            </p>
                        </div>
                    </a>
                    <a href="{{ route('complexes', 'hotel') }}"
                        class="bg-white w-full p-4 rounded-lg flex flex-row md:flex-col gap-4">
                        <img class="w-[5.625rem] md:w-[5rem] xl:w-[6rem] h-[4.375rem] md:h-[3rem] xl:h-[3.75rem]"
                            src="{{ asset('images/3.svg') }}" alt="" />
                        <h2 class="text-base md:block hidden h-12 xl:h-auto xl:text-lg font-bold whitespace-nowrap">
                            Гостиничные комплексы
                        </h2>
                        <p class="text-sm xl:text-base text-custom-gray hidden md:block">
                            {{ $hotel_count }}
                        </p>
                        <div class="w-full flex-col gap-2 md:hidden flex">
                            <h2 class="text-base md:h-12 xl:h-auto xl:text-lg font-bold">
                                Гостиничные комплексы
                            </h2>
                            <p class="text-sm xl:text-base text-custom-gray inline-block">
                                {{ $hotel_count }}
                            </p>
                        </div>
                    </a>
                </div>
                <div class="md:hidden block w-full mt-4 xs:mt-8">
                    <button
                        class="border-white border w-full text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2 justify-center">
                        <i class="mdi mdi-plus"></i>
                        <span>Оставить отзыв</span>
                    </button>
                </div>
            </div>
            <div
                class="w-full md:w-[35%] absolute right-0 z-[-1] -top-[4.25rem] md:top-auto -bottom-[2rem] md:-bottom-[3.5rem] lg:-bottom-[6.7rem] xl:-bottom-[6.2rem]">
                <img src="{{ asset('images/project.png') }}" alt=""
                    class="w-[90%] md:w-full max-[90.625]:w-[80%] mx-auto h-full sm:min-h-[22.5rem] lg:min-h-[25rem] xl:min-h-[27.75rem] hidden md:block" />
                <img src="{{ asset('images/Group 269.png') }}" alt=""
                    class="w-full max-h-[35rem] xs:max-h-max md:w-full max-[90.625]:w-[80%] mx-auto h-full sm:min-h-[22.5rem] lg:min-h-[25rem] xl:min-h-[27.75rem] md:hidden block" />
            </div>
        </div>
    </div>
</section>
