<div class="tab-pane fade in active" id="tab_th">
    <div class="form-group {{ $errors->has('company_name_th') ? 'has-error' : ''}}">
        <label for="company_name_th" class="control-label">{{ 'Company Name Th' }}</label>
        <input class="form-control" name="company_name_th" type="text" id="company_name_th" value="{{ $customer->company_name_th or ''}}" required>
        {!! $errors->first('company_name_th', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('customer_name_th') ? 'has-error' : ''}}">
        <label for="customer_name_th" class="control-label">{{ 'Customer Name Th' }}</label>
        <input class="form-control" name="customer_name_th" type="text" id="customer_name_th" value="{{ $customer->customer_name_th or ''}}" required>
        {!! $errors->first('customer_name_th', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.tab-pane -->
<div class="tab-pane fade" id="tab_en">
    <div class="form-group {{ $errors->has('company_name_en') ? 'has-error' : ''}}">
        <label for="company_name_en" class="control-label">{{ 'Company Name En' }}</label>
        <input class="form-control" name="company_name_en" type="text" id="company_name_en" value="{{ $customer->company_name_en or ''}}" required>
        {!! $errors->first('company_name_en', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('customer_name_en') ? 'has-error' : ''}}">
        <label for="customer_name_en" class="control-label">{{ 'Customer Name En' }}</label>
        <input class="form-control" name="customer_name_en" type="text" id="customer_name_en" value="{{ $customer->customer_name_en or ''}}" required>
        {!! $errors->first('customer_name_en', '<p class="help-block">:message</p>') !!}
    </div>                   
</div>
<!-- /.tab-pane -->

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'แก้ไข' : 'ตกลง' }}">
</div>
