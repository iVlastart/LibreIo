<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreIo / {{$title}}</title>
    <!-- Scripts -->
    @vite(['resources/css/video-player.css', 'resources/js/video-player.js', 'resources/js/like-handler.js', 'resources/js/date-handler.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <x-app-layout>
        {{-- video --}}
        <section>
            @include('post.partials.video-player', ['src'=>$src])
        </section>

        {{-- title --}}
        <section class="container text-left pl-10 md:pl-72 texl-1xl md:text-2xl font-bold">{{$title}}</section>
        
        {{-- items --}}
        <section class="flex flex-wrap flex-row justify-start md:justify-center ml-14 md:ml-0 items-start md:items-center gap-8">
            @include('post.partials.like-form', ['id'=>$id,
                    'isLiked'=>$isLiked, 'isDisliked'=>$isDisliked,
                    'likeCount'=>$likeCount, 'dislikeCount'=>$dislikeCount])
            @include('post.partials.save-form')
            @include('post.partials.download-form')
        </section>

        {{-- uploader --}}
        <section class="flex flex-row items-center pl-1 md:pl-72 mt-10">
            <div class="relative w-36 h-36 md:w-48 md:h-48 scale-[0.35] md:scale-[0.5] flex-shrink-0">
                @include('profile.partials.pfp', ['profile'=>false]) 
            </div>
            <div class="flex flex-col">
                <p class="ml-0 md:ml-4 text-2xl md:text-3xl">
                    {{ $username }}
                </p>
                <p class="text-gray-500 text-sm md:text-base">{{ $followers }} {{ $followers===1 ? 'follower' : 'followers' }}</p>
            </div>

        </section>
    </x-app-layout>
</body>
</html>