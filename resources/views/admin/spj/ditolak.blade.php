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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Filter SPM</label>
                                        <select data-column="7" class="form-control select2bs4 spm">
                                            <option value="">::Semua SPM::</option>
                                            <option value="GU">GU</option>
                                            <option value="TU">TU</option>
                                            <option value="LS">LS</option>
                                            <option value="UP">UP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Filter GU</label>
                                        <select data-column="8" class="form-control select2bs4 gu">
                                            <option value="">::Semua GU::</option>
                                            <option value="GU 1">GU 1</option>
                                            <option value="GU 2">GU 2</option>
                                            <option value="GU 3">GU 3</option>
                                            <option value="GU 4">GU 4</option>
                                            <option value="GU 5">GU 5</option>
                                            <option value="GU 6">GU 6</option>
                                            <option value="GU 7">GU 7</option>
                                            <option value="GU 8">GU 8</option>
                                            <option value="GU 9">GU 9</option>
                                            <option value="GU 10">GU 10</option>
                                            <option value="GU 11">GU 11</option>
                                            <option value="GU 12">GU 12</option>
                                            <option value="GU 13">GU 13</option>
                                            <option value="GU 14">GU 14</option>
                                            <option value="GU 15">GU 15</option>
                                            <option value="GU 16">GU 16</option>
                                            <option value="GU 17">GU 17</option>
                                            <option value="GU 18">GU 18</option>
                                            <option value="GU 19">GU 19</option>
                                            <option value="GU 20">GU 20</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="example1" class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 8%">Tanggal</th>
                                        <th>Kegiatan</th>
                                        <th>Sub Kegiatan</th>
                                        <th>Rekening</th>
                                        <th style="width: 30%">Uraian</th>
                                        <th style="width: 10%">Nilai</th>
                                        <th style="width: 5%">SPM</th>
                                        <th style="width: 5%">GU</th>
                                        <th style="width: 5%" class="text-center">Aksi</th>
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
@endsection
@section('modal')
    {{-- Modal Delete --}}
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
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <center>
                        <h6 class="text-muted">::KEPUTUSAN INI TIDAK DAPAT DIUBAH KEMBALI::</h6>
                        <br>
                    </center>
                    <center>
                        <h6>Apakah anda yakin menghapus SPJ ini ?</h6>
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
                ajax: "{{ route('spj.ditolak') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                    },
                    {
                        data: "tanggal",
                        name: "tanggal",
                    },
                    {
                        data: "kegiatan",
                        name: "kegiatan",
                    },
                    {
                        data: "subkeg",
                        name: "subkeg",
                    },
                    {
                        data: "rekening",
                        name: "rekening",
                    },
                    {
                        data: "uraian",
                        name: "uraian",
                    },
                    {
                        data: "nilai",
                        name: "nilai",
                    },
                    {
                        data: "spm",
                        name: "spm",
                    },
                    {
                        data: "gu",
                        name: "gu",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],
            });
            $("body").on("click", ".delete", function() {
                var spj_id = $(this).data("id");
                $("#modelHeading").html("Hapus");
                $("#ajaxModel").modal("show");
                $("#hapusBtn").click(function(e) {
                    e.preventDefault();
                    $(this).html(
                        "<span class='spinner-border spinner-border-sm'></span><span class='visually-hidden'><i> menghapus...</i></span>"
                    );
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('spj/destroyed') }}" + '/' + spj_id,
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
                                        "<i class='fa fa-trash'></i>&nbsp;Hapus"
                                    );
                                });
                            } else {
                                table.draw();
                                alertSuccess(data.success);
                                $("#hapusBtn").html(
                                    "<i class='fa fa-trash'></i>&nbsp;Hapus");
                                $('#ajaxModel').modal('hide');
                            }
                        },
                    });
                });
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('.spm').change(function() {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
            $('.gu').change(function() {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
        });
    </script>
@endsection
