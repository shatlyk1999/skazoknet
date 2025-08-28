@forelse($complexes as $complex)
    <div class="flex w-full sm:w-[calc((100%-16px)/2)] lg:w-full flex-col lg:flex-row lg:items-start items-center">
        <div class="w-full lg:w-[30%] relative">
            <img src="{{ $complex->image ? asset('complex/' . $complex->image) : asset('images/complex-placeholder.jpg') }}"
                class="rounded-tl-2xl rounded-tr-2xl lg:rounded-2xl h-[12.5rem] w-full object-cover border border-input-border-color"
                alt="{{ $complex->name }}" />
            <div class="absolute top-4 right-4 z-10">
                <span class="bg-primary text-white py-1 px-2 rounded-lg text-xs">
                    {{ $complex->reviews_count ?? 0 }} Отзывов
                </span>
            </div>
            @if ($complex->status == 0)
                <div class="absolute top-4 left-4 z-10">
                    <span class="bg-red-500 text-white py-1 px-2 rounded-lg text-xs">
                        Неактивен
                    </span>
                </div>
            @endif
        </div>
        <div
            class="w-full h-full lg:w-[70%] py-4 px-4 lg:px-8 border border-t-0 lg:border-t lg:border-l-0 border-input-border-color rounded-bl-2xl lg:rounded-bl-none rounded-br-2xl lg:rounded-tr-2xl ml-0 lg:-ml-3 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-bold tracking-wide text-text3">
                    @if ($complex->type == 'residential')
                        ЖК "{{ $complex->name }}"
                    @elseif ($complex->type == 'hotel')
                        ГК "{{ $complex->name }}"
                    @else
                        "{{ $complex->name }}"
                    @endif
                </h2>
                <p class="text-sm font-semibold tracking-wide mt-2 text-text3">
                    {{ $complex->address ?? 'Адрес не указан' }}
                </p>
            </div>

            <div class="lg:mt-0 mt-4">
                <p class="text-xs">Застройщик: <b>{{ $complex->developer->name ?? 'Не указан' }}</b></p>
                <div class="flex items-center gap-2 justify-between mt-4">
                    <div class="flex items-center space-x-px xs:space-x-1" aria-label="Rating" role="img">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= ($complex->rating ?? 3))
                                <img src="{{ asset('icons/Starmini.svg') }}" alt="" />
                            @else
                                <img src="{{ asset('icons/Stargraymini.svg') }}" alt="" />
                            @endif
                        @endfor
                    </div>
                    <a href="{{ route('editComplex', [auth()->user()->id, $complex->id]) }}"
                        class="flex items-center gap-x-2 bg-transparent hover:bg-black/5 px-3 py-2 transition-colors rounded-lg cursor-pointer text-sm">
                        <span class="lg:inline hidden">Редактировать</span>
                        <span class="lg:hidden inline text-primary">
                            {{ $complex->reviews_count ?? 0 }}<span class="px-1">/</span><span
                                class="text-red-500">{{ $complex->negative_reviews ?? 0 }}</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="flex flex-col items-center justify-center py-12">
        <i class="mdi mdi-home-city text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-lg font-semibold text-gray-600 mb-2">Комплексы не найдены</h3>
        <p class="text-gray-500 text-center mb-4">
            Попробуйте изменить поисковый запрос
        </p>
    </div>
@endforelse

<!-- Pagination -->
@if ($complexes->hasPages())
    <div class="flex justify-center mt-6" id="paginationContainer">
        {{ $complexes->appends(['search' => request('search')])->links('cabinet-pagination') }}
    </div>
@endif
