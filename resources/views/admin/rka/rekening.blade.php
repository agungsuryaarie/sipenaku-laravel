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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span>Sub Kegiatan :
                                {{ $subkegiatan->kode_sub . ' ' . $subkegiatan->nama_sub }}
                            </span>
                            <a href="{{ route('rka.subkegiatan', Crypt::encryptString($subkegiatan->kegiatan_id)) ?? 'None' }}"
                                class="btn btn-warning btn-xs float-right">
                                <i class="fas fa-reply"></i> Kembali
                            </a>
                            <a href="javascript:void(0)" id="createRKA" class="btn btn-info btn-xs float-right mr-2">
                                <i class="fas fa-plus-circle"></i> Tambah
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="data-table" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th style="width:3%">No</th>
                                        <th>Rekening</th>
                                        <th>Jumlah Anggaran</th>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                        <th>Action</th>
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
                        <input type="hidden" id="kegiatan_id" name="kegiatan_id"
                            value="{{ $subkegiatan->kegiatan->id ?? 'None' }}">
                        <input type="hidden" id="subkegiatan_id" name="subkegiatan_id"
                            value="{{ $subkegiatan->id ?? 'None' }}">
                        <input type="hidden" id="rekening_id" name="rekening_id" value="{{ $subkegiatan->id ?? 'None' }}">
                        <input type="hidden" name="rka_id" id="rka_id">
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
                                    <label>Januari</label>
                                    <input type="text" class="form-control" value="0" name="january">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Februari</label>
                                    <input type="text" class="form-control" value="0" name="february">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Maret</label>
                                    <input type="text" class="form-control" value="0" name="march">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>April</label>
                                    <input type="text" class="form-control" value="0" name="april">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mei</label>
                                    <input type="text" class="form-control" value="0" name="may">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Juni</label>
                                    <input type="text" class="form-control" value="0" name="june">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Juli</label>
                                    <input type="text" class="form-control" value="0" name="july">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agustus</label>
                                    <input type="text" class="form-control" value="0" name="august">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>September</label>
                                    <input type="text" class="form-control" value="0" name="september">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Oktober</label>
                                    <input type="text" class="form-control" value="0" name="october">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>November</label>
                                    <input type="text" class="form-control" value="0" name="november">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Desember</label>
                                    <input type="text" class="form-control" value="0" name="december">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" id="saveBtn" value="create">Simpan
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

            var table = $("#data-table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: ["excel", "pdf", "print", "colvis"],
                ajax: "{{ route('rka.rekening', $id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_rekening',
                        name: 'nama_rekening'
                    }, {
                        data: 'pagu_rekening',
                        name: 'pagu_rekening'
                    }
                ]
            })
        });

        $("#createRKA").click(function() {
            $("#saveBtn").val("create-rekening");
            $("#rka_id").val("");
            $("#rekeningForm").trigger("reset");
            $("#modelHeading").html("Tambah Rencana Kerja Anggaran");
            $("#ajaxModel").modal("show");
            $("#deleteRekening").modal("show");
        });
    </script>
@endsection
