@if ($complexes->count() > 0)
    @foreach ($complexes as $key => $complex)
        <a href="{{ route('show.complex', $complex->slug) }}"
            class="w-full lg:w-[calc(100%/2-1rem)] rounded-2xl p-8 border border-input-border-color hidden sm:flex items-center sm:items-start gap-4 sm:flex-row flex-col xl:gap-8 hover:border-primary">
            @if ($complex->image != null)
                <div class="flex items-center justify-center h-full w-[40%]">
                    <img src="{{ asset('complex-small/' . $complex->image) }}"
                        class="h-auto h-full border border-input-border-color rounded-md"
                        style="max-width: -webkit-fill-available" alt="{{ $complex->image }}" />
                </div>
            @else
                <div class="flex items-center justify-center h-full border border-input-border-color rounded-md w-[40%]">
                    <img src="{{ asset('images/zaglushka.svg') }}"
                        class="h-auto min-h-[6.125rem] h-full w-[50%] min-w-[50%]" alt="{{ $complex->image }}" />
                </div>
            @endif
            <div class="flex flex-col gap-2 w-full">
                <div class="flex items-start justify-between">
                    <h2 class="text-lg font-bold text-text2 tracking-wide">
                        {{ $type == 'residential' ? 'ЖК' : 'ГК' }} “{{ $complex->name }}”
                    </h2>
                    @if ($complex->popular == '1')
                        <span
                            style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
                    @endif
                </div>
                <p class="font-semibold text-sm tracking-wide text-text2">
                    {{ $complex->address }}
                </p>
                <div
                    class="flex items-start xl:items-center xl:flex-row flex-col xs:flex-row sm:flex-col justify-between my-0 xl:my-2 gap-y-1 xl:gap-0">
                    <div class="flex items-center gap-x-2">
                        {{-- <span class="text-lg font-semibold">4.7</span> --}}
                        {{-- <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                        </div> --}}
                        @include('inc.star_rating', [
                            'type' => 'complex',
                            'main' => 'true',
                            'width' => '27px',
                            'height' => '27px',
                        ])
                    </div>
                    <div class="flex items-center gap-x-2">
                        <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                            {{ $complex->reviews()->where('is_approved', true)->count() }}</span>
                        <span class="text-sm tracking-wide">Комментариев</span>
                    </div>
                </div>
                <div class="font-semibold text-sm tracking-wide">
                    Застройщик: <span class="text-primary">{{ $complex->developer->name }}</span>
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
@if ($complexes->count() > 0)
    @foreach ($complexes as $key => $complex)
        <a href="{{ route('show.complex', $complex->slug) }}"
            class="relative rounded-xl basis-full group hover:shadow-md sm:hidden block">
            <div class="border border-custom-gray rounded-tl-xl rounded-tr-xl">
                @if ($complex->image != null)
                    <img src="{{ asset('complex/' . $complex->image) }}"
                        class="w-full h-auto rounded-tl-xl rounded-tr-xl max-h-[10.625rem] min-h-[10.625rem]"
                        alt="{{ $complex->name }}" />
                @else
                    <img src="{{ asset('images/zaglushka.svg') }}"
                        class="rounded-tl-xl rounded-tr-xl w-[50%] mx-auto max-h-[10.625rem] min-h-[10.625rem] object-contain"
                        alt="{{ $complex->name }}" />
                @endif
            </div>
            <div
                class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
                <h2 class="font-semibold text-lg">
                    {{ $type == 'residential' ? 'ЖК' : 'ГК' }} “{{ $complex->name }}”
                </h2>
                <p>{{ $complex->address }}</p>
                <p class="mt-8">Застройщик: {{ $complex->developer->name }}</p>
                <div class="flex items-center justify-between gap-x-2">
                    <div class="flex md:flex-col gap-2 flex-row justify-between w-full md:w-auto">
                        {{-- <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars"
                            role="img">
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                            <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                        </div> --}}
                        @include('inc.star_rating', [
                            'type' => 'complex',
                            'main' => 'false',
                            'width' => '27px',
                            'height' => '27px',
                        ])
                        <div class="text-primary text-sm">
                            {{ $complex->reviews()->where('is_approved', true)->where('type', 'positive')->count() }}/<span
                                class="text-red-500">{{ $complex->reviews()->where('is_approved', true)->where('type', 'negative')->count() }}</span>
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
                    {{ $complex->reviews()->where('is_approved', true)->count() }} Отзывов
                </span>
            </div>

        </a>
    @endforeach
@endif

<!-- Mobile card -->
