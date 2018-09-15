@extends('backend.layouts.main')

@section('page-title')
    ข้อมูลเทคโนโลยี
@endsection
@section('content')
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Technology</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/technology') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/technology') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('backend.technology.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-fullscreen fade" id="modal-media">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Media</h4>
                </div>
                <div class="modal-body" style="min-height: 350px;">
                    <div id="show-thumbnail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-select">Select Image</button>
                </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <script type="text/javascript">
        $(function () { 
            $('#modal-media').on('show.bs.modal', function (event) {

                $("#modal-media #show-thumbnail").load("{{ route('picture.get-picture', ['type' => 'checkbox', 'search' => 'technology']) }}", function(){}); 
            });

            $('#btn-select').click(function() {
                var items = $.map($('input.select-item:checkbox:checked'), function(n, i){
                        return n.value;
                    }),
                    itemsID = new Array(), itemsImg = new Array();
                items.forEach(function(item, key) {
                    var data = item.split('|');
                    itemsID[key] = data[0];
                    itemsImg[key] = '<div class="col-md-12 col-xs-12" style="background-image: url({{ asset('storage/uploads/') }}' + data[1] + '); background-size: 100% 100%; background-repeat: no-repeat; min-height: 390px; width: 100%; margin-bottom: 10px;">' +
                        get_layer(data[0], 'disabled') +
                    '</div>';
                });
                $('#picture').val(itemsID.join(','));
                $('#img-thumbnail').html(itemsImg.join(''));
                $('#modal-media').modal('hide');
            });
        });
    </script>
@endsection
