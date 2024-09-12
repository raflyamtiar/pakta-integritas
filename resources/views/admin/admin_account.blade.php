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
    <button id="toggleFormBtn" class="custom-btn" onclick="toggleForm()"> Tambah User Baru</button>

   <!-- Form to add new user -->
    <div id="userForm" class="user-form" style="display: none;">
        <h3>Tambah User Baru</h3>
        <form id="addUserForm" method="POST" action="{{ route('admin.store') }}">
            @csrf
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
                <input type="password" id="password" name="password" class="custom-input" required>
            </div>
            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>

<!-- Table untuk menampilkan daftar admin -->

<table class="table-admin-account">
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
                    <td>
                        <a href="{{ route('admin.edit', $admin->id) }}">
                            <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.delete', $admin->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                <div class="icon-action trash-account">
                                    <i class="fa fa-trash"></i>
                                </div>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>

</div>

<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
