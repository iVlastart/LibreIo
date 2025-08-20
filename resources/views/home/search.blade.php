@vite(['resources/js/date-handler.js', 'resources/js/infiniteScroll.js', 'resources/css/loader.css'])

<x-app-layout>
    <x-slot name="header">
        @include('home.partials.header', ['title' => 'Search Results for "' . $query . '"'])
    </x-slot>

    @if($posts->isNotEmpty())
        @include('partials.posts-grid', ['posts' => $posts])
    @else
        @include('home.partials.no-posts', ['msg' => 'Try searching for something else.'])
    @endif
</x-app-layout>