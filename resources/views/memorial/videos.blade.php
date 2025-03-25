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

    <!-- ==================== Start Intro-vid ==================== -->
    @if (!empty($memorial->video))
        <section class="services-dm sub-bg radius-30 section-padding">
            <div class="container pt-0">
                <div class="sec-head mb-100">
                    <div class="row">
                        <div class="col-lg-4">
                            <h6 class="sub-head">Videó az elhunytról</h6>
                        </div>
                        <div class="col-lg-5">
                            <h3 class="text-indent md-mb15">Gyönyörű emlékezetes pillanatok az életből
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <section class="intro-vid ontop">
            <div class="container">

                {{-- <div class="bg-img" data-background="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photo) }}"> --}}
                @if (!empty($memorial->video_img))
                    <div class="bg-img" data-background="{{ $memorial->video_img }}">
                    @else
                    <div class="bg-img" data-background="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photo) }}">
                @endif
                <div class="play-button">
                    <a href="{{ $memorial->video }}" class="vid">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>
            </div>
        </section>
    @endif




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