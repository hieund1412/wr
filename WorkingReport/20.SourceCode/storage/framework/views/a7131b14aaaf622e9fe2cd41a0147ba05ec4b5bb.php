<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo e($message); ?>

</div>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo e($message); ?>

</div>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>
<?php if($message = Session::get('password_input_fail')): ?>
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong><?php echo e($message); ?></strong>
	</div>
<?php endif; ?>
<?php if($message = Session::get('diff_phone')): ?>
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong><?php echo e($message); ?></strong>
	</div>
<?php endif; ?>
<?php if($message = Session::get('diff_email')): ?>
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong><?php echo e($message); ?></strong>
	</div>
<?php endif; ?>
<?php if($message = Session::get('id_device_diff')): ?>
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong><?php echo e($message); ?></strong>
	</div>
<?php endif; ?>
<?php if($message = Session::get('err')): ?>
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong><?php echo e($message); ?></strong>
	</div>
<?php endif; ?>
<?php if($flash=session('edit')): ?>
	<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert"
		   aria-label="close">&times;</a>
		<strong><?php echo e(trans('backend/donvi.success_edit')); ?> !</strong>
		<br>
		<br>
	</div>
<?php endif; ?>
<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<!-- <strong><?php echo e($message); ?></strong> -->
			<ul>
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>	

</div>
<?php endif; ?><?php /**PATH D:\DaoTao\WorkingReport\trunk\20.SourceCode\resources\views/layouts/flash_message.blade.php ENDPATH**/ ?>