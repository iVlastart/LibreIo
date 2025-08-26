@props(['files'=>[]])

<div class="h-screen mx-auto flex flex-col gap-y-8 overflow-y-auto">
    @foreach ($files as $file)
        @include('editor.partials.files.file', ['fileType'=>$file['type'], 'filename'=>$file['name']])
    @endforeach
</div>