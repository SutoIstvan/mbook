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
                    <h6 class="mt-30 fw-bold">Hozzászólás írása</h6>
                </div>
            </div>

        </div>
    </header>

    <section class="testimonials-dm pb-80 ">
        <div class="container">


            <div class="container mb-70">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="text-white">
                            <!-- Заголовок карточки -->
                            {{-- <div class="card-header bg-dark text-white">
                                <h5 class="mb-0 fw-bold">Hozzászólás írása</h5>
                            </div> --}}
            
                            <!-- Тело карточки -->
                            <div class=" p-4">
            
                                <form action="{{ route('comments.store', $memorial->id) }}" method="POST"
                                    class="space-y-4 rounded-lg">
                                    @csrf
            
                                    <!-- Поле "Név" -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold text-white">Név <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" required
                                            class="form-control bg-dark text-white border-0 shadow-sm @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Írd be a nevedet">
                                        @error('name')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- Поле "Megjegyzés" -->
                                    <div class="mb-3">
                                        <label for="content" class="form-label fw-bold text-white">Megjegyzés <span
                                                class="text-danger">*</span></label>
                                        <textarea name="content" id="content" rows="4" required
                                            class="form-control bg-dark text-white border-0 shadow-sm @error('content') is-invalid @enderror"
                                            placeholder="Írd ide a megjegyzésedet">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- Кнопка отправки -->
                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-outline-light px-4 py-2 fw-bold shadow-sm">
                                            Elküld
                                        </button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
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