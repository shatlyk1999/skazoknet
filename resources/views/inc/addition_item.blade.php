<div
    class="rounded-2xl border-2 border-custom-gray hover:border-primary hover:shadow-md transition-all duration-500 ease-in-out p-4">
    <div class="flex items-center justify-between sm:flex-row flex-col gap-4">
        <div class="flex items-center gap-x-4">
            <div class="flex justify-center items-center gap-2">
                <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                    class="size-7" alt="" style="border-radius: 25px;object-fit:cover" />
                {{ $review->user->name }}
            </div>
        </div>
        <div class="flex items-center gap-x-4 text-sm tracking-wide">
            <span class="text-text">{{ $review->created_at->format('Y/m/d') }}</span>
            <div class="flex items-center gap-x-1">
                <img src="{{ asset('images/like.svg') }}" alt="" class="size-5" />
                <span>{{ $addition->likes }}</span>
            </div>
            <div class="flex items-center gap-x-1">
                <img src="{{ asset('images/dislike.svg') }}" alt="" class="h-5 w-6" />
                <span>{{ $addition->dislikes }}</span>
            </div>
        </div>
    </div>
    <hr class="mt-6 sm:hidden flex border-custom-gray" />
    <p class="text-sm font-normal mt-6 text-text2 h-[2.5rem] overflow-hidden transition-all duration-300 ease-in-out"
        id="collapse-content-{{ $addition->id }}">
        {{ $addition->text }}
        @if ($addition->images->count() > 0)
            <div class="flex items-center gap-x-4 max-w-full mt-3">
                <button
                    class="my-tocno-swiper-button-prev bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg cursor-pointer md:block hidden">
                    <i class="mdi mdi-chevron-left"></i>
                </button>
                <div class="swiper myTocnoSwiper relative">
                    <div class="swiper-wrapper">
                        @foreach ($addition->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('addition-images/' . $image->image) }}"
                                    class="rounded-xl w-full max-h-[18.75rem] max-w-[19rem] h-auto" alt="" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <button
                    class="my-tocno-swiper-button-next bg-custom-gray-2 p-1 px-2.5 rounded-full text-lg cursor-pointer md:block hidden">
                    <i class="mdi mdi-chevron-right"></i>
                </button>
            </div>
        @endif
    </p>

    <hr class="mt-6 sm:hidden flex border-custom-gray" />

    <button class="mt-4 float-right tracking-wide text-xs flex items-center gap-x-2 cursor-pointer"
        id="collapse-button-{{ $addition->id }}"
        onclick="toggleCollapse('#collapse-content-{{ $addition->id }}', '#collapse-button-{{ $addition->id }}')">
        <span>Развернуть</span>
        <img src="{{ asset('icons/down.svg') }}" alt="" />
    </button>
</div>
