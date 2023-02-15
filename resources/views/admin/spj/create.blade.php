@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SPJ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('spj.index') }}">SPJ</a></li>
                        <li class="breadcrumb-item active">Tambah SPJ</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Form Input SPJ</h3>
                    </div>
                    <form action="{{ route('spj.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body-form">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kegiatan<span class="text-danger"> *</span></label>
                                <select class="form-control select2bs4 @error('kegiatan_id') is-invalid @enderror"
                                    id="kegiatan" name="kegiatan_id" style="width: 100%;">
                                    <option value="">::Pilih::</option>
                                    @foreach ($kegiatan as $keg)
                                        <option value="{{ $keg->id }}"
                                            {{ $keg->id == old('kegiatan_id') ? 'selected' : '' }}>
                                            {{ $keg->nama_kegiatan }}</option>
                                    @endforeach
                                </select>
                                @error('kegiatan_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Sub Kegiatan<span class="text-danger"> *</span></label>
                                <select id="subkeg" name="subkegiatan_id"
                                    class="form-control select2bs4 @error('subkegiatan_id') is-invalid @enderror">
                                </select>
                                @error('subkegiatan_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Rekening Belanja<span class="text-danger"> *</span></label>
                                <select id="rekening" name="rekening_id"
                                    class="form-control select2bs4 @error('rekening_id') is-invalid @enderror">
                                </select>
                                @error('rekening')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Uraian<span class="text-danger"> *</span></label>
                                <textarea name="uraian" class="form-control @error('uraian') is-invalid @enderror" rows="3">{{ old('uraian') }}</textarea>
                                @error('uraian')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nilai Kwitansi<span class="text-danger"> *</span></label>
                                <input name="kwitansi" type="text"
                                    class="form-control @error('kwitansi') is-invalid @enderror" placeholder="Rp."
                                    value="{{ old('kwitansi') }}">
                                @error('kwitansi')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Rekanan/Penerima<span class="text-danger"> *</span></label>
                                <input name="nama_penerima" type="text"
                                    class="form-control @error('nama_penerima') is-invalid @enderror"
                                    value="{{ old('nama_penerima') }}">
                                @error('nama_penerima')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat Penerima<span class="text-danger"> *</span></label>
                                <textarea name="alamat_penerima" class="form-control  @error('alamat_penerima') is-invalid @enderror" rows="3">{{ old('alamat_penerima') }}</textarea>
                                @error('alamat_penerima')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis SPM<span class="text-danger"> *</span></label>
                                <div class="radio-btn">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="1" id="jenis_spm1"
                                            name="jenis_spm" {{ old('jenis_spm') == '1' ? 'checked' : '' }}>
                                        <label for="jenis_spm1" class="custom-control-label">GU</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="2" id="jenis_spm2"
                                            name="jenis_spm" {{ old('jenis_spm') == '2' ? 'checked' : '' }}>
                                        <label for="jenis_spm2" class="custom-control-label">TU</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="3" id="jenis_spm3"
                                            name="jenis_spm" {{ old('jenis_spm') == '3' ? 'checked' : '' }}>
                                        <label for="jenis_spm3" class="custom-control-label">LS</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="4" id="jenis_spm4"
                                            name="jenis_spm" {{ old('jenis_spm') == '4' ? 'checked' : '' }}>
                                        <label for="jenis_spm4" class="custom-control-label">UP</label>
                                    </div>
                                </div>
                                @error('jenis_spm')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Upload File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="customFile"
                                        required>
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
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
        $(function() {
            bsCustomFileInput.init();
        });
        $(document).ready(function() {
            $('#kegiatan').on('change', function() {
                var idKegiatan = this.value;
                $("#subkeg").html('');
                $.ajax({
                    url: "{{ route('spj.getsubkeg') }}",
                    type: "POST",
                    data: {
                        kegiatan_id: idKegiatan,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#subkeg').html('<option value="">Pilih Sub Kegiatan</option>');
                        $.each(result.subkeg, function(key, value) {
                            $("#subkeg").append('<option value="' + value
                                .id + '">' + value.nama_sub + '</option>');
                        });
                    }
                });
            });

            $('#subkeg').on('change', function() {
                var idSubkeg = this.value;
                console.log(idSubkeg);
                $("#rekening").html('');
                $.ajax({
                    url: "{{ route('spj.getrekening') }}",
                    type: "POST",
                    data: {
                        subkeg_id: idSubkeg,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#rekening').html('<option value="">Pilih Rekening</option>');
                        $.each(result.rekening, function(key, value) {
                            $("#rekening").append('<option value="' + value
                                .id + '">' + value.nama_rekening + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
