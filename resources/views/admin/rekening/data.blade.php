@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-header">
                    <span class="text-bold">{{ $menu }}</span>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2">
                                <div>Kegiatan</div>
                            </div>
                            <div class="col-10">
                                <div>: {{ $subkegiatan->kegiatan->kode_kegiatan ?? 'None' }}
                                    {{ $subkegiatan->kegiatan->nama_kegiatan ?? 'None' }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div>Sub Kegiatan</div>
                            </div>
                            <div class="col-10">
                                <div>: {{ $subkegiatan->kode_sub ?? 'None' }} {{ $subkegiatan->nama_sub ?? 'None' }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div>Bidang</div>
                            </div>
                            <div class="col-10">
                                <div>: {{ $subkegiatan->kegiatan->bagian->nama_bagian ?? 'None' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0)" id="createNewRekening" class="btn btn-info btn-xs">
                                <i class="fas fa-plus-circle"></i> Tambah
                            </a>
                            <a href="{{ route('subkegiatan.index', $subkegiatan->kegiatan->id ?? 'None') }}"
                                id="createNewSubkeg" class="btn btn-warning btn-xs float-right">
                                <i class="fas fa-reply"></i> Kembali
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th style="width:3%">No</th>
                                        <th style="width:15%">Kode Rekening</th>
                                        <th>Nama Rekening</th>
                                        <th style="width:13%">Jumlah</th>
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
                    <form id="rekeningForm" name="rekeningForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" id="subkegiatan_id" name="subkegiatan_id"
                            value="{{ $subkegiatan->id ?? 'None' }}">
                        <input type="hidden" name="rekening_id" id="rekening_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kegiatan</label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ $subkegiatan->kegiatan->kode_kegiatan ?? 'None' }} {{ $subkegiatan->kegiatan->nama_kegiatan ?? 'None' }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sub Kegiatan</label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ $subkegiatan->kode_sub ?? 'None' }} {{ $subkegiatan->nama_sub ?? 'None' }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kode Rekening<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" id="kode_rekening" name="kode_rekening"
                                        placeholder="Kode Rekening">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Rekening<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" id="nama_rekening" name="nama_rekening"
                                        placeholder="Nama Rekening">
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
                ajax: "{{ route('rekening.index', $id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'kode_rekening',
                        name: 'kode_rekening'
                    },
                    {
                        data: 'nama_rekening',
                        name: 'nama_rekening'
                    },
                    {
                        data: 'pagu_rekening',
                        name: 'pagu_rekening'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $("#createNewRekening").click(function() {
                $("#saveBtn").val("create-rekening");
                $("#rekening_id").val("");
                $("#rekeningForm").trigger("reset");
                $("#modelHeading").html("Tambah Rekening");
                $("#ajaxModel").modal("show");
                $("#deleteRekening").modal("show");
            });

            $("body").on("click", ".editRekening", function() {
                var rekening_id = $(this).data("id");
                $.get("{{ route('rekening.index', $rekening->subkegiatan->id ?? 'None') }}" + "/" +
                    rekening_id + "/edit",
                    function(data) {
                        $("#modelHeading").html("Edit Rekening");
                        $("#saveBtn").val("edit-rekening");
                        $("#ajaxModel").modal("show");
                        $("#rekening_id").val(data.id);
                        $("#subkegiatan_id").val(data.subkegiatan_id);
                        $("#kode_rekening").val(data.kode_rekening);
                        $("#nama_rekening").val(data.nama_rekening);
                    });
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html("menyimpan..");

                $.ajax({
                    data: $("#rekeningForm").serialize(),
                    url: "{{ route('rekening.store') }}",
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
                                $('#rekeningForm').trigger("reset");
                            });
                        } else {
                            table.draw();
                            alertSuccess("Rekening Berhasil di tambah");
                            $('#rekeningForm').trigger("reset");
                            $("#saveBtn").html("Simpan");
                            $('#ajaxModel').modal('hide');
                        }
                    },
                });
            });

            $("body").on("click", ".deleteRekening", function() {
                var subkeg_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('rekening.store') }}" + "/" + subkeg_id + "/destroy",
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertDanger("Rekening Berhasil di hapus");
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
