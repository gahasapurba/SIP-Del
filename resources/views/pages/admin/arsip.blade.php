@extends('layouts.admin')

@section('title', 'Arsip SIP Del')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Arsip SIP Del
            </h2>
            <p class="dashboard-subtitle">
                Arsip di Sistem Informasi Purchasing IT Del (SIP Del)
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
                                class="nav-link active"
                                id="pills-kategori-tab"
                                data-toggle="pill"
                                href="#pills-kategori"
                                role="tab"
                                aria-controls="pills-kategori"
                                aria-selected="true"
                            >
                                Kategori
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link"
                                id="pills-pengumuman-tab"
                                data-toggle="pill"
                                href="#pills-pengumuman"
                                role="tab"
                                aria-controls="pills-pengumuman"
                                aria-selected="false"
                            >
                                Pengumuman
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link"
                                id="pills-pembayaran-tab"
                                data-toggle="pill"
                                href="#pills-pembayaran"
                                role="tab"
                                aria-controls="pills-pembayaran"
                                aria-selected="false"
                            >
                                Pembelian
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link"
                                id="pills-item-tab"
                                data-toggle="pill"
                                href="#pills-item"
                                role="tab"
                                aria-controls="pills-item"
                                aria-selected="false"
                            >
                                Item
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link"
                                id="pills-pesan-tab"
                                data-toggle="pill"
                                href="#pills-pesan"
                                role="tab"
                                aria-controls="pills-pesan"
                                aria-selected="false"
                            >
                                Pesan
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link"
                                id="pills-pengguna-tab"
                                data-toggle="pill"
                                href="#pills-pengguna"
                                role="tab"
                                aria-controls="pills-pengguna"
                                aria-selected="false"
                            >
                                Pengguna
                            </a>
                        </li>
                    </ul>
                    <div
                        class="tab-content"
                        id="pills-tabContent"
                    >
                        <div
                            class="tab-pane fade show active"
                            id="pills-kategori"
                            role="tabpanel"
                            aria-labelledby="pills-kategori-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="kategoriTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Nama Kategori</th>
                                                    <th>Dihapus</th>
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
                            class="tab-pane fade"
                            id="pills-pengumuman"
                            role="tabpanel"
                            aria-labelledby="pills-pengumuman-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="pengumumanTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Judul Pengumuman</th>
                                                    <th>Dihapus</th>
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
                            class="tab-pane fade"
                            id="pills-pembayaran"
                            role="tabpanel"
                            aria-labelledby="pills-pembayaran-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="pembayaranTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Judul Pembelian</th>
                                                    <th class="text-center">Nama Perusahaan</th>
                                                    <th class="text-center">Kategori</th>
                                                    <th class="text-center">Author</th>
                                                    <th>Dihapus</th>
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
                            class="tab-pane fade"
                            id="pills-item"
                            role="tabpanel"
                            aria-labelledby="pills-item-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="itemTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Nama Item</th>
                                                    <th class="text-center">Judul Pembelian</th>
                                                    <th class="text-center">Jumlah Item</th>
                                                    <th class="text-center">Harga Per Item (Rp)</th>
                                                    <th class="text-center">Harga Total (Rp)</th>
                                                    <th>Dihapus</th>
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
                            class="tab-pane fade"
                            id="pills-pesan"
                            role="tabpanel"
                            aria-labelledby="pills-pesan-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="pesanTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Pengirim</th>
                                                    <th class="text-center">Penerima</th>
                                                    <th>Dihapus</th>
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
                            class="tab-pane fade"
                            id="pills-pengguna"
                            role="tabpanel"
                            aria-labelledby="pills-pengguna-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="penggunaTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Nama Pengguna</th>
                                                    <th class="text-center">Email</th>
                                                    <th>Role</th>
                                                    <th>Dihapus</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
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

    <script>
        var datatable = $('#kategoriTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-trash-kategori') }}',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                { data: 'name', name: 'name' },
                {
                    data: 'deleted_at',
                    name: 'deleted_at',
                    class: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
            ],
        })
    </script>

    <script>
        var datatable = $('#pengumumanTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-trash-pengumuman') }}',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                { data: 'title', name: 'title' },
                {
                    data: 'deleted_at',
                    name: 'deleted_at',
                    class: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
            ],
        })
    </script>
    
    <script>
        var datatable = $('#pembayaranTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-trash-pembayaran') }}',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                { data: 'title', name: 'title' },
                { data: 'company_name', name: 'company_name' },
                { data: 'category', name: 'category.name', orderable: false, },
                { data: 'author', name: 'author.name', orderable: false, },
                {
                    data: 'deleted_at',
                    name: 'deleted_at',
                    class: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
            ],
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'copy',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'csv',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'excel',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'pdf',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            // ],
        })
    </script>
    
    <script>
        var datatable = $('#itemTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-trash-item') }}',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                { data: 'name', name: 'name' },
                { data: 'purchase', name: 'purchase.title', orderable: false, },
                { data: 'quantity', name: 'quantity' },
                { data: 'price_per_item', name: 'price_per_item' },
                { data: 'price_total_item', name: 'price_total_item' },
                {
                    data: 'deleted_at',
                    name: 'deleted_at',
                    class: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
            ],
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'copy',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'csv',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'excel',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'pdf',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7]
            //         }
            //     },
            // ],
        })
    </script>

    <script>
        var datatable = $('#pesanTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-trash-pesan') }}',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                { data: 'sender', name: 'sender.name', orderable: false, },
                { data: 'receiver', name: 'receiver.name', orderable: false, },
                {
                    data: 'deleted_at',
                    name: 'deleted_at',
                    class: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
            ],
        })
    </script>
    
    <script>
        var datatable = $('#penggunaTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-trash-pengguna') }}',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                {
                    data: 'roles',
                    name: 'roles',
                    class: 'text-center',
                },
                {
                    data: 'deleted_at',
                    name: 'deleted_at',
                    class: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                },
            ],
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'copy',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5]
            //         }
            //     },
            //     {
            //         extend: 'csv',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5]
            //         }
            //     },
            //     {
            //         extend: 'excel',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5]
            //         }
            //     },
            //     {
            //         extend: 'pdf',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5]
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5]
            //         }
            //     },
            // ],
        })
    </script>

    <script type="text/javascript">
        $("body").on("click",".kill-category",function(){
            var current_object = $(this);
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                text: "Anda tidak akan bisa mengembalikan data ini setelah menghapusnya. Data pembayaran yang terkait dengan kategori ini akan ikut terhapus, dan tidak dapat direstore lagi",
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

    <script type="text/javascript">
        $("body").on("click",".kill-announcement",function(){
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

    <script type="text/javascript">
        $("body").on("click",".kill-purchasing",function(){
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
    
    <script type="text/javascript">
        $("body").on("click",".kill-item",function(){
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

    <script type="text/javascript">
        $("body").on("click",".kill-message",function(){
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

    <script type="text/javascript">
        $("body").on("click",".kill-user",function(){
            var current_object = $(this);
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                text: "Anda tidak akan bisa mengembalikan data ini setelah menghapusnya. Data pembayaran dan pesan yang terkait dengan pengguna ini akan ikut terhapus, dan tidak dapat direstore lagi",
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