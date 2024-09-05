@extends('layouts.user')

@section('title', 'Download Surat')

@section('content')

    <div class="container-down-surat">
        <div class="title-down-surat">
            <h2>SURAT PAKTA INTEGRITAS</h2>
        </div>
        <div class="container-down-surat-content">
            <div class="add-surat">
                <a href="/#isi-form">
                    <h5><i class="fa-solid fa-square-plus"></i> Buat Surat Baru</h5>
                </a>
            </div>
            @if ($paktaIntegritas && $paktaIntegritas->isNotEmpty())
            <table class="table-down-surat">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Instansi</th>
                        <th>Email</th>
                        <th>Nomor WhatsApp</th>
                        <th>Print/PDF</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paktaIntegritas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->instansi }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_whatsapp }}</td>
                        <td>
                            <a href="{{ route('integritas.download-pdf', ['role' => $item->role, 'id' => $item->id]) }}">
                                <div class="icon-action print"><i class="fa fa-print"></i></div>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('user.edit-surat', ['id' => $item->id]) }}">
                                <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>Tidak ada data pakta integritas tersedia.</p>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
<script src="script.js"></script>
@endpush
