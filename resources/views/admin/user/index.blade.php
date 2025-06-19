@extends('admin.layouts.main')

@section('title', 'Admin | Users')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/extensions/simple-datatables/style.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/compiled/css/table-datatable.css') }}" />
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        <span style="text-transform: capitalize">Пользователи</span>
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
                                Пользователи
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
                            <h4 class="card-title">
                                <a href="{{ route('users.create') }}">
                                    + <span style="text-transform: capitalize">Создать Пользователь</span>
                                </a>
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {{-- <p>Add <code class="highlighter-rouge">.table-hover</code> to enable a hover state on table
                                    rows
                                    within a
                                    <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                                </p> --}}
                            </div>
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Имя</th>
                                            <th>Электронная почта</th>
                                            <th>Дата создания</th>
                                            <th>Разрешение на комментарий</th>
                                            <th>Статус</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td class="text-bold-500">
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->created_at->format('d.m.Y') }}
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input form-check-success"
                                                            name="permission_comment" type="checkbox"
                                                            id="{{ $user->id }}" data-id="{{ $user->id }}"
                                                            @if ($user->permission_comment == '1') checked @endif>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input form-check-success" name="status"
                                                            type="checkbox" id="{{ $user->id }}"
                                                            data-id={{ $user->id }}
                                                            @if ($user->status == '1') checked @endif>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-outline-warning">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-outline-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->onEachSide(1) }}
                            {{-- {{ $users->links('vendor.pagination.tailwind') }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('admin/static/js/pages/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('change', function(event) {
            const checkbox = event.target;
            if (!checkbox.matches('.form-check-input[name="status"]')) return;

            const id = checkbox.dataset.id;
            const status = checkbox.checked;
            checkbox.disabled = true;

            fetch('/backend/adm/user-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        status: status,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message, 'Успешно', {
                            closeButton: true,
                            positionClass: 'toast-top-right'
                        });
                    } else {
                        toastr.error(data.message || 'Статус не удалось обновить', 'Ошибка', {
                            closeButton: true,
                            positionClass: 'toast-top-right'
                        });
                        checkbox.checked = !status;
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    toastr.error('Произошла ошибка!', 'Ошибка', {
                        closeButton: true,
                        positionClass: 'toast-top-right'
                    });
                    checkbox.checked = !status;
                })
                .finally(() => {
                    checkbox.disabled = false;
                });
        });

        document.addEventListener('change', function(event) {
            const checkbox = event.target;
            if (!checkbox.matches('.form-check-input[name="permission_comment"]'))
                return;

            const id = checkbox.dataset.id;
            const permission_comment = checkbox.checked;
            checkbox.disabled = true;

            fetch('/backend/adm/user-permission-comment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        permission_comment: permission_comment,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message, 'Успешно', {
                            closeButton: true,
                            positionClass: 'toast-top-right'
                        });
                    } else {
                        toastr.error(data.message || 'Статус не удалось обновить', 'Ошибка', {
                            closeButton: true,
                            positionClass: 'toast-top-right'
                        });
                        checkbox.checked = !status;
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    toastr.error('Произошла ошибка!', 'Ошибка', {
                        closeButton: true,
                        positionClass: 'toast-top-right'
                    });
                    checkbox.checked = !status;
                })
                .finally(() => {
                    checkbox.disabled = false;
                });
        });
    </script>
@endsection
