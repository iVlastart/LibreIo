@vite()
<button type="submit" class="{{ $isFollowed ? "text-black" : "text-white" }} py-2 px-4 uppercase rounded 
        {{ $isFollowed ? "bg-white border border-black" : "bg-blue-400" }} hover:{{ $isFollowed ? "bg-slate-100" : "bg-blue-500" }} shadow 
        hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
    {{ $isFollowed ? 'Following' : 'Follow' }}
</button>