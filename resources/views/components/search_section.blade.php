@props(['role' => null])

<div class="search-section">
    <form action="{{ url()->current() }}" method="GET" autocomplete="off">
        <input type="text" name="search" placeholder="Search" class="search-box" value="{{ request('search') }}">
        <button type="submit" class="icon-search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <!-- Tambahkan Filter Surat hanya jika $role tidak null -->
    @if ($role)
        <form action="{{ route('admin.role', ['role' => $role]) }}" method="GET" style="display: inline-block;">
            <select name="status" id="status-filter" onchange="this.form.submit()">
                <option value="">-- Semua --</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Active</option>
                <option value="tidak-aktif" {{ request('status') == 'tidak-aktif' ? 'selected' : '' }}>Expired
                </option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </form>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
