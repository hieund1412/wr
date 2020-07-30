<table class="table table-striped table-hover table-bordered" id="table-workflow">
    <thead>
        <tr role="row" class="odd">
            <th style="background-color: darkgrey;width: 1%;text-align: center" >STT</th>
            <th style="background-color: darkgrey;width: 5%;text-align: center" >Ngày</th>
            <th style="background-color: darkgrey;width: 6%;text-align: center" >Khối thực hiện</th>
            <th style="background-color: darkgrey;width: 6%;text-align: center" >Phòng ban</th>
            <th style="background-color: darkgrey;width: 10%;text-align: center" >Họ tên</th>
            <th style="background-color: darkgrey;width: 6%;text-align: center" >Khối liên quan</th>
            <th style="background-color: darkgrey;width: 10%;text-align: center">Tên Dự Án</th>
            <th style="background-color: darkgrey;width: 12%;text-align: center">Nội dung công việc</th>
            <th style="background-color: darkgrey;width: 7%;text-align: center">Loại công việc</th>
            <th style="background-color: darkgrey;width: 5%;text-align: center">Thời gian(h)</th>
            <th style="background-color: darkgrey;width: 5%;text-align: center">Hiện trạng</th>
            <th style="background-color: darkgrey;width: 8%;text-align: center">Mục tiêu</th>
            <th style="background-color: darkgrey;width: 8%;text-align: center">Kết quả</th>
            <th style="background-color: darkgrey;width: 2%;text-align: center">Có trễ?</th>
            <th style="background-color: darkgrey;width: 7%;text-align: center">Vấn đề</th>
            <th style="background-color: darkgrey;width: 2%;text-align: center">Sửa đổi</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!empty($data)): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $value = (array)$value ?>
            <tr role="row" class="odd reloadRow" id="<?php echo e($value['id']); ?>">
                <td style="text-align: center" readonly><?php echo e($key + 1); ?></td>
                <td style="text-align: center"><p style="display: none"><?php echo e(strtotime($value['work_date'])); ?></p><?php echo e(date('d/m/Y', strtotime($value['work_date']))); ?></td>
                <td style="text-align: center"><?php echo e($value['perform_block']); ?></td>
                <td style="text-align: center"><?php echo e($value['department_name']); ?></td>
                <td style="text-align: center" ><?php echo e($value['fullname']); ?></td>
                <td style="text-align: center">
                    <span class="editSpan reBlock"><?php echo e($value['relation_block']); ?></span>
                    <div class="form-group">
                    <select name="relate_block" class="editInput reBlock form-control input-small" style="display: none;width: 100%;height: 36px" data-bv-notempty="true"
                            data-bv-notempty-message="Khối liên quan không được để trống">
                        <?php $__currentLoopData = $block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($bl->id); ?>" <?php echo e(($bl->id == $value['re_id']) ? 'selected' : ''); ?>><?php echo e($bl->block_name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pjName"><?php echo e($value['project_name']); ?></span>
                    <div class="form-group">
                    <select name="project_id" class="editInput pjName form-control input-small" style="display: none;width: 100%;height: 36px;" data-bv-notempty="true"
                            data-bv-notempty-message="Tên dự án không được để trống">
                    <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pj->id); ?>" <?php echo e(($pj->id == $value['project_id']) ? 'selected' : ''); ?>><?php echo e($pj->project_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan workCon"><?php echo e($value['work_content']); ?></span>
                    <div class="form-group">
                    <input class="editInput workCon form-control input-small" type="text"
                           name="work_content" value="<?php echo e($value['work_content']); ?>" style="display: none; width: 100%;height: 36px;"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="512"
                           data-bv-stringlength-message="Nội dung nhập tối đa 512 kí tự"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Nội dung không được để trống">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan workTy"><?php echo e($value['job_type']); ?></span>
                    <div class="form-group">
                    <select name="work_type" class="editInput workTy form-control input-small" style="display: none;width: 100%;height: 36px;" data-bv-notempty="true"
                            data-bv-notempty-message="Loại công việc không được để trống">
                        <?php $__currentLoopData = $job; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->id); ?>"<?php echo e(($type->id == $value['work_type']) ? 'selected' : ''); ?>><?php echo e($type->job_type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan exeTime"><?php echo e($value['execute_time']); ?></span>
                    <div class="form-group">
                    <input class="editInput exeTime form-control" type="text"
                           name="execute_time" value="<?php echo e($value['execute_time']); ?>" style="display: none;width: 100%;height: 36px"
                           data-bv="true"
                           max="24"
                           data-bv-lessthan-inclusive="true"
                           data-bv-lessthan-message="Thời gian thực hiện nhập giá trị số không trong khoảng từ 0 đến 24"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="^[0-9.]+$"
                           data-bv-regexp-message="Thời gian thực hiện nhập không đúng định dạng giá trị số và dấu chấm"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Thời gian thực hiện không được để trống">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pro"><?php echo e($value['progress']); ?>%</span>
                    <div class="form-group">
                        <input class="editInput pro form-control" type="text"
                               name="progress" value="<?php echo e($value['progress']); ?>" style="display: none;width: 100%;height: 36px"
                               data-bv="true"
                               max="100"
                               data-bv-lessthan-inclusive="true"
                               data-bv-lessthan-message="Hiện trạng nhập giá trị số không trong trong khoảng từ 0 đến 100"
                               data-bv-regexp="true"
                               data-bv-regexp-regexp="^[0-9]+$"
                               data-bv-regexp-message="Hiện trạng nhập không đúng giá trị là số"
                               data-bv-notempty="true"
                               data-bv-notempty-message="Hiện trạng không được để trống">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pro"><?php echo e($value['target']); ?></span>
                    <div class="form-group">
                        <input class="editInput pro form-control" type="text"
                               name="target" value="<?php echo e($value['target']); ?>" style="display: none;width: 100%;height: 36px;margin: 0 -8px"
                               data-bv-regexp="true"
                               data-bv-regexp-regexp="^[0-9]+$"
                               data-bv-regexp-message="Mục tiêu nhập không đúng giá trị là số"
                               maxlength="10"
                               data-bv-stringlength-message="Mục tiêu nhập tối đa 10 ký tự">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pro"><?php echo e($value['result']); ?></span>
                    <div class="form-group">
                        <input class="editInput pro form-control" type="text"
                               name="result" value="<?php echo e($value['result']); ?>" style="display: none;width: 100%;height: 36px;margin: 0 -8px"
                               data-bv-regexp="true"
                               data-bv-regexp-regexp="^[0-9]+$"
                               data-bv-regexp-message="Kết quả nhập không đúng giá trị là số"
                               maxlength="10"
                               data-bv-stringlength-message="Kết quả nhập tối đa 10 ký tự">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan late">
                        <?php if($value['late'] == 1): ?>
                            <i class="fa fa-check" style="color: lightskyblue"></i>
                        <?php endif; ?>
                    </span>
                    <label class="editInput late" style="display: none">
                        <div class="form-group">
                        <input type="checkbox" class="colored-blue editInput late" name="late"
                           <?php if($value['late'] == 1): ?>
                           checked
                           <?php endif; ?>   value="1" >
                        <span class="text" ></span>
                        </div>
                    </label>
                </td>
                <td style="text-align: center"><?php echo e($value['note']); ?></td>
                <td style="text-align: center">
                    <button type="button" class="btn btn-info btn-xs edit" onclick="clickEdit(this);">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <button type="submit" class="btn btn-success btn-xs save" onclick="clickSave(this)" style="display: none">
                        <i class="fa fa-edit"></i> Save
                    </button>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("#table-workflow").bootstrapValidator();
        $('#table-workflow').DataTable({
            language: {search: "",
                paginate: {previous: "<",next:">"},
                emptyTable:"Không có dữ liệu"
            },
            pageLength: 50
        });
    });
</script>

<?php /**PATH D:\DaoTao\WorkingReport\trunk\20.SourceCode\Modules\Workflow\Providers/../Resources/views/tableWorkflow.blade.php ENDPATH**/ ?>