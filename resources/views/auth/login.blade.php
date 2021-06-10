@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')

@php
    use RealRashid\SweetAlert\Facades\Alert;
    if($errors->any())
    {
        alert()->error('Kesalahan Pengisian Data','Silahkan Ulangi Mengisi Data');
    }
@endphp

<div class="row align-items-center row-login">
    <div class="col-lg-6 text-center">
        <img
            src="/images/logo2.png"
            alt="Login Placeholder"
            class="mb-4 mb-lg-none w-75"
        />
    </div>
    <div class="col-lg-5">
        <h2>
            Pengelolaan pembelian, <br />
            menjadi lebih mudah
        </h2>
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="text"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email anda"
                    autofocus
                />

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="Masukkan password anda"
                    data-toggle="password"
                />

                @error('password')
                    <small class="text-danger"><b>{{ $message }}</b></small>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input
                        id="remember"
                        type="checkbox"
                        class="form-check-input"
                        name="remember"
                        {{ old('remember') ? 'checked' : '' }}
                    />
                    <label for="remember">Ingat Saya</label>
                </div>
            </div>
            <button
                type="submit"
                class="btn btn-primary btn-block mt-4"
            >
                Masuk
            </button>
            <a
                href="{{ route('register') }}"
                class="btn btn-signup btn-block mt-2"
            >
                Belum punya akun? Silahkan mendaftar
            </a>
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Lupa Password? Reset Password Anda Disini
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

@endsection