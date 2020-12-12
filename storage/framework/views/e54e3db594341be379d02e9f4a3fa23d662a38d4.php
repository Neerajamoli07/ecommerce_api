<div class="form-group">
    <a href="<?php echo e(url('backend/users')); ?>" class="btn btn-primary">Back</a>
</div>
<div class="form-group">
    <?php echo Form::label('Name', 'Name:'); ?>

    <?php echo Form::text('name',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Email', 'Email'); ?>

    <?php echo Form::email('email',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Password', 'Password'); ?>

    <?php echo Form::password('password',['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Password Confirmation', 'Password Confirmation'); ?>

    <?php echo Form::password('password_confirmation',['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

</div>