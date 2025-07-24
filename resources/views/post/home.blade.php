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
            <div class="ml-96 mt-2 shrink-0">
                <div class="py-4">
                    <div class="max-w-4xl mx-auto sm:px-6:lg-px-8">
                        <div class="  overflow-hidden shadow sm sm:rounded-lg p-1 flex gap-4 items-start">
                            {{-- like --}}
                            <form method="post" action="/like" class="like-form">
                                @csrf
                                <input type="hidden" name="status" value="like">
                                <input type="hidden" name="post_id" value="{{ $id }}">
                                <button id="btnLike" class="span border bg-transparent border-transparent hover:cursor-pointer">
                                    <span class="flex flex-row gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6 text-blue-500">
                                            <path stroke-linecap="round" fill="{{$isLiked ? "currentColor": "white"}}" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                        <span>{{$likeCount}}</span>
                                    </span>
                                </button>
                            </form>
                            {{-- divider --}}
                            <div class="w-px h-8 bg-black"></div>
                            <form action="/like" method="post" class="dislike-form">
                                @csrf
                                <input type="hidden" name="status" value="dislike">
                                <input type="hidden" name="post_id" value="{{ $id }}">
                                <button id="btnDislike" class="span border bg-transparent border-transparent hover:cursor-pointer">
                                    <span class="flex flex-row gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="{{ $isDisliked ? 'currentColor' : 'white' }}" stroke="currentColor"
                                                class="size-6 text-blue-500">
                                            <path d="M12.1 21.35l-1.1-1.05C5.14 15.24 2 12.36 2 8.5 2 6.02 4.02 4 6.5 4c1.74 0 3.41 1.01 4.13 2.44L12 9.5l1.37-3.06C13.09 5.01 14.76 4 16.5 4 18.98 4 21 6.02 21 8.5c0 3.86-3.14 6.74-8.9 11.8l-1.1 1.05zM12 9.5l-1.5 2 1.5 2-1.5 2 1.5 2"/>
                                        </svg>
                                        <span>{{$dislikeCount}}</span>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>