@vite(['resources/js/date-handler.js', 'resources/js/infiniteScroll.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            LibreIo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     <div id="posts-container" class="mt-5 grid gap-4 
                            grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($posts as $post)
                            
                        @endforeach
                    </div>
                </div>
                <div id="loading" style="display: none; text-align: center; margin: 20px;">
                    Loading...
                </div>
            </div>
        </div>
    </div>
</x-app-layout>