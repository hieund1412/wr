<script src="<?php echo e(asset('/template/assets/js/fusioncharts/fusioncharts.js')); ?>"></script>
<script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<script src="<?php echo e(asset('/template/assets/js/fusioncharts/fusioncharts.theme.fusion.js')); ?>"></script>

<?php $__env->startSection('title', 'Thống kê theo nhân viên'); ?>

<?php $__env->startSection('body'); ?>

<div class="page-content">
    <div class="page-header position-relative">
        <div class="header-title"><h1>Thống kê</h1></div>
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
    
    <div class="page-body"><div class="row">    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="row">
            <div class="wrapper"><div class="row">
    
            <div class="col-xs-12 col-md-12">
              <div class="widget">
                <div class="widget-header" style="height: 60px">
                    <span class="widget-caption">Thống kê theo nhân viên</span>
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
                  <!--<form id="registrationForm" method="post" class="" data-bv-message="This value is not valid">-->
                    <div id="search" class="row">
                      <div id="search-condition-1" class="col-md-5">
                            <div id="search-date" class="form-group minHeight">
                                <label class="col-lg-3 col-form-label">Thời gian<span style="color: red">*</span>:</label>                                    
                                <div class="col-lg-9"><div class="input-group">
                                    <span class="input-group-addon">Từ</span>
                                    <input type="text" class="form-control" id="start-date"
                                           value="<?php echo e(\Carbon\Carbon::now()->addDay(-7)->format('d/m/Y')); ?>"
                                           data-bv-notempty="true"
                                           data-bv-notempty-message="Start date is required and cannot be empty">
                                    <span class="input-group-addon">Đến</span>
                                    <input type="text" class="form-control" id="end-date"
                                           value="<?php echo e(\Carbon\Carbon::now()->addDay(-1)->format('d/m/Y')); ?>"
                                           data-bv-notempty="true"
                                           data-bv-notempty-message="End date is required and cannot be empty">
                                </div></div>
                                <h5 class="validate-date validate"></h5>
                            </div>
                            <div id="search-block" class="form-group minHeight">
                                <label class="col-lg-3 col-form-label">Khối thực hiện<span style="color: red">*</span>:</label>
                                <div class="col-lg-9">
                                    <select id="block" class="form-control">
                                        <option value="">---Chọn Khối---</option>
                                        <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($option->id); ?>"><?php echo e($option->block_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <h5 class="validate-block validate"></h5>
                            </div>
                      </div>
                      <div id="search-condition-2" class="col-md-5">
                            <div id="search-department" class="form-group minHeight">
                                <label class="col-lg-3 col-form-label">Phòng<span style="color: red">*</span>:</label>
                                <div class="col-lg-9">
                                    <select id="department"  class="form-control">
                                        <option value="" selected>---Chọn Phòng---</option>
                                    </select>
                                </div>
                                <h5 class="validate-department validate"></h5>
                            </div>
                            <div id="search-user" class="form-group minHeight">
                                <label class="col-lg-3 col-form-label">Nhân viên<span style="color: red">*</span>:</label>
                                <div class="col-lg-9">
                                    <select id="user" class="form-control">
                                        <option value="" selected >---Chọn Nhân Viên---</option>
                                    </select>
                                </div>
                                <h5 class="validate-name validate"></h5>
                            </div>
                        </div>
                      <div id="search-button" class="col-md-1">
                         <button type="submit" class="btn btn-primary" id="submit" data-toggle="search"> Tra cứu </button>
                      </div>
                    </div>
                    <!--</form>-->

                    <div id="work-content-area" style="float:left">
                    </div>
                    <div id="project-area" style="float:left">
                    </div>
                    <div id="relate-block-area" style="float:left">
                    </div>
                    <div id="data-area">
                    <?php if(!empty($data)): ?>
                    <?php echo $__env->make('statistic::statistic_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    </div>
                </div>
              </div>
            </div>
        </div></div>
     </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!--
    <style>
        .wrapper {
            margin-left: 18%;
        }
        #search {
            width: 100%;
            height: 100px;
        }
        #search-condition-1 {
            width: 100%;
            height: 50%;
        }
        #search-condition-2 {
            width: 100%;
            height: 50%;
            padding-top: 0.5%;
        }
        #search-date {
            float: left;
            width: 55%;
            height: 100%;
        }
        #search-block {
            float: left;
            width: 35%;
            height: 100%;
            padding-left: 15px;
        }
        #search-department {
            float: left;
            width: 55%;
            height: 100%;
         }
        #search-user {
            float: left;
            width: 35%;
            height: 100%;
            padding-left: 15px;
        }
        #search-button {
            float: right;
            width: 10%;
            height: 100%;
        }
        .input-group {
            padding-left: 10px;
        }
    </style>
-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    
    <script>
        $(document).ready(function () {
            var to_date = new Date();
            $('#start-date').datepicker({format: 'dd/mm/yyyy', showClose: true, endDate: to_date});
            $('#end-date').datepicker({format: 'dd/mm/yyyy', showClose: true, endDate: to_date});
        });

        $('#start-date, #end-date').on('change', function () {
            var start_date = $('#start-date').val();
            var start_date_array = start_date.split('/');
            var new_start_date = new Date(start_date_array[2], start_date_array[1] - 1, start_date_array[0]);
            var end_date_limit = new Date(new_start_date.getTime() + (24 * 30 * 3600 * 1000));
            var end_date_select = $('#end-date').val();
            if (end_date_select !== '') {
                var end_date_array = end_date_select.split('/');
                var new_end_date = new Date(end_date_array[2], end_date_array[1] - 1, end_date_array[0]);
                if (new_end_date > end_date_limit) {
                    alert('Khoảng thời gian không được nhập quá 31 ngày')
                }
            }
        });

        $('#block').change(function () {
            var block_id = $(this).val();
            $.ajax({
                type: 'post',
                url: '<?php echo e(route('Statistic.get-data')); ?>',
                data: {block_id: block_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var option_department = new Option('---Chọn Phòng---', '');
                    var option_fullname = new Option('---Chọn Nhân Viên---', '');
                    if (data.length !== 0) {
                        $('#department').attr('disabled', false).empty().append(option_department);
                        data.forEach(function (i) {
                            var option = new Option(i['department_name'], i['id']);
                            $('#department').append(option);
                        })
                    } else {
                        $('#department').attr('disabled', true).empty().append(option_department);
                    }
                    $('#user').empty().append(option_fullname);
                }
            })
        });
        $('#department').change(function () {
            var block_id = $('#block').val();
            var department_id = $('#department').val();
           $.ajax({
               type: 'post',
               url: '<?php echo e(route('Statistic.get-data')); ?>',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               data: {block_id: block_id, department_id: department_id},
               success:function (data) {
                   var option_user = new Option('---Chọn Nhân Viên---','');
                   $('#user').attr('disabled',false).empty().append(option_user);
                   data.forEach(function (i) {
                     var option = new Option(i['fullname'], i['user_login']);
                     $('#user').append(option);
                   })
               }
           })
        });
        $('#submit').click(function () {
            //if (!start_date) {
                var flag = true;
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var block = $('#block').val();
                var department = $('#department').val();
                var fullname = $('#user').val();
                if (start_date.trim() === '') {
                    $('#start-date').css('border-color', 'red');
                    $('.validate-date').html('Thời gian không được để trống');
                    flag = false
                } else {
                    $('#start-date').css('border-color', '');
                    $('.validate-date').html('');
                }
                if (end_date.trim() === '') {
                    $('#end-date').css('border-color', 'red');
                    $('.validate-date').html('Thời gian không được để trống');
                    flag = false
                } else {
                    $('#end-date').css('border-color', '');
                    $('.validate-date').html('');
                }
                if (block === '') {
                    $('#block').css('border-color', 'red');
                    $('.validate-block').html('Khối không được để trống');
                    flag = false
                } else {
                    $('#block').css('border-color', '');
                    $('.validate-block').html('');
                }
                if (department === '') {
                    $('#department').css('border-color', 'red');
                    $('.validate-department').html('Phòng ban không được để trống');
                    flag = false
                } else {
                    $('#department').css('border-color', '');
                    $('.validate-department').html('');
                }
                if (fullname === '') {
                    $('#user').css('border-color', 'red');
                    $('.validate-name').html('Nhân viên không được để trống');
                    flag = false
                } else {
                    $('#user').css('border-color', '');
                    $('.validate-name').html('');
                }
                if (flag) {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo e(route("Statistic.search-data")); ?>',
                        data: {
                            start_date: start_date,
                            end_date: end_date,
                            block: block,
                            department: department,
                            fullname: fullname
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            $('#data-area').html(data);
                        }
                    })
                }
            //}
            //else{}
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DaoTao\WorkingReport\trunk\20.SourceCode\Modules\Statistic\Providers/../Resources/views/statistic_employees.blade.php ENDPATH**/ ?>