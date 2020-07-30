<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khôi Phục Mật Khẩu</title>
    <link rel="stylesheet" href="../../app/Auth/Views/assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../app/Auth/Views/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../app/Auth/Views/assets/css/form-elements.css">
    <link rel="stylesheet" href="../../app/Auth/Views/assets/css/style.css">
</head>
<body>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('errors'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ $message }}
    </div>
@endif
    <!-- Top content -->
    <div class="top-content">

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>Khôi Phục Mật Khẩu CMS</strong></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-bottom">
                            <form method="post" class="reset-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="form-username" class="white-text">Mật khẩu mới <span class="red-text">*</span></label>
                                    <input type="password" name="password" class="form-username form-control" id="form-password" placeholder="Mật khẩu trong khoảng từ 8-190 ký tự gồm chữ và số">
                                    <p class="red-text" id="error-username"></p>
                                </div>
                                <div class="form-group">
                                    <label class="white-text" for="form-password">Nhập lại mật khẩu mới<span class="red-text">*</span></label>
                                    <input type="password" name="re-password" class="form-password form-control" id="form-repassword" placeholder="Mật khẩu trong khoảng từ 8-190 ký tự gồm chữ và số">
                                    <p class="red-text" id="error-password"></p>
                                </div>
                                <button type="submit" class="btn">Lưu</button>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!-- Javascript -->
<script src="../../app/Auth/Views/assets/js/jquery-1.11.1.min.js"></script>
<script src="../../app/Auth/Views/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../app/Auth/Views/assets/js/jquery.backstretch.min.js"></script>
<script src="../../app/Auth/Views/assets/js/rspw-scripts.js"></script>
</body>
</html>
