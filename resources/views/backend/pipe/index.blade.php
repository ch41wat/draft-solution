@extends('backend.layouts.main')

@section('page-title')
ข้อมูลท่อน้ำ
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
      <div class="box-header">
        <a href="{{ url('/admin/pipe/create') }}" title="Create"><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Create</button></a>
      </div>
        <thead>
            <tr>
              <th>No.</th>
              <th>name</th>
              <th>size</th>
              <th>price</th>
              <th>Tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pipe as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->size }}</td>
              <td>{{ $item->price }}</td>
              <td>
                  <a href="{{ url('/admin/pipe/' . $item->id . '/edit') }}" title="Edit pipe"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                  <form method="POST" action="{{ url('/admin/pipe' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button class="btn btn-danger btn-sm" title="Delete pipe" onclick="return confirm(&quot;Confirm delete?&quot;)">
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
