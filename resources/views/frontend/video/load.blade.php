<div class="row">
    <div class="col-md-12">
        @foreach ($videos as $item)
        <div class="video-container item active">
            <iframe width="100%" height="315" src="{{ $item->video_url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
        @endforeach
    </div>
</div>