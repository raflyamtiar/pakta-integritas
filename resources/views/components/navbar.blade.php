<nav class="container-navbar-admin">
    <a href="/">
        <div class="logo">
            <img src="{{ asset('assets/logo smi.png') }}" alt="Logo Image" class="logo-img">
            <h3>SMI BPMSPH</h3>
        </div>
    </a>
    <div class="logout-admin">
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="button" id="logout-btn" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>
