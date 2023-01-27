@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Bagian</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                        <a href="{{ 'bagian' }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Account User</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-check"></i>
                        </div>
                        <a href="{{ 'user' }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Kegiatan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                        <a href="{{ 'kegiatan' }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Sub Kegiatan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                        <a href="{{ 'sub-kegiatan' }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
    </section>
@endsection
