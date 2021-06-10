@extends('layouts.app')

@section('title', 'Edit Data Item Pembelian')

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
            <h2 class="dashboard-title">Edit Item Pembelian</h2>
            <p class="dashboard-subtitle">
                Silahkan Edit Data Item Pembelian
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pembayaran.updateitem', $hash->encodeHex($item->id)) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nama Item</label>
                                            <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Masukkan nama item" value="{{ $item->name }}" autofocus>
                                            @if($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('name') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="quantity">Jumlah Item (Unit)</label>
                                            <input type="number" name="quantity" class="form-control @if($errors->has('quantity')) is-invalid @endif" placeholder="Masukkan jumlah item" value="{{ $item->quantity }}" autofocus>
                                            @if($errors->has('quantity'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('quantity') as $error)
                                                        <strong>{{ $error }}</strong>
                                                    @endforeach
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="price_per_item">Harga Per Satuan (Rp)</label>
                                            <input type="number" name="price_per_item" class="form-control @if($errors->has('price_per_item')) is-invalid @endif" placeholder="Masukkan harga per satuan item" value="{{ $item->price_per_item }}" autofocus>
                                            @if($errors->has('price_per_item'))
                                                <span class="invalid-feedback" role="alert">
                                                    @foreach ($errors->get('price_per_item') as $error)
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