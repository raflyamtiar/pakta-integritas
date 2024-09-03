<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMI BPMSPH</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('style/style_admin.css') }}" />
</head>

<body>
    <div class="container-login" style="background-image: url('{{ asset('assets/login-bg.png') }}');">
        <div class="login-content">
            <div class="login-left">
                <img src="{{ asset('assets/logo smi.png') }}" alt="">
                <h3>SISTEM MANAJEMEN INTEGRASI</h3>
                @if ($errors->any())
                    <div class="login-alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="form-group-login">
                        <label for="login">Email or Username</label>
                        <input type="text" id="login" name="login" placeholder="Email or Username" required>
                    </div>
                    <div class="form-group-login">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group-login-show" >
                        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
                        <label for="show-password">Lihat Password</label>
                    </div>
                    <button class="btn-login" type="submit">Login</button>
                </form>
            </div>
            <div class="login-right">
                <img src="{{ asset('assets/login-right.png') }}" alt="foto">
            </div>
        </div>
    </div>
    <script src="{{ asset('script/script-admin.js') }}"></script>

</body>
</html>
