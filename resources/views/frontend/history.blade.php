@extends('frontend.layouts.main')

@section('page-title')
    @yield('frontend-title')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 text-center" style="margin-bottom: 100px;">
            <h3 class="text-white">ระบบข้อมูลสินค้าและบริการอิเล็กทรอนิกส์</h3>
            <form method="GET" action="{{ route(Auth::user()->role . '-history') }}" accept-charset="UTF-8" class="form-inline center-block" role="search">
                <label class="control-label text-white">ค้นหา {{ config('app.name') }}</label>
                <input type="text" class="form-control" name="company" placeholder="ชื่อบริษัท" value="{{ request('company') }}">
                <input type="text" class="form-control" name="sale" placeholder="ชื่อพนักงานขาย" value="{{ request('sale') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i> ค้นหา
                </button>
            </form>
        </div>
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        {{-- <h1>@yield('page-title')</h1> --}}
        <ol class="breadcrumb">
            <li class="home">{{ config('app.name') }}</li>
            @if (Request::segment(2) !== 'home')
                <li class="active">{{ Request::segment(2) }}</li>
            @endif
        </ol>
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="bg-primary">
                            <th>Solution No.</th>
                            <th>Create Date</th>
                            <th>Create Time</th>
                            <th>Last Update</th>
                            <th>Last Time</th>
                            <th>Compay</th>
                            <th>Sales Names</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($drafts)
                            @foreach ($drafts as $draft)
                            <tr>
                                <td>{{ $draft->draft_id }}</td>
                                <td>{{ date('d M Y', strtotime($draft->created_at)) }}</td>
                                <td>{{ date('d M Y', strtotime($draft->created_at)) }}</td>
                                <td>{{ date('d M Y', strtotime($draft->updated_at)) }}</td>
                                <td>{{ date('d M Y', strtotime($draft->updated_at)) }}</td>
                                <td>{{ $draft->customer->company_name }}</td>
                                <td>{{ $draft->user->name }}</td>
                                <td>{{ $draft->cork_water }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $drafts->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            if (typeof(Storage) !== undefined) {
                if (localStorage.technology !== undefined) {
                    localStorage.clear();
                }
            }
        });
    </script>
@endsection
