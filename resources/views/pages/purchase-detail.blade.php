@extends('layouts.app')

@section('title', 'Detail Pembelian')

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
            <h2 class="dashboard-title">
                {{ $item->title }}
            </h2>
            <p class="dashboard-subtitle">
                Detail Informasi Pembelian
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
                                            class="col-12 col-md-4"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Nama
                                                Perusahaan
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                {{ $item->company_name }}
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-4"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Kategori
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                {{ $item->category->name }}
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-4"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Harga Pembelian
                                            </div>
                                            @php
                                                $totalPrice = 0
                                            @endphp
                                            @foreach ($item->items as $itemPembelian)
                                                @php
                                                    $totalPrice += $itemPembelian->price_total_item
                                                @endphp
                                            @endforeach
                                            <div
                                                class="product-subtitle"
                                            >
                                                Rp{{ number_format($totalPrice ?? '0',2,",",".") }}
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Deskripsi Pembelian
                                            </div>
                                            <div
                                                class="product-subtitle"
                                            >
                                                {!! $item->description !!}
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12"
                                        >
                                            <div
                                                class="product-title"
                                            >
                                                Status Pembelian
                                            </div>
                                            <div
                                                class="product-subtitle
                                                    @if($item->purchasing_status == 'belum')
                                                        text-danger
                                                    @elseif($item->purchasing_status == 'sudah')
                                                        text-success
                                                    @endif
                                                "
                                            >
                                                @if($item->purchasing_status == 'belum')
                                                    Belum Dibayar
                                                @elseif($item->purchasing_status == 'sudah')
                                                    Sudah Dibayar
                                                @endif
                                            </div>
                                        </div>
                                        @if($item->purchasing_status == 'sudah')
                                            <div
                                                class="col-12 col-md-12"
                                            >
                                                <div
                                                    class="product-title"
                                                >
                                                    Bukti Pembayaran
                                                </div>
                                                <div
                                                    class="product-subtitle"
                                                >
                                                    @empty($item->payment_slip)
                                                        Tidak ada bukti pembayaran
                                                    @else
                                                        <a href="{{ Storage::url($item->payment_slip) }}" target="blank">Lihat Bukti Pembayaran</a>
                                                    @endempty
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($totalPrice)
                                @if((Auth::user()->roles == 'Staff' && Auth::user()->staff_status == 1))
                                    @if($item->purchasing_status == 'belum')
                                        <form action="{{ route('pembayaran.updatepembayaran', $hash->encodeHex($item->id)) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <input type="hidden" name="users_id" value="{{ $hash->encodeHex($item->users_id) }}">
                                            <input type="hidden" name="categories_id" value="{{ $hash->encodeHex($item->categories_id) }}">
                                            <input type="hidden" name="title" value="{{ $item->title }}">
                                            <input type="hidden" name="company_name" value="{{ $item->company_name }}">
                                            <input type="hidden" name="price" value="{{ $totalPrice }}">
                                            <input type="hidden" name="description" value="{{ $item->description }}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div
                                                            class="col-12 col-md-3"
                                                        >
                                                            <div
                                                                class="product-title"
                                                            >
                                                                Update Status Pembelian
                                                            </div>
                                                            <select
                                                                name="purchasing_status"
                                                                id="purchasing_status"
                                                                class="form-control @if($errors->has('purchasing_status')) is-invalid @endif"
                                                                v-model="purchasing_status"
                                                                autofocus
                                                            >
                                                                <option
                                                                    value="belum"
                                                                    @if($item->purchasing_status == 'belum') selected @endif
                                                                >
                                                                    Belum
                                                                    Dibayar
                                                                </option>
                                                                <option
                                                                    value="sudah"
                                                                    @if($item->purchasing_status == 'sudah') selected @endif
                                                                >
                                                                    Sudah
                                                                    Dibayar
                                                                </option>
                                                            </select>
                                                            @if($errors->has('purchasing_status'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    @foreach ($errors->get('purchasing_status') as $error)
                                                                        <strong>{{ $error }}</strong>
                                                                    @endforeach
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <template
                                                            v-if="purchasing_status == 'sudah'"
                                                        >
                                                            <div
                                                                class="col-md-3"
                                                            >
                                                                <div
                                                                    class="product-title"
                                                                >
                                                                    Input
                                                                    Bukti
                                                                    Pembayaran
                                                                </div>
                                                                <input
                                                                    type="file"
                                                                    class="form-control @if($errors->has('payment_slip')) is-invalid @endif"
                                                                    name="payment_slip"
                                                                    v-model="payment_slip"
                                                                    required
                                                                />
                                                                @if($errors->has('payment_slip'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        @foreach ($errors->get('payment_slip') as $error)
                                                                            <strong>{{ $error }}</strong>
                                                                        @endforeach
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div
                                                                class="col-md-2"
                                                            >
                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-primary btn-block mt-4"
                                                                >
                                                                    Update Pembelian
                                                                </button>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                @endif
                            @endif
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <h4>
                                        Item Pembelian
                                    </h4>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        @forelse ($item->items as $itemPembelian)
                                            <div
                                                class="col-2 col-md-2"
                                            >
                                                <div
                                                    class="product-title"
                                                >
                                                    #
                                                </div>
                                                <div
                                                    class="product-subtitle"
                                                >
                                                    {{ $loop->iteration }}
                                                </div>
                                            </div>
                                            <div
                                                class="col-2 col-md-2"
                                            >
                                                <div
                                                    class="product-title"
                                                >
                                                    Nama Item
                                                </div>
                                                <div
                                                    class="product-subtitle"
                                                >
                                                    {{ $itemPembelian->name }}
                                                </div>
                                            </div>
                                            <div
                                                class="col-2 col-md-2"
                                            >
                                                <div
                                                    class="product-title"
                                                >
                                                    Jumlah Item (Unit)
                                                </div>
                                                <div
                                                    class="product-subtitle"
                                                >
                                                    {{ $itemPembelian->quantity }}
                                                </div>
                                            </div>
                                            <div
                                                class="col-2 col-md-2"
                                            >
                                                <div
                                                    class="product-title"
                                                >
                                                    Harga Per Item (Rp)
                                                </div>
                                                <div
                                                    class="product-subtitle"
                                                >
                                                    Rp{{ number_format($itemPembelian->price_per_item,2,",",".") }}
                                                </div>
                                            </div>
                                            <div
                                                class="col-2 col-md-2"
                                            >
                                                <div
                                                    class="product-title"
                                                >
                                                    Harga Total (Rp)
                                                </div>
                                                <div
                                                    class="product-subtitle"
                                                >
                                                    Rp{{ number_format($itemPembelian->price_total_item,2,",",".") }}
                                                </div>
                                            </div>
                                            @if($item->purchasing_status == 'belum')
                                                @if((Auth::user()->roles == 'Staff' && Auth::user()->staff_status == 1))
                                                    <div class="dropdown col-2 col-md-2">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                            Aksi
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('pembayaran.edititem', $hash->encodeHex($itemPembelian->id)) }}">
                                                                Edit
                                                            </a>
                                                            <a class="dropdown-item text-danger remove-item" href="{{ route('pembayaran.deleteitem', $hash->encodeHex($itemPembelian->id)) }}">
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="dropdown col-2 col-md-2">
                                                    </div>
                                                @endif
                                            @else
                                                <div class="dropdown col-2 col-md-2">
                                                </div>
                                            @endif
                                        @empty
                                            <div
                                                class="col-12 col-md-12"
                                            >
                                                <div
                                                    class="product-title"
                                                >
                                                    Tidak ada item yang ditambahkan
                                                </div>
                                                <div
                                                    class="product-subtitle"
                                                >
                                                    Belum ada item yang ditambahkan pada pembelian ini
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @if($item->purchasing_status == 'belum')
                                @if((Auth::user()->roles == 'Staff' && Auth::user()->staff_status == 1))
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <h5>
                                            Tambah Item Pembelian
                                        </h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <form action="{{ route('pembayaran.additem') }}" method="POST" enctype="multipart/form-data" class="row ml-1">
                                                @csrf
                                                <input type="hidden" name="purchases_id" value="{{ $item->id }}">
                                                <div
                                                    class="col-3 col-md-3"
                                                >
                                                    <div
                                                        class="product-title"
                                                    >
                                                        Nama Item
                                                    </div>
                                                    <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" value="{{ old('name') }}" autofocus>
                                                    @if($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            @foreach ($errors->get('name') as $error)
                                                                <strong>{{ $error }}</strong>
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </div>
                                                <div
                                                    class="col-3 col-md-3"
                                                >
                                                    <div
                                                        class="product-title"
                                                    >
                                                        Jumlah Item (Unit)
                                                    </div>
                                                    <input type="number" name="quantity" class="form-control @if($errors->has('quantity')) is-invalid @endif" value="{{ old('quantity') }}" autofocus>
                                                    @if($errors->has('quantity'))
                                                        <span class="invalid-feedback" role="alert">
                                                            @foreach ($errors->get('quantity') as $error)
                                                                <strong>{{ $error }}</strong>
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </div>
                                                <div
                                                    class="col-3 col-md-3"
                                                >
                                                    <div
                                                        class="product-title"
                                                    >
                                                        Harga Per Satuan (Rp)
                                                    </div>
                                                    <input type="number" name="price_per_item" class="form-control @if($errors->has('price_per_item')) is-invalid @endif" value="{{ old('price_per_item') }}" autofocus>
                                                    @if($errors->has('price_per_item'))
                                                        <span class="invalid-feedback" role="alert">
                                                            @foreach ($errors->get('price_per_item') as $error)
                                                                <strong>{{ $error }}</strong>
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-3 col-md-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        Tambah
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif
                            <div class="row mt-4">
                                <div
                                    class="col-12 text-right"
                                >
                                    @if((Auth::user()->roles == 'Staff' && Auth::user()->staff_status == 1))
                                    <a
                                        href="{{ route('pembayaran.invoice', $hash->encodeHex($item->id)) }}"
                                        class="btn btn-outline-danger btn-md mt-4"
                                        target="_blank"
                                    >
                                        Cetak Laporan PO (PDF)
                                    </a>
                                    @endif
                                    <a
                                        href="{{ route('pembayaran.index') }}"
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

@push('addon-script')

<script src="/vendor/vue/vue.js"></script>
<script>
    var informationDetails = new Vue({
        el: "#informationDetails",
        data: {
            purchasing_status: "{{ $item->purchasing_status }}",
            payment_slip: "",
        },
    });
</script>

@endpush