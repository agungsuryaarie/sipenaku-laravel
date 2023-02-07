@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SPJ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">SPJ</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row-form">
                <div class="col-md-11">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Input SPJ</h3>
                        </div>
                        <form>
                            <div class="card-body-form">
                                <div class="form-group">
                                    <label>Kegiatan<span class="text-danger"> *</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;">
                                        <option selected="selected">::Pilih::</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Kegiatan<span class="text-danger"> *</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;">
                                        <option selected="selected">::Pilih::</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Rekening Belanja<span class="text-danger"> *</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;">
                                        <option selected="selected">::Pilih::</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Uraian<span class="text-danger"> *</span></label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nilai Kwitansi<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="" placeholder="Rp.">
                                </div>
                                <div class="form-group">
                                    <label>Nama Rekanan/Penerima<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Alamat Penerima<span class="text-danger"> *</span></label>
                                    <textarea class="form-control" rows="3" placeholder="ketik alamat ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jenis SPM<span class="text-danger"> *</span></label>
                                    <div class="radio-btn">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1"
                                                name="customRadio">
                                            <label for="customRadio1" class="custom-control-label">GU</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2"
                                                name="customRadio">
                                            <label for="customRadio2" class="custom-control-label">TU</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio3"
                                                name="customRadio">
                                            <label for="customRadio3" class="custom-control-label">LS</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio4"
                                                name="customRadio">
                                            <label for="customRadio4" class="custom-control-label">UP</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis SPJ<span class="text-danger"> *</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;">
                                        <option selected="selected">::Pilih::</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload File</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
