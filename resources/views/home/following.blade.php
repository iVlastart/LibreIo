<x-app-layout>
    <x-slot name="header">
        @include('home.partials.header', ['title' => 'LibreIo'])    
    </x-slot>

    @include('partials.posts-grid', ['posts'=>$posts])
</x-app-layout>