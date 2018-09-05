@extends('frontend')

@section('frontend-title')
    ข้อมูลลูกค้า
@endsection
@section('frontend-content')
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}
            <div class="col-md-6">
                <img src="{{ asset('img/form-customer.jpg') }}" class="img-responsive" alt="">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ config('app.name') }}</h3>
                    </div>
                    @php
                        $disabled_old = (isset($draft->customer_type) && $draft->customer_type == 'customer-old') ? "" : "disabled";
                        $disabled_new = (isset($draft->customer_type) && $draft->customer_type == 'customer-new') ? "" : "disabled";
                    @endphp
                    <div class="card-body">
                        <form method="POST" action="{{ route('customer-post-create') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{-- ลูกค้าปัจจุบัน --}}
                            <div class="form-group disabled">
                                <input type="radio" name="customer_type" id="radio-customer-old" value="customer-old" {{ (isset($draft->customer_type) && $draft->customer_type == 'customer-old') ? "checked" : "" }}>
                                <label for="radio-customer-old" class="control-label">{{ 'ลูกค้าปัจจุบัน' }}</label>
                            </div>
                            <div id="type-old">
                                <div class="form-group {{ $errors->has('customer_name_old') ? 'has-error' : ''}}">
                                    <select class="form-control" name="customer_name_old" id="item-customer" {{ $disabled_old }}>
                                        <option value="{{ $draft->customer_name_old or ''}}">{{ $draft->customer_name_old or ''}}</option>
                                    </select>
                                </div>
                            </div>

                            {{-- ลูกค้าใหม่ --}}
                            <div class="form-group">
                                <input type="radio" name="customer_type" id="radio-customer-new" value="customer-new" {{ (isset($draft->customer_type) && $draft->customer_type == 'customer-new') ? "checked" : "" }}>
                                <label for="radio-customer-new" class="control-label">{{ 'ลูกค้าใหม่' }}</label>
                            </div>
                            <div id="type-new">
                                <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                    <label for="company_name" class="control-label">{{ 'Company Name' }}</label>
                                    <input class="form-control" name="company_name" type="text" id="company_name" value="{{ $draft->company_name or ''}}" {{ $disabled_new }}>
                                    {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                                    <label for="customer_name" class="control-label">{{ 'Customer Name' }}</label>
                                    <input class="form-control" name="customer_name" type="text" id="customer_name" value="{{ $draft->customer_name or ''}}" {{ $disabled_new }}>
                                    {!! $errors->first('customer_name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="{{ 'ตกลง' }}">
                            </div>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                        {{-- {{ print_r($draft) }} --}}
                    </div>
                </div>
            </div>
        </div>
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
                url: "{{ route('ajax-customer') }}",
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
@endsection
