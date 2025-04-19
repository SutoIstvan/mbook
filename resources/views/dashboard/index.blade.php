@extends('layouts.home')

@section('css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

    <style>
        body {
            background-color: #f7f7f7 !important;
        }

        .butn.butn-bord {
            border: 1px solid rgba(0, 0, 0, 0.3);
        }

        .butn.butn-bord:hover {
            background: var(--bg-color);
            color: #000000;
        }

        .navbar {
            mix-blend-mode: difference !important;
        }

        .icon {
            color: #fff;
        }

        :before,
        :after {
            margin: 0;
            padding: 0;
            word-break: break-all;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        .holder {
            /* Вариант 1: Через background-image */
            background-image: url('circle.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            /* или Вариант 2: Можно использовать сокращенную запись */
            /* background: url('путь_к_вашему_изображению.jpg') center/cover no-repeat; */

            /* Добавьте размеры контейнера */
            width: 100%;
            height: 100vh;
            /* На всю высоту viewport */
        }

        .holder {
            margin: 0rem auto 0;
            width: 150px;
            height: 400px;
            position: relative;
        }

        .holder *,
        .holder *:before,
        .holder *:after {
            position: absolute;
            content: "";
        }

        .candle {
            bottom: 243px;
            width: 150px;
            background-image: url('circle.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .flame {
            width: 18px;
            height: 80px;
            left: 50%;
            transform-origin: 50% 100%;
            transform: translateX(-50%);
            bottom: 100%;
            border-radius: 50% 50% 20% 20%;
            background: rgba(255, 255, 255, 1);
            background: linear-gradient(white 80%, transparent);
            animation: moveFlame 6s linear infinite, enlargeFlame 5s linear infinite;
        }

        .flame:before {
            left: 1%;
            width: 100%;
            height: 100%;
            border-radius: 50% 50% 20% 20%;
            box-shadow: 0 0 15px 0 rgba(132, 66, 25, 0.4), 0 -6px 4px 0 rgba(247, 128, 0, .7);
        }

        @keyframes moveFlame {

            0%,
            100% {
                transform: translateX(-50%) rotate(-2deg);
            }

            50% {
                transform: translateX(-50%) rotate(2deg);
            }
        }

        @keyframes enlargeFlame {

            0%,
            100% {
                height: 80px;
            }

            50% {
                height: 100px;
            }
        }

        .glow {
            width: 22px;
            height: 60px;
            border-radius: 50% 50% 35% 35%;
            left: 50%;
            top: -48px;
            transform: translateX(-50%);
            background: rgba(0, 132, 255, 0.207);
            box-shadow: 0 -40px 30px 0 #dc8a0c, 0 40px 50px 0 #dc8a0c, inset 3px 0 2px 0 rgba(0, 133, 255, .6), inset -3px 0 2px 0 rgba(0, 133, 255, .6);
        }

        .glow:before {
            width: 70%;
            height: 60%;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            border-radius: 50%;
            background: rgba(199, 11, 11, 0.35);
        }

        .blinking-glow {
            width: 100px;
            height: 180px;
            left: 50%;
            top: -55%;
            transform: translate(-50%, -70%);

            border-radius: 50%;
            background: #ff62008b;
            filter: blur(60px);
            animation: blinkIt .1s infinite;
        }

        @keyframes blinkIt {
            50% {
                opacity: .8;
            }
        }



        .dropzone .dz-preview.dz-image-preview {
            background: #212529 !important;
        }

        .dropzone .dz-preview .dz-remove {
            margin-top: 10px;
        }

        .card-memorial {
            padding: 15px;
            width: 350px;
            background: #222;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.7);
            user-select: none;
        }

        .cover-photo {
            position: relative;
            /* background: url(https://i.imgur.com/jxyuizJ.jpeg); */
            background-size: cover;
            /* height: 180px; */
            border-radius: 5px 5px 0 0;
        }

        .profile {
            position: absolute;
            width: 120px;
            height: 120px;
            /* Добавьте фиксированную высоту */

            bottom: -60px;
            left: 15px;
            border-radius: 50%;
            border: 2px solid #222;
            background: #222;
            padding: 5px;
            object-fit: cover;
            /* Вместо image-size */

        }

        .profile-name {
            font-size: 25px;
            margin: 5px 0 0 120px;
            color: #fff;
        }

        .about {
            margin-top: 30px;
            line-height: 1.6;
        }

        /* .btn {
                        margin: 30px 15px;
                        background: #7ce3ff;
                        padding: 10px 25px;
                        border-radius: 3px;
                        border: 1px solid #7ce3ff;
                        font-weight: bold;
                        font-family: Montserrat;
                        cursor: pointer;
                        color: #222;
                        transition: 0.2s;
                    } */

        /* .btn:last-of-type {
                        background: transparent;
                        border-color: #7ce3ff;
                        color: #7ce3ff;
                    }

                    .btn:hover {
                        background: #7ce3ff;
                        color: #222;
                    } */


        .pricing-pg .item {
            padding: 45px;
            background: #e8e8e8;;
            border-radius: 14px;
        }

        .fit-img img {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
            -o-object-position: center center;
            object-position: center center;
        }

        img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
@endsection

@section('title', 'Irányítópult - mbook.hu')

@section('content')
    <div class="container">
        <div class="section-padding text-secondary text-center">
            <div class="">

                <h4>
                    <span class="sub-color inline">Az irányítópultban</span>
                </h4>
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mt-4 mb-4">
                        szerkesztheti a meglévő emlékoldalakat és új oldalakat adhat hozzá elhunyt szeretteinek.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="pricing-pg mb-100">
        <div class="container">
            <div class="row">
                @foreach ($memorials as $memorial)
                    <div class="col-lg-4 mb-30">
                        <div class="item md-mb50">
                            <div class="head text-center">
                                <h6 class="text-u fz-20 mb-40">{{ $memorial->name }}</h6>
                                <div class="img img-fit">
                                    <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                                        class="img img-fit">
                                </div>
                            </div>

                            <div class="text-center ">
                                <a href="{{ route('dashboard.edit', $memorial) }}"
                                    class="butn butn-md butn-bord butn-rounded me-3 mt-30 mb-10">
                                    <div class="d-flex align-items-center">
                                        <span>Szerkesztes</span>
                                        <span class="icon ms-2">
                                            <i class="fa-solid fa-pen text-secondary"></i>
                                        </span>
                                    </div>
                                </a>
                                <a href="{{ route('memorial.show', $memorial->slug) }}" target="_blank"
                                    class="butn butn-md butn-bord butn-rounded mt-30 mb-10">
                                    <div class="d-flex align-items-center">
                                        <span class="icon">
                                            <i class="fa-solid fa-up-right-from-square text-secondary"></i>
                                        </span>
                                    </div>
                                </a>
                                {{-- <form action="{{ route('memorial.destroy', $memorial->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="butn butn-md butn-bord butn-rounded mt-30 mb-10"
                                        onclick="return confirm('Biztosan törölni szeretné?')">
                                        <div class="d-flex align-items-center">
                                            <span>Törlés</span>
                                        </div>
                                    </button>
                                </form> --}}
                            </div>

                        </div>
                    </div>
                @endforeach


                @if ($memorials->isEmpty())
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="item md-mb50">
                                <div class="head text-center">
                                    <div class="img img-fit">
                                        <img src="{{ asset('logo-add.png') }}" class="img img-fit">
                                    </div>
                                </div>

                                <div class="text-center mt-70">
                                    <a href="{{ route('memorial.create') }}"
                                        class="butn butn-md butn-bord butn-rounded mt-30 mb-10">
                                        <div class="d-flex align-items-center">
                                            <span>Új emlékoldal vásárlása</span>
                                            <span class="icon ms-2">
                                                <i class="fa-solid fa-basket-shopping text-secondary"></i>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-4 mb-30">
                        <div class="item md-mb50">
                            <div class="head text-center">
                                <div class="img img-fit">
                                    <img src="{{ asset('logo-add.png') }}" class="img img-fit">
                                </div>
                            </div>

                            <div class="text-center mt-70">

                                <a href="{{ route('memorial.create') }}"
                                    class="butn butn-md butn-bord butn-rounded mt-30 mb-10">
                                    <div class="d-flex align-items-center">
                                        <span>Új emlékoldal vásárlása</span>
                                        <span class="icon ms-2">
                                            <i class="fa-solid fa-basket-shopping text-secondary"></i>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif




            </div>
        </div>
    </section>

    </html>


@endsection

@section('js')

@endsection
