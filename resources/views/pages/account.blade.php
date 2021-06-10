@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')

@php
    use RealRashid\SweetAlert\Facades\Alert;
    if($errors->any())
    {
        alert()->error('Kesalahan Pengisian Data','Silahkan Ulangi Mengisi Data');
    }
@endphp

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Akun Saya</h2>
            <p class="dashboard-subtitle">
                Silahkan Edit Profil Akun Anda
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('account.update', $hash->encodeHex($user->id)) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group"
                                        >
                                            <label
                                                for="name"
                                                >Nama
                                                Anda</label
                                            >
                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="form-control @if($errors->has('name')) is-invalid @endif"
                                                placeholder="Masukkan nama anda"
                                                value="{{ $user->name }}"
                                                autofocus
                                            />
                                            @if($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('name') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group"
                                        >
                                            <label
                                                for="phone_number"
                                                >No. HP
                                                (WhatsApp)</label
                                            >
                                            <input
                                                type="text"
                                                name="phone_number"
                                                id="phone_number"
                                                class="form-control @if($errors->has('phone_number')) is-invalid @endif"
                                                placeholder="Masukkan No HP (WhatsApp) anda"
                                                value="{{ $user->phone_number }}"
                                            />
                                            <small>Contoh : +62 811 1234 5678</small>
                                            @if($errors->has('phone_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('phone_number') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group"
                                        >
                                            <label
                                                for="avatar"
                                                >Upload Foto
                                                Profil</label
                                            >
                                            <input
                                                type="file"
                                                name="avatar"
                                                id="avatar"
                                                class="form-control @if($errors->has('avatar')) is-invalid @endif"
                                                value="{{ $user->avatar }}"
                                                onchange="loadFile(event)"
                                                accept="image/*"
                                            />
                                            <small>Silahkan upload foto baru untuk mengganti foto profil yang sudah ada sebelumnya. Direkomendasikan untuk mengupload foto yang berdimensi 1 X 1</small>
                                            @if($errors->has('avatar'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('avatar') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="output"
                                                >Foto Profil</label
                                            ><br>
                                            <img name="output" id="output" alt="Profile Photo" class="rounded-circle profile-picture" width="70" src="{{ Storage::url($user->avatar) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div
                                        class="col text-right"
                                    >
                                        <button
                                            type="submit"
                                            class="btn btn-primary px-5 mb-2"
                                        >
                                            Simpan
                                        </button>
                                        <br>
                                        <a
                                            href="{{ route('password.request') }}"
                                            class="btn btn-warning px-5"
                                        >
                                            Ubah/Reset Password
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

@endpush