<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title  -->
    <title>Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('common/css/plugins.css') }}">

    <!-- Style for individual style contain common & this home style -->
    <link rel="stylesheet" href="{{ asset('common/css/common_style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <!-- Style for combined style contain common & all pages styles -->
    <!-- <link rel="stylesheet" href="../common/css/combined_style.css"> -->

    @yield('css')
</head>

<body>



    <!-- ==================== Start Loading ==================== -->

    <!-- <div class="loader-wrap">
        <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
        </svg>

        <div class="loader-wrap-heading">
            <div class="load-text">
                <span>L</span>
                <span>o</span>
                <span>a</span>
                <span>d</span>
                <span>i</span>
                <span>n</span>
                <span>g</span>
            </div>
        </div>
    </div> -->

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

    <div class="hamenu">
        <div class="close-menu cursor-pointer ti-close"></div>
        <div class="container-fluid rest d-flex">
            <div class="menu-links">
                <ul class="main-menu rest">

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('dashboard.edit', $memorial) }}" class="link"><span class="fill-text"
                                    data-text="{{ __('Edit data') }}">{{ __('Edit data') }}</span></a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('dashboard.photos', $memorial) }}" class="link"><span class="fill-text"
                                    data-text="{{ __('Photos') }}">{{ __('Photos') }}</span></a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('dashboard.video', $memorial) }}" class="link"><span class="fill-text"
                                    data-text="{{ __('Video') }}">{{ __('Video') }}</span></a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('dashboard.comments', $memorial) }}" class="link"><span class="fill-text"
                                    data-text="{{ __('Comments') }}">{{ __('Comments') }}</span></a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('dashboard.family', $memorial) }}" class="link"><span class="fill-text"
                                    data-text="{{ __('Family') }}">{{ __('Family') }}</span></a>
                        </div>
                    </li>

                    <li>
                        <div class="o-hidden">
                            <a href="{{ route('dashboard.settings', $memorial) }}" class="link"><span class="fill-text"
                                    data-text="{{ __('Settings') }}">{{ __('Settings') }}</span></a>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="cont-info valign">
                <div class="text-center full-width">
                    <div class="logo">
                        {{-- <img src="../common/imgs/Logo-light.svg" alt=""> --}}
                    </div>
                    <div class="social-icon mt-40">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-x-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-linkedin-in"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                    </div>
                    <div class="item mt-30">
                        <h5>Magyarorszag, <br> Budapest</h5>
                    </div>
                    <div class="item mt-10">
                        <h5><a href="#0">info@rememus.com</a></h5>
                        <h5 class="underline"><a href="#0">+36 20 841 25 69</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== End Navbar ==================== -->


    <div id="smooth-wrapper">


        <div id="smooth-content">

            <main>


                <div class="main-container container-xxl d-flex ">
                    <div class="left-side">
                        <div>

                            <nav class="navbar navbar-expand-lg d-md-none">

                                <!-- Logo -->
                                <a class="logo" href="#">
                                    {{-- <img src="{{ asset('admin/imgs/Logo.svg') }}" alt="logo"> --}}
                                    <span style="color: #000000">
                                        {{ $memorial->name }}
                                    </span>

                                    
                                </a>

                                <div class="topnav ml-auto">
                                    <div class="menu-icon cursor-pointer">
                                        <span class="icon ti-align-right" style="color: #000000"></span>
                                    </div>
                                </div>
                            </nav>

                            <div class="info md-hide about-ca">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}" style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover;" alt="" class="img-fluid">
                                </div>
                                
                                <div class="cont text-center mt-10">
                                    <ul class="rest">
                                        <li>{{ $memorial->name }}</li>
                                    </ul>
                                    <div class="">

                                    </div>
                                </div>
                            </div>
                            <div class="md-hide mt-20">
                                <a href="{{ route('dashboard.edit', $memorial) }}" class="butn butn-md butn-bord butn-rounded w-100 text-start {{ Route::currentRouteName() === 'dashboard.edit' ? 'active' : '' }}">
                                    <span class="icon me-2">
                                        <i class="fa-solid fa-pen"></i>
                                    </span>
                                    <span>{{ __('Edit data') }}</span>
                                </a>
                            
                                <a href="{{ route('dashboard.photos', ['memorial' => $memorial->slug]) }}" class="butn butn-md butn-bord butn-rounded w-100 text-start {{ Route::currentRouteName() === 'dashboard.photos' ? 'active' : '' }}">
                                    <span class="icon mr-10">
                                        <i class="fa-solid fa-image"></i>
                                    </span>
                                    <span>{{ __('Photos') }}</span>
                                </a>
                            
                                <a href="{{ route('dashboard.video', ['memorial' => $memorial->slug]) }}" class="butn butn-md butn-bord butn-rounded w-100 text-start {{ Route::currentRouteName() === 'dashboard.video' ? 'active' : '' }}">
                                    <span class="icon mr-10">
                                        <i class="fa-solid fa-video"></i>
                                    </span>
                                    <span>{{ __('Video') }}</span>
                                </a>
                            
                                <a href="{{ route('dashboard.comments', ['memorial' => $memorial->slug]) }}" class="butn butn-md butn-bord butn-rounded w-100 text-start {{ Route::currentRouteName() === 'dashboard.comments' ? 'active' : '' }}">
                                    <span class="icon mr-10">
                                        <i class="fa-solid fa-comments"></i>
                                    </span>
                                    <span>{{ __('Comments') }}</span>
                                </a>

                                <a href="{{ route('dashboard.family', ['memorial' => $memorial->slug]) }}" class="butn butn-md butn-bord butn-rounded w-100 text-start {{ Route::currentRouteName() === 'dashboard.family' ? 'active' : '' }}">
                                    <span class="icon mr-10">
                                        <i class="fa-solid fa-users"></i>
                                    </span>
                                    <span>{{ __('Family') }}</span>
                                </a>
                            
                                <a href="{{ route('dashboard.timeline', ['memorial' => $memorial->slug]) }}" class="butn butn-md butn-bord butn-rounded w-100 text-start {{ Route::currentRouteName() === 'dashboard.timeline' ? 'active' : '' }}">
                                    <span class="icon mr-10">
                                        <i class="fa-solid fa-users"></i>
                                    </span>
                                    <span>{{ __('Timeline') }}</span>
                                </a>

                                <a href="{{ route('dashboard.settings', ['memorial' => $memorial->slug]) }}" class="butn butn-md butn-bord butn-rounded w-100 text-start {{ Route::currentRouteName() === 'dashboard.settings' ? 'active' : '' }}">
                                    <span class="icon me-2">
                                        <i class="fa-solid fa-gear"></i>
                                    </span>
                                    <span>{{ __('Settings') }}</span>
                                </a>

                                <a href="{{ route('dashboard') }}" class="butn butn-md butn-bord butn-rounded w-100 text-start">
                                    <span class="icon me-2">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </span>
                                    <span>{{ __('Dashboard') }}</span>
                                </a>

                                {{-- <a class="butn butn-md butn-bord butn-rounded w-100 text-start" href="{{ route('dashboard') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <span class="icon mr-10">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </span>
                                    {{ __('Logout') }}
                                </a> --}}

                                {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form> --}}

                            </div>
                        </div>

                        

                        <div class="md-hide">
                            <a href="{{ route('dashboard.help', ['memorial' => $memorial->slug]) }}" class="butn butn-md butn-bord butn-rounded {{ Route::currentRouteName() === 'dashboard.help' ? 'active' : '' }}">
                                <div class="d-flex align-items-center">
                                    <span class="icon mr-10">
                                        <i class="fa-regular fa-circle-question"></i>
                                    </span>
                                    <span>{{ __('Help') }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="right-side">

                        @yield('content')

                    </div>
                </div>

            </main>


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
    <script src="{{ asset('common/js/gsap_lib/matter.js') }}"></script>
    <script src="{{ asset('common/js/gsap_lib/throwable.js') }}"></script>

    <!-- common scripts -->
    <script src="{{ asset('common/js/common_scripts.js') }}"></script>

    <!-- custom scripts -->
    <script src="{{ asset('admin/js/scripts.js') }}"></script>

    @yield('js')

</body>

</html>
