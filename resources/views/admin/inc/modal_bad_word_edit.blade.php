<div class="modal fade" id="edit_{{ $badWord->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editBadWordTitle_{{ $badWord->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form action="{{ route('bad-word.update', $badWord->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBadWordTitle_{{ $badWord->id }}">
                        Редактировать плохое слово
                    </h5>
                    <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="word_{{ $badWord->id }}">Слово <span class="text-danger">*</span></label>
                        <input id="word_{{ $badWord->id }}" type="text" name="word"
                            placeholder="Введите плохое слово" class="form-control" value="{{ $badWord->word }}"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Закрыть</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Обновить</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
