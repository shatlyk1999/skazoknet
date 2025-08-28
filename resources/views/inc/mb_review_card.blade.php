<div class="swiper-slide">
    <div
        class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between gap-x-2">
                <div class="md:flex items-center gap-1">
                    <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                        class="size-7" alt="" style="border-radius: 25px;object-fit:cover" />
                    <span>{{ $review->user->name }}</span>
                </div>
                {{-- <span class="inline-block md:hidden text-xs">
                    <span
                        class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">
                        {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
                    </span>
                </span> --}}
                <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xxs xxs:text-xs xs:text-sm">
                    {{ $review->additions()->count() }} Дополнений</span>
            </div>
            @php
                if ($review->reviewable_type == 'App\Models\Complex') {
                    $type = 'complex';
                    $complex = $review->reviewable;
                }
                if ($review->reviewable_type == 'App\Models\Developer') {
                    $type = 'developer';
                    $developer = $review->reviewable;
                }
            @endphp
            <div class="flex items-center justify-between mt-4">
                {{-- <div class="flex items-center space-x-px xs:space-x-1" aria-label="3 out of 5 stars" role="img"> --}}
                @include('inc.star_rating', [
                    'type' => $type,
                    'main' => 'false',
                    'width' => '23px',
                    'height' => '23px',
                    // 'star_count_class' => 'pr-1',
                ])
                {{-- </div> --}}
                <span class="text-sm">{{ $review->created_at->format('Y/m/d') }}</span>
            </div>
            {{-- <div class="flex md:hidden items-center gap-1">
                <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                    class="size-8" alt="" />
                <span>{{ $review->user->name }}</span>
            </div> --}}
            <h2 class="font-semibold text-lg line-clamp-1">{{ Str::limit($review->title, 50) }}</h2>
            <p class="text-sm line-clamp-4" style="min-height: 80px;">
                {{ Str::limit($review->text, 150) }}
            </p>
            <div class="my-4 md:my-8">
                <a href="{{ route('review.show', $review) }}"
                    class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                    Читать отзыв
                </a>
            </div>
            <div class="flex items-center justify-between gap-x-2">
                <form action="{{ route('review.like', $review) }}" method="POST" class="flex items-center gap-x-1">
                    @csrf
                    <button type="submit" class="flex items-center gap-x-1"
                        style="background: none; border: none; padding: 0;">
                        <img src="{{ asset('images/like.png') }}" alt="" class="size-5" />
                        <span>{{ $review->total_likes }}</span>
                    </button>
                </form>
                <form action="{{ route('review.dislike', $review) }}" method="POST" class="flex items-center gap-x-1">
                    @csrf
                    <button type="submit" class="flex items-center gap-x-1"
                        style="background: none; border: none; padding: 0;">
                        <img src="{{ asset('images/dislike.png') }}" alt="" class="h-5 w-6" />
                        <span>{{ $review->total_dislikes }}</span>
                    </button>
                </form>
                <div class="flex items-center gap-x-1">
                    <img src="{{ asset('images/comment.png') }}" alt="" class="size-5" />
                    <span>{{ $review->comments()->count() ?? 0 }}</span>
                </div>

                <span class="md:inline-block hidden text-xs text-green-600">
                    Одобрен
                </span>
            </div>
        </div>
    </div>
</div>
