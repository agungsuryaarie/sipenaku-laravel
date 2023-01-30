@extends('admin.layouts.app')
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
                                <div>: {{ $rekening->subkegiatan->kegiatan->kode_kegiatan }}
                                    {{ $rekening->subkegiatan->kegiatan->nama_kegiatan }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div>Sub Kegiatan</div>
                            </div>
                            <div class="col-10">
                                <div>: {{ $rekening->subkegiatan->kode_sub }} {{ $rekening->subkegiatan->nama_sub }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div>Rekening</div>
                            </div>
                            <div class="col-10">
                                <div>: {{ $rekening->kode_rekening }} {{ $rekening->nama_detail }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div>Bidang</div>
                            </div>
                            <div class="col-10">
                                <div>: {{ $rekening->subkegiatan->kegiatan->bagian->nama_bagian }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0)" id="createNewDetail" class="btn btn-info btn-xs">
                                <i class="fas fa-plus-circle"></i> Tambah
                            </a>
                            <a href="{{ route('rekening.index', $rekening->subkegiatan->id) }}" id="createNewSubkeg"
                                class="btn btn-warning btn-xs float-right">
                                <i class="fas fa-reply"></i> Kembali
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th style="width:3%">No</th>
                                        <th>Nama Rekening</th>
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
                    <form id="detailForm" name="detailForm" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" id="id_detail" name="id_detail" value="{{ $rekening->id }}">
                                    <label>Kegiatan</label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ $rekening->subkegiatan->kegiatan->kode_kegiatan }} {{ $rekening->subkegiatan->kegiatan->nama_kegiatan }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="subkeg_id" id="subkeg_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" id="id_detail" name="id_detail" value="{{ $rekening->id }}">
                                    <label>Sub Kegiatan</label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ $rekening->kode_sub }} {{ $rekening->nama_sub }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Uraian<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" id="nama_detail" name="nama_detail"
                                        placeholder="Uraian">
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
                ajax: "{{ route('detail.index', $id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_detail',
                        name: 'nama_detail'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $("#createNewDetail").click(function() {
                $("#saveBtn").val("create-detail");
                $("#detail_id").val("");
                $("#detailForm").trigger("reset");
                $("#modelHeading").html("Tambah Rekening");
                $("#ajaxModel").modal("show");
                $("#deleteDetail").modal("show");
            });

            $("body").on("click", ".editDetail", function() {
                var detail_id = $(this).data("id_detail");
                $.get("{{ route('rekening.index', $rekening->id) }}" + "/" + detail_id + "/edit",
                    function(data) {
                        $("#modelHeading").html("Edit Rekening");
                        $("#saveBtn").val("edit-rekening");
                        $("#ajaxModel").modal("show");
                        $("#detail_id").val(data.id);
                        $("#id_detail").val(data.id_detail);
                        $("#nama_detail").val(data.nama_detail);
                    });
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html("menyimpan..");

                $.ajax({
                    data: $("#detailForm").serialize(),
                    url: "{{ route('detail.store') }}",
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
                                $('#detailForm').trigger("reset");
                            });
                        } else {
                            table.draw();
                            alertSuccess("Rekening Berhasil di tambah");
                            $('#detailForm').trigger("reset");
                            $("#saveBtn").html("Simpan");
                            $('#ajaxModel').modal('hide');
                        }
                    },
                });
            });

            $("body").on("click", ".deleteDetail", function() {
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
