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

    <a href="{{ route('admin.account') }}">
        <div class="box-admin-akun">
            <h3>Pengaturan Akun</h3>
            <i class="fa-solid fa-gear"></i>
        </div>
    </a>
</div>
