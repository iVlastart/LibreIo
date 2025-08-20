@vite('resources/js/pfp-handler.js')

<div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl 
    absolute flex items-center justify-center text-indigo-500 {{ $class }}
        {{ $username===Auth::user()->name ? 'hover:opacity-75 hover:cursor-pointer transition-opacity duration-200 group' : '' }}"
         @if($username===Auth::user()->name) onclick="document.getElementById('pfp-input').click()" @endif>
    
    @if($username===Auth::user()->name)
        <div class="hidden hover:flex group-hover:flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="text-black z-50" viewBox="0 0 16 16">
                <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
            </svg>
        </div>
        <form method="post" class="pfp-form">
            @csrf
            <input type="file" name="pfp" id="pfp-input" class="hidden">
        </form>
    @endif
    @if($pfp===null)
        @include('profile.partials.default-pfp')
    @else
        <img src="{{ asset("/storage/$pfp") }}" alt="Profile Picture" class="w-full h-full rounded-full object-cover">
    @endif
</div>