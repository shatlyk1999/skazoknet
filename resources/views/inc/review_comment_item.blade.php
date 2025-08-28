<div
    class="rounded-2xl border-2 border-custom-gray hover:border-primary hover:shadow-md transition-all duration-500 ease-in-out p-4">
    <div class="flex items-center justify-between sm:flex-row flex-col gap-4">
        <div class="flex items-center gap-x-4">
            <div class="flex justify-center items-center gap-2">
                <img src="{{ $comment->user->avatar ? asset('avatar/' . $comment->user->avatar) : asset('images/user2.png') }}"
                    class="size-7" alt="" style="border-radius: 25px;object-fit:cover" />
                {{ $comment->user->name }}
            </div>
        </div>
        <div class="flex items-center gap-x-4 text-sm tracking-wide">
            <span class="text-text">{{ $comment->created_at->format('Y/m/d') }}</span>
            <div class="flex items-center gap-x-1">
                <img src="{{ asset('images/like.png') }}" alt="" class="size-5" />
                <span>{{ $comment->likes }}</span>
            </div>
            <div class="flex items-center gap-x-1">
                <img src="{{ asset('images/dislike.png') }}" alt="" class="h-5 w-6" />
                <span>{{ $comment->dislikes }}</span>
            </div>
        </div>
    </div>
    <hr class="mt-6 sm:hidden flex border-custom-gray" />
    <p class="text-sm font-normal mt-6 text-text2 h-[2.5rem] overflow-hidden transition-all duration-300 ease-in-out"
        id="collapse-content-{{ $comment->id }}">
        {{ $comment->text }}
    </p>

    <hr class="mt-6 sm:hidden flex border-custom-gray" />

    <button class="mt-4 float-right tracking-wide text-xs flex items-center gap-x-2 cursor-pointer"
        id="collapse-button-{{ $comment->id }}"
        onclick="toggleCollapse('#collapse-content-{{ $comment->id }}', '#collapse-button-{{ $comment->id }}')">
        <span>Развернуть</span>
        <img src="{{ asset('icons/down.svg') }}" alt="" />
    </button>
</div>
