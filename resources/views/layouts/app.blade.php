@include('layouts.head')

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container-header d-flex align-items-center justify-content-between">
            <div class="logo"><img src="{{ url('front/img/logo-sipenaku.png') }}" alt="" class="img-fluid"></div>

            @include('layouts.navbar')

        </div>
    </header>

    {{-- Content --}}
    @yield('content')

    @include('layouts.footer')
