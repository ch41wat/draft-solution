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
                        <form method="POST" action="{{ route('service-post-create') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{-- {{ dd($draft) }} --}}
                            <div class="form-group text-center">
                                <div class="btn-group btn-group-lg" data-toggle="buttons">
                                    @foreach ($service as $item)
                                    <label class="btn {{ (isset($draft->service) && $draft->service == $item->id) ? "active" : "" }}">
                                        <input type="radio" name="service" id="name-{{ $item->id }}" value="{{ $item->id or ''}}" {{ (isset($draft->service) && $draft->service == $item->id) ? "checked" : "" }}> 
                                        {{ $item->name or ''}}
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <div id="box-technology">
                                    @if ($technology)
                                        @foreach ($technology as $item)
                                        <div class="col-md-6 col-xs-6">
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
                            <a href="{{ route('create-form', ['form' => 'customer']) }}" class="btn btn-danger">
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
    <script type="text/javascript">
        $(function () {
            $('#modal-gallery').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('technology');
                $("#modal-gallery #show-thumbnail").load("{{ route('load-equipment-assignment') }}", 'id=' + id, 
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
                            content += '<div class="col-md-6 col-xs-6">' +
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
        });

    </script>
@endsection
