<div class="form-group">
    <a href="<?php echo e(url('backend/articles')); ?>" class="btn btn-primary">Back</a>
</div>
<div class="form-group">
    <?php echo Form::label('Slug', 'Slug:'); ?>

    <?php echo Form::text('slug',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Name', 'Name:'); ?>

    <?php echo Form::text('name',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Description', 'Description:'); ?>

    <?php echo Form::textarea('description',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Image'); ?>

    <?php echo Form::file('a_img', null); ?>

</div>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $brands = $p->brands->pluck('brand', 'brand_id') ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="form-group" style="display: none;">
    <?php echo Form::label('Brand', 'Brand:'); ?>

    <?php echo Form::select('brand_id', $brands, null, ['id' => 'brand_id','class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php $__currentLoopData = $checkbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo Form::label($s->size_id,$s->size); ?>

        <?php echo Form::checkbox( 'size[]',$s->size_id, null,['id' => $s['size_id'],'class' => 'md-check']); ?>

        <?php echo Form::text('rate[]',"",['placeholder'=>'Enter Rate']); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $category = $p->category->pluck('cat', 'cat_id') ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="form-group">
    <?php echo Form::label('Category', 'Category:'); ?>

    <?php echo Form::select('cat_id', $category, null, ['id' => 'cat_id','class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Quantity', 'Quantity:'); ?>

    <?php echo Form::text('quantity',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Price', 'Price:'); ?>

    <?php echo Form::text('price',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Fresh Product Date', 'Fresh Product Date:'); ?>

    <?php echo Form::text('fresh_product_date',null,['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

</div>