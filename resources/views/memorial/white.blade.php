<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $memorial->name }} | Rememus.com</title>
    <link href="white/images/favicon.ico" rel="icon">
    <link rel="stylesheet" href="white/css/bootstrap.min.css">
    <link rel="stylesheet" href="white/css/all.min.css">
    <link rel="stylesheet" href="white/css/animate.min.css">
    <link rel="stylesheet" href="white/css/owl.carousel.min.css">
    <link rel="stylesheet" href="white/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="white/css/tooltipster.min.css">
    <link rel="stylesheet" href="white/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="white/css/revolution/navigation.css">
    <link rel="stylesheet" href="white/css/revolution/settings.css">
    <link rel="stylesheet" href="white/css/style.css">
</head>

<body>
    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="cssload-loader"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
    <!-- header -->
    <header class="site-header" id="header">
        <nav class="navbar navbar-expand-lg transparent-bg darkcolor static-nav">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="white/images/logo.png" alt="logo" class="logo-default">
                    <img src="white/images/logo.png" alt="logo" class="logo-scrolled">
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('memorial.show') ? 'active' : '' }}" href="{{ route('memorial.show', $memorial) }}">Főoldal</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('memorial.biography') ? 'active' : '' }}" href="{{ route('memorial.biography', $memorial) }}">Története</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('timeline.show') ? 'active' : '' }}" href="{{ route('timeline.show', $memorial) }}">Idővonal</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('memorial.photos') ? 'active' : '' }}" href="{{ route('memorial.photos', $memorial) }}">Galéria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('memorial.comments') ? 'active' : '' }}" href="{{ route('memorial.comments', $memorial) }}">Megemlékezések</a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <a class="nav-link" href="{{ route('dashboard') }}">Kezelés</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">Belépés</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
            <!--side menu open button-->
            <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
                <span class="bg-dark"></span> <span class="bg-dark"></span> <span class="bg-dark"></span>
            </a>
        </nav>
        <!-- side menu -->
        <div class="side-menu opacity-0 gradient-bg">
            <div class="overlay"></div>
            <div class="inner-wrapper">
                <span class="btn-close btn-close-no-padding" id="btn_sideNavClose"><i></i><i></i></span>
                <nav class="side-nav w-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">Főoldal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.html">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsePagesSideMenu" data-bs-toggle="collapse" href="#sideNavPages">
                                Pages <i class="fas fa-chevron-down"></i>
                            </a>
                            <div id="sideNavPages" class="collapse sideNavPages">
                                <ul class="navbar-nav mt-2">
                                    <li class="nav-item">
                                        <a class="nav-link" href="team.html">Our Team</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="services.html">Service</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="services-detail.html">Service Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="testimonial.html">Testimonials</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="gallery.html">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="gallery-detail.html">Gallery Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pricing.html">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="faq.html">FAQ's</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="404.html">Error 404</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="coming-soon.html">Coming Soon</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link collapsePagesSideMenu" data-bs-toggle="collapse"
                                            href="#inner-2">
                                            Account <i class="fas fa-chevron-down"></i>
                                        </a>
                                        <div id="inner-2" class="collapse sideNavPages sideNavPagesInner">
                                            <ul class="navbar-nav mt-2">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="login.html">Login</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="register.html">Register</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="forget-password.html">Forget
                                                        Password</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="support.html">Support</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link collapsePagesSideMenu" data-bs-toggle="collapse"
                                            href="#inner-1">
                                            Shops <i class="fas fa-chevron-down"></i>
                                        </a>
                                        <div id="inner-1" class="collapse sideNavPages sideNavPagesInner">
                                            <ul class="navbar-nav mt-2">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="shop.html">Shop Products</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="shop-detail.html">Shop Detail</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="shop-cart.html">Shop Cart</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsePagesSideMenu" data-bs-toggle="collapse"
                                href="#sideNavPages2">
                                Blogs <i class="fas fa-chevron-down"></i>
                            </a>
                            <div id="sideNavPages2" class="collapse sideNavPages">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="blog-1.html">Blog 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="blog-2.html">Blog 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="blog-detail.html">Blog Details</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                </nav>
                <div class="side-footer w-100">
                    <ul class="social-icons-simple white top40">
                        <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i> </a> </li>
                        <li><a href="javascript:void(0)"><i class="fab fa-twitter"></i> </a> </li>
                        <li><a href="javascript:void(0)"><i class="fab fa-instagram"></i> </a> </li>
                    </ul>
                    <p class="whitecolor">&copy; <span id="year"></span> Trax. Made With Love by ThemesIndustry
                    </p>
                </div>
            </div>
        </div>
        <div id="close_side_menu" class="tooltip"></div>
        <!-- End side menu -->
    </header>
    <!-- header -->
    <!--Main Slider-->
    <!--slider-->
    <section id="our-testimonial" class="bglight padding_bottom">
        <div class="parallax page-header testimonial-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 col-md-12 text-center text-lg-end">
                        <div class="heading-title wow fadeInUp padding_testi" data-wow-delay="300ms">
                            <h2 class="whitecolor font-normal">{{ $memorial->name }}</h2>

                            <span class="whitecolor">
                                {{ \Carbon\Carbon::parse($memorial->birth_date)->format('Y') }}
                                -
                                {{ \Carbon\Carbon::parse($memorial->death_date)->format('Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="owl-carousel owl-nav disabled" id="testimonial-slider">
                <!--item 1-->
                <div class="item testi-box no-rounded">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center  offset-lg-1">
                            <div class="testimonial-round d-inline-block ">
                                <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                                    alt="">
                            </div>
                            <!-- <h4 class="defaultcolor font-light top15"><a href="#.">John Smith</a></h4>
                        <p>UPWORK, New York</p> -->
                        </div>
                        <div class="col-lg-6 col-md-10  text-lg-start text-center top90">
                            <h1 class="mt-3 darkcolor">{{ $memorial->name }}</h1>

                            <p class="mt-3 mb-1 fs-5 font-xlight">
                                <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C20.1752 21.4816 19.3001 21.7706 18 21.8985"
                                        stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M7 4V2.5" stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M17 4V2.5" stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M21.5 9H16.625H10.75M2 9H5.875" stroke="#24cdd5" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path
                                        d="M18 17C18 17.5523 17.5523 18 17 18C16.4477 18 16 17.5523 16 17C16 16.4477 16.4477 16 17 16C17.5523 16 18 16.4477 18 17Z"
                                        fill="#24cdd5" />
                                    <path
                                        d="M18 13C18 13.5523 17.5523 14 17 14C16.4477 14 16 13.5523 16 13C16 12.4477 16.4477 12 17 12C17.5523 12 18 12.4477 18 13Z"
                                        fill="#24cdd5" />
                                    <path
                                        d="M13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17C11 16.4477 11.4477 16 12 16C12.5523 16 13 16.4477 13 17Z"
                                        fill="#24cdd5" />
                                    <path
                                        d="M13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.5523 12 13 12.4477 13 13Z"
                                        fill="#24cdd5" />
                                    <path
                                        d="M8 17C8 17.5523 7.55228 18 7 18C6.44772 18 6 17.5523 6 17C6 16.4477 6.44772 16 7 16C7.55228 16 8 16.4477 8 17Z"
                                        fill="#24cdd5" />
                                    <path
                                        d="M8 13C8 13.5523 7.55228 14 7 14C6.44772 14 6 13.5523 6 13C6 12.4477 6.44772 12 7 12C7.55228 12 8 12.4477 8 13Z"
                                        fill="#24cdd5" />
                                </svg>
                                {{-- <i class="fas fa-calendar"> --}}
                                {{ \Carbon\Carbon::parse($memorial->birth_date)->locale('hu')->translatedFormat('Y F d') }}
                                <span class="defaultcolor">-</span>
                                {{ \Carbon\Carbon::parse($memorial->death_date)->locale('hu')->translatedFormat('Y F d') }}

                            </p>
                            <p class="fs-5 font-xlight ">
                                <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none">
                                <path d="M14.1249 12.1178L15.5 13.5M14.1249 12.1178C14.6657 11.5752 15 10.8266 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13C12.8302 13 13.5817 12.6628 14.1249 12.1178Z" stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M5 15.2161C4.35254 13.5622 4 11.8013 4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C9.26474 21.0797 8.13831 20.1439 7.19438 19" stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                {{ $memorial->grave_location }}
                            </p>
                            {{-- <p class="bottom15 top90">We have a number of different teams within our agency that specialise in different areas of business so you can be sure that you won’t receive a generic service and although we boast a years and years of service.</p> --}}
                            {{-- <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                            </span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--slider end-->
    <!--Some Feature -->
    <section id="our-feature" class="single-feature padding">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 text-md-center text-start wow fadeInLeft"
                    data-wow-delay="300ms">
                    <div class="heading-title mb-4">
                        <h2 class="darkcolor fs-2 font-xlight bottom30"><span class="defaultcolor">"</span> {{ ($memorial->motto) }}</h2>
                    </div>
                    <p class="bottom35">{{ Str::limit($memorial->biography, 800) }}</p>
                    <a href="#our-team" class="button btnsecondary gradient-btn pagescroll mb-sm-0 mb-4">Bővebben</a>
                </div>

            </div>
        </div>
    </section>
    <!--Some Feature ends-->
    <!-- WOrk Process-->
    <section id="our-process" class="padding bgdark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="heading-title whitecolor wow fadeInUp" data-wow-delay="300ms">
                        <span>Quisque tellus risus, adipisci </span>
                        <h2 class="font-normal">Our Work Process </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="process-wrapp no-rounded">
                    <li class="whitecolor wow fadeIn" data-wow-delay="300ms">
                        <span class="pro-step bottom20">01</span>
                        <p class="fontbold bottom25">Concept</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="400ms">
                        <span class="pro-step bottom20">02</span>
                        <p class="fontbold bottom25">Plan</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="500ms">
                        <span class="pro-step bottom20">03</span>
                        <p class="fontbold bottom25">Design</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="600ms">
                        <span class="pro-step bottom20">04</span>
                        <p class="fontbold bottom25">Development</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="700ms">
                        <span class="pro-step bottom20">05</span>
                        <p class="fontbold bottom25">Quality Check</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--WOrk Process ends-->
    <!-- Mobile Apps -->
    <section id="our-apps" class="padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <div class="heading-title bottom30 wow fadeInUp" data-wow-delay="300ms"
                        style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
                        <span class="defaultcolor text-center text-md-start">Quisque tellus risus, adipisci
                            viverra</span>
                        <h2 class="darkcolor font-normal text-center text-md-start">Mobile App Designs</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-12">
                    <p class="text-center text-md-start">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed
                        suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque
                        vitae sodales lectus. </p>
                </div>
            </div>
            <div class="row d-flex align-items-center" id="app-feature">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="text-center">
                        <div class="feature-item mt-3 wow fadeInLeft innovative-border arr-left"
                            data-wow-delay="300ms"
                            style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
                            <div class="icon"><i class="fas fa-cog"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Theme Options</span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                        <div class="feature-item mt-5 wow fadeInLeft innovative-border arr-left"
                            data-wow-delay="350ms"
                            style="visibility: visible; animation-delay: 350ms; animation-name: fadeInLeft;">
                            <div class="icon"><i class="fas fa-edit"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Customization</span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="app-image top30">
                        <div class="app-slider-lock-btn"></div>
                        <div class="app-slider-lock">
                            <img src="images/iphone-slide-lock.jpg" alt="">
                        </div>
                        <div id="app-slider" class="owl-carousel owl-theme owl-loaded owl-drag">



                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(-470px, 0px, 0px); transition: all 0s ease 0s; width: 1645px;">
                                    <div class="owl-item cloned" style="width: 235px;">
                                        <div class="item">
                                            <img src="images/iphone-slide2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 235px;">
                                        <div class="item">
                                            <img src="images/iphone-slide3.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 235px;">
                                        <div class="item">
                                            <img src="images/iphone-slide1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 235px;">
                                        <div class="item">
                                            <img src="images/iphone-slide2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 235px;">
                                        <div class="item">
                                            <img src="images/iphone-slide3.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 235px;">
                                        <div class="item">
                                            <img src="images/iphone-slide1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 235px;">
                                        <div class="item">
                                            <img src="images/iphone-slide2.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav disabled"><button type="button" role="presentation"
                                    class="owl-prev"><span aria-label="Previous">‹</span></button><button
                                    type="button" role="presentation" class="owl-next"><span
                                        aria-label="Next">›</span></button></div>
                            <div class="owl-dots disabled"></div>
                        </div>
                        <img src="images/iphone.png" alt="image">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="text-center">
                        <div class="feature-item mt-3 wow fadeInRight innovative-border arr-right"
                            data-wow-delay="300ms"
                            style="visibility: visible; animation-delay: 300ms; animation-name: fadeInRight;">
                            <div class="icon"><i class="fas fa-code"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Powerful Code</span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                        <div class="feature-item mt-5 wow fadeInRight innovative-border arr-right"
                            data-wow-delay="350ms"
                            style="visibility: visible; animation-delay: 350ms; animation-name: fadeInRight;">
                            <div class="icon"><i class="far fa-folder-open"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Documentation </span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Mobile Apps ends-->
    <!-- Counters -->
    <section id="bg-counters" class="padding bg-counters parallax">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-4 col-md-4 col-sm-4 bottom10">
                    <div class="counters whitecolor  top10 bottom10">
                        <span class="count_nums font-light" data-to="2010" data-speed="2500"> </span>
                    </div>
                    <h3 class="font-light whitecolor top20">Since We Started</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p class="whitecolor top20 bottom20 font-light title">Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Nunc mauris arcu, lobortis id interdum vitae, interdum eget elit. </p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 bottom10">
                    <div class="counters whitecolor top10 bottom10">
                        <span class="count_nums font-light" data-to="895" data-speed="2500"> </span>
                    </div>
                    <h3 class="font-light whitecolor top20">Since We Started</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- Counters ends-->
    <!-- Our Team-->
    <section id="our-team" class="padding_top half-section-alt teams-border">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="heading-title heading_space wow fadeInUp" data-wow-delay="300ms">
                        <span class="defaultcolor text-center text-md-start">Quisque tellus risus, adipisci</span>
                        <h2 class="darkcolor font-normal text-center text-md-start">Meet Our Experts</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <p class="heading_space mt-n3 mt-sm-0 text-center text-md-start">Curabitur mollis bibendum luctus.
                        Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus
                        metus sollicitudin. Quisque vitae sodales lectus. </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="ourteam-slider" class="owl-carousel">
                        <div class="item">
                            <div class="team-box">
                                <div class="image">
                                    <img src="images/team-1.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box">
                                <div class="image">
                                    <img src="images/team-2.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jason Wudex </h4>
                                    <p>Designer</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box single">
                                <div class="image">
                                    <img src="images/team-3.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box">
                                <div class="image">
                                    <img src="images/team-4.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Hayden Wood</h4>
                                    <p>Marketing</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box">
                                <div class="image">
                                    <img src="images/team-1.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Shania Jackson </h4>
                                    <p>Print Media</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box">
                                <div class="image">
                                    <img src="images/team-2.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box">
                                <div class="image">
                                    <img src="images/team-3.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Team ends-->
    <!--Pricing Start-->
    <section id="pricing" class="padding bglight">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="heading-title darkcolor wow fadeInUp" data-wow-delay="300ms">
                        <span class="defaultcolor">Quisque tellus risus, adipisci </span>
                        <h2 class="font-normal bottom40"> Pricing Offers </h2>
                    </div>
                </div>
                <div class="col-12 text-center ">
                    <div class="price-toggle-wrapper heading_space">
                        <span class="Pricing-toggle-button month active">Monthly</span>
                        <span class="Pricing-toggle-button year">Yearly</span>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-theme no-dots" id="price-slider">
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item wow fadeInUp animated sale" data-wow-delay="300ms" data-sale="60">
                            <h3 class="font-light darkcolor">Basic</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$9.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li class="price-not">40MB of storage space</li>
                                <li class="price-not">Social media integration</li>
                                <li class="price-not">10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item sale wow fadeInUp animated" data-wow-delay="380ms" data-sale="40">
                            <h3 class="font-light darkcolor">Popular</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$19.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li>40MB of storage space</li>
                                <li class="price-not">Social media integration</li>
                                <li class="price-not">10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item wow fadeInUp animated sale" data-wow-delay="460ms" data-sale="30">
                            <h3 class="font-light darkcolor">Enterprise</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$29.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li>40MB of storage space</li>
                                <li>Social media integration</li>
                                <li class="price-not">10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item wow fadeInUp animated sale" data-wow-deeay="400ms" data-sale="20">
                            <h3 class="font-light darkcolor">Ultimate</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$49.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li>40MB of storage space</li>
                                <li>Social media integration</li>
                                <li>10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Pricing ends-->
    <!-- Partners-->
    <section id="our-partners" class="padding">
        <div class="container">
            <div class="row">
                <h2 class="d-none">Partners Carousel</h2>
                <div class="col-md-12 col-sm-12">
                    <div id="partners-slider" class="owl-carousel">
                        <div class="item">
                            <div class="logo-item"> <img alt="" src="images/logo-1.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-2.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-3.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-4.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-5.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-1.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-2.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-3.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-4.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-5.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners ends-->
    <!-- Testimonials -->
    {{-- <section id="our-testimonial" class="bglight padding_bottom">
        <div class="parallax page-header testimonial-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 col-md-12 text-center text-lg-end">
                        <div class="heading-title wow fadeInUp padding_testi" data-wow-delay="300ms">
                            <span class="whitecolor">Quisque tellus risus, adipisci</span>
                            <h2 class="whitecolor font-normal">What People Say</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="owl-carousel" id="testimonial-slider">
                <!--item 1-->
                <div class="item testi-box no-rounded">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-1.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">John Smith</a></h4>
                            <p>UPWORK, New York</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">We have a number of different teams within our agency that
                                specialise in different areas of business so you can be sure that you won’t receive a
                                generic service and although we boast a years and years of service.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--item 2-->
                <div class="item testi-box no-rounded">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-2.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">Hayden Wood</a></h4>
                            <p>FIVERR, Italy</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">Trax’s customer testimonial page is another beauty. Its simple
                                design focuses on videos and standout quotes from customers. This approach is clean,
                                straightforward, text that can be overwhelming and easy to skip.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i> <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--item 3-->
                <div class="item testi-box no-rounded">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-3.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">Kevin Miller</a></h4>
                            <p>ENVATO, Australia</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">Trax is a company that provides tools to help professional event
                                planning and execution, and their customers are very happy folks! The thing I love about
                                their customer testimonial page provides content formats.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--item 4-->
                <div class="item testi-box no-rounded">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-4.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">Alina Johanson</a></h4>
                            <p>INTEL, Sidney</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">Startup Institute is a career accelerator that allows
                                professionals to learn new skills, take their careers in a different direction, and
                                pursue a career they are passionate about that have completed the program.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i> <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--Testimonials Ends-->
    <!-- Contact US -->
    <section id="stayconnect" class="bglight position-relative">
        <div class="container">
            <div class="contactus-wrapp">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="heading-title wow fadeInUp text-center text-md-start" data-wow-delay="300ms">
                            <h3 class="darkcolor bottom20">Stay Connected</h3>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <form class="getin_form wow fadeInUp" data-wow-delay="400ms" onsubmit="return false;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12" id="result"></div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="userName" class="d-none"></label>
                                        <input class="form-control" type="text" placeholder="Name" required
                                            id="userName" name="userName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="companyName" class="d-none"></label>
                                        <input class="form-control" type="tel" placeholder="Company"
                                            id="companyName" name="companyName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="d-none"></label>
                                        <input class="form-control" type="email" placeholder="Email" required
                                            id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <button type="submit" class="button gradient-btn w-100"
                                        id="submit_btn">subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact US ends -->
    <!--Site Footer Here-->
    <footer id="site-footer" class=" bgdark padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <a href="index.html" class="footer_logo bottom25"><img src="images/logo-transparent.png"
                                alt="MegaOne"></a>
                        <p class="whitecolor bottom25">Keep away from people who try to belittle your ambitions Small
                            people always do that but the really great Friendly.</p>
                        <div class="d-table w-100 address-item whitecolor bottom25">
                            <span class="d-table-cell align-middle"><i class="fas fa-mobile-alt"></i></span>
                            <p class="d-table-cell align-middle bottom0">
                                +01 - 123 - 4567 <a class="d-block" href="mailto:web@support.com">web@support.com</a>
                            </p>
                        </div>
                        <ul class="social-icons white wow fadeInUp" data-wow-delay="300ms">
                            <li><a href="javascript:void(0)" class="facebook"><i class="fab fa-facebook-f"></i> </a>
                            </li>
                            <li><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i> </a>
                            </li>
                            <li><a href="javascript:void(0)" class="linkedin"><i class="fab fa-linkedin-in"></i> </a>
                            </li>
                            <li><a href="javascript:void(0)" class="insta"><i class="fab fa-instagram"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <h3 class="whitecolor bottom25">Latest News</h3>
                        <ul class="latest_news whitecolor">
                            <li> <a href="#.">Aenean tristique justo et... </a> <span
                                    class="date defaultcolor">15 March 2019</span> </li>
                            <li> <a href="#.">Phasellus dapibus dictum augue... </a> <span
                                    class="date defaultcolor">15 March 2019</span> </li>
                            <li> <a href="#.">Mauris blandit vitae. Praesent non... </a> <span
                                    class="date defaultcolor">15 March 2019</span> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20 ps-0 ps-lg-5">
                        <h3 class="whitecolor bottom25">Our Services</h3>
                        <ul class="links">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="blog-1.html">Latest News</a></li>
                            <li><a href="pricing.html">Business Planning</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="faq.html">Faq's</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <h3 class="whitecolor bottom25">Business hours</h3>
                        <p class="whitecolor bottom25">Our support available to help you 24 hours a day, seven days
                            week</p>
                        <ul class="hours_links whitecolor">
                            <li><span>Monday-Saturday:</span> <span>8.00-18.00</span></li>
                            <li><span>Friday:</span> <span>09:00-21:00</span></li>
                            <li><span>Sunday:</span> <span>09:00-20:00</span></li>
                            <li><span>Calendar Events:</span> <span>24-Hour Shift</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer ends-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="white/js/jquery-3.6.0.min.js"></script>
    <!--Bootstrap Core-->
    <script src="white/js/propper.min.js"></script>
    <script src="white/js/bootstrap.min.js"></script>
    <!--to view items on reach-->
    <script src="white/js/jquery.appear.js"></script>
    <!--Owl Slider-->
    <script src="white/js/owl.carousel.min.js"></script>
    <!--number counters-->
    <script src="white/js/jquery-countTo.js"></script>
    <!--Parallax Background-->
    <script src="white/js/parallaxie.js"></script>
    <!--Cubefolio Gallery-->
    <script src="white/js/jquery.cubeportfolio.min.js"></script>
    <!--Fancybox js-->
    <script src="white/js/jquery.fancybox.min.js"></script>
    <!--tooltip js-->
    <script src="white/js/tooltipster.min.js"></script>
    <!--wow js-->
    <script src="white/js/wow.js"></script>
    <!--Revolution SLider-->
    <script src="white/js/revolution/jquery.themepunch.tools.min.js"></script>
    <script src="white/js/revolution/jquery.themepunch.revolution.min.js"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
    <script src="white/js/revolution/extensions/revolution.extension.actions.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.carousel.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.migration.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.navigation.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.parallax.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="white/js/revolution/extensions/revolution.extension.video.min.js"></script>
    <!--custom functions and script-->
    <script src="white/js/functions.js"></script>
</body>

</html>
