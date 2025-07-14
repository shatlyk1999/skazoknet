<div class="modal fade" id="createDeveloper" tabindex="-1" role="dialog" aria-labelledby="createDeveloperTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <form action="{{ route('developer.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDeveloperTitle">
                        Создать застройщика
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

                        {{-- <label for="cityName">Город</label> --}}
                        <div class="form-group">
                            <select id="select-links" name="city_ids[]" multiple placeholder="Города">Город</select>
                        </div>

                        <div class="form-group">
                            <textarea name="content" class="form-control" id="summernote"></textarea>
                        </div>

                        <label for="image">Логотип</label>
                        <div class="form-group">
                            <input id="image" type="file" name="image" placeholder="Логотип"
                                class="form-control">
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="year_establishment" type="integer" name="year_establishment"
                                        placeholder="Год основания" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="sort" type="integer" name="sort" placeholder="Сортировать"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group d-flex justify-content-end gap-3">
                                    <span>Популярный</span>
                                    <div class="form-check form-switch cursor-pointer">
                                        <input class="form-check-input form-check-success" name="popular"
                                            type="checkbox">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group d-flex justify-content-end gap-3">
                                    <span>Статус</span>
                                    <div class="form-check form-switch cursor-pointer">
                                        <input class="form-check-input form-check-success" name="status_create"
                                            type="checkbox">
                                    </div>
                                </div>
                            </div>
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
