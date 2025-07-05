<div class="modal fade" id="createComplex" tabindex="-1" role="dialog" aria-labelledby="createComplexTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <form action="{{ route('complex.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createComplexTitle">
                        Создать комплекс
                    </h5>
                    <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        {{-- <label for="name">Название</label> --}}
                        <div class="form-group">
                            <input id="name" type="text" name="name" placeholder="Название"
                                class="form-control">
                        </div>

                        <label for="type">Тип</label>
                        <div class="form-group">
                            <select name="type" class="form-control" id="type">
                                <option value="residential">Жилые комплекс</option>
                                <option value="hotel">Гостиничные комплекс</option>
                            </select>
                        </div>

                        @if ($cities->count() > 0)
                            <label for="city_id">Город</label>
                            <div class="form-group">
                                <select class="form-control" name="city_id" placeholder="Города">
                                    @foreach ($cities as $key => $city)
                                        <option value="{{ $city->id }}">{{ $city->name }} ({{ $city->label }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            Город не найден
                        @endif

                        @if ($developers->count() > 0)
                            <label for="developer_id">Застройщик</label>
                            <div class="form-group">
                                <select class="form-control" name="developer_id" placeholder="Застройщик">
                                    @foreach ($developers as $key => $developer)
                                        <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            Застройщик не найден
                        @endif

                        <div class="form-group">
                            <textarea name="content" class="form-control" id="summernote"></textarea>
                        </div>

                        <label for="image">Фото</label>
                        <div class="form-group">
                            <input id="image" type="file" name="image" placeholder="Фото" class="form-control">
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="address" type="text" name="address" placeholder="Адрес"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="sort" type="integer" name="sort" placeholder="Сортировать"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group d-flex justify-content-end gap-3">
                                    <span>Статус</span>
                                    <div class="form-check form-switch cursor-pointer">
                                        <input class="form-check-input form-check-success" name="status_create"
                                            type="checkbox">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <label for="image">Фотографии (картинки)</label>
                        <div class="form-group">
                            <input type="file" name="images[]" multiple accept="image/*" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Закрыть</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Сохранить</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
