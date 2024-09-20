@extends('layouts.admin')

@section('title', 'Edit Data ' . ucfirst($role))

@section('content')

<header>
    <h1>Edit Data Pakta Integritas {{ $role }}</h1>
</header>
<hr class="header-line">

<div class="isi-form" id="isi-form">
    <div class="form-container-wrapper">
        <form action="{{ route('integritas.update', ['role' => $role, 'id' => $data->id]) }}" method="POST" id="form-container" class="form-container" >
            @csrf
            @method('PUT') <!-- Tambahkan ini untuk menggunakan metode PUT -->
            <input type="hidden" name="role" value="{{ $role }}">

            <h3>FORMULIR PAKTA INTEGRITAS</h3>
            <div class="img-form">
                <img src="{{ asset('assets/pembatas.png') }}" alt="">
            </div>
            <h3 id="role-title">{{ strtoupper($role) }}</h3>

            <!-- Error Message Handling -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form fields dengan data yang diisi -->
            <div class="form-group">
                <label for="nama">Nama Lengkap <span>*</span></label>
                <input type="text" id="nama" name="nama" max-length="100" value="{{ old('nama', $data->nama) }}" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan <span>*</span></label>
                <input type="text" id="jabatan" name="jabatan" max-length="50" value="{{ old('jabatan', $data->jabatan) }}" required>
            </div>
            <div class="form-group">
                <label for="instansi">Instansi <span>*</span></label>
                <input type="text" id="instansi" name="instansi" max-length="70" value="{{ old('instansi', $data->instansi) }}" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lengkap <span>*</span></label>
                <textarea id="alamat" name="alamat" max-length="255" required>{{ old('alamat', $data->alamat) }}</textarea>
            </div>
            <div class="form-group">
                <label for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $data->email) }}" required>
            </div>
            <div class="form-group">
                <label for="kota">Kota <span>*</span></label>
                <input type="text" id="kota" name="kota" max-length="35" value="{{ old('kota', $data->kota) }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal <span>*</span></label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $data->tanggal) }}" required>
            </div>
            <div class="form-group">
                <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                    <small>Contoh: 81234567899</small>
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">+62</div>
                    <input type="tel" id="no_whatsapp" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp', ltrim($data->no_whatsapp, '62')) }}" placeholder="81234567899"
                        pattern="^\d{8,13}$" required>
                </div>
            </div>

            <div class="btn-send-form">
                <button type="submit">
                    Update <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
