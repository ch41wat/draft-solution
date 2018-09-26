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
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Company</th>
                    <th>Customer Name</th>
                    <th>Tool</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->company_name }}</td>
                        <td>{{ $item->customer_name }}</td>
                        <td class="text-center">
                            <form action="{{ route('customer.customer.destroy', $item->id) }}" method="POST">
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
