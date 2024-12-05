<?php

namespace App\Http\Controllers;

use App\Models\RiwayatVerifikasi;
use App\Models\PaktaIntegritas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\PaktaIntegritasMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class RiwayatVerifikasiController extends Controller
{

    public function index()
    {
        $riwayat_ditindak_lanjuti = RiwayatVerifikasi::where('status', 'ditindak_lanjuti')->get();
        $riwayat_belum_ditindak_lanjuti = RiwayatVerifikasi::where('status', 'belum_ditindak_lanjuti')->get();

        return view('admin.admin_verification_history', compact('riwayat_ditindak_lanjuti', 'riwayat_belum_ditindak_lanjuti'));
    }

    // Menyimpan riwayat verifikasi
    public function store(Request $request, $id)
    {
        // dd($request->all());
        $data = RiwayatVerifikasi::findOrFail($id);
        $dataPakta = PaktaIntegritas::findOrFail($data->pakta_integritas_id);

        $data->update([
            'admin_id' => $request->input('admin_id'),
            'catatan' => $request->input('catatan'),
            'status' => "ditindak_lanjuti",
            'tanggal_verifikasi' => now(),
        ]);

        $dataPakta->update([
            'status' => $request->input('status'),
        ]);

        if ($request->input('status') == "diterima") {
            $downloadLink = route('integritas.download-pdf', ['role' => $dataPakta->role, 'id' => $dataPakta->id]);
            Log::info('Download link: ' . $downloadLink);  // Verifikasi link yang dibentuk
            Mail::to($dataPakta->email)->send(new PaktaIntegritasMail($dataPakta, $downloadLink));
        }


        return redirect()->back()->with('success', 'Permohonan berhasil ditindak!');
    }

    // Menampilkan form untuk membuat riwayat verifikasi
    public function create($paktaIntegritasId)
    {
        return view('riwayat_verifikasi.create', compact('paktaIntegritasId'));
    }

    public function destroy($id)
    {
        $riwayat = RiwayatVerifikasi::findOrFail($id);
        $riwayat->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
