@extends('layouts.memorial')

@section('css')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&libraries=places">
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

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

        .stepper__row {
            display: flex;
            justify-content: space-between;
            max-width: 1064px;
            margin: 0 auto;
            position: relative;
        }

        .stepper--horizontal {
            display: flex;
            align-items: center;
            flex: 1;
            position: relative;
        }

        .stepper--horizontal__circle {
            width: 50px;
            height: 50px;
            background-color: #f7f7f7;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            border-width: 3px;
            /* Толщина границы */
            border-color: #388cf3;
            /* Цвет границы */
            border-style: solid;
        }

        .stepper--horizontal__circle__text {
            color: #388cf3;
            font-size: 18px;
            font-weight: 500;
        }

        .stepper--horizontal__details {
            margin-left: 14px;
            max-width: 160px;
        }

        .stepper--horizontal:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 2px;
            background-color: #388CF3;
        }

        .stepper--horizontal--disabled .stepper--horizontal__circle {
            background-color: #ccc;
            opacity: 0.4;
            border-color: #ccc;
        }

        .stepper--horizontal--disabled .stepper--horizontal__circle__text {
            color: rgba(62, 78, 104, 0.7);
        }

        .stepper--horizontal--disabled .stepper--horizontal__details .heading__three,
        .stepper--horizontal--disabled .stepper--horizontal__details .paragraph {
            color: rgba(62, 78, 104, 0.7);
        }

        .heading__three {
            font-size: 22px;
            font-weight: 500;
            color: #3E4E68;
            line-height: 26px;
            margin: 0;
            letter-spacing: 0.1px;
        }

        .paragraph {
            font-size: 14px;
            font-weight: 500;
            color: #3E4E68;
            line-height: 22px;
            margin: 2px 0 0 0;
        }

        .form-container {
            max-width: 964px;
            margin: 20px auto;
        }

        .steps-horizontal {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1000px;
            position: relative;
            padding: 0;
        }

        .steps-horizontal::before {
            content: '';
            position: absolute;
            top: 24px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }

        .step-horizontal {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: 2px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 20px;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .step-title {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .step-description {
            font-size: 12px;
            color: #adb5bd;
            max-width: 150px;
            margin: 0 auto;
        }

        .step-horizontal.active .step-icon {
            background: #4361ee;
            border-color: #4361ee;
            color: white;
            box-shadow: 0 0 0 5px rgba(67, 97, 238, 0.2);
        }

        .step-horizontal.complete .step-icon {
            background: #2ecc71;
            border-color: #2ecc71;
            color: white;
        }

        /* Vertical Steps Style */
        .steps-vertical {
            max-width: 500px;
            margin: 2rem auto;
            padding: 0;
        }

        .step-vertical {
            display: flex;
            position: relative;
        }

        .step-vertical:not(:last-child)::after {
            content: '';
            /* position: absolute;
                                                                             left: 25px;
                                                                             top: 60px;
                                                                             bottom: 0;
                                                                             width: 2px;
                                                                             background: #e9ecef; */
        }

        .step-vertical-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: 2px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
            color: #6c757d;
            position: relative;
            z-index: 2;
            flex-shrink: 0;
        }

        .step-vertical-content {
            z-index: 1;
            background-color: #f7f7f7;
            padding-left: 5px;
            padding-right: 15px;
            /* padding-top: 0.5rem; */
        }

        .step-vertical.active .step-vertical-icon {
            background: #4361ee;
            border-color: #4361ee;
            color: white;
            box-shadow: 0 0 0 5px rgba(67, 97, 238, 0.2);
        }

        .step-vertical.complete .step-vertical-icon {
            background: #2ecc71;
            border-color: #2ecc71;
            color: white;
        }

        /* Interactive buttons */
        .controls {
            text-align: center;
        }

        ul.timeline-3 {
            list-style-type: none;
            position: relative;
        }

        ul.timeline-3:before {
            content: " ";
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 150%;
            margin-top: 5px;
            z-index: 400;
        }

        ul.timeline-3>li {
            margin: 0px 0;
            padding-left: 20px;
        }

        ul.timeline-3>li:before {
            content: " ";
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 23px;
            width: 15px;
            height: 15px;
            margin-top: 5px;
            z-index: 400;
        }
    </style>
@endsection

@section('title', 'Adat mentés - mbook.hu')

@section('content')

    <div class="info md-hide about-ca pt-30">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover;" alt=""
                class="img-fluid">
        </div>
        <div class="cont text-center pt-10">
            <h6>
                <span class="sub-color inline">{{ $memorial->name }}</span>
            </h6>
        </div>
    </div>

    <div class="container mt-70">
        <div class="row d-flex justify-content-center">
            <div class="steps-horizontal">
                <div class="step-horizontal complete">
                    <div class="step-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-title">{{ __('Step 1') }}</div>
                    <div class="step-description">{{ __('Family Tree') }}</div>
                </div>

                <div class="step-horizontal complete">
                    <div class="step-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="step-title">{{ __('Step 2') }}</div>
                    <div class="step-description">{{ __('Life Events Timeline') }}</div>
                </div>
                <div class="step-horizontal complete">
                    <div class="step-icon">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="step-title">{{ __('Step 3') }}</div>
                    <div class="step-description">{{ __('Media Upload') }}</div>
                </div>
                <div class="step-horizontal active">
                    <div class="step-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div class="step-title">{{ __('Step 4') }}</div>
                    <div class="step-description">{{ __('Burial Information') }}</div>
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

    <body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9">
                <div class="">

                    <div class="">
                        <form id="biographyForm">

                            <!-- Jellemzők és Emlékek -->
                            <div class="form-section">
                                <h6 class="section-title mb-3">Jellemzők, Értékek és Életelvek</h6>
                                
                                <div class="checkbox-group row ms-3">
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="cheerful">
                                        <label class="form-check-label" for="cheerful">Vidám</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="kind">
                                        <label class="form-check-label" for="kind">Kedves</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="helpful">
                                        <label class="form-check-label" for="helpful">Segítőkész</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="family-centered">
                                        <label class="form-check-label" for="family-centered">Családcentrikus</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="wise">
                                        <label class="form-check-label" for="wise">Bölcs / megfontolt</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="humorous">
                                        <label class="form-check-label" for="humorous">Humorérzéke legendás volt</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="strict-fair">
                                        <label class="form-check-label" for="strict-fair">Szigorú, de igazságos</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="creative">
                                        <label class="form-check-label" for="creative">Kreatív / művészlélek</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="precise">
                                        <label class="form-check-label" for="precise">Precíz / rendszerető</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="brave">
                                        <label class="form-check-label" for="brave">Bátor</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="religious">
                                        <label class="form-check-label" for="religious">Vallásos / hívő</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="calm">
                                        <label class="form-check-label" for="calm">Nyugodt</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="energetic">
                                        <label class="form-check-label" for="energetic">Energiával teli</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="customTraits" class="form-label">Egyéb személyiségjegyek, milyen értékeket képviselt, mit tartott a legfontosabbnak?:</label>
                                    <input type="text" class="form-control" id="customTraits" placeholder="pl: Barátság,  hivatás, Tudás, tanulás, Becsület, tisztesség, Segítőkészség, jótékonyság, Hazaszeretet">
                                </div>
                            </div>

                            <!-- Hobbik és Szenvedélyek -->
                            <div class="form-section">
                                <h6 class="section-title mb-3 mt-4">{{ __('Hobbies and Passions') }}</h6>

                                <div class="checkbox-group row ms-3">
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="gardening">
                                        <label class="form-check-label" for="gardening">{{ __('Gardening') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="fishing">
                                        <label class="form-check-label" for="fishing">{{ __('Fishing') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="crafting">
                                        <label class="form-check-label" for="crafting">{{ __('Crafting / DIY') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="traveling">
                                        <label class="form-check-label" for="traveling">{{ __('Traveling') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="cooking">
                                        <label class="form-check-label" for="cooking">{{ __('Cooking / baking') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="music">
                                        <label class="form-check-label" for="music">{{ __('Music (singing, instrument)') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="reading">
                                        <label class="form-check-label" for="reading">{{ __('Reading') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="sports">
                                        <label class="form-check-label" for="sports">{{ __('Sports (running, swimming, boxing)') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="dancing">
                                        <label class="form-check-label" for="dancing">{{ __('Dancing') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="animal-care">
                                        <label class="form-check-label" for="animal-care">{{ __('Animal care') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="collecting">
                                        <label class="form-check-label" for="collecting">{{ __('Collecting (stamps, coins, etc.)') }}</label>
                                    </div>
                                    <div class="form-check custom-checkbox col-12 col-md-6 col-lg-4 mb-2">
                                        <input class="form-check-input" type="checkbox" id="volunteering">
                                        <label class="form-check-label" for="volunteering">{{ __('Volunteering') }}</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="customHobbies" class="form-label">Egyéb hobbi / szenvedély (szabadon írt):</label>
                                    <input type="text" class="form-control" id="customHobbies" placeholder="További hobbik...">
                                </div>
                            </div>

                            <!-- Értékek, Életelvek -->
                            {{-- <div class="form-section">
                                <h6 class="section-title mt-4">Értékek, Életelvek <span class="text-muted ms-0 ms-lg-2 fs-6">Milyen értékeket képviselt, mi volt számára a legfontosabb az életben?</span></h6>
                                <div class="mb-3 mt-2">
                                    <textarea class="form-control" id="values" rows="4" placeholder="pl: Család, Barátság, Munka, hivatás, Vallás, hit, Tudás, tanulás, Becsület, tisztesség, Segítőkészség, jótékonyság, Hazaszeretet"></textarea>
                                </div>
                            </div> --}}

                            <!-- Nyugdíjas évek -->
                            <div class="form-section">
                                <h6 class="section-title mt-4">Nyugdíjas évek <span class="text-muted ms-0 ms-lg-2 fs-6">Hogyan töltötte a nyugdíjas éveit? Mivel foglalkozott ekkor? Utazott? Volt kedvenc helye, ahol szívesen pihent?</span></h6>
                                <div class="mb-3 mt-2">
                                    <textarea class="form-control" id="retirement" rows="3" placeholder="Példa: Nyugdíjas éveit a kertjében töltötte, szeretett rózsákat metszeni, és minden nyáron a Balatonnál nyaralt a családdal."></textarea>
                                </div>
                            </div>

                            <!-- Apró szokások -->
                            <div class="form-section">
                                <h6 class="section-title mt-4">Emlékezetes szokások <span class="text-muted ms-0 ms-lg-2 fs-6">Volt olyan apró szokása, amire mindenki emlékszik?</span></h6>
                                <div class="mb-3 mt-2">
                                    <textarea class="form-control" id="habits" rows="3" placeholder="Példák: Mindig a konyhaasztalnál kávézott reggelente. / Minden vasárnap friss kalácsot sütött. / Minden születésnapra saját készítésű képeslappal lepett meg mindenkit."></textarea>
                                </div>
                            </div>

                            <!-- Vidám történetek -->
                            <div class="form-section">
                                <h6 class="section-title mt-4">Emlékek <span class="text-muted ms-0 ms-lg-2 fs-6">Olyan történet, esemény vagy jellemző amire mindig emlékezzünk</span></h6>
                                <div class="mb-3 mt-2">
                                    <textarea class="form-control" id="stories" rows="3" placeholder="Példák: Egyszer a kerti locsolót véletlenül magára fordította, és mindenki nevetett. / Minden karácsonykor vicces sapkában ajándékozott."></textarea>
                                </div>
                            </div>

                            <!-- Életbölcsesség -->
                            <div class="form-section">
                                <h6 class="section-title mt-4">Életbölcsesség <span class="text-muted ms-0 ms-lg-2 fs-6">Mi volt az az életbölcsesség, amit hátrahagyott számunkra?</span></h6>
                                <div class="mb-3 mt-2">
                                    <textarea class="form-control" id="wisdom" rows="3" placeholder="Milyen tanácsokat, bölcsességeket osztott meg az életben?"></textarea>
                                </div>
                            </div>

                            <!-- Submit gomb -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-submit">
                                    📝 Biográfia generálása
                                </button>
                            </div>
                        </form>

                        <!-- Eredmény terület -->
                        <div id="result" class="mt-4" style="display: none;">
                            <div class="alert alert-success">
                                <h4>Összegyűjtött információk:</h4>
                                <div id="resultContent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="container">




        <div class="container">


            <div class="container col-9 pb-55">
                <div class="d-flex justify-content-between mt-30 pb-50">
                    <a href="{{ route('timeline.gallery', $memorial) }}"
                        class="btn btn-secondary">{{ __('Back') }}</a>
                    <a href="{{ route('generate.biography', $memorial) }}" class="btn btn-primary" id="nextButton">
                        <i class="fa fa-save"></i> {{ __('Next') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Overlay for loading spinner -->
        <div id="loadingOverlay" style="display: none;">
            <div class="spinner"></div>
            <p>{{ __('Please wait, generating biography') }}</p>
        </div>

    @endsection

    @section('js')

        <script>
            document.getElementById('nextButton').addEventListener('click', function(event) {
                // Prevent default navigation immediately
                event.preventDefault();

                // Show the overlay
                const overlay = document.getElementById('loadingOverlay');
                overlay.style.display = 'flex';

                // Navigate to the next page after a short delay to ensure overlay is visible
                setTimeout(() => {
                    window.location.href = this.href;
                }, 300); // 300ms delay to allow overlay to appear
            });

            // Глобальная функция, которая будет вызвана после загрузки API
            function initMap() {
                initAutocomplete();
            }

            // Инициализация автозаполнения мест
            function initAutocomplete() {
                const input = document.getElementById('autocomplete');

                // Используем только один тип для предотвращения ошибки "establishment cannot be mixed with other types"
                // 'establishment' подходит для разных учреждений и мест, включая кладбища
                const options = {
                    types: ['establishment'],
                    language: 'hu',
                    // Можно добавить ограничение по стране, если нужно
                    // componentRestrictions: {country: 'ru'}
                };

                // Создаем экземпляр Autocomplete
                const autocomplete = new google.maps.places.Autocomplete(input, options);

                // Слушатель события выбора места
                autocomplete.addListener('place_changed', function() {
                    const place = autocomplete.getPlace();

                    if (!place.geometry) {
                        console.log("The selected location does not contain geometric information");
                        return;
                    }

                    // Сохраняем типы места


                });

                // Добавляем обработчик для фокуса, чтобы подсказать пользователю
                input.addEventListener('focus', function() {
                    if (!this.value.toLowerCase().includes('cementry')) {
                        // Можно оставить поле пустым или предложить подсказку
                        // this.value = 'кладбище ';
                    }
                });
            }

            // Если API загружен до того, как DOM будет готов, мы обрабатываем это
            if (window.google && window.google.maps) {
                document.addEventListener('DOMContentLoaded', initMap);
            }
        </script>

    @endsection
