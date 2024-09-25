<nav class="container-navbar-admin">
    <div class="admin-profile-dropdown">
        <span class="admin-name" id="adminDropdown" onclick="toggleDropdown()"><i class="fa-solid fa-user"></i> Hai, {{ Auth::guard('admin')->user()->name }} <i class="fa fa-caret-down" id="caretIcon"></i></span>
        <div class="dropdown-content" id="dropdownContent">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn" id="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>
