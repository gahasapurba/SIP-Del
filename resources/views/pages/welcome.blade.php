@extends('layouts.success')

@section('title', 'Pendaftaran Berhasil')

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
        <h2>Selamat Datang di SIP Del!</h2>
        <p>Terimakasih telah menjadi bagian dari SIP Del</p>
        <div>
            <a
                href="{{ route('home') }}"
                class="btn btn-primary w-50 mt-4"
                >Dashboard</a
            >
        </div>
    </div>
</div>

@endsection