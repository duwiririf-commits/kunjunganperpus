@extends('layouts.auth')

@section('title', 'Login - Kunjungan Perpustakaan')

@section('content')

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    html,
    body {
        width: 100%;
        min-height: 100%;
        font-family: Arial, sans-serif;
    }


    .login-page {
        width: 100%;
        min-height: 100vh;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        background: #caa9b7;

        padding: 35px;
    }


    .brand {
        display: flex;
        justify-content: center;
        align-items: center;

        gap: 28px;

        margin-bottom: 20px;
    }


    .brand-title {
        margin: 0;

        font-size: 30px;
        font-weight: bold;
        letter-spacing: 1px;

        color: #202124;
    }


    .brand-icon {
        font-size: 60px;

        color: #1d344b;

        line-height: 1;
    }


    .login-card {
        width: 560px;

        background: #e5e1d4;

        padding: 30px 65px;

        border-radius: 25px;

        box-sizing: border-box;
    }


    .login-header {
        display: flex;
        justify-content: center;
        align-items: center;

        gap: 20px;

        margin-bottom: 25px;
    }


    .login-user-icon {
        width: 70px;
        height: 70px;

        border-radius: 50%;

        background: #202124;

        display: flex;
        justify-content: center;
        align-items: center;

        color: #e5e1d4;

        font-size: 30px;

        flex-shrink: 0;
    }


    .login-title {
        margin: 0;

        font-size: 30px;
        font-weight: bold;

        color: #202124;
    }


    .login-form-group {
        margin-bottom: 15px;
    }


    .login-form-group label {
        display: block;

        margin-bottom: 5px;

        font-size: 20px;
        font-weight: bold;

        color: #25272b;
    }


    .login-input-box {
        width: 100%;
        height: 45px;

        display: flex;
        align-items: center;

        background: #e4e2d8;

        border: 1.5px solid #d28ca8;

        border-radius: 12px;

        box-sizing: border-box;

        overflow: hidden;
    }


    .login-input-icon {
        width: 55px;
        min-width: 55px;
        height: 100%;

        display: flex;
        justify-content: center;
        align-items: center;

        font-size: 20px;

        color: #d28ca8;

        background: transparent;

        pointer-events: none;
    }


    .login-input {
        flex: 1;

        width: 100%;
        height: 100%;

        border: none !important;
        outline: none !important;

        background: transparent !important;

        padding: 0 15px 0 0;

        font-size: 15px;
        font-weight: bold;

        color: #25272b;

        box-shadow: none !important;
    }


    .login-input::placeholder {
        color: #858990;

        opacity: 1;
    }


    .login-input:focus {
        border: none !important;

        outline: none !important;

        background: transparent !important;

        box-shadow: none !important;
    }


    .login-input-box:focus-within {
        border-color: #dd81a6;

        background: #e4e2d8;
    }


    /* ==================================================
       TOMBOL LIHAT PASSWORD
    ================================================== */

    .password-toggle {
        width: 45px;
        min-width: 45px;
        height: 100%;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;

        background: transparent;

        color: #777777;

        font-size: 17px;

        cursor: pointer;

        padding: 0;
    }


    .password-toggle:hover {
        color: #d28ca8;
    }


    /* MENGHILANGKAN WARNA BAWAAN AUTOFILL CHROME */

    .login-input:-webkit-autofill,
    .login-input:-webkit-autofill:hover,
    .login-input:-webkit-autofill:focus,
    .login-input:-webkit-autofill:active {

        -webkit-box-shadow:
            0 0 0 1000px #e4e2d8 inset !important;

        box-shadow:
            0 0 0 1000px #e4e2d8 inset !important;

        -webkit-text-fill-color: #25272b !important;

        caret-color: #25272b !important;

        background-color: #e4e2d8 !important;

        transition:
            background-color
            5000s
            ease-in-out
            0s;
    }


    /* INGAT SAYA */

    .remember-group {
        display: flex;
        align-items: center;

        gap: 10px;

        margin-top: 5px;

        margin-bottom: 18px;
    }


    .remember-group input {
        width: 20px;
        height: 20px;

        margin: 0;

        cursor: pointer;

        accent-color: #bd7894;
    }


    .remember-group label {
        margin: 0;

        font-size: 17px;

        color: #25272b;

        cursor: pointer;
    }


    /* BUTTON LOGIN */

    .btn-login {
        width: 100%;
        height: 48px;

        border: none;

        border-radius: 15px;

        background: #bd7894;

        color: #202124;

        font-size: 23px;

        font-weight: bold;

        letter-spacing: 1px;

        cursor: pointer;

        transition: 0.2s;
    }


    .btn-login:hover {
        background: #aa6682;

        transform: scale(1.01);
    }


    /* ERROR */

    .invalid-feedback {
        margin-top: 5px;

        font-size: 13px;

        color: #d9534f;
    }


    /* RESPONSIVE */

    @media (max-width: 600px) {

        .login-page {
            padding: 20px 15px;
        }


        .brand {
            gap: 12px;

            margin-bottom: 20px;
        }


        .brand-title {
            font-size: 20px;
        }


        .brand-icon {
            font-size: 40px;
        }


        .login-card {
            width: 100%;

            padding: 25px 20px;

            border-radius: 20px;
        }


        .login-title {
            font-size: 24px;
        }


        .login-user-icon {
            width: 60px;
            height: 60px;

            font-size: 25px;
        }

    }

</style>


<div class="login-page">


    <div class="brand">

        <h2 class="brand-title">
            Kunjungan
        </h2>


        <div class="brand-icon">
            <i class="fas fa-book-open"></i>
        </div>


        <h2 class="brand-title">
            Perpustakaan
        </h2>

    </div>


    <div class="login-card">


        <div class="login-header">

            <div class="login-user-icon">
                <i class="fas fa-user"></i>
            </div>


            <h1 class="login-title">
                Login Admin
            </h1>

        </div>


        <form method="POST" action="{{ route('login.process') }}">

            @csrf


            <div class="login-form-group">

                <label for="email">
                    Email
                </label>


                <div class="login-input-box">

                    <div class="login-input-icon">
                        <i class="far fa-envelope"></i>
                    </div>


                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        class="login-input @error('email') is-invalid @enderror"
                        autocomplete="email"
                        required
                    >

                </div>


                @error('email')

                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="login-form-group">

                <label for="password">
                    Password
                </label>


                <div class="login-input-box">

                    <div class="login-input-icon">
                        <i class="fas fa-lock"></i>
                    </div>


                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Masukkan password"
                        class="login-input @error('password') is-invalid @enderror"
                        autocomplete="current-password"
                        required
                    >


                    {{-- ==================================================
                         TOMBOL LIHAT PASSWORD
                    ================================================== --}}

                    <button
                        type="button"
                        class="password-toggle"
                        onclick="togglePassword()"
                        aria-label="Tampilkan password"
                    >

                        <i
                            class="fas fa-eye"
                            id="password-icon"
                        ></i>

                    </button>

                </div>


                @error('password')

                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="remember-group">

                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    {{ old('remember') ? 'checked' : '' }}
                >


                <label for="remember">
                    Ingat saya
                </label>

            </div>


            <button type="submit" class="btn-login">
                Login
            </button>


        </form>

    </div>

</div>


<script>

    function togglePassword() {

        const passwordInput =
            document.getElementById('password');

        const passwordIcon =
            document.getElementById('password-icon');


        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            passwordIcon.classList.remove('fa-eye');

            passwordIcon.classList.add('fa-eye-slash');

        } else {

            passwordInput.type = 'password';

            passwordIcon.classList.remove('fa-eye-slash');

            passwordIcon.classList.add('fa-eye');

        }

    }

</script>


@endsection
