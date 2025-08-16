<div class="shrink-0">
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6:lg-px-8">
            <div class="overflow-hidden shadow sm sm:rounded-lg p-1 flex gap-4 items-start">
                <form action="/save" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="post_id" value="{{ $id }}">
                    <button class="hover:cursor-pointer flex flex-row gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="black" class="size-6">
                            <path stroke-linecap="round" fill="white" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        <span>Save</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>