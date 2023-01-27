@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ '/' }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                        <a href="#" class="btn btn-info btn-xs">
                            <i class="fa fa-edit">
                            </i>&nbsp;Setting</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" table-responsive table-hover">
                        <table class="table">
                            <tr>
                                <td rowspan="4" style="width:4%">
                                    <span class="badge badge-primary btn-sm">GU
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
@endsection
