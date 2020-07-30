<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: <?php echo config('post.name'); ?>

    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('post::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\training\WorkingReport\trunk\20.SourceCode\Modules\Post\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>