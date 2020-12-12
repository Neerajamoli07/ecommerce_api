<?php if(in_array($field->type, array('hidden','auto')) OR !$field->has_wrapper ): ?>

    <?php echo $field->output; ?>


    <?php if($field->message!=''): ?>
    <span class="help-block">
        <span class="glyphicon glyphicon-warning-sign"></span>
        <?php echo $field->message; ?>

    </span>
    <?php endif; ?>

<?php else: ?>
    <div class="form-group clearfix<?php echo $field->has_error; ?>" id="fg_<?php echo $field->name; ?>" >

        <?php if($field->has_label): ?>
            <label for="<?php echo $field->name; ?>" class="col-sm-2 control-label<?php echo $field->req; ?>"><?php echo $field->label.$field->star; ?></label>
            <div class="col-sm-10" id="div_<?php echo $field->name; ?>">
        <?php else: ?>
            <div class="col-sm-12" id="div_<?php echo $field->name; ?>">
        <?php endif; ?>
            
            
            <?php echo $field->output; ?>


            <?php if(count($field->messages)): ?>
                <?php $__currentLoopData = $field->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="help-block">
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        <?php echo $message; ?>

                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>

            
            
    </div>
<?php endif; ?>
