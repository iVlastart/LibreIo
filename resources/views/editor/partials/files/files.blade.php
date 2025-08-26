@props(['files'=>[]])

<div class="mx-auto flex flex-col gap-y-4">
    @foreach ($files as $file)
        @include('editor.partials.files.file', ['fileType'=>$file['type'], 'filename'=>$file['name']])
    @endforeach
</div>