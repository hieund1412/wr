<?php $__env->startSection('title', 'Tạo mới báo cáo công việc'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        th{
            text-align: center;
        }
        td{
            text-align: center;
        }
        .flash{
            color: red;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<div class="page-content">
<div class="page-header position-relative">
    <div class="header-title">
        <h1>Báo cáo công việc</h1>
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
        <span class="widget-caption">Tạo mới báo cáo công việc</span>
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
    <form action="<?php echo e(route('report.insert')); ?>" method="post" id="report_form">
        <input type="hidden" name="listIdWorkingReport" value="<?php echo e($listIdWorkingReport); ?>" id="list-id-report">
        <?php echo csrf_field(); ?>
        <div class="widget-body">
            <div class="form-inline time-rp">
                <div class="form-group"><b>NGÀY BÁO CÁO</b> <span style="color:red">*</span></div>
                <div class="form-group">
                    <div class="input-group " data-provide="date-picker">
                        <input  class="form-control date-picker" name="work_date" id="work_date"
                               type="text" data-bv-notempty="true"
                                data-bv-notempty-message="Ngày báo cáo không được để trống" value="<?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?>">
                        <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <a class="btn btn-default" href="<?php echo e(route('report.getDataReportLatest')); ?>">Lấy lại report cũ</a>
            </div>
            <div><span class="mess_text_error"></span></div>
            <?php echo $__env->make('layouts.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div>
                <table class="table table-hover table-responsive table-striped tableH"
                       id="table_report">
                    <thead>
                    <tr role="row">
                        <th width= "3%">STT</th>
                        <th width= "8%">Khối<br>liên quan <span style="color:red">*</span></th>
                        <th width= "12%">Tên dự án <span style="color:red">*</span></th>
                        <th width= "25%">Nội dung công việc<span style="color:red">*</span></th>
                        <th width= "10%">Loại công việc <span style="color:red">*</span></th>
                        <th width= "7%">Thời gian<span style="color:red"> *</span><br>(h)</th>
                        <th width= "7%">Hiện trạng <span style="color:red">*</span> (%)</th>
                        <th width= "7%">Mục tiêu</th>
                        <th width= "7%">Kết quả</th>
                        <th width= "5%">Có trễ không</th>
                        <th width= "5%">Hành động</th>
                    </tr>
                    </thead>
                    <tbody id="row-report">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $user = (array)$user ?>
                        <tr class="flash" style="border: <?php echo e(in_array($key + 1, $validate_fail_array) ? 'solid' : ''); ?>">
                            <td class="stt" style="text-align: center;color: black"> <?php echo e($key+1); ?> </td>
                            <td>
                                <div class="form-group">
                                <select class="relate_block" name="relate_block[]" id="relate_block_<?php echo e($key+1); ?>"
                                            style="width:100%" data-bv-notempty="true"  >
                                    <option value="" selected >Chọn</option>
                                    <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($bl->id); ?>" <?php if($user['relate_block'] == $bl->id): ?>
                                    selected
                                            <?php endif; ?>><?php echo e($bl->block_name); ?></option>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <select class="project_id" id="project_id_<?php echo e($key+1); ?>" style="width:100%" name="project_id[]" data-bv-notempty="true">
                                    <option value="" selected >Chọn</option>
                                    <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($pj->id); ?>"
                                            <?php if($user['project_id'] == $pj->id): ?>
                                                selected
                                            <?php endif; ?>
                                        ><?php echo e($pj->project_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <textarea type="text" class="form-control work_content" id="work_content_<?php echo e($key+1); ?>"
                                       name="work_content[]" style="width: 100%;height:100%"
                                          placeholder="Nhập nội dung công việc"><?php echo e($user['work_content']); ?></textarea>
                                    <p id="message_error_content_<?php echo e($key); ?>"></p>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <select class="work_type" style="width:100%" name="work_type[]" id="work_type_<?php echo e($key+1); ?>" data-bv-notempty="true">
                                    <option value="" selected >Chọn</option>
                                    <?php $__currentLoopData = $job; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jobs->id); ?>" <?php if($user['work_type'] == $jobs->id): ?> selected <?php endif; ?>>
                                        <?php echo e($jobs->job_type); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <input type="text" name="execute_time[]" class="form-control execute_time" id="execute_time_<?php echo e($key+1); ?>"
                                       value="<?php echo e($user['execute_time']); ?>" style="width: 100%;height:100%" placeholder="Nhập thời gian thực hiện">
                                    <p id="message_error_time_<?php echo e($key); ?>"></p>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <input type="text" name="progress[]" class="form-control progress" id="progress_<?php echo e($key+1); ?>"
                                       value="<?php echo e($user['progress']); ?>" style="width: 100%;height:100%" placeholder="Nhập %">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="target[]" class="form-control target" id="target_<?php echo e($key+1); ?>"
                                    value="<?php echo e($user['target']); ?>" style="width: 100%;height:100%">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="result[]" class="form-control result" id="result<?php echo e($key+1); ?>"
                                           value="<?php echo e($user['result']); ?>" style="width: 100%;height:100%">
                                </div>
                            </td>
                            <td >
                                <div class="checkbox" style="text-align: center">
                                    <label>
                                        <input type="checkbox" class="colored-blue late" name="late[]" id="late_<?php echo e($key+1); ?>"
                                        <?php if($user['late'] == 1): ?>
                                            checked
                                        <?php endif; ?> value="1" >
                                        <span class="text" ></span>
                                    </label>
                                </div>
                            </td>
                            <td style="text-align: center">
                                <a href="#" class="btn btn-danger btn-xs delete"
                                   data-toggle="modal">
                                    <i class="fa fa-trash-o"></i>&nbsp;&nbsp;Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tr>
                        <td colspan="10"></td>
                        <td>
                            <a class="btn btn-info btn-xs edit" id="add-row-report">
                                <i class="fa fa-plus"></i> Thêm</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <textarea class="col-xs-12" name="note"
                                      id="note" cols="100" rows="5"
                                      placeholder="*Các nội dung khác(vấn đề, lo lắng, liên lạc,...)"><?php echo e(isset($note) ? $note : ''); ?></textarea>
                            <p id="message_error_validate"></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="table-toolbar" style="text-align: center">
                <button id="insert_report"
                   class="btn btn-submit btn-info"
                   type="submit" >
                    Tạo báo cáo
                </button>
            </div>
        </div>
    </form>
    <div class="widget-body">
        <b>CÔNG VIỆC CHƯA HOÀN THÀNH</b>
        <table class="table table-striped table-hover table-bordered table-responsive"
               id="table_report">
            <thead>
            <tr role="row">
                <th width="3%">STT</th>
                <th width="7%">Ngày</th>
                <th width="10%">Họ tên</th>
                <th width="5%">Khối liên quan</th>
                <th width="12%">Tên dự án</th>
                <th width="30%">Nội dung công việc</th>
                <th width="8%">Loại công việc</th>
                <th width="5%">Thời gian</th>
                <th width="5%">Hiện trạng</th>
                <th width="7%">Mục tiêu</th>
                <th width="7%">Kết quả</th>
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key +1); ?></td>
                        <td><?php echo e(date('d-m-Y', strtotime($data->work_date))); ?></td>
                        <td><?php echo e($data->fullname); ?></td>
                        <td><?php echo e($data->relation_block); ?></td>
                        <td><?php echo e($data->project_name); ?></td>
                        <td><?php echo e($data->work_content); ?></td>
                        <td><?php echo e($data->job_type); ?></td>
                        <td><?php echo e($data->execute_time); ?></td>
                        <td><?php echo e($data->progress); ?>%</td>
                        <td><?php echo e($data->target); ?></td>
                        <td><?php echo e($data->result); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
    </div></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function getMonday(d) {
            d = new Date(d);
            var day = d.getDay();
            var diff = d.getDate() - day + (day == 0 ? -6:1); // adjust when day is sunday
            return new Date(d.setDate(diff));
        }

        $(document).ready(function() {
            var monday = getMonday(new Date);
            var d = new Date();
            var day = d.getDay();
            if (monday.getDay() == d.getDay()) {
            $(".date-picker").datepicker({
                format: 'dd/mm/yyyy',
                startDate: '-3d',
                endDate: '0d',
                autoclose: 1
            });
            } else {
                $(".date-picker").datepicker({
                    format: 'dd/mm/yyyy',
                    startDate: '-1d',
                    endDate: '0d',
                    autoclose: 1
                });
            }
            $(".date-picker").keydown(false);
            $(".relate_block").select2();
            $(".project_id").select2();
            $(".work_type").select2();
            showDialogConfirm();
        });

        function showDialogConfirm () {
            var listId = $("#list-id-report").val();
            if ((listId && listId.length)) {
                if (confirm("Ngày báo cáo đã tồn tại, Bạn có muốn gửi lại báo cáo?")) {
                    // submit về server để insert đè
                    $("#report_form").attr('action', '<?php echo e(route("report.insert-working-report")); ?>');
                    $("#report_form").submit();
                }
            }
        }

        var rowReport = $('#row-report');
        var i = $('#row-report tr').size();
        $('#add-row-report').on('click', function () {
            if (i < 10) {
                i++;
                rowReport.append('<tr>'
                    + '<td class="stt" style="text-align: center">' + i + '</td>'
                    + '<td> <div class="form-group"> '
                    + '<select class="relate_block" name="relate_block[]" id="relate_block_<?php echo e($key+1); ?>" style="width:100%" data-bv-notempty="true" data-bv-notempty-message="Khối liên quan không được để trống">"'
                    + '" <option value="" selected >Chọn</option>'
                    + <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<option value="<?php echo e($bl->id); ?>" <?php if($user['relate_block'] == $bl->id): ?> selected <?php endif; ?>><?php echo e($bl->block_name); ?></option> '
                    + <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        '</select>'
                    + '</div> </td>'
                    + '<td> <div class="form-group">'
                    + '<select class="project_id" id="project_id_<?php echo e($key+1); ?>" style="width:100%" name="project_id[]" data-bv-notempty="true" data-bv-notempty-message="Tên dự án không được để trống">'
                    + '<option value="" selected >Chọn</option>'
                    + <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<option value="<?php echo e($pj->id); ?>" <?php if($user['project_id'] == $pj->id): ?> selected <?php endif; ?> ><?php echo e($pj->project_name); ?></option>'
                    + <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        '</select>'
                    + '</div> </td> '
                    + '<td> <div class="form-group"> '
                    + '<textarea type="text" class="form-control work_content" id="work_content_<?php echo e($key+1); ?>"\n' +
                    '                                       name="work_content[]" style="width: 100%;height:100%"\n' +
                    '                                          placeholder="Nhập nội dung công việc"><?php echo e($user["work_content"]); ?></textarea> </div> </td> <td> <div class="form-group"> <select class="work_type" name="work_type[]" id="work_type_<?php echo e($key+1); ?>" style="width:100%" data-bv-notempty="true" data-bv-notempty-message="Loại công việc không được để trống"> <option value="" selected >Chọn</option>'
                    + <?php $__currentLoopData = $job; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<option value="<?php echo e($jobs->id); ?>"><?php echo e($jobs->job_type); ?></option>'
                    + <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        '</select>'
                    + '</div> </td> '
                    + '<td> <div class="form-group">'
                    + '<input type="text" name="execute_time[]" class="form-control execute_time" id="execute_time_<?php echo e($key+1); ?>" value="<?php echo e($user['execute_time']); ?>" style="width: 100%;height:100%" placeholder="Nhập thời gian thực hiện" data-bv="true" min="0" data-bv-greaterthan-inclusive="false" max="24" data-bv-lessthan-inclusive="true" data-bv-lessthan-message="Thời gian nhập giá trị số không trong khoảng từ 0 đến 24" data-bv-notempty="true" data-bv-notempty-message="Thời gian không được để trống"> '
                    + '</div> </td> '
                    + '<td> <div class="form-group"> '
                    + '<input type="text" name="progress[]" class="form-control progress" id="progress_<?php echo e($key+1); ?>" value="<?php echo e($user['progress']); ?>" style="width: 100%;height:100%" placeholder="Nhập %" data-bv="true" min="0" data-bv-greaterthan-inclusive="false" max="100" data-bv-lessthan-inclusive="true" data-bv-lessthan-message="Hiện trạng phải trong khoảng từ 0 đến 100" data-bv-notempty="true" data-bv-notempty-message="Hiện trạng không được để trống">'
                    + '</div> </td>'
                    + '<td> <div class="form-group"> '
                    + '<input type="text" name="target[]" class="form-control target" id="target_<?php echo e($key+1); ?>" value="<?php echo e($user['target']); ?>" style="width: 100%;height:100%"> </div> </td> '
                    + '<td> <div class="form-group"> '
                    + '<input type="text" name="result[]" class="form-control result" id="result<?php echo e($key+1); ?>" value="<?php echo e($user['result']); ?>" style="width: 100%;height:100%"> '
                    + '</div> </td>'
                    + '<td > <div class="checkbox" style="text-align: center">'
                    + '<label> <input type="checkbox" class="colored-blue late" name="late[]" id="late_<?php echo e($key+1); ?>" <?php if($user['late'] == 1): ?> checked <?php endif; ?> value="1" > '
                    + '<span class="text" ></span></label>'
                    + ' </div> </td> '
                    + '<td style="text-align: center"> '
                    + '<a href="#" class="btn btn-danger btn-xs delete" data-toggle="modal"> '
                    + '<i class="fa fa-trash-o"></i>Xóa</a>'
                    + '</td></tr>');
                $(".relate_block").select2();
                $(".project_id").select2();
                $(".work_type").select2();
            }
        });
        $(document).on('click', '.delete', function () {
            if (i > 1) {
                $(this).closest('tr').remove();
                i--;
                loadOrder();
            }
        });
        $('#insert_report').click(function() {
            var different_content = $('#note').val();
            var flag = true;
            if(different_content.length >= 1024) {
                $('#message_error_validate').html("Các nội dung khác không vượt quá 1024 ký tự").css("color", "red");
                $('#note').css("border", "2px solid red");
                flag = false;
            }
            $('.work_content').each(function (i) {
                var content = $(this).val();
                if (content != '') {
                    if(content.length > 512) {
                        $('#message_error_content_' + i).html('Nội dung thực hiện không vượt quá 512 ký tự').css("color", "red");
                        $(this).css("border", "2px solid red");
                        flag = false;
                    } else {
                        $('#message_error_content_' + i).html('')
                        $(this).css("border", "");
                    }
                }
            });
            $('.execute_time').each(function (i) {
                var time = $(this).val();
                if(time != '') {
                    if(!validateNumberAndDot(time)) {
                        $('#message_error_time_' + i).html("Thời gian nhập không đúng định dạng giá trị số và dấu chấm").css("color", "red");
                        $(this).css("border", "2px solid red");
                        flag = false;
                    } else if(time < 0 || time > 24) {
                        $('#message_error_time_' + i).html("Thời gian nhập giá trị số không trong khoảng [0-24]");
                        $(this).css("border", "2px solid red");
                        flag = false;
                    } else {
                        $('#message_error_time_' + i).html("");
                        $(this).css("border", "");
                    }
                }
            });
            return flag;
        });

        function loadOrder() {
            var stt = 1;
            $(".stt").each(function() {
                $(this).html(stt++);
            });
        }

        function validateNumberAndDot(time) {
            var re = /^\d+(\.\d+)*$/;
            return re.test(time)
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DaoTao\WorkingReport\trunk\20.SourceCode\Modules\Report\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>