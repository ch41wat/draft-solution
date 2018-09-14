@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New equipment-assignment</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/equipment-assignment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/equipment-assignment') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('backend.equipment-assignment.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $("#technology_id").change(function () {
                $.ajax({
                    url: "{{ route('ajax-technology') }}",
                    type: 'get',
                    data: { column: 'id', q: $(this).val() },
                    dataType: 'json',
                    success: function (data) {
                        var content = '';
                        data.forEach(item => {
                            content += '<img src="{{ asset('storage/uploads/technology') }}/' + item['picture_name'] + '">';
                        });
                        $('#img-content').html(content);
                    },
                    cache: true
                });
            });

            $("#service").change(function () {
                $.ajax({
                    url: "{{ route('ajax-technology') }}",
                    type: 'get',
                    data: { column: 'service', q: $(this).val() },
                    dataType: 'json',
                    success: function (data) {
                        var content = '<option value="">---Choose technology---</option>';
                        data.forEach(item => {
                            content += '<option value="' + item['id'] + '">' + item['name'] + '</option>'
                        });
                        $('#technology_id').html(content);
                    },
                    cache: true
                });
            });
        });

    </script>
@endsection
