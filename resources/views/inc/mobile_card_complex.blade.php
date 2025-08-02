<div class="swiper-slide" onclick="window.location.href='{{ route('show.complex', $complex->slug) }}'"
    style="cursor: pointer;">
    <div class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md">
        <div class="border border-custom-gray rounded-tl-xl rounded-tr-xl">
            @if ($complex->image != null)
                <img src="{{ asset('complex/' . $complex->image) }}"
                    class="w-full h-auto rounded-tl-xl rounded-tr-xl max-h-[10.625rem]" alt="{{ $complex->name }}"
                    style="border-top-left-radius: 10px;border-top-right-radius:10px;" />
            @else
                <img src="{{ asset('images/zaglushka.svg') }}"
                    class="rounded-tl-xl rounded-tr-xl w-[50%] mx-auto max-h-[10.625rem] object-contain"
                    alt="{{ $complex->name }}" style="height:137px;" />
            @endif
        </div>
        <div
            class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
            <h2 class="font-semibold text-lg line-clamp-1">
                {{ $complex->name }}
            </h2>
            <p class="line-clamp-2" style="min-height: 50px;">
                {{ $complex->address }}
            </p>
            <p class="mt-8">Застройщик: {{ $complex->developer->name }}</p>
            <div class="flex items-center justify-between gap-x-2">
                <div class="flex md:flex-col gap-2 flex-row justify-between w-full md:w-auto">
                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars" role="img">
                        <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                        <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                    </div>
                    <div class="text-primary text-sm">
                        115/<span class="text-red-500">15</span>
                    </div>
                </div>
                <div class="group-hover:hidden">
                    {{-- <button
                        class="border-primary border text-xs xl:text-sm rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
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

    </div>
</div>
