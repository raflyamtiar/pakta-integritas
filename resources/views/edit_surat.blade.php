@extends('layouts.user')

@section('title', 'Edit Surat')

@section('content')

    <div class="container-edit-surat">
        <div class="title-edit-surat">
            <h2>EDIT SURAT PAKTA INTEGRITAS</h2>
        </div>
        <div class="form-user-edit">
            <form action="{{ route('user.update-surat', ['id' => $data->id]) }}" method="POST" id="form-container" class="form-container" autocomplete="off">
                @csrf
                @method('PUT') <!-- Tambahkan ini untuk menggunakan metode PUT -->
                <input type="hidden" name="role" value="{{ $data->role }}">
                <h3>FORMULIR PAKTA INTEGRITAS</h3>
                <div class="img-form"><img src="assets/pembatas.png" alt=""></div>
                <h3 id="role-title">{{ strtoupper($data->role) }}</h3>
                <!-- Form Fields -->
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span>*</span></label>
                    <input type="text" id="nama" name="nama" max-length="100" value="{{ $data->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan <span>*</span></label>
                    <input type="text" id="jabatan" name="jabatan" max-length="70" value="{{ $data->jabatan }}" required>
                </div>
                <div class="form-group">
                    <label for="instansi">Instansi <span>*</span></label>
                    <input type="text" id="instansi" name="instansi" max-length="70" value="{{ $data->instansi }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap <span>*</span></label>
                    <textarea id="alamat" name="alamat" max-length="255" required>{{ $data->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" value="{{ $data->email }}" required>
                </div>
                <div class="form-group">
                    <label for="kota">Kota <span>*</span></label>
                    <input type="text" id="kota" name="kota" max-length="35" value="{{ $data->kota }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal <span>*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ $data->tanggal }}" required>
                </div>
                <div class="form-group">
                    <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                        <small>Contoh: 81234567899</small>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">+62</div>
                        <input type="tel" id="no_whatsapp" name="no_whatsapp" value="{{ ltrim($data->no_whatsapp, '62') }}" class="form-control" placeholder="81234567899"
                            pattern="^\d{8,13}$" required>
                    </div>
                </div>
                <div class="btn-send-form">
                    <button type="submit">
                        Kirim <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="script.js"></script>
@endpush
