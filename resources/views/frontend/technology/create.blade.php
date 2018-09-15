@extends('frontend.frontend')

@section('frontend-title')
    เลือกประเภทบริการ/เทคโนโลยี
@endsection
@section('frontend-content')
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Create New Technology</div> --}}
                    <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('technology-post-create') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @foreach ($technology as $item)
                            <div class="box box-default box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Technology: {{ $item->name }}</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-youtube-play"></i> Play video
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="col-md-12 col-xs-12">
                                            @php $images = explode(',', $item->picture_name); @endphp
                                            <input type="checkbox" name="technology_id[]" id="technology-id-{{ $item->id }}" value="{{ $item->id }}" {{ (isset($draft->technology_id) && in_array($item->id, $draft->technology_id)) ? "checked" : "" }}>
                                            <label for="technology-id-{{ $item->id }}" class="control-label">{{ $item->name }}</label>
                                            <a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="{{ $item->id }}">
                                                <img src="{{ asset('storage/uploads/technology/picture/' . $images[0]) }}" style="width: 100%; min-height: 390px;">
                                            </a>
                                        </div>
                                        <div class="form-group {{ $errors->has('water_need_qty.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'ปริมาณความต้องการใช้น้ำ' }}</label>
                                            <input type="text" name="water_need_qty[{{ $item->id }}]" value="{{ $draft->water_need_qty[$item->id] or '' }}" class="form-control">
                                        </div>
                                        <div class="form-group {{ $errors->has('purpose.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'จุดประสงค์ของการใช้' }}</label>
                                            <textarea name="purpose[{{ $item->id }}]" cols="3" class="form-control">
                                                {{ $draft->purpose[$item->id] or '' }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">{{ 'งบประมาณ (ถ้ามี)' }}</label>
                                            <input type="text" name="budget[{{ $item->id }}]" value="{{ $draft->budget[$item->id] or '' }}" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('start_date.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'วันที่มีกำหนดเริ่มต้นน้ำ' }}</label>
                                                    <input type="date" name="start_date[{{ $item->id }}]" value="{{ $draft->start_date[$item->id] or '' }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group {{ $errors->has('start_service_duration.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ระยะเวลารับบริการ' }}</label>
                                                    <input type="date" name="start_service_duration[{{ $item->id }}]" value="{{ $draft->start_service_duration[$item->id] or '' }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group {{ $errors->has('end_service_duration.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ถึง' }}</label>
                                                    <input type="date" name="end_service_duration[{{ $item->id }}]" value="{{ $draft->end_service_duration[$item->id] or '' }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">{{ 'อื่นๆ' }}</label>
                                            <textarea name="other[{{ $item->id }}]" cols="3" class="form-control">
                                                 {{ $draft->other[$item->id] or '' }}
                                            </textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('location.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ตำแหน่งโรงงาน' }}</label>
                                                    <input type="text" name="location[{{ $item->id }}]" value="{{ $draft->location[$item->id] or '' }}" class="form-control">
                                                </div>
                                                <div class="form-group {{ $errors->has('water_qty.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ปริมาณน้ำที่ต้องการ' }}</label>
                                                    <input type="text" name="water_qty[{{ $item->id }}]" value="{{ $draft->water_qty[$item->id] or '' }}" class="form-control">
                                                </div>
                                                <div class="form-group {{ $errors->has('pipe_size.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ขนาดท่อ' }}</label>
                                                    <input type="text" name="pipe_size[{{ $item->id }}]" value="{{ $draft->pipe_size[$item->id] or '' }}" class="form-control">
                                                </div>
                                                <div class="form-group {{ $errors->has('pipe_setup_price.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ราคาค่าวางท่อ / เมตร' }}</label>
                                                    <input type="text" name="pipe_setup_price[{{ $item->id }}]" value="{{ $draft->pipe_setup_price[$item->id] or '' }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="control-label">{{ 'แผนที่' }}</label>
                                                    {{-- <input type="date" name="water_need_qty" id="water_need_qty" class="form-control"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            @endforeach
                            <a href="{{ route('create-form', ['form' => 'service']) }}" class="btn btn-danger">
                                {{ 'ย้อนกลับ' }}
                            </a>
                            <input class="btn btn-primary" type="submit" value="{{ 'ถัดไป' }}">
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
