<div class="modal fade" id="info_{{ $developer->id }}" tabindex="-1" role="dialog"
    aria-labelledby="info_{{ $developer->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="info_{{ $developer->id }}Title">
                    Информация о застройщике
                </h5>
                <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    @if (isset($developer))
                        <div>
                            <div>
                                <b>Пользователь</b>
                                <p>{{ $developer->user->name ?? '' }}</p>
                            </div>
                            <div>
                                <b>Название</b>
                                <p>{{ $developer->name }}</p>
                            </div>
                            <div>
                                <b>Города</b>
                                <br>
                                @if ($developer->cities()->count() > 0)
                                    @foreach ($developer->cities as $city)
                                        {{ $city->name }} ({{ $city->label }}),
                                    @endforeach
                                @endif
                            </div>
                            <br>
                            <div>
                                <b>Год основания</b>
                                <p>{{ $developer->year_establishment }}</p>
                            </div>
                            <div>
                                <b>Логотип</b>
                                <br>
                                <img src="{{ asset('developer/' . $developer->image) }}" alt="">
                            </div>
                            <div>
                                <b>Контент</b>
                                <p>{!! $developer->content !!}</p>
                            </div>
                            <div>
                                <b>Сортировать</b>
                                <p>{{ $developer->sort }}</p>
                            </div>
                            <div class="d-flex gap-2">
                                <b>Популярный</b>
                                <div class="form-check form-switch cursor-pointer">
                                    <input class="form-check-input form-check-success cursor-pointer"
                                        style="cursor: pointer" type="checkbox"
                                        @if ($developer->popular == '1') checked @endif disabled>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex gap-2">
                                <b>Статус</b>
                                <div class="form-check form-switch cursor-pointer">
                                    <input class="form-check-input form-check-success cursor-pointer"
                                        style="cursor: pointer" type="checkbox"
                                        @if ($developer->status == '1') checked @endif disabled>
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
                </div>
            </div>
        </div>
    </div>
</div>
