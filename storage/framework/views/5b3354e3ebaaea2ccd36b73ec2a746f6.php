<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu"><?php echo app('translator')->get('translation.Menu'); ?></li>

                
                <li>
                    <a href="<?php echo e(url('dashboard')); ?>" class="waves-effect">
                        <i class='bx bxs-dashboard'></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="waves-effect">
                        <i class='bx bxs-bar-chart-alt-2' ></i>
                        <span key="t-dashboard">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(url('d-board')); ?>" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-dashboard">D-Board</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(url('doc_verify')); ?>" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-doc_verify">D-Verify</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="waves-effect">
                        <i class='bx bx-conversation' ></i>
                        <span key="t-doc_verify">support </span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH /var/www/html/digitizer_v2/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>