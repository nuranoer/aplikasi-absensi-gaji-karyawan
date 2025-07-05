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
                        <li class="nav-item {{ request()->is('karyawan') ? 'active' : '' }}">
                            <a href="{{ route('karyawan.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Absensi Kamera -->
                        <li class="nav-item {{ request()->is('karyawan/kamera*') ? 'active' : '' }}">
                            <a href="{{ route('karyawan.absensi.kamera') }}">
                                <i class="fas fa-camera"></i>
                                <p>Absensi</p>
                            </a>
                        </li>


                        <!-- Info Kehadiran -->
                        <li class="nav-item {{ request()->is('karyawan/absensi*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#absensi" class="{{ request()->is('karyawan/absensi*') ? '' : 'collapsed' }}"
                                aria-expanded="{{ request()->is('absensi*') ? 'true' : 'false' }}">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Kehadiran</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('karyawan/absensi*') ? 'show' : '' }}" id="absensi">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item {{ request()->is('karyawan/absensi') ? 'active' : '' }}">
                                        <a href="{{ url(route('karyawan.absensi')) }}">
                                            <span class="sub-item">Riwayat</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('karyawan/absensi/pengajuan') ? 'active' : '' }}">
                                        <a href="{{ url(route('karyawan.absensi.pengajuan')) }}">
                                            <span class="sub-item">Pengajuan Izin</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Slip Gaji -->
                        <li class="nav-item {{ request()->is('karyawan/slip*') ? 'active' : '' }}">
                            <a href="{{ route('karyawan.slip') }}">
                                <i class="fas fa-money-check-alt"></i>
                                <p>Slip Gaji</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>