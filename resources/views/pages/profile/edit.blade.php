@extends('layouts.app')

@section('title', 'Ubah Profile')

@section('content')

<style>

    /* =========================================
       BACKGROUND
    ========================================= */

    body,
    #content-wrapper {
        background: #f5f6fa !important;
    }


    /* =========================================
       HALAMAN
    ========================================= */

    .profile-page {
        padding: 35px 45px;
        max-width: 900px;
    }


    /* =========================================
       HEADER PROFILE
    ========================================= */

    .profile-header {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 40px;
    }


    .profile-header-icon {
        width: 72px;
        height: 72px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #111111;
        color: #ffffff;

        font-size: 32px;
    }


    .profile-title {
        margin: 0;

        font-size: 29px;
        font-weight: 700;

        color: #222222;
    }


    /* =========================================
       FORM
    ========================================= */

    .profile-form {
        width: 100%;
        max-width: 650px;
    }


    .profile-row {
        display: grid;

        grid-template-columns:
            230px
            20px
            1fr;

        align-items: center;

        gap: 12px;

        margin-bottom: 16px;
    }


    .profile-label {
        font-size: 18px;
        font-weight: 700;

        color: #333333;
    }


    .profile-separator {
        font-size: 18px;
        font-weight: 700;

        text-align: center;

        color: #333333;
    }


    /* =========================================
       INPUT
    ========================================= */

    .profile-input {
        width: 100%;

        height: 38px;

        padding: 7px 12px;

        border: 1px solid #9da3aa;

        border-radius: 5px;

        outline: none;

        font-size: 15px;

        background: #ffffff;
        color: #333333;

        transition: 0.2s ease;

        box-sizing: border-box;
    }


    .profile-input:focus {
        border-color: #c56f95;

        box-shadow:
            0 0 0 2px
            rgba(
                197,
                111,
                149,
                0.15
            );
    }


    /* =========================================
       PASSWORD INPUT
    ========================================= */

    .password-wrapper {
        position: relative;
        width: 100%;
    }


    .password-wrapper .profile-input {
        padding-right: 42px;
    }


    .password-toggle {
        position: absolute;

        top: 50%;
        right: 12px;

        transform: translateY(-50%);

        border: none;

        background: transparent;

        color: #777777;

        font-size: 16px;

        cursor: pointer;

        padding: 0;

        display: flex;
        align-items: center;
        justify-content: center;
    }


    .password-toggle:hover {
        color: #c56f95;
    }


    /* =========================================
       ERROR
    ========================================= */

    .profile-error {
        grid-column: 3;

        margin-top: -10px;
        margin-bottom: 5px;

        font-size: 13px;

        color: #dc3545;
    }


    /* =========================================
       BUTTON
    ========================================= */

    .profile-button-area {
        margin-top: 30px;

        padding-left: 250px;
    }


    .btn-profile-save {
        min-width: 240px;

        height: 40px;

        border: 1px solid #888888;

        border-radius: 5px;

        background: #ffffff;

        color: #333333;

        font-size: 16px;

        font-weight: 700;

        cursor: pointer;

        transition: 0.2s ease;
    }


    .btn-profile-save:hover {
        background: #d18eae;

        color: #ffffff;

        border-color: #d18eae;
    }


    .btn-profile-save i {
        margin-right: 8px;
    }


    /* =========================================
       ALERT
    ========================================= */

    .profile-success {
        max-width: 650px;

        padding: 12px 15px;

        margin-bottom: 25px;

        border-radius: 5px;

        background: #d4edda;

        border: 1px solid #c3e6cb;

        color: #155724;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 768px) {

        .profile-page {
            padding: 25px;
        }


        .profile-row {
            grid-template-columns: 1fr;

            gap: 7px;
        }


        .profile-separator {
            display: none;
        }


        .profile-error {
            grid-column: auto;
        }


        .profile-button-area {
            padding-left: 0;
        }


        .btn-profile-save {
            width: 100%;
        }

    }

</style>


<div class="profile-page">


    <!-- =====================================
         HEADER
    ====================================== -->

    <div class="profile-header">

        <div class="profile-header-icon">

            <i class="fas fa-user"></i>

        </div>


        <h1 class="profile-title">

            Ubah Profile

        </h1>

    </div>



    <!-- =====================================
         SUCCESS MESSAGE
    ====================================== -->

    @if(session('success'))

        <div class="profile-success">

            <i class="fas fa-check-circle mr-2"></i>

            {{ session('success') }}

        </div>

    @endif



    <!-- =====================================
         FORM
    ====================================== -->

    <form
        action="{{ route('admin.profile.update') }}"
        method="POST"
        class="profile-form"
    >

        @csrf

        @method('PUT')


        <!-- =================================
             NAMA
        ================================== -->

        <div class="profile-row">

            <label
                for="name"
                class="profile-label"
            >

                Nama

            </label>


            <div class="profile-separator">

                :

            </div>


            <input
                type="text"
                name="name"
                id="name"
                class="profile-input"

                value="{{ old('name', $user->name) }}"
            >

        </div>


        @error('name')

            <div class="profile-error">

                {{ $message }}

            </div>

        @enderror



        <!-- =================================
             EMAIL
        ================================== -->

        <div class="profile-row">

            <label
                for="email"
                class="profile-label"
            >

                Email

            </label>


            <div class="profile-separator">

                :

            </div>


            <input
                type="email"
                name="email"
                id="email"
                class="profile-input"

                value="{{ old('email', $user->email) }}"
            >

        </div>


        @error('email')

            <div class="profile-error">

                {{ $message }}

            </div>

        @enderror



        <!-- =================================
             PASSWORD BARU
        ================================== -->

        <div class="profile-row">

            <label
                for="password"
                class="profile-label"
            >

                Password Baru

            </label>


            <div class="profile-separator">

                :

            </div>


            <div class="password-wrapper">

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="profile-input"

                    placeholder="Kosongkan jika tidak ingin mengganti password"
                >


                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword('password', 'eyePassword')"
                    aria-label="Tampilkan password"
                >

                    <i
                        class="fas fa-eye"
                        id="eyePassword"
                    ></i>

                </button>

            </div>

        </div>


        @error('password')

            <div class="profile-error">

                {{ $message }}

            </div>

        @enderror



        <!-- =================================
             KONFIRMASI PASSWORD
        ================================== -->

        <div class="profile-row">

            <label
                for="password_confirmation"
                class="profile-label"
            >

                Konfirmasi Password

            </label>


            <div class="profile-separator">

                :

            </div>


            <div class="password-wrapper">

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="profile-input"
                >


                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword('password_confirmation', 'eyePasswordConfirmation')"
                    aria-label="Tampilkan konfirmasi password"
                >

                    <i
                        class="fas fa-eye"
                        id="eyePasswordConfirmation"
                    ></i>

                </button>

            </div>

        </div>



        <!-- =================================
             BUTTON
        ================================== -->

        <div class="profile-button-area">

            <button
                type="submit"
                class="btn-profile-save"
            >

                <i class="far fa-save"></i>

                Simpan Perubahan

            </button>

        </div>


    </form>


</div>


<script>

    function togglePassword(inputId, iconId) {

        const input = document.getElementById(inputId);

        const icon = document.getElementById(iconId);


        if (input.type === "password") {

            input.type = "text";

            icon.classList.remove("fa-eye");

            icon.classList.add("fa-eye-slash");

        } else {

            input.type = "password";

            icon.classList.remove("fa-eye-slash");

            icon.classList.add("fa-eye");

        }

    }

</script>


@endsection