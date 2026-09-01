@extends('layouts.auth')

@section('title', 'Login - Kunjungan Perpustakaan')

@section('content')

<style>

    /* =========================
       RESET
    ========================= */

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        min-height: 100%;
        font-family: Arial, sans-serif;
    }


    /* =========================
       BACKGROUND
    ========================= */

    .login-page {
        width: 100%;
        min-height: 100vh;

        display: flex;
        flex-direction: column;
        align-items: center;

        background: #dfb4c8;

        padding: 25px 20px;

        box-sizing: border-box;
    }


    /* =========================
       JUDUL
    ========================= */

    .brand {
        display: flex;
        justify-content: center;
        align-items: center;

        gap: 25px;

        margin-bottom: 20px;
    }


    .brand-title {
        margin: 0;

        font-size: 32px;
        font-weight: bold;

        color: #ffffff;
    }


    .brand-icon {
        font-size: 65px;

        color: #ffffff;

        line-height: 1;
    }


    /* =========================
       CARD LOGIN
    ========================= */

    .login-card {
        width: 100%;
        max-width: 650px;

        background: #ffffff;

        padding: 25px 55px 25px;

        border-radius: 35px;

        box-sizing: border-box;

        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }


    /* =========================
       HEADER LOGIN
    ========================= */

    .login-header {
        display: flex;
        justify-content: center;
        align-items: center;

        gap: 22px;

        margin-bottom: 22px;
    }


    .login-user-icon {
        width: 75px;
        height: 75px;

        border-radius: 50%;

        background: #d75b8f;

        display: flex;
        justify-content: center;
        align-items: center;

        color: #ffffff;

        font-size: 32px;

        flex-shrink: 0;
    }


    .login-title {
        margin: 0;

        font-size: 32px;
        font-weight: bold;

        color: #d75b8f;
    }


    /* =========================
       FORM GROUP
    ========================= */

    .login-form-group {
        margin-bottom: 16px;
    }


    .login-form-group label {
        display: block;

        margin-bottom: 7px;

        font-size: 21px;
        font-weight: bold;

        color: #20252c;
    }


    /* =========================
       INPUT
    ========================= */

    .login-input-box {
        width: 100%;
        height: 58px;

        display: flex;
        align-items: center;

        background: #ffffff;

        border: 1px solid #777;
        border-radius: 15px;

        box-sizing: border-box;

        overflow: hidden;
    }


    .login-input-icon {
        width: 65px;
        min-width: 65px;

        display: flex;
        justify-content: center;
        align-items: center;

        font-size: 25px;

        color: #d75b8f;

        pointer-events: none;
    }


    .login-input {
        flex: 1;

        width: 100%;
        height: 100%;

        border: none !important;
        outline: none !important;

        background: transparent !important;

        padding: 0 15px;

        font-size: 19px;

        color: #26333f;

        box-shadow: none !important;

        pointer-events: auto !important;
    }


    .login-input:focus {
        outline: none !important;
        box-shadow: none !important;
    }


    .login-input-box:focus-within {
        border: 2px solid #d75b8f;
    }


    /* =========================
       INGAT SAYA
    ========================= */

    .remember-group {
        display: flex;
        align-items: center;

        gap: 12px;

        margin-top: 3px;
        margin-bottom: 18px;
    }


    .remember-group input {
        width: 22px;
        height: 22px;

        margin: 0;

        cursor: pointer;

        accent-color: #d75b8f;
    }


    .remember-group label {
        margin: 0;

        font-size: 18px;

        color: #59616b;

        cursor: pointer;
    }


    /* =========================
       BUTTON LOGIN
    ========================= */

    .btn-login {
        width: 100%;
        height: 55px;

        border: none;

        border-radius: 17px;

        background: #dc76a0;

        color: #ffffff;

        font-size: 23px;
        font-weight: bold;

        cursor: pointer;

        transition: 0.3s;
    }


    .btn-login:hover {
        background: #c44b7d;

        color: #ffffff;
    }


    /* =========================
       ERROR
    ========================= */

    .invalid-feedback {
        margin-top: 5px;

        font-size: 14px;
    }


    /* =========================
       TABLET
    ========================= */

    @media (max-width: 768px) {

        .login-page {
            padding: 25px 15px;
        }

        .brand-title {
            font-size: 25px;
        }

        .brand-icon {
            font-size: 52px;
        }

        .login-card {
            max-width: 580px;

            padding: 25px 40px;

            border-radius: 30px;
        }

        .login-title {
            font-size: 28px;
        }

    }


    /* =========================
       HP
    ========================= */

    @media (max-width: 500px) {

        .login-page {
            padding: 20px 12px;
        }

        .brand {
            gap: 10px;

            margin-bottom: 20px;
        }

        .brand-title {
            font-size: 18px;
        }

        .brand-icon {
            font-size: 38px;
        }

        .login-card {
            padding: 25px 20px;

            border-radius: 25px;
        }

        .login-header {
            gap: 15px;
        }

        .login-user-icon {
            width: 65px;
            height: 65px;

            font-size: 28px;
        }

        .login-title {
            font-size: 23px;
        }

        .login-form-group label {
            font-size: 18px;
        }

        .login-input {
            font-size: 16px;
        }

    }

</style>


<div class="login-page">


    <!-- JUDUL WEBSITE -->

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


    <!-- CARD LOGIN -->

    <div class="login-card">


        <!-- HEADER LOGIN -->

        <div class="login-header">

            <div class="login-user-icon">
                <i class="fas fa-user"></i>
            </div>

            <h1 class="login-title">
                Login Admin
            </h1>

        </div>


        <!-- FORM LOGIN -->

        <form method="POST" action="{{ route('login.process') }}">

            @csrf


            <!-- EMAIL -->

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


            <!-- PASSWORD -->

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

                </div>

                @error('password')

                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- INGAT SAYA -->

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


            <!-- BUTTON LOGIN -->

            <button type="submit" class="btn-login">
                Login
            </button>

        </form>

    </div>

</div>

@endsection