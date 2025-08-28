@extends('admin.layouts.main')

@section('title', 'Admin | Отзывы')
@section('css')
    {{--  --}}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        <span style="text-transform: capitalize">Отзывы</span>
                    </h3>
                    <p class="text-subtitle text-muted">
                        {{--  --}}
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Панель управления
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Отзывы
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-flex justify-content-between align-items-center">
                                <span>Управление отзывами</span>
                                <a class="btn btn-secondary" data-bs-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Фильтр
                                </a>
                            </h4>
                        </div>
                        <div class="card-content">
                            <!-- Filter -->
                            <div class="collapse {{ request()->hasAny(['search', 'type', 'is_approved', 'include_in_rating', 'reviewable_type', 'is_hidden']) ? 'show' : '' }}"
                                id="collapseExample">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('reviews.index') }}">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="search"
                                                        value="{{ request('search') }}"
                                                        placeholder="Поиск по заголовку, тексту или пользователю...">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select class="form-control" name="type">
                                                        <option value="">Все типы</option>
                                                        <option value="positive"
                                                            {{ request('type') == 'positive' ? 'selected' : '' }}>
                                                            Положительные</option>
                                                        <option value="negative"
                                                            {{ request('type') == 'negative' ? 'selected' : '' }}>Негативные
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="is_approved">
                                                        <option value="">Статус</option>
                                                        <option value="1"
                                                            {{ request('is_approved') == '1' ? 'selected' : '' }}>Одобрен
                                                        </option>
                                                        <option value="0"
                                                            {{ request('is_approved') == '0' ? 'selected' : '' }}>На
                                                            модерации</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="include_in_rating">
                                                        <option value="">Рейтинг</option>
                                                        <option value="1"
                                                            {{ request('include_in_rating') == '1' ? 'selected' : '' }}>В
                                                            рейтинге</option>
                                                        <option value="0"
                                                            {{ request('include_in_rating') == '0' ? 'selected' : '' }}>
                                                            Исключен</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="is_hidden">
                                                        <option value="">Видимость</option>
                                                        <option value="0"
                                                            {{ request('is_hidden') == '0' ? 'selected' : '' }}>Видимые
                                                        </option>
                                                        <option value="1"
                                                            {{ request('is_hidden') == '1' ? 'selected' : '' }}>Скрытые
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select class="form-control" name="reviewable_type">
                                                        <option value="">Все объекты</option>
                                                        <option value="developer"
                                                            {{ request('reviewable_type') == 'developer' ? 'selected' : '' }}>
                                                            Застройщики</option>
                                                        <option value="complex"
                                                            {{ request('reviewable_type') == 'complex' ? 'selected' : '' }}>
                                                            Комплексы</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="city_id">
                                                        <option value="">Все города</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Фильтр</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ route('reviews.index') }}"
                                                    class="btn btn-secondary btn-sm">Очистить</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Пользователь</th>
                                            <th>Объект</th>
                                            <th>Город</th>
                                            <th>Тип</th>
                                            <th>Заголовок</th>
                                            <th>Рейтинг</th>
                                            <th>Статус</th>
                                            <th>В рейтинге</th>
                                            <th>Видимость</th>
                                            <th>Просмотры</th>
                                            <th>Лайки</th>
                                            <th>Дата</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reviews as $key => $review)
                                            <tr>
                                                <td>{{ $reviews->firstItem() + $key }}</td>
                                                <td>
                                                    <strong>{{ $review->user->name }}</strong><br>
                                                    <small class="text-muted">{{ $review->user->email }}</small>
                                                </td>
                                                <td>
                                                    <strong>{{ $review->reviewable->name }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ $review->reviewable_type === 'App\\Models\\Developer' ? 'Застройщик' : 'Комплекс' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <strong>{{ $review->city->name ?? 'Не указан' }}</strong>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $review->type === 'positive' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong>{{ Str::limit($review->title, 30) }}</strong><br>
                                                    {{-- <small class="text-muted">{{ Str::limit($review->text, 50) }}</small> --}}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-1">{{ $review->rating }}</span>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($review->is_approved)
                                                        <span class="badge bg-success">Одобрен</span>
                                                    @else
                                                        <span class="badge bg-warning">На модерации</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($review->include_in_rating)
                                                        <span class="badge bg-primary">В рейтинге</span>
                                                    @else
                                                        <span class="badge bg-secondary">Исключен</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($review->is_hidden)
                                                        <span class="badge bg-danger">Скрыт</span>
                                                    @else
                                                        <span class="badge bg-success">Видимый</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <i class="bi bi-eye"></i> {{ $review->views }}
                                                </td>
                                                <td>
                                                    <i class="bi bi-hand-thumbs-up"></i> {{ $review->total_likes }}
                                                    <i class="bi bi-hand-thumbs-down ms-1"></i>
                                                    {{ $review->total_dislikes }}
                                                </td>
                                                <td>{{ $review->created_at->format('d.m.Y H:i') }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#reviewModal_{{ $review->id }}">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button class="btn btn-outline-warning btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editReviewModal_{{ $review->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        @if (!$review->is_approved)
                                                            <form action="{{ route('reviews.approve', $review->id) }}"
                                                                method="post" style="margin-bottom: 0px;">
                                                                @csrf
                                                                <button class="btn btn-outline-success btn-sm"
                                                                    title="Одобрить">
                                                                    <i class="bi bi-check"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('reviews.reject', $review->id) }}"
                                                                method="post" style="margin-bottom: 0px;">
                                                                @csrf
                                                                <button class="btn btn-outline-warning btn-sm"
                                                                    title="Отклонить">
                                                                    <i class="bi bi-x"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <form action="{{ route('reviews.toggle-rating', $review->id) }}"
                                                            method="post" style="margin-bottom: 0px;">
                                                            @csrf
                                                            <button
                                                                class="btn btn-outline-{{ $review->include_in_rating ? 'secondary' : 'primary' }} btn-sm"
                                                                title="{{ $review->include_in_rating ? 'Исключить из рейтинга' : 'Включить в рейтинг' }}">
                                                                <i
                                                                    class="bi bi-{{ $review->include_in_rating ? 'dash' : 'plus' }}-circle"></i>
                                                            </button>
                                                        </form>
                                                        @if (!$review->is_hidden)
                                                            <form action="{{ route('reviews.hide', $review->id) }}"
                                                                method="post" style="margin-bottom: 0px;">
                                                                @csrf
                                                                <button class="btn btn-outline-danger btn-sm"
                                                                    title="Скрыть отзыв (будет виден только автору)"
                                                                    onclick="return confirm('Скрыть этот отзыв? Он будет виден только автору.')">
                                                                    <i class="bi bi-eye-slash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('reviews.unhide', $review->id) }}"
                                                                method="post" style="margin-bottom: 0px;">
                                                                @csrf
                                                                <button class="btn btn-outline-success btn-sm"
                                                                    title="Показать отзыв всем пользователям">
                                                                    <i class="bi bi-eye"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <form action="{{ route('reviews.destroy', $review->id) }}"
                                                            method="post" style="margin-bottom: 0px;">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-outline-danger btn-sm"
                                                                onclick="return confirm('Вы уверены, что хотите ПОЛНОСТЬЮ удалить этот отзыв?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                        <div class="m-0 position-relative">
                                                            <a href="{{ route('admin.review.additions', $review->id) }}"
                                                                class="btn btn-sm @if ($review->additions()->count() == 0) btn-secondary @endif @if ($review->additions()->count() > 0) btn-primary @endif">Дополнения</a>
                                                            @php
                                                                $pending_additions = $review
                                                                    ->additions()
                                                                    ->where('is_approved', false)
                                                                    ->count();
                                                            @endphp
                                                            @if ($pending_additions > 0)
                                                                <span
                                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                                    style="font-size: 10px; padding: 2px 6px;">
                                                                    {{ $pending_additions }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <a href="{{ route('admin.review_comments.index', ['review_id' => $review->id]) }}"
                                                            class="btn btn-sm @if ($review->comments()->count() == 0) btn-outline-secondary @endif @if ($review->comments()->count() > 0) btn-outline-primary @endif">Комментарии</a>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- View Modal --}}
                                            @include('admin.inc.modal_review_view')

                                            {{-- Edit Modal --}}
                                            @include('admin.inc.modal_review_edit')

                                            {{-- Edit Modal --}}
                                            <div class="modal fade" id="reviewModal_{{ $review->id }}" tabindex="-1"
                                                aria-labelledby="reviewModalLabel_{{ $review->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="reviewModalLabel_{{ $review->id }}">
                                                                Просмотр отзыва #{{ $review->id }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- Left Column - Review Info -->
                                                                <div class="col-md-8">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h6 class="card-title mb-0">Информация об
                                                                                отзыве</h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-3">
                                                                                    <strong>Заголовок:</strong>
                                                                                </div>
                                                                                <div class="col-sm-9">{{ $review->title }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-3"><strong>Текст
                                                                                        отзыва:</strong></div>
                                                                                <div class="col-sm-9">
                                                                                    <div class="border rounded p-3"
                                                                                        style="max-height: 200px; overflow-y: auto;">
                                                                                        {{ $review->text }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-3">
                                                                                    <strong>Рейтинг:</strong>
                                                                                </div>
                                                                                <div class="col-sm-9">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <span
                                                                                            class="me-2">{{ $review->rating }}/5</span>
                                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                                            <i
                                                                                                class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }} me-1"></i>
                                                                                        @endfor
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-3"><strong>Тип
                                                                                        отзыва:</strong></div>
                                                                                <div class="col-sm-9">
                                                                                    <span
                                                                                        class="badge {{ $review->type === 'positive' ? 'bg-success' : 'bg-danger' }}">
                                                                                        {{ $review->type === 'positive' ? 'Положительный' : 'Негативный' }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            @if ($review->admin_note)
                                                                                <div class="row mb-3">
                                                                                    <div class="col-sm-3"><strong>Заметка
                                                                                            админа:</strong></div>
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
                                                                                <h6 class="card-title mb-0">Изображения
                                                                                    ({{ $review->images->count() }})
                                                                                </h6>
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
                                                                            <div class="mb-2"><strong>Имя:</strong>
                                                                                {{ $review->user->name }}</div>
                                                                            <div class="mb-2"><strong>Email:</strong>
                                                                                {{ $review->user->email }}</div>
                                                                            <div class="mb-2"><strong>Роль:</strong>
                                                                                {{ $review->user->role ?? 'user' }}</div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Object Info -->
                                                                    <div class="card mt-3">
                                                                        <div class="card-header">
                                                                            <h6 class="card-title mb-0">Объект отзыва</h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="mb-2"><strong>Название:</strong>
                                                                                {{ $review->reviewable->name }}</div>
                                                                            <div class="mb-2"><strong>Тип:</strong>
                                                                                {{ $review->reviewable_type === 'App\\Models\\Developer' ? 'Застройщик' : 'Комплекс' }}
                                                                            </div>
                                                                            @if ($review->reviewable_type === 'App\\Models\\Complex' && $review->reviewable->developer)
                                                                                <div class="mb-2">
                                                                                    <strong>Застройщик:</strong>
                                                                                    {{ $review->reviewable->developer->name }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <!-- Status Info -->
                                                                    <div class="card mt-3">
                                                                        <div class="card-header">
                                                                            <h6 class="card-title mb-0">Статус и статистика
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="mb-2">
                                                                                <strong>Статус:</strong>
                                                                                @if ($review->is_approved)
                                                                                    <span
                                                                                        class="badge bg-success">Одобрен</span>
                                                                                @else
                                                                                    <span class="badge bg-warning">На
                                                                                        модерации</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-2">
                                                                                <strong>В рейтинге:</strong>
                                                                                @if ($review->include_in_rating)
                                                                                    <span
                                                                                        class="badge bg-primary">Да</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge bg-secondary">Нет</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-2">
                                                                                <strong>Видимость:</strong>
                                                                                @if ($review->is_hidden)
                                                                                    <span
                                                                                        class="badge bg-danger">Скрыт</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge bg-success">Видимый</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-2"><strong>Просмотры:</strong>
                                                                                {{ $review->views }}</div>
                                                                            <div class="mb-2"><strong>Лайки:</strong>
                                                                                {{ $review->likes }}</div>
                                                                            <div class="mb-2"><strong>Дислайки:</strong>
                                                                                {{ $review->dislikes }}</div>
                                                                            <div class="mb-2"><strong>Создан:</strong>
                                                                                {{ $review->created_at->format('d.m.Y H:i') }}
                                                                            </div>
                                                                            <div class="mb-2"><strong>Обновлен:</strong>
                                                                                {{ $review->updated_at->format('d.m.Y H:i') }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Закрыть</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Edit Review Modal --}}
                                            <div class="modal fade" id="editReviewModal_{{ $review->id }}"
                                                tabindex="-1" aria-labelledby="editReviewModalLabel_{{ $review->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <form action="{{ route('reviews.update', $review->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editReviewModalLabel_{{ $review->id }}">
                                                                    Редактировать отзыв #{{ $review->id }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="title_{{ $review->id }}"
                                                                                class="form-label">Заголовок</label>
                                                                            <input type="text" class="form-control"
                                                                                id="title_{{ $review->id }}"
                                                                                name="title"
                                                                                value="{{ $review->title }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="text_{{ $review->id }}"
                                                                                class="form-label">Текст отзыва</label>
                                                                            <textarea class="form-control" id="text_{{ $review->id }}" name="text" rows="5" required>{{ $review->text }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="rating_{{ $review->id }}"
                                                                                class="form-label">Рейтинг</label>
                                                                            <select class="form-control"
                                                                                id="rating_{{ $review->id }}"
                                                                                name="rating" required>
                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                    <option value="{{ $i }}"
                                                                                        {{ $review->rating == $i ? 'selected' : '' }}>
                                                                                        {{ $i }}
                                                                                        звезд{{ $i > 1 ? 'ы' : 'а' }}
                                                                                    </option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="admin_note_{{ $review->id }}"
                                                                                class="form-label">Заметка админа</label>
                                                                            <textarea class="form-control" id="admin_note_{{ $review->id }}" name="admin_note" rows="3"
                                                                                placeholder="Внутренняя заметка для администраторов...">{{ $review->admin_note }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Отмена</button>
                                                                <button type="submit" class="btn btn-primary">Сохранить
                                                                    изменения</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="13" class="text-center">Отзывы не найдены</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $reviews->appends(request()->query())->links('admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    {{-- Additional scripts if needed --}}
@endsection
