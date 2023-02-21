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
                                            class="badge badge-info">{{ $spj->created_at }}</span></span>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table>
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
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" target="blank" class="link-blue text-sm"><i class="fas fa-link mr-1"></i>
                                    File Berkas</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
