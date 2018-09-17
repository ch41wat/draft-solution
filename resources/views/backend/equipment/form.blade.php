<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $equipment->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
    <label for="detail" class="control-label">{{ 'Detail' }}</label>
    <input class="form-control" name="detail" type="text" id="detail" value="{{ $equipment->detail or ''}}" >
    {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
    <label for="picture" class="control-label">{{ 'Picture' }}</label>
    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-media">
        <i class="fa fa-plus"></i>
    </button>
    <input class="form-control" name="picture" type="hidden" id="picture" value="{{ $equipment->picture or ''}}" readonly >
    <div id="img-thumbnail" style="min-height: 150px; margin-top: 5px; background-color: #ddd; padding: 20px 0px;"></div>
    {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
    <label for="detail" class="control-label">{{ 'qty' }}</label>
    <input class="form-control" name="qty" type="text" id="qty" value="{{ $equipment->qty or ''}}" >
    {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('unit') ? 'has-error' : ''}}">
    <label for="unit" class="control-label">{{ 'Unit' }}</label>
    <input class="form-control" name="unit" type="text" id="unit" value="{{ $equipment->unit or ''}}" >
    {!! $errors->first('unit', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
