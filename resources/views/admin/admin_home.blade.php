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
@endsection

@push('scripts')
<script src="{{ asset('script/script-admin.js') }}"></script>
@endpush
