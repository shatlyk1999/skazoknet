@extends('admin.layouts.main')
@section('title', 'Admin | Создать Город')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}"> --}}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Создать
                        <span class="text-capitalize">Город</span>
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
                            <li class="breadcrumb-item"><a href="{{ route('city.index') }}">Города</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <span class="text-capitalize">Создать Город
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
                    <form action="{{ route('city.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    {{-- <label for="name">Город</label> --}}
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Город" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="label">Область</label> --}}
                                    <input type="text" name="label" class="form-control" id="label"
                                        placeholder="Область" required>
                                    @error('label')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="text">Текст</label> --}}
                                    <input type="text" name="text" class="form-control" id="text"
                                        placeholder="Текст" required>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="developer_text">Текст (застройщик)</label> --}}
                                    <input type="text" name="developer_text" class="form-control" id="developer_text"
                                        placeholder="Текст (застройщик)">
                                    @error('developer_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Фото</label>
                                    <input type="file" name="image" class="form-control" id="image" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
