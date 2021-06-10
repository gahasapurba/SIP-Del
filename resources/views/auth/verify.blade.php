@extends('layouts.success')

@section('title', 'Verifikasi Email')

@section('content')

<div
    class="row align-items-center row-login justify-content-center"
>
    <div class="col-lg-6 text-center">
        <img
            src="/images/logo2.png"
            alt="Success"
            class="mb-4 w-75"
        />
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('Email Yang Berisi Link Verifikasi Sudah Dikirim Kembali') }}
            </div>
        @endif
        <h2>Verifikasi Email</h2>
        <p>Silahkan Cek Email Anda dan Klik Link Verifikasi Yang Telah Kami Kirim, Untuk Memverifikasi Email Anda. Apabila Anda Masih Belum Menerimanya, Silahkan Klik Tombol Dibawah Untuk Mengirim Ulang</p>
        <div>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
                <button
                    type="submit"
                    class="btn btn-primary w-50 mt-4"
                >
                    Kirim Ulang Email
                </button>
            </form>
        </div>
    </div>
</div>

@endsection