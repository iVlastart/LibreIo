@foreach ($posts as $video)
    <x-video-preview 
        src="{{ $video->thumbnail }}"
        title="{{ $video->title }}" 
        views="100" 
        slug="{{ $video->slug }}"
        date="{{ $video->published_at }}"
    />
@endforeach
<div style="display:none;">
    {{ $posts->links() }}
</div>