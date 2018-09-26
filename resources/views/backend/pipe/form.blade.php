<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $pipe->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
    <label for="size" class="control-label">{{ 'size' }}</label>
    <input class="form-control" name="size" type="text" id="size" value="{{ $pipe->size or ''}}" >
    {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'price' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ $pipe->price or ''}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('labor_cost') ? 'has-error' : ''}}">
    <label for="labor_cost" class="control-label">{{ 'labor cost' }}</label>
    <input class="form-control" name="labor_cost" type="text" id="labor_cost" value="{{ $pipe->labor_cost or ''}}" >
    {!! $errors->first('labor_cost', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>