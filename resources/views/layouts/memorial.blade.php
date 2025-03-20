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
    <link rel="shortcut icon" href="admin/imgs/favicon.ico">

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
                            <div class="link cursor-pointer dmenu"><span class="fill-text" data-text="Home">Home</span>
                                <i></i>
                            </div>
                        </div>
                        <div class="sub-menu">
                            <ul>
                                <li>
                                    <a href="../startup_agency/index.html" class="sub-link">Startup Agency</a>
                                </li>
                                <li>
                                    <a href="../creative-studio/index.html" class="sub-link">Creative Studio</a>
                                </li>
                                <li>
                                    <a href="../creative_agency/index.html" class="sub-link">Creative Agency</a>
                                </li>
                                <li>
                                    <a href="../digital-marketing/index.html" class="sub-link">Digital Marketing</a>
                                </li>
                                <li>
                                    <a href="../modern_portfolio/index.html" class="sub-link">Modern Portfolio</a>
                                </li>
                                <li>
                                    <a href="../digital_studio/index.html" class="sub-link">Digital Studio</a>
                                </li>
                                <li>
                                    <a href="../modern_agency/index.html" class="sub-link">Modern Agency</a>
                                </li>
                                <li>
                                    <a href="../creative_agency2/index.html" class="sub-link">Creative Agency 2</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="o-hidden">
                            <div class="link cursor-pointer dmenu"><span class="fill-text"
                                    data-text="Pages">Pages</span>
                                <i></i>
                            </div>
                        </div>
                        <div class="sub-menu">
                            <ul>
                                <li>
                                    <a href="../inner_pages/about.html" class="sub-link">About
                                        Us</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/services.html" class="sub-link">Our
                                        Services</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/service-details.html" class="sub-link">Services Details</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/team.html" class="sub-link">Our
                                        Team</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/pricing.html" class="sub-link">Pricing</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/faqs.html" class="sub-link">FAQS</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/contact.html" class="sub-link">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="o-hidden">
                            <div class="link cursor-pointer dmenu"><span class="fill-text"
                                    data-text="Portfolio">Portfolio</span>
                                <i></i>
                            </div>
                        </div>
                        <div class="sub-menu">
                            <ul>
                                <li>
                                    <a href="../inner_pages/portfolio-standard.html" class="sub-link">Standard</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/portfolio-gallery.html" class="sub-link">Gallery</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/portfolio-cards.html" class="sub-link">Card</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/portfolio-layout2.html" class="sub-link">Grid 2 Column</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/portfolio-layout3.html" class="sub-link">Gid 3 Column</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/portfolio-layout4.html" class="sub-link">Grid 4 Column</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/project-details.html" class="sub-link">Project Details</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="o-hidden">
                            <div class="link cursor-pointer dmenu"><span class="fill-text" data-text="Blog">Blog</span>
                                <i></i>
                            </div>
                        </div>
                        <div class="sub-menu">
                            <ul>
                                <li>
                                    <a href="../inner_pages/blog-grid.html" class="sub-link">Blog Grid</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/blog-standard.html" class="sub-link">Blog Standard</a>
                                </li>
                                <li>
                                    <a href="../inner_pages/blog-details.html" class="sub-link">Blog Details</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="o-hidden">
                            <a href="../inner_pages/contact.html" class="link"><span class="fill-text"
                                    data-text="Contact Us">Contact
                                    Us</span></a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="cont-info valign">
                <div class="text-center full-width">
                    <div class="logo">
                        <img src="../common/imgs/Logo-light.svg" alt="">
                    </div>
                    <div class="social-icon mt-40">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-x-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-linkedin-in"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                    </div>
                    <div class="item mt-30">
                        <h5>541 Melville Geek, <br> Palo Alto, CA 94301</h5>
                    </div>
                    <div class="item mt-10">
                        <h5><a href="#0">Hello@email.com</a></h5>
                        <h5 class="underline"><a href="#0">+1 840 841 25 69</a></h5>
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
