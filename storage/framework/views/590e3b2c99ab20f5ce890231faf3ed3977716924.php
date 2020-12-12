<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid" style="background-color: #01A65A;">
        <div class="navbar-header">
            <button type="button" class="navbar-expand-toggle">
                <i class="fa fa-bars icon"></i>
            </button>
            <ol class="breadcrumb navbar-breadcrumb">
            <img width="40px" height="40px" style="border-radius: 50%" class="logo" src="<?php echo e(url('images')); ?>/app_logo.jpg" alt="app logo"/>
                <?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
                    <li>Admin Panel</li>
                <?php endif; ?>
                <?php if (\Illuminate\Support\Facades\Blade::check('user')): ?>
                    <li>User Panel</li>
                <?php endif; ?>
                <li class="active"><?php echo e(Auth::user()->email); ?></li>
                <!-- <li class="active"><a href="<?php echo e(url('cms')); ?>">Back to Site</a></li> -->
                
            </ol>
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-th icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-expanded="false"><?php echo e(Auth::user()->name); ?><span class="caret"></span></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li>
                        <div class="profile-info">
                            <h4 class="username"><?php echo e(Auth::user()->name); ?></h4>

                            <p><?php echo e(Auth::user()->email); ?></p>

                            <div class="btn-group margin-bottom-2x" role="group">
                                <button type="button" class="btn btn-default"><i class="fa fa-user"></i>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
                                        <a href="<?php echo e(url('backend/admin')); ?>"><?= "Admin"?></a>
                                    <?php endif; ?>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('user')): ?>
                                        <a href="<?php echo e(url('backend/user')); ?>"><?= "User"?></a>
                                    <?php endif; ?>
                                </button>
                                <button type="button" class="btn btn-default"><i class="fa fa-sign-out"></i>
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        <?= 'Logout'?>
                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>