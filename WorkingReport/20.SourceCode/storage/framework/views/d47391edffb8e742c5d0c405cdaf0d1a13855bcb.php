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
    <link rel="shortcut icon" href="<?php echo e(Module::asset('auth:ico/favicon.png')); ?>" type="image/x-icon">



    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <link href="<?php echo e(Module::asset('auth:css/beyond.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(Module::asset('auth:css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(Module::asset('auth:css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(Module::asset('auth:css/demo.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(Module::asset('auth:css/animate.min.css')); ?>" rel="stylesheet" type="text/css">


    <script src="<?php echo e(Module::asset('auth:js/skins.js')); ?>"></script>

</head>
<!--Head Ends-->
<!--Body-->
<body>
<?php if($message = \Illuminate\Support\Facades\Session::get('success')): ?>
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo e($message); ?>

    </div>
<?php endif; ?>

<?php if($message = \Illuminate\Support\Facades\Session::get('errors')): ?>

    <div class="alert alert-danger fade in">
        <button class="close" data-dismiss="alert">×</button>
        <i class="fa-fw fa fa-times"></i>
        <strong>Error!</strong> <?php echo e($message); ?>

    </div>
<?php endif; ?>
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
        <form action="<?php echo e(route('auth.login')); ?>" method="post" class="login-form">
            <?php echo e(csrf_field()); ?>

            <div class="loginbox-textbox">
                <input type="text" class="form-control" name="username" placeholder="Username" />
            </div>
            <div class="loginbox-textbox">
                <input type="password" name="password" class="form-control" placeholder="Password" />
            </div>
            <div class="loginbox-forgot">
                <a href="<?php echo e(route('forgot')); ?>" class="white-text">Quên mật khẩu ?</a>
            </div>
            <div class="loginbox-submit">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
        </form>
    </div>
    <div class="logobox">
    </div>
</div>




<script src="<?php echo e(Module::asset('auth:js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('auth:js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('auth:js/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('auth:js/beyond.js')); ?>"></script>




</body>
<!--Body Ends-->
</html>
<?php /**PATH D:\training\WorkingReport\trunk\20.SourceCode\Modules\Auth\Providers/../Resources/views/login.blade.php ENDPATH**/ ?>