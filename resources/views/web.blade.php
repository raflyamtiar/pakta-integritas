@extends('layouts.user')

@section('title', 'Link Website')

@section('content')

    <!-- bg -->
    <figure class="mybg">
        <img src="assets/kantor.jpg" alt="">
    </figure>

    <main>
        <div class="container-web">
            <div class="container-web-title">
                <h2>WEBSITE, APLIKASI PENUNJANG DAN LINK EKSTERNAL</h2>
                <img src="assets/pembatas 2.png" alt="">
            </div>
            <div class="container-web-content">
                <a href="https://bpmsph.ditjenpkh.pertanian.go.id/" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/bpmsph.png" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>BPMSPH <br> (Balai Pengujian Mutu dan Sertifikasi Produk Hewan)</h5>
                </a>
                <a href="https://linktr.ee/HALO_BPMSPH" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/halo bpmsph.webp" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>HALLO BPMSPH <br> (Balai Pengujian Mutu dan Sertifikasi Produk Hewan)</h5>
                </a>
                <a href="https://spill-b.bpmsph.org/" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/spillb.webp" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>SPILL-B <br> (Sistem Pelayanan dan Informasi bagi Lembaga-Lembaga Mitra BPMSPH)</h5>
                </a>
                <a href="https://epersonal.pertanian.go.id/login/" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/e-kinerja.webp" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>E-KINERJA</h5>
                </a>
                <a href="https://simasn.pertanian.go.id/simasn/" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/sim-asn.jpeg" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>SIM-ASN <br> (Sistem Informasi Manajemen Aparatur Sipil Negara)</h5>
                </a>
                <a href="https://ppid.pertanian.go.id/" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/ppid.png" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>PPID Kementan <br> (Pejabat Pengelola Informasi dan Dokumentasi Kementrian Pertanian)</h5>
                </a>
                <a href="https://eperjadinpkh2024.com/login.php" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/eperjadin.png" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>E-PERJADIN <br> (Elektronik-Perjalanan Dinas)</h5>
                </a>
                <a href="https://ivlab.online/login" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/ivlab.png" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>IVLAB <br> (Indonesian Veteriner Labs Information System)</h5>
                </a>
                <a href="https://www.google.com/maps/d/u/0/viewer?mid=17uKXLQNnRWz-rGCGSRnhHwbXqzgBkPQ&ll=-2.5458933065021427%2C116.32159755&z=5"
                    class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/bimtek.jpeg" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>Pemetaan Pengguna Jasa BPMSPH</h5>
                </a>
                <a href="https://linktr.ee/BPMSPH_DitjenPKH" class="web-content-isi">
                    <div class="web-content-title">
                        <figure class="web-img">
                            <img src="assets/bpmsph.png" alt="">
                        </figure>
                        <span class="view-text">View</span>
                    </div>
                    <h5>Sosial Media & Chat BPMSPH</h5>
                </a>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
<script src="script.js"></script>
@endpush
