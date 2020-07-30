<?php $__env->startSection('content'); ?>
    <div class="col-md-6" id="create_project">
        <div class="card">
            <form id="registerFormValidation" action="" method="" novalidate="novalidate">
                <div class="header">Sửa đổi dự án</div>
                <div class="content">

                    <div class="form-group">
                        Email Address <star>*</star></label>
                        <input class="form-control" name="email" type="text" required="true" email="true" autocomplete="off" aria-required="true">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Password <star>*</star></label>
                        <input class="form-control" name="password" id="registerPassword" type="password" required="true" aria-required="true">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Confirm Password <star>*</star></label>
                        <input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" required="true" equalto="#registerPassword" aria-required="true">
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </div>

                <div class="footer">
                    <button type="submit" class="btn btn-info btn-fill pull-right">Register</button>
                    <div class="form-group pull-left">
                        <label class="checkbox">
                            <input id="checkbox41" type="checkbox">
                            <label for="checkbox41">
                                Subscribe to newsletter
                            </label>
                        </label>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\training\WorkingReport\trunk\20.SourceCode\Modules\Blocks\Providers/../Resources/views/create.blade.php ENDPATH**/ ?>