<div class="form-group {{ $errors->has('path') ? 'has-error' : ''}}">
    <label for="path" class="control-label">{{ 'Path' }}</label>
    <select name="path" id="path" class="form-control" required>
        <option value="{{ 'technology' }}">{{ 'Technology' }}</option>
        <option value="{{ 'equipment' }}">{{ 'Equipment' }}</option>
    </select>
    {!! $errors->first('path', '<p class="help-block">:message</p>') !!}
</div>

<div class="addel-picture">
    <div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
        <label for="picture" class="control-label">{{ 'Picture' }}</label>
        <div class="input-group target" style="margin-bottom: 10px;">
            <input type="file" name="picture[]" class="form-control" accept="image/*" value="{{ $picture->picture or ''}}" required>
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger addel-delete"><i class="fa fa-remove"></i></button>
            </span>
        </div>
        <button type="button" class="btn btn-success btn-block addel-add"><i class="fa fa-plus"></i></button>
        {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
<script src="https://www.jqueryscript.net/demo/Dynamic-Form-Element-Creation-And-Deletion-Plugin-Addel/addel.jquery.js"></script>
<script>
    $(document).ready(function () {
        $('.addel-picture').addel({
            classes: {
                target: 'target'
            },
            animation: {
                duration: 100
            }
        }).on('addel-picture:delete', function (event) {
            event.target.find(':select').val()
            // if (!window.confirm('Are you absolutely positive you would like to delete: ' + '"' + event.target.find(':input').val() + '"?')) {
            //     console.log('preventDefault()!');
            //     event.preventDefault();
            // }
        });
    });
</script>