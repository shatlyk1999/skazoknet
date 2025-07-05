<div class="modal fade" id="edit_{{ $complex->id }}" tabindex="-1" role="dialog"
    aria-labelledby="edit_{{ $complex->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <form action="{{ route('complex.update', $complex->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_{{ $complex->id }}Title">
                        Редактировать комплекс
                    </h5>
                    <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        @if (isset($complex))
                            <label for="name">Название</label>
                            <div class="form-group">
                                <input id="name" type="text" name="name"
                                    value="{{ old('name', $complex->name) }}" placeholder="Название"
                                    class="form-control">
                            </div>

                            <label for="type">Тип</label>
                            <div class="form-group">
                                <select name="type" class="form-control" id="type">
                                    <option value="residential" {{ $complex->type == 'residential' ? 'selected' : '' }}>
                                        Жилой комплекс
                                    </option>
                                    <option value="hotel" {{ $complex->type == 'hotel' ? 'selected' : '' }}>
                                        Гостиничный комплекс
                                    </option>
                                </select>
                            </div>

                            <label for="city_id">Город</label>
                            <div class="form-group">
                                <select class="form-control" name="city_id" placeholder="Города">
                                    @foreach ($cities as $key => $city)
                                        <option value="{{ $city->id }}"
                                            {{ $city->id == $complex->city_id ? 'selected' : '' }}>
                                            {{ $city->name }} ({{ $city->label }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="developer_id">Застройщик</label>
                            <div class="form-group">
                                <select class="form-control" name="developer_id" placeholder="Застройщик">
                                    @foreach ($developers as $key => $developer)
                                        <option value="{{ $developer->id }}"
                                            {{ $developer->id == $complex->developer_id ? 'selected' : '' }}>
                                            {{ $developer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea name="content" class="form-control summernote_edit" id="summernote_edit">
                                {!! old('name', $complex->content) !!}
                            </textarea>
                            </div>

                            <label for="image">Фото</label>
                            <br>
                            @if ($complex->image != null)
                                <img src="{{ asset('complex/' . $complex->image) }}" alt=""
                                    style="width: 100px;height:100px;border-radius:10px;">
                            @endif
                            <div class="form-group">
                                <input id="image" type="file" name="image" placeholder="Фото"
                                    class="form-control">
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="address" type="text" name="address" placeholder="Адрес"
                                            class="form-control" value="{{ old('name', $complex->address) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="sort" type="integer" name="sort" placeholder="Сортировать"
                                            class="form-control" value="{{ old('name', $complex->sort) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group  d-flex justify-content-end gap-3">
                                        <label class="form-check-label" for="status_update">Статус
                                        </label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input form-check-success" name="status_update"
                                                type="checkbox" id="status"
                                                @if ($complex->status == '1') checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="image">Фотографии (картинки)</label>
                            <br>
                            <div class="d-flex gap-2 mb-1">
                                @foreach ($complex->images as $key => $image)
                                    <div class="d-flex flex-column gap-2 align-items-center">
                                        <img src="{{ asset('complex-images/' . $image->image) }}" alt=""
                                            style="width: 100px;height:100px;border-radius:10px;">
                                        <a href="{{ route('complex-image', $image->id) }}"
                                            class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <input type="file" name="images[]" multiple accept="image/*" class="form-control">
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Закрыть</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Редактировать</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
