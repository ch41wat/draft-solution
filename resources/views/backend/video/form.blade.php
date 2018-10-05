<div class="form-group {{ $errors->has('video_name') ? 'has-error' : ''}}">
    <label for="video_name" class="control-label">{{ 'Video Name' }}</label>
    <input class="form-control" name="video_name" type="text" id="video_name" value="{{ $video->video_name or ''}}" required>
    {!! $errors->first('video_name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group disabled">
    <input type="radio" name="video_type" id="radio-video-file" value="file" required>
    <label for="radio-video-file" class="control-label">{{ 'ไฟล์วีดีโอ' }}</label>
</div>

<div id="type-file">
    <div class="form-group {{ $errors->has('video_file') ? 'has-error' : ''}}">
        <label for="video_file" class="control-label">{{ 'Video File' }}</label>
        <input class="form-control" name="video_file" type="file" id="video_file" accept="video/*" value="{{ $video->video_file or ''}}" disabled required>
        {!! $errors->first('video_file', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input type="radio" name="video_type" id="radio-video-url" value="url" required>
    <label for="radio-video-url" class="control-label">{{ 'ลิงค์วีดีโอ' }}</label>
</div>

<div id="type-url">
    <div class="form-group {{ $errors->has('video_url') ? 'has-error' : ''}}">
        <label for="video_url" class="control-label">{{ 'Video Url' }}</label>
        <input class="form-control" name="video_url" type="text" id="video_url" value="{{ $video->video_url or ''}}" disabled required>
        {!! $errors->first('video_url', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

<script type="text/javascript">
    $(function () {
        $("input[name='video_type']").click(function () {
            if ($(this).val() == 'file') {
                $("#type-file input[type='file']").prop('disabled', false);
                $("#type-url input[type='text']").val('');
                $("#type-url input[type='text']").prop('disabled', true);
            } else {
                $("#type-file input[type='file']").val('');
                $("#type-file input[type='file']").prop('disabled', true);
                $("#type-url input[type='text']").prop('disabled', false);
            }
        })
    })
</script>