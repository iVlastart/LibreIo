<div class="mx-auto flex flex-col gap-y-4">
    @include('editor.partials.files.file', ['fileType'=>'image', 'filename'=>'Something.jpeg'])
    @include('editor.partials.files.file')
    @include('editor.partials.files.file')
</div>