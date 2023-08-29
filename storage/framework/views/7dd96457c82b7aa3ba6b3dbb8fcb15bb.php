<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- DataTables -->
    <link href="<?php echo e(URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo e(URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?php echo e(URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')); ?>"
        rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Dashboards <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Dashboard <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">

    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Doc Count</p>
                                <h4 class="mb-0"><?php echo e($doc_metrics['doc_count']); ?></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Processed</p>
                                <h4 class="mb-0"><?php echo e($doc_metrics['processed']); ?></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-cog font-size-24"></i>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Extracted</p>
                                <h4 class="mb-0"><?php echo e($doc_metrics['extracted']); ?></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-archive-in font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documents</th>
                            <th scope="col">Uploaded On</th>
                            <th scope="col">Status</th>
                            <th scope="col" data-orderable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($uploaded_list)): ?>
                            <?php $__currentLoopData = $uploaded_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($k + 1); ?></td>
                                    <td><?php echo e($list_val['file_name']); ?>

                                    </td>
                                    <td data-sort="<?php echo e(strtotime($list_val['updated_on'])); ?>">
                                        <?php echo e($list_val['updated_on']); ?></td>
                                    <td><?php echo e($list_val['status']  == "UPLOADED" ? "PROCESSING" : $list_val['status']); ?></td>
                                    <td>
                                        <a
                                            href="<?php echo e($list_val['status'] == 'UPLOADED' ? "javascript:void(0)" : url('doc_verify?file=' . $list_val['files'])); ?>&action=view">
                                            <button class="btn action_btn view"
                                                data-toggle="tooltip" data-placement="top"
                                                <?php if( $list_val['status'] == 'UPLOADED'): ?>
                                                data-bs-html="true"
                                                title="<img width='17px' height='17px' src='<?php echo e(asset('images/spinner.gif')); ?>'> <p>Please wait till the file is processed<p>"
                                                <?php else: ?>
                                                title="view"
                                                <?php endif; ?>
                                                > <i class="fa fa-eye"></i></button>
                                        </a>
                                        <a
                                            href="<?php echo e($list_val['status'] == 'UPLOADED' ? "javascript:void(0)" : url('doc_verify?file=' . $list_val['files'])); ?>&action=edit">
                                            <button class="btn action_btn edit"
                                                data-toggle="tooltip" data-placement="top"
                                                <?php if( $list_val['status'] == 'UPLOADED'): ?>
                                                data-bs-html="true"
                                                title="<img width='17px' height='17px' src='<?php echo e(asset('images/spinner.gif')); ?>'> <p>Please wait till the file is processed<p>"
                                                <?php else: ?>
                                                title="Edit"
                                                <?php endif; ?>
                                                    >


                                                <i class="fa fa-edit"></i></button>
                                        </a>
                                        <a
                                            href="<?php echo e($list_val['status'] == 'UPLOADED' ? "javascript:void(0)" : url('download_document?file_name=' . session('account_id') . '/' . current(explode('.', $list_val['files'])) . '_Key_Value_Result.json')); ?>">
                                            <button class="btn action_btn download"
                                                data-toggle="tooltip" data-placement="top"
                                                <?php if( $list_val['status'] == 'UPLOADED'): ?>
                                                data-bs-html="true"
                                                title="<img width='17px' height='17px' src='<?php echo e(asset('images/spinner.gif')); ?>'> <p>Please wait till the file is processed<p>"
                                                <?php else: ?>
                                                title="Download"
                                                <?php endif; ?>

                                                > <i
                                                    class="fa fa-download"></i></button>
                                        </a>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr class="text-center">
                                <td colspan="5">
                                    No Data available!
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- Transaction Modal -->
<div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div>
                                        <img src="<?php echo e(URL::asset('build/images/product/img-7.png')); ?>" alt="" class="avatar-sm">
                                    </div>
                                </th>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                        <p class="text-muted mb-0">$ 225 x 1</p>
                                    </div>
                                </td>
                                <td>$ 255</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div>
                                        <img src="<?php echo e(URL::asset('build/images/product/img-4.png')); ?>" alt="" class="avatar-sm">
                                    </div>
                                </th>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                        <p class="text-muted mb-0">$ 145 x 1</p>
                                    </div>
                                </td>
                                <td>$ 145</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                </td>
                                <td>
                                    $ 400
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Shipping:</h6>
                                </td>
                                <td>
                                    Free
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    $ 400
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- subscribeModal -->

<!-- end modal -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="<?php echo e(URL::asset('build/libs/apexcharts/apexcharts.min.js')); ?>"></script>

<!-- dashboard init -->
<script src="<?php echo e(URL::asset('build/js/pages/dashboard.init.js')); ?>"></script>
  <!-- Required datatable js -->
  <script src="<?php echo e(URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
  <!-- Buttons examples -->
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('build/libs/jszip/jszip.min.js')); ?>"></script>
  
  <script src="<?php echo e(URL::asset('build/libs/pdfmakebuild/vfs_fonts.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js')); ?>"></script>

  <!-- Responsive examples -->
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')); ?>"></script>
  <!-- Datatable init js -->
  <script src="<?php echo e(URL::asset('build/js/pages/datatables.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Laravel_projects\devportel\devportal_v2\resources\views/dashboard.blade.php ENDPATH**/ ?>