<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('body'); ?>
    <?php echo $__env->make('messages/flash_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <a href="<?php echo e(url('backend/users/create')); ?>" class="btn btn-success">Create User</a>
    <a href="<?php echo e(url('backend/roles')); ?>" class="btn btn-success">Create Role</a>
    <hr>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Roles</th>
            <th>Active</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->mobile_number); ?></td>
                <td><?php echo e(implode(",", $user->role->pluck("slug")->all())); ?></td>
                <td><?php echo e($user->is_activated == 1 ? 'Yes' : 'No'); ?></td>
                <td><a href="<?php echo e(route('users.edit',$user->id)); ?>" class="btn btn-warning">Update</a></td>
                <td>
                    <?php echo Form::open(['method' => 'DELETE', 'route'=>['users.destroy', $user->id]]); ?>

                    <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

                    <?php echo Form::close(); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div>
        <nav>
            <?php echo $users->appends(Input::except('page'))->render(); ?>

        </nav>
    </div>
    <div class="row">
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend/tblTemplate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>