@extends('admin.layouts.main')

@section('title', 'Admin | Плохие слова')
@section('css')
    {{--  --}}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        <span style="text-transform: capitalize">Плохие слова</span>
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
                                Плохие слова
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
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#createBadWord">
                                    + Добавить плохое слово
                                </button>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    Фильтр
                                </a>
                            </h4>
                        </div>
                        <div class="card-content">
                            <!-- Filter -->
                            <div class="collapse" id="collapseExample">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('bad-word.index') }}">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="search"
                                                        value="{{ request('search') }}" placeholder="Поиск слова...">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Фильтр</button>
                                                    <a href="{{ route('bad-word.index') }}"
                                                        class="btn btn-secondary">Очистить</a>
                                                </div>
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
                                            <th>Слово</th>
                                            <th>Дата создания</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($badWords as $key => $badWord)
                                            <tr>
                                                <td>
                                                    {{ $badWords->firstItem() + $key }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $badWord->word }}
                                                </td>
                                                <td>
                                                    {{ $badWord->created_at->format('d.m.Y H:i') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                                            data-bs-target="#edit_{{ $badWord->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        {{-- edit modal --}}
                                                        @include('admin.inc.modal_bad_word_edit')
                                                        <form action="{{ route('bad-word.destroy', $badWord->id) }}"
                                                            method="post" style="margin-bottom: 0px;">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-outline-danger"
                                                                onclick="return confirm('Вы уверены, что хотите удалить это слово?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Плохие слова не найдены</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $badWords->appends(request()->query())->links('admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- create modal --}}
    @include('admin.inc.modal_bad_word_create')

@endsection

@section('script')
    {{-- Status script kaldırıldı --}}
@endsection
