@extends('backend.layouts.main')

@section('page-title')
ข้อมูลผู้ใช้
@endsection
@section('content')
<script>
    $(function () {
        $('#table-user').DataTable()
    })
</script>
<!-- Content Header (Page header) -->
<div class="table-responsive">
    <table id="table-service" class="table table-bordered table-striped">
      
      </div>
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>email</th>
                <th>role</th>
                <th>tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->role }}</td>
                <td>
                    <a href="{{ url('/admin/user/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/user' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)">
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