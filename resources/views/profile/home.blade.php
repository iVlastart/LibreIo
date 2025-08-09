<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreIo / {{$username}}</title>
    <!-- Scripts -->
    @vite(['resources/js/follow-handler.js'])
</head>
<body>
    <x-app-layout>
        <div class="p-16"><div class="p-8 bg-white shadow mt-24">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                    <div>
                        <p class="font-bold text-gray-700 text-xl">{{$videosCount}}</p>        
                        <p class="text-gray-400">Videos</p>
                    </div>
                    <div>           
                        <p class="font-bold text-gray-700 text-xl">{{$followersCount}}</p>
                        <p class="text-gray-400">Followers</p>
                    </div>
                    <div>           
                        <p class="font-bold text-gray-700 text-xl">{{$followingCount}}</p>
                        <p class="text-gray-400">Following</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl 
                            absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20" fill="currentColor">  
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>    
                        </div>    
                    </div>    
                    <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                        @if(Auth::user()->name===$username)
                            <a href="{{ route('profile.edit') }}" class="text-black py-4 px-4 uppercase rounded bg-white border border-black hover:bg-slate-100
                                    shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5 cursor-pointer">Edit</a>                            
                        @else
                            <form action="{{ route('profile.follow') }}" method="post" class="follow-form">
                                @csrf
                                <input type="hidden" name="name" value="{{ $username }}">
                                <button type="submit" class="{{ $isFollowed ? "text-black" : "text-white" }} py-2 px-4 uppercase rounded 
                                        {{ $isFollowed ? "bg-white border border-black" : "bg-blue-400" }} hover:{{ $isFollowed ? "bg-slate-100" : "bg-blue-500" }} shadow 
                                        hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                                    {{ $isFollowed ? 'Following' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                            
                        {{-- donate btn (future updates) --}}
                        {{--<button  class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg 
                                font-medium transition transform hover:-translate-y-0.5">Donate</button>--}}
                    </div>  
                </div>  

                <div class="mt-20 text-center border-b pb-12">    
                    <h1 class="text-4xl font-medium text-gray-700">{{$username}}</h1>
                    {{-- Here will be the country the user will set as their homeland (future updates) --}}
                    {{--<p class="font-light text-gray-600 mt-3">Bucharest, Romania</p>--}}    
                </div>  
                <div class="mt-12 flex flex-col justify-center">    
                    <p class="text-gray-600 text-center font-light lg:px-16">
                        {{ $bio }}
                    </p>    
                  
                </div>
                <div class="mt-5 flex">
                    @foreach ($videos as $video)
                        <x-video-preview src="{{ $video->thumbnail }}"
                            title="{{ $video->title }}" views="100" slug="{{ $video->slug }}"/>
                    @endforeach
                </div>
            </div>
        </div>
        
    </x-app-layout>
</body>
</html>