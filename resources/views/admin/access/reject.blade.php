@extends('admin.layouts.main')

@section('title', 'Admin | Отклонить заявку')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Отклонить заявку</h3>
                    <p class="text-subtitle text-muted">
                        Отклонение заявки от {{ $access->company_name }}
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
                                Отклонить
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
                            <h4 class="card-title">Отклонить заявку</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.access.sendReject', $access->id) }}" method="POST">
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
                                    <label for="message" class="form-label">Описание (причина отклонения)</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5"
                                        required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Отправить сообщение</button>
                                    <a href="{{ route('admin.access.index') }}" class="btn btn-secondary">Отмена</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
