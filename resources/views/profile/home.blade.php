<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreIo / {{$username}}</title>
    <!-- Scripts -->
    @vite(['resources/js/date-handler.js'])
</head>
<body>
    <x-app-layout>
        <div class="p-16"><div class="p-8 bg-white shadow mt-24">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                    <div>
                        <p class="font-bold text-gray-700 text-xl">{{$videosCount}}</p>        
                        <p class="text-gray-400 text-sm lg:text-xl">Videos</p>
                    </div>
                    <div>           
                        <p class="font-bold text-gray-700 text-xl">{{$followersCount}}</p>
                        <p class="text-gray-400 text-sm lg:text-xl">Followers</p>
                    </div>
                    <div>          
                        <p class="font-bold text-gray-700 text-xl">{{$followingCount}}</p>
                        <p class="text-gray-400 text-sm lg:text-xl">Following</p>
                    </div>
                </div>
                    <div class="relative">
                        @include('profile.partials.pfp', ['class'=>'inset-x-0 top-0 -mt-24', 'pfp'=>$pfp, 'username'=>$username])    
                    </div>    
                    <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                        @if(Auth::user()->name===$username)
                            <a href="{{ route('profile.edit') }}" class="text-black py-4 px-4 uppercase rounded bg-white border border-black hover:bg-slate-100
                                    shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5 cursor-pointer">Edit</a>                            
                        @else
                            @include('profile.partials.follow', ['isFollowed'=>$isFollowed])
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

                {{-- navbar user --}}
                <div class="flex flex-row gap-4">
                  <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
                    <nav class="relative bg-white after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
                        <div class="mx-auto max-w-7xl md:px-6">
                            <div class="relative flex h-16 items-center justify-between">
                                @if($username===Auth::user()->name)
                                    @include('profile.partials.postmenu', ['username'=>$username])
                                @endif
                            </div>
                        </div>
                        </div>
                    </nav>
                </div>
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <div id="posts-list" class="mt-5 grid gap-4 
                                            grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                        @include('partials.posts', ['posts'=>$posts])
                                    </div>
                                    <div class="flex w-full justify-center mt-5">
                                        {{ $posts->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </x-app-layout>
</body>
</html>