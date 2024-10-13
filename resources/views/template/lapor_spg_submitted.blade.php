<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPG</title>
</head>

<body style="font-family: Arial, sans-serif;">
    <div class="email-container" style="padding: 20px; background-color: #f9f9f9;">
        <div class="header" style="background-color: #0077b6; padding: 10px; text-align: center;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCoC6ZkD4uvDuCJfKOWs9HcoAT7zGiQ6NfuA&s"
                alt="" style='width: 120px; margin: 10px;'>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7LxvasEXsbtEQpoPQ9UNLVlFMpgkNz86-vw&s"
                alt="" style='width: 120px; margin: 10px;'>
        </div>
        <div class="header-title">
            <h1 style="color: white; text-align:center; padding-bottom: 5px; width: 100%; background-color: #0077b6;">
                LAPORAN SPG</h1>
        </div>
        <div class="content" style="color: black;">
            <p>Yth. Bapak/Ibu {{ $laporanSpg->reporter_name }},</p>
            <p>Terima kasih telah mengirimkan laporan Anda kepada kami. Berikut adalah rincian laporan yang telah Anda
                kirimkan:</p>
            <ul style="list-style-type: none; text-decoration:none;">
                <li><strong>Nama Pelapor:</strong> {{ $laporanSpg->reporter_name }}</li>
                <li><strong>Nama Terlapor:</strong> {{ $laporanSpg->reported_name }}</li>
                <li><strong>Lokasi Kejadian:</strong> {{ $laporanSpg->incident_location }}</li>
                <li><strong>Tanggal Kejadian:</strong> {{ $laporanSpg->incident_date }}</li>
                <li><strong>Waktu Kejadian:</strong> {{ $laporanSpg->incident_time }}</li>
                <li><strong>Deskripsi Kejadian:</strong> {{ $laporanSpg->incident_description }}</li>
            </ul>

            @if ($laporanSpg->evidence)
                <a href="{{ asset('storage/' . $laporanSpg->evidence) }}"
                    style="background-color: #0077b6; color: white; padding: 10px; text-decoration: none;">
                    <img src="https://cdn-icons-png.flaticon.com/128/7403/7403934.png" alt=""
                        style="width: 20px; height: 20px; vertical-align: middle;"> Download Bukti
                </a>
            @endif

            <p>Untuk mengunduh laporan Anda dalam format PDF, silakan klik tombol di bawah ini:</p>
            <a href="{{ route('laporan.pdf', $laporanSpg->id) }}"
                style="background-color: #0077b6; color: white; padding: 10px; text-decoration: none;">
                <img src="https://cdn-icons-png.flaticon.com/128/337/337946.png" alt=""
                    style="width: 20px; height: 20px; vertical-align: middle;"> Download Laporan PDF
            </a>

            <p>Terima kasih atas perhatian Anda.</p>
        </div>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 12px; color: gray;">
            <p>BPMSPH - Balai Pengujian Mutu dan Sertifikasi Produk Hewan</p>
        </div>
    </div>
</body>

</html>
