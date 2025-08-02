<section class="xl:container px-0 sm:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25">
    <div class="flex items-center justify-between mb-8 px-8 xs:px-12 sm:px-0">
        <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
            {{ $city->developer_text ?? 'Застройщики' }} в {{ $city->text }}
        </h1>
        <a href="{{ route('developers') }}" class="md:inline-block hidden">Все застройщики</a>
    </div>
    <div class="hidden sm:flex gap-8 flex-wrap">
        @foreach ($developers as $key => $developer)
            @include('inc.pc_card_developer')
        @endforeach
    </div>
    <div class="mt-8 block sm:hidden">
        <div class="swiper krasnodor2Swiper relative !px-8 xs:!px-12 sm:!px-0">
            <div class="swiper-wrapper">
                @foreach ($developers as $key => $developer)
                    @include('inc.mobile_card_developer')
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-8 block md:hidden px-8 xs:px-12 sm:px-0 flex justify-center items-center text-center">
        <a href="{{ route('developers') }}"
            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
            Все застройщики
        </a>
    </div>
</section>
