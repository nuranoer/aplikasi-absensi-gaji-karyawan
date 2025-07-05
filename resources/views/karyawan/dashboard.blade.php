@extends('layouts.templates.main_karyawan')
@section('title', 'Dashboard Karyawan')

@section('content')
    <!-- Statistik Singkat -->
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Hadir Bulan Ini</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-danger bubble-shadow-small">
                  <i class="fas fa-user-times"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Tidak Hadir</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-money-check-alt"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Gaji</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Jumlah Karyawan</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Grafik & Slip Gaji -->
    <div class="row">
      <div class="col-md-8">
        <div class="card card-round">
          <div class="card-header">
            <h4 class="card-title">Grafik Absensi Bulan Ini</h4>
          </div>
          <div class="card-body">
            <canvas id="absensiChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-round">
          <div class="card-header">
            <h4 class="card-title">Slip Gaji Terbaru</h4>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
@endpush
