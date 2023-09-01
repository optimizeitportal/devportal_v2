<?php if(isset($tables) && !empty($tables)): ?>
    <div class="card">
        <div class="table-responsive">
            
            <form id="tableData" action="<?php echo e(url('/send_tables')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="thead_data" value="<?php echo e(serialize($tables[0])); ?>">
                <table class="table " style="table-layout: fixed; width:100%;">
                    <thead class="table-light">
                        <tr>
                            <?php $__currentLoopData = $tables[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th scope="col" style="font-size: 0.88rem" width="100vw" ><?php echo e($thead); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php unset($tables[0]); ?>
                        </tr>
    
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $tbody): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td <?php echo e($k2==0 ? 'scope="row"' : ''); ?>> <input type="text" name="table[<?php echo e($k1); ?>][<?php echo e($k2); ?>]" class="input-bordered" value="<?php echo e($tbody); ?>" style="width:80%"> </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
<?php elseif(isset($table_new) && !empty($table_new)): ?>

    <?php
        $nav_tab_id = array_keys($table_new);
        $i=1;
    ?>
    <?php if(count($nav_tab_id) > 1): ?>
    <div class="pagination_cont">
        <ul id="table_pagination" class="nav tab-nav simple-pagination">
            <?php $__currentLoopData = $nav_tab_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab_key=> $tab_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>         
                <li>
                    <a class="" data-toggle="tab" href="#<?php echo e($tab_id); ?>"><?php echo e($tab_key+1); ?>  </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="tab-content" style="padding: 0px 15px;">
        
        <?php $__currentLoopData = $table_new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="tab-pane fade p-0 show <?php echo e(current($nav_tab_id) ==$key ? 'active': ''); ?>" id="_table_<?php echo e($i++); ?>">
                <div class="table-responsive">
                    <table class="table Table_data">
                        <?php if(isset($table['header'])): ?>
                            <thead class="table-light">
                                <?php $__currentLoopData = $table['header']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h_row_key=> $h_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $h_row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h_col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th  rowspan="<?php echo e($h_col['Row_Span']); ?>" colspan="<?php echo e($h_col['Column_Span']); ?>" scope="col" style="font-size: 0.72rem"  ><?php echo e($h_col['Cell_Text'] ?? $h_col['Merged_Cell_Text']); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </thead>
                        <?php endif; ?>
                        <?php if(isset($table['body'])): ?>
                            <tbody>
                                <?php $__currentLoopData = $table['body']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b_row_key=> $b_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $b_row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b_ckey => $b_col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $confidence = isset($b_col['Merged_Cell_Confidence']) ? $b_col['Merged_Cell_Confidence'] : $b_col['Cell_Confidence'];
                                                    if ($confidence > 90) {
                                                        $color = 'green';
                                                    } elseif ($confidence > 80) {
                                                        $color = 'Yellow';
                                                    } elseif ($confidence > 50) {
                                                        $color = 'orange';
                                                    } else {
                                                        $color = 'red';
                                                    }
                                            ?>
                                            <td rowspan="<?php echo e($b_col['Row_Span']); ?>" colspan="<?php echo e($b_col['Column_Span']); ?>"> 
                                                <input 
                                                    type="text"  
                                                    data-width="<?php echo e($b_col['Cell_Loc']['Width'] ?? $b_col['Merged_Cell_Loc']['Width'] ?? ''); ?>"
                                                    data-height="<?php echo e($b_col['Cell_Loc']['Height'] ?? $b_col['Merged_Cell_Loc']['Height'] ?? ''); ?>"
                                                    data-left="<?php echo e($b_col['Cell_Loc']['Left'] ?? $b_col['Merged_Cell_Loc']['Left'] ?? ''); ?>"
                                                    data-top="<?php echo e($b_col['Cell_Loc']['Top'] ??$b_col['Merged_Cell_Loc']['Top'] ?? ''); ?>"
                                                    name="table[<?php echo e($key); ?>][<?php echo e($b_row_key); ?>][<?php echo e($b_ckey); ?>]" 
                                                    class="form-control  input-bordered BoundingBoxInput" value="<?php echo e($b_col['Cell_Text'] ?? $b_col['Merged_Cell_Text']); ?>" 
                                                    style="width:100%; height:33px; border-bottom: <?php echo e($color); ?> 2px solid;"
                                                > 
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="not_found">No Data available!</div>
<?php endif; ?>
<?php /**PATH /var/www/html/digitizer_v2/resources/views/components/documents/table.blade.php ENDPATH**/ ?>