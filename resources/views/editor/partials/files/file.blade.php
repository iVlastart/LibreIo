@props(['projectID'=>0, 'fileType'=>'video', 'filename'=>'My Video.mp4'])

<x-card data-projectid="{{ $projectID }}" data-filetype="{{ $fileType }}" data-filename="{{ $filename }}" class="file flex flex-row flex-shrink-0 gap-1 items-center hover:cursor-pointer hover:scale-105 transition-transform duration-300">
    <div>
        @include('editor.partials.svg.' . $fileType)
    </div>
    <span>
        {{ $filename }}
    </span>
</x-card>