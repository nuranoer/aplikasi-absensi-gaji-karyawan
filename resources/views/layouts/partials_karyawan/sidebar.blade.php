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

                        <!-- Info Kehadiran -->
                        <li class="nav-item {{ request()->is('karyawan/absensi*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#absensi"
                                class="{{ request()->is('karyawan/absensi*') ? '' : 'collapsed' }}"
                                aria-expanded="{{ request()->is('absensi*') ? 'true' : 'false' }}">
                                <i class="fas fa-calendar-check"></i>
                                <p>Absensi</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('karyawan/absensi') ? 'show' : '' }}" id="absensi">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item {{ request()->is('karyawan/absensi/masuk') ? 'active' : '' }}">
                                        <a href="{{ route('karyawan.absensi.masuk') }}">
                                            <span class="sub-item">Masuk</span>
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('karyawan/absensi/pulang') ? 'active' : '' }}">
                                        <a href="{{ url(route('karyawan.absensi.pulang')) }}">
                                            <span class="sub-item">Pulang</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{ request()->is('karyawan/perizinan*') ? 'active' : '' }}">
                            <a href="{{ route('karyawan.perizinan') }}">
                                <i class="fas fa-book"></i>
                                <p>Perizinan</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('karyawan/riwayat*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#riwayat" class="{{ request()->is('karyawan/riwayat*') ? '' : 'collapsed' }}"
                                aria-expanded="{{ request()->is('karyawan/riwayat*') ? 'true' : 'false' }}">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Riwayat</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('karyawan/riwayat') ? 'show' : '' }}" id="riwayat">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item {{ request()->is('karyawan/riwayat') ? 'active' : '' }}">
                                        <a href="{{ route('karyawan.riwayat') }}">
                                            <span class="sub-item">Absensi</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('karyawan/riwayat/perizinan') ? 'active' : '' }}">
                                        <a href="{{ url(route('karyawan.riwayat.perizinan')) }}">
                                            <span class="sub-item">Perizinan</span>
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