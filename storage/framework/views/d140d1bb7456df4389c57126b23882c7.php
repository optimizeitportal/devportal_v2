<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <title> <?php echo $__env->yieldContent('title'); ?> | Optimize it</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="OptimizeIT Solutions" name="description" />
    <meta content="optimizeit" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>">
    <?php echo $__env->make('layouts.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>document.documentElement.setAttribute("data-bs-theme", "dark");</script>
</head>

<?php $__env->startSection('body'); ?>
    <body data-sidebar="dark" data-layout-mode="light" >
<?php echo $__env->yieldSection(); ?>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <div id="preloader" style="display: none">
            <div id="loader"></div>
            <div class="timer"></div>
            <div id="loader_text" style="display: none">
                <h6></h6>
                <span style="--i:1">.</span>
                <span style="--i:2">.</span>
                <span style="--i:3">.</span>
            </div>
        </div>
        <?php echo $__env->make('layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <?php echo $__env->make('layouts.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    <?php echo $__env->make('layouts.vendor-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
</body>

</html>
<?php /**PATH /var/www/html/digitizer_v2/resources/views/layouts/master.blade.php ENDPATH**/ ?>