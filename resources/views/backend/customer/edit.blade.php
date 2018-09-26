@extends('backend.layouts.main')

@section('page-title')
    ข้อมูลลูกค้า
@endsection
@section('content')
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}
            <div class="col-md-6">
                <img src="{{ asset('img/form-customer.jpg') }}" class="img-responsive" alt="">
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3>{{ config('app.name') }} #{{ $customer->id }}</h3></div>
                    <div class="card-body">
                        {{-- <a href="{{ url('/admin/customer') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> --}}

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/customer/' . $customer->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('backend.customer.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
