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
                <h1>Selamat Datang, Admin SMI Pakta Integritas</h1>
            </header>
            <hr class="header-line">
            <div class="cards-admin">
                <div class="card green">
                    <h2>Pakta Integritas Pegawai</h2>
                    <p>Jumlah</p>
                    <a href="{{ route('admin.role', ['role' => 'pegawai']) }}">
                        <h3>{{ $countPegawai }}</h3>
                    </a>
                    <hr>
                    <a href="{{ route('admin.role', ['role' => 'pegawai']) }}">
                        <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
                    </a>
                    <img src="../assets/icon-note-white.svg" alt="Document Icon">
                </div>
                <div class="card blue">
                    <h2>Pakta Integritas Penyedia Jasa</h2>
                    <p>Jumlah</p>
                    <a href="{{ route('admin.role', ['role' => 'penyedia-jasa']) }}">
                        <h3>{{ $countPenyediaJasa }}</h3>
                    </a>
                    <hr>
                    <a href="{{ route('admin.role', ['role' => 'penyedia-jasa']) }}">
                        <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
                    </a>
                    <img src="../assets/icon-note-white.svg" alt="Document Icon">
                </div>
                <div class="card yellow">
                    <h2>Pakta Integritas Pengguna Jasa</h2>
                    <p>Jumlah</p>
                    <a href="{{ route('admin.role', ['role' => 'pengguna-jasa']) }}">
                        <h3>{{ $countPenggunaJasa }}</h3>
                    </a>
                    <hr>
                    <a href="{{ route('admin.role', ['role' => 'pengguna-jasa']) }}">
                        <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
                    </a>
                    <img src="../assets/icon-note-white.svg" alt="Document Icon">
                </div>
                <div class="card red">
                    <h2>Pakta Integritas Auditor</h2>
                    <p>Jumlah</p>
                    <a href="{{ route('admin.role', ['role' => 'auditor']) }}">
                        <h3>{{ $countAuditor }}</h3>
                    </a>
                    <hr>
                    <a href="{{ route('admin.role', ['role' => 'auditor']) }}">
                        <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
                    </a>
                    <img src="../assets/icon-note-white.svg" alt="Document Icon">
                </div>
            </div>
        </div>

        <script src="{{ asset('script/script-admin.js') }}"></script>
</body>

</html>
