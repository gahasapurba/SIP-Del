@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Pengumuman</h2>
            <p class="dashboard-subtitle">
                Daftar Pengumuman di SIP Del
            </p>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <form method="GET" action="{{ route('pengumuman.search') }}">
                @csrf
                    <div
                        class="input-group mb-4"
                    >
                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="form-control"
                            placeholder="Cari pengumuman"
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
                    @forelse ($items as $item)
                    <a
                        href="{{ route('pengumuman.show', $hash->encodeHex($item->id)) }}"
                        class="card card-list d-block"
                    >
                        <div class="card-body">
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    Tidak Ada Pengumuman
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforelse
                </div>
                <div class="col-12 mt-3">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection