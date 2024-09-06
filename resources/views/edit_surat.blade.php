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

    <link rel="stylesheet" href="{{ asset('style/style_index.css') }}" />
</head>

<body>
    <figure class="mybg">
        <img src="{{ asset('assets/kantor.jpg') }}" alt="">
    </figure>
    <!-- Navbar -->
    <nav class="container-navbar">
        <a href="/">
            <div class="logo">
                <img src="{{ asset('assets/logo smi.png') }}" alt="Logo Image" class="logo-img">
                <h3>SMI BPMSPH</h3>
            </div>
        </a>
        <div id="icon-nav" class="icon-nav">
            <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
        </div>
        <ul id="menu-list" class="hidden">
            <li><a href="/">Beranda</a></li>
            <li><a href="/lapor">Lapor</a></li>
            <li class="dropdown">
                <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Pedoman dan Prosedur SMI <i
                        class="fa-solid fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/pedoman-smi">Pedoman
                            SMI</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/prosedur-smi">Prosedur
                            SMI</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/formulir-smi">Formulir
                            SMI</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/ikk-smi">IKK</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="https://sites.google.com/view/smapbpmsph/agenda-sosialisasi-pk">Agenda Sosialisasi PK <i
                        class="fa-solid fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/agenda-sosialisasi-pk/audit-internal">Audit
                            Internal</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/agenda-sosialisasi-pk/audit-eksternal">Audit
                            Eksternal</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran">Kebijakan & Sasaran <i
                        class="fa-solid fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/kebijakan">Kebijakan</a>
                    </li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/sasaran">Sasaran</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/pedoman-dan-prosedur-mi">Pedoman
                            Prosedur & Formulir</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/struktur">Struktur</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="https://sites.google.com/view/smapbpmsph/eviden">Eviden <i
                        class="fa-solid fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/eviden-45001">Eviden 45001</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/eviden-9001">Eviden 9001</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/eviden-37001">Eviden 37001</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/manual-sni-iso">Manual SNI ISO</a></li>
                </ul>
            </li>
            </li>
            <li> <a href="/web">Web</i></a>
            </li>
        </ul>
    </nav>
    <!-- navbar end -->

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




<footer>
    <div class="footer-container">
        <div class="footer-address">
            <h3>Balai Pengujian Mutu dan Sertifikasi Produk Hewan</h3>
            <p><a href="https://maps.app.goo.gl/FwhEJiirMgLarwDT8"> Jalan Pemuda No 29A Kecamatan Tanah Sareal
                    Kota Bogor, Jawa Barat </a></p>
            <p>Email: <a href="mailto:bpmsph@pertanian.go.id">bpmsph@pertanian.go.id</a></p>
            <p>Tel/Fax: +62-251-8377111, +62-251-8353712</p>
        </div>
        <div class="footer-sosmed">
            <h3>Sosial Media & Chat</h3>
            <ul>
                <li><a href="https://web.facebook.com/bpmsph.ditjenpkh.5"><i class="fa-brands fa-facebook"></i>
                        bpmsph.ditjenpkh.5</a></li>
                <li><a href="https://twitter.com/BPMSPH"><i class="fa-brands fa-x-twitter"></i> @BPMSPH</a></li>
                <li><a href="https://www.instagram.com/bpmsph_ditjenpkh/"><i class="fa-brands fa-instagram"></i>
                        @bpmsph_ditjenpkh</a></li>
                <li><a href="https://www.youtube.com/@bpmsphbogorkementan231"><i class="fa-brands fa-youtube"></i>
                        BPMSPH Bogor Kementan</a></li>
                <li><a href="https://wa.me/08111109922"><i class="fa-brands fa-whatsapp"></i> 0811 1109 922</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>SNI ISO 9001:2015 - 37001:2016 - 45001:2018 SISTEM MANAJEMEN INTEGRASI - BALAI PENGUJIAN MUTU DAN
            SERTIFIKASI PRODUK HEWAN <span>Hak Cipta&copy;2024 BPMSPH. Semua Hak Dilindungi</span></p>
    </div>
</footer>

</body>

</html>
