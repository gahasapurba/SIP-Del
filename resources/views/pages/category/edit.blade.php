@extends('layouts.app')

@section('title', 'Edit Data Kategori')

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
            <h2 class="dashboard-title">Edit Kategori</h2>
            <p class="dashboard-subtitle">
                Silahkan Edit Data Kategori
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('category.update', $hash->encodeHex($item->id)) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nama Kategori</label>
                                            <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Masukkan nama kategori" value="{{ $item->name }}" autofocus>
                                            @if($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('name') as $error)
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
                                            Simpan
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