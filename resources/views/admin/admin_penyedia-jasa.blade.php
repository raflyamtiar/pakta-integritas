@extends('layouts.admin')

@section('title', 'Tabel Formulir Pakta Integritas Penyedia Jasa')

@section('content')

<header>
    <h1>Tabel Formulir Pakta Integritas Penyedia Jasa</h1>
</header>
<hr class="header-line">

<!-- Panggil komponen search section -->
<x-search_section />

<!-- Panggil komponen data table -->
<x-data_table :data="$data" :role="$role" />

<!-- Panggil komponen pagination -->
<x-pagination :paginator="$data" />


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
