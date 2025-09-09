<div
    class="relative rounded-xl basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between gap-x-2">
            <div class="hidden md:flex items-center gap-1">
                <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                    class="size-7" alt="" style="border-radius: 25px;object-fit:cover" />
                <span>{{ $review->user->name }}</span>
            </div>
            <span class="inline-block md:hidden text-xs">
                @if ($review->images->count() > 0)
                    {{ $review->images->count() }} фото
                @elseif (!$review->is_approved)
                    <span class="text-orange-600">На модерации</span>
                @else
                    <span class="text-green-600">Одобрен</span>
                @endif
            </span>
            {{-- <span
                class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">
                {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
            </span> --}}
            <span class="bg-primary text-white py-1 px-2 rounded-2xl text-xs xs:text-sm">
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
            {{-- @include('inc.star_rating', [
                'type' => $type,
                'main' => 'false',
                'width' => '27px',
                'height' => '27px',
                // 'star_count_class' => 'pr-1',
            ]) --}}

            <div class="flex items-center" aria-label="{{ $review->rating }} out of 5 stars"role="rating">
                @for ($i = 0; $i < $review->rating; $i++)
                    <svg class=" text-yellow-400" fill="currentColor" viewBox="0 0 24 24"
                        style="width:{{ '27px' }};height:{{ '27px' }}">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
                    </svg>
                @endfor
                @for ($i = 0; $i < 5 - $review->rating; $i++)
                    <svg class=" text-gray-300" fill="currentColor" viewBox="0 0 24 24"
                        style="width:{{ '27px' }};height:{{ '27px' }}">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.46,13.97L5.82,21L12,17.27Z" />
                    </svg>
                @endfor
            </div>

            <span class="text-sm">{{ $review->created_at->format('Y/m/d') }}</span>
        </div>
        <div class="flex md:hidden items-center gap-1">
            <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                class="size-8" alt="" style="border-radius: 25px;object-fit:cover" />
            <span>{{ $review->user->name }}</span>
        </div>
        <h2 class="font-semibold text-lg line-clamp-2" style="min-height:56px;">{{ Str::limit($review->title, 50) }}
        </h2>
        <p class="text-sm line-clamp-4" style="min-height: 80px;">
            {{ Str::limit($review->text, 150) }}
        </p>
        <div class="my-4 md:my-8">
            <a href="{{ route('review.show', $review) }}"
                class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full inline-block text-center">
                Читать отзыв
            </a>
        </div>
        <div class="flex items-center justify-between gap-x-2">
            <form action="{{ route('review.like', $review) }}" method="POST" class="flex items-center gap-x-1">
                @csrf
                <button type="submit" class="flex items-center gap-x-1"
                    style="background: none; border: none; padding: 0;">
                    <img src="{{ asset('images/like.svg') }}" alt="" class="size-5" />
                    <span>{{ $review->total_likes }}</span>
                </button>
            </form>
            <form action="{{ route('review.dislike', $review) }}" method="POST" class="flex items-center gap-x-1">
                @csrf
                <button type="submit" class="flex items-center gap-x-1"
                    style="background: none; border: none; padding: 0;">
                    <img src="{{ asset('images/dislike.svg') }}" alt="" class="h-5 w-6" />
                    <span>{{ $review->total_dislikes }}</span>
                </button>
            </form>
            <div class="flex items-center gap-x-1">
                <img src="{{ asset('images/comment.svg') }}" alt="" class="size-5" />
                <span>{{ $review->comments()->count() ?? 0 }}</span>
            </div>

            @if ($review->is_approved == 0)
                <span class="md:inline-block hidden text-xs text-orange-600">
                    {{ $review->approval_status }}
                </span>
            @elseif ($review->is_approved == 1)
                <span class="md:inline-block hidden text-xs text-red-600">
                    {{ $review->approval_status }}
                </span>
            @elseif ($review->is_approved == 2)
                <span class="md:inline-block hidden text-xs text-green-600">
                    {{ $review->approval_status }}
                </span>
            @endif
        </div>
    </div>
</div>
