@extends('layouts.admin')

@section('title', 'Tambah Data ' . ucfirst($role))

@section('content')

    <header>
        <h1>Silahkan Isi Formulir Berikut</h1>
    </header>
    <hr class="header-line">

    <div class="isi-form" id="isi-form">
        <form action="{{ route('integritas.store', ['role' => $role]) }}" method="POST" enctype="multipart/form-data"
            id="form-container" class="form-container">
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
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>
            <!-- Form Jabatan -->
            <div class="form-group">
                <label for="jabatan">Jabatan <span>*</span></label>
                @if ($role === 'pegawai')
                    <select id="jabatan" name="jabatan" required>
                        <option value="" disabled selected>--- Pilih Jabatan ---</option>
                        <option value="Kepala Balai">Kepala Balai</option>
                        <option value="Kepala Subbagian Tata Usaha">Kepala Subbagian Tata Usaha</option>
                        <option value="Bendahara Pengeluaran">Bendahara Pengeluaran</option>
                        <option value="Bendahara Penerimaan">Bendahara Penerimaan</option>
                        <option value="PPK (Pejabat Pembuat Komitmen)">PPK (Pejabat Pembuat Komitmen)</option>
                        <option value="Pejabat Pengadaan Barang dan Jasa">Pejabat Pengadaan Barang dan Jasa</option>
                        <option value="Penyusun Rencana Kegiatan dan Anggaran">Penyusun Rencana Kegiatan dan Anggaran
                        </option>
                        <option value="Petugas Pemelihara Kendaraan Dinas">Petugas Pemelihara Kendaraan Dinas</option>
                        <option value="Pengadministrasi Keuangan">Pengadministrasi Keuangan</option>
                        <option value="Arsiparis Terampil">Arsiparis Terampil</option>
                        <option value="Pengadministrasi dan Penyaji Data">Pengadministrasi dan Penyaji Data</option>
                        <option value="Pengadministrasi Umum">Pengadministrasi Umum</option>
                        <option value="Pekarya Taman">Pekarya Taman</option>
                        <option value="Medik Muda Selaku Subkoordinator Substansi Penyiapan Sampel">Medik Muda Selaku
                            Subkoordinator Substansi Penyiapan Sampel</option>
                        <option value="Medik Veteriner Madya">Medik Veteriner Madya</option>
                        <option value="Paramedik Veteriner Terampil">Paramedik Veteriner Terampil</option>
                        <option value="Medik Veteriner Muda">Medik Veteriner Muda</option>
                        <option value="Medik Veteriner Pertama">Medik Veteriner Pertama</option>
                        <option value="PMHP Muda">PMHP Muda</option>
                        <option value="PMHP Madya">PMHP Madya</option>
                        <option value="PMHP Penyelia">PMHP Penyelia</option>
                        <option value="PMHP Terampil">PMHP Terampil</option>
                        <option value="Teknisi Gedung">Teknisi Gedung</option>
                        <option value="Medik Muda Selaku Subkoordinator Substansi Pelayanan Teknik">Medik Muda Selaku
                            Subkoordinator Substansi Pelayanan Teknik</option>
                        <option value="Paramedik Pelaksana Lanjutan">Paramedik Pelaksana Lanjutan</option>
                        <option value="Medik Veteriner Ahli Pertama">Medik Veteriner Ahli Pertama</option>
                        <option value="Pengadministrasi dan Penyaji Data">Pengadministrasi dan Penyaji Data</option>
                        <option value="Calon Pengolah Data">Calon Pengolah Data</option>
                        <option value="Calon Paramedik Veteriner">Calon Paramedik Veteriner</option>
                        <option value="Paramedik Veteriner Mahir">Paramedik Veteriner Mahir</option>
                    </select>
                @else
                    <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required>
                @endif
            </div>
            <!-- Form Instansi -->
            <div class="form-group">
                <label for="instansi">Instansi <span>*</span></label>
                @if ($role === 'pegawai')
                    <input type="text" id="instansi" name="instansi"
                        value="Balai Pengujian Mutu dan Sertifikasi Produk Hewan" readonly>
                @else
                    <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}" required>
                @endif
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lengkap <span>*</span></label>
                <textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
            </div>
            <div class="form-group">
                <label for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="example@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="kota">Kota <span>*</span></label>
                <input type="text" id="kota" name="kota" value="{{ old('kota') }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pembuatan <span>*</span></label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            </div>
            <div id="info-pegawai">
                <h5 style="color: red; text-align:center;">Surat ini berlaku selama setahun.</h5>
            </div>
            <div class="form-group">
                <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                    <small>Contoh: 81234567899</small>
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">+62</div>
                    <input type="tel" id="no_whatsapp" name="no_whatsapp" class="form-control"
                        placeholder="81234567899" pattern="^\d{8,13}$" value="{{ old('no_whatsapp') }}" required>
                </div>
            </div>
            <!-- Upload File (Identitas Diri) -->
            <div class="form-group">
                <label for="identitas_diri">Identitas Diri</label>
                <input type="file" name="identitas_diri" id="identitas_diri" required>
            </div>
            <div class="btn-send-form">
                <button type="submit">
                    Kirim <i class="fa-solid fa-paper-plane"></i>
                </button>
                <a href="{{ url()->previous() }}" class="btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script src="{{ asset('script/script-admin.js') }}"></script>

@endsection
