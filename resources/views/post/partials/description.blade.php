<div class="container pt-8">
    <p class="text-base pt-2">
        <div class="shrink-0">
            <div class="py-4">
                <div class="max-w-4xl mx-auto sm:px-6:lg-px-8">
                    <div class="overflow-hidden shadow sm sm:rounded-lg p-1 flex flex-col gap-4 items-start">
                        <div class="flex flex-row gap-6 text-base md:text-xl">
                            <div><span class="number">{{$views}}</span> {{$views===1?'view':'views'}}</div>
                            &bull;
                            <div class="date">
                                {{ $date }}
                            </div>
                        </div>
                        <p class="text-base break-words">
                            {{ $description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </p>
</div>