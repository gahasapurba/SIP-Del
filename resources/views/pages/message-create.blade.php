@extends('layouts.app')

@section('title', 'Kirim Pesan')

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
            <h2 class="dashboard-title">Kirim Pesan</h2>
            <p class="dashboard-subtitle">
                Silahkan Kirim Pesan Baru
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pesan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="receiver_users_id">Penerima</label>
                                            <select name="receiver_users_id" class="form-control @if($errors->has('receiver_users_id')) is-invalid @endif" autofocus>
                                                <option value="">Pilih Penerima Pesan</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $hash->encodeHex($user->id) }}" @if(old('receiver_users_id') == $hash->encodeHex($user->id)) selected @endif>{{ $user->name }} ({{ $user->roles }}/{{ $user->email }})</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('receiver_users_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('receiver_users_id') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="content">Isi Pesan</label>
                                            <textarea name="content" id="editor" class="@if($errors->has('content')) is-invalid @endif" placeholder="Masukkan isi pesan">{{ old('content') }}</textarea>
                                            @if($errors->has('content'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('content') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <input type="file" name="file" class="form-control @if($errors->has('file')) is-invalid @endif" placeholder="Masukkan file jika perlu" value="{{ old('file') }}">
                                            <small>Silahkan upload file jika perlu</small>
                                            @if($errors->has('file'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('file') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary px-5">
                                            Kirim
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'editor' );
    </script>

@endpush