@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">technology {{ $technology->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/technology') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/technology/' . $technology->id . '/edit') }}" title="Edit technology"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/technology' . '/' . $technology->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete technology" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $technology->id }}</td>
                                    </tr>
                                    <tr><th> name </th><td> {{ $technology->name }} </td></tr>
                                    <tr><th> picture </th><td> {{ $technology->picture }} </td></tr>
                                    <tr><th> video </th><td> {{ $technology->video }} </td></tr>
                                    <tr><th> service </th><td> {{ $technology->service }} </td></tr>
                                    <tr><th> equipment </th><td> {{ $technology->equipment }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
