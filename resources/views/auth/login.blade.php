@extends('layouts.auth')

@section('title', 'Login - Kunjungan Perpustakaan')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="p-5">

                                <div class="text-center mb-4">
                                    <h2>Kunjungan 📖 Perpustakaan</h2>
                                    <h4>Login Admin</h4>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ url('/login') }}" class="user">
                                    @csrf

                                    <div class="form-group">
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}"
                                            placeholder="Masukkan Email"
                                            required
                                            autofocus
                                        >

                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            placeholder="Masukkan Password"
                                            required
                                        >

                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input
                                                type="checkbox"
                                                name="remember"
                                                id="remember"
                                                class="custom-control-input"
                                                {{ old('remember') ? 'checked' : '' }}
                                            >

                                            <label class="custom-control-label" for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <span class="fa fa-sign-in-alt mr-1"></span>
                                        Login
                                    </button>

                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection