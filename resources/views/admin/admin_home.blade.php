@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <header>
        <h1>Selamat Datang, Admin SMI Pakta Integritas</h1>
    </header>
    <hr class="header-line">
    <div class="cards-admin">
        <div class="card green">
            <h2>Pakta Integritas Pegawai</h2>
            <p>Jumlah</p>
            <a href="{{ route('admin.role', ['role' => 'pegawai']) }}">
                <h3>{{ $countPegawai ?? 0 }}</h3>
            </a>
            <hr>
            <a href="{{ route('admin.role', ['role' => 'pegawai']) }}">
                <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
            </a>
            <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
        </div>
        <div class="card blue">
            <h2>Pakta Integritas Penyedia Jasa</h2>
            <p>Jumlah</p>
            <a href="{{ route('admin.role', ['role' => 'penyedia-jasa']) }}">
                <h3>{{ $countPenyediaJasa ?? 0 }}</h3>
            </a>
            <hr>
            <a href="{{ route('admin.role', ['role' => 'penyedia-jasa']) }}">
                <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
            </a>
            <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
        </div>
        <div class="card yellow">
            <h2>Pakta Integritas Pengguna Jasa</h2>
            <p>Jumlah</p>
            <a href="{{ route('admin.role', ['role' => 'pengguna-jasa']) }}">
                <h3>{{ $countPenggunaJasa ?? 0 }}</h3>
            </a>
            <hr>
            <a href="{{ route('admin.role', ['role' => 'pengguna-jasa']) }}">
                <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
            </a>
            <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
        </div>

        <div class="card red">
            <h2>Pakta Integritas Auditor</h2>
            <p>Jumlah</p>
            <a href="{{ route('admin.role', ['role' => 'auditor']) }}">
                <h3>{{ $countAuditor ?? 0 }}</h3>
            </a>
            <hr>
            <a href="{{ route('admin.role', ['role' => 'auditor']) }}">
                <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
            </a>
            <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
        </div>

        <div class="card purple">
            <h2>Laporan Suap Pungli Gratifikasi</h2>
            <p>Jumlah</p>
            <a href="/admin/lapor">
                <h3>{{ $totalLaporanSpg ?? 0 }}</h3>
            </a>
            <hr>
            <a href="/admin/lapor">
                <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
            </a>
            <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
        </div>
    </div>

    <div class="container-chart-title">
        <h2>Grafik Surat Masuk</h2>
        <hr>
        <div class="dropdown-chart-year">
            <label for="yearSelect">Pilih Tahun:</label>
            <select id="yearSelect">
                @php
                    $currentYear = now()->year;
                    for ($i = $currentYear - 2; $i <= $currentYear + 2; $i++) {
                        echo "<option value='{$i}'" . ($i == $currentYear ? ' selected' : '') . ">{$i}</option>";
                    }
                @endphp
            </select>
        </div>
        <div class="dropdown-chart-status">
            <label for="statusSelect">Pilih Status Surat:</label>
            <select id="statusSelect">
                <option value="semua">Semua</option>
                <option value="diterima">Diterima</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>
        <div class="container-chart">
            <div class="card-chart">
                <div class="card-header-chart">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>Grafik Keseluruhan Surat Masuk</h4>
                </div>
                <div class="card-body-chart">
                    <canvas id="chartSemua" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="card-chart">
                <div class="card-header-chart">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>Grafik Surat Masuk Pegawai</h4>
                </div>
                <div class="card-body-chart">
                    <canvas id="chartPegawai" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="card-chart">
                <div class="card-header-chart">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>Grafik Surat Masuk Penyedia Jasa</h4>
                </div>
                <div class="card-body-chart">
                    <canvas id="chartPenyedia" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="card-chart">
                <div class="card-header-chart">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>Grafik Surat Masuk Pengguna Jasa</h4>
                </div>
                <div class="card-body-chart">
                    <canvas id="chartPengguna" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="card-chart">
                <div class="card-header-chart">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>Grafik Surat Masuk Auditor</h4>
                </div>
                <div class="card-body-chart">
                    <canvas id="chartAuditor" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="card-chart">
                <div class="card-header-chart">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>Grafik Laporan SPG</h4>
                </div>
                <div class="card-body-chart">
                    <canvas id="chartSpg" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Passing data dari controller ke JavaScript -->
    <script>
        var monthlyData = {!! json_encode(array_values($monthlyData)) !!};
        var monthlyDataPegawai = {!! json_encode(array_values($monthlyDataPegawai)) !!};
        var monthlyDataPenyedia = {!! json_encode(array_values($monthlyDataPenyedia)) !!};
        var monthlyDataPengguna = {!! json_encode(array_values($monthlyDataPengguna)) !!};
        var monthlyDataAuditor = {!! json_encode(array_values($monthlyDataAuditor)) !!};
        var monthlyDataLaporSpg = {!! json_encode(array_values($monthlyDataLaporSpg)) !!}; // Tambahkan data LaporSpg
    </script>

    <script src="{{ asset('script/script-admin.js') }}"></script>

@endsection
