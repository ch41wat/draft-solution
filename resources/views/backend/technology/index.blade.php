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
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>picture</th>
                <th>video</th>
                <th>service</th>
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
                <td class="text-center">
                    <form action="{{ route('technology.technology.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">
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
