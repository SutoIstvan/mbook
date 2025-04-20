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
            {{-- <ul class="rest">
                <li>{{ $memorial->name }}</li>
            </ul> --}}
            <h6>
                <span class="sub-color inline">{{ $memorial->name }}</span>
            </h6>
        </div>
    </div>
    {{-- 
    <div class="container mt-80">
        <div class="row d-flex justify-content-center">
            <div class="steps-horizontal">
                <div class="step-vertical complete">
                    <div class="step-vertical-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-vertical-content">
                        <p><bold>Step 1<bold></p>
                        <p><small>Személyes adatok</small></p>
                    </div>
                </div>

                <div class="step-vertical active">
                    <div class="step-vertical-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="step-vertical-content">
                        <p><bold>Step 2<bold></p>
                        <p><small>Életesemények időpontjai</small></p>
                    </div>
                </div>

                <div class="step-vertical">
                    <div class="step-vertical-icon">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="step-vertical-content">
                        <p><bold>Step 2<bold></p>
                        <p><small>Média feltöltése</small></p>
                    </div>
                </div>

                <div class="step-vertical">
                    <div class="step-vertical-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div class="step-vertical-content">
                        <p><bold>Step 4<bold></p>
                        <p><small>Nyughely adatok</small></p>
                    </div>
                </div>


            </div>
        </div>
    </div> --}}


    <div class="container mt-70">
        <div class="row d-flex justify-content-center">
            <div class="steps-horizontal">
                <div class="step-horizontal complete">
                    <div class="step-icon">
                        {{-- <i class="fas fa-user"></i> --}}

                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-title">Step 1</div>
                    <div class="step-description">Személyes adatok</div>
                </div>

                <div class="step-horizontal active">
                    <div class="step-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="step-title">Step 2</div>
                    <div class="step-description">Életesemények időpontjai</div>
                </div>
                <div class="step-horizontal">
                    <div class="step-icon">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="step-title">Step 3</div>
                    <div class="step-description">Média feltöltése</div>
                </div>
                <div class="step-horizontal">
                    <div class="step-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div class="step-title">Step 4</div>
                    <div class="step-description">Nyughely adatok</div>
                </div>
            </div>
        </div>


    </div>

    {{-- <div class="container pt-50">
        <div class="stepper__row">
            <div class="stepper--horizontal ms-4">
                <div class="stepper--horizontal__circle ms-4">
                    <span class="stepper--horizontal__circle__text">
                        1
                    </span>
                </div>
                <div class="stepper--horizontal__details">
                    <p class="paragraph d-none d-md-block">
                        {{ __('Personal Data Entry') }}
                    </p>
                </div>
            </div>
            <div class="stepper--horizontal stepper--horizontal--disabled">
                <div class="stepper--horizontal__circle">
                    <span class="stepper--horizontal__circle__text">
                        2
                    </span>
                </div>
                <div class="stepper--horizontal__details">
                    <p class="paragraph d-none d-md-block">
                        {{ __('Dates of precious moments') }}
                    </p>
                </div>
            </div>
            <div class="stepper--horizontal stepper--horizontal--disabled">
                <div class="stepper--horizontal__circle">
                    <span class="stepper--horizontal__circle__text">
                        3
                    </span>
                </div>
                <div class="stepper--horizontal__details">
                    <h3 class="heading__three">
                    </h3>
                    <p class="paragraph d-none d-md-block">
                        {{ __('Upload media to the memorial page') }}
                    </p>
                </div>
            </div>
            <div class="stepper--horizontal stepper--horizontal--disabled">
                <div class="stepper--horizontal__circle">
                    <span class="stepper--horizontal__circle__text">
                        4
                    </span>
                </div>
                <div class="stepper--horizontal__details">
                    <h3 class="heading__three">
                    </h3>
                    <p class="paragraph d-none d-md-block">
                        {{ __('Nyughely adatok megadása') }}
                    </p>
                </div>
            </div>
        </div>
    </div> --}}

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


    <div class="container">
        <div class=" text-secondary text-center">
            <div class="pt-30">
                <div class="col-lg-8 mx-auto">
                    <p class="fs-5 mt-4 ">
                        Ezen az oldalon megadhatod a fontos eseményeit az időskálán. Válaszd ki az esemény
                        típusát, írd be a részleteket és a dátumot, majd kattints a 'Hozzáadás' gombra.
                    </p>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 p-4 mt-30">

                <div class="container">



                    <div class="row mb-3">
                        {{-- <div class="form-group col-12 col-md-12 mt-1">
                                <select name="role" class="form-select" required>
                                    <option value="">{{ __('Select a life event') }}</option>
                                    <option value="father">{{ __('Father') }}</option>
                                    <option value="mother">{{ __('Mother') }}</option>
                                    <option value="partner">{{ __('Partner') }}</option>
                                    <option value="children">{{ __('Children') }}</option>
                                    <option value="siblings">{{ __('Siblings') }}</option>
                                    <option value="pets">{{ __('Pets') }}</option>
                                </select>
                            </div> --}}
                        {{-- <div class="form-group col-12 col-md-6 mt-1">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                                    required>
                            </div> --}}

                        {{-- @dump($children) --}}


                        <select id="eventType" class="form-select">
                            <option value="">Válassz</option>
                            <option value="child_birth">Gyermek születése</option>
                            <option value="marriage">Házasság</option>
                            <option value="school">Iskola</option>
                            <option value="work">Munkahely</option>
                            <option value="hobby">Hobbija</option>
                            {{-- <option value="favorite_music">Kedvenc zenéi</option> --}}
                            <option value="other_properties">Egyéb tulajdonságai</option>
                        </select>

                        <form action="{{ route('timelines.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                            <div id="childrenInputs" class="mt-3" style="display: none;">
                                <div id="existingChildren mt-4">
                                    @foreach ($children as $child)
                                        <input type="hidden" name="children[{{ $loop->index }}][id]"
                                            value="{{ $child->id }}">

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control"
                                                    name="children[{{ $loop->index }}][name]" value="{{ $child->name }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control"
                                                    name="children[{{ $loop->index }}][birth_date]"
                                                    value="{{ $child->birth_date }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="newChildren"></div>

                                <button type="button" class="btn btn-outline-primary mt-2" id="addChild">+ Új gyermek
                                    hozzáadása</button>

                                <button type="submit" class="btn btn-outline-primary mt-2">Save</button>
                        </form>




                    </div>

                    <form action="{{ route('timelines.storeMarriage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                        <div id="marriageInputs" class="mt-3" style="display: none;">
                            <div id="existingMarriages" class="mt-4">
                                @foreach ($partners as $marriage)
                                    <input type="hidden" name="marriages[{{ $loop->index }}][id]"
                                        value="{{ $marriage->id }}">

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"
                                                name="marriages[{{ $loop->index }}][name]"
                                                value="{{ $marriage->name }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control"
                                                name="marriages[{{ $loop->index }}][marriage_date]"
                                                value="{{ $marriage->birth_date }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div id="newMarriages"></div>

                            <button type="button" class="btn btn-outline-primary mt-2" id="addMarriage">+ Új házasság
                                hozzáadása</button>
                            <button type="submit" class="btn btn-outline-primary mt-2">Save</button>
                        </div>
                    </form>

                    <!-- Форма школы (по умолчанию скрыта) -->
                    <div id="schoolForm" class="event-form" style="display: none;">
                        <form action="{{ route('timelines.addSchool') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <input type="text" name="school_name" class="form-control"
                                        placeholder="Iskola neve" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="school_date">School date from</label>

                                    <input type="date" name="school_date" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="school_date_to">School date to</label>
                                    <input type="date" name="school_date_to" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-3 mt-3 text-center">
                                    <button type="submit" class="btn btn-outline-primary">Mentés</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Форма work (по умолчанию скрыта) -->
                    <div id="workForm" class="event-form" style="display: none;">
                        <form action="{{ route('timelines.addWork') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <input type="text" name="work_name" class="form-control"
                                        placeholder="Munka neve" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="work_date">Work date from</label>

                                    <input type="date" name="work_date" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="work_date_to">Work date to</label>
                                    <input type="date" name="work_date_to" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-3 mt-3 text-center">
                                    <button type="submit" class="btn btn-outline-primary">Mentés</button>
                                </div>
                            </div>
                        </form>
                    </div>

                                        <!-- Форма Hobby (по умолчанию скрыта) -->
                                        <div id="hobbyForm" class="event-form" style="display: none;">
                                            <form action="{{ route('timelines.addHobby') }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                    
                                                <div class="row">
                                                    <div class="col-md-12 mb-2">
                                                        <input type="text" name="hobby_name" class="form-control"
                                                            placeholder="Munka neve" required>
                                                    </div>
                                                    {{-- <div class="col-md-6 mb-2">
                                                        <label for="hobby_date">hobby date from</label>
                    
                                                        <input type="date" name="hobby_date" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="hobby_date_to">hobby date to</label>
                                                        <input type="date" name="hobby_date_to" class="form-control" required>
                                                    </div> --}}
                                                    <div class="col-md-12 mb-3 mt-3 text-center">
                                                        <button type="submit" class="btn btn-outline-primary">Mentés</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                </div>
            </div>



            <br><br>
            @foreach ($timelines as $timeline)
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-10 col-md-10">
                            <ul class="timeline-3">
                                <li class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small>{{ $timeline->date }} </small>
                                        @if ($timeline->date_to)
                                            <small>- {{ $timeline->date_to }}</small>
                                        @endif
                                        @if ($timeline->type)
                                            - {{ __('aigenerate.timeline_types.' . $timeline->type) }}
                                        @endif
                                        <a>{{ $timeline->title }}</a>
                                    </div>

                                    <form action="{{ route('timelines.destroy', $timeline->id) }}" method="POST"
                                        onsubmit="return confirm('Biztosan törölni szeretnéd ezt az eseményt?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Törlés</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="container">
                <div class="d-flex justify-content-between mt-50">
                    <a href="{{ route('family.create', $memorial) }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    <a href="{{ route('timeline.gallery', $memorial) }}" class="btn btn-primary">
                        <i class="fa fa-save"></i> {{ __('Next') }}
                    </a>
                </div>
            </div>


        @endsection

        @section('js')

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const eventType = document.getElementById('eventType');
                    const childrenInputs = document.getElementById('childrenInputs');
                    const addChildBtn = document.getElementById('addChild');
                    const newChildrenContainer = document.getElementById('newChildren');
                    let newChildIndex = 0;

                    const marriageInputs = document.getElementById('marriageInputs');
                    const addMarriageBtn = document.getElementById('addMarriage');
                    const newMarriagesContainer = document.getElementById('newMarriages');
                    let marriageIndex = 0;

                    const schoolForm = document.getElementById('schoolForm'); // Форма для школы
                    const schoolInputs = document.getElementById('schoolInputs');
                    const addSchoolBtn = document.getElementById('addSchool');
                    const newSchoolContainer = document.getElementById('newSchool');
                    let schoolIndex = 0;

                    const workForm = document.getElementById('workForm'); // Форма для школы
                    const workInputs = document.getElementById('workInputs');
                    const addWorkBtn = document.getElementById('addWork');
                    const newWorkContainer = document.getElementById('newWork');
                    let workIndex = 0;

                    const hobbyInputs = document.getElementById('hobbyInputs');
                    const addHobbyBtn = document.getElementById('addHobby');
                    const newHobbyContainer = document.getElementById('newHobby');
                    let hobbyIndex = 0;

                    // Слушатель для изменения значения в селекте
                    eventType.addEventListener('change', function() {
                        const selected = this.value;

                        console.log("Selected event type:", selected); // Тест для проверки, что срабатывает

                        // Скрытие или отображение форм в зависимости от выбора
                        childrenInputs.style.display = selected === 'child_birth' ? 'block' : 'none';
                        marriageInputs.style.display = selected === 'marriage' ? 'block' : 'none';
                        schoolForm.style.display = selected === 'school' ? 'block' : 'none'; // Отображение формы школы

                        workForm.style.display = selected === 'work' ? 'block' : 'none'; //
                        // schoolInputs.style.display = selected === 'school' ? 'block' : 'none';
                        hobbyForm.style.display = selected === 'hobby' ? 'block' : 'none'; //

                        hobbyInputs.style.display = selected === 'hobby' ? 'block' : 'none';
                    });

                    // Добавление новой записи о ребенке
                    addChildBtn.addEventListener('click', function() {
                        const row = document.createElement('div');
                        row.classList.add('row', 'mb-2');
                        row.innerHTML = `
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="new_children[${newChildIndex}][name]" placeholder="Gyermek neve">
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-control" name="new_children[${newChildIndex}][birth_date]">
                        </div>
                    `;
                        newChildrenContainer.appendChild(row);
                        newChildIndex++;
                    });

                    // Добавление новой записи о браке
                    if (addMarriageBtn) {
                        addMarriageBtn.addEventListener('click', function() {
                            const row = document.createElement('div');
                            row.classList.add('row', 'mb-2');
                            row.innerHTML = `
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="new_marriages[${marriageIndex}][partner_name]" placeholder="Partner neve">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="new_marriages[${marriageIndex}][marriage_date]">
                            </div>
                        `;
                            newMarriagesContainer.appendChild(row);
                            marriageIndex++;
                        });
                    }

                    // Добавление новой записи о школе
                    if (addSchoolBtn) {
                        addSchoolBtn.addEventListener('click', function() {
                            const row = document.createElement('div');
                            row.classList.add('row', 'mb-2');
                            row.innerHTML = `
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="new_schools[${schoolIndex}][school_name]" placeholder="Iskola neve">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="new_schools[${schoolIndex}][start_date]">
                            </div>
                        `;
                            newSchoolContainer.appendChild(row);
                            schoolIndex++;
                        });
                    }

                    // Добавление новой записи о хобби
                    if (addHobbyBtn) {
                        addHobbyBtn.addEventListener('click', function() {
                            const row = document.createElement('div');
                            row.classList.add('row', 'mb-2');
                            row.innerHTML = `
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="new_hobbies[${hobbyIndex}][hobby_name]" placeholder="Hobbi neve">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="new_hobbies[${hobbyIndex}][start_date]">
                            </div>
                        `;
                            newHobbyContainer.appendChild(row);
                            hobbyIndex++;
                        });
                    }

                });
            </script>


        @endsection
