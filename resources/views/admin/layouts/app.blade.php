<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIPENAKU</title>
    <link rel="icon" href="{{ url('dist/img/logo.png') }}" type="image/x-icon" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ '/' }}" class="brand-link">
                <img src="{{ url('dist/img/logo.png') }}" alt="Logo Batu Bara" class="brand-image ml-5">
                <span class="brand-text font-weight-light"><b>SIPENAKU</b></span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-1 d-flex">
                    <div class="image">
                        <img src="{{ url('dist/img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Administrator</a>
                        <small class="text-muted">
                            Administrator
                        </small>
                    </div>
                </div>
                <center>
                    <small class="text-white badge badge-success mb-2">
                        {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} |
                        <span id="jam"></span></small>
                </center>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Cari"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ '/dashboard' }}"
                                class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ request()->segment(1) == 'user' ||
                            request()->segment(1) == 'bagian' ||
                            request()->segment(1) == 'kegiatan' ||
                            request()->segment(1) == 'sub-kegiatan' ||
                            request()->segment(1) == 'rekening' ||
                            request()->segment(1) == 'kartu-kendali'
                                ? 'menu-open'
                                : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->segment(1) == 'user' ||
                                request()->segment(1) == 'bagian' ||
                                request()->segment(1) == 'kegiatan' ||
                                request()->segment(1) == 'sub-kegiatan' ||
                                request()->segment(1) == 'rekening' ||
                                request()->segment(1) == 'kartu-kendali'
                                    ? 'active'
                                    : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>
                                    Master Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}"
                                        class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('bagian.index') }}"
                                        class="nav-link {{ request()->segment(1) == 'bagian' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bagian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('kegiatan.index') }}"
                                        class="nav-link {{ request()->segment(1) == 'kegiatan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Anggaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('kartukendali.index') }}"
                                        class="nav-link {{ request()->segment(1) == 'kartukendali' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kartu Kendali</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->segment(1) == 'spj' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    SPJ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.index') }}"
                                class="nav-link {{ request()->segment(1) == 'setting' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                        <div class="user-panel mt-3">
                        </div>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>



        <div class="content-wrapper">
            <div id="alerts"></div>
            @yield('content')
        </div>
        @extends('admin.layouts.footer')
    </div>
