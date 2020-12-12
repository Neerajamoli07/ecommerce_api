<?php $__env->startSection('content'); ?>

<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Delivery Cost</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <a href="/backend/postals/create" class="btn btn-success">Add Delivery </a>
                  <hr>
                  <table class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr class="bg-info">
                           <th>ID</th>
                           <!-- <th>Slug</th> -->
                           <th>Place Name</th>
                           <th>Distance</th>
                           <th>Pin Code</th>
                           <th>Delivery Cost</th>
                           <th colspan="3">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php $__currentLoopData = $postals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($value->id); ?></td>
                           <td><?php echo e($value->place_name); ?></td>
                           <td><?php echo e($value->distance); ?></td>
                           <td><?php echo e($value->pin_code); ?></td>
                           <td><?php echo e($value->deliver_cost); ?></td>
                           <!-- <td><a href="/backend/articles/1" class="btn btn-primary">Read</a></td> -->
                           <td><a href="/backend/postals/<?php echo e($value->id); ?>/edit" class="btn btn-warning">Update</a></td>
                           <td>
                              <form method="POST" action="/backend/postals/<?php echo e($value->id); ?>" accept-charset="UTF-8">
                                <input name="_method" type="hidden" value="DELETE">
                                <?php echo e(csrf_field()); ?>

                                 <input class="btn btn-danger" type="submit" value="Delete">
                              </form>
                           </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                  </table>

                  
                  <div class="row">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>