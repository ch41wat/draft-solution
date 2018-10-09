@extends('backend.layouts.main')

@section('page-title')
ข้อมูลเทคโนโลยี
@endsection
@section('content')
<script>
    $(function () {
        $('#table-technology').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-technology" class="table table-bordered table-striped">
      <div class="box-header">
        <a href="{{ url('/admin/technology/create') }}" title="Create"><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Create</button></a>
        <a href="{{ url('/admin/equipment-assignment/create') }}" title="Mark Detail"><button class="btn btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Mark Detail</button></a>
        <a href="{{ url('/admin/video/create') }}" title="Add Video"><button class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>Add Video</button></a>
      </div>
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>picture</th>
                <th>video</th>
                <th>service</th>
                <th>price</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach($technology as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->picture }}</td>
                <td>{{ $item->video }}</td>
                <td>{{ $item->service }}</td>
                <td>{{ $item->price }}</td>
                <td>
                    <a href="{{ url('/admin/technology/' . $item->id . '/edit') }}" title="Edit Technoogy"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/technology' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" title="Delete Technoogy" onclick="return confirm(&quot;Confirm delete?&quot;)">
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
