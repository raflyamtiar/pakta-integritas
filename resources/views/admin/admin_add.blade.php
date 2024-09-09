@extends('layouts.admin')

@section('title', 'Formulir Pakta Integritas - ' . ucfirst($role))

@section('content')

<header>
    <h1>Silahkan Isi Formulir Berikut</h1>
</header>
<hr class="header-line">

<div class="isi-form" id="isi-form">
    <form action="{{ route('integritas.store', ['role' => $role]) }}" method="POST" id="form-container" class="form-container" autocomplete="off">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">
        <input type="hidden" name="is_admin" value="true">

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

        <div class="form-group">
            <label for="nama">Nama Lengkap <span>*</span></label>
            <input type="text" id="nama" name="nama" max-length="100" value="{{ old('nama') }}" required>
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan <span>*</span></label>
            <input type="text" id="jabatan" name="jabatan" max-length="70" value="{{ old('jabatan') }}" required>
        </div>
        <div class="form-group">
            <label for="instansi">Instansi <span>*</span></label>
            <input type="text" id="instansi" name="instansi" max-length="70" value="{{ old('instansi') }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Lengkap <span>*</span></label>
            <textarea id="alamat" name="alamat" max-length="255" required>{{ old('alamat') }}</textarea>
        </div>
        <div class="form-group">
            <label for="email">Email <span>*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="kota">Kota <span>*</span></label>
            <input type="text" id="kota" name="kota" max-length="35" value="{{ old('kota') }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal <span>*</span></label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
        </div>
        <div class="form-group">
            <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                <small>Contoh: 81234567899</small>
            </label>
            <div class="input-group">
                <div class="input-group-prepend">+62</div>
                <input type="tel" id="no_whatsapp" name="no_whatsapp" class="form-control" placeholder="81234567899"
                    pattern="^\d{8,13}$" value="{{ old('no_whatsapp') }}" required>
            </div>
        </div>

        <div class="btn-send-form">
            <button type="submit">
                Kirim <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </form>
</div>

<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
