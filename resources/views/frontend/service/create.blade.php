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
                                        <input type="radio" name="service" id="name-{{ $item->id }}" value="{{ $item->id or ''}}" {{ (isset($draft->service) && $draft->service == $item->id) ? "checked" : "" }}> 
                                        {{ $item->name or ''}}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-inline form-group pull-left">
                                        <label class="control-label" id="count-select"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
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
                                            <input type="checkbox" name="technology_select[]" id="technology-select-{{ $item->id }}" onclick="add_technology({{ $item->id }})" value="{{ $item->id }}" {{ (isset($draft->technology_id) && in_array($item->id, $draft->technology_id)) ? "checked" : "" }}>
                                            <label for="technology-select-{{ $item->id }}" class="control-label">{{ $item->name }}</label>
                                            <a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="{{ $item->id }}">
                                                <img src="{{ asset('storage/uploads/technology/picture/' . $images[0]) }}" style="width: 100%; min-height: 390px;">
                                            </a>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
				<div id="box-technology-item">
					
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
    <div class="modal fade" id="modal-gallery">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="modal-gallery-title"></h4>
                </div>
                <div class="modal-body">
                    <div id="show-thumbnail"></div>
                </div>
                <div class="modal-footer">
					<h5 class="modal-title" id="modal-gallery-description" align="left"></h5>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body">
                    <p>กรุณาเลือกเทคโนโลยี</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ตกลง</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script> --}}
    <script type="text/javascript">
        $(function () {
	    check_technology();
            document.getElementById('service-form').onsubmit = function() {
                if($('input[name="technology_id[]"]').length === 0){
                    $('#modal-alert').modal({backdrop: 'static'});
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
                    url: "{{ route('ajax-technology-service') }}",
                    type: 'get',
                    data: { column: 'service', q: $(this).val() },
                    dataType: 'json',
                    success: function (data) {
                        var content = '';
                        for (var i = 0; i < data.length; i++) {
                            var images = data[i]['picture_name'].split(',');
                            content += '<div class="col-md-4 col-xs-4">' +
                                            '<input type="checkbox" name="technology_select[]" id="technology-select-' + data[i]['id'] + '" onclick="add_technology(' + data[i]['id'] + ')" value="' + data[i]['id'] + '">' +
                                            ' <label for="technology-select-' + data[i]['id'] + '" class="control-label">' + data[i]['name'] + '</label>' +
                                            '<a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="' + data[i]['id'] + '">' +
                                                '<img src="{{ asset('storage/uploads/') }}/' + images[0] + '" style="width: 100%; min-height: 390px;">' +
                                            '</a>' +
                                        '</div>';
                        }
                        $('#box-technology').html(content);
			            check_technology();
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
                                            '<input type="checkbox" name="technology_select[]" id="technology-select-' + data[i]['id'] + '" onclick="add_technology(' + data[i]['id'] + ')" value="' + data[i]['id'] + '">' +
                                            ' <label for="technology-select-' + data[i]['id'] + '" class="control-label">' + data[i]['name'] + '</label>' +
                                            '<a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="' + data[i]['id'] + '">' +
                                                '<img src="{{ asset('storage/uploads/') }}/' + images[0] + '" style="width: 100%; min-height: 390px;">' +
                                            '</a>' +
                                        '</div>';
                        }
                        $('#box-technology').html(content);
			            check_technology();
                    },
                    cache: true
                });
            })
        });

	function check_technology() {
		var count = 0;
		var technology_html = '';
		if (typeof(Storage) !== undefined) {
			if (localStorage.technology !== undefined) {
				var technology = JSON.parse(localStorage.technology);
				for (var i = 0; i < technology.length; i++) {
					$('#technology-select-' + technology[i]).prop('checked', true);
					technology_html += '<input type="hidden" name="technology_id[]" value="' + technology[i] + '">';
				}
				count = technology.length;
			}
		}
		console.log(count);
		$('#count-select').text('เลือก ' + count + ' เทคโนโลยี');
		$('#box-technology-item').html(technology_html);
	}

	function add_technology(id) {
		var technology = $('input[name="technology_id[]"]').map(function(){
      		    return $(this).val();
    	    }), technologies = [];
            for (var i = 0; i < technology.length; i++) {
                technologies[i] = parseInt(technology[i]);
            }
            if (technologies.indexOf(id) >= 0) {
                technologies.splice(technologies.indexOf(id), 1);
            } else {
                technologies.push(id);
            }
        if (typeof(Storage) !== undefined) {
			localStorage.technology = JSON.stringify(technologies);
            if (technologies.length == 0) {
                localStorage.removeItem('technology');
            }
		}
		check_technology();
	}

    </script>
@endsection
