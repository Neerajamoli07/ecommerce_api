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

    <?php if($product->a_img): ?>
        <a class="thumbnail">
            <img class="img-responsive" src="<?php echo e(asset('images/products/'.$product->a_img)); ?>"
                 height="45" width="35" alt="<?php echo e($product->a_img); ?>">
        </a>
    <?php endif; ?>
    <?php echo Form::file('a_img', null); ?>

    <?php echo Form::hidden('old_img', $product->a_img); ?>

</div>
<?php $sizes_array = $product->size->pluck("size_id")->all();
$brands = $product->brands->pluck('brand', 'brand_id');
?>
<div class="form-group">
    <?php echo Form::label('Brand', 'Brand:'); ?>

    <?php echo Form::select('brand_id', $brands, null, ['id' => 'brand_id','class'=>'form-control']); ?>

</div>
<div class="form-group">
   <?php
     if($product->rate != null){ 
        $rates = explode(",",$product->rate);
       }else{
         $rates = explode(",",",,,,,,,,,,");
       }
        
     //print_r($rates);
     $key = 0;
   ?>
    <?php $__currentLoopData = $checkbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <?php echo Form::label($s->size,$s->size); ?>

        <?php echo Form::checkbox( 'size[]',$s->size_id, in_array($s->size_id, $sizes_array),['id' => $s['size_id'],'class' => 'md-check']); ?>

        <?php
         
         if(in_array($s->size_id, $sizes_array)){
           
          ?>   
            <input placeholder="Enter Rate" name="rate[]" type="text" value="<?php echo $rates[$key] ?>">
         <?php  
         $key++; 
         }else{
             ?>
            <input placeholder="Enter Rate" name="rate[]" type="text" value="">
         
         <?php }
        ?>
        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $sizes_array = $product->category->pluck("cat_id")->all();
$category = $product->category->pluck('cat', 'cat_id');
?>
<div class="form-group">
    <?php echo Form::label('Category', 'Category:'); ?>

    <?php echo Form::select('cat_id', $category, null, ['id' => 'cat_id','class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('Stock', 'Stock:'); ?>

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