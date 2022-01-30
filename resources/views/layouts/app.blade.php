<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Admitro - Admin Panel HTML template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="admin panel ui, user dashboard template, web application templates, premium admin templates, html css admin templates, premium admin templates, best admin template bootstrap 4, dark admin template, bootstrap 4 template admin, responsive admin template, bootstrap panel template, bootstrap simple dashboard, html web app template, bootstrap report template, modern admin template, nice admin template"/>

    <!-- Title -->
    <title>Login | Admin</title>

    <!--Favicon -->
    <link rel="icon" href="{{asset('assets/backend_assets/images/brand/favicon.ico')}}" type="image/x-icon"/>

    <!--Bootstrap css -->
    <link href="{{asset('assets/backend_assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{asset('assets/backend_assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/backend_assets/css/dark.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/backend_assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{asset('assets/backend_assets/css/animated.css')}}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{asset('assets/backend_assets/css/icons.css')}}" rel="stylesheet" />

    <!-- Color Skin css -->
    <link id="theme" href="{{asset('assets/backend_assets/colors/color1.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body class="h-100vh page-style1 dark-mode">

    <div class="page">
        <div class="page-single">
            <div class="p-5">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-lg-9 col-xl-8">
                                <div class="card-group mb-0">
                                    <div class="card p-4">
                                        <div class="card-body">
                                            <div class="text-center title-style mb-6">
                                                <h1 class="mb-2">Login</h1>
                                                <hr style="margin-top: 3rem; margin-bottom: 1rem;">
                                            </div>
                                            <div class="btn-list d-flex">
                                                <a href="https://www.google.com/gmail/" class="btn btn-google btn-block"><i class="fa fa-google fa-1x mr-2"></i> Google</a>
                                                <a href="https://twitter.com/" class="btn btn-twitter"><i class="fa fa-twitter fa-1x"></i></a>
                                                <a href="https://www.facebook.com/" class="btn btn-facebook"><i class="fa fa-facebook fa-1x"></i></a>
                                            </div>
                                            <hr class="divider my-6">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fe fe-user"></i>
                                                        </div>
                                                    </div>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fe fe-lock"></i>
                                                        </div>
                                                    </div>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn  btn-primary btn-block px-4">Login</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <a href="forgot-password.html" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card text-white bg-primary py-5 d-md-down-none page-content mt-0">
                                        <div class="text-center justify-content-center page-single-content">
                                            <div class="box">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                            <img src="{{asset('assets/backend_assets/images/png/login.png')}}" alt="img">
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

    <!-- Jquery js-->
    <script src="{{asset('assets/backend_assets/js/jquery-3.5.1.min.js')}}"></script>

    <!-- Bootstrap4 js-->
    <script src="{{asset('assets/backend_assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/backend_assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!--Othercharts js-->
    <script src="{{asset('assets/backend_assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

    <!-- Circle-progress js-->
    <script src="{{asset('assets/backend_assets/js/circle-progress.min.js')}}"></script>

    <!-- Jquery-rating js-->
    <script src="{{asset('assets/backend_assets/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!-- Custom js-->
    <script src="{{asset('assets/backend_assets/js/custom.js')}}"></script>

</body>
</html>
