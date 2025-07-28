@extends('admin.layouts.main')

@section('title', 'Admin | Одобрить заявку')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Одобрить заявку</h3>
                    <p class="text-subtitle text-muted">
                        Одобрение заявки от {{ $access->company_name }}
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Панель управления</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.access.index') }}">Заявки</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Одобрить
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Информация о заявке</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3"><strong>Название компании:</strong></div>
                                <div class="col-md-9">{{ $access->company_name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><strong>Код компании:</strong></div>
                                <div class="col-md-9">{{ $access->company_code }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><strong>Email:</strong></div>
                                <div class="col-md-9">{{ $access->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><strong>Дата подачи:</strong></div>
                                <div class="col-md-9">{{ $access->created_at->format('d.m.Y H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Одобрить заявку</h4>
                        </div>
                        <div class="card-body">
                            <!-- Confirmation Modal Trigger -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#confirmModal">
                                Одобрить заявку
                            </button>
                            <a href="{{ route('admin.access.index') }}" class="btn btn-secondary">Отмена</a>

                            <!-- Form (initially hidden) -->
                            <div id="approveForm" style="display: none;">
                                <hr class="my-4">
                                <form action="{{ route('admin.access.sendApprove', $access->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Заголовок сообщения</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="login" class="form-label">Логин</label>
                                        <input type="text" class="form-control @error('login') is-invalid @enderror"
                                            id="login" name="login" value="{{ old('login') }}" required>
                                        @error('login')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Пароль</label>
                                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" value="{{ old('password') }}" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="message" class="form-label">Описание</label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5"
                                            required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Отправить сообщение</button>
                                        <button type="button" class="btn btn-secondary"
                                            onclick="hideForm()">Отмена</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Подтверждение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Застройщику компанию подключили?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-success" onclick="showForm()"
                        data-bs-dismiss="modal">Да</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showForm() {
            document.getElementById('approveForm').style.display = 'block';
        }

        function hideForm() {
            document.getElementById('approveForm').style.display = 'none';
        }
    </script>
@endsection
