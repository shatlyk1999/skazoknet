<div class="swiper-slide" onclick="handleCardClick(event, this)">
    <div
        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all">
        <div class="border-b border-custom-gray flex items-center justify-center">
            {{-- h-[13.75rem] --}}
            @if ($developer->image != null)
                <img src="{{ asset('developer/' . $developer->image) }}"
                    class="w-full h-auto rounded-tl-xl rounded-tr-xl max-h-[10.625rem]" alt=""
                    style="border-top-left-radius: 10px;border-top-right-radius:10px;" />
            @else
                <img src="{{ asset('images/zaglushka.svg') }}"
                    class="rounded-tl-xl rounded-tr-xl w-[50%] mx-auto max-h-[10.625rem] object-contain" alt=""
                    style="height:137px;" />
            @endif
        </div>
        <div class="p-4 flex flex-col gap-2">
            <h2 class="font-semibold text-lg line-clamp-1">{{ $developer->name }}</h2>
            <p>Год основания: {{ $developer->year_establishment }} г.</p>
            <p class="mt-8">Количество объектов: {{ $developer->complexes()->count() }}</p>
            <div class="flex items-center justify-between gap-x-2">
                <div class="flex md:flex-col flex-row gap-2 justify-between w-full">
                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars" role="img">
                        <!--<img src="../public/icons/Starmini.svg" alt="" /> -->
                        <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                    </div>
                    <div class="text-primary text-sm">
                        115/<span class="text-red-500">15</span>
                    </div>
                </div>
                <div class="group-hover:hidden">
                    {{-- <button
                        class="border-primary text-sm xl:text-base border rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
                        <img src="{{ asset('icons/Vector.svg') }}" alt="" />
                        <span>Оставить отзыв</span>
                    </button> --}}
                </div>
            </div>
        </div>
        <div class="absolute top-4 right-4 z-10">
            <span class="bg-primary text-white py-2 px-3 rounded-lg text-xs xs:text-sm">
                115 Отзывов
            </span>
        </div>
        <div data-id="overlay" data-card-overlay-id="6"
            class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all pointer-events-none group-hover:pointer-events-auto">
            <div class="flex flex-col gap-2 items-center">
                <a href="{{ route('show.developer', $developer->slug) }}"> Узнать подробнее</a>
                {{-- <button onclick="handleOverlayButtonClick(event, '6')"
                    class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                    <i class="mdi mdi-plus"></i>
                    <span>Оставить отзыв</span>
                </button> --}}
            </div>
        </div>
    </div>
</div>
