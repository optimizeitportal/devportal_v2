@extends('layouts.master-without-nav')

@section('title')
@lang('translation.Login')
@endsection

@section('css')
<!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('build/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
@endsection

@section('body')

<body class="auth-body-bg">
    @endsection

    @section('content')

    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">

                                                <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">5k</span>+ Satisfied clients</h4>

                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" Fantastic theme with a
                                                                    ton of options. If you just want the HTML to
                                                                    integrate with your project, then this is the
                                                                    package. You can find the files in the 'dist'
                                                                    folder...no need to install git and all the other
                                                                    stuff the documentation talks about. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">Abs1981</h4>
                                                                    <p class="font-size-14 mb-0">- Optimize it User</p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" If Every Vendor on Envato
                                                                    are as supportive as Themesbrand, Development with
                                                                    be a nice experience. You guys are Wonderful. Keep
                                                                    us the good work. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">nezerious</h4>
                                                                    <p class="font-size-14 mb-0">- Optimize it User</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                
                                <div class="my-auto">

                                    <div class="mb-4 mb-md-5 auth-logo-box">
                                        <a href="{{url('/')}}" class="d-block auth-logo ">
                                            <img src="{{ asset('images/optimizeit-web-logo.png') }}" alt="" height="45" class="auth-logo-dark">
                                            <img src="{{ asset('images/optimizeit-web-logo.png') }}" alt="" height="45" class="auth-logo-light">
                                        </a>
                                    </div>
                                    <div class="row flex-between-center mt-2">
                                        <div class="col-12">
                                            <h3>Login</h3>
                                        </div>
                                        <div class="col-12 fs--1 text-600"><span class="mb-0 fw-semi-bold">New User?</span> <span><a class="lglink" href="{{ url('signup') }}">Create account</a></span></div>
                                    </div>
                                    <div class="mt-4">
                                        @if(session('succes_massage')) <p class="text-success alertmsg" id="infomsg">{{session('succes_massage')}}</p>@endif
                                        <form class="form-horizontal" method="POST" action="{{ url('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="useremail" placeholder="Enter Email" autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                
                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                <div class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                                    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword" value="" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="text-end mt-2 mb-2">
                                                    <a href="{{ url('/forgotpassword') }}">Forgot password?</a>
                                                </div>
                                            </div>

                                            {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    Remember me
                                                </label>
                                            </div> --}}
                                            @error('error')<p class="text-danger alertmsg mb-2" id="werrmsg">{{$message}}@enderror
                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">Log
                                                    In</button>
                                            </div>

                                        </form>
                                        {{-- <div class="mt-5 text-center">
                                            <p>Don't have an account ? <a href="" class="fw-medium text-primary"> Signup now </a> </p>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())
                                        </script> Optimize it.</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    @endsection
    @section('script')
    <!-- owl.carousel js -->
    <script src="{{ asset('build/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <!-- auth-2-carousel init -->
    <script src="{{ asset('build/js/pages/auth-2-carousel.init.js') }}"></script>
    <script>document.documentElement.setAttribute("data-bs-theme", "light");</script>
    <script>
        var myEfield = document.getElementById("useremail");
        myEfield.onkeyup = function() {
        document.getElementById("werrmsg").style.display = "none";
        }
        myEfield.onfocus = function() {
        document.getElementById("infomsg").style.display = "none";
        window.location.href = "./";
        }
    </script>
    @endsection
