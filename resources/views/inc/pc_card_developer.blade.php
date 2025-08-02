<div onclick="window.location.href='{{ route('show.developer', $developer->slug) }}'"
    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md cursor-pointer">
    @if ($developer->image != null)
        <div class="border border-custom-gray rounded-tl-xl rounded-tr-xl">
            <img src="{{ asset('developer/' . $developer->image) }}"
                class="rounded-tl-xl rounded-tr-xl w-full h-auto 2xl:min-h-[15.5rem] 2xl:max-h-[15.5rem] xl:min-h-[13.6875rem] min-w-full xl:max-h-[13.6875rem] min-h-[10.5rem] max-h-[10.5rem] object-cover"
                alt="{{ $developer->image }}" {{-- style="border-top-left-radius: 10px;border-top-right-radius:10px;"  --}} />
        </div>
    @else
        <div class="border border-custom-gray rounded-tl-xl rounded-tr-xl">
            <img src="{{ asset('images/zaglushka.svg') }}"
                class="rounded-tl-xl rounded-tr-xl w-[50%] min-w-[50%] mx-auto h-auto 2xl:min-h-[15.5rem] 2xl:max-h-[15.5rem] xl:min-h-[13.6875rem] xl:max-h-[13.6875rem] min-h-[10.5rem] max-h-[10.5rem] object-contain"
                alt="{{ $developer->image }}" />
        </div>
    @endif
    <div
        class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
        <h2 class="font-semibold text-lg">{{ $developer->name }}</h2>
        <p>Год основания: {{ $developer->year_establishment }} г.</p>
        <p class="mt-8">Количество объектов: {{ $developer->complexes()->count() }}</p>
        <div class="flex items-start justify-between">
            <div class="flex items-center justify-between gap-x-2">
                <div class="flex md:flex-col gap-2 flex-row justify-between w-full md:w-auto">
                    <div class="flex items-center space-x-px xs:space-x-px" aria-label="3 out of 5 stars"
                        role="img">
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
                {{-- <div class="group-hover:hidden">
                                    <button
                                    class="border-primary border text-xs xl:text-sm rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
                                    <!-- <i class="mdi mdi-plus"></i> -->
                                    <img src="../public/icons/Vector.svg" alt="" />
                                    <span>Оставить отзыв</span>
                                </button>
                            </div> --}}
            </div>
            @if ($developer->popular == '1')
                <span
                    style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>

                {{-- #F9DD4A --}}
            @endif
        </div>
    </div>
    <div class="absolute top-4 right-4 z-10">
        <span class="bg-primary text-white py-2 px-3 rounded-lg text-xs xs:text-sm">
            115 Отзывов
        </span>
    </div>

</div>
