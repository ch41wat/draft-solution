@extends('backend.layouts.main')

@section('page-title')
    ข้อมูลอุปกรณ์
@endsection
@section('content')
<script>
    $(function () {
        $('#table-equipment').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-equipment" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>detail</th>
                <th>picture</th>
                <th>qty</th>
                <th>unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipment as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->detail }}</td>
                <td>{{ $item->picture }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->unit }}</td>
                <td class="text-center">
                    <form action="{{ route('equipment.equipment.destroy', $item->id) }}" method="POST">
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