
<div class="form-group disabled">
    <input type="radio" name="customer_type" id="radio-customer-old" value="customer-old">
    <label for="radio-customer-old" class="control-label">{{ 'ลูกค้าปัจจุบัน' }}</label>
</div>
<div id="type-old">
    <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
        <select class="form-control" name="customer_name_old" id="item-customer" disabled></select>
    </div>
</div>

<div class="form-group">
    <input type="radio" name="customer_type" id="radio-customer-new" value="customer-new">
    <label for="radio-customer-new" class="control-label">{{ 'ลูกค้าใหม่' }}</label>
</div>
<div id="type-new">
    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
        <label for="company_name" class="control-label">{{ 'Company Name' }}</label>
        <input class="form-control" name="company_name" type="text" id="company_name" value="{{ $customer->company_name or ''}}" disabled>
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
        <label for="customer_name" class="control-label">{{ 'Customer Name' }}</label>
        <input class="form-control" name="customer_name" type="text" id="customer_name" value="{{ $customer->customer_name or ''}}" disabled>
        {!! $errors->first('customer_name', '<p class="help-block">:message</p>') !!}
    </div>
    {{-- <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
        <label for="location" class="control-label">{{ 'Location' }}</label>
        <input class="form-control" name="location" type="text" id="location" value="{{ $customer->location or ''}}" >
        {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
    </div> --}}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'แก้ไข' : 'ตกลง' }}">
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("input[name='customer_type']").click(function () {
            if ($(this).val() == 'customer-old') {
                $("#type-old select").prop('disabled', false);
                $("#type-new input[type='text']").prop('disabled', true);
            } else {
                $("#type-old select").prop('disabled', true);
                $("#type-new input[type='text']").prop('disabled', false);
            }
        })
    })

    $('#item-customer').select2({
        placeholder: 'Select an item',
            ajax: {
            url: "{{ route(Auth::user()->role . '-ajax-customer') }}",
            type: 'get',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.customer_name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });


</script>
