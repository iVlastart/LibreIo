@props(['src'=>null, 'title' => null, 'views'=>0, 'slug'=>null, 'date'=>null])
@vite(['resources/js/vid-click-handler.js'])

<x-card class="transition-transform duration-500 ease-in-out hover:scale-110">
    <div class="preview-container cursor-pointer" data-slug="{{ $slug }}">
        <div class="relative">
            <div class="aspect-video bg-black flex items-center justify-center">
                <img src="{{ asset("/storage/$src") }}" 
                    class="w-full h-full object-contain" 
                    onerror="alert('there was an error loading the img')" />
            </div>
            <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 text-white p-2 rounded-b-lg">
                <h3 class="text-lg font-semibold">{{ $title }}</h3>
                <p class="text-sm">{{ $views }} {{$views===1?'view':'views'}}</p>
                <p class="date text-xs">{{ $date }}</p>
            </div>
        </div>
    </div>
</x-card>