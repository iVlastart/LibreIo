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
                        <div class="  overflow-hidden shadow sm sm:rounded-lg p-1 flex gap-4 items-center">
                            {{-- like --}}
                            <form method="POST" action="/like" class="like-form">
                                @csrf
                                <input type="hidden" name="status" value="like">
                                <input type="hidden" name="post_id" value="{{ $id }}">
                                <button id="btnLike" class="span border bg-transparent hover:cursor-pointer liked">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6 text-blue-500">
                                            <path stroke-linecap="round" fill="{{$isLiked ? "currentColor": "white"}}" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    </span>
                                </button>
                            </form>
                            {{-- divider --}}
                            <div class="w-px h-6 bg-black"></div>
                            {{-- dislike --}}
                            {{-- problems with svgs, will implement later --}}
                            {{/*<form method="POST" action="/like" class="dislike-form ">
                                @csrf
                                <input type="hidden" name="status" value="dislike">
                                <input type="hidden" name="post_id" value="{{ $id }}">
                                <button id="btnDislike" class="bg-transparent hover:cursor-pointer">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6 text-blue-500">
                                            <path fill="{{$isDisliked ? "currentColor": "white"}}" d="M8.867 14.41c13.308-9.322 4.79-16.563.064-13.824L7 3l1.5 4-2 3L8 15a38 38 0 0 0 .867-.59m-.303-1.01-.971-3.237 1.74-2.608a1 1 0 0 0 .103-.906l-1.3-3.468 1.45-1.813c1.861-.948 4.446.002 5.197 2.11.691 1.94-.055 5.521-6.219 9.922m-1.25 1.137a36 36 0 0 1-1.522-1.116C-5.077 4.97 1.842-1.472 6.454.293c.314.12.618.279.904.477L5.5 3 7 7l-1.5 3zm-2.3-3.06-.442-1.106a1 1 0 0 1 .034-.818l1.305-2.61L4.564 3.35a1 1 0 0 1 .168-.991l1.032-1.24c-1.688-.449-3.7.398-4.456 2.128-.711 1.627-.413 4.55 3.706 8.229Z" />
                                        </svg>
                                    </span>
                                </button>
                            </form>*/}}đ
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>