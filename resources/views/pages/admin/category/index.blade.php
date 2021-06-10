@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Manajemen Kategori</h2>
            <p class="dashboard-subtitle">
                Manajemen Kategori Pembelian di SIP Del
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">
                                + Tambah Kategori Baru
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th style="display: none">ID</th>
                                            <th>No</th>
                                            <th class="text-center">Nama Kategori</th>
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

@endsection

@push('addon-script')

    <script>
        var datatable = $('#crudTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                {
                    data: 'id',
                    visible: false,
                    orderable: false,
                    searchable: false,
                    name: 'id',
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
                { data: 'name', name: 'name' },
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
        $("body").on("click",".remove-category",function(){
            var current_object = $(this);
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                text: "Anda tidak akan bisa mengembalikan data ini setelah menghapusnya. Data pembelian yang terkait dengan kategori ini akan terdampak, dan tidak bisa ditampilkan sementara. Anda dapat merestore kategori ini nanti, atau ikut menghapus sementara data pembelian terkait",
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