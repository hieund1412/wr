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
    <link rel="shortcut icon" href="{{ asset('/backend/assets/img/favicon.png') }}" type="image/x-icon">

    <!--Basic Styles-->
    <link href="{{ asset('/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/css/font-awesome.min.css') }}" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link href="{{ asset('/backend/assets/css/beyond.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/css/animate.min.css') }}" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="{{ asset('/backend/assets/js/skins.min.js') }}"></script>
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
        <div class="loginbox-title">Đăng nhập</div>
        <div class="loginbox-social">
            <div class="social-buttons">
                <a href="" class="button-facebook">
                    <i class="social-icon fa fa-facebook"></i>
                </a>
                <a href="" class="button-twitter">
                    <i class="social-icon fa fa-twitter"></i>
                </a>
                <a href="" class="button-google">
                    <i class="social-icon fa fa-google-plus"></i>
                </a>
            </div>
        </div>
        <div class="loginbox-or">
            <div class="or-line"></div>
            <div class="or">OR</div>
        </div>
        <form action="{{route('auth.login')}}" method="post" class="login-form">
            {{ csrf_field() }}
            <div class="loginbox-textbox">
                <input type="text" class="form-control" name="username" placeholder="Username" />
            </div>
            <div class="loginbox-textbox">
                <input type="password" name="password" class="form-control" placeholder="Password" />
            </div>
            <div class="loginbox-forgot">
                <a href="{{route('forgot')}}" class="white-text">Quên mật khẩu ?</a>
            </div>
            <div class="loginbox-submit">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
        </form>
    </div>
    <div class="logobox">
    </div>
</div>


<!--Basic Scripts-->
<script src="{{ asset('/backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!--Beyond Scripts-->
<script src="{{ asset('/backend/assets/js/beyond.js') }}"></script>


</body>
<!--Body Ends-->
</html>
