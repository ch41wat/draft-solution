@extends('auth.layouts.main')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <img src="{{ asset('img/logo.png') }}" alt="">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><strong>Log in</strong> your account</p>

        <form action="/users" class="form-login" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="name" name="name" value="" placeholder="Username" autocomplete="off">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control password" placeholder="Password" autocomplete="off">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat loginbutton">LOGIN</button>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script type="text/javascript">
    $(function () {
        if (typeof(Storage) !== undefined) {
            if (localStorage.technology !== undefined) {
                localStorage.removeItem('technology');
            }
        }
    });
</script>
@endsection