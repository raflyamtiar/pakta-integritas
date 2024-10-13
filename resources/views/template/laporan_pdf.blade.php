<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAT LAPORAN SPG (Suap, Pungli, dan Gratifikasi)</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .kop-surat {
            position: fixed;
            top: 0;
            width: 100%;
            text-align: center;
        }

        .kop-surat img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .title-surat h2 {
            text-align: center;
            font-size: 14pt;
            margin-top: 20%;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .content-title {
            margin: 0 2cm;
            font-size: 12pt;
        }

        .content-title p {
            line-height: 1.2;
        }

        .content-body {
            margin: 0 2cm;
            font-size: 12pt;
        }

        .content-description {
            margin: 0 2cm;
            font-size: 12pt;
            margin-top: 20px;
        }

        .content-end {
            margin: 0 2cm;
            font-size: 12pt;
            margin-top: 20px;
        }

        .content-end p {
            text-indent: 2em;
            text-align: justify;
        }

        .signature {
            margin: 0 2cm;
            margin-top: 50px;
            font-size: 12pt;
        }

        .signature p {
            text-align: right;
        }

        .table-biodata {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-left: 5px;
        }

        .table-biodata td {
            vertical-align: top;
            word-wrap: break-word;
            font-size: 12pt;
            padding: 3px;
        }

        .table-biodata .label {
            width: 20%;
        }

        .table-biodata .separator {
            width: 5%;
            text-align: left;
        }

        .table-biodata .value {
            width: 75%;
        }

        .page-break {
            page-break-before: always;
        }

        .content-evidence {
            margin: 0 2cm;
            margin-top: 20%;
        }

        .content-evidence img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
        }
    </style>
</head>

<body>

    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>

    <!-- Judul Laporan -->
    <div class="title-surat">
        <h2>SURAT LAPORAN SPG (Suap, Pungli, dan Gratifikasi)</h2>
    </div>

    <!-- Informasi Penerima -->
    <div class="content-title">
        <p>Kepada Yth,</p>
        <p>Kepala/Pengurus Sistem Manajemen Anti Penyuapan</p>
        <p>Jl. Pemuda No.29 A, RT.01/RW.06, Tanah Sareal,</p>
        <p>Kec. Tanah Sereal, Kota Bogor, Jawa Barat 16161</p>
        <p>{{ \Carbon\Carbon::parse($laporanSpg->created_at)->format('d F Y') }}</p>
    </div>

    <!-- Biodata Pelapor -->
    <div class="content-body">
        <p style="margin-top:20px;">Saya yang bertanda tangan dibawah ini:</p>
        <table class="table-biodata">
            <tr>
                <td class="label">Nama Pelapor</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->reporter_name }}</td>
            </tr>
            <tr>
                <td class="label">Email Pelapor</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->reporter_email }}</td>
            </tr>
            <tr>
                <td class="label">Hubungan dengan Terlapor</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->relationship }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">Melaporkan bahwa saya memiliki informasi mengenai dugaan tindakan suap, pungli, dan
            gratifikasi yang
            dilakukan oleh pihak terlapor sebagai berikut:</p>
        <table class="table-biodata">
            <tr>
                <td class="label">Nama Terlapor</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->reported_name }}</td>
            </tr>
            <tr>
                <td class="label">Jabatan Terlapor</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->reported_position }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kasus</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->case_type }}</td>
            </tr>
            <tr>
                <td class="label">Lokasi Kejadian</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->incident_location }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Kejadian</td>
                <td class="separator">:</td>
                <td class="value">{{ $laporanSpg->incident_address }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Kejadian</td>
                <td class="separator">:</td>
                <td class="value">{{ \Carbon\Carbon::parse($laporanSpg->incident_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="label">Waktu Kejadian</td>
                <td class="separator">:</td>
                <td class="value">{{ \Carbon\Carbon::parse($laporanSpg->incident_time)->format('H:i') }}</td>
            </tr>
        </table>
    </div>

    <!-- Deskripsi Kejadian -->
    <div class="content-description">
        <p><strong>Deskripsi Kejadian:</strong></p>
        <p style="text-indent: 2em; text-align:justify;">{{ $laporanSpg->incident_description }}</p>
    </div>

    <!-- Pernyataan -->
    <div class="content-end">
        <p>
            Dengan ini, saya menyatakan bahwa laporan yang saya sampaikan adalah benar dan
            dapat dipertanggungjawabkan, serta berdasarkan informasi yang saya miliki dan ketahui. Saya menyusun laporan
            ini dengan penuh kesadaran dan tanggung jawab, serta berharap agar dapat ditindaklanjuti sebagaimana
            mestinya. Atas perhatian dan tindak lanjut yang diberikan, saya ucapkan terima kasih.
        </p>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature">
        <p>Hormat Saya,</p>
        <br>
        <br>
        <p>{{ $laporanSpg->reporter_name }}</p>
    </div>

    <!-- Bukti Kejadian di Halaman Baru -->
    @if (isset($laporanSpg->evidence))
        @php
            $evidencePath = storage_path('app/evidence_file/' . $laporanSpg->evidence);
            $mimeType = mime_content_type($evidencePath);
        @endphp

        @if (file_exists($evidencePath))
            @if (strpos($mimeType, 'image') !== false)
                <!-- Menampilkan gambar jika evidence adalah gambar -->
                <div class="content-evidence">
                    <p><strong>Lampiran/Bukti Kejadian:</strong></p>
                    <img src="{{ asset('storage/evidence_file/' . $laporanSpg->evidence) }}" alt="Bukti Kejadian"
                        style="max-width:100%; height:auto;">
                </div>
            @elseif (strpos($mimeType, 'pdf') !== false)
                <!-- Menampilkan PDF jika evidence adalah file PDF -->
                <div class="content-evidence">
                    <p><strong>Lampiran/Bukti Kejadian:</strong></p>
                    <embed src="{{ asset('storage/evidence_file/' . $laporanSpg->evidence) }}" type="application/pdf"
                        width="100%" height="600px" />
                </div>
            @else
                <!-- Menampilkan link unduh jika file bukan gambar atau PDF -->
                <div class="content-evidence">
                    <p><strong>Lampiran/Bukti Kejadian:</strong></p>
                    <a href="{{ asset('storage/evidence_file/' . $laporanSpg->evidence) }}" target="_blank">Unduh
                        Lampiran</a>
                </div>
            @endif
        @else
            <p>Bukti tidak ditemukan.</p>
        @endif
    @endif

</body>

</html>
