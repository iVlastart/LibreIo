<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreIo / {{$title}}</title>
    <!-- Scripts -->
    @vite(['resources/css/video-player.css', 'resources/js/video-player.js', 'resources/js/like-handler.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <x-app-layout>
        <x-video-player :src="$src"/>
        <div class="flex items-start ml-72 gap-x-20 mt-2 flex-col">
            <div class="text-2xl font-bold text-gray-900 max-w-[60%]">
                {{ $title }}
            </div>
            <x-like-form :id="$id" :isLiked="$isLiked"
                    :likeCount="$likeCount" :isDisliked="$isDisliked"
                    :dislikeCount="$dislikeCount"/>
        </div>
    </x-app-layout>
</body>
</html>