<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreIo / {{$title}}</title>
    <!-- Scripts -->
    @vite(['resources/css/video-player.css', 'resources/js/video-player.js'])
</head>
<body>
    <x-app-layout>
        <x-video-player :src="$src"/>
        <div class="flex">
            <div class="mt-2 ml-72  text-2xl font-bold text-gray-900">
                {{ $title }}
            </div> 
        </div>
        
    </x-app-layout>
</body>
</html>