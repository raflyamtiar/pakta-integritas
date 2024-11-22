@extends('layouts.admin')

@section('title', 'Tabel Lapor Spg')

@section('content')

    <header>
        <h1>Tabel Formulir Lapor Spg</h1>
    </header>
    <hr class="header-line">
    <!-- Panggil komponen search section -->
    <x-search_section />

    <!-- Panggil komponen lapor table -->
    <x-lapor_table :data="$data" />

    <!-- Panggil komponen pagination -->
    <x-pagination :paginator="$data" />


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
