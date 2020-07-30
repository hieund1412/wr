<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quên Mật Khẩu</title>
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
<body>

<div class="login-container animated fadeInDown">
    <div class="loginbox bg-white">
        <div class="loginbox-title">Quên mật khẩu</div>
        <div class="loginbox-social">
            <div class="social-title ">Nhập Email của bạn và hướng dẫn sẽ gửi đến bạn !</div>
        </div>
        <div class="loginbox-or">
            <div class="or-line"></div>
            <div class="or">OR</div>
        </div>
        <form action="{{route('forgot.send')}}" method="post" class="login-form">
            {{ csrf_field() }}
            <div class="loginbox-textbox">
                <input type="text" name="email" class="form-username form-control" id="form-email" placeholder="Email định dạng abc@gmail.com" err-msr="Email không được để trống !">
            </div>
            <div class="loginbox-submit">
                <input type="submit" class="btn btn-primary btn-block" value="Gửi">
            </div>
        </form>
    </div>
    <div class="logobox">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Chúng tôi đã gửi link khôi phục mật khẩu đến Email của bạn !
            </div>
        @endif

        @if ($message = Session::get('errors'))
            <div class="alert alert-danger alert-block fadeIn">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{$message}}
            </div>
        @endif
    </div>
</div>
<!-- Javascript -->
<!--Basic Scripts-->
<script src="{{ asset('/backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!--Beyond Scripts-->
<script src="{{ asset('/backend/assets/js/beyond.js') }}"></script>
</body>
</html>
