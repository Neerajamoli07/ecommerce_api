<?php $__env->startSection('content'); ?>

<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Edit Delivery Cost</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <h3>Edit Product</h3>
                  <form method="POST" action="/backend/postals/<?php echo e($postal->id); ?>" accept-charset="UTF-8" enctype="multipart/form-data">
                     <input name="_method" type="hidden" value="PATCH">
                     <?php echo e(csrf_field()); ?>

                     <div class="form-group">
                        <a href="/backend/postals" class="btn btn-primary">Back</a>
                     </div>
                     <div class="form-group">
                        <label for="PlaceName">Place Name:</label>
                        <input class="form-control" name="place_name" type="text" value="<?php echo e($postal->place_name); ?>">
                     </div>
                     <div class="form-group">
                        <label for="Distance">Distance:</label>
                        <input class="form-control" name="distance" type="text" value="<?php echo e($postal->distance); ?>">
                     </div>
                     <div class="form-group">
                        <label for="Pin Code">Pin Code:</label>
                        <input class="form-control" name="pin_code" type="text" value="<?php echo e($postal->pin_code); ?>">
                     </div>
                     <div class="form-group">
                        <label for="DeliveryCost">DeliverCost:</label>
                        <input class="form-control" name="deliver_cost" type="text" value="<?php echo e($postal->deliver_cost); ?>">
                     </div>

                     <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Update">
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