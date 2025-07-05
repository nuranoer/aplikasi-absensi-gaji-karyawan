<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('assets/logo/ssy.jpg') }}" alt="navbar brand" class="navbar-brand"
                            height="50" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <!-- Dashboard -->
                        <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                            <a href="{{ url(route('dashboard')) }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Data Karyawan -->
                        <li class="nav-item {{ request()->is('admin/karyawan*') ? 'active' : '' }}">
                            <a href="{{ url(route('admin.karyawan.index')) }}">
                                <i class="fas fa-users"></i>
                                <p>Data Karyawan</p>
                            </a>
                        </li>

                        <!-- Absensi -->
                        <li class="nav-item {{ request()->is('admin/absensi*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#absensi"
                                class="{{ request()->is('admin/absensi*') ? '' : 'collapsed' }}"
                                aria-expanded="{{ request()->is('absensi*') ? 'true' : 'false' }}">
                                <i class="fas fa-calendar-check"></i>
                                <p>Absensi</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/absensi*') ? 'show' : '' }}" id="absensi">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item {{ request()->is('admin/absensi') ? 'active' : '' }}">
                                        <a href="{{ url(route('admin.absensi')) }}">
                                            <span class="sub-item">Data Absensi</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin/absensi/info') ? 'active' : '' }}">
                                        <a href="{{ url(route('admin.absensi.info')) }}">
                                            <span class="sub-item">Perizinan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Slip Gaji -->
                        <li class="nav-item {{ request()->is('admin/slip*') ? 'active' : '' }}">
                            <a href="{{ url(route('admin.slip')) }}">
                                <i class="fas fa-wallet"></i>
                                <p>Data Slip Gaji</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>