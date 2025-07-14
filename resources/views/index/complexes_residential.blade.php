<section class="xl:container px-0 sm:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
    <div class="px-8 xs:px-12 sm:px-0 flex items-center justify-between mb-8">
        <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
            Жилые комплексы в {{ $city->name }}е
        </h1>
        <a href="{{ route('complexes', 'residential') }}" class="md:inline-block hidden">Все жилые комплексы</a>
    </div>
    <div class="hidden sm:flex gap-8 flex-wrap">
        @foreach ($complexes_residential as $key => $complex)
            @include('inc.pc_card_complex')
        @endforeach
    </div>
    <div class="mt-8 block sm:hidden">
        <div class="swiper krasnodorSwiper relative !px-8 xs:!px-12 sm:!px-0">
            <div class="swiper-wrapper">
                @foreach ($complexes_residential as $key => $complex)
                    @include('inc.mobile_card_complex')
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0">
        <a href="{{ route('complexes', 'residential') }}"
            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
            Все жилые комплексы
        </a>
    </div>
</section>
