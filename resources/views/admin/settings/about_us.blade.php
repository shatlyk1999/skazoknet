@extends('admin.layouts.main')

@section('title', 'Admin | About Us')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/extensions/summernote/summernote-lite.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/compiled/css/form-editor-summernote.css') }}">
    <style>
        .note-editable {
            min-height: 250px;
        }
    </style>
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>О проекте </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                            <li class="breadcrumb-item active" aria-current="page">О проекте</li>
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
                            {{-- <h4 class="card-title">Default Editor</h4> --}}
                        </div>
                        <form action="{{ route('settings.about_us.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <textarea name="text" id="summernote">
                                    @if ($data != null)
{!! $data->text !!}
@endif
                                </textarea>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary w-100">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('admin/static/js/pages/summernote.js') }}"></script>
@endsection
