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
                        <!-- form start -->
                        <form method="POST" action="{{ route('appsetting.store') }}"enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Aplikasi</label>
                                    <input type="text" class="form-control" name="nama_aplikasi"
                                        placeholder="Nama Aplikasi" autocomplete="off" value="">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan Aplikasi</label>
                                    <input type="text" class="form-control" name="keterangan_aplikasi"
                                        placeholder="Keterangan Aplikasi" autocomplete="off" value="">
                                </div>
                                <div class="form-group">
                                    <label>Visi Kab. Batu Bara</label>
                                    <textarea name="visi" id="texteditor1" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Misi Kab. Batu Bara</label>
                                    <textarea name="misi" id="texteditor2" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Logo Website</label>
                                    <input type="file" class="form-control" type="text" name="gambar">
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

@section('script')
    <script>
        $(function() {
            // Summernote
            $('#texteditor1').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
        $(function() {
            // Summernote
            $('#texteditor2').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
@endsection
