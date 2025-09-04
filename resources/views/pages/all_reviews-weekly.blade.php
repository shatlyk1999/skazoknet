@extends('layouts.app')

@section('title', 'Лучшие отзывы недели | skazoknet.com')

@section('content')

    <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25 flex flex-col">
        <div class="flex items-center justify-between mb-8 px-8 xs:px-12 sm:px-0">
            <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide">
                Лучшие отзывы недели
            </h1>
        </div>
        {{-- <div class="hidden sm:flex gap-8 flex-wrap">
            @forelse ($reviews as $review)
                @include('inc.review_card', ['review' => $review])
            @empty
                <div class="text-center py-8 w-full">
                    <p class="text-gray-500">Пока нет отзывов для этого застройщика</p>
                </div>
            @endforelse
        </div>
        <div class="mt-8 block sm:hidden">
            <div class="swiper krasnodor3Swiper relative">
                <div class="swiper-wrapper">
                    @forelse($reviews as $review)
                        @include('inc.mb_review_card')
                    @empty
                        <div class="text-center py-8 w-full">
                            <p class="text-gray-500">Пока нет отзывов для этого застройщика</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div> --}}
        <div class="flex gap-8 flex-wrap order-3 md:mt-0 mt-4">
            @forelse($reviews as $review)
                {{-- @include('inc.review_card') --}}
                <div
                    class="relative rounded-xl basis-full sm:basis-[calc((100%-32px)/2)] lg:basis-[calc((100%-64px)/3)] group hover:shadow-md border-custom-gray border hover:border-primary transition-all p-4 md:p-8">
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
                                @else
                                    Одобрен
                                @endif
                            </span>
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
                            @include('inc.star_rating', [
                                'type' => $type,
                                'main' => 'false',
                                'width' => '27px',
                                'height' => '27px',
                                // 'star_count_class' => 'pr-1',
                            ])
                            <span class="text-sm">{{ $review->created_at->format('Y/m/d') }}</span>
                        </div>
                        <div class="flex md:hidden items-center gap-1">
                            <img src="{{ $review->user->avatar ? asset('avatar/' . $review->user->avatar) : asset('images/user2.png') }}"
                                class="size-7" alt="" style="border-radius: 25px;object-fit:cover" />
                            <span>{{ $review->user->name }}</span>
                        </div>
                        <h2 class="font-semibold text-lg line-clamp-2" style="min-height:56px;">
                            {{ Str::limit($review->title, 50) }}
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
                            <form action="{{ route('review.like', $review) }}" method="POST"
                                class="flex items-center gap-x-1">
                                @csrf
                                <button type="submit" class="flex items-center gap-x-1"
                                    style="background: none; border: none; padding: 0;">
                                    <img src="{{ asset('images/like.png') }}" alt="" class="size-5" />
                                    <span>{{ $review->total_likes }}</span>
                                </button>
                            </form>
                            <form action="{{ route('review.dislike', $review) }}" method="POST"
                                class="flex items-center gap-x-1">
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
            @empty
                <div class="text-center py-8 w-full">
                    <p class="text-gray-500">Пока нет отзывов для этого застройщика</p>
                </div>
            @endforelse
        </div>
        <div class="flex justify-center items-center">
            {{ $reviews->links('vendor.pagination.custom') }}
        </div>
    </section>
@endsection
