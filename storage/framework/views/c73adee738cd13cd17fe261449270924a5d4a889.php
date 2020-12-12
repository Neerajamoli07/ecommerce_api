<?php if( 
    (isset($label) && strlen($label)) || 
    (isset($buttons_left) && count($buttons_left)) || 
    (isset($buttons_center) && count($buttons_center)) || 
    (isset($buttons_right) && count($buttons_right))
    ): ?>
    <div class="btn-toolbar" role="toolbar">

        <?php if(isset($label) && strlen($label)): ?>
        <div class="pull-left">
            <h2><?php echo $label; ?></h2>
        </div>
        <?php endif; ?>
        <?php if(isset($buttons_left) && count($buttons_left)): ?>
        <div class="pull-left">
            <?php $__currentLoopData = $buttons_left; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo $button; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <?php if(isset($buttons_right) && count($buttons_right)): ?>
        <div class="pull-right">
            <?php $__currentLoopData = $buttons_right; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo $button; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <?php if(isset($buttons_center) && count($buttons_center)): ?>
        <div style="text-align: center;">
            <?php $__currentLoopData = $buttons_center; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo $button; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
    <br />
<?php else: ?>
<?php endif; ?>
