@extends('cabinet.app')

@section('css')
    <style>
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            min-height: 50px;
            -webkit-line-clamp: 2;
        }

        .bg-green-500 {
            background-color: rgba(25, 135, 85, 1);
        }

        #reviewExistsModalContent {
            width: 500px;
        }

        .w-50 {
            width: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="max-w-full md:max-w-[calc(100%-15.625rem)] xl:max-w-[calc(100%-21.875rem)] w-full h-full">
        <div class="py-12 px-6 h-full flex flex-col gap-6">
            <div class="flex items-center justify-between gap-2">
                <h1 class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                    Всего отзывов
                </h1>
                <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm inline-block whitespace-nowrap lg:hidden">
                    {{ $totalReviews }} Отзывов
                </span>
            </div>

            <div class="my-2 flex items-center justify-end lg:justify-between">
                <div class="hidden lg:flex items-center gap-x-8">
                    <div class="flex items-center gap-x-2">
                        <span class="bg-primary text-white p-1 px-2 rounded-lg text-sm">{{ $positiveReviews }}</span>
                        <span class="text-sm tracking-wide">Положительных отзывов</span>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <span class="bg-red-500 text-white p-1 px-2 rounded-lg text-sm">{{ $negativeReviews }}</span>
                        <span class="text-sm tracking-wide">Отрицательных отзывов</span>
                    </div>
                </div>
                <div>
                    <div class="dropdown relative inline-block">
                        <button
                            class="flex items-center gap-2 bg-transparent hover:bg-black/5 px-3 py-2 transition-colors rounded-lg cursor-pointer">
                            <span>По умолчанию</span>
                            <img src="{{ asset('icons/Group 334.svg') }}" alt="" />
                        </button>
                        <div class="dropdown-content absolute hidden bg-white min-w-[200px] shadow-lg rounded-lg z-10">
                            <div class="dropdown-item cursor-pointer px-4 py-2" data-value="default">
                                По умолчанию <span class="check-icon hidden">✔</span>
                            </div>
                            <div class="dropdown-item cursor-pointer px-4 py-2" data-value="positive">
                                Сначала положительные <span class="check-icon hidden">✔</span>
                            </div>
                            <div class="dropdown-item cursor-pointer px-4 py-2" data-value="negative">
                                Сначала отрицательные <span class="check-icon hidden">✔</span>
                            </div>
                            <div class="dropdown-item cursor-pointer px-4 py-2" data-value="developer">
                                Застройщики <span class="check-icon hidden">✔</span>
                            </div>
                            <div class="dropdown-item cursor-pointer px-4 py-2" data-value="complex">
                                Комплексы <span class="check-icon hidden">✔</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($reviews->count() > 0)
                <div id="reviews-container"
                    class="flex flex-wrap gap-4 w-full h-full max-h-[calc(100dvh-7.125rem)] overflow-y-auto pr-2">
                    @include('cabinet.partials.all-review-cards', ['reviews' => $reviews])
                </div>

                {{-- Load More Button --}}
                @if ($reviews->hasMorePages())
                    <div class="flex justify-center mt-6">
                        <button id="load-more-btn" data-next-page="{{ $reviews->currentPage() + 1 }}"
                            data-user-id="{{ $user->id }}"
                            class="border-primary text-sm xl:text-base border rounded-3xl px-8 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer md:w-auto w-full">
                            Показать еще
                        </button>
                    </div>
                @endif
            @else
                <div class="flex flex-col items-center justify-center h-full text-center py-20">
                    <div class="w-32 h-32 mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="mdi mdi-comment-text-outline text-6xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Пока нет отзывов</h3>
                    <p class="text-gray-500 mb-6">О вашей компании и комплексах пока не оставлено отзывов</p>
                    <a href="{{ route('home') }}"
                        class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors">
                        Перейти на главную
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Load More Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            const reviewsContainer = document.getElementById('reviews-container');

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const nextPage = this.getAttribute('data-next-page');
                    const userId = this.getAttribute('data-user-id');

                    // Show loading state
                    this.innerHTML = 'Загрузка...';
                    this.disabled = true;

                    // Get current filter parameter
                    const currentUrl = new URL(window.location.href);
                    const filter = currentUrl.searchParams.get('filter') || '';

                    // Build URL with filter parameter
                    let url = `/all-reviews/${userId}?page=${nextPage}`;
                    if (filter) {
                        url += `&filter=${filter}`;
                    }

                    // Make AJAX request
                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.html) {
                                // Append new reviews to container
                                reviewsContainer.insertAdjacentHTML('beforeend', data.html);

                                if (data.hasMore) {
                                    // Update button for next page
                                    this.setAttribute('data-next-page', data.nextPage);
                                    this.innerHTML = 'Показать еще';
                                    this.disabled = false;
                                } else {
                                    // Hide button if no more pages
                                    this.style.display = 'none';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.innerHTML = 'Показать еще';
                            this.disabled = false;
                            alert('Произошла ошибка при загрузке отзывов');
                        });
                });
            }

            // Dropdown functionality
            const dropdown = document.querySelector('.dropdown');
            const dropdownContent = document.querySelector('.dropdown-content');
            const dropdownItems = document.querySelectorAll('.dropdown-item');

            if (dropdown && dropdownContent) {
                // Set initial filter state based on URL parameter
                const currentUrl = new URL(window.location.href);
                const currentFilter = currentUrl.searchParams.get('filter') || 'default';

                // Find and activate current filter
                dropdownItems.forEach(item => {
                    const value = item.getAttribute('data-value');
                    if (value === currentFilter) {
                        const text = item.textContent.replace('✔', '').trim();
                        dropdown.querySelector('span').textContent = text;
                        item.querySelector('.check-icon').classList.remove('hidden');
                    } else {
                        item.querySelector('.check-icon').classList.add('hidden');
                    }
                });

                dropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownContent.classList.toggle('hidden');
                });

                document.addEventListener('click', function() {
                    dropdownContent.classList.add('hidden');
                });

                dropdownItems.forEach(item => {
                    item.addEventListener('click', function() {
                        const value = this.getAttribute('data-value');
                        const text = this.textContent.replace('✔', '').trim();

                        dropdown.querySelector('span').textContent = text;

                        dropdownItems.forEach(i => i.querySelector('.check-icon').classList.add(
                            'hidden'));
                        this.querySelector('.check-icon').classList.remove('hidden');

                        dropdownContent.classList.add('hidden');

                        sortReviews(value);
                    });
                });
            }
        });

        function sortReviews(sortType) {
            // Get current URL
            const currentUrl = new URL(window.location.href);

            // Update filter parameter
            if (sortType === 'default') {
                currentUrl.searchParams.delete('filter');
            } else {
                currentUrl.searchParams.set('filter', sortType);
            }

            // Remove page parameter to start from first page
            currentUrl.searchParams.delete('page');

            // Reload page with new filter
            window.location.href = currentUrl.toString();
        }
    </script>
@endsection
