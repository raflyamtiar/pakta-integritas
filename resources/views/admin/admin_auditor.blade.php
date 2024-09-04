@extends('layouts.admin')

@section('title', 'Tabel Formulir Pakta Integritas Auditor')

@section('content')

<header>
    <h1>Tabel Formulir Pakta Integritas Auditor</h1>
</header>
<hr class="header-line">

<div class="search-section">
    <form action="{{ url()->current() }}" method="GET" autocomplete="off">
        <input type="text" name="search" placeholder="Search" class="search-box" value="{{ request('search') }}">
        <button type="submit" class="icon-search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="down-btn">
    <a href="/admin/add/auditor"><button class="btn-tambah">Tambah</button></a>
    <a href="{{ route('integritas.export', ['role' => $role]) }}"><button class="btn-export">Export Excel</button></a>
</div>

<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Lengkap</th>
            <th>Jabatan</th>
            <th>Instansi</th>
            <th>Email</th>
            <th>Nomor WhatsApp</th>
            <th>Print/ PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->jabatan }}</td>
            <td>{{ $item->instansi }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->no_whatsapp }}</td>
            <td>
                <a href="{{ route('integritas.download-pdf', ['role' => $role, 'id' => $item->id]) }}">
                    <div class="icon-action print"><i class="fa fa-print"></i></div>
                </a>
            </td>
            <td>
                <a href="{{ route('integritas.edit', ['role' => $role, 'id' => $item->id]) }}">
                    <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                </a>
            </td>
            <td>
                <form id="delete-form-{{ $item->id }}" action="{{ route('integritas.destroy', ['role' => $role, 'id' => $item->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="icon-action trash">
                        <button type="button" onclick="confirmDelete({{ $item->id }})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    <!-- Previous Page Link -->
    @if ($data->onFirstPage())
        <span class="disabled">&#x3C;</span>
    @else
        <a href="{{ $data->previousPageUrl() }}" rel="prev">&#x3C;</a>
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
        <a href="{{ $data->nextPageUrl() }}" rel="next">&#x3E;</a>
    @else
        <span class="disabled">&#x3E;</span>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('script/script-admin.js') }}"></script>
@endpush
