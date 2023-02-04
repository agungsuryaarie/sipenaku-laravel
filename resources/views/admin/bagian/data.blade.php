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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0)" id="createNewBagian" class="btn btn-info btn-xs float-right">
                                <i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th style="width:5%">No</th>
                                        <th>Bagian</th>
                                        <th class="text-center" style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
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
                    <form id="bagianForm" name="bagianForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="bagian_id" id="bagian_id">
                        <div class="form-group">
                            <label for="nama_bagian" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama_bagian" name="nama_bagian"
                                    placeholder="Nama Bagian" maxlength="50" required="">
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
                ajax: "{{ route('bagian.index') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                    },
                    {
                        data: "nama_bagian",
                        name: "nama_bagian",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $("#createNewBagian").click(function() {
                $("#saveBtn").val("create-bagian");
                $("#bagian_id").val("");
                $("#bagianForm").trigger("reset");
                $("#modelHeading").html("Tambah Bagian");
                $("#ajaxModel").modal("show");
                $("#deleteBagian").modal("show");
            });

            $("body").on("click", ".editBagian", function() {
                var bagian_id = $(this).data("id");
                $.get("{{ route('bagian.index') }}" + "/" + bagian_id + "/edit", function(data) {
                    $("#modelHeading").html("Edit Bagian");
                    $("#saveBtn").val("edit-bagian");
                    $("#ajaxModel").modal("show");
                    $("#bagian_id").val(data.id);
                    $("#nama_bagian").val(data.nama_bagian);
                });
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html("menyimpan..");

                $.ajax({
                    data: $("#bagianForm").serialize(),
                    url: "{{ route('bagian.store') }}",
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
                                $('#bagianForm').trigger("reset");
                            });
                        } else {
                            table.draw();
                            alertSuccess("Bagian Berhasil di tambah");
                            $('#bagianForm').trigger("reset");
                            $("#saveBtn").html("Simpan");
                            $('#ajaxModel').modal('hide');
                        }
                    },
                });
            });

            $("body").on("click", ".deleteBagian", function() {
                var bagian_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('bagian.store') }}" + "/" + bagian_id,
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertDanger("Bagian Berhasil di hapus");
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });


            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endsection
