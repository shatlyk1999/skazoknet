<div class="modal fade" id="editReviewModal_{{ $review->id }}" tabindex="-1"
    aria-labelledby="editReviewModalLabel_{{ $review->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReviewModalLabel_{{ $review->id }}">
                        Редактировать отзыв #{{ $review->id }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Column - Edit Form -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Редактирование отзыва</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="title_{{ $review->id }}" class="form-label">
                                            Заголовок <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="title_{{ $review->id }}"
                                            name="title" value="{{ $review->title }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="text_{{ $review->id }}" class="form-label">
                                            Текст отзыва <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="text_{{ $review->id }}" name="text" rows="8" required>{{ $review->text }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Рейтинг</label>
                                        <div class="form-control-plaintext">
                                            <div class="d-flex align-items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                                <span class="ms-2">{{ $review->rating }}/5</span>
                                            </div>
                                            <small class="text-muted">Рейтинг нельзя изменить после создания
                                                отзыва</small>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="admin_note_{{ $review->id }}" class="form-label">
                                            Заметка администратора
                                        </label>
                                        <textarea class="form-control" id="admin_note_{{ $review->id }}" name="admin_note" rows="3"
                                            placeholder="Добавьте заметку для внутреннего использования...">{{ $review->admin_note }}</textarea>
                                        <small class="form-text text-muted">
                                            Эта заметка видна только администраторам
                                        </small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="likes_{{ $review->id }}" class="form-label">
                                                    <i class="fas fa-thumbs-up text-success"></i> Лайки (Админ)
                                                </label>
                                                <input type="number" class="form-control"
                                                    id="likes_{{ $review->id }}" name="likes"
                                                    value="{{ $review->likes ?? 0 }}" min="0">
                                                <small class="form-text text-muted">
                                                    Реальные: {{ $review->likes()->count() }} | Админ:
                                                    {{ $review->likes ?? 0 }} | Всего: {{ $review->total_likes }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="dislikes_{{ $review->id }}" class="form-label">
                                                    <i class="fas fa-thumbs-down text-danger"></i> Дислайки (Админ)
                                                </label>
                                                <input type="number" class="form-control"
                                                    id="dislikes_{{ $review->id }}" name="dislikes"
                                                    value="{{ $review->dislikes ?? 0 }}" min="0">
                                                <small class="form-text text-muted">
                                                    Реальные: {{ $review->dislikes()->count() }} | Админ:
                                                    {{ $review->dislikes ?? 0 }} | Всего:
                                                    {{ $review->total_dislikes }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Review Info -->
                        <div class="col-md-4">
                            <!-- Current Info -->
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Информация об отзыве</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>Автор:</strong> {{ $review->user->name }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Объект:</strong> {{ $review->reviewable->name }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Город:</strong> {{ $review->city->name ?? 'Не указан' }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Тип:</strong>
                                        <span
                                            class="badge {{ $review->type === 'positive' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Создан:</strong> {{ $review->created_at->format('d.m.Y H:i') }}
                                    </div>
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
                                </div>
                            </div>

                            <!-- Images (if any) -->
                            @if ($review->images->count() > 0)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Изображения</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($review->images as $image)
                                            <img src="{{ asset('storage/reviews/' . $image->image_path) }}"
                                                class="img-fluid rounded mb-2"
                                                style="max-height: 80px; width: 100%; object-fit: cover;"
                                                alt="Review Image">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </div>
        </form>
    </div>
</div>
