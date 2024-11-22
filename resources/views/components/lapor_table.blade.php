<div class="down-btn">
    <a href="{{ route('lapor.add') }}">
        <button class="btn-tambah">Tambah</button>
    </a>
    <a href="{{ route('lapor-spg.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>

<!-- In your LaporTable component -->

<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th style="width: 24%;">Nama Pelapor</th>
            <th>Jabatan Terlapor</th>
            <th style="width: 24%;">Nama Terlapor</th>
            <th>Email Pelapor</th>
            <th>Tanggal Kejadian</th>
            <th>Print/ PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                <td style="width: 24%;">{{ $item->reporter_name }}</td>
                <td>{{ $item->reported_position }}</td>
                <td style="width: 24%;">{{ $item->reported_name }}</td>
                <td>{{ $item->reporter_email }}</td>
                <td>{{ $item->incident_date }}</td>
                <td class="action-cell">
                    <a href="{{ route('laporan.pdf', ['id' => $item->id]) }}">
                        <div class="icon-action print"><i class="fa fa-print"></i></div>
                    </a>
                </td>
                <td class="action-cell">
                    <a href="{{ route('lapor-spg.edit', ['id' => $item->id]) }}">
                        <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                    </a>
                </td>
                <td class="action-cell">
                    <form id="delete-form-{{ $item->id }}"
                        action="{{ route('lapor-spg.destroy', ['id' => $item->id]) }}" method="POST">
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
