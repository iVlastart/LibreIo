<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreIo / {{$username}}</title>
    <!-- Scripts -->
    @vite(['resources/js/follow-handler.js', 'resources/js/date-handler.js'])
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
                {{-- navbar user --}}
                <div class="flex flex-row gap-4">
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<nav class="relative bg-white after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
        @if($username===Auth::user()->name)
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-500 hover:bg-white/5 hover:text-white" -->
            <a href="{{ route('profile.home', ['username' => $username]) }}" aria-current="page" class="rounded-md text-sm px-3 py-2 font-medium {{ $action==="" ? 'bg-gray-950/50  text-white' :  'text-gray-500 hover:bg-white/5 transition-colors hover:text-black'}}">
                Home
            </a>
            <a href="{{ route('profile.home', ['username'=>$username, 'action'=>'private']) }}" class="rounded-md px-3 py-2 text-sm font-medium {{ $action==="private" ? 'bg-gray-950/50  text-white' :  'text-gray-500 hover:bg-white/5 transition-colors hover:text-black'}}">
                Private
            </a>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <el-disclosure id="mobile-menu" hidden class="block sm:hidden">
    <div class="space-y-1 px-2 pt-2 pb-3">
      <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
      <a href="#" aria-current="page" class="block rounded-md bg-gray-950/50 px-3 py-2 text-base font-medium text-white">Dashboard</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Team</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Projects</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
    </div>
  </el-disclosure>
</nav>
                </div>

                <div class="mt-5 grid gap-4 
                        grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($videos as $video)
                        <x-video-preview src="{{ $video->thumbnail }}"
                            title="{{ $video->title }}" views="100" slug="{{ $video->slug }}"
                            date="{{ $video->published_at }}"/>
                    @endforeach
                </div>
            </div>
        </div>
        
    </x-app-layout>
</body>
</html>