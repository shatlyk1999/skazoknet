@extends('admin.layouts.main')

@section('title', 'Admin | Комплекс')
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
                        <span style="text-transform: capitalize">Жилые комплексы</span>
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
                                Жилые комплексы
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
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#createComplex">
                                    + Создать комплекс
                                </button>
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
                                            <th>Фото</th>
                                            <th>Название</th>
                                            <th>Застройщик</th>
                                            <th>Сортировать</th>
                                            <th>Статус</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($complexes as $key => $complex)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('complex/' . $complex->image) }}"
                                                        style="width:50px;height:50px;border-radius:10px;" alt="">
                                                </td>
                                                <td>
                                                    {{ $complex->name }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $complex->developer->name ?? ' ' }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $complex->sort ?? '' }}
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch cursor-pointer">
                                                        <input class="form-check-input form-check-success cursor-pointer"
                                                            style="cursor: pointer" name="status" type="checkbox"
                                                            id="{{ $complex->id }}" data-id={{ $complex->id }}
                                                            @if ($complex->status == '1') checked @endif>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-outline-secondary" data-bs-toggle="modal"
                                                            data-bs-target="#info_{{ $complex->id }}">
                                                            <i class="bi bi-info-circle"></i>
                                                        </button>
                                                        {{-- info modal --}}
                                                        @include('admin.inc.modal_complex_info')
                                                        <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                                            data-bs-target="#edit_{{ $complex->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        {{-- info modal --}}
                                                        @include('admin.inc.modal_complex_edit')
                                                        <form action="{{ route('complex.destroy', $complex->id) }}"
                                                            method="post" style="margin-bottom: 0px;">
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
                            {{ $complexes->onEachSide(1) }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- add vpn modal --}}
    @include('admin.inc.modal_complex_create')

@endsection

@section('script')
    <script src="{{ asset('admin/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('admin/static/js/pages/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote_edit').each(function() {
                $(this).summernote({
                    height: 150,
                });
            });
        });
    </script>

    <script>
        document.addEventListener('change', function(event) {
            const checkbox = event.target;
            if (!checkbox.matches('.form-check-input[name="status"]')) return;

            const id = checkbox.dataset.id;
            const status = checkbox.checked;
            checkbox.disabled = true;

            fetch('/backend/adm/complex-status', {
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
    </script>
@endsection
