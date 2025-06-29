<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="{{ url('dashboard') }}">
                            <img src="{{ asset('assets/logo/ssy.jpg') }}" alt="Logo">
                        </a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block">
                            <i class="bi bi-x bi-middle"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('dashboard') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('karyawan*') ? 'active' : '' }}">
                        <a href="{{ url('karyawan') }}" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Data Karyawan</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('absensi*') ? 'active' : '' }}">
                        <a href="{{ url('absensi') }}" class='sidebar-link'>
                            <i class="bi bi-calendar-check-fill"></i>
                            <span>Data Absensi</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub {{ request()->is('slip-gaji*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-wallet-fill"></i>
                            <span>Slip Gaji Karyawan</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ request()->is('slip-gaji') ? 'active' : '' }}">
                                <a href="{{ url('slip-gaji') }}">Lihat Slip Gaji</a>
                            </li>
                            <li class="submenu-item {{ request()->is('slip-gaji/cetak') ? 'active' : '' }}">
                                <a href="{{ url('slip-gaji/cetak') }}">Cetak Slip Gaji</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
</div>
