@props(['fileType'=>'mp4', 'filename'=>'My Video'])

<x-card class="flex flex-row gap-1 items-center hover:cursor-pointer hover:scale-105 transition-transform duration-300">
    <div>
        @include('editor.partials.svg.'.$fileType)
    </div>
    <span>
        {{ $filename.'.'.$fileType }}
    </span>
</x-card>