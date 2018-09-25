@extends('backend.layouts.main')

@section('page-title')
ข้อมูลท่อน้ำ
@endsection
@section('content')
{{-- <div class="container"> --}}
<div class="row">
    {{-- @include('admin.sidebar') --}}

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Pipe</div>
            <div class="card-body">
                <a href="{{ url('/admin/pipe/create') }}" class="btn btn-success btn-sm" title="Add New Pipe">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                </a>

                <form method="GET" action="{{ url('/admin/pipe') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>

                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Labor Cost</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pipe as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->labor_cost }}</td>
                                <td>
                                    <a href="{{ url('/admin/pipe/' . $item->id . '/edit') }}" title="Edit Pipe"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                    <form method="POST" action="{{ url('/admin/pipe' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Pipe" onclick="return confirm( & quot; Confirm delete? & quot; )"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $pipe->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
