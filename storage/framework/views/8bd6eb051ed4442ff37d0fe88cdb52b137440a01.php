<div class="form-group">
    <a href="<?php echo e(url('backend/users')); ?>" class="btn btn-primary">Back</a>
</div>
<div class="form-group">
    <?php echo Form::label('Name', 'Name'); ?>

    <?php echo Form::text('name',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Slug', 'Slug'); ?>

    <?php echo Form::text('slug',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Description', 'Description'); ?>

    <?php echo Form::text('description',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Level', 'Level'); ?>

    <?php echo Form::text('level',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

</div>