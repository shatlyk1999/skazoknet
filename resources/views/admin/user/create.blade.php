@extends('admin.layouts.main')
@section('title', 'Admin | Создать Пользователь')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}"> --}}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Создать
                        <span class="text-capitalize">Пользователь</span>
                    </h3>
                    {{-- <p class="text-subtitle text-muted">Give textual form controls like input upgrade with custom styles,
                        sizing, focus states, and more.</p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Панель управления</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Пользователи</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <span class="text-capitalize">Создать пользователя
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Создать
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Пользователь</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Электронная почта
                                    </label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="example@gmail.com" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="text" name="password" class="form-control" id="password"
                                        placeholder="password" required>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input form-check-success" name="permission_comment"
                                            type="checkbox" id="permission_comment">
                                        <label class="form-check-label" for="permission_comment">Разрешение на комментарий
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input form-check-success" name="status" type="checkbox"
                                            id="status">
                                        <label class="form-check-label" for="status">Статус
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary">Создать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    {{-- <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script> --}}
    <script src="{{ asset('assets/static/js/pages/date-picker.js') }}"></script>
@endsection
