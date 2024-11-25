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
            <th>Jabatan</th>
            <th>Instansi</th>
            <th>Email</th>
            <th>Nomor WhatsApp</th>
            <th>Status Surat</th>
            <th>Print/ PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->instansi }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_whatsapp }}</td>
                <td
                    style="background-color: {{ $role === 'pegawai' ? '#dff0d8' : (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($item->tanggal), \Carbon\Carbon::parse($item->tanggal_akhir)->endOfDay()) ? '#dff0d8' : '#f8d7da') }}">
                    @if ($role === 'pegawai')
                        <span style="color:green;">Aktif</span>
                    @else
                        @php
                            $currentDate = \Carbon\Carbon::now();
                            $tanggalAkhir = \Carbon\Carbon::parse($item->tanggal_akhir)->endOfDay();
                            $tanggalMulai = \Carbon\Carbon::parse($item->tanggal);
                        @endphp
                        @if ($currentDate->between($tanggalMulai, $tanggalAkhir))
                            <span style="color:green;">Aktif</span>
                        @else
                            <span style="color: red;">Tidak Aktif</span>
                        @endif
                    @endif
                </td>
                <td class="action-cell">
                    <a href="{{ route('integritas.download-pdf', ['role' => $role, 'id' => $item->id]) }}">
                        <div class="icon-action print"><i class="fa fa-print"></i></div>
                    </a>
                </td>
                <td class="action-cell">
                    <a href="{{ route('integritas.edit', ['role' => $role, 'id' => $item->id]) }}">
                        <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                    </a>
                </td>
                <td class="action-cell">
                    <form id="delete-form-{{ $item->id }}"
                        action="{{ route('integritas.destroy', ['role' => $role, 'id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $item->id }})">
                            <div class="icon-action trash">
                                <i class="fa fa-trash"></i>
                        </button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
