@extends('layouts.main')

@section('page-title')
    เลือกประเภทบริการ/เทคโนโลยี
@endsection
@section('content')
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Create New Service</div> --}}
                    <div class="card-body">
                        {{-- <a href="{{ url('/admin/service') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> --}}

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/service') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            {{-- @include ('backend.service.form', ['formMode' => 'create']) --}}
                            <div class="btn-group btn-group-lg" data-toggle="buttons">
                                @foreach ($service as $item)
                                <label class="btn btn-primary btn-flat">
                                    <input type="radio" name="name" id="name-{{ $item->id }}"> {{ $item->name or ''}}
                                </label>
                                @endforeach
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
