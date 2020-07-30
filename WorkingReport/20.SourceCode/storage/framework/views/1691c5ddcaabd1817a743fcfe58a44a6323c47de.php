<table class="table table-striped table-hover table-bordered table-responsive" id="editabledatatable">
    <thead>
        <tr role="row" >
            <th width="5%">STT</th>
            <th width="15%">Họ tên</th>
            <th width="10%">Khối</th>
            <th width="15%">Phòng ban</th>
            <th width="15%">Vai trò</th>
            <th width="10%">Nhóm quyền</th>
            <?php if(\Illuminate\Support\Facades\Blade::check('role', 'users.view_edit') || \Illuminate\Support\Facades\Blade::check('role', 'users.destroy')): ?>
                <th width="30%">Hành động</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody>
    <?php if(!empty($data)): ?>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td ><?php echo e($key+1); ?></td>
            <td ><?php echo e($user->fullname); ?></td>
            <td ><?php echo e($user->block_name); ?></td>
            <td ><?php echo e($user->department_name); ?></td>
            <td ><?php echo e($user->role_name); ?></td>
            <td ><?php echo e($user->permission_name); ?></td>
            <?php if(\Illuminate\Support\Facades\Blade::check('role', 'users.view_edit') || \Illuminate\Support\Facades\Blade::check('role', 'users.destroy')): ?>
                <td>
                    <?php if(\Illuminate\Support\Facades\Blade::check('role', 'users.view_edit')): ?>
                        <a href="<?php echo e(route('users.view_edit',['id' => $user->id])); ?>" class="btn btn-blue btn-xs edit">
                            <i class="fa fa-edit"></i> Edit</a>
                    <?php endif; ?>
                        <?php if(\Illuminate\Support\Facades\Blade::check('role', 'users.destroy')): ?>
                        <a href="#" class="btn btn-danger btn-xs delete"
                                data-toggle="modal" data-target="#delete_depart<?php echo e($user->id); ?>">
                            <i class="fa fa-trash-o"></i>Delete</a>
                        
                        <div class="modal fade" id="delete_depart<?php echo e($user->id); ?>" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="margin-left: 20%;width:60%">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLabel">Thông báo
                                        <button type="button" class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true" style="color: red">&times;</span>
                                        </button>
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        Bạn đang chọn chức năng xóa <br> Bạn có thực sự muốn xóa không ?
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-danger btn-fill btn-wd"
                                           href="<?php echo e(route('users.destroy',['id' => $user->id])); ?>">Xóa</a>
                                        <button type="button" class="btn btn-default btn-fill btn-wd"
                                                data-dismiss="modal">Đóng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#editabledatatable').DataTable({
            language: {search: "",
                paginate: {previous: "<",next:">"},
                emptyTable:"Không có dữ liệu"
            },
            pageLength: 30
        });
    });
</script><?php /**PATH D:\WorkingReport\20.SourceCode\Modules\Users\Providers/../Resources/views/table_user.blade.php ENDPATH**/ ?>