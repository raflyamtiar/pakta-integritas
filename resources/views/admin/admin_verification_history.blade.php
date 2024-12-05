<head>
    <style>
        .container {
            color: #000;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #0077B6;
            margin-bottom: 40px;
        }

        /* Card styling */
        .mycard-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            margin-top: 10px;
            width: 100%;
            gap: 10px;
            padding-bottom: 10px;
            padding: 10px;
        }

        .mycard-container::-webkit-scrollbar {
            height: 8px;
        }

        .mycard-container::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        .mycard-container::-webkit-scrollbar-track {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .card-me {
            display: flex;
            flex-direction: column;
            border-radius: 12px;
            border: 1px solid #476FFC;
            background: linear-gradient(94deg, #FFF 0%, #e5fcfd 100%);
            box-shadow: 0px 0px 15px 0px rgba(47, 118, 255, 0.25);
            padding: 20px;
            min-width: 520px;
        }

        .card-me .card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-me .card-top h2 {
            color: #0077B6;
            font-family: Inter;
            font-size: 20px;
            font-weight: 700;
            width: 80%;
        }

        .card-me .card-top p {
            color: rgba(0, 0, 0, 0.50);
            font-family: Inter;
            font-size: 14px;
            font-weight: 400;
            width: 20%;
            text-align: right;
        }

        .card-me .card-bottom {
            margin-top: 6px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .card-me .card-bottom .card-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .card-me .card-bottom .card-left h3 {
            color: #000;
            font-family: Inter;
            font-size: 18px;
            font-weight: 700;
        }

        .card-me .card-bottom .card-left h5 {
            color: rgba(0, 0, 0, 0.50);
            font-family: Inter;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            display: flex;
            flex-direction: column
        }

        .card-me .card-bottom .card-left p {
            color: #0077B6;
            font-family: Inter;
            font-size: 14px;
            font-weight: 500;
            text-decoration-line: underline;
        }

        .card-right {
            display: flex;
            gap: 10px;
            margin-bottom: -6px;
        }

        .card-right button {
            border-radius: 20px;
            padding: 5px 20px;
            background: #FFF;
            font-size: 16px;
        }

        .reject {
            border: 0.5px solid #F82424;
            color: #F82424;
            transition: all 0.3s ease-in-out;
        }

        .reject:hover,
        .accept:hover {
            transform: scale(1.1);
            cursor: pointer;
        }

        .accept:hover {
            background-color: #61df6e;
            color: white;
        }

        .reject:hover {
            background-color: #df6161;
            color: white;
        }

        .accept {
            border: 0.5px solid #0aa719;
            color: #0aa719;
            transition: all 0.3s ease-in-out;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #e0e0e0;
            font-size: 1rem;
        }

        table th {
            background-color: #0077B6;
            color: #fff;
            font-weight: bold;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f9fafb;
        }

        table tbody tr:hover {
            background-color: #e0f2fe;
            cursor: pointer;
        }

        table td {
            color: #333;
        }

        /* Status Badge Styling */
        .badge {
            display: inline-block;
            padding: 5px 12px;
            font-size: 0.875rem;
            font-weight: 600;
            text-align: center;
            border-radius: 20px;
        }

        .badge.ditindaklanjuti {
            background-color: #34d399;
            color: white;
        }

        .badge.ditolak {
            background-color: #f87171;
            color: white;
        }

        /* Modal Styling */
        .modal-me {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            color: #000;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .close-btn {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-buttons {
            display: flex;
            justify-content: end;
            gap: 10px;
            margin-top: 20px;
        }

        .modal-buttons button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .confirm-btn {
            background-color: #4CAF50;
            color: white;
        }

        .confirm-btn:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #da190b;
        }

        /* Styling untuk input field */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

@extends('layouts.admin')
@section('title', 'Halaman Verifikasi')
@section('content')

    {{-- MODAL TERIMA --}}
    <div id="confirmationAccModal" class="modal-me">
        <div class="modal-content">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <form method="POST" id="form-popup-accept">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <h2>Yakin anda akan <span class="green">menerima</span> pengajuan Pakta Integritas ini?</h2>

                <label for="catatanAcc" class="catatanModal">Catatan (tidak wajib):</label>
                <input type="text" id="catatanAcc" placeholder="Tuliskan catatan" name="catatan">
                <input type="hidden" name="status" value="diterima">
                <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->id() }}">

                <div class="modal-buttons">
                    <button type="submit" class="confirm-btn">Ya</button>
                    <button type="button" id="cancelAccBtn" class="cancel-btn">Tidak</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL TOLAK --}}
    <div id="confirmationRejModal" class="modal-me">
        <div class="modal-content">
            <span class="close-btn" id="closeRejModalBtn">&times;</span>
            <form method="POST" id="form-popup-reject">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <h2>Yakin anda akan <span class="red">menolak</span> pengajuan Pakta Integritas ini?</h2>

                <label for="catatanRej" class="catatanModal">Catatan (tidak wajib):</label>
                <input type="text" id="catatanRej" placeholder="Tuliskan catatan" name="catatan">
                <input type="hidden" name="status" value="ditolak">
                <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->id() }}">

                <div class="modal-buttons">
                    <button type="submit" class="confirm-btn">Ya</button>
                    <button type="button" id="cancelRejBtn" class="cancel-btn">Tidak</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Halaman utama --}}
    <div class="container">
        <h1>Halaman Verifikasi</h1>

        <h3>Daftar Permohonan Persetujuan</h3>
        <div class="mycard-container">
            @if ($riwayat_belum_ditindak_lanjuti->isEmpty())
                <div>Tidak ada permohonan</div>
            @else
                @foreach ($riwayat_belum_ditindak_lanjuti as $item)
                    <div class="card-me">
                        <div class="card-top">
                            <h2>PERSETUJUAN PAKTA INTEGRITAS</h2>
                            <p>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d F Y') }}</p>
                        </div>
                        <div class="card-bottom">
                            <div class="card-left">
                                <h3>{{ $item->paktaIntegritas->nama }}</h3>
                                <h5><span>{{ ucwords($item->paktaIntegritas->role) }} |
                                        {{ $item->paktaIntegritas->jabatan }}</span>
                                    <span>{{ $item->paktaIntegritas->instansi }}</span>
                                </h5>

                                <p>
                                    <a href="{{ asset('storage/' . $item->paktaIntegritas->identitas_diri) }}"
                                        target="_blank">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Identitas
                                    </a>
                                </p>

                            </div>

                            <div class="card-right">
                                <button class="accept" id="accModalBtn" data-id="{{ $item->id }}">Terima</button>
                                <button class="reject" id="rejModalBtn" data-id="{{ $item->id }}">Tolak</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <h3 style="margin-top: 20px;">Riwayat Verifikasi</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pemohon</th>
                    <th>Diverifikasi Oleh</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Penindakan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($riwayat_ditindak_lanjuti->isEmpty())
                    <tr aria-colspan="8">
                        <td colspan="8">Belum ada data</td>
                    </tr>
                @else
                    @foreach ($riwayat_ditindak_lanjuti as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->paktaIntegritas->nama ?? 'N/A' }}</td>
                            <td>{{ $item->admin->name ?? 'N/A' }}</td>
                            <td>
                                <span
                                    class="badge {{ $item->paktaIntegritas->status == 'diterima' ? 'ditindaklanjuti' : 'ditolak' }}">
                                    {{ $item->paktaIntegritas->status }}
                                </span>
                            </td>
                            <td>{{ $item->catatan ?? 'N/A' }}</td>
                            <td>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d F Y') ?? 'N/A' }}</span>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->toTimeString() }}</span>
                            </td>
                            <td>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal_verifikasi)->format('d F Y') ?? 'N/A' }}</span>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal_verifikasi)->toTimeString() }}</span>
                            </td>
                            @php
                                $messageReject =
                                    'Hai ' .
                                    $item->paktaIntegritas->nama .
                                    ', Mohon maaf kami menolak surat pakta integritas anda karena hal berikut. Catatan Admin: ' .
                                    $item->catatan;
                                $messageAcc =
                                    'Hai ' .
                                    $item->paktaIntegritas->nama .
                                    ', Silakan periksa email anda untuk mendownload surat pakta integritas yang telah anda isi pada *' .
                                    \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') .
                                    '.* Surat ini hanya berlakua sampai pada ' .
                                    \Carbon\Carbon::parse($item->paktaIntegritas->tanggal_akhir)->format('d-m-Y') .
                                    '.';
                                $waLink =
                                    'https://wa.me/' .
                                    ltrim($item->paktaIntegritas->no_whatsapp, '0') .
                                    '?text=' .
                                    urlencode(
                                        $item->paktaIntegritas->status == 'diterima' ? $messageAcc : $messageReject,
                                    );
                            @endphp
                            <td style="display: flex; align-items: center; gap: 10px;">
                                <a href="{{ $waLink }}" target="_blank" style="text-decoration: none;">
                                    <i class="fa-brands fa-square-whatsapp" style="font-size: 30px; color: #25D366;"></i>
                                </a>
                                <form action="{{ route('riwayat-verifikasi.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        style="border: none; background: none; cursor: pointer;"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <div style="border-radius: 5px; background-color:red;"><i class="fa fa-trash"
                                                style="font-size: 18px; color:#fff;padding: 5px; "></i>
                                        </div>
                                    </button>
                                </form>
                            </td>
                            </form>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript untuk menerima dan menolak
        document.addEventListener('DOMContentLoaded', function() {

            // Modal Terima
            const modalAcc = document.getElementById("confirmationAccModal");
            const openAccModalBtn = document.getElementById("accModalBtn");
            const closeModalBtn = document.getElementById("closeModalBtn");
            const cancelAccBtn = document.getElementById("cancelAccBtn");
            const confirmAccBtn = document.getElementById("confirmAccBtn");
            const formAccept = document.getElementById("form-popup-accept");

            openAccModalBtn.addEventListener('click', function() {
                modalAcc.style.display = "block";
                const itemId = this.getAttribute('data-id');
                formAccept.action = '/admin/verification/store/' + itemId;
            });

            closeModalBtn.onclick = function() {
                modalAcc.style.display = "none";
            }
            cancelAccBtn.onclick = function() {
                modalAcc.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target === modalAcc) {
                    modalAcc.style.display = "none";
                }
            }

            // Modal Tolak
            const modalRej = document.getElementById("confirmationRejModal");
            const openRejModalBtn = document.getElementById("rejModalBtn");
            const closeRejModalBtn = document.getElementById("closeRejModalBtn");
            const cancelRejBtn = document.getElementById("cancelRejBtn");
            const confirmRejBtn = document.getElementById("confirmRejBtn");
            const formReject = document.getElementById("form-popup-reject");

            openRejModalBtn.addEventListener('click', function() {
                modalRej.style.display = "block";
                const itemId = this.getAttribute('data-id');
                formReject.action = '/admin/verification/store/' + itemId;
            });

            closeRejModalBtn.onclick = function() {
                modalRej.style.display = "none";
            }
            cancelRejBtn.onclick = function() {
                modalRej.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target === modalRej) {
                    modalRej.style.display = "none";
                }
            }
        });
    </script>
@endsection
