@extends('backend.layouts.main')

@section('page-title')
ข้อมูลบริการ
@endsection
@section('content')
<script>
    $(function () {
        $('#table-service').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-service" class="table table-bordered table-striped">
      <div class="box-header">
        <a href="{{ url('/admin/service/create') }}" title="Create"><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Create</button></a>
      </div>
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach($service as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ url('/admin/service/' . $item->id . '/edit') }}" title="Edit service"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/service' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" title="Delete service" onclick="return confirm(&quot;Confirm delete?&quot;)">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
