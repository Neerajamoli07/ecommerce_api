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
    <?php echo Form::label('Active', 'Active:'); ?>

    <?php echo Form::text('is_activated',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Old Password', 'Old Password'); ?>

    <?php echo Form::password('old_password',['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('New Password', 'New Password'); ?>

    <?php echo Form::password('password',['class'=>'form-control']); ?>

</div>
<?php $roles_array = $user->role->pluck("id")->all();?>
<div class="form-group">
    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo Form::label($r->name,$r->name); ?>

        <?php echo Form::checkbox( 'role[]',$r->id, in_array($r->id, $roles_array),['id' => $r['id'],'class' => 'md-check']); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="form-group">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

</div>