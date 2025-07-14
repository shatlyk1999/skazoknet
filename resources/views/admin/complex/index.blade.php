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
                            <h4 class="card-title d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#createComplex">
                                    + Создать комплекс
                                </button>
                                <a class="btn btn-secondary" data-bs-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Фильтр
                                </a>
                            </h4>
                        </div>
                        <div class="card-content">
                            <form action="{{ route('complex.index.post') }}" method="post">
                                @csrf
                                <div class="collapse {{ !empty($filter) ? 'show' : '' }}" id="collapseExample">
                                    <div class="filter d-flex justify-content-between align-items-end">
                                        <div>
                                            <label for="search">Название</label>
                                            <input type="text" name="search" class="form-control" placeholder=""
                                                value="{{ isset($filter['search']) ? $filter['search'] : '' }}">
                                        </div>
                                        <div>
                                            <label for="type">Тип</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="">--</option>
                                                <option value="residential"
                                                    @if (isset($filter['type']) && $filter['type'] == 'residential') selected @endif>
                                                    Жилые комплекс</option>
                                                <option value="hotel" @if (isset($filter['type']) && $filter['type'] == 'hotel') selected @endif>
                                                    Гостиничные комплекс</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="city_id">Город</label>
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">--</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        @if (isset($filter['city_id']) && $filter['city_id'] == $city->id) selected @endif>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="developer_id">Застройщик</label>
                                            <select name="developer_id" id="developer_id" class="form-control">
                                                <option value="">--</option>
                                                @foreach ($developers as $developer)
                                                    <option value="{{ $developer->id }}"
                                                        @if (isset($filter['developer_id']) && $filter['developer_id'] == $developer->id) selected @endif>
                                                        {{ $developer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="image">Логотип</label>
                                            <select name="image" id="image" class="form-control">
                                                <option value="">--</option>
                                                <option value="1" @if (isset($filter['image']) && $filter['image'] == '1') selected @endif>
                                                    Есть логотип</option>
                                                <option value="0" @if (isset($filter['image']) && $filter['image'] == '0') selected @endif>
                                                    Нет логотип</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filter d-flex justify-content-between align-items-end">
                                        <div>
                                            <label for="popular">Популярный</label>
                                            <select name="popular" id="popular" class="form-control">
                                                <option value="">--</option>
                                                <option value="1" @if (isset($filter['popular']) && $filter['popular'] == '1') selected @endif>
                                                    Популярные</option>
                                                <option value="0" @if (isset($filter['popular']) && $filter['popular'] == '0') selected @endif>
                                                    Непопулярные</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="status">Статус</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">--</option>
                                                <option value="1" @if (isset($filter['status']) && $filter['status'] == '1') selected @endif>
                                                    Активный</option>
                                                <option value="0" @if (isset($filter['status']) && $filter['status'] == '0') selected @endif>
                                                    Пассивный</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="images">Фотографии</label>
                                            <select name="images" id="images" class="form-control">
                                                <option value="">--</option>
                                                <option value="with" @if (isset($filter['images']) && $filter['images'] == 'with') selected @endif>
                                                    Есть фотографии</option>
                                                <option value="without" @if (isset($filter['images']) && $filter['images'] == 'without') selected @endif>
                                                    Нет фотографии</option>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end gap-1">
                                            <div>
                                                <button type="submit" class="btn btn-outline-primary">
                                                    Фильтр
                                                </button>
                                            </div>
                                            <div>
                                                <a href="{{ route('complex.index') }}"
                                                    class="btn btn-outline-danger">Очистить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Логотип</th>
                                            <th>Название</th>
                                            <th>Тип</th>
                                            <th>Город</th>
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
                                                <td>
                                                    @if ($complex->type == 'residential')
                                                        ЖK
                                                    @endif
                                                    @if ($complex->type == 'hotel')
                                                        ГK
                                                    @endif
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $complex->city->name ?? ' ' }}
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
                                                        <button class="btn btn-outline-light" data-bs-toggle="modal"
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
