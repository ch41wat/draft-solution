@extends('backend.layouts.main')

@section('page-title')
    ข้อมูลลูกค้า
@endsection
@section('content')
    {{-- <div class="container"> --}}
        <div class="row">
            {{-- @include('admin.sidebar') --}}
            <div class="col-md-6">
                <img src="{{ asset('img/form-customer.jpg') }}" class="img-responsive" alt="">
            </div>
            <div class="col-md-6">
                <form method="POST" action="{{ url('/admin/customer') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class=""><a href="#tab_en" data-toggle="tab">ภาษาอังกฤษ</a></li>
                            <li class="active"><a href="#tab_th" data-toggle="tab">ภาษาไทย</a></li>
                            <li class="pull-left header">{{ config('app.name') }}</li>
                        </ul>
                        <div class="tab-content">
                            @include ('backend.customer.form', ['formMode' => 'create'])
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </form>
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    {{-- </div> --}}
@endsection
