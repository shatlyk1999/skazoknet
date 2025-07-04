@extends('admin.layouts.main')
@section('title', 'Admin | Редактировать Город')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}"> --}}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Редактировать
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
                                <span class="text-capitalize">Редактировать Город
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
                        Редактировать
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('city.update', $city->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{-- <label for="name">Город</label> --}}
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Город" required value="{{ old('name', $city->name) }}">
                                </div>

                                <div class="form-group">
                                    {{-- <label for="label">Область</label> --}}
                                    <input type="text" name="label" class="form-control" id="label"
                                        placeholder="Область" required value="{{ old('name', $city->label) }}">
                                </div>
                                <div class="form-group">
                                    <label for="image">Фото</label>
                                    <img src="{{ asset('cities/' . $city->image) }}" alt=""
                                        style="width: 100px;height:100px;border-radius:50px;">
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary">Редактировать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
