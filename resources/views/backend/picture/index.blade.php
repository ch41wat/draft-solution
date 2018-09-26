@extends('backend.layouts.main')

@section('page-title')
ข้อมูลรูปภาพ
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
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Path</th>
            </tr>
        </thead>
        <tbody>
            @foreach($picture as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->path }}</td>
                <td class="text-center">
                    <form action="{{ route('technology-picture.technology-picture.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" onclick="return confirm(&quot;Confirm delete?&quot;)">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
