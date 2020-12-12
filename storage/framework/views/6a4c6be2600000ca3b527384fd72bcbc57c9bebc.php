<?php $__env->startSection('body'); ?>
    <h3>Edit Product</h3>
    <?php echo $__env->make('messages/flash_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::model($product,['method' => 'PATCH','route'=>['articles.update',$product->id],'files'=> true]); ?>

    <?php echo $__env->make('product.form_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::close(); ?>

    <?php echo $__env->make('errors.error_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.tblTemplate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>