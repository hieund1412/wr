<?php $__env->startSection('title', 'Quản lý người dùng'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .dataTables_info, .dataTables_length {
            display: none;
        }

        #editabledatatable_new {
            background-color: limegreen;
            color: white;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<div class="page-content">
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Quản lý chung
        </h1>
    </div>
    <!--Header Buttons-->
    <div class="header-buttons">
        <a class="sidebar-toggler" href="#">
            <i class="fa fa-arrows-h"></i>
        </a>
        <a class="refresh" id="refresh-toggler" href="">
            <i class="glyphicon glyphicon-refresh"></i>
        </a>
        <a class="fullscreen" id="fullscreen-toggler" href="#">
            <i class="glyphicon glyphicon-fullscreen"></i>
        </a>
    </div>
    <!--Header Buttons End-->
</div>
<div class="page-body">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="row">
<div class="wrapper">

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <span class="widget-caption">Quản lý người dùng</span>
                <div class="widget-buttons">
                    <a href="#" data-toggle="maximize">
                        <i class="fa fa-expand warning"></i>
                    </a>
                    <a href="#" data-toggle="collapse">
                        <i class="fa fa-minus blue"></i>
                    </a>
                    <a href="#" data-toggle="dispose">
                        <i class="fa fa-times danger"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">                
                <div class="form-inline form-filter col-sm-10">
                    <div class="form-group">
                        <label class="control-label">Khối:</label>                        
                        <select class="form-control" name="block_name" id="block">
                            <option value="" selected="selected">---Chọn Khối---</option>
                            <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->block_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phòng:</label>
                        <select class="form-control"  name="department_name" id="department" disabled>
                            <option disabled selected="selected">---Chọn Phòng---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nhân Viên:</label>
                        <select class="form-control"  name="fullname" id="fullname" disabled>
                            <option value="" selected="selected">---Chọn Nhân Viên---</option>
                        </select>
                    </div>
                    <button class="btn btn-default" id="search">Lọc người dùng</button>
                </div>
                <?php if(\Illuminate\Support\Facades\Blade::check('role', 'users.view')): ?>
                    <div style="text-align: right;">
                        <a id="editabledatatable_new" href="<?php echo e(route('users.view')); ?>"
                           class="btn btn-newUser"
                           type="button" ><i class="fa fa-plus"></i>
                            Tạo mới người dùng
                        </a>
                    </div>
                <?php endif; ?>
                <div style="margin-top: 15px">
                <?php echo $__env->make('layouts.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div id="table">
                    <?php echo $__env->make('users::table_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $('#block').change(function () {
            var block_id = $('#block').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('users.ajax-get-data')); ?>',
                data: {type: 'block', block_id: block_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var option_department = new Option('---Chọn Phòng---', '');
                    var option_fullname = new Option('---Chọn Nhân Viên---', '');
                    if (data.length !== 0) {
                        $('#department').removeAttr('disabled').empty().append(option_department);
                        data.forEach(function (i) {
                            var option = new Option(i['department_name'], i['id']);
                            $('#department').append(option)
                        })
                    } else {
                        $('#department').empty().append(option_department);
                    }
                    $('#fullname').empty().append(option_fullname);
                }
            })
        });

        $('#department').change(function () {
            var block_id = $('#block').val();
            var department_id = $('#department').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('users.ajax-get-data')); ?>',
                data: {type: 'department', block_id: block_id, department_id: department_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var option_fullname = new Option('---Chọn Nhân Viên---', '');
                    if (data.length !== 0) {
                        $('#fullname').removeAttr('disabled').empty().append(option_fullname);
                        data.forEach(function (i) {
                            var option = new Option(i['fullname'], i['id']);
                            $('#fullname').append(option)
                        })
                    } else {
                        $('#fullname').empty().append(option_fullname);
                    }
                }
            })
        });

        $('#search').click(function () {
            var fullname = $('#fullname').val();
            var block = $('#block').val();
            var department = $('#department').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('users.ajax')); ?>',
                data: {fullname: fullname, block: block, department: department},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('#table').html(data);
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WorkingReport\20.SourceCode\Modules\Users\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>