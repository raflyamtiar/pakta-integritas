<?php

namespace App\Http\Controllers;

use App\Models\LaporSpg;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporSpgSubmitted;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporSpgExport;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;


class LaporSpgController extends Controller
{
    public function publicIndex()
    {
        return view('spg');
    }

    public function adminIndex(Request $request)
    {
        \Log::info('AdminIndex method started');

        $query = LaporSpg::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('reporter_name', 'like', "%{$searchTerm}%")
                ->orWhere('reporter_email', 'like', "%{$searchTerm}%")
                ->orWhere('reported_name', 'like', "%{$searchTerm}%")
                ->orWhere('case_type', 'like', "%{$searchTerm}%");
            });
        }

        \Log::info($query->toSql());


        // Sorting
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        // Log the data to the log file
        \Log::info('Data fetched for adminIndex', ['data' => $data]);

        return view('admin.admin_lapor', compact('data'));
    }


    public function create()
    {
        return view('admin.admin_spgAdd');
    }

    public function store(Request $request)
    {
        // Validasi data form
        $validatedData = $request->validate([
            'reporterName' => 'required|string|max:100',
            'reporterEmail' => 'required|email',
            'relationship' => 'required|string',
            'relationship_other' => 'nullable|string|max:100', // Tambahkan untuk "Lainnya"
            'reportedName' => 'required|string',
            'reportedPosition' => 'required|string',
            'caseType' => 'required|string',
            'case_type_other' => 'nullable|string|max:100', // Tambahkan untuk "Lainnya"
            'incidentLocation' => 'required|string',
            'incident_location_other' => 'nullable|string|max:100', // Tambahkan untuk "Lainnya"
            'incidentAddress' => 'required|string',
            'incidentDate' => 'required|date',
            'incidentTime' => 'required|date_format:H:i',
            'incidentDescription' => 'required|string',
            'declaration' => 'required|in:Setuju',  // Pastikan nilai checkbox 'Setuju' dikirim
            'evidence' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:20480',
        ]);

        // Proses nilai "Lainnya" untuk menggantikan nilai utama
        $validatedData['relationship'] = $validatedData['relationship'] === 'Lainnya'
            ? $validatedData['relationship_other']
            : $validatedData['relationship'];

        $validatedData['caseType'] = $validatedData['caseType'] === 'Lainnya'
            ? $validatedData['case_type_other']
            : $validatedData['caseType'];

        $validatedData['incidentLocation'] = $validatedData['incidentLocation'] === 'Lainnya'
            ? $validatedData['incident_location_other']
            : $validatedData['incidentLocation'];

        // Pemformatan data
        $reporterName = ucwords($validatedData['reporterName']);
        $reportedName = ucwords($validatedData['reportedName']);
        $reportedPosition = ucwords($validatedData['reportedPosition']);

        // Simpan data laporan
        $laporanSpg = LaporSpg::create([
            'reporter_name' => $reporterName,
            'reporter_email' => $validatedData['reporterEmail'],
            'relationship' => $validatedData['relationship'],
            'reported_name' => $reportedName,
            'reported_position' => $reportedPosition,
            'case_type' => $validatedData['caseType'],
            'incident_location' => $validatedData['incidentLocation'],
            'incident_address' => $validatedData['incidentAddress'],
            'incident_date' => $validatedData['incidentDate'],
            'incident_time' => $validatedData['incidentTime'],
            'incident_description' => $validatedData['incidentDescription'],
            'declaration' => $validatedData['declaration'],
        ]);

        // Handle file upload (if any)
        if ($request->hasFile('evidence')) {
            $filePath = $request->file('evidence')->store('evidence_files', 'public');
            $laporanSpg->evidence = $filePath;
            $laporanSpg->save();
        }

        // Cek apakah yang melakukan request adalah admin
        if ($request->input('is_admin') === 'true') {
            return redirect()->route('lapor.index')->with('success', 'Laporan berhasil disimpan');
        } else {
            $downloadLink = route('laporan.pdf', $laporanSpg->id);
            Mail::to($laporanSpg->reporter_email)->send(new LaporSpgSubmitted($laporanSpg, $downloadLink));

            return response()->json([
                'message' => 'Laporan Anda berhasil dikirim! Email konfirmasi telah dikirim.',
                'data' => $laporanSpg
            ]);
        }
    }

    public function edit($id)
    {
        $laporanSpg = LaporSpg::findOrFail($id);
        return view('admin.edit_lapor_spg', compact('laporanSpg'));
    }

    public function update(Request $request, $id)
    {
        $data = LaporSpg::findOrFail($id);

        // Validasi data form
        $validatedData = $request->validate([
            'reporterName' => 'required|string|max:100',
            'reporterEmail' => 'required|email',
            'relationship' => 'required|string',
            'relationship_other' => 'nullable|string|max:100', // Tambahkan untuk "Lainnya"
            'reportedName' => 'required|string',
            'reportedPosition' => 'required|string',
            'caseType' => 'required|string',
            'case_type_other' => 'nullable|string|max:100', // Tambahkan untuk "Lainnya"
            'incidentLocation' => 'required|string',
            'incident_location_other' => 'nullable|string|max:100', // Tambahkan untuk "Lainnya"
            'incidentAddress' => 'required|string',
            'incidentDate' => 'required|date',
            'incidentDescription' => 'required|string',
            'declaration' => 'required|in:Setuju', // Validasi untuk checkbox 'Setuju'
            'evidence' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:20480',
        ]);

        // Proses nilai "Lainnya" untuk menggantikan nilai utama
        $validatedData['relationship'] = $validatedData['relationship'] === 'Lainnya'
            ? $validatedData['relationship_other']
            : $validatedData['relationship'];

        $validatedData['caseType'] = $validatedData['caseType'] === 'Lainnya'
            ? $validatedData['case_type_other']
            : $validatedData['caseType'];

        $validatedData['incidentLocation'] = $validatedData['incidentLocation'] === 'Lainnya'
            ? $validatedData['incident_location_other']
            : $validatedData['incidentLocation'];

        // Update data fields
        $data->update([
            'reporter_name' => $validatedData['reporterName'],
            'reporter_email' => $validatedData['reporterEmail'],
            'relationship' => $validatedData['relationship'],
            'reported_name' => $validatedData['reportedName'],
            'reported_position' => $validatedData['reportedPosition'],
            'case_type' => $validatedData['caseType'],
            'incident_location' => $validatedData['incidentLocation'],
            'incident_address' => $validatedData['incidentAddress'],
            'incident_date' => $validatedData['incidentDate'],
            'incident_description' => $validatedData['incidentDescription'],
            'declaration' => $validatedData['declaration'],
        ]);

        // Handle evidence file if uploaded
        if ($request->hasFile('evidence')) {
            // Delete existing file if it exists
            if ($data->evidence) {
                \Storage::disk('public')->delete($data->evidence);
            }

            // Store new file in public/evidence_files
            $filePath = $request->file('evidence')->store('evidence_files', 'public');
            $data->evidence = $filePath;
            $data->save();
        }

        return redirect()->route('lapor.index')->with('success', 'Laporan berhasil diperbarui');
    }


    public function destroy($id)
    {
        $laporanSpg = LaporSpg::findOrFail($id);
        $laporanSpg->delete();

        return redirect()->route('lapor.index')->with('success', 'Laporan berhasil dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new LaporSpgExport, 'laporan_spg.xlsx');
    }

    public function downloadPdf($id)
    {
        try {
            $laporanSpg = LaporSpg::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        // Definisikan variabel yang digunakan dalam compact()
        $pernyataan = 'Pernyataan terkait laporan';
        $perjanjian = 'Perjanjian terkait laporan';
        $judul = 'Laporan SPG';

        // Definisikan $base64 untuk gambar kop surat
        $path = public_path('assets/kop.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Membuat nama file berbasis reporter_name
        $reporterName = str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|', ' '], '-', $laporanSpg->reporter_name);
        $fileName = 'laporan-spg-' . $reporterName . '.pdf';

        // Periksa apakah ada file evidence yang valid
        $evidencePath = $laporanSpg->evidence ? Storage::disk('public')->path($laporanSpg->evidence) : null;

        if ($evidencePath && file_exists($evidencePath) && mime_content_type($evidencePath) === 'application/pdf') {
            // Panggil fungsi jika evidence adalah file PDF dan ada
            return $this->mergePdfWithEvidence($laporanSpg, $evidencePath, 'D', $fileName);
        } elseif ($evidencePath) {
            // Jika evidence berupa gambar atau ada evidence dengan format lain
            $evidenceBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($evidencePath));
        } else {
            // Tangani jika tidak ada evidence
            $evidenceBase64 = null;
        }

        // Render HTML view dan buat file PDF
        $html = view('template.laporan_pdf', compact('laporanSpg', 'pernyataan', 'perjanjian', 'base64', 'judul', 'evidenceBase64'))->render();
        $pdf = Pdf::loadHTML($html);

        return $pdf->download($fileName);
    }


    public function previewPdf($id)
    {
        try {
            $laporanSpg = LaporSpg::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        // Definisikan variabel yang digunakan dalam compact()
        $pernyataan = 'Pernyataan terkait laporan';
        $perjanjian = 'Perjanjian terkait laporan';
        $judul = 'Laporan SPG';

        // Definisikan $base64 untuk gambar kop surat
        $path = public_path('assets/kop.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Membuat nama file berbasis reporter_name
        $reporterName = str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|', ' '], '-', $laporanSpg->reporter_name);
        $fileName = 'laporan-spg-' . $reporterName . '.pdf';

        // Periksa apakah ada file evidence yang valid
        $evidencePath = $laporanSpg->evidence ? Storage::disk('public')->path($laporanSpg->evidence) : null;

        if ($evidencePath && file_exists($evidencePath) && mime_content_type($evidencePath) === 'application/pdf') {
            // Panggil fungsi jika evidence adalah file PDF dan ada
            return $this->mergePdfWithEvidence($laporanSpg, $evidencePath, 'I', $fileName);
        } elseif ($evidencePath) {
            // Jika evidence berupa gambar atau ada evidence dengan format lain
            $evidenceBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($evidencePath));
        } else {
            // Tangani jika tidak ada evidence
            $evidenceBase64 = null;
        }

        // Render HTML view dan buat file PDF
        $html = view('template.laporan_pdf', compact('laporanSpg', 'pernyataan', 'perjanjian', 'base64', 'judul', 'evidenceBase64'))->render();
        $pdf = Pdf::loadHTML($html);

        return $pdf->stream($fileName);
    }



    private function mergePdfWithEvidence($laporanSpg, $evidencePath, $outputMode = 'I', $fileName = 'laporan-spg.pdf')
    {
        // Definisikan $base64 untuk gambar kop surat
        $path = public_path('assets/kop.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        $pernyataan = 'Pernyataan terkait laporan';
        $perjanjian = 'Perjanjian terkait laporan';
        $judul = 'Laporan SPG';

        // Membuat PDF dari template HTML
        $html = view('template.laporan_pdf', compact('laporanSpg', 'pernyataan', 'perjanjian', 'base64', 'judul'))->render();
        $suratPdf = Pdf::loadHTML($html)->output();

        $suratPath = storage_path('app/temp_surat.pdf');
        file_put_contents($suratPath, $suratPdf);

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($suratPath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplId);
        }

        // Tambahkan halaman dari file bukti jika ada
        $evidencePageCount = $pdf->setSourceFile($evidencePath);
        for ($pageNo = 1; $pageNo <= $evidencePageCount; $pageNo++) {
            $tplId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplId);
        }

        // Hapus file sementara
        unlink($suratPath);

        // Return response dengan nama file yang sudah diatur
        return response($pdf->Output($outputMode), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', ($outputMode == 'D' ? 'attachment' : 'inline') . '; filename="' . $fileName . '"');
    }

}
