@extends('layouts.app')

@section('title', 'Isi Pesan Masuk')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Isi Pesan Masuk
            </h2>
            <p class="dashboard-subtitle">
                Detail Isi Pesan Masuk
            </p>
        </div>
        <div
            class="dashboard-content"
            id="informationDetails"
        >
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div
                                    class="col-12 col-md-8"
                                >
                                    <div class="row">
                                        <div
                                            class="col-12 col-md-12"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Pengirim
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                {{ $item->sender->name }} ({{ $item->sender->roles }} / {{ $item->sender->email }})
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Isi Pesan
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                {!! $item->content !!}
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                File Pesan
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                @empty($item->file)
                                                    Tidak ada file yang dikirim bersamaan dengan pesan ini
                                                @else
                                                    <a href="{{ Storage::url($item->file) }}" target="blank">Download File Pesan</a>
                                                @endempty
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Dikirim Pada
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                {{ $item->created_at->isoFormat('dddd, D MMMM Y, HH:mm:ss') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div
                                    class="col-12 text-right"
                                >
                                    <a
                                        href="{{ route('pesan.index') }}"
                                        class="btn btn-primary btn-md mt-4"
                                    >
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection