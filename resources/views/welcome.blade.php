@extends('layouts.home')

@section('title', 'Rememus.com - Címlap')

@section('css')
    <style>
        .header-mst {
            position: relative;
            overflow: hidden;
        }

        .header-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 1;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            opacity: 0;
            transition: opacity 1s ease-in-out;

            &.loaded {
                opacity: 1;
            }
        }

.video-js .vjs-tech {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center center !important;
}

/* Убираем все принудительные размеры */
.video-js {
    width: 100% !important;
    height: 100% !important;
}

        .header-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 3;
        }

        .header-content {
            position: relative;
            z-index: 4;
            color: white;
        }

        .loading-indicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
            color: white;
            text-align: center;
            opacity: 1;
            transition: opacity 0.3s ease;

            &.hidden {
                opacity: 0;
                pointer-events: none;
            }
        }

        .spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')

    <!-- ==================== Start Header ==================== -->

    <header class="header-mst bg-img d-none d-md-block" id="videoHeader">
        <!-- Фоновое изображение -->
        <div class="header-bg-image" data-background="home/imgs/header/bg8.jpg"></div>

        <!-- Video.js плеер -->
        <div class="video-background" id="videoBackground">
            <video-js id="background-video" class="vjs-default-skin video-js" data-setup="{}" muted loop preload="auto"
                playsinline>
                <source src="{{ asset('home/videos/header-bg.mp4') }}" type="video/mp4">
            </video-js>
        </div>

        <!-- Оверлей -->
        <div class="header-overlay"></div>

        <!-- Индикатор загрузки -->
        <div class="loading-indicator" id="loadingIndicator">
            <div class="spinner"></div>
            {{-- <div>Загружается видео...</div> --}}
        </div>

        <!-- Ваш контент -->
        <div class="header-content container ">
            <div class="row">
                <div class="col-lg-7">
                    <div class="caption">
                        <h3 class="d-none d-md-block">
                            <br>
                        </h3>
                        {{-- <h4 class="mt-4 mb-2 d-none d-md-block">
                            Rememus.com
                        </h4> --}}
                        <h4 class="mt-4 mb-2 d-none d-md-block">
                            {{ __('We live on as long as we are remembered') }}
                        </h4>

                        <h7 class="d-none d-md-block">
                            {{ __('Create a worthy memorial page for your deceased loved ones. We will tell their story and preserve their memory for all time.') }}
                        </h7>

                        <h5 class="d-block d-md-none">
                            {{ __('We live on as long as we are remembered') }}
                        </h5>

                        <h7 class="d-block d-md-none mt-50">
                            {{ __('Create a worthy memorial page for your deceased loved ones. We will tell their story and preserve their memory for all time.') }}
                        </h7>
                        <!-- <h1>We Invest <br> In Big Ideas</h1> -->
                    </div>
                </div>
            </div>
            <div class="row justify-content-between mt-80">
                <div class="col-lg-6 order-md-2">
                    <div class="butons">
                        <a href="/create" class="bg">
                            <span class="text-center">{{ __('Create a') }} <br> {{ __('memorial page') }}</span>
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

                            <input id="qr-input" type="text" placeholder="{{ __('QR code redemption') }}"
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



    {{-- <header class="header-mst bg-img d-none d-md-block" data-background="home/imgs/header/bg8.jpg" data-overlay-dark="4">
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
                    </div>
                </div>

            </div>
        </div>
    </header> --}}


    <header class="header-mst bg-img d-block d-md-none"
        style="padding: 130px 0 !important; background-position: left !important;"
        data-background="home/imgs/header/women.jpg" data-overlay-dark="4">
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
                                        <path d="M10 6L16 12L10 18" stroke="#000" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round" />
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
                            {{ __('Rememus.com – The eternal trace of love, a memory that outlives us') }}
                        </h4>

                        <h5 class="d-block d-md-none mb-3">
                            A rememus.com egy <br>QR-kóddal elérhető emlékoldal
                        </h5>
                        <p>
                            {{ __('Rememus memorial pages allow us to preserve the stories, photos, videos and shared moments of our loved ones in a dignified manner – even for generations. The memorial page is made available with a discreetly placed QR code on the gravesite or urn, so memories can be recalled at any time with a single scan – whether in the cemetery or at home.') }}
                        </p>
                        <br>
                        <p>
                            {{ __('The memorial page can be visited without a QR code and shared with family and friends. The timelessness and authenticity of the data is ensured by blockchain technology, so the memory is not only personal, but also reliable and can be preserved - forever.') }}
                            
                        </p>
                        <a href="#" class="butn-scroll butn butn-md butn-rounded bg-light mt-30">
                            <div class="d-flex align-items-center">
                                <span>{{ __('See how it works') }}</span>
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

    <!-- ==================== Start Blog ==================== -->

    <section class="testim-sm pb-100 pt-100 bg-gray" style="    background-color: #ffffff;">
        <div class="container">
            <div class="sec-head text-center mb-100">
                {{-- <h6 class="sub-title main-color mb-15">Testimonials</h6> --}}
                <h3 class="text-u">{{ __('Memorial Pages') }}</h3>
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
                <h3 class="text-u">{{ __('How it works') }}</h3>
            </div>


            {{-- <div class="row xlg-marg"> --}}

            <div class="row">
                <div class="col-lg-4 bord">
                    <div class="item md-mb50">
                        <div class="info d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6>
                                    {{ __('Scan the') }} <br>
                                    {{ __('QR code') }}
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
                                {{ __('Once you receive the commemorative plaque, simply scan the QR code on it with your smartphone or save it on your computer.') }}
                            </h7>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 bord">
                    <div class="item md-mb50">
                        <div class="info d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6>
                                    {{ __('Create a') }} <br>
                                    {{ __('memorial page') }}
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
                                {{ __('Enter the deceased’s details, upload pictures, videos, and sweet stories – all from your smartphone or computer, and Artificial Intelligence will do the rest.') }}
                            </h7>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 bord">
                    <div class="item md-mb50">
                        <div class="info d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6>
                                    {{ __('Share and record') }} <br>
                                    {{ __('the memory package') }}
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
                                {{ __('Share the page with family and friends, who can also share their own thoughts, photos, or farewell lines. Attach the plaque to the grave, urn, or memorial site so the memorial page remains accessible at any time - whether on site or online.') }}
                            </h7>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ==================== End Blog ==================== -->

    <!-- ==================== Start Price ==================== -->

    <section class="price section-padding">
        <div class="container">
            <div class="sec-head-lg text-center mb-80">
                <h2 class="text-u">{{ __('Prices') }}</h2>
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
                                        <title>bookmark</title>
                                        <desc></desc>
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
                            <h5 class="mb-10">{{ __('Basic') }}</h5>
                            <h6 class="fz-16 fw-400 sub-font">{{ __('One-time fee') }} <span class="opacity-7">
                                {{ __('with perpetual access') }}
                            </span>
                            </h6>
                        </div>
                        <div class="feat mb-30 pb-30 bord-thin-bottom">
                            <ul class="rest sub-font">
                                <li><span class="ti-check icon"></span> 1 <span class="opacity-7">{{ __('pcs') }}</span> {{ __('memorial page') }}
                                </li>
                                <li><span class="ti-check icon"></span> 1 <span class="opacity-7">{{ __('pcs') }}</span> {{ __('QR code plate') }}
                                </li>
                                <li><span class="ti-check icon"></span> 30 {{ __('photos') }}</li>
                                <li><span class="ti-check icon"></span> {{__('You can choose from many styles')}}</li>
                                <li><span class="ti-check icon"></span> {{__('Comments without restrictions')}}</li>
                            </ul>
                            <div class="text-center mt-40">
                                <a href="https://shop.rememus.com/Emlekplakettek" target="_blank"
                                    class="butn butn-md butn-rounded" style="border: 1px solid #2e2e2e !important;">
                                    <div class="d-flex align-items-center">
                                        <span>{{ __('Purchase') }}</span>
                                        <span class="icon invert ml-10 mb-1">
                                            <svg fill="#a4a4a4" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px"
                                                viewBox="0 0 490.875 490.875" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
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
                            <h5 class="mb-10">{{ __('Heritage') }}</h5>
                            <h6 class="fz-16 fw-400 sub-font">{{ __('One-time fee') }} <span class="opacity-7">
                                {{ __('with perpetual access') }}
                            </h6>
                        </div>
                        <div class="feat mb-30 pb-30 bord-thin-bottom">
                            <ul class="rest sub-font">
                                <li><span class="ti-check icon"></span> 5 <span class="opacity-7">{{ __('pcs') }}</span> {{ __('memorial page') }}
                                </li>
                                <li><span class="ti-check icon"></span> 5 <span class="opacity-7">{{ __('pcs') }}</span> {{ __('QR code plate') }}
                                </li>
                                <li><span class="ti-check icon"></span> 30 <span class="opacity-7">{{ __('photos') }}</span> / <span class="opacity-7">{{ __('page') }}</span>
                                </li>
                                <li><span class="ti-check icon"></span> {{__('You can choose from many styles')}}</li>
                                <li><span class="ti-check icon"></span> {{ __('Comments without restrictions') }}</li>
                            </ul>
                            <div class="text-center mt-40">
                                <a href="https://shop.rememus.com/Emlekplakettek" target="_blank"
                                    class="butn butn-md butn-rounded" style="border: 1px solid #2e2e2e !important;">
                                    <div class="d-flex align-items-center">
                                        <span>{{ __('Purchase') }}</span>
                                        <span class="icon invert ml-10 mb-1">
                                            <svg fill="#a4a4a4" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px"
                                                viewBox="0 0 490.875 490.875" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
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
                            <p class="ms-2"> / {{ __('pcs') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item dark wow fadeIn" data-wow-delay="0.8s">
                        <div class="head mb-30">
                            <span class="icon-img-80 mb-15">
                                <img src="home/imgs/price/3.svg" alt="">
                            </span>
                            <h5 class="mb-10">{{ __('Custom offer') }}</h5>
                            <h6 class="fz-16 fw-400 sub-font">{{ __('One-time fee') }} <span class="opacity-7">
                                {{ __('with perpetual access') }}
                            </h6>
                        </div>
                        <div class="feat mb-30 pb-30 bord-thin-bottom-light">
                            <ul class="rest sub-font">
                                <li><span class="ti-check icon"></span> 10 <span class="opacity-7">{{ __('pcs') }}</span> {{ __('memorial page') }}
                                </li>
                                <li><span class="ti-check icon"></span> 10 <span class="opacity-7">{{ __('pcs') }}</span> {{ __('QR code plate') }}
                                </li>
                                <li><span class="ti-check icon"></span> 30 <span class="opacity-7">{{ __('photos') }}</span> / <span class="opacity-7">{{ __('page') }}</span>
                                </li>
                                <li><span class="ti-check icon"></span> {{ __('You can choose from many styles') }}</li>
                                <li><span class="ti-check icon"></span> {{ __('Comments without restrictions') }}</li>
                            </ul>

                            <div class="text-center mt-40">
                                <a href="https://shop.rememus.com/Emlekplakettek" target="_blank"
                                    class="butn butn-md butn-bord butn-rounded">
                                    <div class="d-flex align-items-center">
                                        <span>{{ __('Purchase') }}</span>
                                        <span class="icon invert ml-10 mb-1">
                                            <svg fill="#a4a4a4" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px"
                                                viewBox="0 0 490.875 490.875" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M451.611,178.111h-31.244c3.668,20.593-5.14,42.301-23.979,53.957c-8.325,5.146-17.877,7.869-27.635,7.869
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
                            <p class="ms-2"> / {{ __('pcs') }}</p>
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
                    {{ __('The main pillars of the memorial site') }}
                </h3>

                <h5 class="d-block d-md-none mb-3">
                    {{ __('The main pillars of the memorial site') }}
                </h5>

            </div>
        </div>
    </section>

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
                                                <h6>{{ __('Biography') }}</h6>
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
                                                {{ __('Enter important milestones – whether it’s an obituary, a detailed life story, or a few memorable events. We’ll automatically build a chronological timeline from data provided, then use artificial intelligence to edit it into a flowing, inspiring story for future generations to learn from and draw inspiration from it.') }}
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
                                                <h6>{{ __('It is accessible and memorable.') }}</h6>
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
                                                {{ __('Our goal is to make preserving the memory of our loved ones simple and accessible to everyone. We believe that every gravestone deserves a QR code so that no one is forgotten. The system reminds us of important anniversaries – such as birthdays or death anniversaries – so that family and friends are informed in time and can pay their respects on the memorial page with flowers, well-wishes or a heartfelt message.') }}

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
                                                <h6>{{ __('Photos and videos') }}</h6>
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
                                                {{ __('Upload your favorite photos and videos to make your memories last forever. You can also invite friends and family to add their own photos and moments to the memorial page.') }}
                                                
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
                                                <h6>{{ __('Remembrances') }}</h6>
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
                                                {{ __('Collect stories, photos, and personal messages from family and friends. Share the memorial page link on social media, email, or message so anyone can easily add their own memories.') }}
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
                            {{ __('Frequently Asked Questions') }}
                        </h3>

                        <h5 class="d-block d-md-none mb-3">
                            {{ __('Frequently Asked Questions') }}
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
                                            {{ __('Is there an ongoing cost to maintain the website?') }}
                                        </button>
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                {{ __(('No! We are committed to affordability, offering a one-time purchase of a customizable Tribute memorial. This service includes up to 50 photos, unlimited videos, and text storage for your online tribute. For those who want to add even more memories, additional photo storage is available with an annual subscription, so your loved one’s digital memorial is comprehensive and up-to-date.')) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading4">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                                            aria-controls="collapse4">
                                            {{ __('Won\'t QR codes eventually be replaced by another technology?') }}
                                        </button>
                                    </h2>
                                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                {{ __('Experts believe that QR codes are here to stay, with their industrial roots continuing to play a significant role in memorials. These codes do not store your loved one’s details; instead, they act as a direct link to their personal page on our Tributes website. You can be assured that the information is stored securely and is easily accessible. QR codes are considered a durable technology that ensures that even as new technologies emerge, your digital memorial remains accessible and secure online.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading5">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false"
                                            aria-controls="collapse5">
                                            {{ __('Can I give the QR code to my family or friends as a gift?') }}
                                        </button>
                                    </h2>
                                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                {{ __('Yes, you have the flexibility to create a digital memorial page for someone and then transfer ownership of it to another person. The recipient simply needs to create an account on ourtributes.com. Once their account is active, send an email with a transfer request that includes both parties’ email addresses and the name of your loved one. Our team will efficiently handle the transfer of your online tribute page.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading6">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false"
                                            aria-controls="collapse6">
                                            {{ __('Can a single page be used for 2 people, such as a couple?') }}
                                        </button>
                                    </h2>
                                    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                {{ __('Yes, a memorial page can be used for a pair, such as a parent or grandparent. The only limitation at this time is that there is only one space for the birth and death dates. You can leave these blank in the prompts and manually insert them in the \'Biography\' section to include both dates.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading7">
                                        <button class="accordion-button collapsed fs-5 fs-sm-6 fw-sm-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false"
                                            aria-controls="collapse7">
                                            {{ __('Does the plaque damage or harm the gravestone? What if I need to remove it later?') }}
                                        </button>
                                    </h2>
                                    <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>
                                                {{ __('Our Rememus plaques do not damage the headstone! The 3M permanent tape adheres securely to the surface even under harsh conditions such as rain, snow, strong sunlight, etc. However, if necessary, the plaque can be carefully removed from the gravestone using a hard, flat object, such as a flathead screwdriver, to gently pry the edges of the plaque away from the adhesive surface. After removal, use an appropriate gravestone cleaner to remove any remaining sticky residue.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        $(document).ready(function() {
            // Ваш существующий jQuery код...
            if (window.location.hash && $(window.location.hash).length) {
                $('html, body').animate({
                    scrollTop: $(window.location.hash).offset().top
                }, 800);
            }

            $('.butn-scroll').on('click', function(e) {
                const target = $('#howitworks');
                const isHome = window.location.pathname === '/' || window.location.pathname ===
                '/index.php';

                if (isHome && target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 800);
                }
            });

            $('.butn-q-scroll').on('click', function(e) {
                const target = $('#faqs');
                const isHome = window.location.pathname === '/' || window.location.pathname ===
                '/index.php';

                if (isHome && target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 800);
                }
            });

            // Инициализация Video.js (после загрузки jQuery)
            initVideoBackground();
        });

        function initVideoBackground() {
            // Проверяем что Video.js загружен
            if (typeof window.videojs === 'undefined') {
                // console.error('Video.js не загружен!');
                return;
            }

            const videoBackground = document.getElementById('videoBackground');
            const loadingIndicator = document.getElementById('loadingIndicator');

            if (!videoBackground || !loadingIndicator) {
                // console.log('Элементы видео не найдены');
                return;
            }

            let videoLoaded = false;

            // console.log('Инициализируем Video.js плеер...');

            // Инициализируем Video.js плеер
            const player = window.videojs('background-video', {
                controls: false,
                autoplay: 'muted',
                loop: true,
                muted: true,
                preload: 'auto',
                fluid: false,
                responsive: false,
                playsinline: true
            });

            // Функция для показа видео
            function showVideo() {
                if (videoLoaded) return;

                // console.log('Показываем видео фон...');
                videoLoaded = true;
                videoBackground.classList.add('loaded');
                loadingIndicator.classList.add('hidden');
            }

            // События плеера
            player.ready(function() {
                console.log('Video.js плеер готов');

                // Запускаем воспроизведение
                player.play().then(function() {
                    // console.log('Автовоспроизведение запущено');
                }).catch(function(error) {
                    // console.log('Автовоспроизведение заблокировано:', error);
                });
            });

            player.on('canplay', function() {
                // console.log('Видео готово к воспроизведению');
                showVideo();
            });

            player.on('playing', function() {
                // console.log('Видео воспроизводится');
                showVideo();
            });

            player.on('error', function(error) {
                // console.error('Ошибка Video.js:', error);
                loadingIndicator.classList.add('hidden');
            });

            // Fallback таймер
            setTimeout(function() {
                if (!videoLoaded) {
                    // console.log('Таймаут загрузки видео');
                    loadingIndicator.classList.add('hidden');
                }
            }, 10000);
        }
    </script>
@endsection
