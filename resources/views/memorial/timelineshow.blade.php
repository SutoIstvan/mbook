@extends('layouts.dark')

@section('title', $memorial->name . ' - Rememus.com')

@section('css')
    <style>
        .card {
            /* border-color: #000000 !important; */
            border: 0px !important;
        }
        /* The actual timeline (the vertical ruler) */
        .main-timeline-2 {
            position: relative;
        }

        /* The actual timeline (the vertical ruler) */
        .main-timeline-2::after {
            content: "";
            position: absolute;
            width: 3px;
            background-color: #fff;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        /* Container around content */
        .timeline-2 {
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        /* The circles on the timeline */
        .timeline-2::after {
            content: "";
            position: absolute;
            width: 25px;
            height: 25px;
            right: -11px;
            background-color: #fff;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        /* Place the container to the left */
        .left-2 {
            padding: 0px 40px 20px 0px;
            left: 0;
        }

        /* Place the container to the right */
        .right-2 {
            padding: 0px 0px 20px 40px;
            left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        .left-2::before {
            content: " ";
            position: absolute;
            top: 18px;
            z-index: 1;
            right: 30px;
            border: medium solid white;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        /* Add arrows to the right container (pointing left) */
        .right-2::before {
            content: " ";
            position: absolute;
            top: 18px;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        .right-2::after {
            left: -14px;
        }

        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {

            /* Place the timelime to the left */
            .main-timeline-2::after {
                left: 31px;
            }

            /* Full-width containers */
            .timeline-2 {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            /* Make sure that all arrows are pointing leftwards */
            .timeline-2::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            /* Make sure all circles are at the same spot */
            .left-2::after,
            .right-2::after {
                left: 18px;
            }

            .left-2::before {
                right: auto;
            }

            /* Make all right containers behave like the left ones */
            .right-2 {
                left: 0%;
            }
        }

        .butn-vid .vid {
            width: 55px;
            height: 55px;
            line-height: 55px;
            text-align: center;
            border-radius: 50%;
            background: #fff;
            color: #212121;
            position: relative;
        }

        .butn-vid .vid:after {
            content: '';
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .cont {
            padding-left: 20px;
        }

        .play-button {
            cursor: pointer;
            /* Добавляем указатель при наведении */
        }

        .glightbox-clean .gclose {
            width: 35px;
            height: 35px;
            top: 65px !important;
            right: 60px !important;
            position: absolute;
        }
    </style>
@endsection

@section('content')
    <!-- ==================== Start Header ==================== -->

    <header class="header-dm section-padding mt-50">
        <div class="container-xl position-re">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="caption" style="mix-blend-mode: difference;">
                        <h1 style="font-size: 50px">{{ $memorial->name }}</h1>
                    </div>

                </div>
            </div>

        </div>
    </header>

    <!-- ==================== Start Photos ==================== -->

    <section style="background-color: #00000000;">
        <div class="container py-5">
            <div class="main-timeline-2">
                @foreach ($items as $item)
                    <div class="timeline-2 {{ $loop->iteration % 2 === 0 ? 'left-2' : 'right-2' }}">
                        <div class="card">
                            {{-- Изображение: если есть image_path или media, иначе плейсхолдер --}}
                            @php
                                $imgSrc = null;
                                if (isset($item['type']) && $item['type'] === 'image' && !empty($item['image_path'])) {
                                    $imgSrc = asset('memorial/' . $item['image_path']);
                                } elseif (!empty($item['media'])) {
                                    $imgSrc = asset('memorial/' . $item['media']);
                                }
                            @endphp

                            @if ($imgSrc)
                                <img src="{{ $imgSrc }}" class="card-img-top" alt="{{ $item['title'] }}">
                            @else
                            @endif

                            <div class="card-body p-4">
                                {{-- Год или период --}}
                                <h6 class="fw-bold mb-4" style="color: #212121">
                                    <i class="far fa-clock me-2"></i>
                                    @if (!empty($item['date_to']))
                                        {{ \Carbon\Carbon::parse($item['date'])->format('Y') }}
                                        &nbsp;–&nbsp;
                                        {{ \Carbon\Carbon::parse($item['date_to'])->format('Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($item['date'])->format('Y M d') }}
                                    @endif
                                </h6>
                                {{-- Заголовок события или фото --}}
                                <h6 class="text-muted mb-4" style="color: #212121">{{ $item['title'] }}</h6>



                                {{-- Описание --}}
                                <p class="mb-0">{{ $item['description'] ?? '' }}</p>
                                <p class="mb-0">{{ $item['related_person'] ?? '' }}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    {{-- <section class="works-dm mb-100">
        <div class="">
            <div class="container py-5">
                <h1 class="text-center mb-5">{{__('Timeline')}}</h1>

                <div class="timeline">
                    @foreach ($items as $item)
                        <div class="timeline-item mb-5">
                            <div class="d-flex flex-column flex-md-row align-items-center">
                                <div class="date text-primary fw-bold me-3" style="min-width: 100px;">

                                    @if (!empty($item['date_to']))
                                        {{ \Carbon\Carbon::parse($item['date'])->format('Y') }} -
                                        {{ \Carbon\Carbon::parse($item['date_to'])->format('Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($item['date'])->format('Y M d') }}
                                    @endif

                                </div>

                                <div class="card w-100">
                                    <div class="card-body">
                                        @if ($item['type'] === 'event')
                                            <h5 class="card-title">{{ $item['title'] }}</h5>
                                            <p class="card-text">{{ $item['description'] }}</p>
                                        @elseif($item['type'] === 'image')
                                            <img src="{{ asset('memorial/' . $item['image_path']) }}" class="img-fluid mt-2"
                                                alt="Image">
                                                <h5 class="card-title mt-3">{{ $item['title'] }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section> --}}




@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>

    <script type="text/javascript">
        // Инициализируем GLightbox один раз
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            slideEffect: 'slide'
        });

        // Переменная для управления интервалом
        let slideInterval;

        // Функция запуска автопроигрывания
        function startAutoplay() {
            slideInterval = setInterval(() => {
                lightbox.nextSlide(); // Переключаем на следующий слайд
            }, 3000); // Интервал 3 секунды
        }

        // Функция остановки автопроигрывания
        function stopAutoplay() {
            clearInterval(slideInterval);
        }

        // Обработчик нажатия кнопки
        document.getElementById('openSlideshow').addEventListener('click', function() {
            lightbox.open(); // Открываем лайтбокс
            startAutoplay(); // Запускаем автопроигрывание
        });

        // Останавливаем автопроигрывание при закрытии
        lightbox.on('close', () => {
            stopAutoplay();
        });
    </script>
@endsection
