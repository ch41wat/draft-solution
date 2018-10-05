<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $technology->name or ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="addel-picture">
    {{-- {{ dd($picture) }} --}}
    <div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
        <label for="picture" class="control-label">{{ 'Picture' }}</label>
        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-media">
            <i class="fa fa-plus"></i>
        </button>
        <input class="form-control" name="picture" type="hidden" id="picture" value="{{ $technology->picture or ''}}" >
        <div id="img-thumbnail" style="min-height: 400px; margin: 5px auto; background-color: #ddd; padding: 0px; border: 1px solid #202020;"></div>
        {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
    </div>

    {{-- <div class="form-group {{ $errors->has('equipment') ? 'has-error' : ''}}" id="form-group-equipment">
        <label for="equipment" class="control-label">{{ 'Equipment' }}</label>
        <select name="equipment[]" id="equipment" class="form-control">
            @foreach ($equipment as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('equipment', '<p class="help-block">:message</p>') !!}
    </div> --}}
</div>

<div class="addel-video">
    <div class="form-group {{ $errors->has('video') ? 'has-error' : ''}}">
        <label for="video" class="control-label">{{ 'Video' }}</label>
        {{-- <input class="form-control" name="picture" type="file" id="picture" value="{{ $technology->picture or ''}}" > --}}
        <div class="input-group target" style="margin-bottom: 10px;">
            <select name="video[]" id="video" class="form-control" required>
                @foreach ($video as $item)
                <option value="{{ $item->id }}">{{ $item->video_name }}</option>
            @endforeach
            </select>
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger addel-delete"><i class="fa fa-remove"></i></button>
            </span>
        </div>
        <button type="button" class="btn btn-success btn-block addel-add"><i class="fa fa-plus"></i></button>
        {!! $errors->first('video', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="addel-service">
    <div class="form-group {{ $errors->has('service') ? 'has-error' : ''}}">
        <label for="service" class="control-label">{{ 'Service' }}</label>
        {{-- <input class="form-control" name="service" type="file" id="service" value="{{ $technology->service or ''}}" > --}}
        <div class="input-group target" style="margin-bottom: 10px;">
            <select name="service[]" id="service" class="form-control" required>
                @foreach ($service as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
            </select>
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger addel-delete"><i class="fa fa-remove"></i></button>
            </span>
        </div>
        <button type="button" class="btn btn-success btn-block addel-add"><i class="fa fa-plus"></i></button>
        {!! $errors->first('service', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Price' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ $technology->price or ''}}" required>
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ $technology->description or ''}}" required>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
<script src="https://www.jqueryscript.net/demo/Dynamic-Form-Element-Creation-And-Deletion-Plugin-Addel/addel.jquery.js"></script>
<script>
    $(document).ready(function () {

        $('.addel-video').addel({
            classes: {
                target: 'target'
            },
            animation: {
                duration: 100
            }
        }).on('addel-video:delete', function (event) {
            event.target.find(':select').val()
            // if (!window.confirm('Are you absolutely positive you would like to delete: ' + '"' + event.target.find(':input').val() + '"?')) {
            //     console.log('preventDefault()!');
            //     event.preventDefault();
            // }
        });
		$('.addel-service').addel({
            classes: {
                target: 'target'
            },
            animation: {
                duration: 100
            }
        }).on('addel-service:delete', function (event) {
            event.target.find(':select').val()
            // if (!window.confirm('Are you absolutely positive you would like to delete: ' + '"' + event.target.find(':input').val() + '"?')) {
            //     console.log('preventDefault()!');
            //     event.preventDefault();
            // }
        });
    });
</script>
