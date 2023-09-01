@extends('layouts.master-without-nav')

@section('title')
    @lang('translation.Register')
@endsection

@section('css')
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('build/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
    {{-- <link href="{{ asset('build/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css"> --}}
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

                                                    <h4 class="mb-3"><i
                                                            class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span
                                                            class="text-primary">5k</span>+ Satisfied clients</h4>

                                                    <div dir="ltr">
                                                        <div class="owl-carousel owl-theme auth-review-carousel"
                                                            id="auth-review-carousel">
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
                                                <h3>Signup</h3>
                                            </div>
                                            <div class="col-12 fs--1 text-600"><span class="mb-0 fw-semi-bold">Have an account?</span> <span><a class="lglink" href="{{ url('/') }}">Login</a></span></div>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" class="form-horizontal" action="{{ url('register') }}" enctype="multipart/form-data">
                                                @csrf


                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" id="name" name="username" autofocus required
                                                        placeholder="Enter name">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Business Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail"
                                                    value="{{ old('email') }}" name="email" placeholder="Enter email" autofocus required>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password"
                                                        placeholder="Enter password" autofocus required>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div id="message" style="display: none">
                                                    <p id="letter" class="invalid">Password must contain a lower case letter</p>
                                                    <p id="capital" class="invalid">Password must contain an upper case letter</p>
                                                    <p id="special" class="invalid">Password must contain a special character</p>
                                                    <p id="number" class="invalid">Password must contain a number</p>
                                                    <p id="length" class="invalid">Password must contain at least 8 characters</p>
                                                  </div>
                                                  @error('email_error')<p class="text-danger alertmsg" id="emailerr">{!!$message!!}</p> @enderror
                                                  @error('error')
                                                     <p class="text-danger alertmsg" id="emailerr">{{$message}}
                                                         @if ($message=='An account with the given email already exists.')
                                                         <a href="{{url('/')}}" class="lglink">Please Login</a>
                                                         @endif
                                                     </p>
                                                   @enderror
                                                  @error('password')<p class="text-danger alertmsg" id="emailerr">{{$message}}</p> @enderror


                                                <div class="mt-4 d-grid">
                                                    <input type="hidden" id="otpcheck" value="">
                                                    <input type='hidden' name='action' value='register' />
                                                    <button class="btn btn-primary waves-effect waves-light"
                                                        type="submit">Register</button>
                                                </div>


                                                {{-- <div class="mt-4 text-center">
                                                    <p class="mb-0">By registering you agree to the Optimize it <a href="#"
                                                            class="text-primary">Terms of Use</a></p>
                                                </div> --}}
                                            </form>


                                        </div>
                                    </div>

                                    <div class="mt-4 mt-md-3 text-center">
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
        {{-- <script src="{{ asset('build/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script> --}}
        <!-- owl.carousel js -->
        <script src="{{ asset('build/libs/owl.carousel/owl.carousel.min.js') }}"></script>
        <!-- auth-2-carousel init -->
        <script src="{{ asset('build/js/pages/auth-2-carousel.init.js') }}"></script>
        <script>document.documentElement.setAttribute("data-bs-theme", "light");</script>
        <script>
            var myEmail = document.getElementById("useremail");
            var myInput = document.getElementById("userpassword");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var special = document.getElementById("special");
            var number = document.getElementById("number");
            var length = document.getElementById("length");
        
            myEmail.onfocus = function() {
            document.getElementById("cagerr").style.display = "none";
            }
            myEmail.onkeyup = function() {
            document.getElementById("emailerr").style.display = "none";
            }
        
            // When the user clicks on the password field, show the message box
            myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
            }
        
            // When the user clicks outside of the password field, hide the message box
            myInput.onblur = function() {
            document.getElementById("message").style.display = "block";
            }
        
            // When the user starts to type something inside the password field
            myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }
        
            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }
        
            var specialchar = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/g;
            if(myInput.value.match(specialchar)) {
                special.classList.remove("invalid");
                special.classList.add("valid");
            } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
            }
        
            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }
        
            // Validate length
            if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
            }
           
        </script>
    @endsection
