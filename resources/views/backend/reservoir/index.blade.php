@extends('backend.layouts.main')

@section('page-title')
Reservoir
@endsection
@section('content')
<script>
    $(function () {
        $('#table-reservoir').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-reservoir" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>latitude</th>
                <th>longitude</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservoir as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->latitude }}</td>
                <td>{{ $item->longitude }}</td>
<<<<<<< HEAD
                <td class="text-center">
                    <form action="{{ route('reservoir.reservoir.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" onclick="return confirm(&quot;Confirm delete?&quot;)">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
=======
                <td>
                    <a href="{{ url('/admin/reservoir/' . $item->id . '/edit') }}" title="Edit reservoir"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/reservoir' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="reservoir video" onclick="return confirm( & quot; Confirm delete? & quot; )"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
>>>>>>> cb83f4a92e5fe067ac2ead80077589e9a68a70e6
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
