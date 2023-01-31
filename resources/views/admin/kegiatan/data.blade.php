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
                        <li class="breadcrumb-item"><a href="{{ '/' }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:void(0)" id="createNewKegiatan" class="btn btn-info btn-xs float-right">
                            <i class="fas fa-plus-circle"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th style="width:3%">No</th>
                                    <th style="width:10%">Kode Kegiatan</th>
                                    <th>Nama Kegiatan</th>
                                    <th style="width:13%">Jumlah</th>
                                    <th style="width:20%">Bagian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="kegiatanForm" name="kegiatanForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="kegiatan_id" id="kegiatan_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kode Kegiatan <span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan"
                                        placeholder="Kode Kegiatan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Kegiatan <span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                        placeholder="Nama Kegiatan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Bagian<span class="text-danger"> *</span></label>
                                    <select class="browser-default custom-select" name="bagian_id" id="bagian_id">
                                        <option selected>Pilih Bagian</option>
                                        @foreach ($bagian as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_bagian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                lengthChange: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: ["excel", "pdf", "print", "colvis"],
                ajax: "{{ route('kegiatan.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'kode_kegiatan',
                        name: 'kode_kegiatan'
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan'
                    },
                    {
                        data: 'pagu_kegiatan',
                        name: 'pagu_kegiatan'
                    },
                    {
                        data: 'bagian',
                        name: 'bagian.nama_bagian'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $("#createNewKegiatan").click(function() {
                $("#saveBtn").val("create-kegiatan");
                $("#kegiatan_id").val("");
                $("#kegiatanForm").trigger("reset");
                $("#modelHeading").html("Tambah Kegiatan");
                $("#ajaxModel").modal("show");
                $("#deleteKegiatan").modal("show");
            });

            $("body").on("click", ".editKegiatan", function() {
                var kegiatan_id = $(this).data("id");
                $.get("{{ route('kegiatan.index') }}" + "/" + kegiatan_id + "/edit", function(data) {
                    $("#modelHeading").html("Edit Kegiatan");
                    $("#saveBtn").val("edit-kegiatan");
                    $("#ajaxModel").modal("show");
                    $("#kegiatan_id").val(data.id);
                    $("#kode_kegiatan").val(data.kode_kegiatan);
                    $("#nama_kegiatan").val(data.nama_kegiatan);
                    $("#bagian_id").val(data.bagian_id);
                });
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html("menyimpan..");

                $.ajax({
                    data: $("#kegiatanForm").serialize(),
                    url: "{{ route('kegiatan.store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        if (data.errors) {
                            $('.alert-danger').html('');
                            $.each(data.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' +
                                    value +
                                    '</li></strong>');
                                $(".alert-danger").fadeOut(5000);
                                $("#saveBtn").html("Simpan");
                                $('#kegiatanForm').trigger("reset");
                            });
                        } else {
                            table.draw();
                            alertSuccess("Kegiatan Berhasil di tambah");
                            $('#kegiatanForm').trigger("reset");
                            $("#saveBtn").html("Simpan");
                            $('#ajaxModel').modal('hide');
                        }
                    },
                });
            });

            $("body").on("click", ".deleteKegiatan", function() {
                var kegiatan_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('kegiatan.store') }}" + "/" + kegiatan_id + "/destroy",
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertDanger("Kegiatan Berhasil di hapus");
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });
        });
    </script>
@endsection
