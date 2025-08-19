<x-card>
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
</x-card>