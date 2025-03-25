@extends('layouts.dark')

@section('title', $memorial->name . ' - mbook.hu')

@section('css')
<style>
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
        cursor: pointer; /* Добавляем указатель при наведении */
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


    <section class="works-dm mb-100">
        <div class="container">
            <div class="gallery row md-marg">
                <!-- Первый блок (первая картинка из $images) -->
                @if ($images->isNotEmpty())
                    <div class="items col-lg-6 order-md-2">
                        <div class="item">
                            <div class="img">
                                <img src="{{ asset('storage/' . $images->first()->image_path) }}"
                                    alt="">
                            </div>
                            <div class="cont mt-30">
                                <div class="info sub-color mb-10">
                                    @if ($images->isNotEmpty())
                                        <div class="info sub-color mb-10">
                                            @if ($images->first()->image_date)
                                                <span>{{ $images->first()->image_date }}</span>
                                                <span class="dot"></span>
                                            @endif
                                            @if ($images->first()->image_description)
                                                <span>{{ $images->first()->image_description }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Заголовок (статический) -->
                    <div class="items col-lg-6 order-md-1">
                        <div class="sec-head">
                            {{-- <h6 class="sub-head mb-15">Fényképek az elhunytról</h6> --}}
                            <div class="butn-vid d-flex align-items-center">
                                <div class="play-button" id="openSlideshow">
                                    <a class="vid">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                                <div class="cont play-button" id="openSlideshow">
                                    <a>
                                        <span>Fényképek az elhunytról <br> Diavetítés lejátszása</span>
                                    </a>
                                </div>
                                <div class="shaps bottom">
                                    <div class="shap-right-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-11 h-11">
                                            <path
                                                d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                                fill="#0e0f11"></path>
                                        </svg>
                                    </div>
                                    <div class="shap-left-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-11 h-11">
                                            <path
                                                d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                                fill="#0e0f11"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Скрытые ссылки для GLightbox -->
                            <div id="gallery" style="display: none;">
                                @foreach ($images as $image)
                                    <a href="{{ asset('storage/' . $image->image_path) }}" class="glightbox" data-gallery="memorial-gallery"></a>
                                @endforeach
                            </div>
                            {{-- <h2 class="fz-50">Vessen egy pillantást<br> a fényképekre</h2> --}}
                        </div>
                    </div>

                    <!-- Остальные картинки (начиная со второй) -->
                    @if ($images->count() > 1)
                        @foreach ($images->slice(1) as $image)
                            <div class="items col-lg-6 order-md-2">
                                <div class="item">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $image->image_path) }}">
                                    </div>
                                    <div class="cont mt-30">
                                        <div class="info sub-color mb-10">
                                            @if ($image->image_date)
                                                <span>{{ $image->image_date }}</span>
                                                <span class="dot"></span>
                                            @endif
                                            @if ($image->image_description)
                                                <span>{{ $image->image_description }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif



                @endif
            </div>
        </div>
    </section>




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