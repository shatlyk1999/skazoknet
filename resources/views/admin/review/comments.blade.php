@extends('admin.layouts.main')

@section('title')
    Комментарии
@endsection

@section('content')
    <div class="page-heading">
        <h3>Комментарии</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header d-flex justify-content-between align-items-center">
                        <form class="d-flex gap-2" method="get">
                            <input type="text" name="review_id" class="form-control form-control-sm"
                                style="max-width:160px" placeholder="Review ID" value="{{ request('review_id') }}">
                            <select name="is_approved" class="form-select form-select-sm" style="max-width:180px;">
                                <option value="">Модерация</option>
                                <option value="1" @selected(request('is_approved') === '1')>Одобренные</option>
                                <option value="0" @selected(request('is_approved') === '0')>Не одобренные</option>
                            </select>
                            <button class="btn btn-primary btn-sm" type="submit">Фильтр</button>
                            <a href="{{ route('admin.review_comments.index') }}"
                                class="btn btn-outline-secondary btn-sm">Сбросить</a>
                        </form>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Review</th>
                                        <th>User</th>
                                        <th>Text</th>
                                        {{-- <th>Статус</th> --}}
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $c)
                                        <tr>
                                            <td>{{ $c->id }}</td>
                                            <td>#{{ $c->review_id }}</td>
                                            <td>{{ $c->user?->name ?? '—' }}</td>
                                            <td
                                                style="max-width: 420px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $c->text }}
                                            </td>
                                            {{-- <td>
                                                <span class="badge {{ $c->is_approved ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $c->is_approved ? 'Одобрен' : 'Ожидает' }}
                                                </span>
                                            </td> --}}
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#comment_{{ $c->id }}">
                                                    Show
                                                </button>
                                                @include('admin.inc.modal_comment')
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $comments->links('admin-pagination') }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
