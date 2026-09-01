<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kunjungan Perpustakaan</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        /* ==================================================
           RESET
        ================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* ==================================================
           BODY
        ================================================== */

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;

            background-color: #caa9b7;

            display: flex;
            justify-content: center;
            align-items: center;
        }


        /* ==================================================
           CONTAINER
        ================================================== */

        .kunjungan-container {
            width: 100%;
            min-height: 100vh;

            background: #caa9b7;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 35px;
        }


        /* ==================================================
           JUDUL
        ================================================== */

        .title {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 28px;

            margin-bottom: 20px;
        }


        .title h1 {
            font-size: 30px;
            font-weight: bold;

            letter-spacing: 1px;

            color: #202124;
        }


        .title i {
            font-size: 60px;

            color: #1d344b;
        }


        /* ==================================================
           FORM BOX
        ================================================== */

        .form-box {
            width: 560px;

            background: #e5e1d4;

            padding: 22px 65px;

            border-radius: 20px;
        }


        /* ==================================================
           FORM GROUP
        ================================================== */

        .form-group {
            margin-bottom: 10px;
        }


        .form-group label {
            display: block;

            font-size: 20px;
            font-weight: bold;

            color: #25272b;

            margin-bottom: 5px;
        }


        /* ==================================================
           INPUT WRAPPER
        ================================================== */

        .input-wrapper {
            position: relative;

            width: 100%;
        }


        .input-wrapper i {
            position: absolute;

            left: 16px;
            top: 50%;

            transform: translateY(-50%);

            color: #d28ca8;

            font-size: 20px;

            z-index: 2;
        }


        /* ==================================================
           INPUT
        ================================================== */

        .form-group input {
            width: 100%;
            height: 42px;

            border: 1.5px solid #333;
            border-radius: 12px;

            background: #e4e2d8;

            padding-left: 52px;
            padding-right: 15px;

            font-size: 14px;
            font-weight: bold;

            color: #25272b;

            outline: none;

            -webkit-appearance: none;
            appearance: none;
        }


        .form-group input::placeholder {
            color: #858990;

            opacity: 1;
        }


        /* ==================================================
           AUTOFILL
        ================================================== */

        .form-group input:-webkit-autofill,
        .form-group input:-webkit-autofill:hover,
        .form-group input:-webkit-autofill:focus,
        .form-group input:-webkit-autofill:active {

            -webkit-box-shadow:
                0 0 0 1000px #e4e2d8 inset !important;

            -webkit-text-fill-color: #25272b !important;

            caret-color: #25272b;

            transition: background-color 9999s ease-out 0s;
        }


        .form-group input:focus {
            border-color: #c7839e;

            background: #e4e2d8;
        }


        /* ==================================================
           SELECT KELAS / JABATAN
        ================================================== */

        .form-group select {
            width: 100%;
            height: 42px;

            border: 1.5px solid #333;
            border-radius: 12px;

            background: #e4e2d8;

            padding-left: 52px;
            padding-right: 35px;

            font-size: 14px;
            font-weight: bold;

            color: #25272b;

            outline: none;

            cursor: pointer;

            appearance: auto;
        }


        .form-group select:focus {
            border-color: #c7839e;

            background: #e4e2d8;
        }


        .form-group select option {
            background: #e4e2d8;

            color: #25272b;

            font-weight: bold;
        }


        /* ==================================================
           TOMBOL SUBMIT
        ================================================== */

        .btn-submit {
            width: 100%;
            height: 48px;

            border: none;

            border-radius: 15px;

            background: #bd7894;

            color: #202124;

            font-size: 24px;
            font-weight: bold;

            letter-spacing: 1px;

            cursor: pointer;

            margin-top: 12px;

            transition: 0.2s;
        }


        .btn-submit:hover {
            background: #aa6682;

            transform: scale(1.01);
        }


        /* ==================================================
           NOTIFIKASI
        ================================================== */

        .success-message,
        .error-message {
            width: 100%;

            padding: 14px 18px;

            border-radius: 18px;

            font-weight: 500;
            font-size: 14px;

            margin-bottom: 22px;

            background: #f8f4f6;

            border-left: 6px solid transparent;
        }


        /* ==================================================
           NOTIFIKASI BERHASIL
        ================================================== */

        .success-message {
            color: #1f5c3a;

            border-left-color: #2b7a4b;

            background: #edf7f1;
        }


        /* ==================================================
           NOTIFIKASI ERROR
        ================================================== */

        .error-message {
            color: #7a2e3a;

            border-left-color: #b34a5a;

            background: #fdf0f2;
        }


        .error-message ul {
            padding-left: 20px;

            margin-top: 4px;
        }


        /* ==================================================
           RESPONSIVE
        ================================================== */

        @media (max-width: 600px) {

            .kunjungan-container {
                padding: 20px 15px;
            }


            .title {
                gap: 12px;

                margin-bottom: 20px;
            }


            .title h1 {
                font-size: 20px;
            }


            .title i {
                font-size: 40px;
            }


            .form-box {
                width: 100%;

                padding: 20px;

                border-radius: 18px;
            }


            .success-message,
            .error-message {
                width: 100%;
            }

        }

    </style>

</head>


<body>

    <div class="kunjungan-container">


        {{-- ==================================================
             JUDUL
        ================================================== --}}

        <div class="title">

            <h1>
                Kunjungan
            </h1>


            <i class="fa-solid fa-book-open"></i>


            <h1>
                Perpustakaan
            </h1>

        </div>


        {{-- ==================================================
             FORM BOX
        ================================================== --}}

        <div class="form-box">


            {{-- ==================================================
                 PESAN BERHASIL
            ================================================== --}}

            @if (session('success'))

                <div class="success-message">

                    <i class="fas fa-check-circle"
                       style="margin-right: 10px;"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- ==================================================
                 PESAN ERROR
            ================================================== --}}

            @if ($errors->any())

                <div class="error-message">

                    <strong>

                        <i class="fas fa-exclamation-triangle"
                           style="margin-right: 8px;"></i>

                        Data belum lengkap.

                    </strong>


                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ==================================================
                 FORM
            ================================================== --}}

            <form action="{{ route('kunjungan.store') }}" method="POST">

                @csrf


                {{-- ==================================================
                     NISN / NIP
                ================================================== --}}

                <div class="form-group">

                    <label>
                        NISN/NIP
                    </label>


                    <div class="input-wrapper">

                        <i class="fa-regular fa-id-card"></i>


                        <input
                            type="text"
                            name="nisn_nip"
                            value="{{ old('nisn_nip') }}"
                            placeholder="Masukan NIP/NISN"
                            autocomplete="off"
                            required>

                    </div>

                </div>


                {{-- ==================================================
                     NAMA LENGKAP
                ================================================== --}}

                <div class="form-group">

                    <label>
                        Nama Lengkap
                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-user"></i>


                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukan Nama Lengkap"
                            autocomplete="off"
                            required>

                    </div>

                </div>


                {{-- ==================================================
                     KELAS / JABATAN
                ================================================== --}}

                <div class="form-group">

                    <label>
                        Kelas/Jabatan
                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-school"></i>


                        <select
                            id="kelas_jabatan"
                            name="kelas_jabatan"
                            required>

                            <option value="">
                                Pilih Kelas/Jabatan
                            </option>


                            {{-- ==============================
                                 KELAS X
                            ============================== --}}

                            <option value="X PPLG 1"
                                {{ old('kelas_jabatan') == 'X PPLG 1' ? 'selected' : '' }}>
                                X PPLG 1
                            </option>

                            <option value="X PPLG 2"
                                {{ old('kelas_jabatan') == 'X PPLG 2' ? 'selected' : '' }}>
                                X PPLG 2
                            </option>

                            <option value="X PPLG 3"
                                {{ old('kelas_jabatan') == 'X PPLG 3' ? 'selected' : '' }}>
                                X PPLG 3
                            </option>


                            <option value="X PM 1"
                                {{ old('kelas_jabatan') == 'X PM 1' ? 'selected' : '' }}>
                                X PM 1
                            </option>

                            <option value="X PM 2"
                                {{ old('kelas_jabatan') == 'X PM 2' ? 'selected' : '' }}>
                                X PM 2
                            </option>

                            <option value="X PM 3"
                                {{ old('kelas_jabatan') == 'X PM 3' ? 'selected' : '' }}>
                                X PM 3
                            </option>


                            <option value="X TF 1"
                                {{ old('kelas_jabatan') == 'X TF 1' ? 'selected' : '' }}>
                                X TF 1
                            </option>

                            <option value="X TF 2"
                                {{ old('kelas_jabatan') == 'X TF 2' ? 'selected' : '' }}>
                                X TF 2
                            </option>


                            <option value="X TO 1"
                                {{ old('kelas_jabatan') == 'X TO 1' ? 'selected' : '' }}>
                                X TO 1
                            </option>

                            <option value="X TO 2"
                                {{ old('kelas_jabatan') == 'X TO 2' ? 'selected' : '' }}>
                                X TO 2
                            </option>

                            <option value="X TO 3"
                                {{ old('kelas_jabatan') == 'X TO 3' ? 'selected' : '' }}>
                                X TO 3
                            </option>

                            <option value="X TO 4"
                                {{ old('kelas_jabatan') == 'X TO 4' ? 'selected' : '' }}>
                                X TO 4
                            </option>


                            {{-- ==============================
                                 KELAS XI
                            ============================== --}}

                            <option value="XI RPL 1"
                                {{ old('kelas_jabatan') == 'XI RPL 1' ? 'selected' : '' }}>
                                XI RPL 1
                            </option>

                            <option value="XI RPL 2"
                                {{ old('kelas_jabatan') == 'XI RPL 2' ? 'selected' : '' }}>
                                XI RPL 2
                            </option>

                            <option value="XI RPL 3"
                                {{ old('kelas_jabatan') == 'XI RPL 3' ? 'selected' : '' }}>
                                XI RPL 3
                            </option>

                            <option value="XI LPK 3"
                                {{ old('kelas_jabatan') == 'XI LPK 3' ? 'selected' : '' }}>
                                XI LPK 3
                            </option>

                            <option value="XI BD 1"
                                {{ old('kelas_jabatan') == 'XI BD 1' ? 'selected' : '' }}>
                                XI BD 1
                            </option>

                            <option value="XI BD 2"
                                {{ old('kelas_jabatan') == 'XI BD 2' ? 'selected' : '' }}>
                                XI BD 2
                            </option>

                            <option value="XI BR"
                                {{ old('kelas_jabatan') == 'XI BR' ? 'selected' : '' }}>
                                XI BR
                            </option>

                            <option value="XI TSM 1"
                                {{ old('kelas_jabatan') == 'XI TSM 1' ? 'selected' : '' }}>
                                XI TSM 1
                            </option>

                            <option value="XI TSM 2"
                                {{ old('kelas_jabatan') == 'XI TSM 2' ? 'selected' : '' }}>
                                XI TSM 2
                            </option>

                            <option value="XI TSM 3"
                                {{ old('kelas_jabatan') == 'XI TSM 3' ? 'selected' : '' }}>
                                XI TSM 3
                            </option>

                            <option value="XI TSM 4"
                                {{ old('kelas_jabatan') == 'XI TSM 4' ? 'selected' : '' }}>
                                XI TSM 4
                            </option>


                            {{-- ==============================
                                 KELAS XII
                            ============================== --}}

                            <option value="XII RPL 1"
                                {{ old('kelas_jabatan') == 'XII RPL 1' ? 'selected' : '' }}>
                                XII RPL 1
                            </option>

                            <option value="XII RPL 2"
                                {{ old('kelas_jabatan') == 'XII RPL 2' ? 'selected' : '' }}>
                                XII RPL 2
                            </option>

                            <option value="XII RPL 3"
                                {{ old('kelas_jabatan') == 'XII RPL 3' ? 'selected' : '' }}>
                                XII RPL 3
                            </option>

                            <option value="XII BD 1"
                                {{ old('kelas_jabatan') == 'XII BD 1' ? 'selected' : '' }}>
                                XII BD 1
                            </option>

                            <option value="XII BD 2"
                                {{ old('kelas_jabatan') == 'XII BD 2' ? 'selected' : '' }}>
                                XII BD 2
                            </option>

                            <option value="XII BR"
                                {{ old('kelas_jabatan') == 'XII BR' ? 'selected' : '' }}>
                                XII BR
                            </option>

                            <option value="XII TSM 1"
                                {{ old('kelas_jabatan') == 'XII TSM 1' ? 'selected' : '' }}>
                                XII TSM 1
                            </option>

                            <option value="XII TSM 2"
                                {{ old('kelas_jabatan') == 'XII TSM 2' ? 'selected' : '' }}>
                                XII TSM 2
                            </option>

                            <option value="XII TSM 3"
                                {{ old('kelas_jabatan') == 'XII TSM 3' ? 'selected' : '' }}>
                                XII TSM 3
                            </option>

                            <option value="XII TSM 4"
                                {{ old('kelas_jabatan') == 'XII TSM 4' ? 'selected' : '' }}>
                                XII TSM 4
                            </option>

                            <option value="XII LPK 3"
                                {{ old('kelas_jabatan') == 'XII LPK 3' ? 'selected' : '' }}>
                                XII LPK 3
                            </option>


                            {{-- ==============================
                                 GURU DAN KARYAWAN
                            ============================== --}}

                            <option value="Guru & Karyawan"
                                {{ old('kelas_jabatan') == 'Guru & Karyawan' ? 'selected' : '' }}>
                                Guru & Karyawan
                            </option>

                        </select>

                    </div>

                </div>


                {{-- ==================================================
                     TANGGAL KUNJUNGAN
                ================================================== --}}

                <div class="form-group">

                    <label>
                        Tanggal Kunjungan
                    </label>


                    <div class="input-wrapper">

                        <i class="fa-regular fa-calendar"></i>


                        <input
                            type="date"
                            name="tanggal_kunjungan"
                            value="{{ old('tanggal_kunjungan') }}"
                            required>

                    </div>

                </div>


                {{-- ==================================================
                     KEPERLUAN
                ================================================== --}}

                <div class="form-group">

                    <label>
                        Keperluan
                    </label>


                    <div class="input-wrapper">

                        <i class="fa-regular fa-clipboard"></i>


                        <input
                            type="text"
                            name="keperluan"
                            value="{{ old('keperluan') }}"
                            placeholder="Masukan Keperluan Kunjungan"
                            autocomplete="off"
                            required>

                    </div>

                </div>


                {{-- ==================================================
                     TOMBOL SUBMIT
                ================================================== --}}

                <button
                    type="submit"
                    class="btn-submit">

                    Submit

                </button>


            </form>

        </div>

    </div>

</body>

</html>