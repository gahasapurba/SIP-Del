@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Dashboard</h2>
            <p class="dashboard-subtitle">
                Selamat Datang di Administrasi SIP Del (Sistem Informasi
                Purchasing IT Del)
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div
                                class="dashboard-card-title"
                            >
                                Pengguna
                            </div>
                            <div
                                class="dashboard-card-subtitle"
                            >
                                {{ $user }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div
                                class="dashboard-card-title"
                            >
                                Pembelian Sudah Dibayar
                            </div>
                            <div
                                class="dashboard-card-subtitle"
                            >
                                {{ $paid }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div
                                class="dashboard-card-title"
                            >
                                Pembelian Belum Dibayar
                            </div>
                            <div
                                class="dashboard-card-subtitle"
                            >
                                {{ $unpaid }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3">
                        Pengumuman Terbaru
                    </h5>
                    @forelse ($announcements as $item)
                    <a
                        href="{{ route('pengumuman.show', $hash->encodeHex($item->id)) }}"
                        class="card card-list d-block"
                    >
                        <div class="card-body mb-3">
                            <div class="row">
                                <div class="col-md-7">
                                    {{ $item->title }}
                                </div>
                                <div class="col-md-3">
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                                <div
                                    class="col-md-1 d-none d-md-block"
                                >
                                    <img
                                        src="/images/dashboard-arrow-right.svg"
                                        alt="Arrow Right"
                                    />
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <a
                        href="#"
                        class="card card-list d-block"
                    >
                        <div class="card-body mb-3">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    Tidak Ada Pengumuman
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforelse
                    <h5 class="mb-3">
                        Data Pembelian Terbaru
                    </h5>
                    @forelse ($purchases as $item)
                    <a
                        href="{{ route('pembayaran.show', $hash->encodeHex($item->id)) }}"
                        class="card card-list d-block"
                    >
                        <div class="card-body mb-3">
                            <div class="row">
                                <div class="col-md-7">
                                    {{ $item->title }}
                                </div>
                                <div class="col-md-3">
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                                <div
                                    class="col-md-1 d-none d-md-block"
                                >
                                    <img
                                        src="/images/dashboard-arrow-right.svg"
                                        alt="Arrow Right"
                                    />
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <a
                        href="#"
                        class="card card-list d-block"
                    >
                        <div class="card-body mb-3">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    Tidak Ada Data Pembelian
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforelse
                    <h5 class="mb-3">
                        Pesan Masuk Terbaru
                    </h5>
                    @forelse ($messages as $item)
                    <a
                        href="{{ route('pesan.show', $hash->encodeHex($item->id)) }}"
                        class="card card-list d-block"
                    >
                        <div class="card-body mb-3">
                            <div class="row">
                                <div class="col-md-7">
                                    {{ $item->sender->name }}
                                </div>
                                <div class="col-md-3">
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                                <div
                                    class="col-md-1 d-none d-md-block"
                                >
                                    <img
                                        src="/images/dashboard-arrow-right.svg"
                                        alt="Arrow Right"
                                    />
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <a
                        href="#"
                        class="card card-list d-block"
                    >
                        <div class="card-body mb-3">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    Tidak Ada Pesan Masuk
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection