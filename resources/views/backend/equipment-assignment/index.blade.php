@extends('backend.layouts.main')

@section('page-title')
ข้อมูลยูนิตที่อยู่ในเทคโนโลยี
@endsection
@section('content')
<script>
    $(function () {
        $('#table-equipment-assignment').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-equipment-assignment" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
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
                <td>{{ $item->id }}</td>
                <td>{{ $item->technology_id }}</td>
                <td>{{ $item->equipment_id }}</td>
                <td>{{ $item->picture_id }}</td>
                <td>{{ $item->layer }}</td>
                <td>
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
</div>
@endsection
