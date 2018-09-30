@extends('frontend.frontend')

@section('frontend-title')
    เลือกประเภทบริการ/เทคโนโลยี
@endsection
@section('frontend-content')
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Create New Service</div> --}}
                    <div class="card-body">
                        <form method="POST" action="{{ route(Auth::user()->role . '-service-post-create') }}" accept-charset="UTF-8" enctype="multipart/form-data" id="service-form">
                            {{ csrf_field() }}
                            {{-- {{ dd($draft) }} --}}
                            <div class="form-group text-center">
                                <div class="btn-group btn-group-lg" data-toggle="buttons">
                                    @foreach ($service as $item)
                                    <label class="btn {{ (isset($draft->service) && $draft->service == $item->id) ? "active" : "" }}">
                                        <input type="radio" name="service" id="name-{{ $item->id }}" value="{{ $item->id or ''}}" {{ (isset($draft->service) && $draft->service == $item->id) ? "checked" : "" }} required> 
                                        {{ $item->name or ''}}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                            <div class="form-inline form-group pull-right">
                                                <label class="control-label">ค้นหา </label>
                                                <input type="text" class="form-control" name="search" placeholder="เทคโนโลยี">
                                                <button class="btn btn-primary" type="button" id="btn-search">
                                                    <i class="fa fa-search"></i> ค้นหา
                                                </button>
                                            </div>
                                </div>
                                <div id="box-technology">
                                    @if ($technology)
                                        @foreach ($technology as $item)
                                        <div class="col-md-4 col-xs-4">
                                            @php $images = explode(',', $item->picture_name); @endphp
                                            <input type="checkbox" name="technology_id[]" id="technology-id-{{ $item->id }}" value="{{ $item->id }}" {{ (isset($draft->technology_id) && in_array($item->id, $draft->technology_id)) ? "checked" : "" }}>
                                            <label for="technology-id-{{ $item->id }}" class="control-label">{{ $item->name }}</label>
                                            <a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="{{ $item->id }}">
                                                <img src="{{ asset('storage/uploads/technology/picture/' . $images[0]) }}" style="width: 100%; min-height: 390px;">
                                            </a>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route(Auth::user()->role . '-create-form', ['form' => 'customer']) }}" class="btn btn-danger">
                                {{ 'ย้อนกลับ' }}
                            </a>
                            <input class="btn btn-primary" type="submit" value="{{ 'ถัดไป' }}">
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
    <div class="modal fade" id="modal-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="modal-gallery-title"></h4>
                </div>
                <div class="modal-body">
                    <div id="show-thumbnail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script> --}}
    <script type="text/javascript">
        $(function () {
            document.getElementById('service-form').onsubmit = function() {
                if($('input:checkbox[name="technology_id[]"]:checked').length === 0){
                    alert( 'กรุณาเลือกเทคโนโลยี' );
                    return false; // don't submit
                }
                return true; // submit
            };

            $('#modal-gallery').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('technology');
                $("#modal-gallery #show-thumbnail").load("{{ route(Auth::user()->role . '-load-equipment-assignment') }}", 'id=' + id, 
                function(){}); 
            });

            $("input[type='radio']").change(function () {
                $.ajax({
                    url: "{{ route('ajax-technology') }}",
                    type: 'get',
                    data: { column: 'service', q: $(this).val() },
                    dataType: 'json',
                    success: function (data) {
                        var content = '';
                        for (var i = 0; i < data.length; i++) {
                            var images = data[i]['picture_name'].split(',');
                            content += '<div class="col-md-4 col-xs-4">' +
                                            '<input type="checkbox" name="technology_id[]" id="technology-id-' + data[i]['id'] + '" value="' + data[i]['id'] + '">' +
                                            ' <label for="technology-id-' + data[i]['id'] + '" class="control-label">' + data[i]['name'] + '</label>' +
                                            '<a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="' + data[i]['id'] + '">' +
                                                '<img src="{{ asset('storage/uploads/') }}/' + images[0] + '" style="width: 100%; min-height: 390px;">' +
                                            '</a>' +
                                        '</div>';
                        }
                        $('#box-technology').html(content);
                    },
                    cache: true
                });
            });
            
            $("#btn-search").click(function () {
                var service = $('input:radio[name="service"]:checked').val(),
                    search = $('input[name="search"]').val();
                if (service == undefined) {
                    service = '%';
                }
                $.ajax({
                    url: "{{ route(Auth::user()->role . '-search-technology') }}",
                    type: 'get',
                    data: { q: service, search: search },
                    dataType: 'json',
                    success: function (data) {
                        var content = '';
                        for (var i = 0; i < data.length; i++) {
                            var images = data[i]['picture_name'].split(',');
                            content += '<div class="col-md-4 col-xs-4">' +
                                            '<input type="checkbox" name="technology_id[]" id="technology-id-' + data[i]['id'] + '" value="' + data[i]['id'] + '">' +
                                            ' <label for="technology-id-' + data[i]['id'] + '" class="control-label">' + data[i]['name'] + '</label>' +
                                            '<a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="' + data[i]['id'] + '">' +
                                                '<img src="{{ asset('storage/uploads/') }}/' + images[0] + '" style="width: 100%; min-height: 390px;">' +
                                            '</a>' +
                                        '</div>';
                        }
                        $('#box-technology').html(content);
                    },
                    cache: true
                });
            })
        });

    </script>
@endsection
