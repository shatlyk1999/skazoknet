<div class="modal fade" id="info_{{ $contact->id }}" tabindex="-1" role="dialog"
    aria-labelledby="info_{{ $contact->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="info_{{ $contact->id }}Title">
                    Информация о контакте
                </h5>
                <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    @if (isset($contact))
                        <div>
                            <div>
                                <b>Пользователь</b>
                                <p>{{ $contact->user->name ?? '' }}</p>
                            </div>
                            <div>
                                <b>Электронная почта</b>
                                <p>{{ $contact->email }}</p>
                            </div>
                            <div>
                                <b>Телефонный номер</b>
                                <p>{{ $contact->tel_number }}</p>
                            </div>
                            <div>
                                <b>Заметка</b>
                                <p>{{ $contact->note }}</p>
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
