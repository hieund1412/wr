<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<!-- Head -->
<head>
    <meta charset="utf-8"/>
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta name="description" content="Dashboard"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('/template/assets/img/favicon.png')); ?>" type="image/x-icon">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!--Basic Styles-->
    <link href="<?php echo e(asset('/template/assets/css/bootstrap.min.css')); ?>" rel="stylesheet"/>
    <link id="bootstrap-rtl-link" href="" rel="stylesheet"/>
    <link href="<?php echo e(asset('/template/assets/css/font-awesome.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/template/assets/css/weather-icons.min.css')); ?>" rel="stylesheet"/>

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300"
          rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!--Beyond styles-->
    <link href="<?php echo e(asset('/template/assets/css/beyond.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/template/assets/css/demo.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/template/assets/css/typicons.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/template/assets/css/animate.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/template/assets/css/dataTables.bootstrap.css')); ?>" rel="stylesheet"/>
    


    <link id="skin-link" href="" rel="stylesheet" type="text/css"/>
    <?php echo $__env->yieldContent('css'); ?>
    <script src="<?php echo e(asset('/template/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/datatable/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/datatable/ZeroClipboard.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/datatable/dataTables.tableTools.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/datatable/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/datatable/datatables-init.js')); ?>"></script>
    <script src="<?php echo e(asset('/template/assets/js/select2/select2.js')); ?>"></script>

</head>

<body>
<!-- Loading Container -->
<div class="loading-container">
    <div class="loader"></div>
</div>
<!--  /Loading Container -->
<!-- Navbar -->
<div class="navbar">
    <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- /Navbar -->

<!-- Main Container -->
<div class="main-container container-fluid">
    <!-- Page Container -->
    <div class="page-container">

        <!-- Page Sidebar -->
        <div class="page-sidebar" id="sidebar">
            <!-- /Page Sidebar Header -->
            <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- /Page Sidebar -->

        <!-- Page Content -->
    <?php echo $__env->yieldContent('body'); ?>
    <!-- /Page Content -->
    </div>
    <!--- /Page Container -->
</div>
<!-- /Main Container -->
<div id="loader" style="display: none"></div>


<script>
    // $('#summernote').summernote({height: 300});

    function startLoading() {
        document.getElementById("loader").style.display = "block";
    }

    function stopLoading() {
        document.getElementById("loader").style.display = "none";
    }

</script>

<!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
<script src="<?php echo e(asset('/template/assets/js/skins.min.js')); ?>"></script>
<link href="<?php echo e(asset('/template/assets/css/style.css')); ?>" rel="stylesheet"/>
<!--Basic Scripts-->

<script src="<?php echo e(asset('/template/assets/js/slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('/template/assets/js/alertify.js')); ?>"></script>
<script src="<?php echo e(asset('/template/assets/js/parsley.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('template/assets/js/alertify.js')); ?>"></script>
<!--Beyond Scripts-->
<script src="<?php echo e(asset('/template/assets/js/beyond.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/assets/js/validation/bootstrapValidator.js')); ?>" type="text/javascript"></script>

<!--Page Related Scripts-->
<!--Sparkline Charts Needed Scripts-->
<script src="<?php echo e(asset('/template/assets/js/charts/sparkline/jquery.sparkline.js')); ?>"></script>
<script src="<?php echo e(asset('/template/assets/js/charts/sparkline/sparkline-init.js')); ?>"></script>

<!--Easy Pie Charts Needed Scripts-->
<script src="<?php echo e(asset('/template/assets/js/charts/easypiechart/jquery.easypiechart.js')); ?>"></script>
<script src="<?php echo e(asset('/template/assets/js/charts/easypiechart/easypiechart-init.js')); ?>"></script>

<!--Flot Charts Needed Scripts-->

<script src="<?php echo e(asset('/template/assets/js/datetime/moment.js')); ?>"></script>
<script src="<?php echo e(asset('/template/assets/js/datetime/bootstrap-datepicker.js')); ?>"></script>

<script src="<?php echo e(asset('/template/assets/js/validation/bootstrapValidator.js')); ?>"></script>

<script src="<?php echo e(asset('template/assets/js/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('/template/assets/js/editors/summernote/summernote.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
<?php echo $__env->yieldContent('page-script'); ?>

</body>
</html>
<?php /**PATH D:\DaoTao\WorkingReport\trunk\20.SourceCode\resources\views/layouts/app.blade.php ENDPATH**/ ?>