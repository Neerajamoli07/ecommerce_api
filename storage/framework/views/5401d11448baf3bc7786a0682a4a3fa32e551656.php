<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<head>

    <meta charset="utf-8">
    <title>FreshFromVypin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($meta->description); ?>">
    <meta name="author" content="">
    <meta name="keyword" content="<?php echo e($meta->keyword); ?>">

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- CSS -->
    <link href="<?php echo e(asset('/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('/css/flexslider.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('/css/fancySelect.css')); ?>" rel="stylesheet" media="screen, projection"/>
    <link href="<?php echo e(asset('/css/animate.css')); ?>" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo e(asset('/css/style.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('/css/jquery.fancybox.css')); ?>" rel="stylesheet" type="text/css"/>

    <!-- SCRIPTS -->

    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/js/jquery-ui.min.js')); ?>" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="<?php echo e(asset('/js/dirPagination.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/js/productCtrl.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/js/toArrayFilter.js')); ?>" type="text/javascript"></script>

    <!-- FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,
                       700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <link href="<?php echo e(asset('/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">


</head>
<body>

<!-- PRELOADER -->
<div id="preloader">
    <img src="<?php echo e(url('images/preloader.gif')); ?>" alt=""/></div>
<!-- //PRELOADER -->
<div class="preloader_hide">
    <!-- PAGE -->
    <div id="page">

        <!-- HEADER -->
        
                <!-- //HEADER -->
        <!-- <?php echo $__env->yieldContent('content'); ?> -->
        <!-- <?php echo $__env->yieldContent('script'); ?> -->
                <!-- FOOTER -->
        
                <!-- //FOOTER -->
    </div>
    <!-- //PAGE -->
</div>
<!-- <?php echo $__env->make('frontend.javascripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
</body>
</html>