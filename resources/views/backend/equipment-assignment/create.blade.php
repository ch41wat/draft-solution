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

                        <form method="POST" action="{{ url('/admin/equipment-assignment') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('backend.equipment-assignment.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-layer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Layer</h4>
                </div>
                <div class="modal-body" style="min-height: 350px;">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="picture_id" id="picture-id">
                            <input type="hidden" name="layer_id" id="layer-id">
                            <div class="form-group">
                                <label for="item-equipment" class="control-label">Equipment </label>
                                <select class="form-control" name="equipment" id="item-equipment">
                                    <option value=""></option>
                                    @foreach ($equipments as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-select">Select Layer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script type="text/javascript">
        $(function () {
            $('#modal-layer').on('show.bs.modal', function (e) {
                var image = $(e.relatedTarget).data('image'),
                    layer = $(e.relatedTarget).data('layer');
                // console.log(image + '-' + layer);
                $('#picture-id').val(image);
                $('#layer-id').val(layer);
                // $("#modal-layer #show-thumbnail").load("{{ route('ajax-equipment') }}", function(){}); 
            });

            $("#technology_id").change(function () {
                $.ajax({
                    url: "{{ route('ajax-technology') }}",
                    type: 'get',
                    data: { column: 'id', q: $(this).val() },
                    dataType: 'json',
                    success: function (data) {
                        var content = '';
                        data.forEach(item => {
                            var pictures_id = item['picture_id'].split(','),
                                pictures_name = item['picture_name'].split(',');
                            pictures_id.forEach(function(id, key) {
                                content += '<div class="col-md-12 col-xs-12" style="background-image: url({{ asset('storage/uploads') }}' + pictures_name[key] + '); background-size: 100% 100%; background-repeat: no-repeat; min-height: 400px; width: 100%; margin-bottom: 10px;">' +
                                    get_layer(id, '') +
                                '</div>' + 
                                '<input type="hidden" name="picture_id[]" value="' + id + '">';
                            });
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

            $('#btn-select').click(function() {
                var id = $('#picture-id').val(),
                    layer = $('#layer-id').val(),
                    equipment = $('#item-equipment').val();
                $('#layer-' + id + '-' + layer).val(equipment);
                $('#link-' + id + '-' + layer).html(layer + ' <span class="label label-success"><i class="fa fa-check-square"></i></span>');
                $('#modal-layer').modal('hide');
            });
        });

    </script>
@endsection
