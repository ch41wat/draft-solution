<div class="row">
    <div class="col-md-12">
        @foreach ($videos as $item)
            @if ($item->video_type == 'url')
                <div class="video-container item active">
                    <iframe width="100%" height="315" src="{{ $item->video_url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            @else
                <video width="100%" height="315" controls>
                    <source src="{{ asset('storage/uploads/video/file/' . $item->video_file) }}" type="video/mp4">
                    <source src="{{ asset('storage/uploads/video/file/' . $item->video_file) }}" type="video/ogg">
                </video>
            @endif
        @endforeach
    </div>
</div>