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
</div>

<div class="container-chart">
    <div class="card-chart">
        <div class="card-header-chart">
            <i class="fa-solid fa-chart-line"></i>
            <h2>Grafik Surat Masuk</h2>
        </div>
        <div class="card-body-chart">
            <!-- Dropdown untuk kategori surat -->
            <div class="form-group-chart">
                <label for="filterSurat">Filter Kategori Surat:</label>
                <select id="filterSurat" class="form-control-chart" onchange="updateChart()">
                    <option value="semua">Keseluruhan</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="penyedia-jasa">Penyedia Jasa</option>
                    <option value="pengguna-jasa">Pengguna Jasa</option>
                    <option value="auditor">Auditor</option>
                </select>
            </div>
            <div class="chart-container-chart">
                <div class="chart-header">
                    <h3><i class="fa fa-chart-area"></i> Grafik Surat Masuk</h3>
                    <!-- Dropdown untuk tahun -->
                    <select id="filterTahun" class="form-control-chart" onchange="updateChart()"></select>
                </div>
                <canvas id="suratMasukChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Passing data dari controller ke JavaScript -->
<script>
    var monthlyData = {!! json_encode(array_values($monthlyData)) !!}; // Data surat keseluruhan
    var monthlyDataPegawai = {!! json_encode(array_values($monthlyDataPegawai)) !!}; // Data Pegawai
    var monthlyDataPenyedia = {!! json_encode(array_values($monthlyDataPenyedia)) !!}; // Data Penyedia Jasa
    var monthlyDataPengguna = {!! json_encode(array_values($monthlyDataPengguna)) !!}; // Data Pengguna Jasa
    var monthlyDataAuditor = {!! json_encode(array_values($monthlyDataAuditor)) !!}; // Data Auditor
</script>

<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
