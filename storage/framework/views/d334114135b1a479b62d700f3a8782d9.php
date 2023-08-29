
<?php if($raw_text): ?>
<div class="raw_text_cont">
    
    
    <?php $__currentLoopData = $raw_text; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
        
            
                <span
                    class="raw_text_val"
                    data-width="<?php echo e($field['BoundingBox']['Width'] ?? ''); ?>"
                    data-height="<?php echo e($field['BoundingBox']['Height'] ?? ''); ?>"
                    data-left="<?php echo e($field['BoundingBox']['Left'] ?? ''); ?>"
                    data-top="<?php echo e($field['BoundingBox']['Top'] ?? ''); ?>" 
                >
                    <?= $field['Text'] ?>
                </span>
            
        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php else: ?>
<div class="not_found">No Data available!</div>
<?php endif; ?>
<?php /**PATH E:\Laravel_projects\devportel\devportal_v2\resources\views/components/documents/raw_text.blade.php ENDPATH**/ ?>