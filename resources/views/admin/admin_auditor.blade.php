<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMI BPMSPH</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="{{ asset('style/style_admin.css') }}" />
</head>

<body>
    <nav class="container-navbar-admin">
        <a href="/">
            <div class="logo">
                <img src="../assets/logo smi.png" alt="Logo Image" class="logo-img">
                <h3>SMI BPMSPH</h3>
            </div>
        </a>
        <div class="logout-admin">
            <button class="logout-btn">Logout</button>
            <form id="logout-form" action="" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav> <!-- navbar end -->

    <div class="container-admin">
        <div class="sidebar-admin">
            <a href="/admin/home">
                <div class="box-admin">
                    <h3>Beranda</h3>
                </div>
            </a>

            <div class="dropdown-admin">
                <div class="select-admin">
                    <h5 class="selected">Pakta Integritas</h5>
                    <div class="caret"></div>
                </div>
                <ul class="menu-admin">
                    <li class="active">Pakta Integritas</li>
                    <a href="/admin/pegawai">
                        <li>Pegawai</li>
                    </a>
                    <a href="/admin/penyedia-jasa">
                        <li>Penyedia Jasa</li>
                    </a>
                    <a href="/admin/pengguna-jasa">
                        <li>Pengguna Jasa</li>
                    </a>
                    <a href="/admin/auditor">
                        <li>Auditor</li>
                    </a>
                </ul>
            </div>
        </div>
        <div class="content-admin">
            <header>
                <h1>Tabel Formulir Pakta Integritas Auditor</h1>
            </header>
            <hr class="header-line">

            <div class="search-section">
                <form action="{{ url()->current() }}" method="GET" autocomplete="off">
                    <input type="text" name="search" placeholder="Search" class="search-box" value="{{ request('search') }}">
                    <button type="submit" class="icon-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="down-btn">
                <a href="/admin/add/auditor"><button class="btn-tambah">Tambah</button></a>
                <a href="{{ route('integritas.export', ['role' => $role]) }}"><button class="btn-export">Export Excel</button></a>
            </div>

            <table class="table-admin">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Instansi</th>
                        <th>Email</th>
                        <th>No WhatsApp</th>
                        <th>Print/PDF</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh Baris Tabel -->
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->instansi }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_whatsapp }}</td>
                        <td>
                            <!-- Tombol Print/PDF -->
                            <a href="{{ route('integritas.download-pdf', ['role' => $role, 'id' => $item->id]) }}">
                                <div class="icon-action print"><i class="fa fa-print"></i></div>
                            </a>
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('integritas.edit', ['role' => $role, 'id' => $item->id]) }}">
                                <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                            </a>
                        </td>
                        <td>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('integritas.destroy', ['role' => $role, 'id' => $item->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <div class="icon-action trash"><button type="submit"><i class="fa fa-trash"></i></button></div>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="pagination">
                <!-- Previous Page Link -->
                @if ($data->onFirstPage())
                    <span class="disabled">&#x3C;</span>
                @else
                    <a href="{{ $data->previousPageUrl() }}" rel="prev">&#x3C;</a>
                @endif

                <!-- Pagination Elements -->
                @foreach ($data->links()->elements as $element)
                    <!-- "Three Dots" Separator -->
                    @if (is_string($element))
                        <span class="disabled">{{ $element }}</span>
                    @endif

                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $data->currentPage())
                                <span class="active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($data->hasMorePages())
                    <a href="{{ $data->nextPageUrl() }}" rel="next">&#x3E;</a>
                @else
                    <span class="disabled">&#x3E;</span>
                @endif
            </div>
        </div>
        <script src="{{ asset('script/script-admin.js') }}"></script>
</body>

</html>
