@vite(['resources/js/date-handler.js', 'resources/js/infiniteScroll.js', 'resources/css/loader.css'])
<x-app-layout>
    <x-slot name="header">
        @include('home.partials.header', ['title' => 'LibreIo'])
    </x-slot>
    @include('partials.posts-grid', ['posts' => $posts])
</x-app-layout>