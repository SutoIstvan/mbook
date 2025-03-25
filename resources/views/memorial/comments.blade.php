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

    <section class="testimonials-dm section-padding pb-80 ">
        <div class="container">
            <div class="sec-head mb-100">
                <div class="row">
                    <div class="col-lg-5">
                        <h6 class="sub-head">Amit a család mond</h6>
                    </div>
                    <div class="col-lg-7">
                        <h3 class="text-indent">Legfrissebb megjegyzések <br>rokonoktól és szeretteinktől
                        </h3>

                    </div>
                </div>
            </div>


            <div class="mt-40">

                <div class="mt-80">
                    @forelse($comments as $comment)
                        <div class="swiper-slide">
                            <div class="item mb-30">
                                <div class="d-flex mb-30">
                                    <div class="img">
                                        {{-- <div class="fit-img"> --}}
                                        <div class="fit-img">
                                            <img src="{{ asset('dark/imgs/header/circle-badge4.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="sub-color"></span>
                                    </div>
                                </div>
                                <h5>“{{ $comment->content }}”</h5>
                                <div class="d-flex justify-content-between mt-30 w-100">
                                    <span class="sub-color">{{ $comment->name }}</span>
                                    <span class="sub-color">{{ $comment->created_at->format('Y.m.d') }}</span>
                                </div>

                            </div>
                        </div>
                    @empty
                    <div class="d-flex justify-content-center align-items-center text-gray-500" style="height: 200px;">
                        Még nincsenek hozzászólások
                    </div>

                    @endforelse
                </div>


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