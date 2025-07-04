  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
                src="{{ asset('assets/logo/ssy.jpg') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="50"
              />
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
              <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <!-- Data Karyawan -->
              <li class="nav-item {{ request()->is('karyawan*') ? 'active' : '' }}">
                <a href="{{ url('karyawan') }}">
                  <i class="fas fa-users"></i>
                  <p>Data Karyawan</p>
                </a>
              </li>

              <!-- Absensi -->
              <li class="nav-item {{ request()->is('absensi*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#absensi" class="{{ request()->is('absensi*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->is('absensi*') ? 'true' : 'false' }}">
                  <i class="fas fa-calendar-check"></i>
                  <p>Absensi</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse {{ request()->is('absensi*') ? 'show' : '' }}" id="absensi">
                  <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->is('absensi') ? 'active' : '' }}">
                      <a href="{{ url('absensi') }}">
                        <span class="sub-item">Data Absensi</span>
                      </a>
                    </li>
                    <li class="nav-item {{ request()->is('absensi/info') ? 'active' : '' }}">
                      <a href="{{ url('absensi/info') }}">
                        <span class="sub-item">Info Kehadiran</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <!-- Slip Gaji -->
              <li class="nav-item {{ request()->is('slip-gaji*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#slipGaji" class="{{ request()->is('slip-gaji*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->is('slip-gaji*') ? 'true' : 'false' }}">
                  <i class="fas fa-wallet"></i>
                  <p>Slip Gaji Karyawan</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse {{ request()->is('slip-gaji*') ? 'show' : '' }}" id="slipGaji">
                  <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->is('slip-gaji') ? 'active' : '' }}">
                      <a href="{{ url('slip-gaji') }}">
                        <span class="sub-item">Lihat Slip Gaji</span>
                      </a>
                    </li>
                    <li class="nav-item {{ request()->is('slip-gaji/cetak') ? 'active' : '' }}">
                      <a href="{{ url('slip-gaji/cetak') }}">
                        <span class="sub-item">Cetak Slip Gaji</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>

          </div>
        </div>
      </div>
