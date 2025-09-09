@extends('admin.layouts.main')

@section('title', 'Admin | Застройщики')
@section('css')
    <link rel="stylesheet" href="{{ asset('styles/tom-select-2.4.3.css') }}" />
    <style>
        .ts-wrapper .option .name {
            display: block;
        }

        .ts-wrapper .option .label {
            font-size: 12px;
            display: block;
            color: #a0a0a0;
        }

        button.close,
        button[data-bs-dismiss="modal"] {
            all: unset;
            /* color: #fef08a !important; */
            font-size: 1.25rem;
            cursor: pointer;
        }


        @media (max-width: 992px) {
            .filter {
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
            }

            .filter>div {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('admin/extensions/summernote/summernote-lite.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/compiled/css/form-editor-summernote.css') }}">

@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        <span style="text-transform: capitalize">Контакт</span>
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
                                Контакт
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
                        {{-- <div class="card-header">
                            <h4 class="card-title d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#createcontact">
                                    + Создать застройщика
                                </button>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    Фильтр
                                </a>
                            </h4>
                        </div> --}}
                        <div class="card-content">
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Пользователь</th>
                                            <th>Имя</th>
                                            <th>Электронная почта</th>
                                            <th>Заметка</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $key => $contact)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    {{ $contact->user->name ?? '-' }}
                                                </td>
                                                <td>
                                                    {{ $contact->name }}
                                                </td>
                                                <td>
                                                    {{ $contact->email }}
                                                </td>
                                                <td>
                                                    {{ $contact->note }}
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-outline-light" data-bs-toggle="modal"
                                                            data-bs-target="#info_{{ $contact->id }}">
                                                            <i class="bi bi-info-circle"></i>
                                                        </button>
                                                        {{-- info modal --}}
                                                        @include('admin.inc.modal_contact_info')
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $contacts->appends(request()->query())->links('admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
