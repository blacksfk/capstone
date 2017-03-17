<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- FLEXSLIDER CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/flexslider.css')); ?>">
    <!-- CUSTOM STYLE CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">   
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>
<body>
    <?php echo $__env->make('shared.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('shared.carousel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div  class="tag-line" >
        <div class="container">
            <div class="row  text-center" >
                <div class="col-lg-12  col-md-12 col-sm-12">      
                    <h2 data-scroll-reveal="enter from the bottom after 0.1s" >
                        <i class="fa fa-circle-o-notch"></i>
                        <?php echo $__env->yieldContent('title'); ?>
                        <i class="fa fa-circle-o-notch"></i>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('shared.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--  Jquery Core Script -->
    <script src="<?php echo e(asset('assets/js/jquery-1.10.2.js')); ?>"></script>
    <!--  Core Bootstrap Script -->
    <script src="<?php echo e(asset('assets/js/bootstrap.js')); ?>"></script>
    <!--  Flexslider Scripts --> 
    <script src="<?php echo e(asset('assets/js/jquery.flexslider.js')); ?>"></script>
    <!--  Scrolling Reveal Script -->
    <script src="<?php echo e(asset('assets/js/scrollReveal.js')); ?>"></script>
    <!--  Scroll Scripts --> 
    <script src="<?php echo e(asset('assets/js/jquery.easing.min.js')); ?>"></script>
    <!--  Custom Scripts --> 
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
</body>
</html>