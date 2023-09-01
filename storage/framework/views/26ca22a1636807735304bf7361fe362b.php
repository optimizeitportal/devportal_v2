<?php echo $__env->yieldContent('css'); ?>

<!-- Bootstrap Css -->
<link href="<?php echo e(asset('build/css/bootstrap.min.css')); ?>"  rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?php echo e(asset('build/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo e(asset('build/css/app.min.css')); ?>"  rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link href="<?php echo e(asset('assets/css/style-override.css')); ?>"  rel="stylesheet" type="text/css" />
<!-- App js -->
<script src="<?php echo e(asset('build/js/plugin.js')); ?>"></script>

<style>
    @import url('<?php echo e(asset("assets/fonts/amazon_webfonts/font.css")); ?>');

    * {
        font-family: 'Amazon Ember', sans-serif;
    }
</style>
<?php /**PATH /var/www/html/digitizer_v2/resources/views/layouts/head-css.blade.php ENDPATH**/ ?>