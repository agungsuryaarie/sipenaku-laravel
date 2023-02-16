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
                        <div class="card-header">
                            <a href="{{ route('spj.create') }}" class="btn btn-info btn-sm float-right btn-rounded">
                                <i class="fa fa-paper-plane"></i> Upload Pengajuan</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kegiatan</th>
                                        <th>Sub Kegiatan</th>
                                        <th>Rekening</th>
                                        <th>Uraian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @php $no = 1; @endphp
                                    @foreach ($spj as $s)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ $s->kegiatan->kode_kegiatan }} {{ $s->kegiatan->nama_kegiatan }}</td>
                                            <td>{{ $s->subkegiatan->kode_sub }} {{ $s->subkegiatan->nama_sub }}</td>
                                            <td>{{ $s->rekening->kode_rekening }} {{ $s->rekening->nama_rekening }}</td>
                                            <td>{{ $s->uraian }}</td>
                                            <td>
                                                @if ($s->status == 1)
                                                    <form action="{{ route('spj.kirim', $s->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-xs">Kirim</button>
                                                    </form>
                                                @elseif ($s->status == 2)
                                                    <span class="btn btn-warning btn-xs">
                                                        Verifikasi
                                                    </span>
                                                @elseif ($s->status == 3)
                                                    <span class="btn btn-danger btn-xs">
                                                        Ditolak
                                                    </span>
                                                @else
                                                    <span class="btn btn-success btn-xs">
                                                        Diterima
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('spj.destroy', $s->id) }}" method="POST">
                                                    <a class="btn btn-primary btn-xs"
                                                        href="{{ route('spj.edit', $s->id) }}">
                                                        <i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                </tbody>
                            </table>
                        </div>
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
                ajax: "{{ route('spj.index') }}",
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
                        data: "status",
                        name: "status",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],
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

            $("body").on("click", ".kirim", function() {
                var spj_id = $(this).data("id");
                $.ajax({
                    type: "POST",
                    url: "{{ url('spj/kirim') }}" + '/' + spj_id,
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertSuccess("SPJ Berhasil di kirim");
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
