@extends('layouts.admin')

@section('title', 'Pengaturan Akun')

@section('content')
<header>
    <h1>Halo, Admin Pakta Integritas</h1>
</header>
<hr class="header-line">
<div class="container-account">
    <h2>Daftar Pengguna</h2>

    <!-- Button to toggle form visibility -->
    <button id="toggleFormBtn" class="custom-btn" onclick="toggleForm()"> Tambah Admin Baru</button>

    <!-- Form to add new user -->
    <div id="userForm" class="user-form" style="display: none;">
        <h3 id="formTitle">Tambah Admin Baru</h3>
        <form id="addUserForm" method="POST">
            @csrf
            <input type="hidden" id="methodField" name="_method" value="POST">
            <input type="hidden" id="userId" name="id" value="">
            <div class="form-group-account">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="custom-input" required>
            </div>
            <div class="form-group-account">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="custom-input" required>
            </div>
            <div class="form-group-account">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="custom-input">
                <small id="passwordHint" style="display: none;">Kosongkan jika tidak ingin mengubah password</small>
            </div>
            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>

    <!-- Table untuk menampilkan daftar admin -->
    <div class="container-table-admin">
        <table class="table-admin-account">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td class="action-cell">
                            <button type="button" onclick="editAdmin('{{ $admin->id }}', '{{ $admin->name }}', '{{ $admin->email }}')">
                                <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                            </button>
                        </td>
                        <td class="action-cell">
                            <button type="button" onclick="confirmDelete({{ $admin->id }})">
                                <div class="icon-action trash-account">
                                    <i class="fa fa-trash"></i>
                                </div>
                            </button>
                            <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            <!-- Previous Page Link -->
            @if ($admins->onFirstPage())
                <span class="disabled"><i class="fa-solid fa-caret-left"></i></span>
            @else
                <a href="{{ $admins->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-caret-left"></i></a>
            @endif

            <!-- Pagination Elements -->
            @foreach ($admins->links()->elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <span class="disabled">{{ $element }}</span>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $admins->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($admins->hasMorePages())
                <a href="{{ $admins->nextPageUrl() }}" rel="next"><i class="fa-solid fa-caret-right"></i></a>
            @else
                <span class="disabled"><i class="fa-solid fa-caret-right"></i></span>
            @endif
        </div>

    </div>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Define showErrorAlert function -->
<script>
    function showErrorAlert(errors) {
        let errorMessages = '';
        errors.forEach(function(error) {
            errorMessages += error + '\n'; // Gabungkan pesan error
        });

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessages,
        });
    }
</script>

<!-- SweetAlert for Errors -->
@if ($errors->any())
    <script>
        var errors = [];
        @foreach ($errors->all() as $error)
            errors.push('{{ $error }}');
        @endforeach
        showErrorAlert(errors);
    </script>
@endif

<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
