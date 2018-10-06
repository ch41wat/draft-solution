@extends('frontend.frontend')

@section('frontend-title')
    สรุปรายละเอียด
@endsection
@section('frontend-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                {{-- {{ dd($draft) }} --}}
                <form method="POST" action="{{ route(Auth::user()->role . '-draft-post-create') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @foreach ($technology as $item)
                    <div class="box box-default box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Technology: {{ $item->name }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="col-md-12 col-xs-12">
                                    @php $images = explode(',', $item->picture_name); @endphp
                                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="{{ $item->id }}">
                                        <img src="{{ asset('storage/uploads/technology/picture/' . $images[0]) }}" style="width: 100%; min-height: 390px;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @php $serviceName = []; @endphp
                                @if (count($service[$item->id]) > 0)
                                    @foreach ($service[$item->id] as $itemService)
                                        @php $serviceName[] = $itemService->name; @endphp
                                    @endforeach
                                @endif
                                <h3>{{ strtoupper(implode(', ', $serviceName)) }}</h3>
                                <div class="form-group {{ $errors->has('purpose.' . $item->id) ? 'has-error' : ''}}">
                                    <label class="control-label">{{ 'จุดประสงค์ของการใช้' }}</label>
                                    <textarea name="purpose[{{ $item->id }}]" cols="3" class="form-control" readonly>{{ $draft->purpose[$item->id] or '' }}</textarea>
                                </div>
                                @if ($draft->is_water[$item->id] > 0)
                                <div class="form-group">
                                    <label class="control-label">{{ 'ตำแหน่งโรงงาน' }}</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('latitude.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'ละติจูด' }}</label>
                                            <input type="text" name="latitude[{{ $item->id }}]" id="latitude-{{ $item->id }}" value="{{ $draft->latitude[$item->id] or '' }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('longitude.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'ลองจิจูด' }}</label>
                                            <input type="text" name="longitude[{{ $item->id }}]" id="longitude-{{ $item->id }}" value="{{ $draft->longitude[$item->id] or '' }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group {{ $errors->has('water_qty.' . $item->id) ? 'has-error' : ''}}">
                                    <label class="control-label">{{ 'ปริมาณน้ำที่ต้องการ' }}</label>
                                    <input type="text" name="water_qty[{{ $item->id }}]" value="{{ number_format($draft->water_need_qty[$item->id]) }}" class="form-control" readonly>
                                </div>
                                <div class="form-group {{ $errors->has('pipe_size_need.' . $item->id) ? 'has-error' : ''}}">
                                    <label class="control-label">{{ 'ขนาดท่อ' }}</label>
                                    <input type="text" name="pipe_size_need[{{ $item->id }}]" value="{{ $draft->pipe_size_need[$item->id] or '' }}" class="form-control" readonly>
                                </div>
                                @if ($draft->is_water[$item->id] > 0)
                                <div class="form-group {{ $errors->has('labor_cost.' . $item->id) ? 'has-error' : ''}}">
                                    <label class="control-label">{{ 'ค่าแรง : ' }}</label>
                                    <input type="radio" name="labor_cost[{{ $item->id }}]" id="is-cost-1" value="1" {{ ((isset($draft->labor_cost) && $draft->labor_cost[$item->id] == 1)) ? "checked" : "" }} onclick="return false;">
                                    <label for="is-cost-1" class="control-label">{{ 'รวม' }}</label>
                                    <input type="radio" name="labor_cost[{{ $item->id }}]" id="is-cost-0" value="0" {{ ((isset($draft->labor_cost) && $draft->labor_cost[$item->id] == 0)) ? "checked" : "" }} onclick="return false;">
                                    <label for="is-cost-0" class="control-label">{{ 'ไม่รวม' }}</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('pipe_setup_price.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'ราคาท่อ' }}</label>
                                            <input type="text" name="pipe_setup_price[{{ $item->id }}]" value="{{ number_format($draft->pipe_setup_price[$item->id]) }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('pipe_setup_price.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'ค่าแรง' }}</label>
                                            <input type="text" name="pipe_cost[{{ $item->id }}]" id="pipe-cost-{{ $item->id }}" value="{{ number_format($draft->pipe_cost[$item->id]) }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('total_price.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'รวม' }}</label>
                                            <input type="text" name="total_price[{{ $item->id }}]" id="total-price-{{ $item->id }}" value="{{ number_format($draft->total_price[$item->id]) }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equipment_assignment[$item->id] as $eqm)
                                        <tr>
                                            <td></td>
                                            <td>{{ $eqm->equipment->name }}</td>
                                            <td>{{ $eqm->equipment->qty }}</td>
                                            <td>{{ $eqm->equipment->unit }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-danger">
                                            <th></th>
                                            <th>Total</th>
                                            <th>{{ number_format($draft->total_all[$item->id], 2) }}</th>
                                            <th>บาท</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    @endforeach
                    <div class="col-md-6 text-left">
                        <a href="{{ route(Auth::user()->role . '-generate-pdf') }}" class="btn btn-warning">Preview</a>
                        <!-- <a href="{{ route(Auth::user()->role . '-draft-excel') }}" class="btn btn-success">Export Excel</a> -->
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route(Auth::user()->role . '-technology') }}" class="btn btn-danger">
                            {{ 'ย้อนกลับ' }}
                        </a>
                        <input class="btn btn-primary" type="submit" value="{{ 'บันทึก' }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
