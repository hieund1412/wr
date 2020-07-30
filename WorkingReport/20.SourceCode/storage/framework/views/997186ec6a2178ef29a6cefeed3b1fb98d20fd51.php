<?php $__env->startSection('title', 'Tạo mới người dùng'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .dataTables_info, .dataTables_length {
            display: none;
        }
        select{
            width:100%;
        }
        .form-group {
            margin-top:10%;
        }
        .modal-footer{
            margin-top:5%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<div class="page-content">
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Tạo mới nhân viên
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
    <div class="widget-header ">
        <span class="widget-caption">Tạo mới người dùng</span>
            <div class="widget-buttons">
                <a href="#" data-toggle="maximize">
                    <i class="fa fa-expand"></i>
                </a>
                <a href="#" data-toggle="collapse">
                    <i class="fa fa-minus"></i>
                </a>
                <a href="#" data-toggle="dispose">
                    <i class="fa fa-times"></i>
                </a>
            </div>
    </div>
    <div class="widget-body">
        <form action="<?php echo e(route('users.insert')); ?>" method="post" id="insertUser"
              class="form-horizontal"
              data-bv-message="This value is not valid"
              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group" style="margin-top:5%">
                        <label for="user_login" class="col-lg-4 col-form-label">Tên đăng nhập <span style="color:red">*</span> :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control"
                                   id="user_login"
                                   name="user_login"
                                   data-bv-message="Tên không hợp lệ"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="Tên đăng nhập không được để trống"
                                   data-bv-regexp="true"
                                   data-bv-regexp-regexp="^[a-zA-Z0-9]+$"
                                   data-bv-regexp-message="Tên đăng nhập nhập không đúng giá trị là kí tự và số"
                                   data-bv-stringlength="true"
                                   data-bv-stringlength-min="3"
                                   data-bv-stringlength-max="30"
                                   data-bv-stringlength-message="Tên đăng nhập nhập giá trị không trong khoảng 3 - 30 kí tự">
                            <span id="validate-user-login" style="color: red"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name-depart"
                               class="col-lg-4 col-form-label">Họ tên <span style="color:red">*</span> :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control"
                                   id="recipient-name-depart"
                                   name="fullname"
                                   data-bv-message="Họ tên không hợp lệ"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="Họ tên không được để trống"
                                   data-bv-regexp="true"
                                   data-bv-regexp-regexp="^([A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪ
                                   a-zàáâãèéêếìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ0-9 ]+?)+$"
                                   data-bv-regexp-message="Họ tên nhập không đúng giá trị là kí tự và số"
                                   data-bv-stringlength="true"
                                   data-bv-stringlength-min="3"
                                   data-bv-stringlength-max="30"
                                   data-bv-stringlength-message="Họ tên nhập giá trị không trong khoảng 3 - 30 kí tự">
                            <span id="validate-user-name" style="color: red"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-lg-4 col-form-label">Khối <span style="color:red">*</span> :</label>
                        <div class="col-lg-8">
                            <select name="block_id" id="block" class="form-control" data-bv-notempty="true"
                                    data-bv-notempty-message="Khối không được để trống">
                                <option disabled="disabled" selected="selected" value="">---Chọn Khối---</option>
                                <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->block_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span id="validate-block-name" style="color: red"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="col-lg-4 col-form-label">Phòng ban <span style="color:red">*</span> :</label>
                        <div class="col-lg-8">
                            <select name="department_id" id="department" class="form-control"
                                    data-bv-notempty="true"
                                    data-bv-notempty-message="Phòng ban không được để trống">
                                <option disabled="disabled" selected="selected" value="">
                                    ---Chọn Phòng ban---
                                </option>
                            </select>
                            <span id="validate-department-name" style="color: red"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="form-group" style="margin-top: 5%">
                        <label for="role_id" class="col-lg-4 col-form-label">Vai trò <span style="color:red">*</span> :</label>
                        <div class="col-lg-8">
                            <select name="role_id" id="role_id" class="form-control" data-bv-notempty="true"
                                    data-bv-notempty-message="Vai trò không được để trống">
                                <option disabled="disabled" selected="selected" value="">---Chọn Vai trò---</option>
                                <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->role_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span id="validate-role-name" style="color: red"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-lg-4 col-form-label">Nhóm quyền <span style="color:red">*</span> :</label>
                        <div class="col-lg-8">
                            <select name="permission" id="permission" class="form-control" data-bv-notempty="true"
                                    data-bv-notempty-message=" Nhóm quyền không được để trống">
                                <option disabled="disabled" selected="selected" value="">---Chọn Nhóm quyền---</option>
                                <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->permission_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span id="validate-permission-name" style="color: red"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name-departs"
                               class="col-lg-4 col-form-label">Email <span style="color:red">*</span> :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control"
                                   id="recipient-name-departs"
                                   value=""
                                   name="email"
                                   data-bv-emailaddress="true"
                                   data-bv-emailaddress-message="Nhập không đúng định dạng địa chỉ mail"
                                   data-bv-regexp="true"
                                   data-bv-regexp-regexp="^([a-zA-Z][a-z0-9_\.]{2,31})@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="Email không được để trống">
                            <span id="validate-email-name" style="color: red"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" >
                <div align="center">
                <button type="button" onclick="checkEmail()" class="btn btn-info btn-fill btn-wd" style="margin-right:5%;">Tạo mới</button>
                <a href="<?php echo e(route('users.index')); ?>">
                    <button type="button" class="btn btn-danger " data-dismiss="modal" >Quay lại</button>
                </a>
                </div>
            </div>
        </form>
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
        $(document).ready(function () {
            $("#insertUser").bootstrapValidator();
        });

        $('#block').change(function () {
            var block_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('users.ajax-get-data')); ?>',
                data: {type: 'block', block_id: block_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var option_department = new Option('---Chọn Phòng Ban---', '');
                    if (data.length !== 0) {
                        $('#department').attr('disabled', false).empty().append(option_department);
                        data.forEach(function (i) {
                            var option = new Option(i['department_name'], i['id']);
                            $('#department').append(option)
                        })
                    } else {
                        $('#department').empty().append(option_department);
                    }
                }
            })
        });
        function checkEmail() {
            var flag = true;
            var user_name = $('#recipient-name-depart').val();
            var block_name = document.getElementById('block');
            var block_name_option = block_name.options[block_name.selectedIndex].value;
            var depart = document.getElementById('department');
            var depart_option = depart.options[depart.selectedIndex].value;
            var role = document.getElementById('role_id');
            var role_option = role.options[role.selectedIndex].value;
            var permission = document.getElementById('permission');
            var permission_option = permission.options[permission.selectedIndex].value;
            var user_login_check = $('#user_login').val();
            var id_check = $('#id_check').val();
            var email = $('#recipient-name-departs').val();
            if (user_login_check.trim() === '') {
                $('#user_login').css('border-color', 'red');
                $('#validate-user-login').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else if (user_login_check.length > 256) {
                $('#user_login').css('border-color', 'red');
                $('#validate-user-login').html('Không được quá 256 kí tự');
                flag = false
            } else if (!user_login_check.match(/^[a-zA-Z0-9]+$/)) {
                $('#user_login').css('border-color', 'red');
                $('#validate-user-login').html('Chỉ được nhập chữ và số');
                flag = false
            } else {
                $('#permission_name').css('border-color', '');
                $('#validate-user-login').html('');
            }
            if (user_name.trim() === '') {
                $('#recipient-name-depart').css('border-color', 'red');
                $('#validate-user-name').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#recipient-name-depart').css('border-color', '');
                $('#validate-user-name').html('');
            }
            if (block_name_option === '') {
                $('#block').css('border-color', 'red');
                $('#validate-block-name').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#block').css('border-color', '');
                $('#validate-block-name').html('');
            }
            if (depart_option === '') {
                $('#department').css('border-color', 'red');
                $('#validate-department-name').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#depart').css('border-color', '');
                $('#validate-department-name').html('');
            }
            if (role_option === '') {
                $('#role_id').css('border-color', 'red');
                $('#validate-role-name').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#role_id').css('border-color', '');
                $('#validate-role-name').html('');
            }
            if (permission_option === '') {
                $('#permission').css('border-color', 'red');
                $('#validate-permission-name').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#permission').css('border-color', '');
                $('#validate-permission-name').html('');
            }
            if (email.trim() === '') {
                $('#recipient-name-departs').css('border-color', 'red');
                $('#validate-email-name').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#recipient-name-departs').css('border-color', '');
                $('#validate-email-name').html('');
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('users.ajax-check-email')); ?>',
                    data: {email: email, id_check: id_check, user_login_check: user_login_check},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.message);
                        if (data.status === 'success') {
                            document.getElementById('insertUser').submit()
                        }
                    }
                })
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WorkingReport\20.SourceCode\Modules\Users\Providers/../Resources/views/form_insert.blade.php ENDPATH**/ ?>