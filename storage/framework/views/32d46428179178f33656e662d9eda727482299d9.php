<?php $__env->startSection('content'); ?>
        <!-- Main Content -->
<div class="container-fluid">
    <div class="side-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="title "><?php echo $__env->yieldContent('title', 'Edit Products'); ?></span>
                            <!--<div class="description">Description</div>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->yieldContent('body'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Main Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>