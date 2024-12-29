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
use App\Models\LaporSpg;
use Carbon\Carbon;
use App\Models\RiwayatVerifikasi;
use App\Mail\PaktaIntegritasMail;
use Illuminate\Support\Facades\Mail;

class PaktaIntegritasController extends Controller
{

    public function index(Request $request, $role = null)
    {
        $year = $request->input('year', now()->year);
        \Log::info("Fetching data for year: {$year}");

        // Menghitung jumlah surat yang masuk per bulan (keseluruhan)
        $suratMasukPerBulan = PaktaIntegritas::whereYear('created_at', $year)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->pluck('total', 'month');

        \Log::info("Surat Masuk per bulan: ", $suratMasukPerBulan->toArray());

        // Menghitung jumlah laporan dari LaporSpg per bulan
        $laporSpgPerBulan = LaporSpg::whereYear('created_at', $year)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->pluck('total', 'month');

        // Total surat masuk per bulan (gabungan dari PaktaIntegritas dan LaporSpg)
        $totalSuratMasukPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $totalSuratMasukPerBulan[$i] = ($suratMasukPerBulan[$i] ?? 0) + ($laporSpgPerBulan[$i] ?? 0);
        }

        // Menghitung jumlah surat per kategori (pegawai, penyedia jasa, pengguna jasa, auditor)
        $roles = ['pegawai', 'penyedia-jasa', 'pengguna-jasa', 'auditor'];
        $monthlyDataByRole = [];

        foreach ($roles as $r) {
            $monthlyDataByRole[$r] = PaktaIntegritas::where('role', $r)
                ->whereYear('created_at', $year)
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->pluck('total', 'month');
        }

        // Data untuk chart
        $monthlyData = [];
        $monthlyDataPegawai = [];
        $monthlyDataPenyedia = [];
        $monthlyDataPengguna = [];
        $monthlyDataAuditor = [];
        $monthlyDataLaporSpg = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = $totalSuratMasukPerBulan[$i]; // Semua kategori
            $monthlyDataPegawai[$i] = $monthlyDataByRole['pegawai'][$i] ?? 0; // Pegawai
            $monthlyDataPenyedia[$i] = $monthlyDataByRole['penyedia-jasa'][$i] ?? 0; // Penyedia Jasa
            $monthlyDataPengguna[$i] = $monthlyDataByRole['pengguna-jasa'][$i] ?? 0; // Pengguna Jasa
            $monthlyDataAuditor[$i] = $monthlyDataByRole['auditor'][$i] ?? 0; // Auditor
            $monthlyDataLaporSpg[$i] = $laporSpgPerBulan[$i] ?? 0; // LaporSpg
        }

        // Menghitung jumlah laporan LaporSpg
        $totalLaporanSpg = LaporSpg::count();

        // Query untuk data berdasarkan role
        $query = PaktaIntegritas::query();

        if ($role) {
            $query->where('role', $role);
        }

        // Pencarian berdasarkan parameter search
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
        // Filter status
        if ($request->has('status')) {
            $currentDate = \Carbon\Carbon::now();

            if ($request->input('status') === 'active') {
                $query->where('status', 'diterima')
                    ->where('tanggal_akhir', '>=', $currentDate->toDateString());
            } elseif ($request->input('status') === 'not-active') {
                $query->where(function ($q) use ($currentDate) {
                    $q->where('status', '!=', 'diterima')
                    ->where('tanggal_akhir', '<', $currentDate->toDateString());
                });
            } elseif ($request->input('status') === 'expired') {
                $query->where('tanggal_akhir', '<', $currentDate->toDateString());
            } elseif ($request->input('status') === 'pending') {
                $query->where('status', 'pending');
            } elseif ($request->input('status') === 'diterima') {
                $query->where('status', 'diterima');
            } elseif ($request->input('status') === 'ditolak') {
                $query->where('status', 'ditolak');
            }
        }

        // Paginasi data
        $data = $query->orderBy('created_at', 'desc')->paginate(10);

        // Menghitung jumlah role
        $roleCounts = PaktaIntegritas::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        $countPegawai = $roleCounts['pegawai'] ?? 0;
        $countPenyediaJasa = $roleCounts['penyedia-jasa'] ?? 0;
        $countPenggunaJasa = $roleCounts['pengguna-jasa'] ?? 0;
        $countAuditor = $roleCounts['auditor'] ?? 0;

        // Mendefinisikan variabel yang diperlukan
        $currentDate = \Carbon\Carbon::now();
        $oneYearAgo = $currentDate->copy()->subYear();

        // Jika permintaan AJAX untuk grafik
        if ($request->ajax()) {
            return response()->json([
                'monthlyData' => array_values($monthlyData),
                'monthlyDataPegawai' => array_values($monthlyDataPegawai),
                'monthlyDataPenyedia' => array_values($monthlyDataPenyedia),
                'monthlyDataPengguna' => array_values($monthlyDataPengguna),
                'monthlyDataAuditor' => array_values($monthlyDataAuditor),
                'monthlyDataLaporSpg' => array_values($monthlyDataLaporSpg),
            ]);
        }

        // Mengirimkan data ke view
        if ($role) {
            return view('admin.admin_' . strtolower($role), compact(
                'data',
                'role',
                'countPegawai',
                'countPenyediaJasa',
                'countPenggunaJasa',
                'countAuditor',
                'currentDate',
                'oneYearAgo'
            ));
        } else {
            return view('admin.admin_home', compact(
                'monthlyData',
                'monthlyDataPegawai',
                'monthlyDataPenyedia',
                'monthlyDataPengguna',
                'monthlyDataAuditor',
                'monthlyDataLaporSpg',
                'countPegawai',
                'countPenyediaJasa',
                'countPenggunaJasa',
                'countAuditor',
                'totalLaporanSpg',
                'currentDate',
                'oneYearAgo'
            ));
        }
    }

    public function getDataSurat(Request $request)
    {
        $year = $request->input('year') ?? date('Y');
        $status = $request->input('status') ?? 'semua';

        \Log::info("Year: {$year}, Status: {$status}");

        $monthlyData = [
            'semua' => [],
            'pegawai' => [],
            'penyedia' => [],
            'pengguna' => [],
            'auditor' => [],
            'laporspg' => [],
        ];

        try {
            // Query untuk semua surat di Pakta Integritas
            $querySemua = PaktaIntegritas::whereYear('created_at', $year);
            if ($status !== 'semua') {
                $querySemua->where('status', $status);
            }
            $suratMasukPerBulanSemua = $querySemua
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData['semua'][$i] = $suratMasukPerBulanSemua[$i] ?? 0;
            }

            // Query untuk pegawai
            $queryPegawai = PaktaIntegritas::whereYear('created_at', $year)->where('role', 'pegawai');
            if ($status !== 'semua') {
                $queryPegawai->where('status', $status);
            }
            $suratMasukPerBulanPegawai = $queryPegawai
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData['pegawai'][$i] = $suratMasukPerBulanPegawai[$i] ?? 0;
            }

            // Query untuk penyedia jasa
            $queryPenyedia = PaktaIntegritas::whereYear('created_at', $year)->where('role', 'penyedia-jasa');
            if ($status !== 'semua') {
                $queryPenyedia->where('status', $status);
            }
            $suratMasukPerBulanPenyedia = $queryPenyedia
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData['penyedia'][$i] = $suratMasukPerBulanPenyedia[$i] ?? 0;
            }

            // Query untuk pengguna jasa
            $queryPengguna = PaktaIntegritas::whereYear('created_at', $year)->where('role', 'pengguna-jasa');
            if ($status !== 'semua') {
                $queryPengguna->where('status', $status);
            }
            $suratMasukPerBulanPengguna = $queryPengguna
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData['pengguna'][$i] = $suratMasukPerBulanPengguna[$i] ?? 0;
            }

            // Query untuk auditor
            $queryAuditor = PaktaIntegritas::whereYear('created_at', $year)->where('role', 'auditor');
            if ($status !== 'semua') {
                $queryAuditor->where('status', $status);
            }
            $suratMasukPerBulanAuditor = $queryAuditor
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData['auditor'][$i] = $suratMasukPerBulanAuditor[$i] ?? 0;
            }

            // Query untuk lapor SPG
            $queryLaporSpg = LaporSpg::whereYear('created_at', $year);
            $suratMasukPerBulanLaporSpg = $queryLaporSpg
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData['laporspg'][$i] = $suratMasukPerBulanLaporSpg[$i] ?? 0;
            }

        } catch (\Exception $e) {
            \Log::error("Error fetching data: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        return response()->json([
            'monthlyData' => [
                'semua' => array_values($monthlyData['semua']),
                'pegawai' => array_values($monthlyData['pegawai']),
                'penyedia' => array_values($monthlyData['penyedia']),
                'pengguna' => array_values($monthlyData['pengguna']),
                'auditor' => array_values($monthlyData['auditor']),
                'laporspg' => array_values($monthlyData['laporspg']),
            ],
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'instansi' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'kota' => 'required|string',
            'tanggal' => 'required|date',
            'no_whatsapp' => 'required|string',
            'role' => 'required|string',
            'identitas_diri' => 'required|file|mimes:jpg,jpeg,png,pdf|max:20480',
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

        // Hitung tanggal akhir (setahun setelah tanggal pembuatan)
        $tanggal_pembuatan = $request->input('tanggal');
        $tanggal_akhir = \Carbon\Carbon::parse($tanggal_pembuatan)->addYear(); // Menambah 1 tahun

        // Proses file identitas_diri
        $identitasDiriPath = null;
        if ($request->hasFile('identitas_diri') && $request->file('identitas_diri')->isValid()) {
            // Simpan file dan dapatkan pathnya
            $identitasDiriPath = $request->file('identitas_diri')->store('identitas_diri', 'public');
        }

        // Menyimpan data ke database
        $paktaIntegritas = PaktaIntegritas::create([
            'nama' => $nama,
            'jabatan' => $jabatan,
            'instansi' => $instansi,
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'kota' => $kota,
            'tanggal' => $tanggal_pembuatan,
            'no_whatsapp' => $noWhatsapp,
            'role' => $request->input('role'),
            'status' => "pending",
            'tanggal_akhir' => $tanggal_akhir,
            'identitas_diri' => $identitasDiriPath,
        ]);

        RiwayatVerifikasi::create([
            'pakta_integritas_id' => $paktaIntegritas->id,
            'admin_id' => null,
            'status' => "belum_ditindak_lanjuti",
            'catatan' => "",
            'tanggal_pengajuan' => now(),
        ]);

        // Cek apakah yang melakukan request adalah admin
        if ($request->input('is_admin') == 'true') {
            return redirect()->route('admin.role', strtolower(str_replace(' ', '-', $request->role)))->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect()->back()->with('success', 'Pakta Integritas berhasil dikirim!');
        }
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
        // Mencari data berdasarkan ID
        $data = PaktaIntegritas::findOrFail($id);

        // Validasi data form
        $rules = [
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'instansi' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'kota' => 'required|string',
            'tanggal' => 'required|date',
            'no_whatsapp' => 'required|string',
        ];

        // Menambahkan validasi untuk identitas_diri
        if (!$data->identitas_diri) {
            $rules['identitas_diri'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:20480';
        } else {
            $rules['identitas_diri'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480';
        }

        $request->validate($rules);

        // Memastikan nomor WhatsApp diawali dengan '62'
        $noWhatsapp = $request->input('no_whatsapp');
        if (!str_starts_with($noWhatsapp, '62')) {
            $noWhatsapp = '62' . ltrim($noWhatsapp, '0'); // Menghilangkan '0' di awal jika ada
        }

        // Mengubah huruf pertama setiap kata menjadi kapital
        $nama = ucwords($request->input('nama'));
        $jabatan = ucwords($request->input('jabatan'));
        $instansi = ucwords($request->input('instansi'));
        $kota = ucwords($request->input('kota'));

        // Mengatur tanggal_akhir menjadi satu tahun setelah tanggal
        $tanggal = $request->input('tanggal');
        $tanggalAkhir = Carbon::parse($tanggal)->addYear()->toDateString();

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
            'tanggal_akhir' => $tanggalAkhir,
        ]);

        // Proses file identitas_diri
        if ($request->hasFile('identitas_diri')) {
            // Hapus file lama jika ada
            if ($data->identitas_diri && Storage::exists($data->identitas_diri)) {
                Storage::delete($data->identitas_diri);
            }

            // Simpan file baru
            $filePath = $request->file('identitas_diri')->store('uploads', 'public');
            $data->update(['identitas_diri' => $filePath]);
        }

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

            // Pastikan role yang diberikan sesuai, misalnya hanya pengguna dengan role terkait yang bisa mengunduh
        if ($data->role !== $role) {
            return redirect()->route('integritas.index')->withErrors(['message' => 'Role tidak sesuai untuk mengunduh file ini']);
        }

        // Temukan data Pakta Integritas berdasarkan ID yang diberikan
        $data = PaktaIntegritas::findOrFail($id);

        // Dapatkan pernyataan, perjanjian, dan judul berdasarkan role
        $result = $this->getPerjanjianByRole($role);
        $pernyataan = $result['pernyataan'];
        $perjanjian = $result['perjanjian'];
        $judul = $result['judul'];

        // Path ke gambar kop surat yang akan digunakan dalam surat
        $path = public_path('assets/kop-surat.png');
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

    public function previewEmail()
    {
        // Dummy data untuk simulasi tampilan
        $paktaIntegritas = (object) [
            'nama' => 'John Doe',
            'jabatan' => 'Manajer',
            'instansi' => 'PT. ABC',
            'email' => 'johndoe@example.com',
            'no_whatsapp' => '08123456789',
        ];

        // Buat link download dummy
        $downloadLink = '#';

        // Return view template email dengan data dummy
        return view('template.template_email', compact('paktaIntegritas', 'downloadLink'));
    }

}
