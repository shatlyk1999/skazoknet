<div onclick="window.location.href='{{ route('show.complex', $complex->slug) }}'"
    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md cursor-pointer">
    @if ($complex->image != null)
        <div class="border border-custom-gray rounded-tl-xl rounded-tr-xl">
            <img src="{{ asset('complex/' . $complex->image) }}"
                class="rounded-tl-xl rounded-tr-xl w-full h-auto 2xl:min-h-[15.5rem] 2xl:max-h-[15.5rem] xl:min-h-[13.6875rem] min-w-full xl:max-h-[13.6875rem] min-h-[10.5rem] max-h-[10.5rem] object-cover"
                alt="{{ $complex->name }}" {{-- style="border-top-left-radius: 10px;border-top-right-radius:10px;"  --}} />
        </div>
    @else
        <div class="border border-custom-gray rounded-tl-xl rounded-tr-xl">
            <img src="{{ asset('images/zaglushka.svg') }}"
                class="rounded-tl-xl rounded-tr-xl w-[50%] min-w-[50%] mx-auto h-auto 2xl:min-h-[15.5rem] 2xl:max-h-[15.5rem] xl:min-h-[13.6875rem] xl:max-h-[13.6875rem] min-h-[10.5rem] max-h-[10.5rem] object-contain"
                alt="{{ $complex->name }}" />
        </div>
    @endif
    <div
        class="p-4 flex flex-col gap-2 group-hover:border-primary border-custom-gray border border-t-0 rounded-bl-xl rounded-br-xl">
        <h2 class="font-semibold text-lg line-clamp-1">
            {{ $complex->name }}
        </h2>
        <p class="line-clamp-2" style="min-height: 50px;">
            {{ $complex->address }}
        </p>
        <p class="mt-8">Застройщик:
            <a href="{{ route('show.developer', $complex->developer->slug) }}"
                class="text-primary hover:underline">#{{ $complex->developer->name }}</a>
        </p>
        <div class="flex items-start justify-between items-center">
            <div class="flex items-center justify-between gap-x-2">
                <div class="flex md:flex-col gap-2 flex-row justify-between w-full md:w-auto">
                    @include('inc.star_rating', [
                        'type' => 'complex',
                        'main' => 'false',
                        'width' => '27px',
                        'height' => '27px',
                    ])
                    <div class="text-primary text-sm">
                        {{ $complex->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->where('type', 'positive')->count() }}/<span
                            class="text-red-500">{{ $complex->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->where('type', 'negative')->count() }}</span>
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
            @if ($complex->popular == '1')
                <span
                    style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
            @endif
        </div>
    </div>
    <div class="absolute top-4 right-4 z-10">
        <span class="bg-primary text-white py-2 px-3 rounded-lg text-xs xs:text-sm">
            {{ $complex->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->count() }} Отзывов
        </span>
    </div>

</div>
