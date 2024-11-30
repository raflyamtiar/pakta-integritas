<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakta Integritas</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-optical-sizing: auto;
            font-style: normal;
            box-sizing: border-box;
        }

        .kop-surat {
            text-align: center;
            padding: 10px
        }

        .kop-surat img {
            max-width: 100%;
            height: auto;
        }

        .title-surat h5 {
            text-align: center;
            margin: 0;
            font-size: {{ $data->role === 'pegawai' ? '11pt' : '12pt' }};
        }

        .content-biodata {
            margin: 0 2cm;
            font-size: {{ $data->role === 'pegawai' ? '11pt' : '12pt' }};
        }

        .content-biodata p {
            margin: 20px 0 10px 0;
        }

        .table-biodata {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin: 0 0 5px 5px;
        }

        .table-biodata td {
            vertical-align: top;
            word-wrap: break-word;
            padding: 5px;
            font-size: {{ $data->role === 'pegawai' ? '11pt' : '12pt' }};
        }

        .table-biodata .label {
            width: 15%;
        }

        .table-biodata .separator {
            width: 2%;
            text-align: left;
        }

        .table-biodata .value {
            width: 83%;
        }

        .content-pernyataan {
            margin: 0 2cm;
            font-size: {{ $data->role === 'pegawai' ? '11pt' : '12pt' }};
        }

        .content-pernyataan p {
            text-align: justify;
            margin-top: 10px;
        }

        .content-pernyataan ol {
            padding-left: 25px;
            font-size: {{ $data->role === 'pegawai' ? '11pt' : '12pt' }};
        }

        .content-pernyataan ol li {
            padding: 3px 0;
            text-align: justify;
            font-size: {{ $data->role === 'pegawai' ? '11pt' : '12pt' }};
        }

        .signature {
            margin: 20px 70px 0 0;
            text-align: right;
            font-size: {{ $data->role === 'pegawai' ? '11pt' : '12pt' }};
        }

        .signature-barcode {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>
    <div class="title-surat">
        <h5>PAKTA INTEGRITAS <br> {{ $judul }}</h5>
    </div>
    <div class="content-biodata">
        <p>Saya yang bertanda tangan dibawah ini:</p>
        <table class="table-biodata">
            <tr>
                <td class="label">Nama</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->nama }}</td>
            </tr>
            <tr>
                <td class="label">Jabatan</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->jabatan }}</td>
            </tr>
            <tr>
                <td class="label">Instansi</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->instansi }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->alamat }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->email }}</td>
            </tr>
        </table>
    </div>
    <div class="content-pernyataan">
        <p>{{ $pernyataan }}</p>
        <ol>
            @foreach ($perjanjian as $butir)
                <li>{{ $butir }}</li>
            @endforeach
        </ol>
    </div>
    <div class="signature">
        @php
            \Carbon\Carbon::setLocale('id'); // Mengatur locale Carbon ke bahasa Indonesia
        @endphp

        <p>{{ $data->kota }}, {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</p>

        {{-- !-- Menampilkan QR Code dalam format SVG --> --}}
        <div class="signature-barcode">
            <img src="data:image/svg+xml;base64,{{ $qrcodeBase64 }}" alt="QR Code" width="80">
        </div>

        <p class="signature-name">{{ $data->nama }}</p>

        {{-- Menambahkan catatan khusus sesuai role --}}
        @if (in_array($data->role, ['penyedia-jasa', 'pengguna-jasa', 'auditor']))
            <br>
        @endif
        <div class="signature-note" style="margin: 0 2cm; text-align: left; font-size: 12pt;">
            <p>Catatan:</p>
            <p>Surat ini berlaku mulai dari {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}
                sampai {{ \Carbon\Carbon::parse($data->tanggal_akhir)->translatedFormat('d F Y') }}.</p>
        </div>
    </div>
</body>

</html>
