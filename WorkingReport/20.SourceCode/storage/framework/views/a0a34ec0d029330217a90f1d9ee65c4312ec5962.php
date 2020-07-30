<script src="<?php echo e(asset('/template/assets/js/fusioncharts/fusioncharts.js')); ?>"></script>
<script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<script src="<?php echo e(asset('/template/assets/js/fusioncharts/fusioncharts.theme.fusion.js')); ?>"></script>

<?php $__env->startSection('title', 'Thống kê theo dự án'); ?>

<?php $__env->startSection('body'); ?>
    <div class="page-content">
        <div class="page-header position-relative">
            <div class="header-title">
                <h1>
                    Thống kê
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
                                        <div class="widget-header " style="height: 60px">
                                            <span class="widget-caption">Thống kê theo dự án</span>
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
                                        <div class="widget-body ">
<!--                                            -->
                                            <div id="search" class="row">
                                                <div id="search-condition-1" class="col-md-5">
                                                    <div id="search-date" class="form-group minHeight">
                                                        <label class="col-lg-3 col-form-label">Thời gian<span style="color: red">*</span>:</label>
                                                        <div class="col-lg-9"><div class="input-group">
                                                            <span class="input-group-addon"><label for="from-date">Từ</label></span>
                                                            <input type="text" class="form-control" id="from-date"
                                                                   value="<?php echo e(\Carbon\Carbon::now()->addDay(-7)->format('d/m/Y')); ?>"
                                                                   data-bv-notempty="true"
                                                                   data-bv-notempty-message="Start date is required and cannot be empty">
                                                            <span class="input-group-addon"><label for="to-date">Đến</label></span>
                                                            <input type="text" class="form-control" id="to-date"
                                                                   value="<?php echo e(\Carbon\Carbon::now()->addDay(-1)->format('d/m/Y')); ?>"
                                                                   data-bv-notempty="true"
                                                                   data-bv-notempty-message="End date is required and cannot be empty">
                                                        </div></div>
                                                        <h5 class="validate-from-date validate"></h5>
                                                        <h5 class="validate-max-date validate"></h5>
                                                        <h5 class="validate-to-date validate"></h5>
                                                    </div>
                                                    <div id="search-block" class="form-group minHeight">
                                                        <label class="col-lg-3 col-form-label">Khối thực hiện<span style="color: red">*</span>:</label>
                                                        <div class="col-lg-9">
                                                            <select id="block-name" class="form-control">
                                                                <option value="" selected>---Chọn khối---</option>
                                                                <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option_block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($option_block->block_name); ?>"><?php echo e($option_block->block_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <h5 class="validate-block validate"></h5>
                                                    </div>
                                                </div>
                                                <div id="search-condition-2" class="col-md-5" style="margin-top: 10px;">
                                                    <div id="search-relate-block" class="form-group minHeight">
                                                        <label class="col-lg-3 col-form-label" for="relate-block">Khối liên quan:</label>
                                                        <div class="col-lg-9">
                                                            <select id="relate-block" class="form-control">
                                                                <option selected value="">---Chọn Khối liên quan---</option>
                                                                <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option_block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($option_block->block_name); ?>"><?php echo e($option_block->block_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="search-user" class="form-group minHeight">
                                                        <label class="col-lg-3 col-form-label" for="project-name">Tên dự án:</label>
<!--
                                                        
                                                            
                                                                
                                                                        
                                                                
                                                            
                                                        
-->

                                                        <div class="col-lg-9">
                                                            <select id="project-name" multiple class="form-control">
                                                                <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($option_project->id); ?>"><?php echo e($option_project->project_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                                <div id="search-button" class="col-md-2">
                                                        <button class="btn btn-primary" id="submit" data-toggle="search" onclick="submitSearch();"> Tra cứu </button>
                                                    </div>
                                            </div>
                                            <div id="project-name-area" style="float:left; margin:10px"></div>

                                            <div id="relate-block-area" style="float:left; margin:10px"></div>

                                            <div id="corporation-name-area" style="float:left; margin:10px"></div>
<!--                                            -->
                                            <div id="table-data">
                                                <?php if(!empty($data)): ?>
                                                <?php echo $__env->make('statiscalproject::statistic_project_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
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

<?php $__env->startSection('css'); ?>
<!--
    <style>
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
        #search-relate-block {
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
        #project-name {
            min-width: 100px;
        }
    </style>
-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        $("document").ready(function() {
            var from_date = new Date();
            $('#from-date').datepicker({format: 'dd/mm/yyyy', autoClose: true, endDate: from_date});
            $('#to-date').datepicker({format: 'dd/mm/yyyy', autoClose: true, endDate: from_date});
            delayLoadMultiMenu();
        });

        function submitSearch() {
            //if (!start_date) {
                var flag = true;
                var from_date = $('#from-date').val();
                var to_date = $('#to-date').val();
                var block_name = $('#block-name').val();
                var relate_block = $('#relate-block').val();
                var project_name = $('#project-name').val();
                // split the date into days, months, years array
                var newFromDate = from_date.split('/')
                var newToDate = to_date.split('/')

                // create date objects using year, month, day
                var objFromDate = new Date(newFromDate[2],newFromDate[1],newFromDate[0]);
                var objToDate = new Date(newToDate[2],newToDate[1],newToDate[0]);

                // calculate difference between dayes
                var dateDiff = ( objToDate - objFromDate ) / (1000 * 60 * 60 * 24);

                if (from_date.trim() === '') {
                    $('#from-date').css('border-color', 'red');
                    $('.validate-from-date').html('Vui lòng nhập thông tin');
                    flag = false
                } else {
                    $('#from-date').css('border-color', '');
                    $('.validate-from-date').html('');
                }
                if (to_date.trim() === '') {
                    $('#to-date').css('border-color', 'red');
                    $('.validate-to-date').html('Vui lòng nhập thông tin');
                    flag = false
                } else {
                    $('#to-date').css('border-color', '');
                    $('.validate-to-date').html('');
                }
                if (dateDiff > 31) {
                    $('#from-date').css('border-color', 'red');
                    $('#to-date').css('border-color', 'red');
                    $('.validate-max-date').html('Không được quá 31 ngày');
                    flag = false
                } else {
                    $('#from-date').css('border-color', '');
                    $('#to-date').css('border-color', '');
                    $('.validate-max-date').html('');
                }
                if (block_name === '') {
                    $('#block-name').css('border-color', 'red');
                    $('.validate-block').html('Vui lòng nhập thông tin');
                    flag = false
                } else {
                    $('#block-name').css('border-color', '');
                    $('.validate-block').html('');
                }
                if (flag) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo e(route("statiscalProject.search-data")); ?>',
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            block_name: block_name,
                            relate_block: relate_block,
                            project_name: project_name
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            $('#table-data').html(data);
                        }
                    })
                }
        }
        function delayLoadMultiMenu() {
            setTimeout(function(){
                $("#project-name").select2({
                    placeholder: "Chọn 1 hoặc nhiều dự án",
                    allowClear: true
                });
            }, 1000);
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WorkingReport\20.SourceCode\Modules\StatiscalProject\Providers/../Resources/views/statistic_project.blade.php ENDPATH**/ ?>