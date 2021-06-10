@extends('layouts.app')

@section('title', 'Pembelian')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Informasi Pembelian</h2>
            <p class="dashboard-subtitle">
                Informasi Pembelian di SIP Del
            </p>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <form method="GET" action="{{ route('pembayaran.search') }}">
                @csrf
                    <div
                        class="input-group mb-4"
                    >
                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="form-control"
                            placeholder="Cari pembelian"
                            autofocus
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12 mt-2">
                    <ul
                        class="nav nav-pills mb-3"
                        id="pills-tab"
                        role="tablist"
                    >
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link {{ (Str::contains(url()->full(), 'unpaid')) ? '' : 'active' }}"
                                id="pills-sudah-tab"
                                data-toggle="pill"
                                href="#pills-sudah"
                                role="tab"
                                aria-controls="pills-sudah"
                                aria-selected="true"
                            >
                                Pembelian Sudah Dibayar
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link {{ (Str::contains(url()->full(), 'unpaid')) ? 'active' : '' }}"
                                id="pills-belum-tab"
                                data-toggle="pill"
                                href="#pills-belum"
                                role="tab"
                                aria-controls="pills-belum"
                                aria-selected="false"
                            >
                                Pembelian Belum Dibayar
                            </a>
                        </li>
                    </ul>
                    <div
                        class="tab-content"
                        id="pills-tabContent"
                    >
                        <div
                            class="tab-pane fade {{ (Str::contains(url()->full(), 'unpaid')) ? '' : 'show active' }}"
                            id="pills-sudah"
                            role="tabpanel"
                            aria-labelledby="pills-sudah-tab"
                        >
                            @forelse ($paids as $paid)
                            <a
                                href="{{ route('pembayaran.show', $hash->encodeHex($paid->id)) }}"
                                class="card card-list d-block"
                            >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            {{ $paid->title }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $paid->created_at->diffForHumans() }}
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
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            Tidak Ada Data Pembelian
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforelse
                            <div class="col-12 mt-3">
                                {{ $paids->links() }}
                            </div>
                        </div>
                        <div
                            class="tab-pane fade {{ (Str::contains(url()->full(), 'unpaid')) ? 'show active' : '' }}"
                            id="pills-belum"
                            role="tabpanel"
                            aria-labelledby="pills-belum-tab"
                        >
                            @forelse ($unpaids as $unpaid)
                            <a
                                href="{{ route('pembayaran.show', $hash->encodeHex($unpaid->id)) }}"
                                class="card card-list d-block"
                            >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            {{ $unpaid->title }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $unpaid->created_at->diffForHumans() }}
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
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            Tidak Ada Data Pembelian
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforelse
                            <div class="col-12 mt-3">
                                {{ $unpaids->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection