<div class="modal fade" id="edit_{{ $developer->id }}" tabindex="-1" role="dialog"
    aria-labelledby="edit_{{ $developer->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <form action="{{ route('developer.update', $developer->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_{{ $developer->id }}Title">
                        Создать застройщика
                    </h5>
                    <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        @if (isset($developer))
                            <label for="name">Название</label>
                            <div class="form-group">
                                <input id="name" type="text" name="name"
                                    value="{{ old('name', $developer->name) }}" placeholder="Название"
                                    class="form-control">
                            </div>

                            <label for="city_ids[]">Город</label>
                            <div class="form-group">
                                <select class="select-links" id="select-links-{{ $developer->id }}" name="city_ids[]"
                                    multiple placeholder="Города">Город</select>
                            </div>

                            <div class="form-group">
                                <textarea name="content" class="form-control summernote_edit" id="summernote_edit">
                                {!! old('name', $developer->content) !!}
                            </textarea>
                            </div>

                            <label for="image">Фото</label>
                            <br>
                            <img src="{{ asset('developer/' . $developer->image) }}" alt=""
                                style="width: 100px;height:100px;border-radius:10px;">
                            <div class="form-group">
                                <input id="image" type="file" name="image" placeholder="Фото"
                                    class="form-control">
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="year_establishment" type="integer" name="year_establishment"
                                            placeholder="Год основания" class="form-control"
                                            value="{{ old('name', $developer->year_establishment) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="sort" type="integer" name="sort" placeholder="Сортировать"
                                            class="form-control" value="{{ old('name', $developer->sort) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input form-check-success" name="status_update"
                                                type="checkbox" id="status"
                                                @if ($developer->status == '1') checked @endif>
                                            <label class="form-check-label" for="status">Статус
                                            </label>
                                        </div>
                                    </div>
                                </div>
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

<script>
    // const selectedCity_{{ $developer->id }} = @json($developer->cities->pluck('id')->toArray());
    // console.log(selectedCity_{{ $developer->id }});
</script>
