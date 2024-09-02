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
    <!-- Navbar -->
    <nav class="container-navbar">
        <a href="/">
            <div class="logo">
                <img src="assets/logo smi.png" alt="Logo Image" class="logo-img">
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
            <li> <a href="/web">Web</i></a>
            </li>
        </ul>
    </nav> <!-- navbar end -->

    <!-- icon langsung ke top -->
    <i id="scrollToTopBtn" title="Go to top" class="fa-solid fa-circle-up"></i>


    <!-- bg -->
    <figure class="mybg">
        <img src="assets/kantor.jpg" alt="">
    </figure>

    <!-- Main page start -->
    <main class="main-page" id="beranda">
        <div class="container-home">
            <div class="home-title">
                <h1>SISTEM MANAJEMEN INTEGRASI</h1>
                <div class="home-content">
                    <div class="home-content-text">
                        <h6>Pelayanan Prima Menjamin Kesehatan Keselamatan Kerja dan Bebas dari Suap, Pungli,
                            Gratifikasi
                        </h6>
                        <p>
                            pakta integritas adalah janji tertulis yang berisi komitmen untuk melaksanakan tugas dengan
                            penuh
                            integritas dan menghindari tindakan tercela seperti korupsi, kolusi, dan nepotisme (KKN).
                            Untuk pengguna yang ingin berkomitmen dalam menjalankan tugas dengan jujur, transparan,
                            dan tanpa korupsi di lingkungan BPMSPH. anda bisa mengisi formulir pakta integritas ini.
                        </p>
                        <a href="#isi-form"><button>
                                <i class="fa-regular fa-pen-to-square" ></i>
                                Formulir Pakta Integritas
                            </button></a>
                    </div>
                    <div class="home-content-logo">
                        <img src="assets/logo smi.png" alt="logo smi">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tutor -->
        <div class="tutorial">
            <div class="tutorial-header">
                <h2>CARA MENGISI FORMULIR PAKTA INTEGRITAS</h2>
                <br>
                <p>Anda dapat membuat surat Pakta Integritas dengan cara berikut:</p>
            </div>
            <div class="tutorial-container">
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <h4>Buka Website</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Anda dapat membuat surat pakta integritas di website smi bpmsph</p>
                        </div>
                    </div>
                </div>
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa-brands fa-readme"></i>
                        </div>
                        <h4>Membaca Perjanjian</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Anda dapat mengklik “lihat perjanjian” untuk mengetahui isi perjanjian dari
                                masing-masing
                                peran</p>
                        </div>
                    </div>
                </div>
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <h4>Memilih Peran</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Anda dapat memilih peran sesuai dengan peran/jabatan anda sendiri</p>
                        </div>
                    </div>
                </div>
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </div>
                        <h4>Mengisi Formulir</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Anda dapat mengisi identitas anda pada formulir, lalu kirim dan surat dapat di
                                download
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tutor end -->

        <!-- Role -->
        <div class="role" id="role">
            <div class="role-header">
                <h2>PERJANJIAN PAKTA INTEGRITAS</h2>
            </div>
            <div class="role-container">
                <div class="role-main">
                    <div class="role-title-container">
                        <figure class="role-image">
                            <img src="assets/pegawai.png" alt="" onclick="togglePopup('role-popup-1')">
                        </figure>
                        <h4>Pegawai</h4>
                    </div>

                    <div class="role-button-container">
                        <button onclick="togglePopup('role-popup-1')"> Lihat Perjanjian </button>
                    </div>
                </div>

                <div class="role-main">
                    <div class="role-title-container">
                        <figure class="role-image">
                            <img src="assets/penyedia jasa 2.png" alt="" onclick="togglePopup('role-popup-2')">
                        </figure>

                        <h4>Penyedia Jasa</h4>
                    </div>

                    <div class="role-button-container">
                        <button onclick="togglePopup('role-popup-2')"> Lihat Perjanjian </button>
                    </div>
                </div>

                <div class="role-main">
                    <div class="role-title-container">
                        <figure class="role-image">
                            <img src="assets/pengguna.png" alt="" onclick="togglePopup('role-popup-3')">

                        </figure>
                        <h4>Pengguna Jasa</h4>
                    </div>

                    <div class="role-button-container">
                        <button onclick="togglePopup('role-popup-3')"> Lihat Perjanjian </button>
                    </div>
                </div>
                <div class="role-main">
                    <div class="role-title-container">
                        <figure class="role-image">
                            <img src="assets/Auditor.png" alt="" onclick="togglePopup('role-popup-4')">

                        </figure>
                        <h4>Auditor</h4>
                    </div>

                    <div class="role-button-container">
                        <button onclick="togglePopup('role-popup-4')"> Lihat Perjanjian </button>
                    </div>
                </div>
            </div>
            <div class="role-popup-1" id="role-popup-1">
                <div class="role-popup-content-1"></div>
                <div class="role-popup-text-1">
                    <div class="role-close-btn-1" onclick="togglePopup('role-popup-1')"><i
                            class="fa-solid fa-circle-xmark"></i></div>
                    <h3>PERJANJIAN PAKTA INTEGRITAS PEGAWAI</h3>
                    <p>Menyatakan bahwa saya dengan sungguh-sungguh dalam rangka pelaksanaan pemeriksaan dan
                        pengujian di BPMSPH bersedia menjalankan dan mentaati hal-hal seperti yang tertulis
                        dibawah ini :</p>
                    <br>
                    <ol>
                        <li>Berperan secara pro aktif dalam upaya pencegahan dan pemberantasan Korupsi, Kolusi
                            dan Nepotisme (KKN) serta tidak melibatkan diri dalam perbuatan tercela;</li>
                        <li>Berkomitmen tidak meminta pemberian secara langsung dan/atau tidak langsung berupa
                            suap,
                            hadiah, bantuan, atau bentuk lainnya yang tidak sesuai dengan ketentuan yang berlaku
                            serta melaporkan pemberian tersebut apabila menerimanya;</li>
                        <li>Berkomitmen bersikap transparan, jujur, objektif dan akuntabel untuk tidak terlibat
                            atau
                            terpengaruh terhadap tekanan komersial, keuangan yang dapat mempengaruhi hasil
                            pengujian
                            untuk menghindari benturan kepentingan (conflict of interest) dalam pelaksanaan
                            tugas;
                        </li>
                        <li>Berkomitmen untuk bebas dari kegiatan lain, internal dan eksternal yang dapat
                            mengurangi
                            kepercayaan dalam kemandirian pertimbangan dan integritas dalam kegiatan pengujian,
                            dan
                            berpengaruh buruk terhadap mutu kerja;</li>
                        <li>Berkomitmen untuk bekerja secara profesional, menjunjung tinggi aturan yang berlaku
                            baik di lingkungan laboratorium pengujian;</li>
                        <li>Berkomitmen untuk menjaga kerahasiaan informasi dan hak kepemilikan dari pelanggan
                            Laboratorium sesuai dengan persyaratan dan ketentuan yang berlaku, termasuk
                            informasi
                            dalam bentuk elektronik;</li>
                        <li>Berkomitmen memberi contoh dalam kepatuhan terhadap peraturan perundang-undangan
                            dalam
                            melaksanaan tugas terutama kepada pegawai yang berada di bawah pengawasan saya dan
                            sesama pegawai di lingkungan kerja saya secara konsisten;</li>
                        <li>Berkomitmen menyampaikan informasi penyimpangan integritas serta turut menjaga
                            kerahasiaan atas pelanggaran peraturan yang dilaporkannya;</li>
                        <li>Bila saya melanggar hal-hal tersebut di atas, saya siap menghadapi konsekuensi
                            berdasarkan ketentuan dan perundang-undangan yang berlaku.</li>
                    </ol>
                </div>
            </div>
            <div class="role-popup-2" id="role-popup-2">
                <div class="role-popup-content-2"></div>
                <div class="role-popup-text-2">
                    <div class="role-close-btn-2" onclick="togglePopup('role-popup-2')"><i
                            class="fa-solid fa-circle-xmark"></i></div>
                    <h3>PERJANJIAN PAKTA INTEGRITAS PENYEDIA JASA</h3>
                    <p>Menyatakan bahwa saya dengan sungguh-sungguh dalam rangka pelaksanaan pemeriksaan dan
                        pengujian
                        di BPMSPH bersedia menjalankan dan mentaati hal-hal seperti yang tertulis dibawah ini:</p>
                    <br>
                    <ol>
                        <li>Berperan secara pro aktif dalam upaya pencegahan dan pemberantasan Korupsi, Kolusi dan
                            Nepotisme (KKN) serta tidak melibatkan diri dalam perbuatan tercela;</li>
                        <li>Tidak melakukan pemberian secara langsung dan/atau tidak langsung berupa suap, hadiah,
                            bantuan, atau bentuk lainnya yang tidak sesuai dengan ketentuan yang berlaku serta
                            melaporkan pemberian permintaan tersebut apabila ada yang menerimanya;</li>
                        <li>Bersikap transparan, jujur, objektif dan akuntabel dalam melaksanakan kegiatan sebagai
                            penyedia jasa;
                        </li>
                        <li>Menghindari benturan kepentingan (conict of interest) dalam pelaksanaan kegiatan sebagai
                            penyedia jasa; </li>
                        <li>Memberi contoh dalam kepatuhan terhadap peraturan perundang-undangan dalam melaksanakan
                            kegiatan sebagai penyedia jasa; </li>
                        <li>Akan menyampaikan informasi penyimpangan integritas serta turut menjaga kerahasiaan atas
                            pelanggaran peraturan yang dilaporkannya; </li>
                        <li>Bila saya melanggar hal-hal tersebut di atas, saya siap menghadapi konsekuensi
                            berdasarkan
                            ketentuan dan perundang-undangan yang berlaku.</li>
                    </ol>
                </div>
            </div>
            <div class="role-popup-3" id="role-popup-3">
                <div class="role-popup-content-3"></div>
                <div class="role-popup-text-3">
                    <div class="role-close-btn-3" onclick="togglePopup('role-popup-3')"><i
                            class="fa-solid fa-circle-xmark"></i></div>
                    <h3>PERJANJIAN PAKTA INTEGRITAS PENGGUNA JASA</h3>
                    <p>Menyatakan bahwa saya dengan sungguh-sungguh akan menjalankan dan mentaati hal-hal seperti
                        yang
                        tertulis dibawah ini:</p>
                    <br>
                    <ol>
                        <li>Berperan secara pro aktif dalam upaya pencegahan dan pemberantasan Korupsi, Kolusi dan
                            Nepotisme (KKN) serta tidak melibatkan diri dalam perbuatan tercela;</li>
                        <li>Bersikap transparan, jujur, objektif dan akuntabel dalam melaksanakan kegiatan sebagai
                            pengguna jasa;</li>
                        <li>Menghindari benturan kepentingan (conict of interest) dalam pelaksanaan kegiatan sebagai
                            pengguna jasa;
                        </li>
                        <li>Memberi contoh dalam kepatuhan terhadap peraturan perundang-undangan dalam melaksanakan
                            kegiatan sebagai pengguna jasa;</li>
                        <li>Akan menyampaikan informasi penyimpangan integritas serta turut menjaga kerahasiaan atas
                            pelanggaran peraturan yang dilaporkannya;</li>
                        <li>Bila saya melanggar hal-hal tersebut di atas, saya siap menghadapi konsekuensi
                            berdasarkan
                            ketentuan dan perundang-undangan yang berlaku.</li>
                    </ol>
                </div>
            </div>
            <div class="role-popup-4" id="role-popup-4">
                <div class="role-popup-content-4"></div>
                <div class="role-popup-text-4">
                    <div class="role-close-btn-4" onclick="togglePopup('role-popup-4')"><i
                            class="fa-solid fa-circle-xmark"></i></div>
                    <h3>PERJANJIAN PAKTA INTEGRITAS AUDITOR</h3>
                    <p>Menyatakan bahwa Saya sebagai Auditor Internal menandatangani & menjalankan “Pakta Integritas
                        Ketidakberpihakan Auditor Internal” dengan ketentuan sebagai berikut:</p>
                    <br>
                    <ol>
                        <li>Auditor Internal tidak akan berpihak kepada pihak tertentu dalam menjalankan fungsinya saat
                            melaksanakan audit;</li>
                        <li>Auditor Internal tidak diperkenankan melakukan kerjasama dalam ketidakbenaran terkait temuan
                            saat melaksanakan audit dengan auditee;</li>
                        <li>Auditor Internal menyadari dengan sepenuh hati terhadap tanggung jawabnya dalam melaksanakan
                            audit untuk selalu mengedepankan “Independensi” atau ketidaktergantungan kepada pihak
                            manapun;
                        </li>
                        <li>Auditor internal sebagai kapasitasnya dalam jabatan tertentu tidak diperkenankan menggunakan
                            kewenangannya melakukan intervensi dalam pelaksanaan audit yang mengakibatkan terjadinya
                            konflik kepentingan pada ketidaksesuaian yang terjadi;</li>
                        <li>Auditor internal tidak diperbolehkan melakukan penghilangan atau penambahan temuan audit
                            ketika kegiatan audit sudah selesai.</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Role -->

        <!-- isi form -->
        <div class="isi-form" id="isi-form">
            <div class="form-title">
                <h2>ISI FORMULIR</h2>
                <div class="form-content">
                    <div class="form-content-text">
                        <div class="form-content-text-title">
                            <h3>Silahkan memilih Peran yang dibutuhkan:</h3>
                        </div>
                        <div class="form-choice">
                            <p>Pilih Peran</p>
                            <select name="form-role" id="form-role" onchange="showForm()">
                                <option value="null">---Silahkan Pilih---</option>
                                <option value="pegawai">Pegawai</option>
                                <option value="penyedia-jasa">Penyedia Jasa</option>
                                <option value="pengguna-jasa">Pengguna Jasa</option>
                                <option value="auditor">Auditor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-content-logo">
                        <img src="assets/beranda.png" alt="">
                    </div>
                </div>

                <!-- Form Container -->
                <form action="{{ route('integritas.store', ['role' => 'null']) }}" method="POST" id="form-container" class="form-container" autocomplete="off">
                    @csrf
                    <input type="hidden" name="role" id="hidden-role" value="null">
                    <h3>FORMULIR PAKTA INTEGRITAS</h3>
                    <div class="img-form"><img src="assets/pembatas.png" alt=""></div>
                    <h3 id="role-title">{{ $role ?? 'ROLE TITLE' }}</h3>
                    <!-- Form Fields -->
                    <div class="form-group">
                        <label for="nama">Nama Lengkap <span>*</span></label>
                        <input type="text" id="nama" name="nama" max-length="100" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan <span>*</span></label>
                        <input type="text" id="jabatan" name="jabatan" max-length="70" required>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Instansi <span>*</span></label>
                        <input type="text" id="instansi" name="instansi" max-length="70" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap <span>*</span></label>
                        <textarea id="alamat" name="alamat" max-length="255" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span>*</span></label>
                        <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota <span>*</span></label>
                        <input type="text" id="kota" name="kota" max-length="35" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal <span>*</span></label>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                            <small>Contoh: 81234567899</small>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">+62</div>
                            <input type="tel" id="no_whatsapp" name="no_whatsapp" class="form-control" placeholder="81234567899"
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
    </main>

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
    <script src="{{ asset('script/script.js') }}"></script>

</body>

</html>
