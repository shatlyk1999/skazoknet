<div class="modal fade" id="info_{{ $complex->id }}" tabindex="-1" role="dialog"
    aria-labelledby="info_{{ $complex->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="info_{{ $complex->id }}Title">
                    Информация о комплексе
                </h5>
                <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    @if (isset($complex))
                        <div>
                            <div>
                                <b>Название</b>
                                <p>{{ $complex->name }}</p>
                            </div>
                            <div>
                                <b>Тип</b>
                                <p>
                                    {{ $complex->type == 'residential' ? 'Жилой комплекс' : '' }}
                                    {{ $complex->type == 'hotel' ? 'Гостиничный комплекс' : '' }}
                                </p>
                            </div>
                            <div>
                                <b>Города</b>
                                <p>{{ $complex->city->name }} ({{ $complex->city->label }})</p>
                            </div>
                            <div>
                                <b>Застройщик</b>
                                <p>{{ $complex->developer->name ?? '' }}</p>
                            </div>
                            <div>
                                <b>Адрес</b>
                                <p>{{ $complex->address }}</p>
                            </div>
                            <div>
                                <b>Логотип</b>
                                <br>
                                @if ($complex->image != null)
                                    <img src="{{ asset('complex/' . $complex->image) }}" alt="">
                                @endif
                            </div>
                            <div>
                                <b>Контент</b>
                                <p>{!! $complex->content !!}</p>
                            </div>
                            <div>
                                <b>Сортировать</b>
                                <p>{{ $complex->sort }}</p>
                            </div>
                            <div class="d-flex gap-2">
                                <b>Популярный</b>
                                <div class="form-check form-switch cursor-pointer">
                                    <input class="form-check-input form-check-success cursor-pointer"
                                        style="cursor: pointer" type="checkbox"
                                        @if ($complex->popular == '1') checked @endif disabled>
                                </div>
                            </div>
                            <br>
                            <div>
                                <b>Координата X</b>
                                <p>{{ $complex->map_x }}</p>
                            </div>
                            <div>
                                <b>Координата Y</b>
                                <p>{{ $complex->map_y }}</p>
                            </div>
                            <br>
                            <div class="d-flex gap-2">
                                <b>Статус</b>
                                <div class="form-check form-switch cursor-pointer">
                                    <input class="form-check-input form-check-success cursor-pointer"
                                        style="cursor: pointer" type="checkbox"
                                        @if ($complex->status == '1') checked @endif disabled>
                                </div>
                            </div>
                            <div>
                                <br>
                                <b>Фотографии (картинки)</b>
                                <br>
                                @foreach ($complex->images as $key => $image)
                                    <img src="{{ asset('complex-images/' . $image->image) }}" alt=""
                                        style="width: 100px;height:100px;border-radius:10px;">
                                @endforeach
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
