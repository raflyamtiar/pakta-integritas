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

    <link rel="stylesheet" href="style/style_index.css" />
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

    <main>
        <div class="container-cara-melapor">
            <div class="cara-melapor-title">
                <h2>LAYANAN PENGADUAN</h2>
                <img src="assets/line lapor.png" alt="">
                <h2>SISTEM MANAJEMEN INTEGRASI</h2>
            </div>
            <div class="cara-melapor-content" style="background-image: url('{{ asset('assets/kertas.png') }}');">
                <div class="cara-melapor-tutor">
                    <h3><i class="fa-brands fa-readme"></i> Cara Melapor:</h3>
                    <div class="tutor-lapor">
                        <ol>
                            <li>Klik tombol 'Lapor';</li>
                            <li>Silahkan baca terlebih dahulu cara melapor;</li>
                            <li>Setelah itu pilih masalah yang akan anda laporkan sesuai dengan bidangnya;</li>
                            <li>Isi formulir pelaporan sesuai dengan informasi yang anda ketahui, hal yang harus diperhatikan:</li>
                            <ol class="anak" type="a">
                                <li>Semua kotak yang diberi tanda (*) wajib di isi;</li>
                                <li>Pastikan informasi yang diberikan sedapat mungkin memenuhi unsur 4W + 1H;</li>
                                <li>Jika anda memiliki bukti dalam bentuk file seperti foto atau dokumen lain, silahkan;</li>
                            </ol>
                            <li>Setelah selesai mengisi, silahkan klik tombol "Kirim" untuk melanjutkan atau klik tombol "Reset" untuk membatalkan proses pelaporan.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-layanan-pengaduan">
            <div class="layanan-pengaduan-title">
                <h2>Layanan Pengaduan</h2>
                <img src="assets/pembatas.png" alt="">
            </div>
            <div class="container-layanan-content">
                <a href="https://wbs.pertanian.go.id/" class="layanan-content-isi">
                    <div class="layanan-content-title">
                        <figure class="layanan-img">
                            <img src="assets/wbs.jpeg" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>WhistleBlower's System (WBS) Kementrian Pertanian</h5>
                </a>
                <a href="https://wa.me/6281112122023" class="layanan-content-isi">
                    <div class="layanan-content-title">
                        <figure class="layanan-img">
                            <img src="assets/siintan.jpeg" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>WA SIINTAN <br> (WhatsApp Saluran Informasi Kementrian Pertanian)</h5>
                </a>
                <a href="https://dumas.pertanian.go.id/" class="layanan-content-isi">
                    <div class="layanan-content-title">
                        <figure class="layanan-img">
                            <img src="assets/dumas.jpeg" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>KALDU EMAS <br> (Kanal Pengaduan Elektronik Bagi Masyarakat)
                        <br>Kementrian Pertanian</h5>
                </a>
                <a href="https://sigap-upg.pertanian.go.id/" class="layanan-content-isi">
                    <div class="layanan-content-title">
                        <figure class="layanan-img">
                            <img src="assets/sigap.jpeg" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>UPG SIGAP <br> (Sistem Informasi Gratifikasi Pertanian)</h5>
                </a>
                <a href="https://www.lapor.go.id/" class="layanan-content-isi">
                    <div class="layanan-content-title">
                        <figure class="layanan-img">
                            <img src="assets/span.jpg" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>Layanan Aspirasi dan Pengaduan Online Rakyat</h5>
                </a>
                <a href="https://form.jotform.com/212288407937060" class="layanan-content-isi">
                    <div class="layanan-content-title">
                        <figure class="layanan-img">
                            <img src="assets/gsi.png" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>Lapor SPG! <br>Lapor Penolakan Suap Pungli</h5>
                </a>
                <a href="https://docs.google.com/document/d/1btODQp8yFu-Z_XMPkGhrpju69Ja-jA4V/edit?usp=sharing&ouid=115175528271640506706&rtpof=true&sd=true"
                    class="layanan-content-isi">
                    <div class="layanan-content-title">
                        <figure class="layanan-img">
                            <img src="assets/k3.png" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>Lapor Kecelakaan Kerja K3 BPMSPH</h5>
                </a>
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
    <script src="script.js"></script>

</body>

</html>
