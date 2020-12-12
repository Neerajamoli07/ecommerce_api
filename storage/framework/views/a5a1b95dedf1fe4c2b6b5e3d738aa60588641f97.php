<?php $__env->startSection('content'); ?>
<!-- Main Content -->
<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title"><?php echo e($title); ?></span>
      <!-- <div class="description">A bootstrap table for display list of data.</div> -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="wrapper wrapper-content">
            <div class="row">
              <div class="col-lg-3">
                <div class="widget style1 yellow-bg">
                  <div class="row">
                    <div class="col-xs-4">
                      <i class="fa fa-desktop fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                      <span> Total Products </span>
                      <h2 class="font-bold"><?php echo e($totalProducts); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="widget style1 red-bg">
                  <div class="row">
                    <div class="col-xs-4">
                      <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                      <span> Total Users </span>
                      <h2 class="font-bold"><?php echo e($totalUsers); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="widget style1 lazur-bg">
                  <div class="row">
                    <div class="col-xs-4">
                      <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                      <span> Recently joined Users </span>
                      <h2 class="font-bold"><?php echo e($totalUsers); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                  <div class="row">
                    <div class="col-xs-4">
                      <i class="fa fa-dollar fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                      <span> Total Revenue </span>
                      <h2 class="font-bold">4.01</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Main Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>