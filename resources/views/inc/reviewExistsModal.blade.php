<!-- Review Exists Modal -->
@if (isset($review))
    <div id="reviewExistsModal"
        class="fixed inset-0 bg-black/50 bg-opacity-50 backdrop-blur-md hidden z-50 flex items-center justify-center p-4">
        <div id="reviewExistsModalContent"
            class="bg-white rounded-lg shadow-xl w-full max-w-[500px] transform transition-all duration-300 scale-95 opacity-0">
            <!-- Header -->
            <div class="bg-primary text-white px-4 py-3 rounded-t-lg">
                <h3 class="text-base font-semibold">Уведомление</h3>
            </div>

            <!-- Body -->
            <div class="p-4 text-center">
                <div class="mb-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto">
                        <i class="mdi mdi-information text-2xl text-blue-600"></i>
                    </div>
                </div>
                <p class="text-gray-700 mb-4 text-sm leading-relaxed">
                    @if ($review->reviewable_type === 'App\Models\Developer')
                        Вы уже оставили отзыв для этого застройщика. Каждый пользователь может оставить только один
                        отзыв на
                        застройщика.
                    @else
                        Вы уже оставили отзыв для этого комплекса. Каждый пользователь может оставить только один отзыв
                        на
                        комплекс.
                    @endif
                </p>
                <button onclick="closeReviewExistsModal()"
                    class="bg-primary cursor-pointer text-white px-5 py-2 rounded-lg transition-colors duration-200 text-sm">
                    Понятно
                </button>
            </div>
        </div>
    </div>
@endif
