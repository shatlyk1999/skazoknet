@extends('cabinet.app')

@section('content')
    <div class="max-w-full md:max-w-[calc(100%-15.625rem)] xl:max-w-[calc(100%-21.875rem)] w-full h-full">
        <div class="py-4 md:py-12 px-6 h-full flex flex-col gap-6 relative">
            <h1
                class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto mt-4 md:mt-0">
                Мои комплексы
            </h1>

            <!-- Search -->
            <div class="flex items-center justify-between gap-x-4 my-2">
                <div class="px-8 rounded-3xl h-12 flex items-center gap-x-2 w-full lg:w-[70%] border border-input-border-color"
                    style="background: linear-gradient(to right, #fcfdff 10%, #f0f0f0 90%);">
                    <img src="{{ asset('icons/search 1.svg') }}" alt="" />
                    <input type="text" id="searchInput" value="{{ request('search') }}"
                        placeholder="Поиск по названию или адресу..."
                        class="h-12 border-none outline-none w-full bg-transparent" />
                </div>
                <div class="hidden lg:block">
                    <a href="{{ route('createComplex', auth()->user()->id) }}"
                        class="border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Добавить комплекс
                    </a>
                </div>
            </div>

            <!-- Mobile Add Button Info -->
            <div class="lg:hidden flex items-center justify-end md:justify-between">
                <a href="{{ route('createComplex', auth()->user()->id) }}"
                    class="border-primary md:inline-block hidden text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                    <i class="mdi mdi-plus"></i>
                    Добавить комплекс
                </a>
                <div class="text-sm text-gray-500">
                    Всего: <span id="totalCount">{{ $complexes->total() }}</span> комплексов
                </div>
            </div>

            <!-- Loading indicator -->
            <div id="loadingIndicator" class="hidden flex justify-center items-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                <span class="ml-2 text-gray-600">Поиск...</span>
            </div>

            <!-- Complexes List -->
            <div id="complexesList"
                class="my-2 w-full gap-4 flex flex-col flex-nowrap sm:flex-wrap lg:flex-nowrap sm:flex-row lg:flex-col max-h-[calc(100%-6rem)] overflow-auto pr-2 lg:pr-0">
                @include('cabinet.complexes-list', ['complexes' => $complexes])
            </div>

            <!-- Mobile Add Button -->
            <div class="md:hidden block absolute bottom-8 left-0 px-4 w-full">
                <a href="{{ route('createComplex', auth()->user()->id) }}"
                    class="border-primary text-sm xl:text-base border bg-white rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer w-full text-center block">
                    <i class="mdi mdi-plus"></i>
                    Добавить комплекс
                </a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let searchTimeout;
        let currentRequest = null;

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const complexesList = document.getElementById('complexesList');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const totalCount = document.getElementById('totalCount');

            // Real-time search with AJAX
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const searchValue = this.value.trim();

                // Cancel previous request
                if (currentRequest) {
                    currentRequest.abort();
                }

                // Debounce search for 300ms
                searchTimeout = setTimeout(function() {
                    performSearch(searchValue);
                }, 300);
            });

            function performSearch(searchValue) {
                // Show loading
                loadingIndicator.classList.remove('hidden');
                complexesList.style.opacity = '0.5';

                // Prepare URL
                const url = '{{ route('searchComplexes', auth()->user()->id) }}';
                const params = new URLSearchParams();
                if (searchValue) {
                    params.append('search', searchValue);
                }

                // Make AJAX request
                currentRequest = fetch(url + '?' + params.toString(), {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(html => {
                        // Update content
                        complexesList.innerHTML = html;

                        // Update URL without refresh
                        const newUrl = new URL(window.location);
                        if (searchValue) {
                            newUrl.searchParams.set('search', searchValue);
                        } else {
                            newUrl.searchParams.delete('search');
                        }
                        window.history.pushState({}, '', newUrl);

                        // Update total count (extract from pagination or count elements)
                        updateTotalCount();
                    })
                    .catch(error => {
                        if (error.name !== 'AbortError') {
                            console.error('Search error:', error);
                            complexesList.innerHTML =
                                '<div class="flex justify-center items-center py-12 text-red-500">Ошибка при поиске. Попробуйте еще раз.</div>';
                        }
                    })
                    .finally(() => {
                        // Hide loading
                        loadingIndicator.classList.add('hidden');
                        complexesList.style.opacity = '1';
                        currentRequest = null;
                    });
            }

            function updateTotalCount() {
                // Count visible complex items
                const complexItems = complexesList.querySelectorAll(
                    '.flex.w-full.sm\\:w-\\[calc\\(\\(100\\%-16px\\)\\/2\\)\\]');
                const count = complexItems.length;
                if (totalCount) {
                    totalCount.textContent = count;
                }
            }

            // Handle pagination clicks
            document.addEventListener('click', function(e) {
                if (e.target.closest('#paginationContainer a')) {
                    e.preventDefault();
                    const link = e.target.closest('a');
                    const url = link.href;

                    // Show loading
                    loadingIndicator.classList.remove('hidden');
                    complexesList.style.opacity = '0.5';

                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            complexesList.innerHTML = html;
                            window.history.pushState({}, '', url);
                            updateTotalCount();
                        })
                        .catch(error => {
                            console.error('Pagination error:', error);
                        })
                        .finally(() => {
                            loadingIndicator.classList.add('hidden');
                            complexesList.style.opacity = '1';
                        });
                }
            });
        });
    </script>
@endsection
