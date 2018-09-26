@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Equipment-assignment</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/equipment-assignment/create') }}" class="btn btn-success btn-sm" title="Add New equipment-assignment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/equipment-assignment') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Technology Id</th>
                                        <th>Equipment Id</th>
                                        <th>Picture Id</th>
                                        <th>Layer</th>
                                        <th>Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($equipment_assignment as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->technology_id }}</td>
                                        <td>{{ $item->equipment_id }}</td>
                                        <td>{{ $item->picture_id }}</td>
                                        <td>{{ $item->layer }}</td>
                                        <td>
                                            <a href="{{ url('/admin/equipment-assignment/' . $item->id) }}" title="View equipment-assignment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/equipment-assignment/' . $item->id . '/edit') }}" title="Edit equipment-assignment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/equipment-assignment' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-sm" title="Delete equipment-assignment" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $equipment_assignment->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
