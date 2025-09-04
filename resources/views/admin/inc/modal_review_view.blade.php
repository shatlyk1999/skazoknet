<div class="modal fade" id="reviewModal_{{ $review->id }}" tabindex="-1"
    aria-labelledby="reviewModalLabel_{{ $review->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel_{{ $review->id }}">
                    Просмотр отзыва #{{ $review->id }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left Column - Review Info -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Информация об отзыве</h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3"><strong>Заголовок:</strong></div>
                                    <div class="col-sm-9">{{ $review->title }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><strong>Текст отзыва:</strong></div>
                                    <div class="col-sm-9">
                                        <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                            {{ $review->text }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><strong>Рейтинг:</strong></div>
                                    <div class="col-sm-9">
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">{{ $review->rating }}/5</span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }} me-1"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><strong>Тип отзыва:</strong></div>
                                    <div class="col-sm-9">
                                        <span
                                            class="badge {{ $review->type === 'positive' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
                                        </span>
                                    </div>
                                </div>
                                @if ($review->admin_note)
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Заметка админа:</strong></div>
                                        <div class="col-sm-9">
                                            <div class="alert alert-info">
                                                {{ $review->admin_note }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Images -->
                        @if ($review->images->count() > 0)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Изображения ({{ $review->images->count() }})</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($review->images as $image)
                                            <div class="col-md-4 mb-3">
                                                <img src="{{ asset('reviews/' . $image->image_path) }}"
                                                    class="img-fluid rounded"
                                                    style="max-height: 150px; width: 100%; object-fit: cover;"
                                                    alt="Review Image">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - User & Object Info -->
                    <div class="col-md-4">
                        <!-- User Info -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Пользователь</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-2"><strong>Имя:</strong> {{ $review->user->name }}</div>
                                <div class="mb-2"><strong>Email:</strong> {{ $review->user->email }}</div>
                                <div class="mb-2"><strong>Роль:</strong> {{ $review->user->role ?? 'user' }}</div>
                            </div>
                        </div>

                        <!-- Object Info -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Объект отзыва</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-2"><strong>Название:</strong> {{ $review->reviewable->name }}</div>
                                <div class="mb-2"><strong>Тип:</strong>
                                    {{ $review->reviewable_type === 'App\\Models\\Developer' ? 'Застройщик' : 'Комплекс' }}
                                </div>
                                <div class="mb-2"><strong>Город:</strong> {{ $review->city->name ?? 'Не указан' }}
                                </div>
                                @if ($review->reviewable_type === 'App\\Models\\Complex' && $review->reviewable->developer)
                                    <div class="mb-2"><strong>Застройщик:</strong>
                                        {{ $review->reviewable->developer->name }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Status Info -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Статус и статистика</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <strong>Статус:</strong>
                                    @if ($review->is_approved == 0)
                                        <span class="badge bg-warning">{{ $review->approval_status }}</span>
                                    @elseif ($review->is_approved == 1)
                                        <span class="badge bg-danger">{{ $review->approval_status }}</span>
                                    @elseif ($review->is_approved == 2)
                                        <span class="badge bg-success">{{ $review->approval_status }}</span>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <strong>В рейтинге:</strong>
                                    @if ($review->include_in_rating)
                                        <span class="badge bg-primary">Да</span>
                                    @else
                                        <span class="badge bg-secondary">Нет</span>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <strong>Видимость:</strong>
                                    @if ($review->is_hidden)
                                        <span class="badge bg-danger">Скрыт</span>
                                    @else
                                        <span class="badge bg-success">Видимый</span>
                                    @endif
                                </div>
                                <div class="mb-2"><strong>Просмотры:</strong> {{ $review->views }}</div>
                                <div class="mb-2"><strong>Лайки:</strong> {{ $review->likes }}</div>
                                <div class="mb-2"><strong>Дислайки:</strong> {{ $review->dislikes }}</div>
                                <div class="mb-2"><strong>Создан:</strong>
                                    {{ $review->created_at->format('d.m.Y H:i') }}</div>
                                <div class="mb-2"><strong>Обновлен:</strong>
                                    {{ $review->updated_at->format('d.m.Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
