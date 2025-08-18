<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- og:image  -->
    <meta property="og:image" content="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}">
    <meta property="og:title" content="{{ $memorial->name }} - rememus.com">
    <meta property="og:description" content="Rememus.com">

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

    <style type="text/css" media="screen">
        .tree {
            min-width: 1100px;
        }

        .tree-container {
            overflow-x: auto;
            width: 100%;

        }

        .tree ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .tree li {
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 30px 0 30px;
            transition: all 0.5s;
        }

        /* Connectors */
        .tree li::before,
        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 178px;
            z-index: -1;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        /* Remove connectors for elements without siblings */
        .tree li:only-child::after,
        .tree li:only-child::before {
            display: none;
        }

        /* Remove space from the top of single children */
        .tree li:only-child {
            padding-top: 0;
        }

        /* Remove left connector from first child and right connector from last child */
        .tree li:first-child::before,
        .tree li:last-child::after {
            border: 0 none;
        }

        /* Add back the vertical connector to the last nodes */
        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            transform: translateX(1px);
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        /* Downward connectors from parents */
        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
            z-index: -1;
        }

        /* Style for <a> elements */
        .tree li a {
            border: 1px solid #ccc;
            padding: 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 14px;
            display: inline-block;
            background: white;
            border-radius: 5px;
            transition: all 0.5s;
            width: 120px;
            text-align: center;
            filter: drop-shadow(2px 1px 3px rgba(0, 0, 0, 0.1)) drop-shadow(0px 0px 1px rgba(0, 0, 0, 0.01));

        }

        /* Adjust image size and alignment */
        .tree li a img {
            display: block;
            margin: 0 auto 5px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0rem 0.4rem 0.6rem 0rem rgba(32, 46, 66, 0.08);
        }

        /* Parent pair styling */
        .parent-pair {
            display: flex;
            justify-content: center;
            position: relative;
            padding-top: 0 !important;
            margin-bottom: 20px;
        }

        .parent-pair li {
            padding: 0 10px;
        }

        /* Connector between parents */
        .parent-pair li:first-child a::after {
            content: '';
            position: absolute;
            border-top: 1px solid #ccc;
            top: 50%;
            left: 100%;
            width: 20px;
            z-index: -1;
        }

        /* Connector from parents to children */
        .parent-pair::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
            z-index: -1;
        }

        /* Hover effects */
        .tree li a:hover {
            background: #c8e4f8;
            color: #000;
            border: 1px solid #94a0b4;
        }

        /* Connector styles on hover */
        /* .tree li a:hover~ul li::after,
        .tree li a:hover~ul li::before,
        .tree li a:hover~ul::before,
        .tree li a:hover~ul ul::before,
        .parent-pair:hover::after {
            border-color: #94a0b4;
        } */


        .tree li.down::after {
            content: '';
            position: absolute;
            bottom: -20px;
            top: auto;
            border-top: none;
            border-bottom: 1px solid #ccc;
            width: 50%;
            height: 20px;
            z-index: -1;
        }

        .tree li.up::before {
            content: '';
            position: absolute;
            bottom: -20px;
            top: auto;
            border-top: none;
            border-bottom: 1px solid #ccc;
            width: 50%;
            height: 20px;
            z-index: -1;
        }

        .tree li.down::before {
            right: 50%;
        }

        .tree li.up::before {
            border-right: 1px solid #ccc;
            border-radius: 0 0 5px 0;
            transform: translateX(1px);
        }

        .tree li.down::after {
            left: 50%;
            right: auto;
            border-left: 1px solid #ccc;
            border-radius: 0 0 0 5px;

        }

        .tree li a+a {
            margin-left: 20px;
            position: relative;
        }

        .tree li a+a::before {
            content: '';
            position: absolute;
            border-top: 1px solid #ccc;
            top: 50%;
            left: -25px;
            width: 25px;
        }



        li.up::after {
            content: none !important;
            /* Отменяет содержимое псевдоэлемента */
            display: none !important;
            /* Скрывает псевдоэлемент */
        }

        li.down::before {
            content: none !important;
            /* Отменяет содержимое псевдоэлемента */
            display: none !important;
            /* Скрывает псевдоэлемент */
        }


        .tree ul.down {
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 0px 10px 0 10px;
            transition: all 0.5s;
        }

        .tree ul ul.apa::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 40px;
            z-index: -1;
        }

        .img-fluid {
            height: 90px;
            width: 90px;
            object-fit: cover;
        }

        .name-wrap {
            max-width: 90px;
            word-wrap: break-word;
        }

        .memorial-name {
            height: 2.7em;
            line-height: 1.5em;
            display: flex;
            /* align-items: center; */
            justify-content: center;
            text-align: center;
            white-space: normal;
            word-break: break-word;
            font-size: 14px;
        }

        
    </style>



</head>

<body data-bs-spy="scroll" data-bs-target=".navbar-nav" data-bs-offset="75" class="offset-nav">
    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="cssload-loader"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
    <!-- header -->
    <header class="site-header" id="header">
        <nav class="navbar navbar-expand-lg transparent-bg static-nav">
            <div class="container">
                <a class="navbar-brand" href="https://rememus.com/">
                    <img src="white/logo-rememus-qr-3.png" alt="logo" class="logo-default">
                    {{-- <img src="white/logo-rememus-qr-3.png" alt="logo" class="logo-scrolled"> --}}
                    <div class="logo-scrolled">
                        <div class="d-flex align-items-center ">
                            <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                                alt="" height="40px" style="border-radius: 3px">
                            <h1 class="darkcolor ms-4 fs-2">{{ $memorial->name }}</h1>
                        </div>
                    </div>

                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mx-auto ms-xl-auto me-xl-0">
                        {{-- <li class="nav-item">
                        <a class="nav-link active pagescroll" href="#home">Home</a>
                    </li> --}}
                        <li class="nav-item">
                            <a class="nav-link pagescroll scrollupto" href="#home">{{ __('History') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#gallery">{{ __('Gallery') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#timeline">{{ __('Timeline') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#family-tree">{{ __('Family Tree') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#testimonials">{{ __('Commemorations') }}</a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Log In') }}</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
            <!--side menu open button-->
            <a href="javascript:void(0)" class="d-inline-block sidemenu_btn d-block d-lg-none" id="sidemenu_toggle">
                <span></span> <span></span> <span></span>
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
                            <a class="nav-link pagescroll scrollupto" href="#home">{{ __('History') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#gallery">{{ __("Gallery") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#timeline">{{ __('Timeline') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#family-tree">{{ __('Family Tree') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#testimonials">{{ __('Commemorations') }}</a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Log In') }}</a>
                            @endauth
                        </li>
                    </ul>
                </nav>
                <div class="side-footer w-100">
                    <ul class="social-icons-simple white top40">
                        <li><a href="javascript:void(0)" class="facebook"><i class="fab fa-facebook-f"></i> </a>
                        </li>
                        <li><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="insta"><i class="fab fa-instagram"></i> </a> </li>
                    </ul>
                    <p class="whitecolor">&copy; <span id="year"></span> Rememus.com
                    </p>
                </div>
            </div>
        </div>
        <div id="close_side_menu" class="tooltip"></div>
        <!-- End side menu -->
    </header>
    <!-- header -->
    <!--Main Slider-->
    <section id="home" class="">
        <div class="parallax page-header testimonial-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 col-md-12 text-center text-lg-end">
                        <div class="heading-title wow fadeInUp padding_testi" data-wow-delay="300ms">
                            {{-- <h1 style="font-size: 90px; color: #ffffff76">{{ $memorial->name }}</h2> --}}
                            <h1 class="d-none d-md-block" style="font-size: 90px; color: #ffffff76">
                                {{ $memorial->name }}</h1>
                            <h1 class="d-block d-md-none mt-5" style="font-size: 30px; color: #ffffff76">
                                {{ $memorial->name }}</h1>
                            {{-- <span class="whitecolor">
                                {{ \Carbon\Carbon::parse($memorial->birth_date)->format('Y') }}
                                -
                                {{ \Carbon\Carbon::parse($memorial->death_date)->format('Y') }}
                            </span> --}}
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
                                <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M14.1249 12.1178L15.5 13.5M14.1249 12.1178C14.6657 11.5752 15 10.8266 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13C12.8302 13 13.5817 12.6628 14.1249 12.1178Z"
                                        stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M5 15.2161C4.35254 13.5622 4 11.8013 4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C9.26474 21.0797 8.13831 20.1439 7.19438 19"
                                        stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
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
    <!--Main Slider ends -->

    <!--Some Feature -->
    <section id="biography" class="single-feature padding_bottom mt-5 pt-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 text-start wow fadeInLeft" data-wow-delay="300ms">
                    <div class="heading-title mb-4">
                        <h2 class="darkcolor fs-2 font-xlight bottom30 text-center"><span
                                class="defaultcolor">"</span>
                            {{ $memorial->motto }}</h2>
                    </div>
                    <p class="bottom35">{{ $memorial->biography }}</p>

                    {{-- <p class="bottom35">{{ Str::limit($memorial->biography, 800) }}</p> --}}
                    {{-- <a href="#our-team" class="button btnsecondary gradient-btn pagescroll mb-sm-0 mb-4">Bővebben</a> --}}
                </div>

            </div>
        </div>
    </section>
    <!--Some Feature ends-->

    <!-- Gallery -->
    <section id="gallery" class="position-relative padding bglight">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center wow fadeIn top15" data-wow-delay="300ms">
                    <h2 class="heading bottom45 darkcolor font-light2">{{ __('Gallery') }}<span class="font-normal"></span>
                        <span class="divider-center"></span>
                    </h2>
                    <div class="col-md-8 offset-md-2 bottom40">
                        <p>
                            {{ __('A gallery is a collection of photos, videos, and other visual memories. It allows you to visually preserve and share important moments, events, and family stories.') }}
                        </p>
                    </div>
                </div>
                {{-- <div class="col-lg-12">
                    <div id="mosaic-filter" class="cbp-l-filters bottom30 wow fadeIn text-center"
                        data-wow-delay="350ms">
                        <div data-filter="*" class="cbp-filter-item">
                            <span>All</span>
                        </div>

                        <div data-filter=".graphics" class="cbp-filter-item">
                            <span>Video</span>
                        </div>
                        <div data-filter=".graphics" class="cbp-filter-item">
                            <span>Megemlékezések</span>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div id="grid-mosaic" class="cbp cbp-l-grid-mosaic-flat">
                        @foreach ($images as $image)
                            <div class="cbp-item brand graphics" style="border-radius: 4px;">
                                <img src="{{ asset('memorial/' . $image->image_path) }}"
                                    alt="{{ $image->image_description ?? 'Gallery Image' }}">
                                <a href="{{ asset('memorial/' . $image->image_path) }}"
                                    class="gallery-hvr whitecolor opens glightbox text-decoration-none"
                                    data-fancybox="gallery" title="{{ $image->image_description ?? __('Zoom in') }}">
                                    <div class="center-box">
                                        <i class="fa fa-search-plus text-white fs-5"></i>
                                        <h4 class="w-100">{{ $image->image_description ?? '' }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>


                {{-- <div class="col-lg-12 mb-4">
                    <!--Load more itema from another html file using ajax-->
                    <div id="js-loadMore-mosaic" class="cbp-l-loadMore-button ">
                        <a href="load-more.html"
                            class="cbp-l-loadMore-link button py-1 button gradient-btn whitecolor transition-3"
                            rel="nofollow">
                            <span class="cbp-l-loadMore-defaultText">LOAD MORE (<span
                                    class="cbp-l-loadMore-loadItems">13</span>)</span>
                            <span class="cbp-l-loadMore-loadingText">LOADING <i
                                    class="fas fa-spinner fa-spin"></i></span>
                            <span class="cbp-l-loadMore-noMoreLoading d-none">NO MORE WORKS</span>
                        </a>
                    </div>
                </div> --}}


            </div>
        </div>
    </section>
    <!-- Gallery ends -->


    <!-- WOrk Process-->
    {{-- <section id="our-process" class="padding bgdark">
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
            <ul class="process-wrapp">
                <li class="whitecolor wow fadeIn" data-wow-delay="300ms">
                    <span class="pro-step bottom20">01</span>
                    <p class="fontbold bottom20">Concept</p>
                    <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                </li>
                <li class="whitecolor wow fadeIn" data-wow-delay="400ms">
                    <span class="pro-step bottom20">02</span>
                    <p class="fontbold bottom20">Plan</p>
                    <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                </li>
                <li class="whitecolor wow fadeIn active" data-wow-delay="500ms">
                    <span class="pro-step bottom20">03</span>
                    <p class="fontbold bottom20">Design</p>
                    <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                </li>
                <li class="whitecolor wow fadeIn" data-wow-delay="600ms">
                    <span class="pro-step bottom20">04</span>
                    <p class="fontbold bottom20">Development</p>
                    <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                </li>
                <li class="whitecolor wow fadeIn" data-wow-delay="700ms">
                    <span class="pro-step bottom20">05</span>
                    <p class="fontbold bottom20">Quality Check</p>
                    <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                </li>
            </ul>
        </div>
    </div>
</section> --}}
    <!--WOrk Process ends-->



    <!-- Timeline -->
    <section id="timeline" class="padding">
        <div class="container">
            <div class="row">
                <h2 class="d-none"></h2>
                <div class="col-md-12 col-sm-12">
                    <div id=""></div>
                    <div id="tracking">
                        <div class="col-md-12 text-center wow fadeIn top15" data-wow-delay="300ms">
                            <h2 class="heading bottom45 darkcolor font-light2">{{ __('Timeline') }}<span
                                    class="font-normal"></span>

                            </h2>
                            <div class="col-md-8 offset-md-2 bottom40">
                                <p>
                                    {{ __('A timeline depicts important life events in chronological order. It presents key moments, such as births, marriages, or significant achievements, with dates and descriptions, helping you to review your family history.') }}
                                </p>
                            </div>
                        </div>
                        <div class="">


                            @foreach ($timelines->take(6) as $timeline)
                                <div class="tracking-item ">

                                    <div class="tracking-icon status-intransit">

                                        @if ($timeline->type == 'marriage')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M8.96173 18.9109L9.42605 18.3219L8.96173 18.9109ZM12 5.50063L11.4596 6.02073C11.601 6.16763 11.7961 6.25063 12 6.25063C12.2039 6.25063 12.399 6.16763 12.5404 6.02073L12 5.50063ZM15.0383 18.9109L15.5026 19.4999L15.0383 18.9109ZM7.00061 16.4209C6.68078 16.1577 6.20813 16.2036 5.94491 16.5234C5.68169 16.8432 5.72758 17.3159 6.04741 17.5791L7.00061 16.4209ZM2.34199 13.4115C2.54074 13.7749 2.99647 13.9084 3.35988 13.7096C3.7233 13.5108 3.85677 13.0551 3.65801 12.6917L2.34199 13.4115ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55954 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219ZM9.42605 18.3219C8.63014 17.6945 7.82129 17.0963 7.00061 16.4209L6.04741 17.5791C6.87768 18.2624 7.75472 18.9144 8.49742 19.4999L9.42605 18.3219ZM3.65801 12.6917C3.0968 11.6656 2.75 10.5033 2.75 9.1371H1.25C1.25 10.7746 1.66995 12.1827 2.34199 13.4115L3.65801 12.6917Z"
                                                    fill="#24cdd5" />
                                            </svg>
                                        @endif

                                        @if ($timeline->type == 'school')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M9.78272 3.49965C11.2037 2.83345 12.7962 2.83345 14.2172 3.49965L20.9084 6.63664C22.3639 7.31899 22.3639 9.68105 20.9084 10.3634L14.2173 13.5003C12.7963 14.1665 11.2038 14.1665 9.78281 13.5003L3.0916 10.3634C1.63613 9.68101 1.63614 7.31895 3.0916 6.63659L6 5.27307"
                                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                                <path d="M2 8.5V14" stroke="#24cdd5" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                                <path
                                                    d="M12 21C10.204 21 7.8537 19.8787 6.38533 19.0656C5.5035 18.5772 5 17.6334 5 16.6254V11.5M19 11.5V16.6254C19 17.6334 18.4965 18.5772 17.6147 19.0656C17.0843 19.3593 16.4388 19.6932 15.7459 20"
                                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        @endif

                                        @if ($timeline->type == 'child_birth')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M8.00012 16.6066C9.1493 17.4664 10.5185 17.9874 12 17.9998C16.142 18.0343 19.5937 14.0798 19.5603 9.8043C19.5268 5.52875 16.142 2.03476 12 2.00026C7.858 1.96576 4.52734 5.4038 4.56077 9.67936C4.56976 10.8295 4.81252 11.9605 5.24326 13"
                                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                                <path d="M15.5 9C15.4867 7.35641 14.1436 6.01326 12.5 6"
                                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                                <path
                                                    d="M12 20.3502C12.3212 20.3502 12.4818 20.3502 12.5933 20.3283C13.2466 20.1999 13.6441 19.5557 13.4511 18.9384C13.4181 18.833 13.342 18.6962 13.1896 18.4227M12 20.3502C11.6788 20.3502 11.5182 20.3502 11.4067 20.3283C10.7534 20.1999 10.3559 19.5557 10.5489 18.9384C10.5819 18.833 10.658 18.6962 10.8104 18.4227M12 20.3502V22.5"
                                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        @endif

                                        @if ($timeline->type == 'work')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M2 14C2 10.2288 2 8.34315 3.17157 7.17157C4.34315 6 6.22876 6 10 6H14C17.7712 6 19.6569 6 20.8284 7.17157C21.4816 7.82475 21.7706 8.69989 21.8985 10M22 14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22878 22 4.34314 22 3.17157 20.8284C2.51839 20.1752 2.22937 19.3001 2.10149 18"
                                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                                <path
                                                    d="M16 6C16 4.11438 16 3.17157 15.4142 2.58579C14.8284 2 13.8856 2 12 2C10.1144 2 9.17157 2 8.58579 2.58579C8 3.17157 8 4.11438 8 6"
                                                    stroke="#24cdd5" stroke-width="1.5" />
                                                <path
                                                    d="M17 9C17 9.55228 16.5523 10 16 10C15.4477 10 15 9.55228 15 9C15 8.44772 15.4477 8 16 8C16.5523 8 17 8.44772 17 9Z"
                                                    fill="#24cdd5" />
                                                <path
                                                    d="M9 9C9 9.55228 8.55228 10 8 10C7.44772 10 7 9.55228 7 9C7 8.44772 7.44772 8 8 8C8.55228 8 9 8.44772 9 9Z"
                                                    fill="#24cdd5" />
                                            </svg>
                                        @endif


                                        <!-- <i class="fas fa-circle"></i> -->
                                    </div>

                                    <div class="tracking-date defaultcolor fs-4 wow fadeIn" data-wow-delay="300ms">
                                        {{ \Carbon\Carbon::parse($timeline->date)->format('Y') }}<span
                                            class="fs-6">{{ \Carbon\Carbon::parse($timeline->date)->format('M d') }}</span>
                                    </div>
                                    <div class="border">
                                        <div class="tracking-content defaultcolor fs-6">
                                            {{ __('aigenerate.timeline_types.' . $timeline->type) }}<span>
                                                @if ($timeline->type)
                                                    <span class="pt-2 fs-6">
                                                        {{ $timeline->title }}
                                                    </span>
                                                @endif
                                            </span></div>

                                    </div>
                                </div>
                            @endforeach


                            {{-- <div class="tracking-item ">

                                <div class="tracking-icon status-intransit">
                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true"
                                        data-prefix="fas" data-icon="circle" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                    <!-- <i class="fas fa-circle"></i> -->
                                </div>

                                <div class="tracking-date">Aug 10, 2018<span>05:01 PM</span></div>
                                <div class="border">
                                    <div class="tracking-content">DESTROYEDPER SHIPPER INSTRUCTION<span>KUALA LUMPUR
                                            (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>

                                </div>
                            </div> --}}

                            {{-- <div class="tracking-item">
                                <div class="tracking-icon status-outfordelivery">
                                    <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true"
                                        data-prefix="fas" data-icon="shipping-fast" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
                                        </path>
                                    </svg>
                                    <!-- <i class="fas fa-shipping-fast"></i> -->
                                </div>
                                <div class="tracking-date">Jul 20, 2018<span>08:58 AM</span></div>
                                <div class="border">
                                    <div class="tracking-content">Shipment is out for despatch by KLHB023.<span>KUALA
                                            LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Timeline -->

    <!-- Counters -->
    <section id="bg-counters" class="padding bg-counters parallax">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-3 col-md-3 col-sm-3 bottom10">
                    <div class="counters whitecolor  top10 bottom10">
                        <span class="count_nums font-light"
                            data-to="{{ \Carbon\Carbon::parse($memorial->birth_date)->locale('hu')->translatedFormat('Y') }}"
                            data-speed="2500"> </span>
                    </div>
                    {{-- <h3 class="font-light whitecolor top20">Since We Started</h3> --}}
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h3 class="whitecolor top20 bottom20 font-light title">{{ $memorial->motto }}</h3>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 bottom10">
                    <div class="counters whitecolor top10 bottom10">
                        <span class="count_nums font-light"
                            data-to="{{ \Carbon\Carbon::parse($memorial->death_date)->locale('hu')->translatedFormat('Y') }}"
                            data-speed="2500"> </span>
                    </div>
                    {{-- <h3 class="font-light whitecolor top20">Since We Started</h3> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Counters ends-->

    <!-- Family tree -->
    <section id="family-tree" class="position-relative padding_top">

        <div class="col-md-12 text-center wow fadeIn top15" data-wow-delay="300ms">
            <h2 class="heading bottom45 darkcolor font-light2">{{ __('Family Tree') }}<span class="font-normal"></span>

            </h2>
            <div class="col-md-8 offset-md-2 bottom40">
                <p>
                    {{ __('A diagram showing family kinship relationships, including a person`s ancestors and descendants such as parents, children, and grandparents.') }}
                </p>
            </div>
        </div>
        {{-- @dump($family) --}}
        <div class="tree-container padding_bottom">
            <div class="tree wow fadeIn" data-wow-delay="300ms">
                <ul class="down">
                    <!-- My Grand Parents -->
                    <li class="down">
                        <a {{ $grandfatherFather?->qr_code ? 'href=' . route('memorial.show', $grandfatherFather->qr_code) : '' }}
                            target="_blank">
                            <img src="{{ isset($grandfatherFather) && $grandfatherFather->photo ? asset('memorial/' . $grandfatherFather->photo) : asset('avatar/avatar-father.png') }}"
                                class="img-fluid rounded-circle" width="90" height="90">
                            <div class="memorial-name mt-2">
                                {{ $grandfatherFather->name ?? __('Grand Father') }}
                            </div>

                            @if (!empty($grandfatherFather->qr_code))
                                <div class="position-absolute" title="{{ __('Qr code') }}"
                                    style="cursor: pointer; top: 0; right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="15px"
                                        height="15px" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1">
                                        <title />
                                        <path
                                            d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                    </svg>
                                </div>
                            @endif


                            {{-- <div class="position-absolute" title="{{ __('Qr code') }}"
                                style="cursor: pointer; top: 0; right: 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="15px" height="15px"
                                    viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1">
                                    <title />
                                    <path
                                        d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                </svg>
                            </div> --}}

                        </a>
                    </li>
                    <li class="up">
                        <a {{ $grandmotherFather?->qr_code ? 'href=' . route('memorial.show', $grandmotherFather->qr_code) : '' }}
                            target="_blank">
                            <img src="{{ isset($grandmotherFather) && $grandmotherFather->photo ? asset('memorial/' . $grandmotherFather->photo) : asset('avatar/avatar-woman.png') }}"
                                class="img-fluid rounded-circle" width="90" height="90">
                            <div class="memorial-name mt-2">
                                {{ $grandmotherFather->name ?? __('Grand Mother') }}
                            </div>
                            @if (!empty($grandmotherFather->qr_code))
                                <div class="position-absolute" title="{{ __('Qr code') }}"
                                    style="cursor: pointer; top: 0; right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="15px"
                                        height="15px" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1">
                                        <title />
                                        <path
                                            d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                    </svg>
                                </div>
                            @endif
                        </a>
                    </li>
                    <li class="down">
                        <a {{ $grandfatherMother?->qr_code ? 'href=' . route('memorial.show', $grandfatherMother->qr_code) : '' }}
                            target="_blank">
                            <img src="{{ isset($grandfatherMother) && $grandfatherMother->photo ? asset('memorial/' . $grandfatherMother->photo) : asset('avatar/avatar-father.png') }}"
                                class="img-fluid rounded-circle" width="90" height="90">
                            <div class="memorial-name mt-2">
                                {{ $grandfatherMother->name ?? __('Grand Father') }}
                            </div>
                            @if (!empty($grandfatherMother->qr_code))
                                <div class="position-absolute" title="{{ __('Qr code') }}"
                                    style="cursor: pointer; top: 0; right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="15px"
                                        height="15px" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1">
                                        <title />
                                        <path
                                            d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                    </svg>
                                </div>
                            @endif
                        </a>
                    </li>
                    <li class="up">
                        <a {{ $grandmotherMother?->qr_code ? 'href=' . route('memorial.show', $grandmotherMother->qr_code) : '' }}
                            target="_blank">
                            <img src="{{ $grandmotherMother?->photo ? asset('memorial/' . $grandmotherMother->photo) : asset('avatar/avatar-woman.png') }}"
                                class="img-fluid rounded-circle" width="90" height="90">
                            <div class="memorial-name mt-2">
                                {{ $grandmotherMother->name ?? __('Grand Mother') }}
                            </div>
                            @if (!empty($grandmotherMother->qr_code))
                                <div class="position-absolute" title="{{ __('Qr code') }}"
                                    style="cursor: pointer; top: 0; right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="15px"
                                        height="15px" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1">
                                        <title />
                                        <path
                                            d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                    </svg>
                                </div>
                            @endif
                        </a>
                    </li>
                </ul>
                <ul class="down">
                    <!-- My Parents -->

                    <li class="down">
                        <ul class="apa">
                            <a {{ $father?->qr_code ? 'href=' . route('memorial.show', $father->qr_code) : '' }}
                                target="_blank">
                                <img src="{{ isset($father) && $father->photo ? asset('memorial/' . $father->photo) : asset('avatar/avatar-man.png') }}"
                                    class="img-fluid rounded-circle" width="90" height="90">
                                <div class="memorial-name mt-2">
                                    {{ $father->name ?? __('Father') }}
                                </div>
                                @if (!empty($father->qr_code))
                                    <div class="position-absolute" title="{{ __('Qr code') }}"
                                        style="cursor: pointer; top: 0; right: 5px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="15px"
                                            height="15px" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1">
                                            <title />
                                            <path
                                                d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                        </svg>
                                    </div>
                                @endif
                            </a>
                        </ul>
                    </li>

                    <li class="up mom">
                        <ul class="apa">
                            <a {{ $mother?->qr_code ? 'href=' . route('memorial.show', $mother->qr_code) : '' }}
                                target="_blank">
                                <img src="{{ isset($mother) && $mother->photo ? asset('memorial/' . $mother->photo) : asset('avatar/avatar-girl.png') }}"
                                    class="img-fluid rounded-circle" width="90" height="90">
                                <div class="memorial-name mt-2">
                                    {{ $mother->name ?? __('Mother') }}
                                </div>
                                @if (!empty($mother->qr_code))
                                    <div class="position-absolute" title="{{ __('Qr code') }}"
                                        style="cursor: pointer; top: 0; right: 5px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="15px"
                                            height="15px" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1">
                                            <title />
                                            <path
                                                d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                        </svg>
                                    </div>
                                @endif
                            </a>
                        </ul>
                    </li>
                </ul>

                <ul>
                    <ul>
                        <li>
                            @foreach ($partners as $partner)
                                @if ($partner->name || $partner->photo)
                                    <a {{ $partner?->qr_code ? 'href=' . route('memorial.show', $partner->qr_code) : '' }}
                                        target="_blank">
                                        <img src="{{ $partner->photo ? asset('memorial/' . $partner->photo) : asset('avatar/avatar-woman.png') }}"
                                            class="img-fluid rounded-circle" width="90" height="90">
                                        <div class="memorial-name mt-2">
                                            {{ $partner->name ?? __('Partner') }}
                                        </div>
                                        @if (!empty($partner->qr_code))
                                            <div class="position-absolute" title="{{ __('Qr code') }}"
                                                style="cursor: pointer; top: 0; right: 5px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#666666" width="15px"
                                                    height="15px" viewBox="0 0 200 200" data-name="Layer 1"
                                                    id="Layer_1">
                                                    <title />
                                                    <path
                                                        d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </a>
                                @endif
                            @endforeach

                            <a style="background: #c8e4f8;">
                                <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                                    class="img-fluid rounded-circle" width="90" height="90">
                                <div class="memorial-name mt-2">
                                    {{ $memorial->name }}
                                </div>
                            </a>

                            <!-- My Children -->
                            @if ($childrens?->isNotEmpty())
                                @php $hasValidChildren = false; @endphp

                                @foreach ($childrens as $children)
                                    @if ($children->name || $children->photo)
                                        @php $hasValidChildren = true; @endphp
                                        @break
                                    @endif
                                @endforeach

                                @if ($hasValidChildren)
                                    <ul>
                                        @foreach ($childrens as $children)
                                            @if ($children->name || $children->photo)
                                                <li>
                                                    <a {{ $children?->qr_code ? 'href=' . route('memorial.show', $children->qr_code) : '' }}
                                                        target="_blank">
                                                        <img src="{{ $children->photo ? asset('memorial/' . $children->photo) : asset('avatar/avatar-woman.png') }}"
                                                            class="img-fluid rounded-circle" width="90"
                                                            height="90">
                                                        <div class="memorial-name mt-2">
                                                            {{ $children->name ?? __('Child') }}
                                                        </div>
                                                        @if (!empty($children->qr_code))
                                                            <div class="position-absolute"
                                                                title="{{ __('Qr code') }}"
                                                                style="cursor: pointer; top: 0; right: 5px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#666666"
                                                                    width="15px" height="15px"
                                                                    viewBox="0 0 200 200" data-name="Layer 1"
                                                                    id="Layer_1">
                                                                    <title />
                                                                    <path
                                                                        d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            @endif

                        </li>
                        @if ($siblings && $siblings->isNotEmpty())
                            @foreach ($siblings as $sibling)
                                @if ($sibling->name || $sibling->photo)
                                    <li>
                                        <a {{ $sibling?->qr_code ? 'href=' . route('memorial.show', $sibling->qr_code) : '' }}
                                            target="_blank">
                                            <img src="{{ $sibling->photo ? asset('memorial/' . $sibling->photo) : asset('avatar/avatar-woman.png') }}"
                                                class="img-fluid rounded-circle" width="90" height="90">
                                            <div class="memorial-name mt-2">
                                                {{ $sibling->name ?? __('Sibling') }}
                                            </div>
                                            @if (!empty($sibling->qr_code))
                                                <div class="position-absolute" title="{{ __('Qr code') }}"
                                                    style="cursor: pointer; top: 0; right: 5px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#666666"
                                                        width="15px" height="15px" viewBox="0 0 200 200"
                                                        data-name="Layer 1" id="Layer_1">
                                                        <title />
                                                        <path
                                                            d="M75,15H35A20.06,20.06,0,0,0,15,35V75A20.06,20.06,0,0,0,35,95H75A20.06,20.06,0,0,0,95,75V35A20.06,20.06,0,0,0,75,15Zm0,60H35V35H75Zm0,30H35a20.06,20.06,0,0,0-20,20v40a20.06,20.06,0,0,0,20,20H75a20.06,20.06,0,0,0,20-20V125A20.06,20.06,0,0,0,75,105Zm0,60H35V125H75ZM165,15H125a20.06,20.06,0,0,0-20,20V75a20.06,20.06,0,0,0,20,20h40a20.06,20.06,0,0,0,20-20V35A20.06,20.06,0,0,0,165,15Zm0,60H125V35h40ZM50,65H60a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,50,65Zm0,90H60a5.38,5.38,0,0,0,5-5V140a5.38,5.38,0,0,0-5-5H50a5.38,5.38,0,0,0-5,5v10A5.38,5.38,0,0,0,50,155Zm90-90h10a5.38,5.38,0,0,0,5-5V50a5.38,5.38,0,0,0-5-5H140a5.38,5.38,0,0,0-5,5V60A5.38,5.38,0,0,0,140,65Zm-30,80h10a5.38,5.38,0,0,0,5-5V130a5.38,5.38,0,0,1,5-5h10a5.38,5.38,0,0,0,5-5V110a5.38,5.38,0,0,0-5-5H110a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5Zm70-40H170a5.38,5.38,0,0,0-5,5v30a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V110A5.38,5.38,0,0,0,180,105Zm-60,60H110a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,120,165Zm60,0H170a5.38,5.38,0,0,1-5-5V150a5.38,5.38,0,0,0-5-5H130a5.38,5.38,0,0,0-5,5v10a5.38,5.38,0,0,0,5,5h10a5.38,5.38,0,0,1,5,5v10a5.38,5.38,0,0,0,5,5h30a5.38,5.38,0,0,0,5-5V170A5.38,5.38,0,0,0,180,165Z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </section>
    <!-- Family tree ends -->

    <!-- Testimonials -->
    <section id="testimonials" class="padding bglight">
        <div class="container">
            <div class="row">
                <h2 class="d-none"></h2>
                <div class="col-md-12 col-sm-12">
                    <div id=""></div>
                    <div id="tracking">
                        <div class="col-md-12 text-center wow fadeIn top15" data-wow-delay="300ms">
                            <h2 class="heading bottom45 darkcolor font-light2">
                                {{ __('Commemorations') }}
                            </h2>
                            <div class="col-md-8 offset-md-2 bottom40">
                                <p>{{ __('Share your common moments, feelings, and thoughts.') }}</p>
                            </div>
                        </div>
                        <div class="comments-list row justify-content-center">
                            <div class="col-md-10 col-sm-12 col-lg-8">


                                @forelse($comments as $comment)
                                    <div class="comment-box wow fadeIn mb-3" data-wow-delay="300ms">

                                        <div class="d-flex gap-3">
                                            <img src="{{ asset('dark/imgs/header/circle-badge4.png') }}"
                                                alt="User Avatar" class="user-avatar">
                                            <div class="flex-grow-1">
                                                <div class="mb-2">
                                                    <h6 class="mb-0 defaultcolor fs-4">{{ $comment->name }}</h6>
                                                    <span
                                                        class="comment-time">{{ $comment->created_at->format('Y M d') }}</span>
                                                </div>
                                                <p class="mb-2">“{{ $comment->content }}”</p>

                                            </div>

                                            @if ($comment->hasPhoto())
                                                <div class="comment-photo">
                                                    <div class="cbp-item mb-0 me-0 brand graphics position-relative d-inline-block"
                                                        style="border-radius: 4px;">
                                                        <img src="{{ $comment->photo_url }}"
                                                            alt="Фото от {{ $comment->name }}" class="img-fluid"
                                                            style="max-width: 300px;">
                                                        <a href="{{ $comment->photo_url }}"
                                                            class="gallery-hvr whitecolor glightbox text-decoration-none"
                                                            data-fancybox="comment-gallery"
                                                            title="{{ __('Zoom in') }}"
                                                            style="cursor: pointer;">
                                                            <div class="center-box">
                                                                <i class="fa fa-search-plus mb-2 text-white"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center">
                                        <p class="text-gray-500">
                                            {{ __('No commemorations yet. Be the first to share your thoughts and memories.') }}
                                        </p>
                                    </div>

                            </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="container text-center mt-5">
            <button type="button" class="button gradient-btn" data-bs-toggle="modal"
                data-bs-target="#contactModal">
                {{ __('Add Commemoration') }}
                <i class="far fa-comment ms-2"></i>

            </button>
        </div>

        <!--contact us-->
        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 text-center">
                                    {{-- <span class="defaultcolor">Quisque tellus risus</span> --}}
                                    <div class="heading-title bottom25 darkcolor">
                                        <h2 class="font-normal darkcolor">{{ __('Add Commemoration') }}</h2>
                                    </div>
                                    <div class="col-md-6 offset-md-3 pb-3">
                                        <p>
                                            {{ __('Share your common moments, feelings, and thoughts.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 text-center text-md-start">
                                    <div class="contact-meta pl-0 pl-sm-5">
                                        <div class="heading-title heading_small">
                                            {{-- <span class="defaultcolor mb-2">Fotó a Megemlékezéshez:</span> --}}
                                            <h4 class="darkcolor font-normal">
                                                {{ __('Photo for Commemoration:') }}
                                            </h4>
                                        </div>
                                        <div class="my-3">
                                            <p id="photo-description" class="bottom10">
                                                {{ __('You can add a photo to your commemoration. The photo will be displayed alongside your message.') }}
                                            </p>

                                            <div id="preview-container" class="mt-3" style="display: none;">
                                                <img id="preview-image" src="#" alt="Előnézeti kép"
                                                    class="img-fluid rounded"
                                                    style="max-width: 250px; max-height: 170px;">
                                            </div>

                                            <div class="mb-3">
                                                <label for="comment_photo" class="form-label">
                                                    {{ __('Select Photo') }}
                                                </label>
                                                <input class="form-control" type="file" id="comment_photo"
                                                    name="comment_photo" accept="image/*"
                                                    onchange="previewImage(event)">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="heading-title">
                                        <form class="getin_form" id="addcomment"
                                            data-memorial-id="{{ $memorial->id }}">
                                            @csrf

                                            <div class="row px-2">
                                                <div class="col-12" id="result1"></div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input class="form-control" id="name1" type="text"
                                                            placeholder="Név" required name="userName"
                                                            style="border: 1px solid #d7d7d7;">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="message1" placeholder="Üzenet" required name="message"
                                                            style="border: 1px solid #d7d7d7;     color: #373737;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" id="submit_btn1"
                                                        class="button gradient-btn w-100">{{ __('Send message') }}</button>

                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> --}}
                </div>
            </div>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
            <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ __('Commemoration added successfully!') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
            {{-- <div id="successToast" class="toast alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    An example success alert with an icon
                </div>
            </div> --}}

        </div>


        <!--contact us end-->

    </section>

    <!-- Testimonials -->

    {{-- <section id="our-testimonial">
    <div class="parallax page-header testimonial-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-6 col-md-12 text-center text-lg-end">
                    <div class="heading-title wow fadeInRight padding_testi" data-wow-delay="300ms">
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
            <div class="item testi-box">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12 text-center">
                        <div class="testimonial-round d-inline-block">
                            <img src="images/testimonial-5.jpg" alt="">
                        </div>
                        <h4 class="defaultcolor font-light top15"><a href="#.">John Smith</a></h4>
                        <p>UPWORK, New York</p>
                    </div>
                    <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                        <p class="bottom15 top90">We have a number of different teams within our agency that specialise in different areas of business so you can be sure that you won’t receive a generic service and although we boast a years and years of service.</p>
                        <span class="d-inline-block test-star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--item 2-->
            <div class="item testi-box">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12 text-center">
                        <div class="testimonial-round d-inline-block">
                            <img src="images/testimonial-2.jpg" alt="">
                        </div>
                        <h4 class="defaultcolor font-light top15"><a href="#.">Hayden Wood</a></h4>
                        <p>FIVERR, Italy</p>
                    </div>
                    <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                        <p class="bottom15 top90">Trax’s customer testimonial page is another beauty. Its simple design focuses on videos and standout quotes from customers. This approach is clean, straightforward, text that can be overwhelming and easy to skip.</p>
                        <span class="d-inline-block test-star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--item 3-->
            <div class="item testi-box">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12 text-center">
                        <div class="testimonial-round d-inline-block">
                            <img src="images/testimonial-3.jpg" alt="">
                        </div>
                        <h4 class="defaultcolor font-light top15"><a href="#.">Kevin Miller</a></h4>
                        <p>ENVATO, Australia</p>
                    </div>
                    <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                        <p class="bottom15 top90">Trax is a company that provides tools to help professional event planning and execution, and their customers are very happy folks! The thing I love about their customer testimonial page provides content formats.</p>
                        <span class="d-inline-block test-star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--item 4-->
            <div class="item testi-box">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12 text-center">
                        <div class="testimonial-round d-inline-block">
                            <img src="images/testimonial-4.jpg" alt="">
                        </div>
                        <h4 class="defaultcolor font-light top15"><a href="#.">Alina Johanson</a></h4>
                        <p>INTEL, Sidney</p>
                    </div>
                    <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                        <p class="bottom15 top90">Startup Institute is a career accelerator that allows professionals to learn new skills, take their careers in a different direction, and pursue a career they are passionate about that have completed the program.</p>
                        <span class="d-inline-block test-star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!--Testimonials Ends-->



    <!-- map -->
    {{-- <div class="w-100">
    <div id="map" class="full-map"></div>
</div> --}}
    <!-- map end -->
    <!-- Stay connected US -->
    {{-- <section id="stayconnect">
    <div class="container position-relative">
        <div class="contactus-wrapp position-absolute shadow-equal">
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
                                    <input class="form-control" type="text" placeholder="Name" required id="userName" name="userName">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="companyName" class="d-none"></label>
                                    <input class="form-control" type="text" placeholder="Company"  id="companyName" name="companyName">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="d-none"></label>
                                    <input class="form-control" type="email" placeholder="Email" required id="email" name="email">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <button type="submit" class="button gradient-btn w-100" id="submit_btn">subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!-- Contact US ends -->
    <!--Site Footer Here-->
    <footer id="site-footer" class=" bgdark padding_top">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <a href="index.html" class="footer_logo bottom25"><img src="white/logo-rememus-qr-3.png"
                                alt="trax"></a>
                        <p class="whitecolor bottom25">Keep away from people who try to belittle your ambitions Small
                            people always do that but the really great Friendly.</p>

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
                </div> --}}
                <div class="col-lg-3 col-md-4 col-sm-12 mt-4  d-flex justify-content-center justify-content-md-start">
                    <a href="index.html" class="footer_logo bottom25"><img src="white/logo-rememus-qr-4.png"
                            alt="trax"></a>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 d-flex justify-content-end">
                    <div class="footer_panel padding_bottom_half bottom20 ps-0 ps-lg-5">
                        <h3 class="whitecolor bottom25"></h3>
                        <ul class="links nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link pagescroll scrollupto" href="#home">{{ __('History') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link pagescroll" href="#gallery">{{ __('Gallery') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pagescroll" href="#timeline">{{ __('Timeline') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link pagescroll" href="#family-tree">{{ __('Family Tree') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link pagescroll" href="#testimonials">Megemlékezések</a>
                            </li> --}}
                            <li class="nav-item">
                                @auth
                                    <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                @else
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Log In') }}</a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20 ps-0 ps-lg-5">
                        
                        <h3 class="whitecolor bottom25">Navigation</h3>
                        <ul class="links ">
                            <li><a href="#home" class="pagescroll">Home</a></li>
                            <li><a href="#about" class="pagescroll scrollupto">About Us</a></li>
                            <li><a href="#pricing" class="pagescroll">Our Pricing</a></li>
                        </ul>
                    </div>
                </div> --}}
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
    {{-- <script src="white/js/jquery.fancybox.min.js"></script> --}}
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

    <script>
        // Функция для предварительного просмотра изображения
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const photoDescription = document.getElementById('photo-description');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                    photoDescription.textContent = 'Kiválasztott kép előnézete:';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
                photoDescription.textContent =
                    'Adj hozzá egy fotót a megjegyzésedhez, és lepd meg a rokonaidat egy egyedi képpel.';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const commentForm = document.getElementById('addcomment');
            if (!commentForm) return;

            commentForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const form = e.target;
                const memorialId = form.dataset.memorialId;
                const formData = new FormData(form);

                // Добавляем фото в FormData (если выбрано)
                const photoInput = document.getElementById('comment_photo');
                if (photoInput && photoInput.files[0]) {
                    formData.append('comment_photo', photoInput.files[0]);
                }

                // Блокируем кнопку отправки
                const submitBtn = document.getElementById('submit_btn1');
                const originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Küldés...';

                fetch(`/${memorialId}/comments`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw err;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        form.reset();

                        // Скрываем предварительный просмотр
                        document.getElementById('preview-container').style.display = 'none';
                        document.getElementById('photo-description').textContent =
                            'Adj hozzá egy fotót a megjegyzésedhez, és lepd meg a rokonaidat egy egyedi képpel.';

                        // Закрываем Bootstrap модальное окно
                        const modalEl = document.getElementById('contactModal');
                        const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap
                            .Modal(modalEl);
                        modalInstance.hide();

                        // Показываем Bootstrap Toast
                        const toastEl = document.getElementById('successToast');
                        const toast = new bootstrap.Toast(toastEl);
                        toast.show();

                        // Очищаем result блок (если есть)
                        document.getElementById('result1').innerHTML = '';
                    })
                    .catch(error => {
                        console.error(error);
                        let errorMessage = 'Érvénytelen adatok';

                        if (error.errors) {
                            // Laravel validation errors
                            const firstError = Object.values(error.errors)[0];
                            if (firstError && firstError[0]) {
                                errorMessage = firstError[0];
                            }
                        } else if (error.message) {
                            errorMessage = error.message;
                        }

                        document.getElementById('result1').innerHTML =
                            `<div class="alert alert-danger">Hiba történt: ${errorMessage}</div>`;
                    })
                    .finally(() => {
                        // Восстанавливаем кнопку
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                    });
            });
        });

        
// $(document).ready(function() {
//     // Переопределяем все кнопки с переводами и правильными иконками
//     $.fancybox.defaults.btnTpl.close = 
//         '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{ __('Bezárás') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m12.71 12 5.29-5.29a.5.5 0 0 0-.71-.71L12 10.29 6.71 5.29a.5.5 0 0 0-.71.71L10.29 12 5.29 17.29a.5.5 0 0 0 .71.71L12 13.41l5.29 5.29a.5.5 0 0 0 .71-.71z"/></svg></button>';
    
//     $.fancybox.defaults.btnTpl.arrowLeft = 
//         '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{ __('Előző') }}"><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.36-2.68 2.72H19v1.98H8.6l2.68 2.71z"/></svg></div></button>';
    
//     $.fancybox.defaults.btnTpl.arrowRight = 
//         '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{ __('Következő') }}"><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.72 8.3l1.34-1.37L19 12l-4.94 5.07-1.34-1.36 2.68-2.72H5v-1.98h10.4l-2.68-2.71z"/></svg></div></button>';
    
//     $.fancybox.defaults.btnTpl.smallBtn = 
//         '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{ __('Bezárás') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="m10,10 L22,22 M22,10 L10,22"></path></svg></button>';
    
//     $.fancybox.defaults.btnTpl.zoom = 
//         '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ __('Nagyítás') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"/></svg></button>';
    
//     $.fancybox.defaults.btnTpl.slideShow = 
//         '<button data-fancybox-play class="fancybox-button fancybox-button--play" title="{{ __('Diavetítés indítása') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 5.4v13.2l11-6.6z"/></svg></button>';
    
//     $.fancybox.defaults.btnTpl.fullScreen = 
//         '<button data-fancybox-fullscreen class="fancybox-button fancybox-button--fsenter" title="{{ __('Teljes képernyő') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg></button>';
    
//     $.fancybox.defaults.btnTpl.thumbs = 
//         '<button data-fancybox-thumbs class="fancybox-button fancybox-button--thumbs" title="{{ __('Miniatűrök') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14.59 14.59h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76H5.65V5.65z"/></svg></button>';
    
//     $.fancybox.defaults.btnTpl.download = 
//         '<button data-fancybox-download class="fancybox-button fancybox-button--download" title="{{ __('Letöltés') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.62 17.09V19H5.38v-1.91zm-2.97-6.96L17 11.45l-5 4.87-5-4.87 1.36-1.32 2.68 2.64V5h1.92v7.77l2.69-2.64z"/></svg></button>';
    
//     $.fancybox.defaults.btnTpl.share = 
//         '<button data-fancybox-share class="fancybox-button fancybox-button--share" title="{{ __('Megosztás') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.55 19c1.4-8.4 9.1-9.8 11.9-9.8V5l7 7-7 6.3v-3.5c-2.8 0-10.5 2.1-11.9 4.2z"/></svg></button>';
// });

$(document).ready(function() {
    // Переопределяем все кнопки с переводами и правильными иконками
    $.fancybox.defaults.btnTpl.close = 
        '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{ __('Close') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m12.71 12 5.29-5.29a.5.5 0 0 0-.71-.71L12 10.29 6.71 5.29a.5.5 0 0 0-.71.71L10.29 12 5.29 17.29a.5.5 0 0 0 .71.71L12 13.41l5.29 5.29a.5.5 0 0 0 .71-.71z"/></svg></button>';
    
    $.fancybox.defaults.btnTpl.arrowLeft = 
        '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{ __('Previous') }}"><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.36-2.68 2.72H19v1.98H8.6l2.68 2.71z"/></svg></div></button>';
    
    $.fancybox.defaults.btnTpl.arrowRight = 
        '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{ __('Next') }}"><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.72 8.3l1.34-1.37L19 12l-4.94 5.07-1.34-1.36 2.68-2.72H5v-1.98h10.4l-2.68-2.71z"/></svg></div></button>';
    
    $.fancybox.defaults.btnTpl.smallBtn = 
        '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{ __('Close') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="m10,10 L22,22 M22,10 L10,22"></path></svg></button>';
    
    $.fancybox.defaults.btnTpl.zoom = 
        '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ __('Zoom In') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"/></svg></button>';
    
    $.fancybox.defaults.btnTpl.slideShow = 
        '<button data-fancybox-play class="fancybox-button fancybox-button--play" title="{{ __('Start Slideshow') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 5.4v13.2l11-6.6z"/></svg></button>';
    
    $.fancybox.defaults.btnTpl.fullScreen = 
        '<button data-fancybox-fullscreen class="fancybox-button fancybox-button--fsenter" title="{{ __('Fullscreen') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg></button>';
    
    $.fancybox.defaults.btnTpl.thumbs = 
        '<button data-fancybox-thumbs class="fancybox-button fancybox-button--thumbs" title="{{ __('Thumbnails') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14.59 14.59h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76H5.65V5.65z"/></svg></button>';
    
    $.fancybox.defaults.btnTpl.download = 
        '<button data-fancybox-download class="fancybox-button fancybox-button--download" title="{{ __('Download') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.62 17.09V19H5.38v-1.91zm-2.97-6.96L17 11.45l-5 4.87-5-4.87 1.36-1.32 2.68 2.64V5h1.92v7.77l2.69-2.64z"/></svg></button>';
    
    $.fancybox.defaults.btnTpl.share = 
        '<button data-fancybox-share class="fancybox-button fancybox-button--share" title="{{ __('Share') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.55 19c1.4-8.4 9.1-9.8 11.9-9.8V5l7 7-7 6.3v-3.5c-2.8 0-10.5 2.1-11.9 4.2z"/></svg></button>';
});

    </script>


    <script src="white/js/jquery.fancybox.min.js"></script>


</body>

</html>
