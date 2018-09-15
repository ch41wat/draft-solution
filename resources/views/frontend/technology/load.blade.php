<div class="row" id="load" style="position: relative;">
    @foreach ($technology as $item)
    <div class="col-md-12" style="background-image: url({{ asset('storage/uploads/' . $item->picture->path . '/picture/' . $item->picture->name) }}); background-size: 100% 100%; background-repeat: no-repeat; min-height: 390px; width: 100%; margin-bottom: 10px;">
        <label for="technology-id-" class="control-label">Technology: {{ $item->technology->name }}</label>  
        <img src="{{ asset('storage/uploads/' . $item->picture->path . '/picture/' . $item->picture->name) }}" style="width: 100%; min-height: 390px;">
    </div>
    @endforeach
</div>
{{ $equipment_assignment->links() }}