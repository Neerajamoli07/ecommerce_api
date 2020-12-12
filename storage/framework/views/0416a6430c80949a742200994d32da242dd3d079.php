<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('body'); ?>
    <?php echo $__env->make('messages.flash_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <h3>Edit User</h3>
    <?php echo Form::model($user,['method' => 'PATCH','route'=>['users.update',$user->id]]); ?>

    <?php echo $__env->make('users.form_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::close(); ?>

    <?php echo $__env->make('errors.error_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.tblTemplate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>