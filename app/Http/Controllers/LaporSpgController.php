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
            'reportedName' => 'required|string',
            'reportedPosition' => 'required|string',
            'caseType' => 'required|string',
            'incidentLocation' => 'required|string',
            'incidentAddress' => 'required|string',
            'incidentDate' => 'required|date',
            'incidentTime' => 'required|date_format:H:i',
            'incidentDescription' => 'required|string',
            'declaration' => 'required|in:Setuju',  // Pastikan nilai checkbox 'Setuju' dikirim
            'evidence' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:20480',
        ]);

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

        // Validation rules
        $validatedData = $request->validate([
            'reporterName' => 'required|string|max:100',
            'reporterEmail' => 'required|email',
            'relationship' => 'required|string',
            'reportedName' => 'required|string',
            'reportedPosition' => 'required|string',
            'caseType' => 'required|string',
            'incidentLocation' => 'required|string',
            'incidentAddress' => 'required|string',
            'incidentDate' => 'required|date',
            // 'incidentTime' => 'nullable|date_format:H:i', // Optional validation for incidentTime
            'incidentDescription' => 'required|string',
            'declaration' => 'required|in:Setuju', // Validasi untuk checkbox 'Setuju'
            'evidence' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:20480',
        ]);

        // Update data fields, with conditional fallback for incidentTime
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
            'incident_time',
            'incident_description' => $validatedData['incidentDescription'],
            'declaration' => $validatedData['declaration'],
        ]);

        // Handle evidence file if uploaded
        if ($request->hasFile('evidence')) {
            if ($data->evidence) {
                \Storage::delete($data->evidence); // Delete existing file if it exists
            }

            $filePath = $request->file('evidence')->store('evidence_files');
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


    public function downloadPdf($id)
    {
        try {
            // Mencari data LaporSpg berdasarkan ID
            $laporanSpg = LaporSpg::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Jika data tidak ditemukan, redirect dengan pesan error
            return redirect()->route('admin.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        // Dapatkan pernyataan, perjanjian, dan judul (langsung tanpa menggunakan role)
        $pernyataan = 'Pernyataan terkait laporan';
        $perjanjian = 'Perjanjian terkait laporan';
        $judul = 'Laporan SPG';

        // Path ke gambar kop surat yang akan digunakan dalam surat
        $path = public_path('assets/kop.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        $evidencePath = Storage::path($laporanSpg->evidence);
        if (file_exists($evidencePath)) {
            $evidenceData = base64_encode(file_get_contents($evidencePath));
            $evidenceBase64 = 'data:image/png;base64,' . $evidenceData;
        } else {
            $evidenceBase64 = null;
        }

        // Render view PDF
        $html = view('template.laporan_pdf', compact('laporanSpg', 'pernyataan', 'perjanjian', 'base64', 'judul', 'evidenceBase64'))->render();

        // Load HTML ke dalam DOMPDF
        $pdf = Pdf::loadHTML($html);

        // Bersihkan nama file dari karakter yang tidak valid
        $invalidCharacters = ['\\', '/', ':', '*', '?', '"', '<', '>', '|'];
        $sanitizedFileName = str_replace($invalidCharacters, '-', 'laporan_spg_' . $laporanSpg->id);

        // Download file PDF
        return $pdf->download($sanitizedFileName . '.pdf');
    }

    // Menambahkan metode untuk ekspor ke Excel
    public function exportExcel()
    {
        return Excel::download(new LaporSpgExport, 'laporan_spg.xlsx');
    }

    public function previewPdf($id)
{
    try {
        // Mencari data LaporSpg berdasarkan ID
        $laporanSpg = LaporSpg::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return redirect()->route('admin.index')->withErrors(['message' => 'Data tidak ditemukan']);
    }

    // Persiapan data untuk view PDF
    $pernyataan = 'Pernyataan terkait laporan';
    $perjanjian = 'Perjanjian terkait laporan';
    $judul = 'Laporan SPG';

    $path = public_path('assets/kop.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $dataGambar = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

    $evidencePath = Storage::path($laporanSpg->evidence);
    if (file_exists($evidencePath)) {
        $evidenceData = base64_encode(file_get_contents($evidencePath));
        $evidenceBase64 = 'data:image/png;base64,' . $evidenceData;
    } else {
        $evidenceBase64 = null;
    }

    $html = view('template.laporan_pdf', compact('laporanSpg', 'pernyataan', 'perjanjian', 'base64', 'judul', 'evidenceBase64'))->render();

    $pdf = Pdf::loadHTML($html);

    // Tampilkan PDF di browser
    return $pdf->stream('laporan_spg_' . $laporanSpg->id . '.pdf');
}

}
