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
<<<<<<< HEAD
                <td class="text-center">
                    <form action="{{ route('technology-picture.technology-picture.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" onclick="return confirm(&quot;Confirm delete?&quot;)">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
=======
                <td>
                    <a href="{{ url('/admin/picture/' . $item->id . '/edit') }}" title="Edit picture"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/picture' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete picture" onclick="return confirm( & quot; Confirm delete? & quot; )"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
>>>>>>> cb83f4a92e5fe067ac2ead80077589e9a68a70e6
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
