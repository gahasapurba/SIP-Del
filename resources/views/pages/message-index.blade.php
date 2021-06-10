@extends('layouts.app')

@section('title', 'Pesan')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Pesan</h2>
            <p class="dashboard-subtitle">
                Pesan Anda di SIP Del
            </p>
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
                                class="nav-link {{ (Str::contains(url()->full(), config('app.url') . '/pesan?page=')) || (request()->is('search/pesan*')) ? '' : 'active' }}"
                                id="pills-terkirim-tab"
                                data-toggle="pill"
                                href="#pills-terkirim"
                                role="tab"
                                aria-controls="pills-terkirim"
                                aria-selected="true"
                            >
                                Pesan Terkirim
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link {{ (Str::contains(url()->full(), config('app.url') . '/pesan?page=')) || (request()->is('search/pesan*')) ? 'active' : '' }}"
                                id="pills-masuk-tab"
                                data-toggle="pill"
                                href="#pills-masuk"
                                role="tab"
                                aria-controls="pills-masuk"
                                aria-selected="false"
                            >
                                Pesan Masuk
                            </a>
                        </li>
                    </ul>
                    <div
                        class="tab-content"
                        id="pills-tabContent"
                    >
                        <div
                            class="tab-pane fade {{ (Str::contains(url()->full(), config('app.url') . '/pesan?page=')) || (request()->is('search/pesan*')) ? '' : 'show active' }}"
                            id="pills-terkirim"
                            role="tabpanel"
                            aria-labelledby="pills-terkirim-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ route('pesan.create') }}" class="btn btn-primary mb-3">
                                        + Kirim Pesan Baru
                                    </a>
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="terkirimTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Nama Penerima</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade {{ (Str::contains(url()->full(), config('app.url') . '/pesan?page=')) || (request()->is('search/pesan*')) ? 'show active' : '' }}"
                            id="pills-masuk"
                            role="tabpanel"
                            aria-labelledby="pills-masuk-tab"
                        >
                            <div class="row">
                                <div class="col-lg-3">
                                    <form method="GET" action="{{ route('pesan.search') }}">
                                    @csrf
                                        <div
                                            class="input-group mb-4"
                                        >
                                            <input
                                                type="text"
                                                name="search"
                                                id="search"
                                                class="form-control"
                                                placeholder="Cari pengirim"
                                                autofocus
                                            />
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-primary">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @forelse ($items as $item)
                            <a
                                href="{{ route('pesan.show', $hash->encodeHex($item->id)) }}"
                                class="card card-list d-block"
                            >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            {{ $item->sender->name }} ({{ $item->sender->roles }})
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
                                            Tidak Ada Pesan Masuk
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforelse
                            <div class="col-12 mt-3">
                                {{ $items->links() }}
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

    <script>
        var datatable = $('#terkirimTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('pesan.index') }}',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    width: '5%',
                    class: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    width: '5%',
                    class: 'text-center',
                },
                { data: 'receiver', name: 'receiver.name' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '10%',
                    class: 'text-center',
                },
            ],
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'copy',
            //         exportOptions: {
            //             columns: [1, 2]
            //         }
            //     },
            //     {
            //         extend: 'csv',
            //         exportOptions: {
            //             columns: [1, 2]
            //         }
            //     },
            //     {
            //         extend: 'excel',
            //         exportOptions: {
            //             columns: [1, 2]
            //         }
            //     },
            //     {
            //         extend: 'pdf',
            //         exportOptions: {
            //             columns: [1, 2]
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         exportOptions: {
            //             columns: [1, 2]
            //         }
            //     },
            // ],
        })
    </script>

    <script type="text/javascript">
        $("body").on("click",".remove-message",function(){
            var current_object = $(this);
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                text: "Anda tidak akan bisa mengembalikan data ini setelah menghapusnya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');

                    $('body').html("<form class='remove-form' method='post' action='"+action+"'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
    </script>

@endpush