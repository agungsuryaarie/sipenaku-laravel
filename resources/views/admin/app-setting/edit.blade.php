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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0)" id="" class="btn btn-info btn-xs float-right">
                                <i class="fas fa-plus-circle"></i> Edit</a>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Aplikasi</label>
                                    <input type="text" class="form-control" name="nama_aplikasi"
                                        value="{{ old('nama_aplikasi', $appsetting->nama_aplikasi) }}"
                                        placeholder="Nama Aplikasi" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan aplikasi</label>
                                    <textarea class="form-control" rows="3" name="keterangan_aplikasi" value="{{ $appsetting->keterangan_aplikasi }}"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Visi Kabupaten Batu Bara</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Misi Kabupaten Batu Bara</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
