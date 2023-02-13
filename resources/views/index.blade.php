@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container-fluid" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>{{ old('nama_aplikasi', $appsetting->nama_aplikasi) }}</h1>
                    <h2></h2>
                    <div><a href="{{ '/login' }}" class="btn-get-started scrollto">Get Started</a></div>
                </div>
                <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
                    <img src="{{ url('front/img/features.svg') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <section id="visi-misi" class="about">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-3 order-1 order-lg-1" data-aos="zoom-in" data-aos-delay="150">
                        <img src="{{ url('front/img/logobb.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-4 pt-4 pt-lg-0 order-2 order-lg-2 content" data-aos="fade-right">
                        <h3 class="mb-4">Visi Pemerintah Kab.Batu Bara</h3>
                        <ul>
                            <li>Menjadikan masyarakat Kabupaten Batub Bara Masyarakat Industri yang Sejahtera,
                                Mandiri dan Berbudaya</li>
                        </ul>
                    </div>
                    <div class="col-lg-4 pt-4 pt-lg-0 order-2 order-lg-2 content" data-aos="fade-right">
                        <h3 class="mb-4">Misi Pemerintah Kab.Batu Bara</h3>
                        <ul>
                            <li>Meningkatkan Pelayanan Aparatur Pemerintah atas Pelayanan Publik dan Investasi
                            </li>
                            <li> Meningkatkan Jumlah dan Kualitas Infrastruktur dan Sarana Prasarana pendukung pertumbuhan
                                Industri dan Perekonomian Masyarakat</li>
                            <li>Mewujudkan Masyarakat yang Produktif, Inovatif dan Berbu. . .
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="btn-more d-flex align-items-center justify-content-center">
                    <a href="https://batubarakab.go.id/pages/visi-dan-misi" class="read-more">Read More <i
                            class="bi bi-long-arrow-right"></i></a>
                </div>
            </div>
        </section>
        <section id="features" class="services section-bg">
            <div class="section-tittle">
                <h3>Features</h3>
            </div>
            <div class="row-card">
                <div class="cardpokersize">
                    <img src="{{ url('front/img/undraw_booking_re_gw4j.svg') }}">
                    <h3>Perencanaan Lima Tahunan</h3>
                    <p>Input data perencanaan lima tahunan yang dilakukan oleh fungsi perencana pada Pemerintah Daerah
                    </p>
                </div>
                <div class="cardpokersize">
                    <img src="{{ url('front/img/undraw_investing_re_bov7.svg') }}">
                    <h3>Perencanaan Tahunan</a></h3>
                    <p>nput data perencanaan tahunan yang dilakukan oleh fungsi perencana pada Pemerintah Daerah</p>
                </div>
                <div class="cardpokersize">
                    <img src="{{ url('front/img/undraw_printing_invoices_-5-r4r.svg') }}">
                    <h3>Penganggaran</h3>
                    <p>Input data penganggaran yang dilakukan oleh fungsi penganggaran pada Pemerintah Daerah</p>
                </div>
                <div class="cardpokersize">
                    <img src="{{ url('front/img/features.svg') }}">
                    <h3>Penatausahaan</h3>
                    <p>Input seluruh transaksi keuangan baik penerimaan dan pengeluaran dalam satu tahun anggaran yang
                        dilakukan oleh fungsi penatausahaan pada Pemerintah Daerah</p>
                </div>
                <div class="cardpokersize">
                    <img src="{{ url('front/img/undraw_data_re_80ws.svg') }}">
                    <h3>Pelaporan</h3>
                    <p>Menghasilkan laporan keuangan Pemerintah Daerah berupa Laporan Realisasi Anggaran, Laporan
                        Operasional, Neraca, Laporan perubahan ekuitas, Catatan atas laporan keuangan, Laporan Perubahan
                        SAL, Laporan Arus Kas.</p>
                </div>
                <div class="cardpokersize">
                    <img src="{{ url('front/img/sakip.svg') }}">
                    <h3>S A K I P</h3>
                    <p>Input kinerja Pemerintah Daerah sesuai dengan pertanggungjawaban yang ada</p>
                </div>

            </div>
        </section>
    </main>
@endsection
