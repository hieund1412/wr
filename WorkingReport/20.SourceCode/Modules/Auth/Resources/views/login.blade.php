<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>
    <meta charset="utf-8" />
    <title>Đăng nhập</title>

    <meta name="description" content="login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{{ asset('/template/assets/img/favicon.png') }}" type="image/x-icon">



    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <link href="{{ Module::asset('auth:css/beyond.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ Module::asset('auth:css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ Module::asset('auth:css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ Module::asset('auth:css/demo.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ Module::asset('auth:css/animate.min.css') }}" rel="stylesheet" type="text/css">
    
    <link href="{{ Module::asset('auth:css/fix-login.css') }}" rel="stylesheet" type="text/css">
    
    <script src="{{ Module::asset('auth:js/skins.js') }}"></script>

</head>
<!--Head Ends-->
<!--Body-->
<body>
@if ($message = \Illuminate\Support\Facades\Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ $message }}
    </div>
@endif

@if ($message = \Illuminate\Support\Facades\Session::get('errors'))

    <div class="alert alert-danger fade in">
        <button class="close" data-dismiss="alert">×</button>
        <i class="fa-fw fa fa-times"></i>
        <strong>Error!</strong> {{ $message }}
    </div>
@endif
<div class="login-container animated fadeInDown">
    <div class="loginbox bg-white">
        <h3 align="center"><img src="{{asset('/template/assets/img/wrp_logo_login.png')}}"></h3>
        <div class="loginbox-title">Đăng nhập</div>
        <form action="{{route('auth.login')}}" method="post" class="login-form">
            {{ csrf_field() }}
            <div class="loginbox-textbox">
                <input type="text" class="form-control" name="user_login" placeholder="Username" />
            </div>
            <div class="loginbox-textbox">
                <input type="password" name="password" class="form-control" placeholder="Password" />
            </div>
            <div class="loginbox-submit">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
        </form>
    </div>
    <h4 align="center"><a href="http://agrimedia.vn/">© 2019 - AgriMedia JSC.</a></h4>
</div>




<script src="{{ Module::asset('auth:js/jquery.min.js') }}"></script>
<script src="{{ Module::asset('auth:js/bootstrap.min.js') }}"></script>
<script src="{{ Module::asset('auth:js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ Module::asset('auth:js/beyond.js') }}"></script>




</body>
<!--Body Ends-->
</html>
