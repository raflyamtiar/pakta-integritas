<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakta Integritas Email</title>
</head>

<body style="font-family: Arial, sans-serif;">
    <div class="email-container" style="padding: 20px; background-color: #f9f9f9;">
        <div class="header" style="background-color: #0077b6; padding: 10px; text-align: center;">
            <h1 style="color: white;">Pakta Integritas BPMSPH</h1>
        </div>
        <div class="content" style="color: black;">
            <p>Yth. Bapak/Ibu {{ $paktaIntegritas->nama }},</p>

            {{-- Logika untuk email baru atau expired --}}
            @if ($isExpired ?? false)
                <p>Kami ingin menginformasikan bahwa surat Pakta Integritas Anda saat ini sudah <strong>tidak
                        aktif</strong>.</p>
                <p>Berikut ini adalah data diri Anda yang akan kami hapus:</p>
                <ul style="list-style-type: none;">
                    <li>Nama: {{ $paktaIntegritas->nama }}</li>
                    <li>Jabatan: {{ $paktaIntegritas->jabatan }}</li>
                    <li>Instansi: {{ $paktaIntegritas->instansi }}</li>
                    <li>Email: {{ $paktaIntegritas->email }}</li>
                    <li>Nomor WhatsApp: {{ $paktaIntegritas->no_whatsapp }}</li>
                </ul>
                <p>Jika Anda ingin mengaktifkan kembali, silakan isi ulang formulir Pakta Integritas dengan mengklik
                    tombol di bawah ini:</p>
                <a href="{{ $downloadLink }}"
                    style="background-color: #0077b6; color: white; padding: 10px; text-decoration: none;">
                    Isi Ulang Formulir
                </a>
            @else
                <p>Terima kasih atas komitmen Bapak/Ibu dalam menjaga integritas dan mendukung terciptanya lingkungan
                    kerja yang bersih serta transparan di BPMSPH.</p>
                <p>Berikut ini adalah data diri Anda yang telah kami terima:</p>
                <ul style="list-style-type: none;">
                    <li>Nama: {{ $paktaIntegritas->nama }}</li>
                    <li>Jabatan: {{ $paktaIntegritas->jabatan }}</li>
                    <li>Instansi: {{ $paktaIntegritas->instansi }}</li>
                    <li>Email: {{ $paktaIntegritas->email }}</li>
                    <li>Nomor WhatsApp: {{ $paktaIntegritas->no_whatsapp }}</li>
                </ul>
                <p>Anda bisa mendownload surat yang telah Anda buat dengan mengklik tombol di bawah ini:</p>
                <a href="{{ $downloadLink }}"
                    style="background-color: #0077b6; color: white; padding: 10px; text-decoration: none;">
                    Download Surat
                </a>
            @endif
        </div>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 12px; color: gray;">
            <p>BPMSPH - Balai Pengujian Mutu dan Sertifikasi Produk Hewan</p>
        </div>
    </div>
</body>

</html>
