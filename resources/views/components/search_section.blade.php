<div class="search-section">
    <form action="{{ url()->current() }}" method="GET" autocomplete="off">
        <input type="text" name="search" placeholder="Search" class="search-box" value="{{ request('search') }}">
        <button type="submit" class="icon-search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
