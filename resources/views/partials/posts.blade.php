@foreach ($posts as $video)
    <x-video-preview 
        src="{{ $video->thumbnail }}"
        title="{{ $video->title }}" 
        views="{{ DB::table('Views')->where('post_id', $video->id)->count() }}" 
        slug="{{ $video->slug }}"
        date="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d H:i:s') }}"
    />
@endforeach