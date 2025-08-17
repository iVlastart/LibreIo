@foreach ($posts as $video)
    <x-video-preview 
        src="{{ $video->thumbnail }}"
        title="{{ $video->title }}" 
        views="{{ $video->views }}" 
        slug="{{ $video->slug }}"
        date="{{ $video->published_at }}"
    />
@endforeach
{{ $posts->links() }}