@if ($developers->count() > 0)
    @foreach ($developers as $key => $developer)
        <a href="{{ route('show.developer', $developer->slug) }}"
            class="w-full lg:w-[calc(100%/2-1rem)] rounded-2xl p-8 border border-input-border-color hidden sm:flex items-center sm:items-start gap-4 sm:flex-row flex-col xl:gap-8 hover:border-primary">
            @if ($developer->image != null)
                <div class="flex items-center justify-center h-full w-[40%]">
                    <img src="{{ asset('developer-small/' . $developer->image) }}"
                        class="h-auto h-full border border-input-border-color rounded-md"
                        style="max-width: -webkit-fill-available" alt="{{ $developer->name }}" />
                </div>
            @else
                <div class="flex items-center justify-center h-full border border-input-border-color rounded-md w-[40%]">
                    <img src="{{ asset('images/zaglushka.svg') }}"
                        class="h-auto min-h-[6.125rem] h-full w-[50%] min-w-[50%]" alt="{{ $developer->name }}" />
                </div>
            @endif
            <div class="flex flex-col gap-2 w-full h-full justify-between">
                <div>
                    <div class="flex items-start justify-between">
                        <h2 class="text-lg font-bold text-text2 tracking-wide">
                            “{{ $developer->name }}”
                        </h2>
                        @if ($developer->popular == '1')
                            <span
                                style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
                        @endif
                    </div>
                    <br>
                    <p class="font-semibold text-sm tracking-wide text-text2">
                        Год основания: {{ $developer->year_establishment }} г. | Количество объектов:
                        {{ $developer->complexes()->count() }}
                    </p>
                </div>
                <div
                    class="flex items-start xl:items-center xl:flex-row flex-col xs:flex-row sm:flex-col justify-between my-0 xl:my-2 gap-y-1 xl:gap-0">
                    <div class="flex items-center gap-x-2">
                        <span class="text-lg font-semibold">4.7</span>
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                            115</span>
                        <span class="text-sm tracking-wide">Комментариев</span>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
@else
    <div class="flex justify-center items-center">
        Данных нет
    </div>
@endif

<!-- Mobile card -->
@if ($developers->count() > 0)
    @foreach ($developers as $key => $developer)
        <div class="relative rounded-xl basis-full group hover:shadow-md sm:hidden block">
            <div class="border border-custom-gray rounded-tl-xl rounded-tr-xl">
                @if ($developer->image != null)
                    <img src="{{ asset('developer-small/' . $developer->image) }}"
                        class="w-full h-auto rounded-tl-xl rounded-tr-xl max-h-[10.625rem] min-h-[10.625rem]"
                        alt="{{ $developer->name }}" />
                @else
                    <img src="{{ asset('images/zaglushka.svg') }}"
                        class="rounded-tl-xl rounded-tr-xl w-[50%] mx-auto max-h-[10.625rem] min-h-[10.625rem] object-contain"
                        alt="{{ $developer->name }}" />
                @endif
            </div>
            <div
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">
                    “{{ $developer->name }}”
                </h2>
                <p>Год основания: {{ $developer->year_establishment }}</p>
                <p class="mt-8">Количество объектов: {{ $developer->complexes()->count() }}</p>
                <div class="flex items-center justify-between gap-x-2">
                    <div class="flex md:flex-col gap-2 flex-row justify-between w-full md:w-auto">
                        <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
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
                    <div class="group-hover:hidden">
                        {{-- <button
                        class="border-primary border text-sm xl:text-base rounded-3xl px-3 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer hidden md:flex items-center gap-x-2">
                        <!-- <i class="mdi mdi-plus"></i> -->
                        <img src="icons/Vector.svg" alt="" />
                        <span>Оставить отзыв</span>
                    </button> --}}
                    </div>
                </div>
            </div>
            <div class="absolute top-4 right-4 z-10">
                <span class="bg-primary text-white py-2 px-3 rounded-lg">
                    115 Отзывов
                </span>
            </div>
            <div
                class="absolute top-0 left-0 z-11 size-full bg-primary/90 rounded-xl flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="flex flex-col gap-2 items-center">
                    <a href="{{ route('show.developer', $developer->slug) }}"> Узнать подробнее</a>
                    {{-- <button
                    class="border-white border text-sm xl:text-base rounded-3xl px-3 py-2 text-white transition-colors cursor-pointer flex items-center gap-x-2">
                    <i class="mdi mdi-plus"></i>
                    <span>Оставить отзыв</span>
                </button> --}}
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- Mobile card -->
