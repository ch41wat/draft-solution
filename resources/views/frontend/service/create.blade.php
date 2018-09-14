@extends('frontend.frontend')

@section('frontend-title')
    เลือกประเภทบริการ/เทคโนโลยี
@endsection
@section('frontend-content')

    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Create New Service</div> --}}
                    <div class="card-body">
                        <form method="POST" action="{{ url('/admin/service') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group text-center">
                                <div class="btn-group btn-group-lg" data-toggle="buttons">
                                    @foreach ($service as $item)
                                    <label class="btn btn-primary btn-flat">
                                        <input type="radio" name="name" id="name-{{ $item->id }}" value="{{ $item->id or ''}}"> {{ $item->name or ''}}
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="box-technology"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('create-form', ['form' => 'customer']) }}" class="btn btn-danger">
                                    {{ 'ย้อนกลับ' }}
                                </a>
                                <input class="btn btn-primary" type="submit" value="{{ 'ถัดไป' }}" disabled>
                            </div>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function () {
        $("input[type='radio']").change(function () {
            $.ajax({
                url: "{{ route('ajax-technology') }}",
                type: 'get',
                data: { column: 'service', q: $(this).val() },
                dataType: 'json',
                success: function (data) {
                    var content = '';
                    for (var i = 0; i < data.length; i++) {
                        content += '<div class="col-md-6">' +
                                        '<div class="form-group">' +
                                            '<input type="checkbox" name="technology_id[]" id="technology-id-' + data[i]['id'] + '" value="' + data[i]['id'] + '">' +
                                            ' <label for="technology-id-' + data[i]['id'] + '" class="control-label">' + data[i]['name'] + '</label>' +
                                        '</div>' +
                                        '<img src="{{ asset('storage/uploads/technology/picture') }}/' + data[i]['picture'] + '" class="img-responsive" alt="">' +
                                    '</div>';
                    }
                    $('#box-technology').html(content);
                },
                cache: true
            });
        });
    });

</script>
@endsection
