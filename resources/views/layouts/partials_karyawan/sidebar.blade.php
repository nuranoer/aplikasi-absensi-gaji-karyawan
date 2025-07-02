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
              <li class="nav-item {{ request()->is('dashboard_karyawan') ? 'active' : '' }}">
                <a href="{{ url('dashboard_karyawan') }}">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <!-- Absensi Kamera -->
              <li class="nav-item {{ request()->is('absensi/kamera*') ? 'active' : '' }}">
                <a href="{{ url('absensi/kamera') }}">
                  <i class="fas fa-camera"></i>
                  <p>Absensi Kamera</p>
                </a>
              </li>


              <!-- Info Kehadiran -->
              <li class="nav-item {{ request()->is('kehadiran*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#infoKehadiran" class="{{ request()->is('kehadiran*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->is('kehadiran*') ? 'true' : 'false' }}">
                  <i class="fas fa-clipboard-list"></i>
                  <p>Info Kehadiran</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse {{ request()->is('kehadiran*') ? 'show' : '' }}" id="infoKehadiran">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->is('kehadiran/riwayat') ? 'active' : '' }}">
                      <a href="{{ url('kehadiran/riwayat') }}">
                        <span class="sub-item">Riwayat Kehadiran</span>
                      </a>
                    </li>
                    <li class="{{ request()->is('kehadiran/pengajuan') ? 'active' : '' }}">
                      <a href="{{ url('kehadiran/pengajuan') }}">
                        <span class="sub-item">Pengajuan Izin/Cuti/Sakit</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <!-- Slip Gaji -->
              <li class="nav-item {{ request()->is('slip-gaji*') ? 'active' : '' }}">
                <a href="{{ url('slip-gaji') }}">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Slip Gaji</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
