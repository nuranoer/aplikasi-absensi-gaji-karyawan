@extends('layouts.templates.main_karyawan')
@section('title', 'Dashboard')

@php
    function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        $i = 0;

        while ($num >= 1000 && $i < count($units) - 1) {
            $num /= 1000;
            $i++;
        }

        return preg_replace('/\.0$/', '', number_format($num, 1)) . $units[$i];
    }

@endphp

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Hadir</p>
                                <h4 class="card-title">{{ number_format($hadir)  }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-md-4">
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
                                <h4 class="card-title">{{ number_format($tidakHadir) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Gaji</p>
                                <h4 class="card-title">Rp{{ shortNumber($totalGaji) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <ul>
                        @forelse ($slipTerbaru as $slip)
                            <li>
                                Rp{{number_format($slip->total_gaji)}}
                            </li>
                        @empty
                            <li class="text-center">
                                Tidak ada data
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('absensiChart').getContext('2d');
        const absenChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Tidak Hadir'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ $hadir }}, {{ $tidakHadir }}],
                    backgroundColor: ['#1e88e5', '#e53935'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>
@endsection