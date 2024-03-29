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
                <div class="card mt-4">
                    <div class="card-header">
                        <span class="text-bold">{{ $menu }}</span>
                        <a href="javascript:void(0)" id="createNewKegiatan" class="btn btn-info btn-xs float-right">
                            <i class="fas fa-plus-circle"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th style="width:3%">No</th>
                                    <th style="width:15%">Kode Kegiatan</th>
                                    <th>Nama Kegiatan</th>
                                    <th style="width:13%">Jumlah</th>
                                    <th style="width:20%">Bagian</th>
                                    <th class="text-center" style="width: 10%">Action</th>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kode Kegiatan <span class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan"
                                    placeholder="Kode Kegiatan">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Kegiatan <span class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                    placeholder="Nama Kegiatan">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bagian<span class="text-danger"> *</span></label>
                                <select class="browser-default custom-select select2bs4" name="bagian_id" id="bagian_id">
                                    <option selected disabled>Pilih Bagian</option>
                                    @foreach ($bagian as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama_bagian }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-default btn-sm"
                                data-dismiss="modal">&nbsp;Kembali</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="saveBtn" value="create">&nbsp;Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    {{-- Modal Delete --}}
    <div class="modal fade" id="ajaxModelHps">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modelHeadingHps">
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <center>
                        <h6 class="text-muted">::KEPUTUSAN INI TIDAK DAPAT DIUBAH KEMBALI::</h6>
                    </center>
                    <center>
                        <h6>Apakah anda yakin menghapus Kegiatan ini ?</h6>
                    </center>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger btn-sm " id="hapusBtn"><i class="fa fa-trash"></i>
                        Hapus</button>
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
                pageLength: 10,
                lengthMenu: [10, 50, 100, 200, 500],
                lengthChange: true,
                autoWidth: false,
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
                $(this).html(
                    "<span class='spinner-border spinner-border-sm'></span><span class='visually-hidden'><i> menyimpan...</i></span>"
                );
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
                                // $('#kegiatanForm').trigger("reset");
                            });
                        } else {
                            table.draw();
                            alertSuccess("Kegiatan Berhasil ditambah");
                            // $('#kegiatanForm').trigger("reset");
                            $("#saveBtn").html("Simpan");
                            $('#ajaxModel').modal('hide');
                        }
                    },
                });
            });
            $("body").on("click", ".deleteKegiatan", function() {
                var kegiatan_id = $(this).data("id");
                $("#modelHeadingHps").html("Hapus");
                $("#ajaxModelHps").modal("show");
                $("#hapusBtn").click(function(e) {
                    e.preventDefault();
                    $(this).html(
                        "<span class='spinner-border spinner-border-sm'></span><span class='visually-hidden'><i> menghapus...</i></span>"
                    );
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('kegiatan.store') }}" + "/" + kegiatan_id +
                            "/destroy",
                        data: {
                            _token: "{!! csrf_token() !!}",
                        },
                        success: function(data) {
                            if (data.errors) {
                                $('.alert-danger').html('');
                                $.each(data.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<strong><li>' +
                                        value +
                                        '</li></strong>');
                                    $(".alert-danger").fadeOut(5000);
                                    $("#hapusBtn").html(
                                        "<i class='fa fa-trash'></i>"
                                    );
                                });
                            } else {
                                table.draw();
                                alertSuccess(data.success);
                                $("#hapusBtn").html(
                                    "<i class='fa fa-trash'></i>");
                                $('#ajaxModelHps').modal('hide');
                            }
                        },
                    });
                });
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endsection
