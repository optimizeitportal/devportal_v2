<?php if($forms): ?>
<div class="mb-4">
    <select name="" id="select2" class="p-3">
        <option value="">Select text</option>
        <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            //    $value = explode('.', $val[0]['Key_Text']);
             
            //    if(count($value) > 1){
            //         unset($value[0]);
            //     }
            //     $value = implode('.',$value);
              
            ?>
            
            <option data-trigger-id="#input<?php echo e($key); ?>" value="<?php echo e($val[0]['Key_Text'] ?? ""); ?>"><?php echo e($val[0]['Key_Text'] ?? ""); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
    <div class="token-box-top mb-5">
        
        <form id="formsData" action="" method="post">
            <?php echo csrf_field(); ?>
            <div class="row gutter-vr-30px form_cont ">

                <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        if ($form[1]['Value_Confidence'] > 90) {
                            $color = 'green';
                        } elseif ($form[1]['Value_Confidence'] > 80) {
                            $color = 'Yellow';
                        } elseif ($form[1]['Value_Confidence'] > 50) {
                            $color = 'orange';
                        }else {
                            $color = 'red';
                        }
                        $val = $form[1]['Value_Text'] ?? "";

                        if ((isset($form[0]['Key_Mandatory']) && $form[0]['Key_Mandatory'] == "Y") && ($val =="" || $val=='VALUE_NOT_FOUND')) {
                            $color = 'red';
                        }
                    ?>
                
                    <div class="col-lg-4 col-md-6 px-1 py-1">
                        <div class="token-sale-box"> <span class="token-sale-title"
                                style="display:inline-block;"><?php echo e($form[0]['Key_Text'] ?? ''); ?></span>
                            <div class="field-wrap">
                                <input name="input[<?php echo e($key); ?>]" id="input<?php echo e($key); ?>"
                                    data-width="<?php echo e($form[1]['Value_Loc']['Width'] ?? ''); ?>"
                                    data-height="<?php echo e($form[1]['Value_Loc']['Height'] ?? ''); ?>"
                                    data-left="<?php echo e($form[1]['Value_Loc']['Left'] ?? ''); ?>"
                                    data-top="<?php echo e($form[1]['Value_Loc']['Top'] ?? ''); ?>" type="text"
                                    class="form-control input-bordered BoundingBoxInput" value="<?= $form[1]['Value_Text'] ?? '' ?>"
                                    style="border-bottom: <?php echo e($color); ?> 2px solid;" 
                                />

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="form_data" value="<?php echo e(serialize($forms)); ?>">
            </div>
        </form>
    </div>
<?php else: ?>
    <div class="not_found">No Data available!</div>
<?php endif; ?>
<?php /**PATH /var/www/html/digitizer_v2/resources/views/components/documents/form.blade.php ENDPATH**/ ?>