@extends('layouts.user')

@section('title', 'Situs Lapor')

@section('content')

    {{-- loading --}}
    <div id="loader" class="loader-container">
        <div class="spinner"></div>
    </div>

    <!-- bg -->
    <figure class="mybg">
        <img src="assets/kantor.jpg" alt="">
    </figure>
    <div class="container-cara-melapor">
        <div class="cara-melapor-title">
            <h2>LAYANAN PENGADUAN</h2>
            <img src="assets/line lapor.png" alt="">
            <h2>SISTEM MANAJEMEN INTEGRASI</h2>
        </div>
        <div class="cara-melapor-content">
            <div class="cara-melapor-tutor">
                <h3><i class="fa-brands fa-readme"></i> Cara Melapor:</h3>
                <div class="tutor-lapor">
                    <ol>
                        <li>Klik tombol 'Lapor';</li>
                        <li>Silahkan baca terlebih dahulu cara melapor;</li>
                        <li>Setelah itu pilih masalah yang akan anda laporkan sesuai dengan bidangnya;</li>
                        <li>Isi formulir pelaporan sesuai dengan informasi yang anda ketahui, hal yang harus diperhatikan:
                        </li>
                        <ol class="anak" type="a">
                            <li>Semua kotak yang diberi tanda (*) wajib di isi;</li>
                            <li>Pastikan informasi yang diberikan sedapat mungkin memenuhi unsur 4W + 1H;</li>
                            <li>Jika anda memiliki bukti dalam bentuk file seperti foto atau dokumen lain, silahkan;</li>
                        </ol>
                        <li>Setelah selesai mengisi, silahkan klik tombol "Kirim" untuk melanjutkan atau klik tombol "Reset"
                            untuk membatalkan proses pelaporan.</li>
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
            <a href="/spg" class="layanan-content-isi">
                <div class="layanan-content-title">
                    <figure class="layanan-img">
                        <img src="assets/smap23.jpg" alt="">
                    </figure>
                    <span class="view-text">View</span>
                </div>
                <h5>Lapor SPG! <br>Lapor Penolakan Suap Pungli dan Gratifikasi</h5>
            </a>
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
                    <br>Kementrian Pertanian
                </h5>
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

    <script src="script.js"></script>
@endsection
