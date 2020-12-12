<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Send Notifications</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <h3>Send Notification</h3>
                  <form method="POST" action="/backend/notifications" accept-charset="UTF-8" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                     <div class="form-group">
                        <a href="/backend/notification" class="btn btn-primary">Back</a>
                     </div>
                     <div class="form-group">
                        <label for="Name">Notification Title:</label>
                        <input class="form-control" name="notification_title" type="text">
                     </div>
                     <div class="form-group">
                        <label for="PinCode">Notification Body:</label>
                        <input class="form-control" name="notification_body" type="text">
                     </div>
                     <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Save">
                     </div>
                     <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                     <?php endif; ?>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>