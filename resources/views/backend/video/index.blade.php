@extends('backend.layouts.main')

@section('page-title')
    ข้อมูลวีดีโอ
@endsection
@section('content')
<script>
    $(function () {
        $('#table-video').DataTable()
    })
</script>
<!-- Content Header (Page header) -->

<div class="table-responsive">
    <table id="table-video" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>type</th>
                <th>file</th>
                <th>url</th>
            </tr>
        </thead>
        <tbody>
            @foreach($video as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->video_name }}</td>
                <td>{{ $item->video_type }}</td>
                <td>{{ $item->video_file }}</td>
                <td>{{ $item->video_url }}</td>
                <td class="text-center">
                    <form action="{{ route('video.video.destroy', $item->id) }}" method="POST">
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