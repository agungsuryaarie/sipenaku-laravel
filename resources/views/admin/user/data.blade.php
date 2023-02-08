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
                            <a href="javascript:void(0)" id="createNewUser" class="btn btn-info btn-xs float-right">
                                <i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th style="width:5%">No</th>
                                        <th>Bagian</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th class="text-center">Foto</th>
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
                    <form id="userForm" name="userForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bagian<span class="text-danger"> *</span></label>
                                        <select class="browser-default custom-select select2bs4" name="bagian_id"
                                            id="bagian_id">
                                            <option selected disabled>Pilih Bagian</option>
                                            @foreach ($bagian as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama_bagian }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            placeholder="NIP" autocomplete="off" value="{{ old('nip') }}" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama" autocomplete="off" value="{{ old('nama') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Handphone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nohp" name="nohp"
                                            placeholder="Nomor Handphone" autocomplete="off" value="{{ old('nohp') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email" autocomplete="off" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Username" autocomplete="off" value="{{ old('username') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Re-Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="repassword" name="repassword"
                                            placeholder="Re-Password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Level<span class="text-danger"> *</span></label>
                                        <select name="level" id="level" class="form-control select2bs4"
                                            style="width: 100%;">
                                            <option selected disabled>{{ old('level', '..::Pilih Level::..') }}
                                            <option value="2">User Bagian</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="saveBtn"
                                value="create">Simpan</button>
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
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'bagian',
                        name: 'bagian.nama_bagian'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $("#createNewUser").click(function() {
                $("#saveBtn").val("create-user");
                $("#user_id").val("");
                $("#userForm").trigger("reset");
                $("#modelHeading").html("Tambah User");
                $("#ajaxModel").modal("show");
                $("#deleteUser").modal("show");
            });

            $("body").on("click", ".editUser", function() {
                var user_id = $(this).data("id");
                $.get("{{ route('user.index') }}" + "/" + user_id + "/edit", function(data) {
                    $("#modelHeading").html("Edit User");
                    $("#saveBtn").val("edit-user");
                    $("#ajaxModel").modal("show");
                    $("#user_id").val(data.id);
                    $("#bagian_id").val(data.bagian_id);
                    $("#nip").val(data.nip);
                    $("#nama").val(data.nama);
                    $("#nohp").val(data.nohp);
                    $("#email").val(data.email);
                    $("#username").val(data.username);
                    $("#level").val(data.level);
                });
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html(
                    "<span class='spinner-border spinner-border-sm'></span><span class='visually-hidden'><i> menyimpan...</i></span>"
                );
                $.ajax({
                    data: $("#userForm").serialize(),
                    url: "{{ route('user.store') }}",
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
                                $(".alert-danger").fadeOut(3000);
                                $("#saveBtn").html("Simpan");
                                $('#userForm').trigger("reset");
                            });
                        } else {
                            table.draw();
                            alertSuccess("User Berhasil ditambah");
                            $('#userForm').trigger("reset");
                            $("#saveBtn").html("Simpan");
                            $('#ajaxModel').modal('hide');
                        }
                    },
                });
            });

            $("body").on("click", ".deleteUser", function() {
                var user_id = $(this).data("id");
                confirm("Apakah kamu ingin menghapus data ini ?");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('user.store') }}" + "/" + user_id + "/destroy",
                    data: {
                        _token: "{!! csrf_token() !!}",
                    },
                    success: function(data) {
                        alertDanger("User Berhasil dihapus");
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endsection
