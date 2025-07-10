<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords"
        content="emlékoldal, virtuális emlékmű, elhunytak emléke, emlékmű online, emlékhely, rememus, Rememus, rememus.com, Remember, us">
    <meta name="description"
        content="rememus.com – online emlékoldalak szeretteik emlékének megörökítésére. Készítsen virtuális emlékműveket, ossza meg emlékeit és fotóit.">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Title  -->
    <title>@yield('title', 'Rememus.com')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('common/css/plugins.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.css">

    <link rel="stylesheet" href="{{ asset('home/css/effect-material.min.css') }}">

    <!-- Core Style Css -->
    <link rel="stylesheet" href="{{ asset('common/css/common_style.css') }}">

    <link rel="stylesheet" href="{{ asset('home/css/home.css') }}">

    <!-- CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Для локализации на венгерский -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.hu.min.js">
    </script>

    @yield('css')
</head>

<body>

    <!-- ==================== Start Loading ==================== -->

    <div class="loader-wrap">
        <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
        </svg>

        <div class="loader-wrap-heading">
            <div class="load-text">
                <span>R</span>
                <span>E</span>
                <span>M</span>
                <span>E</span>
                <span>M</span>
                <span>U</span>
                <span>S</span>
            </div>
        </div>
    </div>

    <!-- ==================== End Loading ==================== -->

    <div class="cursor"></div>

    <!-- ==================== Start progress-scroll-button ==================== -->

    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!-- ==================== End progress-scroll-button ==================== -->

    <!-- ==================== Start Navbar ==================== -->

    {{-- @include('layouts.partials.nav') --}}

    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <!-- Logo -->
            <a class="logo" href="{{ route('welcome') }}">
                <img src="{{ asset('home/imgs/logo-rememus.png') }}" style="height: 16px;" alt="logo">
            </a>

            <!-- navbar links -->

            <div class="topnav d-flex align-items-center">
                <!-- <a href="../inner_pages/contact.html" class="butn butn-rounded">
                    <div class="d-flex align-items-center">
                        <span>Start Project</span>
                        <span class="icon ml-10">
                            <img src="../common/imgs/icons/arrow-top-right.svg" alt="">
                        </span>
                    </div>
                </a> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}"
                                href="{{ route('welcome') }}">Címlap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('price') ? 'active' : '' }}"
                                href="{{ route('price') }}">Árak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link butn-scroll"
                                href="{{ url('/')}}#howitworks">Hogyan működik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link butn-q-scroll"
                                href="{{ url('/')}}#faqs">Kérdések</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">Kapcsolatok</a>
                        </li>

                        <li class="nav-item">
                            @auth
                                <a class="nav-link" href="{{ route('dashboard') }}">Kezelés</a>
                            @else
                                <a class="nav-link" href="{{ route('dashboard') }}">Bejelentkezés</a>
                            @endauth
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                href="https://shop.rememus.com">Shop</a>
                        </li>
                    </ul>
                </div>

                <div class="menu-icon cursor-pointer" style="    color: #ffffff !important;">
                    <span class="icon ti-align-right d-block d-lg-none"></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="hamenu">
        <div class="close-menu cursor-pointer ti-close"></div>
        <div class="container-fluid rest d-flex">
            <div class="menu-links">
                <ul class="main-menu rest">
                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('welcome') }}" class="link"><span class="fill-text" data-text="Címlap">Címlap</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('price') }}" class="link"><span class="fill-text" data-text="Árak">Árak</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('contact') }}" class="link"><span class="fill-text"
                                    data-text="Kapcsolatok">Kapcsolatok</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('dashboard') }}" class="link"><span class="fill-text"
                                    data-text="Bejelentkezés">Bejelentkezés</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="https://shop.rememus.com" class="link"><span class="fill-text"
                                    data-text="Shop">Shop</span>
                            </a>
                        </div>
                    </li>

                    
                </ul>
            </div>
            <div class="cont-info valign">
                <div class="text-center full-width">
                    <div class="logo mb-2">
                        <img src="{{ asset('home/imgs/logo-rememus.png') }}" alt="">
                    </div>
                    <div class="social-icon mt-40">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-x-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-linkedin-in"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                    </div>
                    <div class="item mt-30">
                        <h5>Magyaroszag, <br> Paks</h5>
                    </div>
                    <div class="item mt-10">
                        <h5><a href="#0">info@rememus.com</a></h5>
                        <h5 class="underline"><a href="#0">+ 36 20 41 25 69</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== End Navbar ==================== -->

    <div id="smooth-wrapper">

        <div id="smooth-content">

            <main>

                @yield('content')

            </main>

            <!-- ==================== Start Footer ==================== -->

            {{-- @include('layouts.partials.footer') --}}


            <footer class="footer-mp section-padding pt-60 pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-item md-mb30">
                                <span class="fz-12 text-u sub-color mb-10">Telefon</span>
                                <h6>+36 70 702 1252</h6>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-item md-mb30">
                                <span class="fz-12 text-u sub-color mb-10">Email</span>
                                <h6>info@rememus.hu</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex">
                            <div class="ml-auto ml-none">
                                <div class="social-icon">
                                    <a href="#0">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                    <a href="#0">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                    <a href="#0">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                    <a href="#0">
                                        <i class="fa-brands fa-viber"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sub-footer pt-30 pb-30 mt-30 bord-thin-top">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="copy sub-color md-mb30">
                                    <p>Copyright © 2025 <a href="#0">Paksi Informatika.</a> Minden jog fenntartva.</p>
                                </div>
                            </div>
                            <div class="col-lg-7 d-flex justify-content-end">
                                <div class="links sub-color d-flex justify-content-between">
                                {{-- <a href="#" class="active">Impresszum</a> --}}
                                <a href="#">Impresszum</a>
                                <a href="#">Adatvédelmi tájékoztató</a>
                                <a href="#">Általános szerződési feltételek</a>
                                <a href="#">Cookie beállítások</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>



            {{-- <footer class="footer-mp  pb-0">
                <div class="container">
                    <div class="row">
                        <div class="sub-footer pt-30 pb-30 mt-30 ">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="copy sub-color md-mb30 sm-hide">
                                        <p>Copyright © 2025 Paksi Informatika. Minden jog fenntartva! ÁSZF Adatkezelési tájékoztató</p>
                                    </div>
                                    <div class="copy sub-color md-mb30 text-center d-block d-sm-none">
                                        <p>© 2025 rememus.com</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end sm-hide">
                                    <div class="ml-auto ml-none">
                                        <div class="social-icon">
                                            <a href="#0">
                                                <i class="fa-brands fa-x-twitter"></i>
                                            </a>
                                            <a href="#0">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                            <a href="#0">
                                                <i class="fa-brands fa-facebook"></i>
                                            </a>
                                            <a href="#0">
                                                <i class="fa-brands fa-viber"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </footer> --}}

            <!-- ==================== End Footer ==================== -->

        </div>

    </div>

    <!-- jQuery -->
    <script src="{{ asset('common/js/lib/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('common/js/lib/jquery-migrate-3.4.0.min.js') }}"></script>

    <!-- plugins -->
    <script src="{{ asset('common/js/lib/plugins.js') }}"></script>

    <!-- GSAP -->
    <script src="{{ asset('common/js/gsap_lib/gsap.min.js') }}"></script>
    <script src="{{ asset('common/js/gsap_lib/ScrollSmoother.min.js') }}"></script>
    <script src="{{ asset('common/js/gsap_lib/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('common/js/gsap_lib/SplitText.min.js') }}"></script>

    <!-- common scripts -->
    <script src="{{ asset('common/js/common_scripts.js') }}"></script>

    <!-- custom scripts -->
    <script src="{{ asset('home/js/scripts.js') }}"></script>

    @yield('js')

</body>

</html>
