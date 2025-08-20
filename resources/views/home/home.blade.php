@vite('resources/js/infiniteScroll.js')
<x-app-layout>
    <x-slot name="header">
        @include('home.partials.header', ['title' => 'Home'])
    </x-slot>
    @include('partials.posts-grid', ['posts' => $posts])
</x-app-layout>