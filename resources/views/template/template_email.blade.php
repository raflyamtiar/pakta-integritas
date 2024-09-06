<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakta Integritas Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .email-container {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #0077b6;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Pakta Integritas BPMSPH</h1>
        </div>
        <div class="content">
            <p>Dear {{ $paktaIntegritas->nama }},</p>
            <p>Terima kasih telah membuat surat Pakta Integritas. Berikut adalah detail informasi Anda:</p>
            <ul>
                <li>Nama: {{ $paktaIntegritas->nama }}</li>
                <li>Jabatan: {{ $paktaIntegritas->jabatan }}</li>
                <li>Instansi: {{ $paktaIntegritas->instansi }}</li>
                <li>Email: {{ $paktaIntegritas->email }}</li>
                <li>Nomor WhatsApp: {{ $paktaIntegritas->no_whatsapp }}</li>
            </ul>
            <p>Anda bisa mendownload surat Anda dengan mengklik tombol di bawah:</p>
            <a href="{{ $downloadLink }}" style="background-color: #0077b6; color: white; padding: 10px; text-decoration: none;">Download Surat</a>
        </div>
        <div class="footer">
            <p>BPMSPH - Balai Pengujian Mutu dan Sertifikasi Produk Hewan</p>
        </div>
    </div>
</body>
</html>
