@extends('layouts.home')

@section('title', 'Rememus.com - Címlap')

@section('css')
    <style>

    </style>
@endsection

@section('content')

    <!-- ==================== Start Header ==================== -->

    <header class="header-mst bg-img d-none d-md-block" data-background="home/imgs/header/bg.jpg" data-overlay-dark="4">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="caption">
                        <h3 class="d-none d-md-block">
                            <br>
                        </h3>

                        <h4 class="mt-4 mb-2 d-none d-md-block">
                            Emlékhely, ahol a szeretteink örökké élnek.
                        </h4>

                        <h7 class="d-none d-md-block">
                            Hozz létre egy méltó emlékoldalt elhunyt szeretteid számára.
                            Elmeséljük a történetüket, emléküket megőrizzük az idők végezetéig.
                        </h7>

                        <h5 class="d-block d-md-none">
                            Emlékhely, ahol a szeretteink örökké élnek.
                        </h5>

                        <h7 class="d-block d-md-none mt-50">
                            Hozz létre egy méltó emlékoldalt elhunyt szeretteid számára.
                            Elmeséljük a történetüket, emléküket megőrizzük az idők végezetéig.
                        </h7>
                        <!-- <h1>We Invest <br> In Big Ideas</h1> -->
                    </div>
                </div>
            </div>
            <div class="row justify-content-between mt-80">
                <div class="col-lg-6 order-md-2">
                    <div class="butons">
                        <a href="/create" class="bg">
                            <span>Emlékoldal <br> létrehozása</span>
                        </a>
                        <a href="https://shop.rememus.com/Emlekplakettek" target="_blank" class="bord">
                            <span class="icon invert ml-5 mb-1">
                                <svg fill="#ffffffa6" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px"
                                    viewBox="0 0 490.875 490.875" xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
                                                        c-18.359,0-35.082-9.312-44.729-24.912c-6.822-11.033-9.033-24.246-6.75-36.915h-143.67c2.273,12.669,0.063,25.881-6.758,36.922
                                                        c-9.639,15.592-26.362,24.904-44.721,24.904c-9.765,0-19.316-2.723-27.646-7.869c-18.835-11.656-27.646-33.364-23.974-53.957
                                                        H39.263C17.575,178.11,0,195.685,0,217.373c0,21.676,17.575,39.25,39.263,39.25h4.331l28.793,175.116
                                                        c3.019,18.319,18.847,31.771,37.423,31.771h271.254c18.575,0,34.403-13.452,37.42-31.771l28.784-175.114h4.343
                                                        c21.686,0,39.264-17.576,39.264-39.251C490.875,195.686,473.295,178.111,451.611,178.111z M167.419,418.083
                                                        c-1.186,0.174-2.36,0.266-3.523,0.266c-11.459,0-21.503-8.391-23.269-20.069l-16.306-108.682
                                                        c-1.931-12.87,6.931-24.861,19.801-26.792c12.886-1.875,24.853,6.931,26.792,19.793l16.31,108.692
                                                        C189.155,404.157,180.289,416.151,167.419,418.083z M268.997,394.782c0,13.018-10.541,23.564-23.552,23.564
                                                        c-13.016,0-23.552-10.549-23.552-23.564V286.093c0-13.004,10.537-23.553,23.552-23.553c13.011,0,23.552,10.549,23.552,23.553
                                                        V394.782z M366.561,289.596l-16.317,108.682c-1.754,11.68-11.797,20.069-23.256,20.069c-1.168,0-2.338-0.091-3.527-0.266
                                                        c-12.869-1.931-21.732-13.926-19.801-26.792l16.307-108.692c1.938-12.87,13.857-21.732,26.791-19.794
                                                        C359.625,264.734,368.49,276.727,366.561,289.596z"></path>
                                                <path
                                                    d="M102.748,218.713c6.037,3.74,12.748,5.521,19.379,5.521c12.341,0,24.407-6.199,31.362-17.464
                                                        c6.415-10.375,6.967-22.646,2.739-33.151l69.947-113.048c6.321-10.222,3.16-23.611-7.062-29.944
                                                        c-3.566-2.203-7.522-3.263-11.423-3.263c-7.286,0-14.402,3.661-18.528,10.324l-69.924,113.048
                                                        c-11.282,0.906-22.02,6.86-28.435,17.232C80.086,185.283,85.449,208.003,102.748,218.713z">
                                                </path>
                                                <path d="M334.652,173.619c-4.228,10.505-3.688,22.776,2.729,33.151c6.967,11.266,19.021,17.464,31.373,17.464
                                                        c6.629,0,13.332-1.781,19.379-5.521c17.299-10.71,22.65-33.431,11.937-50.745c-6.398-10.372-17.146-16.326-28.418-17.232
                                                        L301.7,37.688c-4.114-6.664-11.231-10.324-18.519-10.324c-3.899,0-7.855,1.06-11.427,3.263
                                                        c-10.218,6.333-13.354,19.722-7.058,29.944L334.652,173.619z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span> </a>
                    </div>
                </div>
                {{-- <div class="col-lg-4 order-md-1">
                    <div class="cont md-mb50">
                        <div class="d-flex align-items-center mb-15">

                            <input type="text" placeholder="keresés" class="text-light border placeholder-gray">
                            <!-- <span>No Code No Limited</span> -->
                            <div>
                                <div class="arrow ms-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <path d="M15.5 14h-.79l-.28-.27a6.51 6.51 0 0 0 1.58-4.23c0-3.59-2.91-6.5-6.5-6.5S3 5.91 3 9.5s2.91 6.5 6.5 6.5c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="#808080"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <p>Itt kereshetsz az emlékoldalak között név alapján.</p>
                    </div>
                </div> --}}

                <div class="col-lg-4 order-md-1">
                    <div class="cont md-mb50">
                        <div class="d-flex align-items-center mb-15 mt-35">

                            <input id="qr-input" type="text" placeholder="QR-kód beváltása"
                                class="text-light border placeholder-gray">

                            <div>
                                <button onclick="redirectWithCode()" class="ms-2 p-0 border-0 bg-transparent"
                                    style="width: 45px; height: 45px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                        viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="12" fill="white" />
                                        <path d="M10 6L16 12L10 18" stroke="#000" stroke-width="1" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                        {{-- <p class="ms-3">Itt válthatod be a QR-kódot.</p> --}}
                    </div>
                </div>

            </div>
        </div>
    </header>


        <header class="header-mst bg-img d-block d-md-none" style="padding: 130px 0 !important; background-position: left !important;" data-background="home/imgs/header/women.jpg" data-overlay-dark="4">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="caption">
                        <h3 class="d-none d-md-block">
                            <br>
                        </h3>

                        <h4 class="mt-4 mb-2 d-none d-md-block">
                            Emlékhely, ahol a szeretteink örökké élnek.
                        </h4>

                        <h7 class="d-none d-md-block">
                            Hozz létre egy méltó emlékoldalt elhunyt szeretteid számára.
                            Elmeséljük a történetüket, emléküket megőrizzük az idők végezetéig.
                        </h7>

                        <h5 class="d-block d-md-none">
                            Emlékhely, ahol a szeretteink örökké élnek.
                        </h5>

                        <h7 class="d-block d-md-none mt-50">
                            Hozz létre egy méltó emlékoldalt elhunyt szeretteid számára.
                            Elmeséljük a történetüket, emléküket megőrizzük az idők végezetéig.
                        </h7>
                        <!-- <h1>We Invest <br> In Big Ideas</h1> -->
                    </div>
                </div>
            </div>
            <div class="row justify-content-between mt-40">
                <div class="col-lg-6 order-md-2">
                    <div class="butons">
                        <a href="/create" class="bg">
                            <span>Emlékoldal <br> létrehozása</span>
                        </a>
                        <a href="https://shop.rememus.com/Emlekplakettek" target="_blank" class="bord">
                            <span class="icon invert ml-5 mb-1">
                                <svg fill="#ffffffa6" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px"
                                    viewBox="0 0 490.875 490.875" xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
                                                        c-18.359,0-35.082-9.312-44.729-24.912c-6.822-11.033-9.033-24.246-6.75-36.915h-143.67c2.273,12.669,0.063,25.881-6.758,36.922
                                                        c-9.639,15.592-26.362,24.904-44.721,24.904c-9.765,0-19.316-2.723-27.646-7.869c-18.835-11.656-27.646-33.364-23.974-53.957
                                                        H39.263C17.575,178.11,0,195.685,0,217.373c0,21.676,17.575,39.25,39.263,39.25h4.331l28.793,175.116
                                                        c3.019,18.319,18.847,31.771,37.423,31.771h271.254c18.575,0,34.403-13.452,37.42-31.771l28.784-175.114h4.343
                                                        c21.686,0,39.264-17.576,39.264-39.251C490.875,195.686,473.295,178.111,451.611,178.111z M167.419,418.083
                                                        c-1.186,0.174-2.36,0.266-3.523,0.266c-11.459,0-21.503-8.391-23.269-20.069l-16.306-108.682
                                                        c-1.931-12.87,6.931-24.861,19.801-26.792c12.886-1.875,24.853,6.931,26.792,19.793l16.31,108.692
                                                        C189.155,404.157,180.289,416.151,167.419,418.083z M268.997,394.782c0,13.018-10.541,23.564-23.552,23.564
                                                        c-13.016,0-23.552-10.549-23.552-23.564V286.093c0-13.004,10.537-23.553,23.552-23.553c13.011,0,23.552,10.549,23.552,23.553
                                                        V394.782z M366.561,289.596l-16.317,108.682c-1.754,11.68-11.797,20.069-23.256,20.069c-1.168,0-2.338-0.091-3.527-0.266
                                                        c-12.869-1.931-21.732-13.926-19.801-26.792l16.307-108.692c1.938-12.87,13.857-21.732,26.791-19.794
                                                        C359.625,264.734,368.49,276.727,366.561,289.596z"></path>
                                                <path
                                                    d="M102.748,218.713c6.037,3.74,12.748,5.521,19.379,5.521c12.341,0,24.407-6.199,31.362-17.464
                                                        c6.415-10.375,6.967-22.646,2.739-33.151l69.947-113.048c6.321-10.222,3.16-23.611-7.062-29.944
                                                        c-3.566-2.203-7.522-3.263-11.423-3.263c-7.286,0-14.402,3.661-18.528,10.324l-69.924,113.048
                                                        c-11.282,0.906-22.02,6.86-28.435,17.232C80.086,185.283,85.449,208.003,102.748,218.713z">
                                                </path>
                                                <path d="M334.652,173.619c-4.228,10.505-3.688,22.776,2.729,33.151c6.967,11.266,19.021,17.464,31.373,17.464
                                                        c6.629,0,13.332-1.781,19.379-5.521c17.299-10.71,22.65-33.431,11.937-50.745c-6.398-10.372-17.146-16.326-28.418-17.232
                                                        L301.7,37.688c-4.114-6.664-11.231-10.324-18.519-10.324c-3.899,0-7.855,1.06-11.427,3.263
                                                        c-10.218,6.333-13.354,19.722-7.058,29.944L334.652,173.619z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span> </a>
                    </div>
                </div>
                {{-- <div class="col-lg-4 order-md-1">
                    <div class="cont md-mb50">
                        <div class="d-flex align-items-center mb-15">

                            <input type="text" placeholder="keresés" class="text-light border placeholder-gray">
                            <!-- <span>No Code No Limited</span> -->
                            <div>
                                <div class="arrow ms-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <path d="M15.5 14h-.79l-.28-.27a6.51 6.51 0 0 0 1.58-4.23c0-3.59-2.91-6.5-6.5-6.5S3 5.91 3 9.5s2.91 6.5 6.5 6.5c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="#808080"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <p>Itt kereshetsz az emlékoldalak között név alapján.</p>
                    </div>
                </div> --}}

                <div class="col-lg-4 order-md-1">
                    <div class="cont md-mb50">
                        <div class="d-flex align-items-center mb-15 mt-35">

                            <input id="qr-input" type="text" placeholder="QR-kód beváltása"
                                class="text-light border placeholder-gray">

                            <div>
                                <button onclick="redirectWithCode()" class="ms-2 p-0 border-0 bg-transparent"
                                    style="width: 45px; height: 45px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                        viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="12" fill="white" />
                                        <path d="M10 6L16 12L10 18" stroke="#000" stroke-width="1" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                        {{-- <p class="ms-3">Itt válthatod be a QR-kódot.</p> --}}
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- ==================== End Header ==================== -->



    <!-- ==================== Start Intro ==================== -->

    <section class="hero-mst section-padding">
        <div class="container pt-50 pb-50">
            <div class="row">
                <div class="col-lg-4 offset-lg-1 md-mb80">
                    <div class="img fit-img d-none d-md-block">
                        <img src="home/imgs/intro/1.jpg" alt="">
                    </div>
                    <div class="fit-img d-block d-md-none rounded-3">
                        <img src="home/imgs/intro/1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 valign">
                    <div class="cont">

                        <h4 class="d-none d-md-block mb-3">
                            Rememus.com – A szeretet örök nyoma, emlék, amely túlél minket
                        </h4>

                        <h5 class="d-block d-md-none mb-3">
                            A rememus.com egy <br>QR-kóddal elérhető emlékoldal
                        </h5>

                        <!-- <p>Az Mbook.hu egy QR-kóddal elérhető emlékoldal, amely életrajzokat, fényképeket, videókat és személyes emlékeket tartalmaz. Tökéletes megoldás sírkövekre és urnákra.</p> -->
                        <p>

                            A Rememus emlékoldalai lehetőséget adnak arra, hogy szeretteink története, fényképei, videói és
                            közös pillanatai méltó módon fennmaradjanak – akár generációkon át.
                            Az emlékoldal egy diszkréten elhelyezett QR-kóddal válik elérhetővé a sírhelyen vagy urnán, így
                            egyetlen beolvasással bármikor felidézhetők az emlékek – akár a temetőben, akár otthon.

                        </p>
                        <br>
                        <p>
                            A megemlékező oldal QR-kód nélkül is látogatható, megosztható a családtagokkal, barátokkal. Az
                            adatok időtállóságát és hitelességét blokklánc-technológia biztosítja, így az emlék nemcsak
                            személyes, hanem megbízható és megőrizhető is – örökre.
                        </p>
                        <a href="#" class="butn-scroll butn butn-md butn-rounded bg-light mt-30">
                            <div class="d-flex align-items-center">
                                <span>Nézze meg, hogyan működik</span>
                                <span class="icon ml-10">
                                    <img src="../common/imgs/icons/arrow-top-right.svg" alt="">
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="exp">
                    <span>years of <br> experience</span>
                    <h2>18</h2>
                </div> -->
        <div class="curve">
            <img src="home/imgs/intro/Curve.svg" alt="">
        </div>
    </section>

    <!-- ==================== End Intro ==================== -->



    <!-- ==================== Start Services ==================== -->

    <!-- <section class="services-accord2 section-padding">
                <div class="container">
                    <div class="sec-head mb-80 d-flex align-items-center bord-thin-bottom-light pb-15">
                        <div>
                            <h6 class="text-u">Our Services</h6>
                        </div>
                        <div class="ml-auto">
                            <a href="../inner_pages/services.html" class="butn butn-md butn-bord butn-rounded">
                                <div class="d-flex align-items-center">
                                    <span>See Our Approach</span>
                                    <span class="icon ml-10">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="accordion wow fadeInUp slow" data-wow-delay="0.4s" id="accordionExample">
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading1">
                                <div class="accordion-title" data-bs-toggle="collapse" data-bs-target="#collapse1"
                                    aria-expanded="true" aria-controls="collapse1">
                                    <div class="d-flex align-items-end">
                                        <div class="title">
                                            <h2>Brand Strategy</h2>
                                        </div>
                                        <div class="numb ml-auto">
                                            <span>001</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text">
                                                <p>Development and building amazing digital products with best user
                                                    experiences strategy. Development and building amazing digital
                                                    products with best user experiences strategy.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 offset-lg-1">
                                            <div class="sm-hide">
                                                <div class="img fit-img">
                                                    <img src="imgs/services/1.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading2">
                                <div class="accordion-title collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                    <div class="d-flex align-items-end">
                                        <div class="title">
                                            <h2>Web Developments</h2>
                                        </div>
                                        <div class="numb ml-auto">
                                            <span>002</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text">
                                                <p>Development and building amazing digital products with best user
                                                    experiences strategy. Development and building amazing digital
                                                    products with best user experiences strategy.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 offset-lg-1">
                                            <div class="sm-hide">
                                                <div class="img fit-img">
                                                    <img src="imgs/services/2.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading3">
                                <div class="accordion-title collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                    <div class="d-flex align-items-end">
                                        <div class="title">
                                            <h2>Branding</h2>
                                        </div>
                                        <div class="numb ml-auto">
                                            <span>003</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text">
                                                <p>Development and building amazing digital products with best user
                                                    experiences strategy. Development and building amazing digital
                                                    products with best user experiences strategy.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 offset-lg-1">
                                            <div class="sm-hide">
                                                <div class="img fit-img">
                                                    <img src="imgs/services/3.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading4">
                                <div class="accordion-title collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                    <div class="d-flex align-items-end">
                                        <div class="title">
                                            <h2>Design</h2>
                                        </div>
                                        <div class="numb ml-auto">
                                            <span>004</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text">
                                                <p>Development and building amazing digital products with best user
                                                    experiences strategy. Development and building amazing digital
                                                    products with best user experiences strategy.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 offset-lg-1">
                                            <div class="sm-hide">
                                                <div class="img fit-img">
                                                    <img src="imgs/services/4.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

    <!-- ==================== End Services ==================== -->

    <!-- ==================== Start Blog ==================== -->

    <section class="testim-sm pb-100 pt-100 bg-gray" style="    background-color: #ffffff;">
        <div class="container">
            <div class="sec-head text-center mb-100">
                {{-- <h6 class="sub-title main-color mb-15">Testimonials</h6> --}}
                <h3 class="text-u">Emlékoldalak</h3>
            </div>
            <div class="swiper testim-swiper swiper-container">
                <div class="swiper-wrapper">



                    @foreach ($memorials as $memorial)
                        <div class="swiper-slide">
                            <a href="{{ route('memorial.show', $memorial->slug) }}" target="_blank">
                                <div class="item">
                                    <div class="mb-10">
                                        <div class="img img-fit">
                                            <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                                                class="img img-fit">
                                        </div>
                                    </div>
                                    <div>

                                        <div class="mt-15">
                                            <div class="info-text text-center">
                                                <span>{{ $memorial->name }}</span>
                                                <p>
                                                    {{ \Carbon\Carbon::parse($memorial->birth_date)->format('Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($memorial->death_date)->format('Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>

    <div id="howitworks" class="section-padding bg-gray">
        <div class="container">
            <div class="sec-head text-center mb-100">
                <!-- <h6 class="sub-title main-color mb-15">Our Blog</h6> -->
                <h3 class="text-u">Hogyan működik</h3>
            </div>


            {{-- <div class="row xlg-marg"> --}}

            <div class="row">
                <div class="col-lg-4 bord">
                    <div class="item md-mb50">
                        <div class="info d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6>
                                    Olvassa be a <br>
                                    QR kódot
                                </h6>
                            </div>
                            <div class="date ml-auto">
                                <span class="sub-color circle">
                                    1
                                </span>
                            </div>
                        </div>
                        <div class="img fit-img mt-30">
                            <img src="home/imgs/blog/1.png" alt="">
                        </div>
                        <div class="cont mt-30">
                            <h7>
                                Miután kézhez kapta az emlékplakettet, egyszerűen olvassa be a rajta lévő QR-kódot
                                okostelefonjával vagy rögzítse a számítógépén.
                            </h7>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 bord">
                    <div class="item md-mb50">
                        <div class="info d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6>
                                    Emlékoldal <br>
                                    létrehozása
                                </h6>
                            </div>
                            <div class="date ml-auto">
                                <span class="sub-color circle">
                                    2
                                </span>
                            </div>
                        </div>
                        <div class="img fit-img mt-30">
                            <img src="home/imgs/blog/2.png" alt="">
                        </div>
                        <div class="cont mt-30">
                            <h7>
                                Adja meg az elhunyt adatait, töltsön fel képeket, videókat, kedves történeteket – mindezt
                                okostelefonról vagy számítógépről, a többit elvégzi a mesterséges Intelligencia
                            </h7>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 bord">
                    <div class="item md-mb50">
                        <div class="info d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6>
                                    Ossza meg majd <br>rögzítse az emlékpakettet
                                </h6>
                            </div>
                            <div class="date ml-auto">
                                <span class="sub-color circle">
                                    3
                                </span>
                            </div>
                        </div>
                        <div class="img fit-img mt-30">
                            <img src="home/imgs/blog/3.png" alt="">
                        </div>
                        <div class="cont mt-30">
                            <h7>
                                Ossza meg az oldalt családtagokkal, barátokkal, akik szintén megoszthatják saját
                                gondolataikat, fotóikat vagy búcsúzó soraikat. Rögzítse a plakettet a sírhelyre, urnára vagy
                                emlékhelyre, így az emlékoldal bármikor elérhető marad – akár a helyszínen, akár online.
                            </h7>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ==================== End Blog ==================== -->

    <!-- ==================== Start about ==================== -->

    {{-- <section class="about-smt section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="sec-head ">
                        <!-- <span class="sub-title mb-15">Amit tartalmaz:</span> -->
                        <h3>Digitális emlékmű</h3>
                        <p class="mt-30">Hozzon létre egy digitális emlékművet, amely tele van szeretteinek történeteivel
                            és emlékeivel. Könnyedén rögzíthet egy elegáns, rozsdamentes acél QR-táblát, és készítsen helyet
                            minden dédelgetett fényképének, videójának és sok másnak. Ez több, mint tisztelgés, szívből jövő
                            emlékezés, mindig elérhető és örökké kincsként kezelt.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-30">
                    <a href="#" class="butn butn-md butn-rounded bg-light md-mb30">
                        <div class="d-flex align-items-center">
                            <span>Tekintse meg a mintaoldalt</span>
                            <span class="icon ml-10">
                                <img src="{{ asset('common/imgs/icons/arrow-top-right.svg') }}" alt="">
                            </span>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-lg-5">
                        <div class="text">
                            <p>Hozzon létre egy digitális emlékművet, amely tele van szeretteinek történeteivel és emlékeivel. Könnyedén rögzíthet egy elegáns, rozsdamentes acél QR-táblát, és készítsen helyet minden dédelgetett fényképének, videójának és sok másnak. Ez több, mint tisztelgés, szívből jövő emlékezés, mindig elérhető és örökké kincsként kezelt.
                            </p>
                        </div>
                    </div> -->
            </div>
            <div class="row boxs">
                <div class="col-lg-7 offset-lg-5">
                    <div class="d-flex">
                        <div class="item text-center bg-color"
                            style="background-image: url('home/imgs/intro/1.png'); background-size: cover; background-position: center; min-height: 260px;">
                            <!-- <h2>80</h2>
                                <h6>Project Completed</h6> -->
                        </div>
                        <div class="item text-center bg-light"
                            style="background-image: url('home/imgs/intro/2.png'); background-size: cover; background-position: center;">
                            <!-- <h2>17k</h2>
                                <h6>Happy Customers</h6> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-img fit-img">
            <img src="home/imgs/intro/2.jpg" alt="">
        </div>
    </section> --}}

    <!-- ==================== End about ==================== -->

    <!-- ==================== Start Price ==================== -->

    <section class="price section-padding">
        <div class="container">
            <div class="sec-head-lg text-center mb-80">
                <h2 class="text-u">Árak</h2>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="item md-mb50 wow fadeIn" data-wow-delay="0.4s">
                        <div class="head mb-30">
                            <span class="icon-img-80 mb-15">
                                <svg viewBox="-7.5 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>Book-bookmark</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs> </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" sketch:type="MSPage">
                                            <g id="Book-bookmark" sketch:type="MSLayerGroup"
                                                transform="translate(2.000000, 1.000000)" stroke="#6B6C6E"
                                                stroke-width="2">
                                                <path
                                                    d="M44,8 C45.1,8 46,8.9 46,10 L46,60 C46,61.1 45.1,62 44,62 L2,62 C0.9,62 0,61.1 0,60 L0,4"
                                                    id="Shape" sketch:type="MSShapeGroup"> </path>
                                                <path d="M5,11 L5,59" id="Shape" sketch:type="MSShapeGroup"> </path>
                                                <path
                                                    d="M44,4.5 L44,8 L3.2,8 C1.6,8 -0.1,5.9 -0.1,4 L-0.1,4 C-0.1,2.1 1.5,0 3.2,0 L41,0 C42.6,0 43.9,0.6 43.9,2.5 L44,4.5 L44,4.5 Z"
                                                    id="Shape" sketch:type="MSShapeGroup"> </path>
                                                <path d="M4,4 L40,4" id="Shape" sketch:type="MSShapeGroup"> </path>
                                                <path
                                                    d="M18.1,42 C18.1,42.6 17.7,43 17.1,43 L14.1,39 L11.1,43 C10.5,43 10.1,42.6 10.1,42 L10.1,9 C10.1,8.4 10.5,8 11.1,8 L17.1,8 C17.7,8 18.1,8.4 18.1,9 L18.1,42 L18.1,42 Z"
                                                    id="Shape" sketch:type="MSShapeGroup"> </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <h5 class="mb-10">Alap</h5>
                            <h6 class="fz-16 fw-400 sub-font">Egyszeri díj, <span class="opacity-7">örökös
                                    hozzáféréssel</span>
                            </h6>
                        </div>
                        <div class="feat mb-30 pb-30 bord-thin-bottom">
                            <ul class="rest sub-font">
                                <li><span class="ti-check icon"></span> 1 <span class="opacity-7">db</span> emlékoldal
                                </li>
                                <li><span class="ti-check icon"></span> 1 <span class="opacity-7">db</span> QR-kódos lemez
                                </li>
                                <li><span class="ti-check icon"></span> 30 fénykép</li>
                                <li><span class="ti-check icon"></span> Két oldalstílus közül választhat</li>
                                <li><span class="ti-check icon"></span> Megjegyzések korlátozás nélkül</li>
                            </ul>
                            <div class="text-center mt-40">
                                <a href="https://shop.rememus.com/Emlekplakettek" target="_blank" class="butn butn-md butn-rounded"
                                    style="border: 1px solid #2e2e2e !important;">
                                    <div class="d-flex align-items-center">
                                        <span>Vásárlás</span>
                                        <span class="icon invert ml-10 mb-1">
                                            <svg fill="#a4a4a4" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px"
                                                viewBox="0 0 490.875 490.875" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
                                                                    c-18.359,0-35.082-9.312-44.729-24.912c-6.822-11.033-9.033-24.246-6.75-36.915h-143.67c2.273,12.669,0.063,25.881-6.758,36.922
                                                                    c-9.639,15.592-26.362,24.904-44.721,24.904c-9.765,0-19.316-2.723-27.646-7.869c-18.835-11.656-27.646-33.364-23.974-53.957
                                                                    H39.263C17.575,178.11,0,195.685,0,217.373c0,21.676,17.575,39.25,39.263,39.25h4.331l28.793,175.116
                                                                    c3.019,18.319,18.847,31.771,37.423,31.771h271.254c18.575,0,34.403-13.452,37.42-31.771l28.784-175.114h4.343
                                                                    c21.686,0,39.264-17.576,39.264-39.251C490.875,195.686,473.295,178.111,451.611,178.111z M167.419,418.083
                                                                    c-1.186,0.174-2.36,0.266-3.523,0.266c-11.459,0-21.503-8.391-23.269-20.069l-16.306-108.682
                                                                    c-1.931-12.87,6.931-24.861,19.801-26.792c12.886-1.875,24.853,6.931,26.792,19.793l16.31,108.692
                                                                    C189.155,404.157,180.289,416.151,167.419,418.083z M268.997,394.782c0,13.018-10.541,23.564-23.552,23.564
                                                                    c-13.016,0-23.552-10.549-23.552-23.564V286.093c0-13.004,10.537-23.553,23.552-23.553c13.011,0,23.552,10.549,23.552,23.553
                                                                    V394.782z M366.561,289.596l-16.317,108.682c-1.754,11.68-11.797,20.069-23.256,20.069c-1.168,0-2.338-0.091-3.527-0.266
                                                                    c-12.869-1.931-21.732-13.926-19.801-26.792l16.307-108.692c1.938-12.87,13.857-21.732,26.791-19.794
                                                                    C359.625,264.734,368.49,276.727,366.561,289.596z">
                                                            </path>
                                                            <path
                                                                d="M102.748,218.713c6.037,3.74,12.748,5.521,19.379,5.521c12.341,0,24.407-6.199,31.362-17.464
                                                                    c6.415-10.375,6.967-22.646,2.739-33.151l69.947-113.048c6.321-10.222,3.16-23.611-7.062-29.944
                                                                    c-3.566-2.203-7.522-3.263-11.423-3.263c-7.286,0-14.402,3.661-18.528,10.324l-69.924,113.048
                                                                    c-11.282,0.906-22.02,6.86-28.435,17.232C80.086,185.283,85.449,208.003,102.748,218.713z">
                                                            </path>
                                                            <path
                                                                d="M334.652,173.619c-4.228,10.505-3.688,22.776,2.729,33.151c6.967,11.266,19.021,17.464,31.373,17.464
                                                                    c6.629,0,13.332-1.781,19.379-5.521c17.299-10.71,22.65-33.431,11.937-50.745c-6.398-10.372-17.146-16.326-28.418-17.232
                                                                    L301.7,37.688c-4.114-6.664-11.231-10.324-18.519-10.324c-3.899,0-7.855,1.06-11.427,3.263
                                                                    c-10.218,6.333-13.354,19.722-7.058,29.944L334.652,173.619z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="amount d-flex align-items-end">
                            <h2> 20 000 <span>ft</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item gray md-mb50 wow fadeIn" data-wow-delay="0.6s">
                        <div class="head mb-30">
                            <span class="icon-img-80 mb-5">
                                <svg version="1.1" id="Layer_1" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 57 64" enable-background="new 0 0 57 64" xml:space="preserve"
                                    fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>Stack</title>
                                        <desc>Created with Sketch.</desc>
                                        <g id="Page-1" sketch:type="MSPage">
                                            <g id="Stack" transform="translate(2.000000, 1.000000)"
                                                sketch:type="MSLayerGroup">
                                                <path id="Shape_3_" sketch:type="MSShapeGroup" fill="none"
                                                    stroke="#6B6C6E" stroke-width="2"
                                                    d="M48.9,39.3l4.2,2.5 c0.9,0.9,0.9,2.4,0,3.3L28.5,61.3c-0.9,0.9-2.4,0.9-3.3,0L0.6,45.1c-0.9-0.9-0.9-2.4,0-3.3l4.2-2.5">
                                                </path>
                                                <path id="Shape_2_" sketch:type="MSShapeGroup" fill="none"
                                                    stroke="#6B6C6E" stroke-width="2"
                                                    d="M48.9,30.6l4.2,2.5 c0.9,0.9,0.9,2.4,0,3.3L28.5,52.6c-0.9,0.9-2.4,0.9-3.3,0L0.6,36.4c-0.9-0.9-0.9-2.4,0-3.3l4.2-2.5">
                                                </path>
                                                <path id="Shape_1_" sketch:type="MSShapeGroup" fill="none"
                                                    stroke="#6B6C6E" stroke-width="2"
                                                    d="M48.9,22l4.2,2.5 c0.9,0.9,0.9,2.4,0,3.3L28.5,44c-0.9,0.9-2.4,0.9-3.3,0L0.6,27.8c-0.9-0.9-0.9-2.4,0-3.3L4.8,22">
                                                </path>
                                                <path id="Shape" sketch:type="MSShapeGroup" fill="none"
                                                    stroke="#6B6C6E" stroke-width="2"
                                                    d="M53.1,15.7c0.9,0.9,0.9,2.4,0,3.3 L28.5,35.2c-0.9,0.9-2.4,0.9-3.3,0L0.6,19c-0.9-0.9-0.9-2.4,0-3.3L25.2,1.1c0.9-0.9,2.4-0.9,3.3,0L53.1,15.7L53.1,15.7z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>

                            </span>
                            <h5 class="mb-10">Örökség</h5>
                            <h6 class="fz-16 fw-400 sub-font">Egyszeri díj, <span class="opacity-7">örökös
                                    hozzáféréssel</span>
                            </h6>
                        </div>
                        <div class="feat mb-30 pb-30 bord-thin-bottom">
                            <ul class="rest sub-font">
                                <li><span class="ti-check icon"></span> 5 <span class="opacity-7">db</span> emlékoldal
                                </li>
                                <li><span class="ti-check icon"></span> 5 <span class="opacity-7">db</span> QR-kódos lemez
                                </li>
                                <li><span class="ti-check icon"></span> 30 fénykép / <span class="opacity-7">oldal</span>
                                </li>
                                <li><span class="ti-check icon"></span> Két oldalstílus közül választhat</li>
                                <li><span class="ti-check icon"></span> Megjegyzések korlátozás nélkül</li>
                            </ul>
                            <div class="text-center mt-40">
                                <a href="https://shop.rememus.com/Emlekplakettek" target="_blank" class="butn butn-md butn-rounded"
                                    style="border: 1px solid #2e2e2e !important;">
                                    <div class="d-flex align-items-center">
                                        <span>Vásárlás</span>
                                        <span class="icon invert ml-10 mb-1">
                                            <svg fill="#a4a4a4" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px"
                                                viewBox="0 0 490.875 490.875" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
                                                                    c-18.359,0-35.082-9.312-44.729-24.912c-6.822-11.033-9.033-24.246-6.75-36.915h-143.67c2.273,12.669,0.063,25.881-6.758,36.922
                                                                    c-9.639,15.592-26.362,24.904-44.721,24.904c-9.765,0-19.316-2.723-27.646-7.869c-18.835-11.656-27.646-33.364-23.974-53.957
                                                                    H39.263C17.575,178.11,0,195.685,0,217.373c0,21.676,17.575,39.25,39.263,39.25h4.331l28.793,175.116
                                                                    c3.019,18.319,18.847,31.771,37.423,31.771h271.254c18.575,0,34.403-13.452,37.42-31.771l28.784-175.114h4.343
                                                                    c21.686,0,39.264-17.576,39.264-39.251C490.875,195.686,473.295,178.111,451.611,178.111z M167.419,418.083
                                                                    c-1.186,0.174-2.36,0.266-3.523,0.266c-11.459,0-21.503-8.391-23.269-20.069l-16.306-108.682
                                                                    c-1.931-12.87,6.931-24.861,19.801-26.792c12.886-1.875,24.853,6.931,26.792,19.793l16.31,108.692
                                                                    C189.155,404.157,180.289,416.151,167.419,418.083z M268.997,394.782c0,13.018-10.541,23.564-23.552,23.564
                                                                    c-13.016,0-23.552-10.549-23.552-23.564V286.093c0-13.004,10.537-23.553,23.552-23.553c13.011,0,23.552,10.549,23.552,23.553
                                                                    V394.782z M366.561,289.596l-16.317,108.682c-1.754,11.68-11.797,20.069-23.256,20.069c-1.168,0-2.338-0.091-3.527-0.266
                                                                    c-12.869-1.931-21.732-13.926-19.801-26.792l16.307-108.692c1.938-12.87,13.857-21.732,26.791-19.794
                                                                    C359.625,264.734,368.49,276.727,366.561,289.596z">
                                                            </path>
                                                            <path
                                                                d="M102.748,218.713c6.037,3.74,12.748,5.521,19.379,5.521c12.341,0,24.407-6.199,31.362-17.464
                                                                    c6.415-10.375,6.967-22.646,2.739-33.151l69.947-113.048c6.321-10.222,3.16-23.611-7.062-29.944
                                                                    c-3.566-2.203-7.522-3.263-11.423-3.263c-7.286,0-14.402,3.661-18.528,10.324l-69.924,113.048
                                                                    c-11.282,0.906-22.02,6.86-28.435,17.232C80.086,185.283,85.449,208.003,102.748,218.713z">
                                                            </path>
                                                            <path
                                                                d="M334.652,173.619c-4.228,10.505-3.688,22.776,2.729,33.151c6.967,11.266,19.021,17.464,31.373,17.464
                                                                    c6.629,0,13.332-1.781,19.379-5.521c17.299-10.71,22.65-33.431,11.937-50.745c-6.398-10.372-17.146-16.326-28.418-17.232
                                                                    L301.7,37.688c-4.114-6.664-11.231-10.324-18.519-10.324c-3.899,0-7.855,1.06-11.427,3.263
                                                                    c-10.218,6.333-13.354,19.722-7.058,29.944L334.652,173.619z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="amount d-flex align-items-end">
                            <h2> 18 000 <span>ft</span></h2>
                            <p class="ms-2"> / darab</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item dark wow fadeIn" data-wow-delay="0.8s">
                        <div class="head mb-30">
                            <span class="icon-img-80 mb-15">
                                <img src="home/imgs/price/3.svg" alt="">
                            </span>
                            <h5 class="mb-10">Egyedi ajánlat</h5>
                            <h6 class="fz-16 fw-400 sub-font">Egyszeri díj, <span class="opacity-7">örökös
                                    hozzáféréssel</span>
                            </h6>
                        </div>
                        <div class="feat mb-30 pb-30 bord-thin-bottom-light">
                            <ul class="rest sub-font">
                                <li><span class="ti-check icon"></span> 10 <span class="opacity-7">db</span> emlékoldal
                                </li>
                                <li><span class="ti-check icon"></span> 10 <span class="opacity-7">db</span> QR-kódos
                                    lemez</li>
                                <li><span class="ti-check icon"></span> 30 fénykép / <span class="opacity-7">oldal</span>
                                </li>
                                <li><span class="ti-check icon"></span> Két oldalstílus közül választhat</li>
                                <li><span class="ti-check icon"></span> Megjegyzések korlátozás nélkül</li>
                            </ul>
                            <!-- <a href="#0" class="view mt-15">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="37" height="36"
                                            viewBox="0 0 37 36" fill="none">
                                            <path
                                                d="M1 35L34.2929 1.70711C34.9229 1.07714 36 1.52331 36 2.41421V21.5H29.5"
                                                stroke="#141414" stroke-width="2"></path>
                                        </svg>
                                    </a> -->

                            <div class="text-center mt-40">
                                <a href="https://shop.rememus.com/Emlekplakettek" target="_blank" class="butn butn-md butn-bord butn-rounded" >
                                    <div class="d-flex align-items-center">
                                        <span>Vásárlás</span>
                                        <span class="icon invert ml-10 mb-1">
                                            <svg fill="#a4a4a4" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px"
                                                viewBox="0 0 490.875 490.875" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
                                                                    c-18.359,0-35.082-9.312-44.729-24.912c-6.822-11.033-9.033-24.246-6.75-36.915h-143.67c2.273,12.669,0.063,25.881-6.758,36.922
                                                                    c-9.639,15.592-26.362,24.904-44.721,24.904c-9.765,0-19.316-2.723-27.646-7.869c-18.835-11.656-27.646-33.364-23.974-53.957
                                                                    H39.263C17.575,178.11,0,195.685,0,217.373c0,21.676,17.575,39.25,39.263,39.25h4.331l28.793,175.116
                                                                    c3.019,18.319,18.847,31.771,37.423,31.771h271.254c18.575,0,34.403-13.452,37.42-31.771l28.784-175.114h4.343
                                                                    c21.686,0,39.264-17.576,39.264-39.251C490.875,195.686,473.295,178.111,451.611,178.111z M167.419,418.083
                                                                    c-1.186,0.174-2.36,0.266-3.523,0.266c-11.459,0-21.503-8.391-23.269-20.069l-16.306-108.682
                                                                    c-1.931-12.87,6.931-24.861,19.801-26.792c12.886-1.875,24.853,6.931,26.792,19.793l16.31,108.692
                                                                    C189.155,404.157,180.289,416.151,167.419,418.083z M268.997,394.782c0,13.018-10.541,23.564-23.552,23.564
                                                                    c-13.016,0-23.552-10.549-23.552-23.564V286.093c0-13.004,10.537-23.553,23.552-23.553c13.011,0,23.552,10.549,23.552,23.553
                                                                    V394.782z M366.561,289.596l-16.317,108.682c-1.754,11.68-11.797,20.069-23.256,20.069c-1.168,0-2.338-0.091-3.527-0.266
                                                                    c-12.869-1.931-21.732-13.926-19.801-26.792l16.307-108.692c1.938-12.87,13.857-21.732,26.791-19.794
                                                                    C359.625,264.734,368.49,276.727,366.561,289.596z">
                                                            </path>
                                                            <path
                                                                d="M102.748,218.713c6.037,3.74,12.748,5.521,19.379,5.521c12.341,0,24.407-6.199,31.362-17.464
                                                                    c6.415-10.375,6.967-22.646,2.739-33.151l69.947-113.048c6.321-10.222,3.16-23.611-7.062-29.944
                                                                    c-3.566-2.203-7.522-3.263-11.423-3.263c-7.286,0-14.402,3.661-18.528,10.324l-69.924,113.048
                                                                    c-11.282,0.906-22.02,6.86-28.435,17.232C80.086,185.283,85.449,208.003,102.748,218.713z">
                                                            </path>
                                                            <path
                                                                d="M334.652,173.619c-4.228,10.505-3.688,22.776,2.729,33.151c6.967,11.266,19.021,17.464,31.373,17.464
                                                                    c6.629,0,13.332-1.781,19.379-5.521c17.299-10.71,22.65-33.431,11.937-50.745c-6.398-10.372-17.146-16.326-28.418-17.232
                                                                    L301.7,37.688c-4.114-6.664-11.231-10.324-18.519-10.324c-3.899,0-7.855,1.06-11.427,3.263
                                                                    c-10.218,6.333-13.354,19.722-7.058,29.944L334.652,173.619z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="amount d-flex align-items-end">
                            <h2> 15 000 <span>ft</span></h2>
                            <p class="ms-2"> / darab</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== End Price ==================== -->

    <section class="testim-sm mt-100">
        <div class="container">
            <div class="sec-head text-center">
                <!-- <h6 class="sub-title main-color mb-15">Testimonials</h6> -->
                {{-- <h3 class="text-u">Mit tartalmaz egy emlékoldal?</h3> --}}
                <h3 class="d-none d-md-block mb-3">
                    Az emlékoldal fő pillérei
                </h3>

                <h5 class="d-block d-md-none mb-3">
                    Az emlékoldal fő pillérei
                </h5>

            </div>

            <!-- <div class="row">
                        <div class="col-lg-4">
                            <div class="item">
                                <div class="mb-20">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>Fényképek és videók</h6>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="">
                                                <span class="iconcir pe-7s-photo ml-10 fz-20"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div class="mt-15">
                                        <h6 class="fz-16">
                                            Könnyedén feltöltheti saját fényképeit és videóit, hogy örökre megőrzésre kerüljenek az emlékoldalon. Lehetőséget adhat barátoknak és családtagoknak is, hogy megosszák saját emlékeiket.

                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="item">
                                <div class="mb-20">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>Életrajz</h6>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="">
                                                <span class="iconcir pe-7s-notebook ml-10 fz-20"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div class="mt-15">
                                        <h6 class="fz-16">
                                            Másolja be a gyászjelentést, élettörténetet vagy bármilyen emléket, amelyet meg szeretne őrizni a jövő generációi számára, hogy megismerhessék és inspirációt meríthessenek belőle.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="item">
                                <div class="mb-20 ">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>Elérhető</h6>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="">
                                                <span class="iconcir pe-7s-diamond ml-10 fz-20"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div class="mt-15">
                                        <h6 class="fz-16">
                                            Célunk, hogy szeretteink emlékének megőrzése egyszerű és elérhető legyen mindenki számára. Hiszünk abban, hogy minden sírkövön QR-kódnak kell lennie, hogy senki se merüljön feledésbe.
                                        
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="item mt-30">
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>Idővonal</h6>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="">
                                                <span class="iconcir pe-7s-timer ml-10 fz-20"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div class="">
                                        <h6 class="fz-16">
                                            Hozzon létre egy idővonalat szerette fontos életpillanatairól. Társítsa az eseményekhez fényképeket, hogy még teljesebb képet adjon életútjáról, és örökre megőrizze azokat.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="item mt-30">
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>Megemlékezések</h6>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="">
                                                <span class="iconcir pe-7s-medal ml-10 fz-20"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div class="">
                                        <h6 class="fz-16">
                                            Gyűjtsön össze történeteket és fényképeket családtagoktól vagy barátoktól. Ossza meg szerette emlékoldalának linkjét közösségi médiában, e-mailben vagy üzenetben.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="item mt-30">
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>Emléktábla a temetésen</h6>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="">
                                                <span class="iconcir pe-7s-id ml-10 fz-20"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div class="">
                                        <h6 class="fz-16">
                                            Nyomtassa ki a QR-kódot, és helyezze el a temetésen, ravatalozáson vagy megemlékezési eseményen, hogy a vendégek is megoszthassák emlékeiket és részvétüket.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> -->



        </div>
    </section>

    <!-- ==================== Start Testimonials ==================== -->

    <!-- <section class="testim-sm section-padding">
                <div class="container">
                    <div class="sec-head text-center mb-100">
                        <h6 class="sub-title main-color mb-15">Testimonials</h6>
                        <h3 class="text-u">What Our Clients Say?</h3>
                    </div>
                    <div class="swiper testim-swiper swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="mb-70">
                                        <div class="info d-flex align-items-center pt-30 mb-15">
                                            <div>
                                                <div class="img-author">
                                                    <img src="imgs/testim/avatar1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="info-text">
                                                <span>Bradley Gordon</span>
                                                <p>CEO & Founder, Archin Studio</p>
                                            </div>
                                        </div>
                                        <h3>“Excellent</h3>
                                    </div>
                                    <div>
                                        <div class="rate">
                                            <h5>5.0
                                                <span class="stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </h5>
                                        </div>
                                        <div class="mt-15">
                                            <h6 class="fz-16">A studio with passionate, professional and full
                                                creativity. Much
                                                more than i’m expect. Great services, high quality products &
                                                affordable prices. I’m extremly satisfied!.</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="mb-70">
                                        <div class="info d-flex align-items-center pt-30 mb-15">
                                            <div>
                                                <div class="img-author">
                                                    <img src="imgs/testim/avatar1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="info-text">
                                                <span>Bradley Gordon</span>
                                                <p>CEO & Founder, Archin Studio</p>
                                            </div>
                                        </div>
                                        <h3>“Excellent</h3>
                                    </div>
                                    <div>
                                        <div class="rate">
                                            <h5>5.0
                                                <span class="stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </h5>
                                        </div>
                                        <div class="mt-15">
                                            <h6 class="fz-16">A studio with passionate, professional and full
                                                creativity. Much
                                                more than i’m expect. Great services, high quality products &
                                                affordable prices. I’m extremly satisfied!.</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="mb-70">
                                        <div class="info d-flex align-items-center pt-30 mb-15">
                                            <div>
                                                <div class="img-author">
                                                    <img src="imgs/testim/avatar1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="info-text">
                                                <span>Bradley Gordon</span>
                                                <p>CEO & Founder, Archin Studio</p>
                                            </div>
                                        </div>
                                        <h3>“Excellent</h3>
                                    </div>
                                    <div>
                                        <div class="rate">
                                            <h5>5.0
                                                <span class="stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </h5>
                                        </div>
                                        <div class="mt-15">
                                            <h6 class="fz-16">A studio with passionate, professional and full
                                                creativity. Much
                                                more than i’m expect. Great services, high quality products &
                                                affordable prices. I’m extremly satisfied!.</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="mb-70">
                                        <div class="info d-flex align-items-center pt-30 mb-15">
                                            <div>
                                                <div class="img-author">
                                                    <img src="imgs/testim/avatar1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="info-text">
                                                <span>Bradley Gordon</span>
                                                <p>CEO & Founder, Archin Studio</p>
                                            </div>
                                        </div>
                                        <h3>“Excellent</h3>
                                    </div>
                                    <div>
                                        <div class="rate">
                                            <h5>5.0
                                                <span class="stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </h5>
                                        </div>
                                        <div class="mt-15">
                                            <h6 class="fz-16">A studio with passionate, professional and full
                                                creativity. Much
                                                more than i’m expect. Great services, high quality products &
                                                affordable prices. I’m extremly satisfied!.</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="mb-70">
                                        <div class="info d-flex align-items-center pt-30 mb-15">
                                            <div>
                                                <div class="img-author">
                                                    <img src="imgs/testim/avatar1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="info-text">
                                                <span>Bradley Gordon</span>
                                                <p>CEO & Founder, Archin Studio</p>
                                            </div>
                                        </div>
                                        <h3>“Excellent</h3>
                                    </div>
                                    <div>
                                        <div class="rate">
                                            <h5>5.0
                                                <span class="stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </h5>
                                        </div>
                                        <div class="mt-15">
                                            <h6 class="fz-16">A studio with passionate, professional and full
                                                creativity. Much
                                                more than i’m expect. Great services, high quality products &
                                                affordable prices. I’m extremly satisfied!.</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

    <!-- ==================== End Testimonials ==================== -->

    <div class="testim-sm faqs section-padding">

        <div class="position-re">
            <div class="container ontop">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="item">
                                    <div class="mb-20">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6>Életrajz</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="">
                                                    <span class="iconcir pe-7s-notebook ml-10 fz-20"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="mt-15">
                                            <h6 class="fz-16">
                                                Adja meg a fontos mérföldköveket – legyen az a gyászjelentés, egy részletes
                                                élettörténet vagy néhány emlékezetes esemény-pont. Mi ezekből automatikusan
                                                felépítjük a kronológiai idővonalat, majd mesterséges intelligencia
                                                segítségével gördülékeny, inspiráló történetté szerkesztjük, hogy a jövő
                                                generációi is megismerhessék és példát meríthessenek belőle.
                                            </h6>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="col-lg-6 mt-lg-0 mt-4">
                                <div class="item ">
                                    <div class=" ">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6>Elérhető és emlékeztet.</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="">
                                                    <span class="iconcir pe-7s-diamond ml-10 fz-20"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="mt-15">
                                            <h6 class="fz-16">
                                                Célunk, hogy szeretteink emlékének megőrzése egyszerű, bárki számára
                                                hozzáférhető legyen. Hiszünk abban, hogy minden sírkőn helye van egy
                                                QR-kódnak, hogy senki se merüljön feledésbe. A rendszer emlékeztet a fontos
                                                évfordulókra – például születésnapra vagy halálozási évfordulóra –, így a
                                                családtagok és barátok időben értesülnek, és az emlékoldalon virággal,
                                                jókívánsággal vagy meghitt üzenettel róhatják le tiszteletüket.

                                            </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6 mt-lg-0 mt-4">
                                <div class="item mt-30">
                                    <div class="">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6>Fényképek és videók</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="">
                                                    <span class="iconcir pe-7s-photo ml-10 fz-20"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="">
                                            <h6 class="fz-16">
                                                Töltsön fel kedvenc fotókat és videókat, hogy az emlékek méltó módon örökre
                                                fennmaradjanak. Barátait és családtagjait is meghívhatja, hogy saját
                                                felvételeikkel, közös pillanataikkal gazdagítsák az emlékoldalt.
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6 mt-lg-0 mt-4">
                                <div class="item mt-30">
                                    <div class="">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6>Megemlékezések</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="">
                                                    <span class="iconcir pe-7s-medal ml-10 fz-20"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="">
                                            <h6 class="fz-16">
                                                Gyűjtse össze a családtagok és barátok történeteit, fényképeit és személyes
                                                üzeneteit. Ossza meg az emlékoldal linkjét közösségi médiában, e-mailben
                                                vagy üzenetben, hogy bárki könnyedén hozzátehesse saját emlékeit.
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <div class="imgs">
                <div class="img1 fit-img wow fadeIn" data-wow-delay="0.4s"
                    style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                    <img src="home/imgs/hero/f3.png" alt="">
                </div>
                <div class="img2 fit-img wow fadeIn" data-wow-delay="0.6s"
                    style="visibility: visible; animation-delay: 0.6s; animation-name: fadeIn;">
                    <img src="home/imgs/hero/f1.png" alt="">
                </div>
                <div class="img3 fit-img wow fadeIn" data-wow-delay="0.8s"
                    style="visibility: visible; animation-delay: 0.8s; animation-name: fadeIn;">
                    <img src="home/imgs/hero/f2.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Start Blog ==================== -->

    <div class="blog-mp section-padding bg-gray" id="faqs">
        <div class="container">

            <section class="faqs-ds pt-0">
                <div class="container">
                    <div class="sec-head text-center mb-70">
                        {{-- <h2>Gyakran Ismételt Kérdések</h2> --}}
                        <h3 class="d-none d-md-block mb-3">
                            Gyakran Ismételt Kérdések
                        </h3>

                        <h5 class="d-block d-md-none mb-3">
                            Gyakran Ismételt Kérdések
                        </h5>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accordion" id="accordionExample">

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading3">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false"
                                            aria-controls="collapse3">
                                            Van-e folyamatos költsége a weboldal fenntartásának?
                                        </button>
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                Nem! Elkötelezettek vagyunk a megfizethetőség mellett, egyszeri vásárlást
                                                kínálunk egy személyre szabható Tisztelgésünk emlékművünkhöz. Ez a
                                                szolgáltatás akár 50 fénykép, korlátlan számú videó és szöveges tárolást is
                                                tartalmaz az online tiszteletadáshoz. Azok számára, akik még több emléket
                                                szeretnének felvenni, éves előfizetéssel extra fotótárhelyet biztosítanak,
                                                így szerettei digitális emlékhelye átfogó és naprakész.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading4">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                                            aria-controls="collapse4">
                                            Nem váltja fel végül a QR-kódokat egy másik technológia?
                                        </button>
                                    </h2>
                                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                A szakértők úgy vélik, hogy a QR-kódok még hosszú ideig léteznek, ipari
                                                gyökereiktől kezdve jelentős szerepük lesz az emlékművekben. Ezek a kódok
                                                nem tárolják szeretett személyének adatait; ehelyett közvetlen linkként
                                                működnek a Tributes weboldalunkon található személyes oldalukra. Biztos
                                                lehet benne, hogy az információkat biztonságosan tároljuk és könnyen
                                                hozzáférhetők. A QR-kódokat tartós technológiának tekintik, amely
                                                biztosítja, hogy még az új technológiák megjelenésével is, a digitális
                                                emlékmű elérhető és biztonságos online maradjon.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading5">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false"
                                            aria-controls="collapse5">
                                            Elajándékozhatom-e a QR kódot családomnak, vagy a barátoknak?
                                        </button>
                                    </h2>
                                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                Igen, rugalmasan létrehozhat egy digitális emlékoldalt valakinek, majd
                                                átruházhatja annak tulajdonjogát egy másik személyre. A címzettnek
                                                egyszerűen létre kell hoznia egy fiókot a ourtributes.com oldalon. Miután
                                                fiókjuk aktív lett, küldjön e-mailben egy átviteli kérelmet, amely
                                                tartalmazza mindkét fél e-mail címét és a szeretett személy nevét. Csapatunk
                                                hatékonyan kezeli az online tribute oldal átadását.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading6">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false"
                                            aria-controls="collapse6">
                                            Használható-e egyetlen oldal 2 személyre, például egy párra?
                                        </button>
                                    </h2>
                                    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                Igen, egy emlékoldal használható egy pár, például egy szülő vagy nagyszülő
                                                számára. Jelenleg az egyetlen korlátozás az, hogy csak egy hely van a
                                                születési és halálozási dátumoknak. Ezeket üresen hagyhatja a promptokban,
                                                és manuálisan beillesztheti az „Életrajz” szakaszba, hogy mindkét dátum
                                                szerepeljen.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading7">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false"
                                            aria-controls="collapse7">
                                            A tábla megsérti vagy megrongálja a sírkövet? Mi van, ha később el kell
                                            távolítanom?
                                        </button>
                                    </h2>
                                    <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                A Tributes plakettjeink nem sértik meg a kopjafát! A 3M permanens szalag
                                                tartósan tapad a felülethez súlyos körülmények között, például esőben,
                                                hóban, erős napsütésben stb. Ennek ellenére, ha szükséges, a lepedéket
                                                óvatosan el lehet távolítani a sírkőről egy kemény lapos tárggyal, például
                                                lapos csavarhúzóval, hogy a plakk széleit a tapadási felületről lefeszítse.
                                                Az eltávolítás után használjon megfelelő sírkőtisztítót a megmaradt ragacsos
                                                maradékok eltávolítására.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="text-center mt-70">
                                <a href="../inner_pages/faqs.html"
                                    class="butn butn-md butn-bord butn-rounded mt-40">
                                    <div class="d-flex align-items-center">
                                        <span>See All Questions</span>
                                        <span class="icon ml-10">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </a>
                            </div> -->
                </div>
            </section>

        </div>
    </div>

    <!-- ==================== End Blog ==================== -->

@endsection

@section('js')
    <script>
        function redirectWithCode() {
            const code = document.getElementById('qr-input').value.trim();
            if (code) {
                window.location.href = `https://rememus.com/memorial/attach/${encodeURIComponent(code)}`;
            } else {
                alert('Kérlek, adj meg egy QR-kódot!');
            }
        }

        // $(document).ready(function () {
        //     $('.butn-scroll').on('click', function (e) {
        //         e.preventDefault();
        //         $('html, body').animate({
        //             scrollTop: $('#howitworks').offset().top
        //         }, 800); // 800 мс = плавная прокрутка
        //     });
        // });




        $(document).ready(function () {
            // Прокрутка к якорю, если он есть в URL
            if (window.location.hash && $(window.location.hash).length) {
                $('html, body').animate({
                    scrollTop: $(window.location.hash).offset().top
                }, 800);
            }

            // Обработчик кнопки scroll к #howitworks
            $('.butn-scroll').on('click', function (e) {
                const target = $('#howitworks');
                const isHome = window.location.pathname === '/' || window.location.pathname === '/index.php';

                if (isHome && target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 800);
                }
                // иначе произойдёт переход по href="/#howitworks"
            });

            // Обработчик кнопки scroll к #faqs
            $('.butn-q-scroll').on('click', function (e) {
                const target = $('#faqs');
                const isHome = window.location.pathname === '/' || window.location.pathname === '/index.php';

                if (isHome && target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 800);
                }
                // иначе переход по href="/#faqs"
            });
        });

    </script>
@endsection
