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
                <td class="text-center">
                    <form action="{{ route('reservoir.reservoir.destroy', $item->id) }}" method="POST">
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
