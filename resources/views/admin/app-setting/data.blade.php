@extends('admin.layouts.app')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a href="#" class="btn btn-info btn-xs"data-toggle="modal" data-target="#modal-lg">
                                <i class="fa fa-edit">
                                </i>&nbsp;Setting</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class=" table-responsive">
                            <table class="table">
                                <tr>
                                    <td rowspan="4" style="width:4%">
                                        <span class="badge badge-primary btn-sm"
                                            style="display:flex; align-items:center; margin:auto">GU
                                            1</span>
                                    </td>
                                    <td style="width:4%">
                                        Tanggal Mulai
                                    </td>
                                    <td style="width:0%">
                                        :
                                    </td>
                                    <td style="width:20%">
                                        26-01-2023
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal Selesai
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        26-01-2023
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jam Mulai
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        08.00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jam Selesai
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        16.00
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Setting</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Pilih GU</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">::Pilih::</option>
                                            <option>Alaska</option>
                                            <option>California</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Mulai</label>
                                                <input type="date" class="form-control" id="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Selesai</label>
                                                <input type="date" class="form-control" id="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>jam Mulai</label>
                                                <input type="time" class="form-control" id="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jam Selesai</label>
                                                <input type="time" class="form-control" id="" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer float-right">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </section>
@endsection
