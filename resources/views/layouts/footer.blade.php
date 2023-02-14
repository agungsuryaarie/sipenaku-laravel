<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container-footer">
            <div class="row-footer">
                <div class="col-lg-4 col-md-6 footer-contact">
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="{{ url('front/img/logo-sipenaku-white.png') }}"class="img-fluid mb-3" style="width:45%"
                            alt="">
                        <b> V.2.0</b>
                    </div>
                    <p>{{ old('keterangan_aplikasi', $appsetting->keterangan_aplikasi) }}</p>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Pemerintah Kabupaten Batu bara</h4>
                    <p>Jl. Perintis Kemerdekaan, Lima Puluh Kota, Kec. Lima Puluh, Kabupaten Batu Bara, Sumatera Utara
                        21255</p>
                </div>

            </div>
        </div>
    </div>

    <div class="container-footer">
        <div class="copyright-wrap d-md-flex py-4">
            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    Copyright &copy; 2023 | Hak Cipta Dilindungi
                </div>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ url('front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ url('front/vendor/aos/aos.js') }}"></script>
<script src="{{ url('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('front/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ url('front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ url('front/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ url('front/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ url('front/js/main.js') }}"></script>

</body>

</html>
