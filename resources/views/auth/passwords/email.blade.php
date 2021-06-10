@extends('layouts.success')

@section('title', 'Reset Password')

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
        <h2>Reset Password</h2>
        <p>Silahkan Reset Password Anda Dengan Terlebih Dahulu Memasukkan Email Yang Telah Terdaftar Sebelumnya dan Kami Akan Segera Mengirimkan Link Reset Password</p>
        <div class="mt-5">
            <form method="POST" action="{{ route('password.email') }}">
            @csrf
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Alamat Email" value="{{ old('email') }}" autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <button
                    type="submit"
                    class="btn btn-primary w-50 mt-4"
                >
                    Kirim Link Reset Password
                </button>
                <div class="text-center">
                    @auth
                        <a class="btn btn-link" href="{{ route('account.index') }}">
                            Batalkan
                        </a>
                    @endauth
                    @guest
                        <a class="btn btn-link" href="{{ route('login') }}">
                            Batalkan
                        </a>
                    @endguest
                </div>
            </form>
        </div>
    </div>
</div>

@endsection