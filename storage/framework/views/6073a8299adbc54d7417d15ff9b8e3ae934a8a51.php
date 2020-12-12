<?php $__env->startSection('body'); ?>
    <?php echo $__env->make('messages.flash_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <a href="<?php echo e(url('backend/articles/create')); ?>" class="btn btn-success">Create Product</a>
    <hr>
    <?php echo $__env->make('product.search', ['url'=>'backend/articles/search'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th>ID</th>
            <!-- <th>Slug</th> -->
            <th>Name</th>
            <th>Brand</th>
            <th>Size</th>
            <th>Size Price</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Front Image</th>
            <th>Side Image</th>
            <th>Left Image</th>
            <th>Fresh Prod Date</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <tr>
                <td><?php echo e($p->id); ?></td>
                <!-- <td><?php echo e($p->slug); ?></td> -->
                <td><?php echo e($p->name); ?></td>
                <td><?php echo e($p->brands->brand); ?></td>
                <td><?php echo e(implode(",", $p->size->pluck("size")->all())); ?></td>
                <td><?php echo e($p->rate); ?></td>
                <td><?php echo e($p->category->cat); ?></td>
                <td><?php echo e($p->quantity); ?></td>
                <td><?php echo e($p->price); ?></td>

                <td><img src="<?php echo e(asset('images/products/'.$p->a_img)); ?>" height="35" width="25"></td>
                <!-- <td><img src="<?php echo e(asset('images/products/'.$p->b_img)); ?>" height="35" width="25"></td>
                <td><img src="<?php echo e(asset('images/products/'.$p->c_img)); ?>" height="35" width="25"></td> -->
                <td><?php echo e($p->fresh_product_date); ?></td>
                <td><a href="<?php echo e(route('articles.show',$p->id)); ?>" class="btn btn-primary">Read</a></td>
                <td><a href="<?php echo e(route('articles.edit',$p->id)); ?>" class="btn btn-warning">Update</a></td>
                
                <td>
                    <?php echo Form::open(['method' => 'DELETE', 'route'=>['articles.destroy', $p->id]]); ?>

                    <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

                    <?php echo Form::close(); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div>
        <nav>
            <?php echo $products->appends(Input::except('page'))->render(); ?>

        </nav>
    </div>
    <div class="row">
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.tblTemplate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>