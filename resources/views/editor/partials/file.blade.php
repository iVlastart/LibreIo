@props(['fileType'=>'.mp4', 'filename'=>'My File'])

<x-card class="flex flex-row mx-auto gap-2 items-center">
    <div>
        @include('editor.partials.svg.'.$fileType)
    </div>
    <span>
        {{ $filename }}
    </span>
</x-card>