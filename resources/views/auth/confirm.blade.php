@extends('layouts.master-without-nav')

@section('title')
Conformation Code
@endsection

@section('css')
<!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('build/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
@endsection

@section('body')

<body class="auth-body-bg" >
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
                                    <div class="row">
                                        <div class="col-md-12" style="padding:30px 0px 0px 0px;">
                                            <h5 class="text-center">DO NOT CLOSE THIS WINDOW</h5>
                                            <p class="text-left">Dear User,</p>
                        
                                            <p class="text-left" style="font-size:13px; font-weight:normal;">As part of our security practices, we will need you to confirm your email. Kindly look for an email from verify@optimizeit.ai, which sometimes may end up in your spam folder. Once you located the email, please get the confirmation code, and put it below to login. This is a onetime activity to confirm your email.</p>
                        
                                            <p class="text-left"><span style="font-size:13px; font-weight:normal;"> Thank you for signing up, we are sure you will find our solution meet your needs.</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <h3 class="text-center">Verification</h3>

                            <form method='post' action='{{url('confirmation')}}'>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="split-reset-password">Email</label>
                                    <input type="text" class="form-control" name='email' value='{{Request::get('email')}}'
                                        readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="split-reset-confirm-password">Verification Code</label>
                                    <input class="form-control" type="text" name='confirmation' />
                                </div>
                                 @error('error')<p class="text-danger alertmsg mb-2 mb-3">{{$message}}</p>@enderror

                                <div class="mb-3" id="regbox" align="center">
                                    <input type='hidden' name='action' value='confirm' />
                                    <button class="btn btn-primary waves-effect waves-light"
                                        type="submit">Verify</button>
                                </div>
                            </form>

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
   
    @endsection
