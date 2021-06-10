@extends('layouts.success')

@section('title', 'Ubah Password')

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
        <h2>Ubah Password</h2>
        <p>Silahkan Ubah Password Anda Dengan Mengisi Email dan Password Yang Baru Pada Form Dibawah</p>
        <div class="mt-5">
            <form method="POST" action="{{ route('password.update') }}">
            @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Alamat Email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <br>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password Anda Yang Baru" autocomplete="new-password" data-toggle="password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <br>

                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Ulangi Password Anda Yang Baru" autocomplete="new-password" data-toggle="password">
                
                <button
                    type="submit"
                    class="btn btn-primary w-50 mt-4"
                >
                    Ubah Password
                </button>
                <div class="text-center">
                    <a class="btn btn-link" href="{{ route('login') }}">
                        Batalkan
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection