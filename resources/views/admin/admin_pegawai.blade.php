@extends('layouts.admin')

@section('title', 'Tabel Formulir Pakta Integritas Pegawai')

@section('content')

<header>
    <h1>Tabel Formulir Pakta Integritas Pegawai</h1>
</header>
<hr class="header-line">

<!-- Panggil komponen search section -->
<x-search_section />

<!-- Panggil komponen data table -->
<x-data_table :data="$data" :role="$role" />

<div class="pagination">
    <!-- Previous Page Link -->
    @if ($data->onFirstPage())
        <span class="disabled"><i class="fa-solid fa-caret-left"></i></span>
    @else
        <a href="{{ $data->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-caret-left"></i></a>
    @endif

    <!-- Pagination Elements -->
    @foreach ($data->links()->elements as $element)
        <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif

        <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $data->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($data->hasMorePages())
        <a href="{{ $data->nextPageUrl() }}" rel="next"><i class="fa-solid fa-caret-right"></i></a>
    @else
        <span class="disabled"><i class="fa-solid fa-caret-right"></i></span>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('script/script-admin.js') }}"></script>
@endpush
