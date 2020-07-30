<!-- Sidebar Menu -->
<ul class="nav sidebar-menu">
    <?php
    $menus = \Modules\Permissions\Services\CommonMenu::$menu;
    $current = \Route::currentRouteName();
    echo $current;
    ?>
    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($menu['child']) && sizeof($menu['child']) > 0 ): ?>
            <?php
                $class = 'has_sub';
                $isChildPermit = false;
                foreach ($menu['child'] as $child) {
                    $controller_now = explode(".", $current);
                    $controller_menu = explode(".", $child['route']);

                    if ($child['route'] == $current || $controller_now[0] == $controller_menu[0]) {
                        $class = 'has_sub active nav-active1';

                    }
                    if (in_array($child['route'], $permissions)) {
                        $isChildPermit = true;
                    }
                }
            ?>
            <?php if($isChildPermit || in_array("*",$permissions)): ?>
                <li class="<?php echo e($class); ?>"><a class="<?php echo e($menu['class']); ?>" href="javascript:void(0)"> <i
                                class="<?php echo e($menu['icon']); ?>"></i><span><?php echo e($menu['text']); ?></span><i class="menu-expand"></i></a>
                    <ul class="submenu" <?php echo e($class != '' ? 'style="display:block;"':''); ?>>
                        <?php $__currentLoopData = $menu['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $controller_now = explode(".", $current);
                            $controller_menu = explode(".", $child['route']);
                            $check = false;
                            ?>
                            <?php if(in_array($child['route'],$permissions) || in_array("*",$permissions)): ?>
                                <?php $check = true; ?>
                                <li class="<?php echo e((($child['route'] == $current || $controller_now[0] == $controller_menu[0]) && $check == false) ? 'active':''); ?>">
                                    <a class="<?php echo e($menu['class']); ?>" href="<?php echo e(route($child['route'])); ?>">
                                        <i class="<?php echo e($child['icon']); ?>"></i><span class="menu-text"><?php echo e($child['text']); ?></span></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php else: ?>
            <?php if(in_array($menu['route'],$permissions) || in_array("*",$permissions)): ?>
                <?php if($menu['route'] == $current ): ?>
                    <li class="active"><a class="<?php echo e($menu['class']); ?>" href="<?php echo e(route($menu['route'])); ?>">
                            <i class="<?php echo e($menu['icon']); ?>"></i><span class="menu-text"><?php echo e($menu['text']); ?></span></a>
                    </li>
                <?php else: ?>
                    <li><a class="<?php echo e($menu['class']); ?>" href="<?php echo e(route($menu['route'])); ?>">
                            <i class="<?php echo e($menu['icon']); ?>"></i><span class="menu-text"><?php echo e($menu['text']); ?></span></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<!-- /Sidebar Menu --><?php /**PATH D:\WorkingReport\20.SourceCode\resources\views/layouts/menu.blade.php ENDPATH**/ ?>