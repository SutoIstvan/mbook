@extends('layouts.memorial')

@section('css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        .cropper-modal {
            background-color: rgb(0, 0, 0) !important;
            opacity: 1 !important;
        }

        .image-container {
            max-width: 100%;
            margin-top: 20px;
            display: none;
        }

        #image {
            display: block;
            max-width: 100%;
        }

        body {
            background-color: #f7f7f7 !important;
            /* background-color: #d9d9d9 !important; */
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
            width: 102%;
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
                <div class="info md-hide about-ca pt-10">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                            style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover;" alt=""
                            class="img-fluid">
                    </div>

                    <div class="cont text-center pt-10">
                        {{-- <ul class="rest">
                            <li>{{ $memorial->name }}</li>
                        </ul> --}}
                        <h6>
                            <span class="sub-color inline">{{ $memorial->name }}</span>
                        </h6>
                    </div>
                </div>

                {{-- <h1 class="display-5 fw-bold text-white mt-15">Fogadja őszinte részvétünket a veszteségért.</h1> --}}
                <div class="col-lg-8 mx-auto">
                    <p class="fs-5 mt-4 mb-4">
                        {{ __('You have successfully added additional information about your loved one. Based on the information you provided, we have created a biography for you that can help preserve memories. You can now freely add to and edit it to make it even more personal.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-10 col-md-10 p-4">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif



    <form action="{{ route('memorial.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
        {{-- <form action="{{ route('memorial.create-with-qr') }}" method="POST" enctype="multipart/form-data" id="form"> --}}
        @csrf

        <div class="container">
            <div class="row d-flex justify-content-center">


                <div class="col-12 col-md-3 p-4">
                    <h3>{{ __('Deceased data') }}</h3>
                    <p class="mt-2">
                        {{ __('Please provide the following information: Full name, Date of birth, Date of death.') }}
                    </p>
                </div>

                <div class="col-12 col-md-7 p-3">
                    <div class="container">
                        <div class="row">

                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="col-form-label text-md-end">{{ __('Full Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $memorial->name }}" required autocomplete="name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="birth_date" class="col-form-label text-md-end">{{ __('Date of Birth') }}</label>
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                    name="birth_date" value="{{ old('name', $memorial->birth_date) }}" required>
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="birth_place"
                                    class="col-form-label text-md-end">{{ __('Birth Place') }}</label>
                                <input id="birth_place" type="text"
                                    class="form-control @error('birth_place') is-invalid @enderror" name="birth_place"
                                    value="{{ $memorial->birth_place }}">
                                @error('birth_place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="death_date"
                                    class="col-form-label text-md-end">{{ __('Date of Death') }}</label>
                                <input id="death_date" type="date"
                                    class="form-control @error('death_date') is-invalid @enderror" name="death_date"
                                    value="{{ $memorial->death_date }}">
                                @error('death_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="grave_location"
                                    class="col-form-label text-md-end">{{ __('Grave Location') }}</label>
                                <input id="grave_location" type="text"
                                    class="form-control @error('grave_location') is-invalid @enderror" name="grave_location"
                                    value="{{ $memorial->grave_location }}">
                                @error('grave_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="text-end pb-8 mt-8">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row d-flex justify-content-center">


                <div class="col-12 col-md-3 p-4 mt-20">
                    <h3>{{ __('Motto') }}</h3>
                    <p class="mt-2">{{ __('Please write your favorite quote or motto here.') }}</p>
                </div>

                <div class="col-12 col-md-7 p-3">

                    <div class="container mt-20">
                        <label for="motto" class="col-form-label text-md-end">{{ __('Motto') }}</label>
                        <textarea id="motto" class="form-control @error('motto') is-invalid @enderror" name="motto"
                            rows="3">{{ $memorial->motto }}</textarea>
                        @error('motto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>


        <div class="container">
            <div class="row d-flex justify-content-center">


                <div class="col-12 col-md-3 p-4 mt-20">
                    <h3>{{ __('Biography') }}</h3>
                    <p class="mt-2">
                        {{ __('Share with us your fond memories, important moments for them, or what you loved most about them.') }}
                    </p>
                </div>

                <div class="col-12 col-md-7 p-3">

                    <div class="container mt-20">
                        <label for="biography" class="col-form-label text-md-end">{{ __('Biography') }}</label>
                        <textarea id="biography" class="form-control @error('biography') is-invalid @enderror" name="biography"
                            rows="13">{{ $memorial->biography }}</textarea>
                        @error('biography')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="text-center pb-55 mt-40">


            {{-- <button type="submit" id="submitBtn" class="butn butn-md butn-bord butn-rounded">
                <span class="text">
                    {{ __('Adatok mentése') }}
                </span>
                <span id="btnIcon" class="icon">
                    <i class="fa-regular fa-save"></i>
                </span>
                <span id="btnSpinner" class="icon d-none">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </span>
            </button> --}}

            <a href="{{ url('/' . $memorial->slug) }}" class="butn butn-md butn-bord butn-rounded">
                <span class="text">
                    {{ __('Save data') }}
                </span>
                <span class="icon">
                    <i class="fa-regular fa-save"></i>
                </span>
            </a>
            
        </div>

    </form>




    </html>


@endsection

@section('js')

    <!-- Cropper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        let cropper;
        let originalFile;

        const form = document.getElementById('uploadForm');
        const dragArea = document.getElementById('imageContainer');
        const fileInput = document.getElementById('photoInput');
        const fileTrigger = document.getElementById('fileTrigger');
        const image = document.getElementById('image');
        const defaultContent = dragArea.querySelector('.default-content');
        const cropControls = document.querySelector('.crop-controls');
        const removePhotoBtn = document.getElementById('removePhoto');
        const cropX = document.getElementById('cropX');
        const cropY = document.getElementById('cropY');
        const cropWidth = document.getElementById('cropWidth');
        const cropHeight = document.getElementById('cropHeight');

        fileTrigger.addEventListener('click', () => fileInput.click());

        function handleFile(file) {
            if (file && file.type.startsWith('image/')) {
                originalFile = file;
                const reader = new FileReader();
                reader.onload = function(event) {
                    image.src = event.target.result;
                    image.style.display = 'block';
                    defaultContent.style.display = 'none';
                    cropControls.style.display = 'flex'; // Показываем описание и кнопку

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(image, {
                        aspectRatio: 1 / 1,
                        viewMode: 1,
                        autoCropArea: 0.97,
                        scalable: false,
                        zoomable: false,
                        movable: true,
                        cropBoxResizable: true,
                        crop: function(event) {
                            const cropData = cropper.getData();
                            cropX.value = Math.round(cropData.x);
                            cropY.value = Math.round(cropData.y);
                            cropWidth.value = Math.round(cropData.width);
                            cropHeight.value = Math.round(cropData.height);
                        }
                    });
                };
                reader.readAsDataURL(file);
            }
        }

        // Удаление фото
        removePhotoBtn.addEventListener('click', () => {
            if (cropper) {
                cropper.destroy(); // Уничтожаем Cropper.js
            }
            image.src = ''; // Очищаем изображение
            image.style.display = 'none'; // Скрываем изображение
            defaultContent.style.display = 'block'; // Показываем исходный контент
            cropControls.style.display = 'none'; // Скрываем описание и кнопку
            fileInput.value = ''; // Сбрасываем input для новой загрузки
            cropX.value = ''; // Очищаем координаты
            cropY.value = '';
            cropWidth.value = '';
            cropHeight.value = '';
        });

        dragArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dragArea.classList.add('active');
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('active');
        });

        dragArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dragArea.classList.remove('active');
            const file = e.dataTransfer.files[0];
            handleFile(file);
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            handleFile(file);
        });

        form.addEventListener('submit', (e) => {
            // Cropper данные
            if (cropper) {
                const cropData = cropper.getData();
                cropX.value = Math.round(cropData.x);
                cropY.value = Math.round(cropData.y);
                cropWidth.value = Math.round(cropData.width);
                cropHeight.value = Math.round(cropData.height);
            }

            // Кнопка и спиннер
            let button = document.getElementById("submitBtn");
            let btnIcon = document.getElementById("btnIcon");
            let btnSpinner = document.getElementById("btnSpinner");

            if (button && btnIcon && btnSpinner) {
                button.disabled = true;
                btnIcon.classList.add("d-none");
                btnSpinner.classList.remove("d-none");
            } else {
                console.error("Один из элементов (submitBtn, btnIcon, btnSpinner) не найден");
            }
        });
    </script>

@endsection
