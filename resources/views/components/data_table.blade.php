<div class="down-btn">
    <a href="{{ route('admin.add', ['role' => $role]) }}">
        <button class="btn-tambah">Tambah</button>
    </a>
    <a href="{{ route('integritas.export', ['role' => $role]) }}">
        <button class="btn-export"> Export Excel</button>
    </a>
</div>

<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Lengkap</th>
            @if ($role === 'pegawai')
                <th>Jabatan</th>
            @else
                <th>Instansi</th>
            @endif
            <th>Email</th>
            <th>Nomor WhatsApp</th>
            <th>Identitas Diri</th>
            <th>Status Surat</th>
            <th>Pengajuan Surat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                @if ($role === 'pegawai')
                    <td>{{ $item->jabatan }}</td>
                @else
                    <td>{{ $item->instansi }}</td>
                @endif
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_whatsapp }}</td>
                <td>
                    @if ($item->identitas_diri)
                        <a href="{{ Storage::url($item->identitas_diri) }}" target="_blank">Lihat</a>
                    @else
                        Tidak ada file
                    @endif
                </td>
                <td
                    style="background-color: {{ \Carbon\Carbon::now()->between(\Carbon\Carbon::parse($item->tanggal), \Carbon\Carbon::parse($item->tanggal_akhir)->endOfDay()) ? '#dff0d8' : '#f8d7da' }}">
                    @php
                        $currentDate = \Carbon\Carbon::now();
                        $tanggalAkhir = \Carbon\Carbon::parse($item->tanggal_akhir)->endOfDay();
                        $tanggalMulai = \Carbon\Carbon::parse($item->tanggal);
                    @endphp
                    @if ($currentDate->between($tanggalMulai, $tanggalAkhir))
                        <span style="color:green;">Active</span>
                    @else
                        <span style="color: red;">Expired</span>
                    @endif
                </td>
                <td>
                    <label for="status_pengajuan_{{ $item->id }}" style="display: none;">Status Pengajuan
                        Surat</label>
                    <span id="status_pengajuan_{{ $item->id }}">
                        @if ($item->status == 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif ($item->status == 'diterima')
                            <span class="badge ditindaklanjuti">Diterima</span>
                        @elseif ($item->status == 'ditolak')
                            <span class="badge ditolak">Ditolak</span>
                        @else
                            <span class="badge">N/A</span>
                        @endif
                    </span>
                </td>
                <td class="action-cell">
                    <a href="{{ route('admin.integritas.download-pdf', ['role' => $role, 'id' => $item->id]) }}">
                        <div class="icon-action print"><i class="fa fa-print"></i></div>
                    </a>
                    <a href="{{ route('integritas.edit', ['role' => $role, 'id' => $item->id]) }}">
                        <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                    </a>
                    <form id="delete-form-{{ $item->id }}"
                        action="{{ route('integritas.destroy', ['role' => $role, 'id' => $item->id]) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $item->id }})">
                            <div class="icon-action trash">
                                <i class="fa fa-trash"></i>
                            </div>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
