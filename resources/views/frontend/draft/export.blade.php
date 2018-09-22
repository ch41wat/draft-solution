<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css') }}">
    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- jQuery 3 -->
    <script src="{{ asset ('/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset ('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset ('/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset ('/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset ('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset ('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset ('/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset ('/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset ('/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset ('/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset ('/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- DataTable -->
    <script src="{{ asset ('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset ('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset ('/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset ('/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ('/dist/js/adminlte.min.js') }}"></script>

    <!-- Google Font -->
    <!--<link rel="stylesheet"  href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}">-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if ($technology)
            @foreach ($technology as $item)
            <h3>{{ strtoupper($service[$item->id]->name) }}</h3>
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Technology: {{ $item->name }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="col-md-12 col-xs-12">
                            @php $images = explode(',', $item->picture_name); @endphp
                            <img src="{{ asset('storage/uploads/technology/picture/' . $images[0]) }}" style="width: 100%; min-height: 390px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tbody>
                                <tr>
                                    <td><label class="control-label">{{ 'จุดประสงค์ของการใช้: ' }}</label></td>
                                    <td>{{ $draft->purpose[$item->id] or '' }}</td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">{{ 'ตำแหน่งโรงงาน: ' }}</label></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">{{ 'ละติจูด' }}</label></td>
                                    <td>{{ $draft->latitude[$item->id] or '' }}</td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">{{ 'ลองจิจูด' }}</label></td>
                                    <td>{{ $draft->longitude[$item->id] or '' }}</td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">{{ 'ปริมาณน้ำที่ต้องการ' }}</label></td>
                                    <td>{{ $draft->water_qty[$item->id] or '' }}</td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">{{ 'ขนาดท่อ' }}</label></td>
                                    <td>{{ $draft->pipe_size_need[$item->id] or '' }}</td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">{{ 'ราคาท่อ' }}</label></td>
                                    <td>{{ $draft->pipe_setup_price[$item->id] or '' }}</td>
                                </tr>
                                @if ($draft->labor_cost[$item->id] > 0)
                                    <tr>
                                        <td><label class="control-label">{{ 'ค่าแรง' }}</label></td>
                                        <td>{{ $draft->pipe_cost[$item->id] or '' }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><label class="control-label">{{ 'รวม' }}</label></td>
                                    <td>{{ $draft->total_price[$item->id] or '' }}</td>
                                </tr>
                            </tbody>
                        </table>      
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
                                @foreach ($equipment_assignment[$item->id] as $key => $eqm)
                                <tr>
                                    <td>{{ ($key+1) }}</td>
                                    <td>{{ $eqm->equipment->name }}</td>
                                    <td>{{ $eqm->equipment->qty }}</td>
                                    <td>{{ $eqm->equipment->unit }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @php $total = $eqm->technology->price * $draft->water_need_qty[$item->id]; @endphp
                                <tr class="bg-danger">
                                    <th></th>
                                    <th>Total</th>
                                    @if ($draft->is_water[$item->id] > 0)
                                        @php $total = $draft->pipe_setup_price[$item->id]; @endphp
                                    @endif
                                    @php $total_cost = $draft->pipe_cost[$item->id] * $draft->labor_cost[$item->id]; @endphp
                                    <th>{{ number_format(($total + $total_cost), 2) }}</th>
                                    <th>บาท</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
</body>
</html>