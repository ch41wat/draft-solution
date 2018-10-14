<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Username' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $user->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'Role' }}</label>
    <select name="role" id="role" class="form-control" required>
        <option value="{{ 'admin' }}">{{ 'Admin' }}</option>
        <option value="{{ 'sale' }}">{{ 'Sale' }}</option>
		<option value="{{ 'saleadmin' }}">{{ 'SaleAdmin' }}</option>
    </select>
    {!! $errors->first('path', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

