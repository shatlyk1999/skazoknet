<div class="modal fade" id="comment_{{ $c->id }}" tabindex="-1" role="dialog"
    aria-labelledby="comment_{{ $c->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comment_{{ $c->id }}Title">
                    Комментарий
                </h5>
                <button type="button" class="close text-amber-50" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($c))
                    <div>
                        <div>
                            <b>ID</b>
                            <p>{{ $c->id }}</p>
                        </div>
                        <div>
                            <b>Review</b>
                            <p>#{{ $c->review_id }}</p>
                        </div>
                        <div>
                            <b>User</b>
                            <p>{{ $c->user?->name ?? '—' }}</p>
                        </div>
                        <div>
                            <b>Аватар</b><br>
                            @php($avatar = $c->user?->avatar ? asset('avatar/' . $c->user->avatar) : asset('images/user2.png'))
                            <img src="{{ $avatar }}" alt=""
                                style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        </div>
                        <div>
                            <b>Создан</b>
                            <p>{{ $c->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div>
                            <b>Текст</b>
                            <p style="white-space: pre-wrap;">{{ $c->text }}</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div>
                                <b>Лайки</b>
                                <p>{{ $c->likes ?? 0 }}</p>
                            </div>
                            <div>
                                <b>Дизлайки</b>
                                <p>{{ $c->dislikes ?? 0 }}</p>
                            </div>
                        </div>
                        {{-- <div class="d-flex gap-2">
                            <b>Статус</b>
                            <div class="form-check form-switch cursor-pointer">
                                <input class="form-check-input form-check-success cursor-pointer" type="checkbox"
                                    @if (!empty($c->is_approved)) checked @endif disabled>
                            </div>
                        </div> --}}
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <span class="d-none d-sm-block">Закрыть</span>
                </button>
            </div>
        </div>
    </div>
</div>
