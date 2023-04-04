@extends('admin.layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $menu }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="box-shadow mb-5">
                    <div class="title mb-3">
                        <h3>Filter Berdasarkan : </h3>
                    </div>
                    <div class="row-kartu">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bagian</label>
                                <select data-column="2" class="form-control select2bs4 bagian">
                                    <option value="">::Semua Bagian::</option>
                                    @foreach ($bagian as $item)
                                        <option value="{{ $item->nama_bagian }}">
                                            {{ $item->nama_bagian }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kegiatan</label>
                                <select data-column="1" class="form-control select2bs4 kegiatan">
                                    <option value="">::Semua Kegiatan::</option>
                                    @foreach ($kegiatan as $k)
                                        <option value="{{ $k->nama_kegiatan }}">
                                            {{ $k->nama_kegiatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th style="width:3%">No</th>
                                    <th>Nama Kegiatan</th>
                                    <th style="width:15%">Bagian</th>
                                    <th style="width:13%">Jumlah</th>
                                    <th style="width:13%">Terpakai</th>
                                    <th style="width:13%">Sisa</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var table = $(".data-table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 10,
                lengthMenu: [10, 50, 100, 200, 500],
                lengthChange: true,
                autoWidth: false,
                ajax: "{{ route('kartu.kegiatan') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan'
                    },
                    {
                        data: 'bagian',
                        name: 'bagian'
                    },
                    {
                        data: 'pagu_kegiatan',
                        name: 'pagu_kegiatan'
                    },
                    {
                        data: 'terpakai',
                        name: 'terpakai'
                    },
                    {
                        data: 'sisa_kegiatan',
                        name: 'sisa_kegiatan'
                    },
                ]
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('.bagian').change(function() {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
            $('.kegiatan').change(function() {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
        });
        //Filter Bagian
        // $(document).ready(function() {
        //     let table = $(".data-table")
        //     $('#pilih').on('change', function() {
        //         teble.on('preXhr.dt', function(e, settings, data) {
        //                 data.bagian_id = $('#pilih').val();
        //             })
        //             .dataTable({
        //                 ajax: "data.json"
        //             });
        //         table.DataTable().ajax.reload()
        //     })
        // })
    </script>
@endsection
