<!DOCTYPE html>
<html>

<head>
    <title>Admin Backend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/font-awesome/css/font-awesome.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/animate.css')); ?>">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/style-backend.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/flat-blue.css')); ?>">

    <!-- SCRIPTS -->
    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>" type="text/javascript"></script>
    <?php echo Rapyd::styles(false); ?>

    <?php echo Rapyd::head(); ?>


</head>

<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        <?php echo $__env->make('backend.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('backend.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- FOOTER -->
    <?php echo $__env->make('backend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- //FOOTER -->
</div>

<script src="<?php echo e(asset('/js/convertdocument/jquery-3.5.1.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/convertdocument/jquery.dataTables.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/convertdocument/dataTables.buttons.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/convertdocument/jszip.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/convertdocument/pdfmake.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/convertdocument/vfs_fonts.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/convertdocument/buttons.html5.min.js')); ?>" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $('#converter').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pdf'
        ]
    } );
    $('#converter_filter').css("display", "none");
} );
</script>
</body>

</html>
