@extends('admin.layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard @if (Auth::user()->level == 1)
                            Administrator
                        @else
                            {{ Auth::user()->bagian->nama_bagian }}
                        @endif
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (Auth::user()->level == 1)
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
            @endif
    </section>
    @if (Auth::user()->level == 2)
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="info-box p-3">
                        <div class="image">
                            @if (Auth::user()->foto == null)
                                <img src="{{ url('fotouser/blank.png') }}" class="img-circle elevation-2">
                            @else
                                <img src="{{ url('storage/fotouser/' . Auth::user()->foto) }}"
                                    class="img-circle elevation-2" width="100px">
                            @endif
                        </div>
                        <div class="info-box-content">
                            <span class="info-box-number">{{ Auth::user()->bagian->nama_bagian }}</span>
                            <span class="info-box-number">
                                @if (Auth::user()->level == 2)
                                    @foreach ($kegiatan as $keg)
                                        <p>Anggaran :&nbsp;{{ 'Rp. ' . number_format($keg->pagu, 0, ',', '.') }}</h4>
                                    @endforeach
                                @endif
                            </span>
                        </div>
                        <div class="float-right d-none d-sm-inline-block">
                            @if ($gu != null)
                                @if (date('Y-m-d') > $gu->tgl_mulai ||
                                        (date('Y-m-d') == $gu->tgl_mulai && date('Y-m-d') < $gu->tgl_selesai) ||
                                        (date('Y-m-d') == $gu->tgl_selesai && date('H:i:s') > $gu->jam_mulai && date('H:i:s') < $gu->jam_selesai))
                                    <a href="#" class="btn btn-success btn-round btn-xs mr-2 mb-2">
                                        <i class="fa fa-wallet"></i>&nbsp;&nbsp;{{ $gu->judul }} mulai
                                        {{ \Carbon\Carbon::parse($gu->tgl_mulai)->translatedFormat('l, d F Y') }}
                                        </td> | Pukul : {{ $gu->jam_mulai }} -
                                        {{ \Carbon\Carbon::parse($gu->tgl_selesai)->translatedFormat('l, d F Y') }}
                                        </td> | Pukul : {{ $gu->jam_selesai }}</a>
                                    <a href="#" class="btn btn-danger btn-round btn-xs mb-2"><i
                                            class="fas fa-clock"></i>&nbsp;&nbsp;
                                        <span id="berakhir"></span></a>
                                @else
                                    <a href="#" class="btn btn-success btn-round btn-xs mr-2 mb-2"><i
                                            class="fa fa-wallet"></i>&nbsp;&nbsp;{{ $gu->judul }} mulai
                                        {{ \Carbon\Carbon::parse($gu->tgl_mulai)->translatedFormat('l, d F Y') }}
                                        </td> | Pukul : {{ $gu->jam_mulai }} -
                                        {{ \Carbon\Carbon::parse($gu->tgl_selesai)->translatedFormat('l, d F Y') }}
                                        </td> | Pukul : {{ $gu->jam_selesai }}</a>
                                    <a href="#" class="btn btn-warning btn-round btn-xs mb-2 text-white"><i
                                            class="fas fa-clock"></i>&nbsp;&nbsp;sesi belum dimulai</a>
                                @endif
                            @else
                                <a href="#" class="btn btn-success btn-round btn-xs mr-2 mb-2"><i
                                        class="fa fa-wallet"></i>&nbsp;&nbsp;GU belum dimulai</a>
                                <a href="#" class="btn btn-danger btn-round btn-xs mb-2"><i
                                        class="fas fa-clock"></i>&nbsp;&nbsp;<span id="berakhir"></span></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('script')
    <script>
        @if (!$gu == null)
            var countDownDate4 = new Date("{{ $gu->tgl_selesai }} {{ $gu->jam_selesai }}").getTime();
        @else
            var countDownDate4 = new Date().getTime();
        @endif
        var countdownfunction4 = setInterval(function() {
            var now = new Date().getTime();
            var distance4 = countDownDate4 - now;
            var days4 = Math.floor(distance4 / (1000 * 60 * 60 * 24));
            var hours4 = Math.floor(
                (distance4 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            var minutes4 = Math.floor((distance4 % (1000 * 60 * 60)) / (1000 * 60));
            var seconds4 = Math.floor((distance4 % (1000 * 60)) / 1000);
            document.getElementById("berakhir").innerHTML = "Berakhir dalam " +
                days4 + " hari " + hours4 + " jam " + minutes4 + " menit " + seconds4 + " detik " +
                "lagi . . .";
            if (distance4 < 0) {
                clearInterval(countdownfunction4);
                document.getElementById("berakhir").innerHTML = "sesi telah berakhir";
            }
        }, 1000);
    </script>
@endsection
