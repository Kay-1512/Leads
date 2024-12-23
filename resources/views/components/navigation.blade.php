<aside class="left-sidebar with-horizontal">
    <!-- Sidebar scroll-->
    <div>
        <!-- Sidebar navigation-->
        <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->
                <li class="sidebar-item selected">
                    <a class="sidebar-link" href="{{ route('/') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home-2"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>

                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('clients') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home-2"></i>
                        </span>
                        <span class="hide-menu">Clients</span>
                    </a>

                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('sso.switch_to_pandabot') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home-2"></i>
                        </span>
                        <span class="hide-menu">Programs</span>
                    </a>

                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>