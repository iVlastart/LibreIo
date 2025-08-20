<x-app-layout>
    <x-slot name="header">
        @include('home.partials.header', ['title' => 'LibreIo'])    
    </x-slot>
    @if($posts->isNotEmpty())
        @include('partials.posts-grid', ['posts'=>$posts])
    @else
        @include('home.partials.no-posts', ['msg' => 'When you follow someone, their posts will appear here.'])
    @endif
</x-app-layout>