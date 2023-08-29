<?php echo $__env->yieldContent('css'); ?>

<!-- Bootstrap Css -->
<link href="<?php echo e(URL::asset('build/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?php echo e(URL::asset('build/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo e(URL::asset('build/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
<!-- App js -->
<script src="<?php echo e(URL::asset('build/js/plugin.js')); ?>"></script>

<style>
    @import url('<?php echo e(asset("assets/fonts/amazon_webfonts/font.css")); ?>');

    * {
        font-family: 'Amazon Ember', sans-serif;
    }
</style>
<?php /**PATH E:\Laravel_projects\devportel\devportal_v2\resources\views/layouts/head-css.blade.php ENDPATH**/ ?>