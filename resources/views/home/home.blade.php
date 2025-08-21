@vite('resources/js/infiniteScroll.js')
<x-app-layout>
    <x-slot name="header">
        @include('home.partials.header', ['title' => 'Home'])
    </x-slot>
    @if($posts->isNotEmpty())
        @include('partials.posts-grid', ['posts' => $posts])
    @else
        @include('home.partials.no-posts', ['msg' => 'No posts available.'])
    @endif
</x-app-layout>