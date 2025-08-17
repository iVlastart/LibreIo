<div class="hidden sm:ml-6 sm:block">
  <div class="flex space-x-4">
    <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-500 hover:bg-white/5 hover:text-white" -->
    <a href="{{ route('profile.home', ['username' => $username]) }}" aria-current="page" class="rounded-md text-sm px-3 py-2 font-medium {{ $action==="" ? 'bg-gray-950/50  text-white' :  'text-gray-500 hover:bg-white/5 transition-colors hover:text-black'}}">
        Home
    </a>
    <a href="{{ route('profile.home', ['username'=>$username, 'action'=>'private']) }}" class="rounded-md px-3 py-2 text-sm font-medium {{ $action==="private" ? 'bg-gray-950/50  text-white' :  'text-gray-500 hover:bg-white/5 transition-colors hover:text-black'}}">
        Private
    </a>
    <a href="{{ route('profile.home', ['username'=>$username, 'action'=>'saved']) }}" class="rounded-md px-3 py-2 text-sm font-medium {{ $action==="saved" ? 'bg-gray-950/50  text-white' :  'text-gray-500 hover:bg-white/5 transition-colors hover:text-black'}}">
        Saved
    </a>
  </div>
</div>