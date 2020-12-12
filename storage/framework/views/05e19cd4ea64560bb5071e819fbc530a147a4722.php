<?php echo Form::open(['method'=>'GET','url'=>$url]); ?>

<div>
    <input type="text" class="form-control" name="search" placeholder="Search...">

    <p></p>
    <span class="title">
        <?php echo Form::submit('Search', ['class' => 'btn btn-primary']); ?>

    </span>
</div>
    <p></p>
<?php echo Form::close(); ?>