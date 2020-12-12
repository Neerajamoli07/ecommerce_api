<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/admin')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-tachometer <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>Dashboard <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/articles')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-pencil-square-o <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>Product <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/users')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-user <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>Manage Users <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/orders')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-shopping-cart <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>Orders <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/brands')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-th-large <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>Brands <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/category')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-list <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>Categories <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/subcategory')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-list-alt <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>Subcategories <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <li class="menu">
        <a href="/backend/postals">
            <span class="icon fa fa-th-large"></span><span class="title">Delivery Cost</span>
        </a>
    </li>

    <li class="menu">
        <a href="/backend/notifications/create">
            <span class="icon fa fa-th-large"></span><span class="title">Notifications</span>
        </a>
    </li>
    
    <li class="  panel panel-default dropdown">
    <a data-toggle="collapse" href="#dropdown-table">
        <span class="icon fa fa-table"></span><span class="title">Reports</span>
    </a>
    <!-- Dropdown-->
    <div id="dropdown-table" class="panel-collapse collapse">
        <div class="panel-body">
            <ul class="nav navbar-nav">
                <li><a href="/backend/dailyOrders">
                        <span class="icon fa fa-pencil-square-o"></span>Daily Reports</a>
                </li>
                <li><a href="/backend/weeklyOrders">
                        <span class="icon fa fa-pencil-square-o"></span>Weekly Reports</a>
                </li>
                <li><a href="/backend/monthlyOrders">
                        <span class="icon fa fa-pencil-square-o"></span>Monthly Reports</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Dropdown-->
</li>
    
<?php endif; ?>
<?php if (\Illuminate\Support\Facades\Blade::check('user')): ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/user')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-tachometer <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>User Dashboard <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/profile')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-eye <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>User Profile <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('backend.link'); ?>
    <?php $__env->slot('link'); ?><?php echo e(url('backend/user-orders')); ?><?php $__env->endSlot(); ?>
    <?php $__env->slot('icon'); ?>icon fa fa-money <?php $__env->endSlot(); ?>
    <?php $__env->slot('name'); ?>My Orders <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
<?php endif; ?>