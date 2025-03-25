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

    <header class="header-dm section-padding">
        <div class="container-xl position-re">
            <div class="row">
                <div class="col-lg-9">
                    <div class="caption" style="mix-blend-mode: difference;">
                        <h1 style="font-size: 50px">{{ $memorial->name }}</h1>
                    </div>
                    <div class="row md-hide">
                        <div class="col-lg-6 imgs-cube">
                            <div class="imgs">
                                <div class="circle">
                                    <img src="{{ asset('dark/imgs/header/circle-badge4.png') }}" alt="">
                                </div>
                            </div>
                            {{-- <div class="img fit-img radius-30 mt-50">
                                <img src="{{ asset('images/memorials/' . $memorial->id . '/' . $memorial->photo) }}"
                                    alt="">
                            </div> --}}

                            <div class="img fit-img radius-30 mt-50">
                                @if ($images->isNotEmpty())
                                    <!-- Используем первую картинку из массива $images -->
                                    <img src="{{ asset('storage/' . $images->first()->image_path) }}"
                                        alt="Изображение мемориала">
                                @elseif ($memorial->photo)
                                    <!-- Если массив $images пустой, используем изображение из $memorial->photo -->
                                    <img src="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photo) }}"
                                        alt="Изображение мемориала">
                                @else
                                    <!-- Если нет ни одной картинки, выводим заглушку -->
                                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="">
                                @endif
                            </div>

                            {{-- @if ($memorial->photo)
                            <img src="{{ asset('storage/' . $memorial->photo) }}" alt="Фото">
                        @endif --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="mimg fit-img">

                {{-- <div class="mimg fit-img" style="filter: grayscale(100%);"> --}}
                <img src="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photo) }}" alt="">
                <div class="text">
                    <span class="fz-14 text-u mb-10">{{ $memorial->birth_date }} - {{ $memorial->death_date }}</span>
                    <p style="margin-left: 25px;">Míg éltél szerettünk<br> míg élünk nem feledünk!</p>
                    <div class="shaps bottom">
                        <div class="shap-left-top">
                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path
                                    d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                    fill="#0e0f11"></path>
                            </svg>
                        </div>
                        <div class="shap-right-bottom">
                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path
                                    d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                    fill="#0e0f11"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                {{-- <div class="absolute" style="position: absolute; top: 387px; left: 350px;">
                    <img src="assets/imgs/header/circle-badge4.png" style="width: 180px;" alt="Иконка">
                </div> --}}
            </div>
        </div>
    </header>

    <!-- ==================== End Header ==================== -->

    <section class="awards-sa mb-100">
        <div class="container">
            <div class="sec-head mb-100">
                <div class="row">
                    <div class="col-lg-5">
                        <h6 class="sub-head">Életrajz</h6>
                    </div>
                    <div class="col-lg-7">

                        <h4>Az élet utolsó fejezete:
                            <span class="sub-color inline">Egy személyes történet, amely örökre megmarad.</span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h7>
                    {{ $memorial->biography }}
                </h7>
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