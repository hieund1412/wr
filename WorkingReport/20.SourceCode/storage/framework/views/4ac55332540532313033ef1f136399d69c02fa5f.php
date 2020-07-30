<?php $__env->startSection('content'); ?>
    <div class="wrapper">
        <h1><div class="header">Quản lý dự án</div></h1>
        <div class="row">
            <div class="col-xs-4">
                Pháp Nhân:
                <select name="" id="">
                    <option>AGRIMEDIA</option>
                    <option>abc acb</option>
                </select>
            </div>
            <div class="col-xs-4">
                Tên dự án
                <input type="text">
            </div>
            <div class="col-xs-4">
                <button class="btn btn-primary btn-fill btn-wd">Tra cứu</button>
            </div>
        </div>

        
        <button type="button" class="btn btn-success btn-fill btn-wd" data-toggle="modal" data-target="#create_project">Thêm mới dự án</button>
        
        <table class="table" border="1" >
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Pháp nhân</th>
                <th scope="col">Tên dự án</th>
                <th scope="col">Mô tả dự án</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td scope="row"><?php echo e($projects->id); ?></td>
                <td scope="row" id="corporation_name_<?php echo e($projects->id); ?>"><?php echo e($projects->corporation_name); ?></td>
                <td scope="row" id="project_name_<?php echo e($projects->id); ?>"><?php echo e($projects->project_name); ?></td>
                <td scope="row" id="project_note_<?php echo e($projects->id); ?>"><?php echo e($projects->project_note); ?></td>
                <td>
                    <a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#update_project"
                       onclick="getData(<?php echo e($projects->id); ?>)">
                        <i class="fa fa-edit"></i>
                    </a>
                    
                    <a href="#" class="btn btn-simple btn-danger btn-icon remove"
                       data-toggle="modal" data-target="#delete_project<?php echo e($projects->id); ?>"><i class="fa fa-times"></i></a>

                    <div class="modal fade" id="delete_project<?php echo e($projects->id); ?>" tabindex="-1"
                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn khhông ?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-fill btn-wd" data-dismiss="modal">Close</button>
                                    <a type="button" class="btn btn-danger btn-fill btn-wd" href="<?php echo e(route('destroy',['id' => $projects['id']])); ?>">Save changes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>


        </table>
        <script>
            $(document).ready( function () {

                $('.table').DataTable( {
                    "language": {
                        "lengthMenu": "Display _MENU_ records per page",
                        "zeroRecords": "Nothing found - sorry",
                        "info": "Showing page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",


                        "sProcessing":   "Đang xử lý...",
                        "sLengthMenu":   "Xem _MENU_ mục",
                        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                        "sInfoPostFix":  "",
                        "sSearch":       "Tìm:",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst": "Đầu",
                            "sPrevious": "Trước",
                            "sNext": "Tiếp",
                            "sLast": "Cuối"
                        }
                    }
                } );
            } );
        </script>
        
        
            
            
            
            
        
    </div>


    




    


    <div class="modal fade" id="create_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới dự án</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div><br />
                <?php endif; ?>
                <div class="modal-body">
                    <form action="<?php echo e(route('insert')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Pháp nhân<star>*</star></label>
                            <input type="text" class="form-control" id="recipient-name" name="corporation_name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tên dự án<star>*</star></label>
                            <input type="text" class="form-control" id="recipient-name" name="project_name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mô tả dự án</label>
                            <textarea class="form-control" id="message-text" name="project_note"></textarea>
                        </div>


                        <div class="modal-footer">
                            <button class="btn btn-warning btn-fill btn-wd" aria-label="Close" data-dismiss="modal">Quay lại</button>
                            <button class="btn btn-primary btn-fill btn-wd">Cập nhật</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    

    <div class="modal fade" id="update_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa đổi dự án</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Pháp nhân<star>*</star></label>
                            <input type="text" class="form-control" id="corporation_name" name="corporation_name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tên dự án<star>*</star></label>
                            <input type="text" class="form-control" id="project_name" name="project_name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mô tả dự án</label>
                            <textarea class="form-control" id="message-text" name="project_note"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning btn-fill btn-wd" aria-label="Close" data-dismiss="modal">Quay lại</button>
                    <button class="btn btn-primary btn-fill btn-wd">Cập nhật</button>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script type="text/javascript">
    function getData(id) {
        var corporation_name    = $('#corporation_name_'+ id).text();
        var project_name = $('#project_name' + id).text();
        var project_note = $('#project_note_' + id).text();
        $('#id-edit').val(id);
        $('#corporation_name-edit').val(corporation_name);
        $('#project_name-edit').val(project_name);
        $('#message-text-edit').val(project_note);
    }
</script>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\training\WorkingReport\trunk\20.SourceCode\Modules\Projects\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>