@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $menu }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="post">
                                <div class="user-block">
                                    <img src="{{ url('storage/fotouser/' . $user->foto) }}"
                                        class="img-circle img-bordered-sm" alt="User Image">
                                    <span class="username">
                                        <a href="#">{{ $user->nama }}</a>
                                    </span>
                                    <span class="description">{{ $spj->bagian->nama_bagian }}</span>
                                    <span class="description">upload pada - <span
                                            class="badge badge-info">{{ \Carbon\Carbon::parse($spj->created_at)->translatedFormat('l, d F Y') }}</span>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <hr>
                                            <h5>
                                                Detail Kegiatan
                                            </h5>
                                            <table>
                                                <tr>
                                                    <td rowspan="5" style="width:4%">
                                                        @if ($spj->jenis_spm == 1)
                                                            <span class="badge badge-primary btn-sm">GU</span>
                                                        @elseif($spj->jenis_spm == 2)
                                                            <span class="badge badge-primary btn-sm">TU</span>
                                                        @elseif($spj->jenis_spm == 3)
                                                            <span class="badge badge-primary btn-sm">LS</span>
                                                        @elseif($spj->jenis_spm == 4)
                                                            <span class="badge badge-primary btn-sm">UP</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Kode Kegiatan
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        {{ $spj->kegiatan->kode_kegiatan }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Kegiatan
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        {{ $spj->kegiatan->nama_kegiatan }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Kode Sub Kegiatan
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        {{ $spj->subkegiatan->kode_sub }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Sub Kegiatan
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        {{ $spj->subkegiatan->nama_sub }}
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <h5>
                                                Detail Penerima
                                            </h5>
                                            <table>
                                                <tr>
                                                    <td rowspan="5" style="width:4%">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Uraian
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        {{ $spj->uraian }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Nama Penerima
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        {{ $spj->nama_penerima }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Alamat Penerima
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        {{ $spj->alamat_penerima }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 4%">
                                                        Nilai Kwitansi
                                                    </td>
                                                    <td style="width: 1%">
                                                        :
                                                    </td>
                                                    <td style="width: 20%">
                                                        <span
                                                            class="badge badge-danger">{{ 'Rp. ' . number_format($spj->kwitansi, 0, ',', '.') }}</span>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <h5>
                                                Berkas
                                            </h5>
                                            <a href="{{ url('storage/file/', $spj->file) }}" target="blank"
                                                class="link-blue text-sm"><i class="fas fa-link mr-1"></i>
                                                File Berkas</a>
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                data-id="{{ $spj->id }}" data-original-title="Terima"
                                                class="btn btn-success btn-xs terima"><i class="fa fa-check"></i> Terima</a>
                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                data-id="{{ $spj->id }}" data-original-title="Kembalikan"
                                                class="btn btn-warning btn-xs text-white kembalikan"><i
                                                    class="fa fa-exchange-alt"></i>
                                                Kembalikan</a>
                                            <button id="tolak" type="button" data-toggle="modal"
                                                data-target="#modal-tolak{{ $spj->id }}"
                                                class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Tolak</button>
                                            {{-- <a href="javascript:void(0)" data-toggle="tooltip"
                                                data-id="{{ $spj->id }}" data-original-title="Tolak"
                                                class="btn btn-danger btn-xs tolak"><i class="fa fa-ban"></i> Tolak</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal fade" id="ajaxModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modelHeading">
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <form id="tolakForm" name="tolakForm" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <p>Apakah anda yakin untuk menolak SPJ dari {{ $spj->bagian->nama_bagian }} ?</p>
                        <input type="hidden" id="spj_id" name="spj_id" value="{{ $spj->id }}">
                        <div class="form-group">
                            <label>Berikan Alasan</label>
                            <textarea name="alasan" id="alasan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger btn-sm " id="tolakBtn"><i class="fa fa-ban"></i>
                            Tolak</button>
                    </div>
                </form>
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

            $("body").on("click", ".deleteSpj", function() {
                var spj_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('spj/destroy') }}" + '/' + spj_id,
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertDanger("SPJ Berhasil di hapus");
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });

            $("body").on("click", ".terima", function() {
                var spj_id = $(this).data("id");
                confirm("Terima !");
                $.ajax({
                    type: "POST",
                    url: "{{ url('spj/terima') }}" + '/' + spj_id,
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertSuccess("SPJ Berhasil diterima");
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });

            $("body").on("click", ".kembalikan", function() {
                var spj_id = $(this).data("id");
                confirm("Kembalikan !");
                $.ajax({
                    type: "POST",
                    url: "{{ url('spj/kembalikan') }}" + '/' + spj_id,
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertSuccess("SPJ Berhasil dikembalikan");
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });
            $("#tolak").click(function() {
                $("#tolakForm").trigger("reset");
                $("#modelHeading").html("Konfirmasi");
                $("#ajaxModel").modal("show");
            });
            $("#tolakBtn").click(function(e) {
                e.preventDefault();
                $(this).html(
                    "<span class='spinner-border spinner-border-sm'></span><span class='visually-hidden'><i> memproses...</i></span>"
                );
                var spj_id = $("#spj_id").val();
                $.ajax({
                    data: $("#tolakForm").serialize(),
                    url: "{{ url('spj/decline') }}" + "/" + spj_id,
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        if (data.errors) {
                            $('.alert-danger').html('');
                            $.each(data.error, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' +
                                    value +
                                    '</li></strong>');
                                $(".alert-danger").fadeOut(5000);
                                $("#tolakBtn").html("<i class='fa fa-ban'></i> Tolak");
                                $('#tolakForm').trigger("reset");
                            });
                        } else {
                            alertSuccess(data.success);
                            $("#tolakBtn").html("<i class='fa fa-ban'></i> Tolak");
                            $('#ajaxModel').modal('hide');
                            window.location.href = "{{ url('spj/verifikasi') }}"
                        }
                    },
                });
            });
        });
    </script>
@endsection
