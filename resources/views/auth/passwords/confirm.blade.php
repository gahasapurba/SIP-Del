@extends('layouts.success')

@section('title', 'Konfirmasi Password')

@section('content')

@php
    use RealRashid\SweetAlert\Facades\Alert;
    if($errors->any())
    {
        alert()->error('Kesalahan Pengisian Data','Silahkan Ulangi Mengisi Data');
    }
@endphp

<div
    class="row align-items-center row-login justify-content-center"
>
    <div class="col-lg-6 text-center">
        <img
            src="/images/logo2.png"
            alt="Success"
            class="mb-4 w-75"
        />
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h2>Konfirmasi Password</h2>
        <p>Silahkan Masukkan Kembali Password Anda Untuk Mengkonfirmasi Bahwa Ini Memang Akun Anda</p>
        <div class="mt-5">
            <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password Anda" autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <button
                    type="submit"
                    class="btn btn-primary w-50 mt-4"
                >
                    Konfirmasi Password
                </button>
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
</div>

@endsection