<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMI BPMSPH</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('style/style_admin.css') }}" />
</head>

<body>
    <nav class="container-navbar-admin">
        <a href="/">
            <div class="logo">
                <img src="/assets/logo smi.png" alt="Logo Image" class="logo-img">
                <h3>SMI BPMSPH</h3>
            </div>
        </a>
        <div class="logout-admin">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                <button class="logout-btn">Logout</button>
                @csrf
            </form>
        </div>
    </nav> <!-- navbar end -->

    <div class="container-admin">
        <div class="sidebar-admin">
            <a href="/admin/home">
                <div class="box-admin">
                    <h3>Beranda</h3>
                </div>
            </a>

            <div class="dropdown-admin">
                <div class="select-admin">
                    <h5 class="selected">Pakta Integritas</h5>
                    <div class="caret"></div>
                </div>
                <ul class="menu-admin">
                    <li class="active">Pakta Integritas</li>
                    <a href="/admin/pegawai">
                        <li>Pegawai</li>
                    </a>
                    <a href="/admin/penyedia-jasa">
                        <li>Penyedia Jasa</li>
                    </a>
                    <a href="/admin/pengguna-jasa">
                        <li>Pengguna Jasa</li>
                    </a>
                    <a href="/admin/auditor">
                        <li>Auditor</li>
                    </a>
                </ul>
            </div>
        </div>
        <div class="content-admin-edit">
            <header>
                <h1>Edit Data Pakta Integritas {{ $role }}</h1>
            </header>
            <hr class="header-line">
            <div class="isi-form" id="isi-form">
                <!-- Form Container -->
                <div class="form-container-wrapper">
                    <form action="{{ route('integritas.update', ['role' => $role, 'id' => $data->id]) }}" method="POST" id="form-container" class="form-container" autocomplete="off">
                        @csrf
                        @method('PUT') <!-- Tambahkan ini untuk menggunakan metode PUT -->
                        <input type="hidden" name="role" value="{{ $role }}">
                        <h3>FORMULIR PAKTA INTEGRITAS</h3>
                        <div class="img-form"><img src="{{ asset('assets/pembatas.png') }}" alt=""></div>
                        <h3 id="role-title">{{ strtoupper($role) }}</h3>

                        <!-- Form fields dengan data yang diisi -->
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <span>*</span></label>
                            <input type="text" id="nama" name="nama" max-length="100" value="{{ $data->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan <span>*</span></label>
                            <input type="text" id="jabatan" name="jabatan" max-length="50" value="{{ $data->jabatan }}" required>
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
                            <input type="email" id="email" name="email" value="{{ $data->email }}" required>
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
                                <input type="tel" id="no_whatsapp" name="no_whatsapp" value="{{ ltrim(old('no_whatsapp', $data->no_whatsapp), '62') }}" class="form-control" placeholder="81234567899"
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
        </div>
        <script src="{{ asset('script/script-admin.js') }}"></script>
</body>

</html>
