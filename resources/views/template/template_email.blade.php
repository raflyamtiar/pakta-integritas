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
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCoC6ZkD4uvDuCJfKOWs9HcoAT7zGiQ6NfuA&s" alt="" style='width: 120px; margin: 10px;'>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7LxvasEXsbtEQpoPQ9UNLVlFMpgkNz86-vw&s" alt="" style='width: 120px; margin: 10px;'>
        </div>
        <div class="header-title">
            <h1 style="color: white; text-align:center; padding-bottom: 5px; width: 100%; background-color: #0077b6;">PAKTA INTEGRITAS BPMSPH</h1>
        </div>
        <div class="content" style="color: black;">
            <p>Yth. Bapak/Ibu {{ $paktaIntegritas->nama }},</p>
            <p>Terima kasih atas komitmen Bapak/Ibu dalam menjaga integritas dan mendukung terciptanya lingkungan kerja yang bersih serta transparan di BPMSPH. Berikut ini adalah data diri anda yang telah kami terima:</p>
            <ul style="list-style-type: none; text-decoration:none;">
                <li>Nama: {{ $paktaIntegritas->nama }}</li>
                <li>Jabatan: {{ $paktaIntegritas->jabatan }}</li>
                <li>Instansi: {{ $paktaIntegritas->instansi }}</li>
                <li>Email: {{ $paktaIntegritas->email }}</li>
                <li>Nomor WhatsApp: {{ $paktaIntegritas->no_whatsapp }}</li>
            </ul>
            <p>Anda bisa mendownload surat yang telah anda buat dengan mengklik tombol di bawah:</p>
            <a href="{{ $downloadLink }}" style="background-color: #0077b6; color: white; padding: 10px; text-decoration: none;" >
                <img src="https://cdn-icons-png.flaticon.com/128/7403/7403934.png" alt="" style="width: 20px; heigh: 20px; vertical-align: middle;"> Download Surat
            </a>
        </div>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 12px; color: gray;">
            <p>BPMSPH - Balai Pengujian Mutu dan Sertifikasi Produk Hewan</p>
        </div>
    </div>
</body>
</html>
