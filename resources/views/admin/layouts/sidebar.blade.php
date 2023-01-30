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
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari" aria-label="Search">
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
                    <a href="{{ '/dashboard' }}" class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}">
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
                            <a href="pages/charts/uplot.html"
                                class="nav-link {{ request()->segment(1) == 'kartu-kendali' ? 'active' : '' }}">
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
                    <a href="{{ 'setting' }}"
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
