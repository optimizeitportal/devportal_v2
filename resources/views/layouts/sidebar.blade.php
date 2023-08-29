<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="index" key="t-default">@lang('translation.Default')</a></li>
                        <li><a href="dashboard-saas" key="t-saas">@lang('translation.Saas')</a></li>
                        <li><a href="dashboard-crypto" key="t-crypto">@lang('translation.Crypto')</a></li>
                        <li><a href="dashboard-blog" key="t-blog">@lang('translation.Blog')</a></li>
                        <li><a href="dashboard-job">@lang('translation.Jobs')</a></li>
                    </ul>
                </li> --}}
                <li>
                    <a href="{{url('dashboard')}}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-dashboard">D-Board</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('doc_verify')}}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-doc_verify">D-Verify</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
