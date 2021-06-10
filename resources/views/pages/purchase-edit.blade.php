@extends('layouts.app')

@section('title', 'Edit Data Pembelian')

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
            <h2 class="dashboard-title">Edit Pembelian</h2>
            <p class="dashboard-subtitle">
                Silahkan Edit Data Pembelian
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('manajemenpembayaran.update', $hash->encodeHex($item->id)) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Judul Pembelian</label>
                                            <input type="text" name="title" class="form-control @if($errors->has('title')) is-invalid @endif" placeholder="Masukkan judul pembelian" value="{{ $item->title }}" autofocus>
                                            @if($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('title') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categories_id">Kategori Pembelian</label>
                                            <select name="categories_id" class="form-control @if($errors->has('categories_id')) is-invalid @endif">
                                                <option value="">Pilih Kategori Pembelian</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $hash->encodeHex($category->id) }}" @if($hash->encodeHex($item->categories_id) == $hash->encodeHex($category->id)) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('categories_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('categories_id') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company_name">Nama Perusahaan</label>
                                            <input type="text" name="company_name" class="form-control @if($errors->has('company_name')) is-invalid @endif" placeholder="Masukkan nama perusahaan" value="{{ $item->company_name }}" autofocus>
                                            @if($errors->has('company_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('company_name') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi Pembelian</label>
                                            <textarea name="description" id="editor" class="@if($errors->has('description')) is-invalid @endif" placeholder="Masukkan deskripsi pembelian">{{ $item->description }}</textarea>
                                            @if($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('description') as $error)
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

@push('addon-script')

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'editor' );
    </script>

@endpush