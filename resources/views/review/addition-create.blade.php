@extends('cabinet.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('swiper/swiper-bundle.css') }}" />
@endsection

@section('content')
    <div class="max-w-full md:max-w-[calc(100%-15.625rem)] xl:max-w-[calc(100%-21.875rem)] w-full h-full">
        <div class="py-12 px-6 h-full flex flex-col gap-12">
            <div class="flex flex-col gap-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="font-bold text-2xl lg:text-3xl tracking-widest text-text">
                            Мои отзывы
                        </h1>
                        <p class="mt-2 text-xs font-semibold">
                            Отзыв: <span class="text-primary">{{ $review?->id ? '№' . $review->id : '—' }}</span>
                        </p>
                    </div>
                    {{-- <button type="button"
                        class="md:flex hidden md:w-fit w-full border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Дополнить отзыв
                    </button> --}}
                    <span class="text-sm md:hidden inline">{{ $review->created_at->format('Y/m/d') }}</span>
                </div>
                <div class="flex items-center xl:items-end justify-between gap-4 xl:flex-nowrap flex-wrap">
                    <div class="flex flex-col gap-1">
                        <label class="text-input-divider text-xs font-medium tracking-wide pl-2">Тип отзыва:</label>
                        <span
                            class="bg-{{ $review->type === 'positive' ? 'green' : 'red' }}-500 text-white rounded-3xl px-5 py-3 font-medium text-sm">
                            {{ $review->type === 'positive' ? 'Положительный отзыв' : 'Негативный отзыв' }}
                        </span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-input-divider text-xs font-medium tracking-wide">Моя оценка:</label>
                        <div class="text-xl lg:text-3xl flex items-center w-[50%] md:w-auto order-1 md:order-0">
                            <span class="pr-1 text-lg">{{ $review?->rating ?? '—' }}</span>
                            @php
                                $rating = (float) ($review?->rating ?? 0);
                                $fullStars = (int) floor($rating);
                                $emptyStars = max(0, 5 - $fullStars);
                            @endphp
                            <div class="flex items-center space-x-px xs:space-x-1" role="img">
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <img src="{{ asset('icons/Starmini.svg') }}" class="inline-block" alt="" />
                                @endfor
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <img src="{{ asset('icons/Stargraymini.svg') }}" class="inline-block" alt="" />
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center sm:items-start gap-4 sm:flex-row flex-col xl:gap-8 w-[50%]">
                        <div class="min-h-[8.125rem] w-[80%] flex items-center justify-center border rounded-xl">
                            @if (class_basename($review->reviewable_type) == 'Complex')
                                <img src="{{ asset('complex/' . ($review->reviewable->image ?? 'images/zaglushka.svg')) }}"
                                    class="rounded-xl w-[100%] mx-auto h-auto min-h-[6.125rem]" alt="" />
                            @endif
                            @if (class_basename($review->reviewable_type) == 'Developer')
                                <img src="{{ asset('developer/' . ($review->reviewable->image ?? 'images/image4.png')) }}"
                                    class="rounded-xl w-[100%] mx-auto h-auto min-h-[6.125rem]" alt="" />
                            @endif
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            @if (class_basename($review->reviewable_type) == 'Complex')
                                <h2 class="text-lg font-bold text-text2 tracking-wide">
                                    @if ($review?->reviewable?->type == 'residential')
                                        ЖК “{{ $review?->reviewable?->name }}”
                                    @elseif ($review?->reviewable?->type == 'hotel')
                                        ГК “{{ $review?->reviewable?->name }}”
                                    @else
                                        “{{ $review?->reviewable?->name }}”
                                    @endif
                                </h2>
                                <p class="font-semibold text-sm tracking-wide text-text2">
                                    {{ $review?->reviewable?->address ?? '-' }}
                                </p>
                                <div class="font-semibold text-sm tracking-wide mt-4">
                                    Застройщик: <span
                                        class="text-primary">{{ $review?->reviewable?->developer?->name ?? '-' }}</span>
                                </div>
                            @endif
                            @if (class_basename($review->reviewable_type) == 'Developer')
                                <div class="font-semibold text-sm tracking-wide mt-4">
                                    Застройщик: <span class="text-primary">{{ $review?->reviewable?->name ?? '-' }}</span>
                                    <p class="font-semibold text-sm tracking-wide text-text2">
                                        {{ $review?->reviewable?->year_establishment ?? '-' }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-item w-full">
                <label for="name" class="text-input-divider text-xs font-medium tracking-wide pl-2">Заголовок:</label>
                <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                    <input type="text"
                        class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"
                        placeholder="Заголовок" id="title" name="title"
                        value="{{ old('title', $review?->title ?? '') }}" disabled />
                </div>
            </div>

            <div class="form-item w-full">
                <label for="name" class="text-input-divider text-xs font-medium tracking-wide pl-2">Текст
                    отзыва:</label>
                <div class="rounded-3xl border-auth-input-border-color border px-4 py-2 flex items-center mt-1">
                    <textarea placeholder="Введите текст" id="text" name="text" rows="3" disabled
                        class="text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none">{{ old('text', $review?->text ?? '') }}</textarea>
                </div>
            </div>

            <div class="w-full swiper md:!overflow-auto md:pr-2 pr-0" id="redaktFileContainer">
                <div
                    class="swiper-wrapper md:flex md:items-center md:justify-end md:flex-wrap md:gap-4 md:max-h-[14.6875rem] md:h-auto">
                </div>
            </div>

            <form action="{{ route('reviews.additions.store', $review->id) }}" class="flex flex-wrap gap-8 form"
                enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-item w-full">
                    <label for="name" class="text-input-divider text-xs font-medium tracking-wide pl-2">Дополнение к
                        отзыву:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 py-2 flex items-center mt-1">
                        <textarea placeholder="Введите текст" id="text" name="text" rows="5"
                            class="text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"></textarea>
                    </div>
                </div>

                <div class="w-full" id="imagePreviewContainer">
                    <!-- Image previews will be added here -->
                </div>

                <div class="flex items-center w-full justify-end">
                    <input type="file" name="images[]" class="hidden" id="imageInput" multiple accept="image/*">
                    <button type="button" onclick="document.getElementById('imageInput').click()"
                        class="md:w-fit w-full mt-6 border-primary text-sm xl:text-base border rounded-3xl px-4 py-3 font-bold sm:py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Загрузить изображение
                    </button>
                </div>

                <button type="submit"
                    class="w-full text-center py-2 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer my-2 md:my-6.5">
                    Опубликовать дополнение
                </button>
            </form>
        </div>
    </div>
    <style>
        .review-type-btn.active.positive {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }

        .review-type-btn.active.negative {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .star.inactive {
            filter: grayscale(100%);
        }

        .image-preview {
            position: relative;
            display: inline-block;
            margin: 5px;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e5e7eb;
        }

        .image-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image upload preview
            const imageInput = document.getElementById('imageInput');
            const previewContainer = document.getElementById('imagePreviewContainer');

            imageInput.addEventListener('change', function() {
                const files = Array.from(this.files);

                files.forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.createElement('div');
                            preview.className = 'image-preview';
                            preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-btn" onclick="removeImage(this)">×</button>
                    `;
                            previewContainer.appendChild(preview);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });

        function removeImage(btn) {
            btn.parentElement.remove();
            // Reset file input to allow re-selection
            const imageInput = document.getElementById('imageInput');
            imageInput.value = '';
        }
    </script>
@endsection
