@extends('layouts.admin')

@section('title', 'Edit Data Pakta Integritas {{ ucfirst($role) }}')

@section('content')

    <header>
        <h1>Edit Data Pakta Integritas {{ $role }}</h1>
    </header>
    <hr class="header-line">

    <div class="isi-form" id="isi-form">
        <div class="form-container-wrapper">
            <form action="{{ route('integritas.update', ['role' => $role, 'id' => $data->id]) }}" method="POST"
                enctype="multipart/form-data" id="form-container" class="form-container">
                @csrf
                @method('PUT') <!-- Menambahkan metode PUT untuk update -->
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

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span>*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $data->nama) }}" required>
                </div>

                <!-- Jabatan -->
                <div class="form-group">
                    <label for="jabatan">Jabatan <span>*</span></label>
                    @if ($role === 'pegawai')
                        <select id="jabatan" name="jabatan" required>
                            <option value="" disabled>--- Pilih Jabatan ---</option>
                            @foreach (['Kepala Balai', 'Kepala Subbagian Tata Usaha', 'Bendahara Pengeluaran', 'Bendahara Penerimaan', 'PPK (Pejabat Pembuat Komitmen)', 'Pejabat Pengadaan Barang dan Jasa', 'Penyusun Rencana Kegiatan dan Anggaran', 'Petugas Pemelihara Kendaraan Dinas', 'Pengadministrasi Keuangan', 'Arsiparis Terampil', 'Pengadministrasi dan Penyaji Data', 'Pengadministrasi Umum', 'Pekarya Taman', 'Medik Muda Selaku Subkoordinator Substansi Penyiapan Sampel', 'Medik Veteriner Madya', 'Medik Veteriner Terampil', 'Medik Veteriner Muda', 'Medik Veteriner Pertama', 'PMHP Muda', 'PMHP Madya', 'PMHP Penyelia', 'PMHP Terampil', 'Teknisi Gedung', 'Medik Muda Selaku Subkoordinator Substansi Pelayanan Teknik', 'Paramedik Pelaksana Lanjutan', 'Medik Veteriner Ahli Pertama', 'Calon Pengolah Data', 'Calon Paramedik Veteriner', 'Paramedik Veteriner Mahir'] as $jabatan)
                                <option value="{{ $jabatan }}"
                                    {{ old('jabatan', $data->jabatan) === $jabatan ? 'selected' : '' }}>
                                    {{ $jabatan }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $data->jabatan) }}"
                            required>
                    @endif
                </div>

                <!-- Instansi -->
                <div class="form-group">
                    <label for="instansi">Instansi <span>*</span></label>
                    @if ($role === 'pegawai')
                        <input type="text" id="instansi" name="instansi"
                            value="Balai Pengujian Mutu dan Sertifikasi Produk Hewan" readonly>
                    @else
                        <input type="text" id="instansi" name="instansi" value="{{ old('instansi', $data->instansi) }}"
                            required>
                    @endif
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat <span>*</span></label>
                    <textarea name="alamat" id="alamat" required>{{ old('alamat', $data->alamat) }}</textarea>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $data->email) }}" required>
                </div>

                <!-- Kota -->
                <div class="form-group">
                    <label for="kota">Kota <span>*</span></label>
                    <input type="text" id="kota" name="kota" value="{{ old('kota', $data->kota) }}" required>
                </div>

                <!-- Tanggal -->
                <div class="form-group">
                    <label for="tanggal">Tanggal <span>*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $data->tanggal) }}"
                        required>
                </div>

                <!-- No WhatsApp -->
                <div class="form-group">
                    <label for="no_whatsapp">No WhatsApp <span>*</span></label>
                    <input type="text" id="no_whatsapp" name="no_whatsapp"
                        value="{{ old('no_whatsapp', $data->no_whatsapp) }}" required>
                </div>

                <!-- Identitas Diri -->
                <div class="form-group">
                    <label for="identitas_diri">Identitas Diri <span>*</span></label>
                    <input type="file" name="identitas_diri" id="identitas_diri">
                    @if ($data->identitas_diri)
                        <p><a href="{{ asset('storage/' . $data->identitas_diri) }}" target="_blank">Lihat File</a></p>
                    @endif
                </div>


                <!-- Submit Button -->
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
    </div>
    <script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
