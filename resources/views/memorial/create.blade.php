@extends('layouts.memorial')

@section('css')

    <style>
        body{
            background-color: #d9d9d9 !important;
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
            background-image: url('../circle.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
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
            /* background-image: url('circle.png'); */
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
            width: 20px;
            height: 60px;
            border-radius: 50% 50% 35% 35%;
            left: 50%;
            top: -48px;
            transform: translateX(-50%);
            background: rgba(0, 132, 255, 0.207);
            box-shadow: 0 -40px 30px 0 #dc8a0c, 0 40px 50px 0 #dc8a0c, inset 3px 0 2px 0 rgba(0, 132, 255, 0.4), inset -3px 0 2px 0 rgba(0, 133, 255, .4);
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


        .drag-area {
            position: relative;
            height: 290px;
            border: 1.4px dashed #6c757d;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 1px auto;
        }

        .drag-area .icon {
            font-size: 50px;
            color: #fefefe;
        }

        .drag-area .header {
            font-size: 18px;
            font-weight: 500;
            color: #525252;
        }

        .drag-area .support {
            font-size: 12px;
            color: gray;
            margin: 10px 0 15px 0;
        }

        .drag-area .button {
            font-size: 16px;
            font-weight: 500;
            color: #fafafa;
            cursor: pointer;
            background-color: #5b5e60;
        }

        .drag-area.active {
            border: 1px solid #787878;
        }

        .drag-area img {
            width: 100%;
            height: 100%;
            border-radius: 4px;
            object-fit: cover;
        }

        .deleteBtn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 0, 0, 0.7);
            /* Полупрозрачный красный фон */
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s;
        }

        /* Темная тема для датапикера */
        .gj-datepicker-bootstrap [role="right-icon"] button {
            background-color: #343a40 !important;
            border-color: #212529 !important;
        }

        .gj-datepicker-bootstrap [role="right-icon"] button .gj-icon {
            color: #fff !important;
        }

        .gj-picker-bootstrap {
            background-color: #212529 !important;
            border: 1px solid #343a40 !important;
        }

        .gj-picker-bootstrap table tr td.selected.gj-cursor-pointer div {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #fff !important;
        }

        .gj-picker-bootstrap table tr td.today div {
            color: #0d6efd !important;
        }

        .gj-picker-bootstrap table tr th div {
            color: #fff !important;
        }

        .gj-picker-bootstrap table tr td div {
            color: #dee2e6 !important;
        }

        .gj-picker-bootstrap table tr td.other-month div {
            color: #6c757d !important;
        }

        .gj-picker-bootstrap table tr td.gj-cursor-pointer div:hover {
            background: #343a40 !important;
            color: #fff !important;
        }

        /* Стиль для input поля */
        .gj-textbox-md {
            background-color: #212529 !important;
            color: #fff !important;
            border: 1px solid #343a40 !important;
        }

        /* Стиль для кнопок навигации */
        .gj-picker-bootstrap [role="header"] {
            background-color: #343a40 !important;
            color: #fff !important;
        }

        .gj-picker-bootstrap [role="header"] div[role="period"] {
            color: #fff !important;
        }


        /* Измените фон виджета */
        .bootstrap-datetimepicker-widget {
            background-color: #343a40;
            /* Цвет фона виджета */
            color: #ffffff;
            /* Цвет текста внутри виджета */
        }

        /* Измените цвет фона для дней */
        .bootstrap-datetimepicker-widget table {
            background-color: #343a40;
            /* Цвет фона таблицы */
        }

        /* Измените цвет фона для ячеек дней */
        .bootstrap-datetimepicker-widget table td {
            background-color: #495057;
            /* Цвет фона ячеек */
            color: #ffffff;
            /* Цвет текста в ячейках */
        }

        .bootstrap-datetimepicker-widget table td:hover {
            background-color: #6c757d;
            /* Цвет фона при наведении на ячейку */
        }

        /* Измените цвет фона для активной ячейки */
        .bootstrap-datetimepicker-widget table td.active {
            background-color: #007bff;
            /* Цвет фона для активной ячейки */
            color: #ffffff;
            /* Цвет текста для активной ячейки */
        }

        /* Измените цвет фона для текущего дня */
        .bootstrap-datetimepicker-widget table td.today {
            background-color: #28a745;
            /* Цвет фона для текущего дня */
            color: #ffffff;
            /* Цвет текста для текущего дня */
        }

        /* Измените фон кнопок и их цвет текста */
        .bootstrap-datetimepicker-widget .btn {
            background-color: #007bff;
            /* Цвет фона */
            color: #535353;
            /* Цвет текста */
        }

        .bootstrap-datetimepicker-widget .btn:hover {
            background-color: #0056b3;
            /* Цвет фона при наведении */
            color: #b4b4b4;
            /* Цвет текста при наведении */
        }

        /* Измените цвет активного дня */
        .bootstrap-datetimepicker-widget table td.active,
        .bootstrap-datetimepicker-widget table td.active:hover {
            background-color: #28a745;
            /* Цвет фона активного дня */
            color: #fff;
            /* Цвет текста активного дня */
        }

        /* Измените цвет для текущего дня */
        .bootstrap-datetimepicker-widget table td.today:before {
            border-bottom-color: #ffc107;
            /* Цвет для текущего дня */
        }

        /* Измените цвет заголовков */
        .bootstrap-datetimepicker-widget table th {
            background-color: #343a40;
            /* Цвет фона заголовков */
            color: #fff;
            /* Цвет текста заголовков */
        }

        /* Измените цвет текста в неактивных днях */
        .bootstrap-datetimepicker-widget table td.disabled,
        .bootstrap-datetimepicker-widget table td.disabled:hover {
            color: #6c757d;
            /* Цвет текста неактивных дней */
        }

        /* Измените цвет фона для дней при наведении */
        .bootstrap-datetimepicker-widget table td:hover {
            background-color: #495057;
            /* Цвет фона при наведении */
        }

        /* Увеличение высоты заголовка */
        .bootstrap-datetimepicker-widget .picker-switch {
            line-height: 60px;
        }

        /* Увеличьте высоту кнопок в заголовке */



        .input-group-text {
            display: flex;
            align-items: center;
            padding: .375rem .75rem;
            font-size: 16px !important;
            font-weight: 400;
            line-height: 1.5;
            color: #c0c0c0;
            text-align: center;
            white-space: nowrap;
            background-color: #212529 !important;
            border: 1px solid #6c757d !important;
            border-radius: .25rem;
        }
    </style>
@endsection

@section('title', 'Adat mentés - mbook.hu')

@section('content')

    <div class="container">
        <div class=" text-secondary text-center">

            <div class="py-5">
                <div class="d-flex justify-content-center">
                    <div class="holder">
                        <div class="candle">
                            <div class="blinking-glow"></div>
                            <div class="thread"></div>
                            <div class="glow"></div>
                            <div class="flame"></div>
                        </div>
                    </div>
                </div>
                <h4>
                    <span class="sub-color inline">Új emlékoldal hozzáadása.</span>
                </h4>

                {{-- <h1 class="display-5 fw-bold text-white mt-15">Fogadja őszinte részvétünket a veszteségért.</h1> --}}
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mt-4 mb-4">
                        Az alábbiakban rögzítheti az elhunyt adatait, amelyeket később bármikor módosíthat vagy
                        kiegészíthet.
                        Töltse fel a fő fotót és néhány emlékezetes fényképét.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-10 col-md-10 p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <form action="{{ route('memorial.store') }}" method="POST" enctype="multipart/form-data" id="form">
        {{-- <form action="{{ route('memorial.create-with-qr') }}" method="POST" enctype="multipart/form-data" id="form"> --}}
            @csrf

        <div class="container">
            <div class="row d-flex justify-content-center">


                <div class="col-12 col-md-3 p-4">
                    <h3>Elhunyt adatai</h3>
                    <p class="mt-2">Kérjük, tüntesd fel a következő információkat: Teljes név, Születési dátum,
                        Elhalálozás dátum.</p>
                </div>

                <div class="col-12 col-md-7 p-3">
                    <div class="container">
                        <div class="row">
                            {{-- <div class="mb-35">
                                <label for="fullName" class="form-label ">Teljes név</label>
                                <input name="name" type="text"
                                    class="form-control  text-white border-secondary py-2" id="fullName"
                                    placeholder="Teljes név"
                                    value="{{ old('name')}}">
                            </div> --}}
                            {{-- <div class="col-12 col-md-6 mb-3">
                                <label for="birth_date" class="form-label text-white">Születési dátum</label>
                                <input name="birth_date" type="text"
                                    class="form-control bg-dark text-white border-secondary py-2 datepicker" id="birth_date"
                                    placeholder="00.00.0000">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="death_date" class="form-label text-white">Elhalálozás dátuma</label>
                                <input name="death_date" type="text"
                                    class="form-control bg-dark text-white border-secondary py-2" id="death_date"
                                    placeholder="nn.hh.eeee">
                            </div> --}}


                            {{-- <div class="col-12 col-md-6 mb-3">
                                <div class="form-group" data-bs-theme="dark">
                                    <label for="birth_date" class="form-label text-white">Születési dátum</label>

                                    <div class="input-group date" id="datetimepicker10" data-target-input="nearest">
                                        <input name="birth_date" type="text"
                                            value="{{ old('birth_date')}}"
                                            class="form-control datetimepicker-input bg-dark text-white border-secondary py-2 datepicker"
                                            data-target="#datetimepicker10" placeholder="éééé-hh-nn" />
                                        <div class="input-group-append" data-target="#datetimepicker10"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"
                                                    style="line-height: 1.8 !important;"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group" data-bs-theme="dark">
                                    <label for="death_date" class="form-label text-white">Elhalálozás dátuma</label>

                                    <div class="input-group date" id="datetimepicker11" data-target-input="nearest">
                                        <input name="death_date" type="text"
                                            value="{{ old('death_date')}}"
                                            class="form-control datetimepicker-input bg-dark text-white border-secondary py-2 datepicker"
                                            data-target="#datetimepicker11" placeholder="éééé-hh-nn" />
                                        <div class="input-group-append" data-target="#datetimepicker11"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"
                                                    style="line-height: 1.8 !important;"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="col-form-label text-md-end">{{ __('Full Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="birth_date" class="col-form-label text-md-end">{{ __('Date of Birth') }}</label>
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-md-12 mb-3">
                                <label for="death_date" class="col-form-label text-md-end">{{ __('Date of Death') }}</label>
                                <input id="death_date" type="date" class="form-control @error('death_date') is-invalid @enderror" name="death_date" value="{{ old('death_date') }}">
                                @error('death_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <input id="datepicker" class="form-control bg-dark text-white border-secondary py-2 datepicker" data-bs-theme="dark" placeholder="nn.hh.éééé"/> --}}




                            {{-- <div class="mt-30">
                                <label for="story" class="form-label text-white">Emlékezés, tiszteletadás</label>
                                <textarea name="story" class="form-control bg-dark text-white border-secondary" id="story" rows="3"></textarea>
                            </div> --}}
                        </div>
                    </div>
                </div>



            </div>
        </div>


        <div class="container">
            <div class="row d-flex justify-content-center">


                <div class="col-12 col-md-3 p-4 mt-50">
                    <h3>Fő emlékkép</h3>
                    <p class="mt-2">Ez a fénykép fog elsőként megjelenni az emlékoldalon.</p>
                </div>

                <div class="col-12 col-md-7 p-3 mt-50">
                    <div class="container">
                        <div class="row">
                            <div class="container">
                                <label class="form-label">Fő emlékkép feltöltése</label>
                                <div class="drag-area  text-white border-secondary">
                                    <div class="icon">
                                        <i class="fas fa-images"></i>
                                    </div>

                                    <span class="header">Húzza ide a fényképet</span>
                                    <span class="header">vagy nyissa meg a </span>

                                    <div class="text-center mb-10 mt-10">
                                        <span class="button butn butn-md butn-bord butn-rounded">böngészőben</span>
                                    </div>

                                    <input name="photo" type="file" hidden />
                                    <span class="support">Fényképformátum: JPEG, JPG, PNG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="container">
            <div class="row d-flex justify-content-center">


                <div class="col-12 col-md-3 p-4 mt-50">
                    <h3>Életrajz</h3>
                    <p class="mt-2">Oszd meg velünk kedves emlékeidet, a számára fontos pillanatokat vagy azt, amit
                        szerettél benne a legjobban.</p>
                </div>

                <div class="col-12 col-md-7 p-3">
                    {{-- <div class="container">
                        <div class="row">
                            <div class="mt-30">
                                <label for="biography" class="form-label text-white">Életrajz</label>
                                <textarea name="biography" class="form-control bg-dark text-white border-secondary" id="biography" rows="12">{{ old('biography')}}</textarea>
                            </div>
                        </div>
                    </div> --}}

                    <div class="container mt-50">
                        <label for="biography" class="col-form-label text-md-end">{{ __('Biography') }}</label>
                        <textarea id="biography" class="form-control @error('biography') is-invalid @enderror" name="biography" rows="7">{{ old('biography') }}</textarea>
                        @error('biography')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>




            </div>
        </div>

        {{-- <input name="token" value="{{ $token }}" hidden> --}}





        {{-- <div class="container mt-100 mb-50">

            <!--Avatar-->
            <div>
                <div class="d-flex justify-content-center mt-100 mb-50">
                    <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
                        class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;"
                        alt="example placeholder" />
                </div>
                <div class="d-flex justify-content-center">
                    <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                        <label class="form-label text-white m-1" for="customFile2">Choose file</label>
                        <input name="photo" type="file" class="form-control d-none" id="customFile2"
                            onchange="displaySelectedImage(event, 'selectedAvatar')" />
                    </div>
                </div>
            </div>

        </div> --}}

        {{-- <div class="container">
        <div class="row d-flex justify-content-center mt-4 mb-50">
            <div class="col-12 col-md-3 p-4">
                <h3 class="text-white">Fényképek</h3>
                <p class="mt-2 text-white-50">Töltsön fel néhány fényképet, később dátumot és további adatokat is megadhat.</p>
            </div>

            <div class="col-12 col-md-7 p-3 ">
                <div class="container">
                    <div class="card bg-dark border-warning">
                        <form method="post" action="{{url('images/store')}}" enctype="multipart/form-data"
                            class="dropzone bg-dark text-white" id="dropzone">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


        <div class="text-center pb-55 mt-40">
            <button type="submit" class="butn butn-md butn-bord butn-rounded" id="submitBtn">
                <div class="d-flex align-items-center">
                    <span id="btnText">Adatok mentése</span>
                    <span class="icon pe-7s-angle-right ml-10 fz-30" id="btnIcon"></span>
                    <span class="spinner-border spinner-border-sm ml-10 d-none" id="btnSpinner"></span>
                </div>
            </button>
        </div>

    </form>

    </html>


@endsection

@section('js')
    <script>
        // const picker = new tempusDominus.TempusDominus(document.getElementById('datepicker'), {
        //     display: {
        //         theme: 'dark'  // Устанавливает тёмную тему
        //     }
        // });

        $(function() {
            $('#datetimepicker10').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                display: {
                    theme: 'dark' // Устанавливает тёмную тему
                }
            });
        });

        $(function() {
            $('#datetimepicker11').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                display: {
                    theme: 'dark' // Устанавливает тёмную тему
                }
            });
        });

        // gj.core.messages['hu-hu'] = {
        //     monthNames: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'],
        //     monthShortNames: ['Jan', 'Feb', 'Már', 'Ápr', 'Máj', 'Jún', 'Júl', 'Aug', 'Szept', 'Okt', 'Nov', 'Dec'],
        //     weekDaysMin: ['V', 'H', 'K', 'Sz', 'Cs', 'P', 'Szo'],
        //     weekDaysShort: ['Vas', 'Hét', 'Ked', 'Sze', 'Csü', 'Pén', 'Szo'],
        //     weekDays: ['Vasárnap', 'Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'],
        //     am: 'de.',
        //     pm: 'du.',
        //     ok: 'OK',
        //     cancel: 'Mégse',
        //     titleFormat: 'yyyy'
        // };

        // $('#datepicker').datepicker({
        //     uiLibrary: 'bootstrap5',
        //     format: 'yyyy-mm-dd',
        //     weekStartDay: 1,
        //     iconsLibrary: 'fontawesome',
        //     locale: 'hu-hu',
        //     showRightIcon: false
        // });



        const dropArea = document.querySelector('.drag-area');
        const dragText = document.querySelector('.header');

        let button = dropArea.querySelector('.button');
        let input = dropArea.querySelector('input');

        let file;

        // Функция инициализации всех обработчиков событий
        function initializeEventListeners() {
            button = dropArea.querySelector('.button');
            input = dropArea.querySelector('input');

            button.onclick = () => {
                input.click();
            };

            input.addEventListener('change', function() {
                file = this.files[0];
                dropArea.classList.add('active');
                displayFile();
            });

            dropArea.addEventListener('dragover', (event) => {
                event.preventDefault();
                dropArea.classList.add('active');
                dragText.textContent = 'Release to Upload';
            });

            dropArea.addEventListener('dragleave', () => {
                dropArea.classList.remove('active');
                dragText.textContent = 'Drag & Drop';
            });

            dropArea.addEventListener('drop', (event) => {
                event.preventDefault();
                file = event.dataTransfer.files[0];
                displayFile();
            });
        }

        // Инициализируем обработчики при загрузке страницы
        initializeEventListeners();

        function displayFile() {
            let fileType = file.type;
            let validExtensions = ['image/jpeg', 'image/jpg', 'image/png'];

            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();

                fileReader.onload = () => {
                    let fileURL = fileReader.result;
                    dropArea.innerHTML = `
                        <img src="${fileURL}" alt="">
                            <button type="button" class="deleteBtn butn butn-md butn-danger butn-rounded">
                                Kép törlése
                            </button>
                        <span class="button"></span>
                        <input name="photo" type="file" hidden />
                    `;

                    // Переназначаем элементы
                    button = dropArea.querySelector('.button');
                    input = dropArea.querySelector('input');
                    const deleteBtn = dropArea.querySelector('.deleteBtn');

                    // Обработчик для кнопки удаления
                    deleteBtn.addEventListener('click', () => {
                        // Возвращаем начальный HTML для drag-area
                        dropArea.innerHTML = `
                            <div class="icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <span class="header">Húzza ide a fényképet</span>
                            <span class="header">vagy nyissa meg a </span>
                            <div class="text-center mb-10 mt-10">
                                <span class="button butn butn-md butn-bord butn-rounded">böngészőben</span>
                            </div>
                            <input name="photo" type="file" hidden/>
                            <span class="support">Fényképformátum: JPEG, JPG, PNG</span>
                        `;

                        // Переназначаем элементы после сброса
                        button = dropArea.querySelector('.button');
                        input = dropArea.querySelector('input');

                        // Восстанавливаем обработчик клика для кнопки выбора файла
                        button.onclick = () => {
                            input.click();
                        };

                        // Удаляем класс active
                        dropArea.classList.remove('active');

                        // Заново инициализируем все обработчики событий
                        initializeEventListeners();
                    });

                    // Восстанавливаем обработчик для кнопки выбора файла
                    button.onclick = () => {
                        input.click();
                    };

                    // Устанавливаем файл в input
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('This is not an Image File');
                dropArea.classList.remove('active');
            }
        }


        document.getElementById("form").addEventListener("submit", function(event) {
            let button = document.getElementById("submitBtn");
            let btnIcon = document.getElementById("btnIcon");
            let btnSpinner = document.getElementById("btnSpinner");

            // Отключаем кнопку
            button.disabled = true;

            // Скрываем стрелку, показываем спиннер
            btnIcon.classList.add("d-none");
            btnSpinner.classList.remove("d-none");
        });
    </script>

@endsection
