@extends('layouts.app')

@section('title', 'Detail Informasi Pengumuman')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                {{ $item->title }}
            </h2>
            <p class="dashboard-subtitle">
                Detail Informasi Pengumuman
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
                                                Isi Pengumuman
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
                                                File Pengumuman
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                @empty($item->file)
                                                    Tidak ada file pengumuman
                                                @else
                                                    <a href="{{ Storage::url($item->file) }}" target="blank">Download File Pengumuman</a>
                                                @endempty
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Dibuat Pada
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
                                        href="{{ route('pengumuman.index') }}"
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