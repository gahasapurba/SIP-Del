@extends('layouts.app')

@section('title', 'Manajemen Pembelian')

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Manajemen Pembelian</h2>
            <p class="dashboard-subtitle">
                Manajemen Pembelian di SIP Del
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('manajemenpembayaran.create') }}" class="btn btn-primary mb-3">
                                + Tambah Data Pembelian Baru
                            </a>
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
        var datatable = $('#pembayaranTable').DataTable({
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{ route('manajemenpembayaran.index') }}',
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
                { data: 'title', name: 'title' },
                { data: 'company_name', name: 'company_name' },
                { data: 'category', name: 'category.name' },
                { data: 'author', name: 'author.name' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '10%',
                    class: 'text-center',
                },
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                },
            ],
        })
    </script>

    <script type="text/javascript">
        $("body").on("click",".remove-purchasing",function(){
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