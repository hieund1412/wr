<div class="navbar-inner">
    <div class="navbar-container">
        <!-- Navbar Barnd -->

        <div class="navbar-header pull-left">
            <a href="" class="navbar-brand">
                <img src="<?php echo e(asset('/template/assets/img/wrp_logo.png')); ?>">
            </a>`

        </div>
        <!-- /Navbar Barnd -->
        <!-- Sidebar Collapse -->
        <div class="sidebar-collapse" id="sidebar-collapse">
            <i class="collapse-icon fa fa-bars"></i>
        </div>
        <!-- /Sidebar Collapse -->
        <!-- Account Area and Settings --->
        <div class="navbar-header pull-right">
            <div class="navbar-account">
                <ul class="account-area">
                    <li>
                        <a class="login-area dropdown-toggle" data-toggle="dropdown">
                            <div class="avatar" title="View your public profile">
                                <img src="<?php echo e(asset('/template/assets/img/avatars/ava.jpg')); ?>">
                            </div>
                            <section>
                                <h2><span class="profile"><span><?php echo e(\Illuminate\Support\Facades\Auth::user()->fullname); ?></span></span></h2>
                            </section>
                        </a>
                        <!--Login Area Dropdown-->
                        <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                            <li class="username"><a><?php echo e(\Illuminate\Support\Facades\Auth::user()->fullname); ?></a></li>
                            <!--/Theme Selector Area-->
                            <a class="dropdown-footer" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
									   document.getElementById('logout-form').submit();">
                                <i class="dripicons-exit text-muted"></i>Đăng xuất</a>
                            <li class="dropdown-footer">
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                      style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>

                        </ul>
                        <!--/Login Area Dropdown-->
                    </li>
                </ul>
                <!-- Settings -->
            </div>
        </div>
        <!-- /Account Area and Settings -->
    </div>
</div>
<?php /**PATH D:\WorkingReport\20.SourceCode\resources\views/layouts/nav.blade.php ENDPATH**/ ?>