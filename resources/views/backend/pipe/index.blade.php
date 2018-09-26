@extends('backend.layouts.main')

@section('page-title')
Pipe
@endsection
@section('content')
<script>
    $(function () {
        $('#table-pipe').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-pipe" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>size</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pipe as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->size }}</td>
                <td>{{ $item->price }}</td>
                <td class="text-center">
                    <form action="{{ route('pipe.pipe.destroy', $item->id) }}" method="POST">
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
