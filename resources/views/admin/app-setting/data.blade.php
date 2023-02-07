@extends('admin.layouts.app')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $menu }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="float-right">
                                <a href="{{ route('appsetting.edit', $appsetting->id) }}"
                                    class="btn btn-warning btn-xs text-white">
                                    <i class="fa fa-edit">
                                    </i>Edit</a>
                            </div>
                        </div>
                        <div class=" table-responsive">
                            <table class="table">
                                <tr>
                                    <td style="width:4%">
                                        Nama Aplikasi
                                    </td>
                                    <td style="width:0%">
                                        :
                                    </td>
                                    <td style="width:20%">
                                        {{ $appsetting->nama_aplikasi }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Keterangan Aplikasi
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $appsetting->keterangan_aplikasi }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Visi kab. Batu Bara
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {!! $appsetting->visi !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Misi kab. Batu Bara
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {!! $appsetting->misi !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Logo Aplikasi
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        <img class="profile-user-img img-fluid"
                                            src="{{ url('storage/logo/' . $appsetting->gambar) }}"
                                            alt="User profile picture">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid"
                                    src="{{ url('storage/logo/' . $appsetting->gambar) }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center mb-5"></h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nama Aplikasi</b> <a class="float-right">{{ $appsetting->nama_aplikasi }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Keterangan Aplikasi</b> <a
                                        class="float-right">{{ $appsetting->keterangan_aplikasi }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Visi kab. Batu Bara</b> <a class="float-right">{{ $appsetting->visi }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Misi kab. Batu Bara</b> <a class="float-right">{{ $appsetting->misi }}</a>
                                </li>
                            </ul>

                            <a href="{{ route('appsetting.edit', $appsetting->id) }}"
                                class="btn btn-primary btn-sm float-right" title="Edit"><i class="fa fa-edit">
                                </i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection
