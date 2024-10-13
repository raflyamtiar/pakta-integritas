<div class="sidebar-admin">
    <a href="/">
        <div class="logo">
            <img src="{{ asset('assets/logo smi.png') }}" alt="Logo Image" class="logo-img">
            <h3>Sistem Manajemen Integrasi</h3>
        </div>
    </a>
    <a href="/admin/home">
        <div class="box-admin">
            <i class="fa-solid fa-house"></i>
            <h4>Beranda</h4>
        </div>
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

    <a href="/admin/lapor">
        <div class="box-admin-akun">
            <i class="fas fa-file-alt"></i>
            <h4>Formulir SPG</h4>
        </div>
    </a>

    <a href="{{ route('admin.account') }}">
        <div class="box-admin-akun">
            <i class="fa-solid fa-gear"></i>
            <h4>Pengaturan Akun</h4>
        </div>
    </a>
</div>
