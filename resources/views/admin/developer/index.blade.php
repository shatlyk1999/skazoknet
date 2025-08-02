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
                        <span style="text-transform: capitalize">Застройщики</span>
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
                                Застройщики
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
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#createDeveloper">
                                    + Создать застройщика
                                </button>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    Фильтр
                                </a>
                            </h4>
                        </div>
                        <div class="card-content">
                            @include('admin.inc.filter_developer')
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Логотип</th>
                                            {{-- <th>Пользователь</th> --}}
                                            <th>Название</th>
                                            <th>Сортировать</th>
                                            <th>Статус</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($developers as $key => $developer)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('developer/' . $developer->image) }}"
                                                        style="width:50px;height:50px;border-radius:10px;" alt="">
                                                </td>
                                                {{-- <td>
                                                    {{ $developer->user->name }} ({{ $developer->user->email }})
                                                </td> --}}
                                                <td>
                                                    {{ $developer->name }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $developer->sort }}
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch cursor-pointer">
                                                        <input class="form-check-input form-check-success cursor-pointer"
                                                            style="cursor: pointer" name="status" type="checkbox"
                                                            id="{{ $developer->id }}" data-id={{ $developer->id }}
                                                            @if ($developer->status == '1') checked @endif>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-outline-light" data-bs-toggle="modal"
                                                            data-bs-target="#info_{{ $developer->id }}">
                                                            <i class="bi bi-info-circle"></i>
                                                        </button>
                                                        {{-- info modal --}}
                                                        @include('admin.inc.modal_developer_info')
                                                        <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                                            data-bs-target="#edit_{{ $developer->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        {{-- info modal --}}
                                                        @include('admin.inc.modal_developer_edit')
                                                        <form action="{{ route('developer.destroy', $developer->id) }}"
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
                            {{ $developers->appends(request()->query())->links('admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- add vpn modal --}}
    @include('admin.inc.modal_developer_create')

@endsection

@section('script')
    <script src="{{ asset('js/tom-select-2.4.3.js') }}"></script>
    <script>
        const cities = @json($cities);
        // console.log(cities);
        new TomSelect('#select-links', {
            valueField: 'id',
            searchField: 'name',
            options: cities,
            render: {
                option: function(data, escape) {
                    return '<div>' +
                        '<span class="name">' + escape(data.name) + '</span>' +
                        '<span class="label">' + escape(data.label) + '</span>' +
                        '</div>';
                },
                item: function(data, escape) {
                    return '<div name="' + escape(data.label) + '">' + escape(data.name) + '</div>';
                }
            }
        });
    </script>

    <script>
        const selectedCities = {
            @foreach ($developers as $dev)
                {{ $dev->id }}: @json($dev->cities->pluck('id')),
            @endforeach
        };
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.modal').forEach(modalEl => {
                modalEl.addEventListener('shown.bs.modal', function() {
                    const modalId = modalEl.getAttribute('id'); // örn: edit_12
                    if (!modalId.startsWith('edit_')) return;

                    const developerId = modalId.split('_')[1];
                    const selectEl = modalEl.querySelector(`#select-links-${developerId}`);

                    if (!selectEl.tomselect) {
                        new TomSelect(selectEl, {
                            valueField: 'id',
                            searchField: 'name',
                            options: cities,
                            render: {
                                option: function(data, escape) {
                                    return `<div><span>${escape(data.name)}</span></div>`;
                                },
                                item: function(data, escape) {
                                    return `<div>${escape(data.name)}</div>`;
                                }
                            }
                        });
                    }

                    // Seçili şehirleri ata
                    const selected = selectedCities[developerId];
                    if (selected) {
                        selectEl.tomselect.setValue(selected);
                    }
                });
            });
        });
    </script>

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

            fetch('/backend/adm/developer-status', {
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
