@include('auth.layouts-log.head')

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(dist/login/images/hero-bg3.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex justify-content-center">
                                <img src="dist/login/images/logobb.png" style="width:100px">
                            </div>
                            <div class="w-100 text-center">
                                <h3>Sipenaku</h3>

                            </div>

                            <form action="{{ route('login') }}" class="signin-form" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name"><i class="fa fa-user"></i> Username</label>
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Username" value="{{ old('username') }}" required>
                                    @error('username')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password"><i class="fa fa-lock"></i> Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" required>

                                    @error('password')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        In</button>
                                </div>
                                <div class="copyright text-center mt-4">
                                    © 2023
                                    <span> <a href="#" target="_blank">Bagian Keuangan
                                            Setdakab Batubara</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h4><strong>Administrator</strong></h4>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                    autofocus value="{{ old('username') }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            @error('username')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            @error('password')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    @include('auth.layouts-log.js')
