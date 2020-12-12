<?php $__env->startSection('content'); ?>
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">
    
        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="login">
                    <div class="row">
                    <img width="40px" height="40px" style="border-radius: 50%" class="logo" src="<?php echo e(url('images')); ?>/app_logo.jpg" alt="app logo"/>
                       <h2>Log IN</h2>
                    </div>
                    
                    <form class="login_form" id="loginform" role="form" method="POST" action="<?php echo e(url('/delivery')); ?>">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        EMAIL:<br>
                        <input type="email" name="email">

                        PASSWORD:<br>
                        <input type="password" name="password">

                        <!-- <div class="clearfix">
                            <div class="pull-left">
                                <input type="checkbox" name="remember"><label for="remember"> Remember Me </label>
                            </div>
                            <div class="pull-right">
                                <a class="forgot_pass" href="<?php echo e(url('/password/email')); ?>">Forgot password?</a>
                            </div>
                        </div> -->
                        <div class="center">
                            <input type="submit" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- //CONTAINER -->
    </section>
    <!-- //MY ACCOUNT PAGE -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>