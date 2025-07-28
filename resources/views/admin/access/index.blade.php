@extends('admin.layouts.main')

@section('title', 'Admin | Заявки')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        <span style="text-transform: capitalize">Заявки</span>
                    </h3>
                    <p class="text-subtitle text-muted">
                        Управление заявками на доступ
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Панель управления</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Заявки
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
                                <span>Список заявок</span>
                                {{-- <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle me-1" type="button"
                                        id="dropdownMenuButtonSec" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Статус
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                        <a class="dropdown-item" href="{{ route('admin.access.index') }}">Все</a>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.access.index', ['status' => 'pending']) }}">Ожидающие</a>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.access.index', ['status' => 'rejected']) }}">Отклоненные</a>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.access.index', ['status' => 'approved']) }}">Одобренные</a>
                                    </div>
                                </div> --}}
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <!-- Search Form -->
                                <form method="GET" action="{{ route('admin.access.index') }}" class="mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Поиск по названию, email или коду..."
                                                value="{{ request('search') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <select name="status" class="form-control">
                                                <option value="">Все статусы</option>
                                                <option value="pending"
                                                    {{ request('status') == 'pending' ? 'selected' : '' }}>Ожидающие
                                                </option>
                                                <option value="rejected"
                                                    {{ request('status') == 'rejected' ? 'selected' : '' }}>Отклоненные
                                                </option>
                                                <option value="approved"
                                                    {{ request('status') == 'approved' ? 'selected' : '' }}>Одобренные
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Поиск</button>
                                            <a href="{{ route('admin.access.index') }}" class="btn btn-danger">Очистить</a>
                                        </div>
                                    </div>
                                </form>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Название компании</th>
                                                <th>Код компании</th>
                                                <th>Email</th>
                                                <th>Статус</th>
                                                <th>Дата создания</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($accesses as $key => $access)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td style="white-space:nowrap">{{ $access->company_name }}</td>
                                                    <td>{{ $access->company_code }}</td>
                                                    <td>{{ $access->email }}</td>
                                                    <td>
                                                        @if ($access->status == 'pending')
                                                            <span class="badge bg-warning">Ожидает</span>
                                                        @elseif($access->status == 'rejected')
                                                            <span class="badge bg-danger">Отклонена</span>
                                                        @elseif($access->status == 'approved')
                                                            <span class="badge bg-success">Одобрена</span>
                                                        @endif
                                                    </td>
                                                    <td style="white-space:nowrap">
                                                        {{ $access->created_at->format('d.m.Y H:i') }}</td>
                                                    <td class="d-flex gap-2">
                                                        @if ($access->status == 'pending')
                                                            <a href="{{ route('admin.access.reject', $access->id) }}"
                                                                class="btn btn-sm btn-danger">Отклонить</a>
                                                            <a href="{{ route('admin.access.approve', $access->id) }}"
                                                                class="btn btn-sm btn-success">Одобрить</a>
                                                        @else
                                                            <span class="text-muted">Обработана</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Заявки не найдены</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="mt-3">
                                    {{ $accesses->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
