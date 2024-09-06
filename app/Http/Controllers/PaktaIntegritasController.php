<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaktaIntegritas;
use App\Exports\PaktaIntegritasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaktaIntegritasMail;

class PaktaIntegritasController extends Controller
{

    public function index(Request $request, $role)
    {
        // Memulai query untuk mendapatkan data berdasarkan role
        $query = PaktaIntegritas::where('role', $role)->orderBy('created_at', 'desc');

        // Jika ada parameter pencarian, tambahkan ke query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('jabatan', 'like', '%' . $search . '%')
                    ->orWhere('instansi', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('no_whatsapp', 'like', '%' . $search . '%');
            });
        }
        // Melakukan paginasi pada hasil query
        $data = $query->paginate(10);

        $roleCounts = PaktaIntegritas::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        $countPegawai = $roleCounts['pegawai'] ?? 0;
        $countPenyediaJasa = $roleCounts['penyedia-jasa'] ?? 0;
        $countPenggunaJasa = $roleCounts['pengguna-jasa'] ?? 0;
        $countAuditor = $roleCounts['auditor'] ?? 0;

        if ($role) {
            return view('admin.admin_' . strtolower($role), compact('data', 'role', 'countPegawai', 'countPenyediaJasa', 'countPenggunaJasa', 'countAuditor'));
        } else {
            return view('admin.admin_home', compact('countPegawai', 'countPenyediaJasa', 'countPenggunaJasa', 'countAuditor'));
        }
    }

    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:70',
            'instansi' => 'required|string|max:70',
            'alamat' => 'required|string|max:200',
            'email' => 'required|email',
            'kota' => 'required|string|max:35',
            'tanggal' => 'required|date',
            'no_whatsapp' => 'required|string',
            'role' => 'required|string',
        ]);

        // Pastikan nomor WhatsApp diawali dengan '62'
        $noWhatsapp = $request->input('no_whatsapp');
        if (!str_starts_with($noWhatsapp, '62')) {
            $noWhatsapp = '62' . ltrim($noWhatsapp, '0'); // Menghilangkan '0' di awal jika ada
        }

         // Ubah huruf pertama setiap kata menjadi kapital menggunakan ucwords()
        $nama = ucwords($request->input('nama'));
        $jabatan = ucwords($request->input('jabatan'));
        $instansi = ucwords($request->input('instansi'));
        $kota = ucwords($request->input('kota'));

        // Menyimpan data ke database
        $paktaIntegritas = PaktaIntegritas::create([
            'nama' => $nama,
            'jabatan' => $jabatan,
            'instansi' => $instansi,
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'kota' => $kota,
            'tanggal' => $request->input('tanggal'),
            'no_whatsapp' => $noWhatsapp,
            'role' => $request->input('role'),
        ]);

        // Cek apakah yang melakukan request adalah admin
        if ($request->input('is_admin') == 'true') {
            // Jika admin, hanya redirect tanpa kirim email
            return redirect()->route('admin.role', strtolower(str_replace(' ', '-', $request->role)))->with('success', 'Data Berhasil Disimpan');
        } else {
            // Buat link download surat
            $downloadLink = route('integritas.download-pdf', ['role' => $paktaIntegritas->role, 'id' => $paktaIntegritas->id]);

            // Kirim email dengan mailable yang telah di-update
            Mail::to($request->input('email'))->send(new PaktaIntegritasMail($paktaIntegritas, $downloadLink));

            // Redirect ke halaman user setelah mengirim email
            return redirect()->back()->with('success', 'Data Berhasil Disimpan dan Email Terkirim.');
        }
    }

    public function userSurat()
    {
        $paktaIntegritas = PaktaIntegritas::latest()->take(3)->get();
        return view('down_surat', compact('paktaIntegritas'));
    }

    public function showForm($role)
    {
        return view('admin.admin_add', ['role' => $role]);
    }

    public function destroy($role, $id)
    {
        // Mencari data berdasarkan ID
        $data = PaktaIntegritas::findOrFail($id);

        // Menghapus data
        $data->delete();

        // Redirect kembali ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('admin.role', $role)->with('success', 'Data Berhasil Dihapus');
    }

    public function update(Request $request, $role, $id)
    {
        // Validasi data form
        $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:50',
            'instansi' => 'required|string|max:70',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'kota' => 'required|string|max:35',
            'tanggal' => 'required|date',
            'no_whatsapp' => 'required|string',
        ]);

       // Pastikan nomor WhatsApp diawali dengan '62'
        $noWhatsapp = $request->input('no_whatsapp');
        if (!str_starts_with($noWhatsapp, '62')) {
            $noWhatsapp = '62' . ltrim($noWhatsapp, '0'); // Menghilangkan '0' di awal jika ada
        }

        // Mengubah huruf pertama setiap kata menjadi kapital (capital each word) seperti di store
        $nama = ucwords($request->input('nama'));
        $jabatan = ucwords($request->input('jabatan'));
        $instansi = ucwords($request->input('instansi'));
        $kota = ucwords($request->input('kota'));

        // Mencari data berdasarkan ID
        $data = PaktaIntegritas::findOrFail($id);

        // Mengupdate data
        $data->update([
            'nama' => $nama,
            'jabatan' => $jabatan,
            'instansi' => $instansi,
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'kota' => $kota,
            'tanggal' => $request->input('tanggal'),
            'no_whatsapp' => $noWhatsapp,
        ]);

        // Redirect kembali ke halaman tabel sesuai role
        return redirect()->route('admin.role', strtolower(str_replace(' ', '-', $role)))->with('success', 'Data berhasil diupdate');
    }


    public function edit($role, $id)
    {
        // Mencari data berdasarkan ID
        $data = PaktaIntegritas::findOrFail($id);

        // Mengirimkan data ke view yang sesuai
        return view('admin.admin_edit', compact('data', 'role'));
    }

    public function editUserSurat($id)
    {
        // Temukan data berdasarkan ID
        $data = PaktaIntegritas::findOrFail($id);

        // Kirimkan data ke view
        return view('edit_surat', compact('data'));
    }

    public function updateUserSurat(Request $request, $id)
    {
        // Validasi data form
        $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:70',
            'instansi' => 'required|string|max:70',
            'alamat' => 'required|string|max:200',
            'email' => 'required|email',
            'kota' => 'required|string|max:35',
            'tanggal' => 'required|date',
            'no_whatsapp' => 'required|string',
        ]);

        // Pastikan nomor WhatsApp diawali dengan '62'
        $noWhatsapp = $request->input('no_whatsapp');
        if (!str_starts_with($noWhatsapp, '62')) {
            $noWhatsapp = '62' . ltrim($noWhatsapp, '0'); // Menghilangkan '0' di awal jika ada
        }

        // Mengubah huruf pertama setiap kata menjadi kapital (capital each word) seperti di store
        $nama = ucwords($request->input('nama'));
        $jabatan = ucwords($request->input('jabatan'));
        $instansi = ucwords($request->input('instansi'));
        $kota = ucwords($request->input('kota'));

        // Mencari data berdasarkan ID
        $data = PaktaIntegritas::findOrFail($id);

        // Mengupdate data
        $data->update([
            'nama' => $nama,
            'jabatan' => $jabatan,
            'instansi' => $instansi,
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'kota' => $kota,
            'tanggal' => $request->input('tanggal'),
            'no_whatsapp' => $noWhatsapp,
        ]);

        // Redirect ke halaman down_surat dengan pesan sukses
        return redirect()->route('user.down-surat')->with('success', 'Data berhasil diupdate');
    }


    // export excel
    public function export($role)
    {
        return Excel::download(new PaktaIntegritasExport($role), 'data-' . $role . '.xlsx');
    }

    // download pdf dan template
    public function downloadPdf($role, $id)
    {
        try {
            $data = PaktaIntegritas::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.role', $role)->withErrors(['message' => 'Data tidak ditemukan']);
        }

        // Temukan data Pakta Integritas berdasarkan ID yang diberikan
        $data = PaktaIntegritas::findOrFail($id);

        // Dapatkan pernyataan, perjanjian, dan judul berdasarkan role
        $result = $this->getPerjanjianByRole($role);
        $pernyataan = $result['pernyataan'];
        $perjanjian = $result['perjanjian'];
        $judul = $result['judul'];

        // Path ke gambar kop surat yang akan digunakan dalam surat
        $path = public_path('assets/kop-surat.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Generate QR Code untuk WhatsApp
        $phone = '62' . ltrim($data->no_whatsapp, '0'); // Menghapus '0' di awal dan menambahkan '62'
        $waLink = 'https://wa.me/' . $phone;
        $qrcodeSvg = QrCode::format('svg')->size(80)->generate($waLink);
        $qrcodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcodeSvg);
        $qrcodeBase64 = base64_encode($qrcodeSvgClean);


        // Render view template_surat dengan data yang sudah disiapkan
        $html = view('template.template_surat', compact('data', 'pernyataan', 'perjanjian', 'base64', 'judul', 'qrcodeBase64'))->render();

        // Load HTML ke dalam DOMPDF
        $pdf = Pdf::loadHTML($html);

        // Bersihkan nama file dari karakter yang tidak valid
        $invalidCharacters = ['\\', '/', ':', '*', '?', '"', '<', '>', '|'];
        $sanitizedFileName = str_replace($invalidCharacters, '-', $data->nama);

        // Unduh file PDF dengan nama yang sesuai
        switch (strtolower($role)) {
            case 'pegawai':
                $fileName = 'PaktaIntegritas-Pegawai-' . $sanitizedFileName . '.pdf';
                break;
            case 'penyedia-jasa':
                $fileName = 'PaktaIntegritas-PenyediaJasa-' . $sanitizedFileName . '.pdf';
                break;
            case 'pengguna-jasa':
                $fileName = 'PaktaIntegritas-PenggunaJasa-' . $sanitizedFileName . '.pdf';
                break;
            case 'auditor':
                $fileName = 'PaktaIntegritas-Auditor-' . $sanitizedFileName . '.pdf';
                break;
            default:
                $fileName = 'PaktaIntegritas-' . $sanitizedFileName . '.pdf';
                break;
        }

        return $pdf->download($fileName);
    }

    // Fungsi untuk mendapatkan perjanjian berdasarkan role
    private function getPerjanjianByRole($role)
    {
        $judul = '';
        $perjanjian = [];
        $pernyataan = '';

        switch (strtolower($role)) {
            case 'pegawai':
                $judul = "ANTI SUAP PUNGLI GRATIFIKASI, KETIDAKBERPIHAKAN DAN KERAHASIAAN";
                $pernyataan = "Menyatakan bahwa saya dengan sungguh-sungguh dalam rangka pelaksanaan pemeriksaan dan pengujian di BPMSPH bersedia menjalankan dan mentaati hal-hal seperti yang tertulis dibawah ini :";
                $perjanjian = [
                    "Berperan secara pro aktif dalam upaya pencegahan dan pemberantasan Korupsi, Kolusi dan Nepotisme (KKN) serta tidak melibatkan diri dalam perbuatan tercela;",
                    "Berkomitmen tidak meminta pemberian secara langsung dan/atau tidak langsung berupa suap, hadiah, bantuan, atau bentuk lainnya yang tidak sesuai dengan ketentuan yang berlaku serta melaporkan pemberian tersebut apabila menerimanya;",
                    "Berkomitmen bersikap transparan, jujur, objektif dan akuntabel untuk tidak terlibat atau terpengaruh terhadap tekanan komersial, keuangan yang dapat mempengaruhi hasil pengujian untuk menghindari benturan kepentingan (conflict of interest) dalam pelaksanaan tugas;",
                    "Berkomitmen untuk bebas dari kegiatan lain, internal dan eksternal yang dapat mengurangi kepercayaan dalam kemandirian pertimbangan dan integritas dalam kegiatan pengujian, dan berpengaruh buruk terhadap mutu kerja;",
                    "Berkomitmen untuk bekerja secara profesional, menjunjung tinggi aturan yang berlaku baik di lingkungan laboratorium pengujian;",
                    "Berkomitmen untuk menjaga kerahasiaan informasi dan hak kepemilikan dari pelanggan Laboratorium sesuai dengan persyaratan dan ketentuan yang berlaku, termasuk informasi dalam bentuk elektronik;",
                    "Berkomitmen memberi contoh dalam kepatuhan terhadap peraturan perundang-undangan dalam melaksanaan tugas terutama kepada pegawai yang berada di bawah pengawasan saya dan sesama pegawai di lingkungan kerja saya secara konsisten;",
                    "Berkomitmen menyampaikan informasi penyimpangan integritas serta turut menjaga kerahasiaan atas pelanggaran peraturan yang dilaporkannya;",
                    "Bila saya melanggar hal-hal tersebut di atas, saya siap menghadapi konsekuensi berdasarkan ketentuan dan perundang-undangan yang berlaku."
                ];
                break;
            case 'penyedia-jasa':
                $judul = "PENYEDIA JASA";
                $pernyataan = "Menyatakan bahwa saya dengan sungguh-sungguh dalam rangka pelaksanaan pemeriksaan dan pengujian di BPMSPH bersedia menjalankan dan mentaati hal-hal seperti yang tertulis dibawah ini:";
                $perjanjian = [
                    "Berperan secara pro aktif dalam upaya pencegahan dan pemberantasan Korupsi, Kolusi dan Nepotisme (KKN) serta tidak melibatkan diri dalam perbuatan tercela;",
                    "Tidak melakukan pemberian secara langsung dan/atau tidak langsung berupa suap, hadiah, bantuan, atau bentuk lainnya yang tidak sesuai dengan ketentuan yang berlaku serta melaporkan pemberian permintaan tersebut apabila ada yang menerimanya;",
                    "Bersikap transparan, jujur, objektif dan akuntabel dalam melaksanakan kegiatan sebagai penyedia jasa;",
                    "Menghindari benturan kepentingan (conict of interest) dalam pelaksanaan kegiatan sebagai penyedia jasa;",
                    "Memberi contoh dalam kepatuhan terhadap peraturan perundang-undangan dalam melaksanakan kegiatan sebagai penyedia jasa;",
                    "Akan menyampaikan informasi penyimpangan integritas serta turut menjaga kerahasiaan atas pelanggaran peraturan yang dilaporkannya;",
                    "Bila saya melanggar hal-hal tersebut di atas, saya siap menghadapi konsekuensi berdasarkan ketentuan dan perundang-undangan yang berlaku."
                ];
                break;
            case 'pengguna-jasa':
                $judul = "PENGGUNA JASA";
                $pernyataan = "Menyatakan bahwa saya dengan sungguh-sungguh akan menjalankan dan mentaati hal-hal seperti yang tertulis dibawah ini:";
                $perjanjian = [
                    "Berperan secara pro aktif dalam upaya pencegahan dan pemberantasan Korupsi, Kolusi dan Nepotisme (KKN) serta tidak melibatkan diri dalam perbuatan tercela;",
                    "Bersikap transparan, jujur, objektif dan akuntabel dalam melaksanakan kegiatan sebagai pengguna jasa;",
                    "Menghindari benturan kepentingan (conict of interest) dalam pelaksanaan kegiatan sebagai pengguna jasa;",
                    "Memberi contoh dalam kepatuhan terhadap peraturan perundang-undangan dalam melaksanakan kegiatan sebagai pengguna jasa;",
                    "Akan menyampaikan informasi penyimpangan integritas serta turut menjaga kerahasiaan atas pelanggaran peraturan yang dilaporkannya;",
                    "Bila saya melanggar hal-hal tersebut di atas, saya siap menghadapi konsekuensi berdasarkan ketentuan dan perundang-undangan yang berlaku."
                ];
                break;
            case 'auditor':
                $judul = "KETIDAKBERPIHAKAN AUDITOR INTERNAL";
                $pernyataan = "Menyatakan bahwa Saya sebagai Auditor Internal menandatangani & menjalankan “Pakta Integritas Ketidakberpihakan Auditor Internal” dengan ketentuan sebagai berikut:";
                $perjanjian = [
                    "Auditor Internal tidak akan berpihak kepada pihak tertentu dalam menjalankan fungsinya saat melaksanakan audit;",
                    "Auditor Internal tidak diperkenankan melakukan kerjasama dalam ketidakbenaran terkait temuan saat melaksanakan audit dengan auditee;",
                    "Auditor Internal menyadari dengan sepenuh hati terhadap tanggung jawabnya dalam melaksanakan audit untuk selalu mengedepankan “Independensi” atau ketidaktergantungan kepada pihak manapun;",
                    "Auditor internal sebagai kapasitasnya dalam jabatan tertentu tidak diperkenankan menggunakan kewenangannya melakukan intervensi dalam pelaksanaan audit yang mengakibatkan terjadinya konflik kepentingan pada ketidaksesuaian yang terjadi;",
                    "Auditor internal tidak diperbolehkan melakukan penghilangan atau penambahan temuan audit ketika kegiatan audit sudah selesai."
                ];
                break;
            default:
                $pernyataan = "Pernyataan tidak ditemukan untuk role yang dipilih.";
                $perjanjian = ["Perjanjian tidak ditemukan untuk role yang dipilih."];
                break;
        }

        return compact('pernyataan', 'perjanjian', 'judul');
    }

    public function viewSurat($role, $id)
    {
        // Temukan data berdasarkan ID
        $data = PaktaIntegritas::findOrFail($id);

        // Dapatkan pernyataan, perjanjian, dan judul berdasarkan role
        $result = $this->getPerjanjianByRole($role);
        $pernyataan = $result['pernyataan'];
        $perjanjian = $result['perjanjian'];
        $judul = $result['judul'];

        // Konversi gambar ke base64
        $path = public_path('assets/kop-surat.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        $qrcodeSvg = QrCode::format('svg')->size(80)->generate($data->no_whatsapp);
        $qrcodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcodeSvg);
        $qrcodeBase64 = base64_encode($qrcodeSvgClean);

        // Tampilkan view template surat di browser
        return view('template.template_surat', compact('data', 'pernyataan', 'perjanjian', 'base64', 'judul', 'qrcodeBase64'));
    }

}
