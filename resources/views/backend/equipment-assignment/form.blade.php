<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('service') ? 'has-error' : ''}}">
            <label for="service" class="control-label">{{ 'Services' }}</label>
            <select name="service" id="service" class="form-control">
                 <option value="">{{ '---Choose services---' }}</option>
                @foreach ($services as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('service', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('technology_id') ? 'has-error' : ''}}">
            <label for="technology_id" class="control-label">{{ 'Technology Id' }}</label>
            <select name="technology_id" id="technology_id" class="form-control">
                <option value=""></option>
            </select>{!! $errors->first('technology_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="img-content" style="min-height: 390px; margin: 5px auto; background-color: #ddd; padding: 0px; border: 1px solid #202020;"></div>
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
