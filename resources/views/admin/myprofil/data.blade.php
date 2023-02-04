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
                        <li class="breadcrumb-item"><a href="{{ '/dahboard' }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username">{{ $user->nama }}</h3>
                                <h5 class="widget-user-desc">{{ $user->bagian->nama_bagian }}</h5>
                            </div>
                            <div class="widget-user-image">
                                @if ($user->foto == null)
                                    <img src="{{ url('fotouser/blank.png') }}" class="img-circle elevation-2"
                                        alt="User Avatar">
                                @else
                                    <img src="{{ url('fotouser/blank.png') }}" class="img-circle elevation-2"
                                        alt="User Avatar">
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 text-center">
                                    <div class="description-block mt-5 mb-4">
                                        <h5 class="description-header">200</h5>
                                        <span class="description-text">SPJ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-user"></i> Profil Saya
                                        <div class="float-right">
                                            <a href="#" class="btn btn-warning btn-xs text-white" title="Ubah Profil"
                                                data-toggle="modal" data-target="#modal-lg-p{{ $user->id }}">
                                                <i class="fa fa-edit">
                                                </i>
                                            </a>
                                            <a href="#" class="btn btn-warning btn-xs text-white"
                                                title="Ubah Password" data-toggle="modal"
                                                data-target="#modal-lg-ps{{ $user->id }}">
                                                <i class="fa fa-key">
                                                </i>
                                            </a>
                                            <a href="#" class="btn btn-warning btn-xs text-white" title="Ubah Foto"
                                                data-toggle="modal" data-target="#modal-lg-f{{ $user->id }}">
                                                <i class="fa fa-camera">
                                                </i>
                                            </a>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col mt-4">
                                <h6><b>Nama</b></h6>
                                <span>{{ $user->nama }}</span>
                                <h6 class="mt-2"><b>Email</b></h6>
                                <span>{{ $user->email }}</span>
                                <h6 class="mt-2"><b>Username</b></h6>
                                <span>{{ $user->username }}</span>
                                <h6 class="mt-2"><b>Nomor Handphone</b></h6>
                                <span>{{ $user->nohp }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
