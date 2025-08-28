@extends('admin.layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Дополнения к отзыву #{{ $review->id }}</h3>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <strong>Отзыв:</strong>
                    <div class="mt-2 p-3 border rounded">
                        <div class="mb-2">
                            Пользователь: {{ $review->user?->name ?? '—' }}
                            <span class="mx-2">|</span>
                            Объект:
                            @if (class_basename($review->reviewable_type) == 'Developer')
                                Застройщик
                            @endif
                            @if (class_basename($review->reviewable_type) == 'Complex')
                                Комплекс
                            @endif
                            #{{ $review->reviewable->name }}
                        </div>
                        <div>{!! nl2br(e($review->content)) !!}</div>
                    </div>
                </div>

                <h5 class="mb-3">Список дополнений</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Текст</th>
                            <th>Изображения</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($review->additions as $addition)
                            <tr>
                                <td>{{ $addition->id }}</td>
                                <td>{{ $addition->user?->name ?? '—' }}</td>
                                <td style="max-width: 400px;">{{ Str::limit($addition->text, 50) }}
                                </td>
                                <td>
                                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                        @foreach ($addition->images as $img)
                                            <img src="{{ asset('addition-images/' . $img->image) }}"
                                                style="width:80px;height:80px;object-fit:cover;border-radius:6px;" />
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    @if ($addition->is_hidden)
                                        <span class="badge bg-secondary">Скрыто</span>
                                    @elseif($addition->is_approved)
                                        <span class="badge bg-success">Одобрено</span>
                                    @else
                                        <span class="badge bg-warning text-dark">На модерации</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.review.additions.approve', $addition->id) }}"
                                        method="post" style="display:inline-block;">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit">Одобрить</button>
                                    </form>
                                    <form action="{{ route('admin.review.additions.reject', $addition->id) }}"
                                        method="post" style="display:inline-block;">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit">Скрыть</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Нет дополнений</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
