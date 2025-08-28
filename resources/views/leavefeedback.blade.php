@extends('layouts.app')

@section('title', 'Оставить отзыв')

@section('content')
    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative">
        <h1
            class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-[90%] md:w-full xl:w-[80%] mr-0 xl:mr-auto sm:hidden block">
            Оставить отзыв
        </h1>
        <div class="flex items-start justify-between gap-x-8 lg:gap-x-12 flex-col md:flex-row sm:mt-0 mt-8">
            <div
                class="h-[12.5rem] mx-auto md:mx-0 max-w-[18.125rem] md:max-w-[15.625rem] lg:max-w-[19.375rem] size-full border-transparent border rounded-xl md:border-custom-gray flex items-center justify-center mb-2">
                @if ($type === 'developer')
                    @if ($reviewable->image != null)
                        <img src="{{ asset('developer/' . $reviewable->image) }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-full" alt=""
                            style="width:100%;max-height:100%;" />
                    @else
                        <img src="{{ asset('images/zaglushka.svg') }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-auto" alt="" />
                    @endif
                @else
                    @if ($reviewable->image != null)
                        <img src="{{ asset('complex/' . $reviewable->image) }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-full" alt=""
                            style="width:100%;max-height:100%;" />
                    @else
                        <img src="{{ asset('images/zaglushka.svg') }}"
                            class="rounded-xl w-[80%] mx-auto max-h-[9.375rem] h-auto" alt="" />
                    @endif
                @endif
            </div>
            <div class="w-full md:w-[calc(100%-17.625rem)] lg:w-[calc(100%-22.375rem)] flex flex-col gap-2 lg:gap-4">
                @if ($type === 'developer')
                    <h1 class="tracking-widest text-2xl lg:text-3xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                        Строительная компания «{{ $reviewable->name }}»
                    </h1>
                    <div
                        class="flex items-start xs:items-center gap-3 lg:gap-6 w-full xl:w-[80%] mr-0 xl:mr-auto xs:flex-row flex-col">
                        @if ($reviewable->year_establishment)
                            <h4 class="text-sm lg:text-base font-semibold tracking-wider">
                                Год основания: {{ $reviewable->year_establishment }} г.
                            </h4>
                            <div class="xs:inline-block hidden">|</div>
                        @endif
                        <div class="text-sm lg:text-base font-semibold">
                            Количество объектов: {{ $reviewable->complexes()->count() }}
                        </div>
                    </div>
                @else
                    <h1 class="tracking-widest text-2xl lg:text-3xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                        @if ($reviewable->type == 'residential')
                            Жилой комплекс
                        @endif
                        @if ($reviewable->type == 'hotel')
                            Гостиничные комплекс
                        @endif «{{ $reviewable->name }}»
                    </h1>
                    <div
                        class="flex items-start xs:items-center gap-3 lg:gap-6 w-full xl:w-[80%] mr-0 xl:mr-auto xs:flex-row flex-col">
                        <h4 class="text-sm lg:text-base font-semibold tracking-wider">
                            {{ $reviewable->address }}
                        </h4>
                        <div class="xs:inline-block hidden">|</div>
                        <div class="text-sm lg:text-base font-semibold">
                            Застройщик: {{ $reviewable->developer->name }}
                        </div>
                    </div>
                @endif
                <hr class="md:hidden border-auth-input-border-color" />
                @if ($reviewable->content)
                    <p class="text-xs lg:text-sm tracking-wide w-full xl:w-[80%] mr-0 xl:mr-auto">
                        {!! $reviewable->content !!}
                    </p>
                @endif
            </div>
        </div>

        <div class="mt-8 w-full xl:w-[80%] mr-0 xl:mr-auto flex items-center justify-between md:flex-nowrap flex-wrap">
            <div
                class="text-xs 2xl:text-sm tracking-wide order-4 md:order-none md:w-auto w-full md:mt-0 mt-4 md:text-left text-center">
                @if ($type === 'developer')
                    Ваша компания? <a href="{{ route('gainingaccess', ['company_id' => $reviewable->id]) }}"
                        class="text-primary">Оставьте заявку</a>
                @else
                    Ваша компания? <a href="{{ route('gainingaccess', ['company_id' => $reviewable->developer->id]) }}"
                        class="text-primary">Оставьте заявку</a>
                @endif
            </div>
            <div class="text-xl lg:text-3xl flex items-center w-[50%] md:w-auto order-1 md:order-0">
                <span
                    class="pr-1">{{ number_format($reviewable->approvedReviews()->includedInRating()->avg('rating') ?? 0, 2) }}</span>
                <div class="flex items-center space-x-px xs:space-x-1" aria-label="Rating stars" role="img">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= ($reviewable->approvedReviews()->includedInRating()->avg('rating') ?? 0))
                            <img src="{{ asset('icons/Star.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                alt="" />
                            <img src="{{ asset('icons/Starmini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                                alt="" />
                        @else
                            <img src="{{ asset('icons/Stargray.svg') }}" class="min-[51.875rem]:inline-block hidden"
                                alt="" />
                            <img src="{{ asset('icons/Stargraymini.svg') }}" class="min-[51.875rem]:hidden inline-block"
                                alt="" />
                        @endif
                    @endfor
                </div>
            </div>
            <div>
                @if ($type === 'developer' && $reviewable->popular == '1')
                    <span
                        style="background-color: #EBEBEE;padding:5px 10px;border-radius:10px;color:#2C2C2C">Популярный</span>
                @endif
            </div>
            <div class="flex items-center gap-x-2 w-[50%] md:w-auto order-2 md:order-none md:justify-start justify-end">
                <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">
                    {{ $reviewable->approvedReviews()->count() }}
                </span>
                <span class="text-sm tracking-wide">Отзывов</span>
            </div>
        </div>
    </div>

    <section class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto w-full my-12 md:my-25 flex flex-col">
        <hr class="block sm:hidden border-auth-input-border-color">



        <div class="sm:border sm:border-input-border-color rounded-2xl p-0 sm:p-6">
            <h1
                class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto sm:block hidden">
                Оставить отзыв
            </h1>

            @php
                $remainingLimit = \App\Models\Review::getUserDailyRemainingLimit(auth()->id());
                $todayReviews = \App\Models\Review::where('user_id', auth()->id())
                    ->whereDate('created_at', today())
                    ->count();
            @endphp

            {{-- <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="bi bi-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">
                            Информация о лимитах
                        </h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Вы можете оставить только один отзыв для каждого объекта</li>
                                <li>Дневной лимит: 2 отзыва в день</li>
                                <li>Сегодня вы оставили: <strong>{{ $todayReviews }}/2</strong> отзывов</li>
                                <li>Осталось сегодня: <strong>{{ $remainingLimit }}</strong> отзывов</li>
                                @if ($remainingLimit == 0)
                                    <li class="text-red-600"><strong>Вы достигли дневного лимита. Попробуйте
                                            завтра.</strong></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}

            <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data"
                class="mt-4 sm:mt-8 flex flex-col gap-6">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="reviewable_id" value="{{ $reviewable->id }}">

                <div class="flex items-start sm:items-center gap-6 sm:flex-row flex-col md:gap-16 lg:gap-22">
                    <div class="sm:w-auto w-full">
                        <label class="text-input-divider text-xs font-medium tracking-wide pl-2 inline-block">
                            Выберите тип отзыва:
                        </label>
                        <div class="flex items-start sm:items-center sm:flex-row flex-col gap-2 md:gap-4 mt-2">
                            <label class="cursor-pointer">
                                <input type="radio" name="review_type" value="positive" class="hidden" checked>
                                <span
                                    class="review-type-btn positive text-center sm:inline inline-block whitespace-nowrap w-full text-xs md:text-sm px-6 py-1.5 md:px-8 md:py-2.5 rounded-3xl font-medium border border-primary text-primary">
                                    Положительный отзыв
                                </span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="review_type" value="negative" class="hidden">
                                <span
                                    class="review-type-btn negative text-center sm:inline inline-block whitespace-nowrap w-full text-xs md:text-sm px-6 py-1.5 md:px-8 md:py-2.5 rounded-3xl font-medium border border-red-500 text-red-500">
                                    Негативный отзыв
                                </span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="text-input-divider text-xs font-medium tracking-wide pl-2 inline-block">
                            Ваша оценка:
                        </label>
                        <div class="text-xl lg:text-3xl flex items-center w-[50%] md:w-auto mt-2">
                            <span class="pr-1 text-xl sm:text-base rating-display">5</span>
                            <div class="flex items-center space-x-px xs:space-x-1 rating-stars" role="img">
                                @for ($i = 1; $i <= 5; $i++)
                                    <img src="{{ asset('icons/Star.svg') }}"
                                        class="star cursor-pointer min-[51.875rem]:inline-block sm:hidden inline-block"
                                        data-rating="{{ $i }}" alt="">
                                    <img src="{{ asset('icons/Starmini.svg') }}"
                                        class="star cursor-pointer min-[51.875rem]:hidden size-5 hidden sm:inline-block"
                                        data-rating="{{ $i }}" alt="">
                                @endfor
                            </div>
                            <input type="hidden" name="rating" value="5" id="rating-input">
                        </div>
                    </div>
                </div>

                <div class="form-item w-full">
                    <label for="title" class="text-input-divider text-xs font-medium tracking-wide pl-2">
                        Заголовок:
                    </label>
                    <div
                        class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                            placeholder="Введите заголовок" id="title" required>
                    </div>
                    @error('title')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-item w-full">
                    <label for="text" class="text-input-divider text-xs font-medium tracking-wide pl-2">
                        Текст отзыва:
                    </label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 py-2 flex items-center mt-1">
                        <textarea name="text" placeholder="Введите текст" id="text" rows="5"
                            class="text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none" required>{{ old('text') }}</textarea>
                    </div>
                    @error('text')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
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

                <button type="submit" {{ $remainingLimit == 0 ? 'disabled' : '' }}
                    class="w-full text-center py-3 rounded-3xl border {{ $remainingLimit == 0 ? 'border-gray-400 text-gray-400 cursor-not-allowed' : 'border-primary text-primary hover:bg-primary hover:text-white cursor-pointer' }} text-sm font-bold tracking-wide px-8 transition-colors mt-6.5">
                    {{ $remainingLimit == 0 ? 'Лимит исчерпан' : 'Опубликовать отзыв' }}
                </button>
            </form>
        </div>
    </section>

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
            // Review type selection
            const reviewTypeInputs = document.querySelectorAll('input[name="review_type"]');
            const reviewTypeBtns = document.querySelectorAll('.review-type-btn');

            reviewTypeInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    reviewTypeBtns.forEach(btn => btn.classList.remove('active'));
                    if (this.checked) {
                        reviewTypeBtns[index].classList.add('active');
                    }
                });
            });

            // Initialize first option as active
            reviewTypeBtns[0].classList.add('active');

            // Star rating
            const stars = document.querySelectorAll('.star');
            const ratingDisplay = document.querySelector('.rating-display');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    ratingInput.value = rating;
                    ratingDisplay.textContent = rating;

                    // Update star display
                    stars.forEach((s, index) => {
                        const starIndex = Math.floor(index / 2) +
                            1; // Her yıldız için 2 img var (büyük/küçük)

                        if (starIndex <= rating) {
                            s.classList.remove('inactive');
                            if (s.src.includes('Stargray')) {
                                s.src = s.src.replace('Stargray', 'Star');
                            }
                            if (s.src.includes('Stargraymini')) {
                                s.src = s.src.replace('Stargraymini', 'Starmini');
                            }
                        } else {
                            s.classList.add('inactive');
                            if (s.src.includes('Star.svg')) {
                                s.src = s.src.replace('Star.svg', 'Stargray.svg');
                            }
                            if (s.src.includes('Starmini.svg')) {
                                s.src = s.src.replace('Starmini.svg', 'Stargraymini.svg');
                            }
                        }
                    });
                });
            });

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
