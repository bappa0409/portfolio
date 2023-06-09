<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta property="og:image" content="#" />

    <title>Arthor | Home 8</title>
    <!--  favicon -->
    <link rel="shortcut icon" href="{{asset('frontend_assets/img/favicon.png')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,600,700,900" rel="stylesheet">
    <!-- plugins CSS -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/plugins.min.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/app.css')}}">
</head>

<body class="home" data-spy="scroll" data-target="#navbar-nav">
    <!-- =========== Start of Preloader ============ -->
    <div class="pre-laoder">
        <img src="{{asset('frontend_assets/img/diagonal-line-pattern.png')}}" alt="overlay" class="background-image-holder">
        <div id="lineDrawing">
            <div class="demo-content align-center">
                <svg class="svg-sahpe">
                    <g fill="none" fill-rule="evenodd" stroke="#fbc25e" stroke-width="1" class="lines">
                        <!-- Replace your svg code with inside of the "path d=" code-->
                        <path d="
                        M54.2,1.9L102.8,86c1.1,1.8-0.3,4.1-2.4,4.1H75.2c-1,0-1.9-0.5-2.4-1.4L51.8,52.3c-1.1-1.8-3.7-1.8-4.8,0
                        l-6.2,10.8c-0.5,0.9-0.5,1.9,0,2.8L52.6,86c1.1,1.8-0.3,4.1-2.4,4.1H3.3c-2.1,0-3.4-2.3-2.4-4.1L49.5,1.9C50.5,0,53.2,0,54.2,1.9z
                        M50.5,41.3l24.9,43.1c0.5,0.9,1.4,1.4,2.4,1.4h15.1c2.1,0,3.4-2.3,2.4-4.1l-41-71.1c-1.1-1.8-3.7-1.8-4.8,0l-41,71.1
                        c-1.1,1.8,0.3,4.1,2.4,4.1h31.8c2.1,0,3.4-2.3,2.4-4.1l-9.6-16.5c-0.2-0.4-0.2-0.9,0-1.3l12.8-22.5C48.7,40.5,50,40.5,50.5,41.3z"
                            stroke-dasharray="406.8699035644531" style="stroke-dashoffset: 0px; "></path>
                    </g>
                </svg>
            </div>
        </div>

    </div>
    <!-- =========== End of Preloader ============ -->

    <!-- =========== Start of Navigation (main menu) ============ -->
    <header class="navbar navbar-expand-lg navbar-dark position-fixed">
        <div class="container">
            <!-- end navbar-toggler = -->
            <div class="navbar-inner">
                <nav class="flex-row d-lg-flex justify-content-lg-end align-items-lg-center">
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Home
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index-2.html">Home-1</a></li>
                                <li><a class="dropdown-item" href="home-2.html">Home-2</a></li>
                                <li><a class="dropdown-item" href="home-3.html">Home-3</a></li>
                                <li><a class="dropdown-item" href="home-4.html">Home-4</a></li>
                                <li><a class="dropdown-item" href="home-5.html">Home-5</a></li>
                                <li><a class="dropdown-item" href="home-6.html">Home-6</a></li>
                                <li><a class="dropdown-item" href="home-7.html">Home-7</a></li>
                                <li><a class="dropdown-item" href="home-8.html">Home-8</a></li>
                                <li><a class="dropdown-item" href="home-9.html">Home-9</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#story">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#portfolio">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#skills">Skills</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="about.html">About Me/Us</a></li>
                                <li><a class="dropdown-item" href="services.html">Services</a></li>
                                <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Portfolio</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="portfolio-grid.html">Portfolio Grid</a></li>
                                        <li><a class="dropdown-item" href="portfolio-masonry.html">Portfolio Masonry</a></li>
                                        <li><a class="dropdown-item" href="portfolio-masonry-full.html">Portfolio
                                                Masonry Full</a></li>
                                        <li><a class="dropdown-item" href="portfolio-masonry-full-unequal.html">Portfolio
                                                Masonry Unequal</a></li>
                                        <li><a class="dropdown-item" href="portfolio-details-1.html">Portfolio Details
                                                1</a></li>
                                        <li><a class="dropdown-item" href="portfolio-details-2.html">Portfolio Details
                                                2</a></li>
                                        <li><a class="dropdown-item" href="portfolio-details-3.html">Portfolio Details
                                                3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Blog
                                        Pages</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="blog-full.html">Blog Full</a></li>
                                        <li><a class="dropdown-item" href="blog-sidebar-right.html">Blog Sidebar Right</a></li>
                                        <li><a class="dropdown-item" href="blog-sidebar-left.html">Blog Sidebar left</a></li>
                                        <li><a class="dropdown-item" href="blog-details-full.html">Blog Details Full</a></li>
                                        <li><a class="dropdown-item" href="blog-details-sidebar-right.html">Blog
                                                Details Sidebar Right</a></li>
                                        <li><a class="dropdown-item" href="blog-details-sidebar-left.html">Blog Details
                                                Sidebar left</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="coming-soon.html">Coming Soon</a></li>
                                <li><a class="dropdown-item" href="404.html">404 Page</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end of nav menu items -->
                </nav>
            </div>
        </div>
        <span class="site-language">
            <a href="#">ENG</a>
        </span>
    </header>
    <!-- =========== End of Navigation (main menu)  ============ -->

    <!-- =========== Start of Sidebar Navigation (off canvas) ============ -->
    <div>
        <div class="navigations-sidebar">
            <span class="logo-holder">
                <a href="index-2.html" class="brand-logo"><img src="{{asset('frontend_assets/img/brand-logo.png')}}" alt="brand-logo"></a>
            </span>

            <!-- Offcanvas Nav Toggoler -->
            <button class="offcanvas-toggler action action--open" aria-label="Open Menu">
                <span class="offcanvas-toggler-icon"></span>
            </button>

            <!-- Main Nav Toggoler *It's here because it helps to make the responsive nav easier* -->
            <button class="navbar-toggler" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- end of main nav toggler -->


            <div class="navigations-connect">
                <ul>
                    <li><a href="#"><i class="ft ft-facebook"></i></a></li>
                    <li><a href="#"><i class="ft ft-twitter"></i></a></li>
                    <li><a href="#"><i class="ft ft-linkedin"></i></a></li>
                    <li><a href="#"><i class="ft ft-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- end of navigations sidebar -->

        <div class="offcanvas-menu">
            <div class="overlay">
                <img class="background-image-holder" src="{{asset('frontend_assets/img/overlay.png')}}" alt="overlay">
            </div>
            <nav id="ml-menu" class="menu">
                <div class="menu__wrap">
                    <!-- Mainmenu -->
                    <ul data-menu="main" class="menu__level" tabindex="-1" role="menu" aria-label="All">
                        <li class="menu__item " role="menuitem"><a class="menu__link menu__link--current" data-submenu="submenu-1" aria-owns="submenu-1" href="#">Home</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="about.html">About</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="services.html">Services</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" data-submenu="submenu-3" aria-owns="submenu-3" href="#">Portfolio</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" data-submenu="submenu-4" aria-owns="submenu-4" href="#">Blog</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="contact.html">Contact</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="coming-soon.html">Coming Soon</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="404.html">404</a></li>
                    </ul>
                    <!-- Submenu 1 -->
                    <ul data-menu="submenu-1" id="submenu-1" class="menu__level" tabindex="-1" role="menu" aria-label="">
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="index-2.html">HOME FULL IMAGE
                                SLIDER</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-2.html">HOME HLAF IMAGE
                                SLIDER</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-3.html">HOME FULL IMAGE</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-4.html">HOME HALF IMAGE</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-5.html">HOME Video</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-6.html">HOME HALF IMAGE
                                PARTICLE</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-7.html">HOME HALF IMAGE
                                SLIDER PARTICLE</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-8.html">HOME Full IMAGE
                                PARTICLE</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="home-9.html">HOME Full IMAGE
                                SLIDER PARTICLE</a></li>
                    </ul>
                    <!-- Submenu 3 -->
                    <ul data-menu="submenu-3" id="submenu-3" class="menu__level" tabindex="-1" role="menu" aria-label="">
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="portfolio-grid.html">Portfolio
                                Grid</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="portfolio-masonry.html">Portfolio
                                Masonry</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="portfolio-masonry-full.html">Portfolio
                                Masonry Full</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="portfolio-masonry-full-unequal.html">Portfolio
                                Masonry Unequal</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="portfolio-details-1.html">Portfolio
                                Details-1</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="portfolio-details-2.html">Portfolio
                                Details-2</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="portfolio-details-3.html">Portfolio
                                Details-3</a></li>
                    </ul>
                    <!-- Submenu 4 -->
                    <ul data-menu="submenu-4" id="submenu-4" class="menu__level" tabindex="-1" role="menu" aria-label="">
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="blog-full.html">Blog Full</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="blog-sidebar-right.html">Blog
                                Sidebar Right</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="blog-sidebar-left.html">Blog
                                Sidebar Left</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="blog-details-sidebar-left.html">Blog
                                Full Sidebar Left</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="blog-details-full.html">Blog
                                Details Full</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="blog-details-sidebar-right.html">Blog
                                Details Sidebar Right</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="blog-details-sidebar-left.html">Blog
                                Details Sidebar Left</a></li>
                    </ul>
                </div>
            </nav>
            <div class="offcanvas__copyright"> © <span>Arthor</span> 2018, all rights reserved.</div>
        </div>
    </div>
    <!-- =========== End of Sidebar Navigation ============ -->

    <!-- =========== Start of main-wrapper ============ -->
    <div class="main-wrapper">
        <!-- =========== Start of Hero ============ -->
        <section class="cover p-0" id="hero" data-scrollax-parent="true">
            <div class="cover-image" data-scrollax="properties: { 'translateY': '500px'}">
                <img class="background-image-holder" src="{{asset('frontend_assets/img/hero-img-4.jpg')}}" alt="background">
            </div>
            <div class="overlay overlay--pattern">
                <img class="background-image-holder" src="{{asset('frontend_assets/img/diagonal-line-pattern.png')}}" alt="overlay">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cover__content">
                            <div class="content__top"><span></span>Hello<span></span></div>
                            <h1>I’m <span>Jofra</span> Arthor <br> passionate with Design</h1>
                            <p>Passionate about Branding but mostly about App and Web design focused on interfaces and user experience (UI/UX).</p>
                            <div>
                                <a class="btn btn--primary btn--megaEffect" href="#"> See Works
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="quick-contact">
                <span class="quick-contact__text">Contact</span>
                <a class="quick-contact__link" href="mailto:"><i class="ft ft-mail"></i></a>
            </div>
        </section>
        <!-- =========== End of Hero ============ -->

        <!-- =========== Start of Story ============ -->
        <section class="story pb-0" id="story" data-scrollax-parent="true">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 text-center text-sm-left">
                        <div class="story-img-block">
                            <div class="title-overlay title-overlay--vertical" data-scrollax="properties: { 'margin-top': '-100%'}">About</div>
                            <picture class="story__img">
                                <img src="{{asset('frontend_assets/img/about-profile.png')}}" alt="image">
                            </picture>

                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="story-details">
                            <span class="story__mini-title">WHO AM I?</span>
                            <h3>Passionate with Design <br> Mostly ui/ux and Application design</h3>
                            <p>I am a Front-End Developer and UI UX Designer based in Bangladesh. I am director and CEO at Marvel Theme Creative Agency. I am a dreamer and a fanatic of all digital things. I have many years of experience in consulting in
                                all areas of digital. I love minmal design and Biker. I am also an Author an Envato Marketplace.</p>
                            <span class="story__signature">
                                <img class="" src="{{asset('frontend_assets/img/signature.png')}}" alt="signature">
                            </span>
                            <a href="#" class="btn btn--primary btn--sm btn--megaEffect">
                                Download CV </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- =========== End of Story ============ -->

        <!-- =========== Start of Service ============ -->
        <section class="services" id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="card service">
                            <i class="icon ti-paint-bucket"></i>
                            <div class="service__body">
                                <a href="#">
                                    <h5>ui ux Design</h5>
                                </a>
                                <p>tempor incididunt ut labore et dolore magna aliqua. Ut enim adita minim lagbore emit.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card service">
                            <i class="icon ti-vector"></i>
                            <div class="service__body">
                                <a href="#">
                                    <h5>iOS App Design</h5>
                                </a>
                                <p>tempor incididunt ut labore et dolore magna aliqua. Ut enim adita minim lagbore emit.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card service">
                            <i class="icon ti-camera"></i>
                            <div class="service__body">
                                <a href="#">
                                    <h5>Web Development</h5>
                                </a>
                                <p>tempor incididunt ut labore et dolore magna aliqua. Ut enim adita minim lagbore emit.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End of Service ============ -->

        <!-- =========== Start of Facts ============ -->
        <section class="facts" data-scrollax-parent="true">
            <div class="bg-image" data-scrollax="properties: { 'background-position-y': '-100%'}"><img class="background-image-holder" src="{{asset('frontend_assets/img/facts.jpg')}}" alt="background-image"></div>
            <div class="overlay">
                <img class="background-image-holder" src="{{asset('frontend_assets/img/overlay.png')}}" alt="overlay">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="facts-inner background-dark" data-scrollax="properties: { 'translateY': '20%'}">
                            <div class="section-title">
                                <span class="title-overlay" data-scrollax="properties: { translateY: '-250px' }">
                                    Funfact
                                </span>
                                <h3 class="section-title__main">Lets See Some <br> Funfacts About me</h3>
                                <p class="section-title__description">Over 10 Years Expericences i am work with business & provide solution to client with their business problem</p>
                            </div>
                            <ul class="facts-items">
                                <li class="fact">
                                    <i class="icon ti-user"></i>
                                    <span class="fact__title">Happy Clients</span>
                                    <span class="fact__value" data-value="378">00</span>
                                </li>
                                <li class="fact">
                                    <i class="icon ti-blackboard"></i>
                                    <span class="fact__title">Project Complete</span>
                                    <span class="fact__value" data-value="532">00</span>
                                </li>
                                <li class="fact">
                                    <i class="icon ti-cup"></i>
                                    <span class="fact__title">Cups of tea</span>
                                    <span class="fact__value" data-value="812">00</span>
                                </li>

                                <li class="fact">
                                    <i class="icon ti-user"></i>
                                    <span class="fact__title">ti-crown</span>
                                    <span class="fact__value" data-value="812">00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End of Facts ============ -->

        <!-- =========== Start of Portfolio ============ -->
        <section class="portfolio" id="portfolio" data-scrollax-parent="true">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <span class="title-overlay" data-scrollax="properties: { translateY: '-150px' }">
                                Portfolio
                            </span>
                            <h2 class="section-title__main">Featured Work</h2>
                            <p class="section-title__description">Over 10 Years Expericences i am work with business & provide solution to client with their business problem</p>
                        </div>
                        <!-- section title end -->

                        <!-- swiper-navigation -->
                        <div class="swiper-navigation">
                            <div class="swiper-button-prev">PREV</div>
                            <div class="swiper-button-next">NEXT</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-1.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-1.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-2.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-2.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-3.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-3.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-4.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-4.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-2.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-2.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-1.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-1.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-2.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-2.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-3.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-3.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-4.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-4.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-inner-image">

                                <a class="slide-inner__lightbox" data-gall="portfolio-gall" href="{{asset('frontend_assets/img/portfolio-2.png')}}">
                                    <i class="ft ft-image"></i>
                                </a>
                                <!-- lightbox item end-->

                                <img src="{{asset('frontend_assets/img/portfolio-2.png')}}" alt="portfolio">
                            </div>
                            <!-- main thumbnail end -->
                            <div class="slide-inner-meta">
                                <div class="slide-inner__category">
                                    <span>Design</span>
                                    <span>Illustration</span>
                                </div>
                                <a href="#" class="slide-inner__title">Visual Oil Painting</a>
                            </div>
                            <!-- item description end -->
                        </div>
                    </div>
                    <!-- single slide end -->
                </div>
                <!-- Add Scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
            <!-- slider end -->
        </section>
        <!-- =========== End of Portfolio ============ -->

        <!-- =========== Start of Working process ============ -->
        <section class="background-dark pb-xl-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="process-content">
                            <h2>Have a Look at <br> My Working Process</h2>
                            <p>Behance is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore design.</p>
                            <div class="process-button-group">
                                <a href="#" class="btn btn--primary btn--megaEffect">
                                    See Works
                                </a>
                                <span class="process-play-btn">
                                    <a href="https://youtu.be/l-epKcOA7RQ" class="process__play" data-autoplay="true"
                                        data-vbtype="video"><i class="ft ft-play"></i></a>Watch Me
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5 col-12 offset-lg-1">
                        <picture class="process__img">
                            <img src="{{asset('frontend_assets/img/process.png')}}" alt="process">
                        </picture>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End of Working process ============ -->

        <!-- =========== Start of Working Experience ============ -->
        <section class="experience switchable" id="experience" data-scrollax-parent="true">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <span class="title-overlay" data-scrollax="properties: { translateY: '150px' }">
                                    Experience
                                </span>
                            <h3 class="section-title__main">Work Experience</h3>
                            <p class="section-title__description">Over 10 Years Expericences i am work with business & provide solution to client with their business problem</p>
                        </div>
                        <!-- section title end -->
                    </div>
                </div>
                <!--switchable-row end  -->
                <div class="row switchable-row">
                    <div class="col-12 d-lg-flex justify-content-between">
                        <picture class="experience__img">
                            <img src="{{asset('frontend_assets/img/experience-1.jpg')}}" alt="experience">
                        </picture>
                        <!-- image end -->
                        <div class="experience-text">
                            <div class="experience-title">
                                <span class="experience__cologo"><img src="{{asset('frontend_assets/img/company-logo-2.png')}}" alt="company-logo"></span>
                                <div>
                                    <h6>UI UX Designer at Behance</h6>
                                    <p>January 2015 - August 2018</p>
                                </div>
                            </div>
                            <!-- experience-title end -->

                            <div class="experience-description card card--md">
                                <p>Behance is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore design.</p>
                                <ul>
                                    <li>Project management analysis </li>
                                    <li>Senior project reseArthor and director</li>
                                    <li>Creative director</li>
                                </ul>

                            </div>
                            <!-- experience-description end -->

                        </div>
                    </div>
                    <!-- info end -->
                </div>
                <!--switchable-row end  -->
                <div class="row switchable-row">
                    <div class="col-12 d-lg-flex justify-content-between">
                        <picture class="experience__img">
                            <img src="{{asset('frontend_assets/img/experience-2.jpg')}}" alt="experience">
                        </picture>
                        <!-- image end -->
                        <div class="experience-text">
                            <div class="experience-title">
                                <span class="experience__cologo"><img src="{{asset('frontend_assets/img/company-logo-3.png')}}" alt="company-logo"></span>
                                <div>
                                    <h6>UI UX Designer at Behance</h6>
                                    <p>January 2015 - August 2018</p>
                                </div>
                            </div>
                            <!-- experience-title end -->

                            <div class="experience-description card card--md">
                                <p>Behance is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore design.</p>
                                <ul>
                                    <li>Project management analysis </li>
                                    <li>Senior project reseArthor and director</li>
                                    <li>Creative director</li>
                                </ul>

                            </div>
                            <!-- experience-description end -->

                        </div>
                    </div>
                    <!-- info end -->
                </div>
                <!--switchable-row end  -->
                <div class="row switchable-row">
                    <div class="col-12 d-lg-flex justify-content-between">
                        <picture class="experience__img">
                            <img src="{{asset('frontend_assets/img/experience-3.jpg')}}" alt="experience">
                        </picture>
                        <!-- image end -->
                        <div class="experience-text">
                            <div class="experience-title">
                                <span class="experience__cologo"><img src="{{asset('frontend_assets/img/company-logo.png')}}" alt="company-logo"></span>
                                <div>
                                    <h6>UI UX Designer at Behance</h6>
                                    <p>January 2015 - August 2018</p>
                                </div>
                            </div>
                            <!-- experience-title end -->

                            <div class="experience-description card card--md">
                                <p>Behance is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore design.</p>
                                <ul>
                                    <li>Project management analysis </li>
                                    <li>Senior project reseArthor and director</li>
                                    <li>Creative director</li>
                                </ul>

                            </div>
                            <!-- experience-description end -->

                        </div>
                    </div>
                    <!-- info end -->
                </div>
                <!--switchable-row end  -->
            </div>

        </section>
        <!-- =========== End of Working Experience ============ -->

        <!-- =========== Start of Skill ============ -->
        <section class="skills background-dark" data-scrollax-parent="true" id="skills">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <span class="title-overlay" data-scrollax="properties: { translateY: '-100px' }">
                                My Skills
                            </span>
                            <h3 class="section-title__main">My Expertise Areas</h3>
                            <p class="section-title__description">Over 10 Years Expericences i am work with business & provide solution to client with their business problem</p>
                        </div>
                        <!-- section title end -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-container">
                            <ul class="tabs">
                                <li><button data-animate="progress"><i class="ft ft-image"></i>UI UX DESIGN</button></li>

                                <li><button data-animate="progress"><i class="ft ft-airplay"></i>WEB DEVELOPMENT</button></li>

                                <li><button data-animate="progress"><i class="ft ft-server"></i>LANGUAGE SKILLS</button></li>
                            </ul>
                            <!-- skill tab end -->
                            <div class="tab-content">
                                <div class="tabs-item tabs-item--active">
                                    <div class="skill">
                                        <span class="skill__name">Adobe Photoshop</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width:95%;">
                                                <span class="skill__value">95%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                    <div class="skill">
                                        <span class="skill__name">Adobe Illustrator</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width:85%;">
                                                <span class="skill__value">85%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                    <div class="skill">
                                        <span class="skill__name">Adobe After Effect</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width:75%">
                                                <span class="skill__value">75%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                </div>
                                <!-- single tab end -->
                                <div class="tabs-item">
                                    <div class="skill">
                                        <span class="skill__name">HTML/CSS
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width:90%">
                                                <span class="skill__value">90%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                    <div class="skill">
                                        <span class="skill__name">Javascript</span>
                                        <div class="progress">
                                            <div class="progress-bar reveal" style="width:80%">
                                                <span class="skill__value">80%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                    <div class="skill">
                                        <span class="skill__name">WordPress
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar reveal" style="width:85%">
                                                <span class="skill__value">85%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                </div>
                                <!-- single tab end -->
                                <div class="tabs-item">
                                    <div class="skill">
                                        <span class="skill__name">English
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar reveal" style="width:95%">
                                                <span class="skill__value">95%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                    <div class="skill">
                                        <span class="skill__name">Spanish</span>
                                        <div class="progress">
                                            <div class="progress-bar reveal" style="width:65%">
                                                <span class="skill__value">65%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                    <div class="skill">
                                        <span class="skill__name">German
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar reveal" style="width:70%">
                                                <span class="skill__value">70%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single item end -->
                                </div>
                                <!-- single tab end -->
                            </div>
                            <!-- skill end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End of Skill ============ -->

        <!-- =========== Start of Testimonial ============ -->
        <section class="testimonial" data-scrollax-parent="true">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <span class="title-overlay" data-scrollax="properties: { translateY: '-200px' }">
                                Testimonials
                            </span>
                            <h3 class="section-title__main">Testimonials</h3>
                            <p class="section-title__description">Over 10 Years Expericences i am work with business & provide solution to client with their business problem</p>
                        </div>
                        <!-- section title end -->
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial-content card">
                                        <blockquote>
                                            Arthor is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur dcng aelit, sed do eiusmod tempor incididunt labore design.
                                        </blockquote>
                                        <div class="testimonial-info">
                                            <div class="testimonial-customer">
                                                <span class="testimonial__avatar"><img src="{{asset('frontend_assets/img/testimonial-2.png')}}" alt="testimonial"></span>
                                                <div class="testimonial-avatar-info">
                                                    <h6> Miki Jonson</h6>
                                                    <span>Co-Founder</span>
                                                </div>
                                            </div>
                                            <div class="testimonial-rating">
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star"></i>
                                                <i class="icon ti-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single item end -->
                                <div class="swiper-slide">
                                    <div class="testimonial-content card">
                                        <blockquote>
                                            Arthor is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur dcng aelit, sed do eiusmod tempor incididunt labore design.
                                        </blockquote>
                                        <div class="testimonial-info">
                                            <div class="testimonial-customer">
                                                <span class="testimonial__avatar"><img src="{{asset('frontend_assets/img/testimonial-1.png')}}" alt="testimonial"></span>
                                                <div class="testimonial-avatar-info">
                                                    <h6> Miki Jonson</h6>
                                                    <span>Co-Founder</span>
                                                </div>
                                            </div>
                                            <div class="testimonial-rating">
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star"></i>
                                                <i class="icon ti-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single item end -->
                                <div class="swiper-slide">
                                    <div class="testimonial-content card">
                                        <blockquote>
                                            Arthor is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur dcng aelit, sed do eiusmod tempor incididunt labore design.
                                        </blockquote>
                                        <div class="testimonial-info">
                                            <div class="testimonial-customer">
                                                <span class="testimonial__avatar"><img src="{{asset('frontend_assets/img/testimonial-3.png')}}" alt="testimonial"></span>
                                                <div class="testimonial-avatar-info">
                                                    <h6> Miki Jonson</h6>
                                                    <span>Co-Founder</span>
                                                </div>
                                            </div>
                                            <div class="testimonial-rating">
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single item end -->
                                <div class="swiper-slide">
                                    <div class="testimonial-content card">
                                        <blockquote>
                                            Arthor is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur dcng aelit, sed do eiusmod tempor incididunt labore design.
                                        </blockquote>
                                        <div class="testimonial-info">
                                            <div class="testimonial-customer">
                                                <span class="testimonial__avatar"><img src="{{asset('frontend_assets/img/testimonial-2.png')}}" alt="testimonial"></span>
                                                <div class="testimonial-avatar-info">
                                                    <h6> Miki Jonson</h6>
                                                    <span>Co-Founder</span>
                                                </div>
                                            </div>
                                            <div class="testimonial-rating">
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star"></i>
                                                <i class="icon ti-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single item end -->
                                <div class="swiper-slide">
                                    <div class="testimonial-content card">
                                        <blockquote>
                                            Arthor is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur dcng aelit, sed do eiusmod tempor incididunt labore design.
                                        </blockquote>
                                        <div class="testimonial-info">
                                            <div class="testimonial-customer">
                                                <span class="testimonial__avatar"><img src="{{asset('frontend_assets/img/testimonial-1.png')}}" alt="testimonial"></span>
                                                <div class="testimonial-avatar-info">
                                                    <h6> Miki Jonson</h6>
                                                    <span>Co-Founder</span>
                                                </div>
                                            </div>
                                            <div class="testimonial-rating">
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star"></i>
                                                <i class="icon ti-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single item end -->
                                <div class="swiper-slide">
                                    <div class="testimonial-content card">
                                        <blockquote>
                                            Arthor is a top leading most popular portfolio site for growing lalented designer orem ipsum dolor sit amet, consectetur dcng aelit, sed do eiusmod tempor incididunt labore design.
                                        </blockquote>
                                        <div class="testimonial-info">
                                            <div class="testimonial-customer">
                                                <span class="testimonial__avatar"><img src="{{asset('frontend_assets/img/testimonial-3.png')}}" alt="testimonial"></span>
                                                <div class="testimonial-avatar-info">
                                                    <h6> Miki Jonson</h6>
                                                    <span>Co-Founder</span>
                                                </div>
                                            </div>
                                            <div class="testimonial-rating">
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                                <i class="icon ti-star active"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single item end -->
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination swiper-pagination--custom"></div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- =========== End of Testimonial ============ -->

        <!-- =========== Start of CTA ============ -->
        <section class="position-relative py-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cta background-dark">
                            <div class="cta-inner overlay--pattern">
                                <img src="{{asset('frontend_assets/img/diagonal-line-pattern.png')}}" alt="overlay" class="background-image-holder">
                                <h6>Have any Project in Mind ? <a href="mailto:">JUST SAY HELLO</a></h6>
                                <a href="#" class="btn btn--primary btn--lg btn--megaEffect">
                                    Hire Me
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End CTA ============ -->

        <!-- =========== Start of Clients ============ -->
        <section class="space-bottom--sm position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="clients swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{asset('frontend_assets/img/client.png')}}" alt="client">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('frontend_assets/img/client-1.png')}}" alt="client">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('frontend_assets/img/client-2.png')}}" alt="client">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('frontend_assets/img/client-3.png')}}" alt="client">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('frontend_assets/img/client-4.png')}}" alt="client">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End of Clients ============ -->

        <!-- =========== Start of Footer ============ -->
        <footer class="footer background-dark">

            <div class="overlay overlay--pattern">
                <img src="{{asset('frontend_assets/img/diagonal-line-pattern.png')}}" alt="overlay" class="background-image-holder">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="footer-about">
                            <span class="footer-brand-logo"><img src="{{asset('frontend_assets/img/brand-logo-2.png')}}" alt="brand-logo"></span>
                            <p class="footer-about__description">We are <span>Jofra Arthor</span>. 10 years of experience on this field with most awesome talanted peoples and leaders. </p>
                            <ul class="contact-info">
                                <li><i class="ft ft-phone-call"></i>
                                    <a href="tell:">
                                        <p>+008 225 3366</p>
                                    </a>
                                </li>
                                <li> <i class="ft ft-mail"></i>
                                    <a href="mailto:">
                                        <p>+info@example.com</p>
                                    </a>
                                </li>
                                <li> <i class="ft ft-map-pin"></i>
                                    <p>28 Green Tower, Street NamE New York City, USA</p>
                                </li>
                            </ul>
                        </div>
                        <!-- footer about end -->

                    </div>
                    <div class="col-lg-4 col-12">

                        <div class="footer-newsfeed ">
                            <h6 class="footer__title">Blog Posts</h6>
                            <div class="scrollbar-outer">


                                <ul class="inner-content scrollbar-dynamic">
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">Best 10 effective Portfolio site for
                                            freelancer</a>
                                    </li>
                                    <!-- single news feed item end -->
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">See the world through the design</a>
                                    </li>
                                    <!-- single news feed item end -->
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">Top ten article for beginner who
                                            want to learn ui design</a>
                                    </li>
                                    <!-- single news feed item end -->
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">Top ten article for beginner who
                                            want to learn ui design</a>
                                    </li>
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">Best 10 effective Portfolio site for
                                            freelancer</a>
                                    </li>
                                    <!-- single news feed item end -->
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">See the world through the design</a>
                                    </li>
                                    <!-- single news feed item end -->
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">Top ten article for beginner who
                                            want to learn ui design</a>
                                    </li>
                                    <!-- single news feed item end -->
                                    <li>
                                        <div class="footer-newsfeed-meta">
                                            <span class="footer-newsfeed__date">20 Oct. 2018</span>

                                            <div class="footer-newsfeed__category">
                                                <a href="#">BRANDING</a>
                                                <a href="#">TREND</a>
                                            </div>
                                        </div>
                                        <a class="footer-newsfeed__title" href="#">Top ten article for beginner who
                                            want to learn ui design</a>
                                    </li>
                                    <!-- single news feed item end -->
                                </ul>
                            </div>

                            <!-- news feed widget end -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="footer-newsletter">
                            <h6 class="footer__title">NEWSLETTER</h6>
                            <p class="footer-newsletter__description">Thanks for signing up to keep in touch with Arthor. From now, you'll get regular updates, special offer and many more from Arthor.</p>
                            <form action="#">
                                <div class="footer-newsletter-form">
                                    <div class="form-group">
                                        <input type="email" class="" id="email" placeholder="Your Email Address">
                                    </div>
                                    <button type="submit" class="btn btn--primary">Send</button>
                                </div>
                            </form>

                            <ul class="social-connet">
                                <li><a href="#"><i class="ft ft-twitter"></i></a></li>
                                <li><a href="#"><i class="ft ft-linkedin"></i></a></li>
                                <li><a href="#"><i class="ft ft-instagram"></i></a></li>
                                <li><a href="#"><i class="ft ft-instagram"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
        <!-- =========== End of Footer ============ -->


    </div>
    <!-- Plugns JS Files -->
    <script src="{{asset('frontend_assets/js/plugins.min.js')}}"></script>
    <!-- google map js -->
    <!-- Replace test API Key "AIzaSyCLFomDOPKqvvITt7tv_hZG0PDlWB2-q0g" with your own one below  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLFomDOPKqvvITt7tv_hZG0PDlWB2-q0g"></script>
    <!-- App JS Files -->
    <script src="{{asset('frontend_assets/js/app.js')}}"></script>
</body>


</html>