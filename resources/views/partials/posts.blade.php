@foreach ($posts as $video)
    <x-video-preview 
        src="{{ $video->thumbnail }}"
        title="{{ $video->title }}" 
        views="{{ 100 }}" 
        slug="{{ $video->slug }}"
        date="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d H:i:s') }}"
    />
@endforeach