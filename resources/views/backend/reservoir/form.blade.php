<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $reservoir->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('latitude') ? 'has-error' : ''}}">
    <label for="latitude" class="control-label">{{ 'latitude' }}</label>
    <input class="form-control" name="latitude" type="text" id="latitude" value="{{ $reservoir->latitude or ''}}" >
    {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('longitude') ? 'has-error' : ''}}">
    <label for="longitude" class="control-label">{{ 'longitude' }}</label>
    <input class="form-control" name="longitude" type="text" id="longitude" value="{{ $reservoir->longitude or ''}}" >
    {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
</div>