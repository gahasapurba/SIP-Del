@extends('layouts.admin')

@section('title', 'Manajemen Role')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Manajemen Role Pengguna SIP Del
            </h2>
            <p class="dashboard-subtitle">
                Manajemen Role Pengguna di Sistem Informasi Purchasing IT Del (SIP Del)
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
                                id="pills-staff-tab"
                                data-toggle="pill"
                                href="#pills-staff"
                                role="tab"
                                aria-controls="pills-staff"
                                aria-selected="true"
                            >
                                Staff
                            </a>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <a
                                class="nav-link"
                                id="pills-user-tab"
                                data-toggle="pill"
                                href="#pills-user"
                                role="tab"
                                aria-controls="pills-user"
                                aria-selected="false"
                            >
                                Visitor
                            </a>
                        </li>
                    </ul>
                    <div
                        class="tab-content"
                        id="pills-tabContent"
                    >
                        <div
                            class="tab-pane fade show active"
                            id="pills-staff"
                            role="tabpanel"
                            aria-labelledby="pills-staff-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="staffTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Email</th>
                                                    <th>NIP</th>
                                                    <th>No. Telepon (WhatsApp)</th>
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
                            id="pills-user"
                            role="tabpanel"
                            aria-labelledby="pills-user-tab"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="userTable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">ID</th>
                                                    <th>No</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Email</th>
                                                    <th>No. Telepon (WhatsApp)</th>
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
        var datatable = $('#staffTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-role-staff') }}',
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
                    data: 'nip',
                    name: 'nip',
                    class: 'text-center',
                },
                {
                    data: 'phone_number',
                    name: 'phone_number',
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
                        columns: [1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                },
            ],
        })
    </script>

    <script>
        var datatable = $('#userTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('admin-role-user') }}',
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
                    data: 'phone_number',
                    name: 'phone_number',
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

    <script type="text/javascript">
        $("body").on("click",".remove-staff",function(){
            var current_object = $(this);
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                text: "Anda tidak akan bisa mengembalikan data ini setelah menghapusnya. Data pembayaran dan pesan yang terkait dengan staff ini akan terdampak, dan tidak bisa ditampilkan sementara. Anda dapat merestore staff ini nanti, atau ikut menghapus sementara data pembayaran dan pesan terkait",
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
        $("body").on("click",".remove-user",function(){
            var current_object = $(this);
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                text: "Anda tidak akan bisa mengembalikan data ini setelah menghapusnya. Data pembayaran dan pesan yang terkait dengan user ini akan terdampak, dan tidak bisa ditampilkan sementara. Anda dapat merestore user ini nanti, atau ikut menghapus sementara data pembayaran dan pesan terkait",
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