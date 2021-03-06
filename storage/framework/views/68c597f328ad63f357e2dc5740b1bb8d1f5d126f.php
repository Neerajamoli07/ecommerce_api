<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('body'); ?>
    <h3>Create Role</h3>
    <?php echo $__env->make('messages.flash_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::open(['url' => 'backend/roles']); ?>

    <?php echo $__env->make('users.roles_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::close(); ?>

    <?php echo $__env->make('errors.error_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.tblTemplate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>