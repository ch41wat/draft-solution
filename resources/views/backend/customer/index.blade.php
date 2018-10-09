@extends('backend.layouts.main')

@section('page-title')
ข้อมูลลูกค้า
@endsection
@section('content')
<script>
    $(function () {
        $('#table-customer').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-customer" class="table table-bordered table-striped">
      <div class="box-header">
        <a href="{{ url('/admin/customer/create') }}" title="Create"><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Create</button></a>
      </div>
        <thead>
            <tr>
                <th>No.</th>
                <th>Company Th</th>
                <th>Company En</th>
                <th>Customer Name Th</th>
                <th>Customer Name En</th>
                <th width="130px;">Tool</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customer as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->company_name_th }}</td>
                <td>{{ $item->company_name_en }}</td>
                <td>{{ $item->customer_name_th }}</td>
                <td>{{ $item->customer_name_en }}</td>
                <td class="text-center">
                    <a href="{{ url('/admin/customer/' . $item->id . '/edit') }}" title="Edit customer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/customer' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" title="Delete customer" onclick="return confirm(&quot;Confirm delete?&quot;)">
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
