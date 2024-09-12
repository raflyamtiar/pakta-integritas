<nav class="container-navbar-admin">
    <a href="/">
        <div class="logo">
            <img src="{{ asset('assets/logo smi.png') }}" alt="Logo Image" class="logo-img">
            <h3>SMI BPMSPH</h3>
        </div>
    </a>
    <div class="admin-profile-dropdown">
        <span class="admin-name" id="adminDropdown" onclick="toggleDropdown()">Hai, {{ Auth::guard('admin')->user()->name }} <i class="fa fa-caret-down" id="caretIcon"></i></span>
        <div class="dropdown-content" id="dropdownContent">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>
