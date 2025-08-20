@vite(['resources/js/date-handler.js', 'resources/js/infiniteScroll.js', 'resources/css/loader.css'])
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center">
            <h2 id="Title" class="font-semibold text-xl text-gray-800 leading-tight hover:cursor-pointer w-fit">
                LibreIo
            </h2>
            @include('home.partials.searchbar')
        </div>
    </x-slot>

    @include('partials.posts-grid', ['posts' => $posts])
</x-app-layout>