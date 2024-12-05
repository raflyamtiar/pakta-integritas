<div class="sidebar-admin">
    <a href="/">
        <div class="logo">
            <img src="{{ asset('assets/logo smi.png') }}" alt="Logo Image" class="logo-img">
            <h3>Sistem Manajemen Integrasi</h3>
        </div>
    </a>
    <a href="/admin/home" class="box-admin">
        <i class="fa-solid fa-house"></i>
        <h4>Beranda</h4>
    </a>
    <br>
    <hr>
    <h5>Menu</h5>
    <div class="dropdown-admin">
        <div class="select-admin">
            <i class="fas fa-file-alt"></i>
            <h4 class="selected">Pakta Integritas</h4>
            <i class="fa-solid fa-caret-down"></i>
        </div>
        <ul class="menu-admin">
            <a href="/admin/pegawai" class="menu-item">
                <li>Pegawai</li>
            </a>
            <a href="/admin/penyedia-jasa" class="menu-item">
                <li>Penyedia Jasa</li>
            </a>
            <a href="/admin/pengguna-jasa" class="menu-item">
                <li>Pengguna Jasa</li>
            </a>
            <a href="/admin/auditor" class="menu-item">
                <li>Auditor</li>
            </a>
        </ul>
    </div>

    <a href="/admin/lapor" class="box-admin-akun">
        <i class="fas fa-file-alt"></i>
        <h4>Formulir SPG</h4>
    </a>

    <a href="/admin/verification" class="box-admin-akun">
        <i class="fas fa-file-alt"></i>
        <h4>Verifikasi</h4>
    </a>

    <a href="{{ route('admin.account') }}" class="box-admin-akun">
        <i class="fa-solid fa-gear"></i>
        <h4>Pengaturan Akun</h4>
    </a>
</div>
