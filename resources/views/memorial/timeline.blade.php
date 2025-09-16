@extends('layouts.memorial')

@section('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .tracking-detail {
            padding: 3rem 0
        }

        #tracking {
            margin-bottom: 1rem
        }

        [class*=tracking-status-] p {
            margin: 0;
            font-size: 1.1rem;
            color: #fff;
            text-transform: uppercase;
            text-align: center
        }

        [class*=tracking-status-] {
            padding: 1.6rem 0
        }

        .tracking-status-intransit {
            background-color: #65aee0
        }

        .tracking-status-outfordelivery {
            background-color: #f5a551
        }

        .tracking-status-deliveryoffice {
            background-color: #f7dc6f
        }

        .tracking-status-delivered {
            background-color: #4cbb87
        }

        .tracking-status-attemptfail {
            background-color: #b789c7
        }

        .tracking-status-error,
        .tracking-status-exception {
            background-color: #d26759
        }

        .tracking-status-expired {
            background-color: #616e7d
        }

        .tracking-status-pending {
            background-color: #ccc
        }

        .tracking-status-inforeceived {
            background-color: #214977
        }

        .tracking-list {
            border: 1px solid #e5e5e5
        }

        .tracking-item {
            border-left: 1px solid #bff4ff;
            position: relative;
            padding: 2rem 1.5rem .5rem 2.5rem;
            font-size: .9rem;
            margin-left: 3rem;
            min-height: 5rem
        }

        .tracking-item:last-child {
            padding-bottom: 0.5rem
        }

        .tracking-item .tracking-date {
            margin-bottom: .5rem
        }

        .tracking-item .tracking-date span {
            color: #888;
            font-size: 85%;
            padding-left: .4rem
        }

        .tracking-item .tracking-content {
            padding: .5rem .8rem;
            /* background-color:#f4f4f4; */
            border-radius: .5rem;

        }

        .border {
            border: 0px #dee2e6 !important;
            padding: 20px 25px;
            border-radius: 6px;
            background: white;
            filter: drop-shadow(2px 1px 3px rgba(0, 0, 0, 0.1)) drop-shadow(0px 0px 1px rgba(0, 0, 0, 0.01));
        }

        .border:before {
            content: '';
            position: absolute;
            top: 10px;
            left: 0px;
            margin: 0 0 0 -8px;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid #fff;
        }

        .tracking-item .tracking-content span {
            display: block;
            color: #888;
            font-size: 85%
        }

        .tracking-item .tracking-icon {
            line-height: 2.6rem;
            position: absolute;
            left: -1.3rem;
            width: 2.7rem;
            height: 2.7rem;
            text-align: center;
            border-radius: 50%;
            font-size: 1.1rem;
            background-color: #fff;
            color: #fff
        }

        .tracking-item .tracking-icon.status-sponsored {
            background-color: #f68
        }

        .tracking-item .tracking-icon.status-delivered {
            background-color: #4cbb87
        }

        .tracking-item .tracking-icon.status-outfordelivery {
            background-color: #f5a551
        }

        .tracking-item .tracking-icon.status-deliveryoffice {
            background-color: #f7dc6f
        }

        .tracking-item .tracking-icon.status-attemptfail {
            background-color: #b789c7
        }

        .tracking-item .tracking-icon.status-exception {
            background-color: #d26759
        }

        .tracking-item .tracking-icon.status-inforeceived {
            background-color: #214977
        }

        .tracking-item .tracking-icon.status-intransit {
            /* color:#e5e5e5; */
            border: 1px solid #72dfe4;
            font-size: .6rem
        }

        @media(min-width:992px) {
            .tracking-item {
                margin-left: 10rem
            }

            .tracking-item .tracking-date {
                position: absolute;
                left: -9.5rem;
                width: 7.5rem;
                text-align: right
            }

            .tracking-item .tracking-date span {
                display: block
            }

            .tracking-item .tracking-content {
                padding: 0;
                background-color: transparent
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
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-title">{{ __('Step 1') }}</div>
                    <div class="step-description">{{ __('Family Tree') }}</div>
                </div>

                <div class="step-horizontal active">
                    <div class="step-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="step-title">{{ __('Step 2') }}</div>
                    <div class="step-description">{{ __('Timeline') }}</div>
                </div>
                <div class="step-horizontal">
                    <div class="step-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="step-title">{{ __('Step 3') }}</div>
                    <div class="step-description">{{ __('Features, events') }}</div>
                </div>
                <div class="step-horizontal">
                    <div class="step-icon">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="step-title">{{ __('Step 4') }}</div>
                    <div class="step-description">{{ __('Media Upload') }}</div>
                </div>
                <div class="step-horizontal">
                    <div class="step-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div class="step-title">{{ __('Step 5') }}</div>
                    <div class="step-description">{{ __('Burial Information') }}</div>
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
                        {{ __('This page allows you to add important events to your timeline. Select the event type, enter the details and date, and then click the "Add" button.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10">

                <div class="">

                    <form action="{{ route('timelines.newstore', $memorial) }}" method="POST">
                        @csrf
                        <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                        {{-- Форма добавления нового события --}}
                        <div class="tracking-item mt-4">
                            <div class="tracking-icon status-intransit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M7.43361 9.90622C5.34288 10.3793 4.29751 10.6158 4.04881 11.4156C3.8001 12.2153 4.51276 13.0487 5.93808 14.7154L6.30683 15.1466C6.71186 15.6203 6.91438 15.8571 7.00548 16.1501C7.09659 16.443 7.06597 16.759 7.00474 17.3909L6.94899 17.9662C6.7335 20.19 6.62575 21.3019 7.27688 21.7962C7.928 22.2905 8.90677 21.8398 10.8643 20.9385L11.3708 20.7053C11.927 20.4492 12.2052 20.3211 12.5 20.3211C12.7948 20.3211 13.073 20.4492 13.6292 20.7053L14.1357 20.9385C16.0932 21.8398 17.072 22.2905 17.7231 21.7962C18.3742 21.3019 18.2665 20.19 18.051 17.9662M19.0619 14.7154C20.4872 13.0487 21.1999 12.2153 20.9512 11.4156C20.7025 10.6158 19.6571 10.3793 17.5664 9.90622L17.0255 9.78384C16.4314 9.64942 16.1343 9.5822 15.8958 9.40114C15.6573 9.22007 15.5043 8.94564 15.1984 8.3968L14.9198 7.89712C13.8432 5.96571 13.3048 5 12.5 5C11.6952 5 11.1568 5.96571 10.0802 7.89712"
                                        stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M4.98987 2C4.98987 2 5.2778 3.45771 5.90909 4.08475C6.54037 4.71179 8 4.98987 8 4.98987C8 4.98987 6.54229 5.2778 5.91525 5.90909C5.28821 6.54037 5.01013 8 5.01013 8C5.01013 8 4.7222 6.54229 4.09091 5.91525C3.45963 5.28821 2 5.01013 2 5.01013C2 5.01013 3.45771 4.7222 4.08475 4.09091C4.71179 3.45963 4.98987 2 4.98987 2Z"
                                        stroke="#24cdd5" stroke-linejoin="round" />
                                    <path d="M18 5H20M19 6L19 4" stroke="#24cdd5" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                            </div>

                            <div class="tracking-date defaultcolor fs-4 wow fadeIn d-flex justify-content-end mt-1"
                                data-wow-delay="300ms">
                                {{-- <select id="eventYear" name="year" class="form-select"
                                    style="max-width: 90px; overflow-y: auto;" required>
                                    <option value=""></option>
                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                        <option value="{{ $year }}"
                                            {{ old('year', date('Y')) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select> --}}
                            </div>
                            <div class="border mt-1">
                                <div class="tracking-content defaultcolor fs-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <select name="type" class="form-select" id="typeSelect">
                                                <option value="">{{ __('Select event type') }}</option>
                                                <option value="child_birth">{{ __('Child Birth') }}</option>
                                                <option value="marriage">{{ __('Marriage') }}</option>
                                                <option value="school">{{ __('School') }}</option>
                                                <option value="work">{{ __('Work') }}</option>
                                                <option value="hobby">{{ __('Hobby') }}</option>
                                                <option value="other_properties">{{ __('Other Properties') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-2" id="yearFromWrapper">
                                            <select id="eventYear" name="year" class="form-select" required>
                                                <option value="">{{ __('From Year') }}</option>
                                                @for ($year = date('Y'); $year >= 1900; $year--)
                                                    <option value="{{ $year }}"
                                                        {{ old('year', date('Y')) == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-6 mt-2" id="dateToWrapper" style="display: none;">
                                            <select id="eventYearTo" name="date_to" class="form-select">
                                                <option value="">{{ __('To Year') }}</option>
                                                @for ($year = date('Y'); $year >= 1900; $year--)
                                                    <option value="{{ $year }}"
                                                        {{ old('date_to') == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <!-- Поле для своего значения -->
                                        <div id="customTypeWrapper" class="mt-2" style="display: none;">
                                            <input type="text" name="custom_type" class="form-control"
                                                placeholder="{{ __('Enter a name for the timeline') }}">
                                        </div>

                                        <div class="mt-2">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="{{ __('Enter timeline details') }}">
                                        </div>
                                        <div class="col-12 mt-2">

                                            <button type="submit"
                                                class="btn btn-outline-primary mt-2 w-100">{{ __('Add') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <form action="{{ route('timelines.updateNext') }}" method="POST">
                        @csrf
                        <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                        {{-- Список существующих событий для редактирования --}}
                        @foreach ($timelines as $timeline)
                            <div class="tracking-item">
                                <input type="hidden" name="timelines[{{ $timeline->id }}][id]"
                                    value="{{ $timeline->id }}">

                                <div class="tracking-icon status-intransit">

                                    @if ($timeline->type == 'marriage')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M8.96173 18.9109L9.42605 18.3219L8.96173 18.9109ZM12 5.50063L11.4596 6.02073C11.601 6.16763 11.7961 6.25063 12 6.25063C12.2039 6.25063 12.399 6.16763 12.5404 6.02073L12 5.50063ZM15.0383 18.9109L15.5026 19.4999L15.0383 18.9109ZM7.00061 16.4209C6.68078 16.1577 6.20813 16.2036 5.94491 16.5234C5.68169 16.8432 5.72758 17.3159 6.04741 17.5791L7.00061 16.4209ZM2.34199 13.4115C2.54074 13.7749 2.99647 13.9084 3.35988 13.7096C3.7233 13.5108 3.85677 13.0551 3.65801 12.6917L2.34199 13.4115ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55954 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219ZM9.42605 18.3219C8.63014 17.6945 7.82129 17.0963 7.00061 16.4209L6.04741 17.5791C6.87768 18.2624 7.75472 18.9144 8.49742 19.4999L9.42605 18.3219ZM3.65801 12.6917C3.0968 11.6656 2.75 10.5033 2.75 9.1371H1.25C1.25 10.7746 1.66995 12.1827 2.34199 13.4115L3.65801 12.6917Z"
                                                fill="#24cdd5" />
                                        </svg>
                                    @endif

                                    @if ($timeline->type == 'school')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M9.78272 3.49965C11.2037 2.83345 12.7962 2.83345 14.2172 3.49965L20.9084 6.63664C22.3639 7.31899 22.3639 9.68105 20.9084 10.3634L14.2173 13.5003C12.7963 14.1665 11.2038 14.1665 9.78281 13.5003L3.0916 10.3634C1.63613 9.68101 1.63614 7.31895 3.0916 6.63659L6 5.27307"
                                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M2 8.5V14" stroke="#24cdd5" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path
                                                d="M12 21C10.204 21 7.8537 19.8787 6.38533 19.0656C5.5035 18.5772 5 17.6334 5 16.6254V11.5M19 11.5V16.6254C19 17.6334 18.4965 18.5772 17.6147 19.0656C17.0843 19.3593 16.4388 19.6932 15.7459 20"
                                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    @endif

                                    @if ($timeline->type == 'child_birth')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M8.00012 16.6066C9.1493 17.4664 10.5185 17.9874 12 17.9998C16.142 18.0343 19.5937 14.0798 19.5603 9.8043C19.5268 5.52875 16.142 2.03476 12 2.00026C7.858 1.96576 4.52734 5.4038 4.56077 9.67936C4.56976 10.8295 4.81252 11.9605 5.24326 13"
                                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M15.5 9C15.4867 7.35641 14.1436 6.01326 12.5 6" stroke="#24cdd5"
                                                stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M12 20.3502C12.3212 20.3502 12.4818 20.3502 12.5933 20.3283C13.2466 20.1999 13.6441 19.5557 13.4511 18.9384C13.4181 18.833 13.342 18.6962 13.1896 18.4227M12 20.3502C11.6788 20.3502 11.5182 20.3502 11.4067 20.3283C10.7534 20.1999 10.3559 19.5557 10.5489 18.9384C10.5819 18.833 10.658 18.6962 10.8104 18.4227M12 20.3502V22.5"
                                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    @endif

                                    @if ($timeline->type == 'work')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M2 14C2 10.2288 2 8.34315 3.17157 7.17157C4.34315 6 6.22876 6 10 6H14C17.7712 6 19.6569 6 20.8284 7.17157C21.4816 7.82475 21.7706 8.69989 21.8985 10M22 14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22878 22 4.34314 22 3.17157 20.8284C2.51839 20.1752 2.22937 19.3001 2.10149 18"
                                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M16 6C16 4.11438 16 3.17157 15.4142 2.58579C14.8284 2 13.8856 2 12 2C10.1144 2 9.17157 2 8.58579 2.58579C8 3.17157 8 4.11438 8 6"
                                                stroke="#24cdd5" stroke-width="1.5" />
                                            <path
                                                d="M17 9C17 9.55228 16.5523 10 16 10C15.4477 10 15 9.55228 15 9C15 8.44772 15.4477 8 16 8C16.5523 8 17 8.44772 17 9Z"
                                                fill="#24cdd5" />
                                            <path
                                                d="M9 9C9 9.55228 8.55228 10 8 10C7.44772 10 7 9.55228 7 9C7 8.44772 7.44772 8 8 8C8.55228 8 9 8.44772 9 9Z"
                                                fill="#24cdd5" />
                                        </svg>
                                    @endif

                                    @if ($timeline->type == 'hobby')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                            viewBox="0 0 24 24" fill="none">
                                            <circle cx="14.5" cy="4.5" r="2.5" stroke="#24cdd5"
                                                stroke-width="1.5" />
                                            <path
                                                d="M19 21.9959V18.0489C19 16.273 17.395 14.9199 15.6265 15.2047M7.94806 13.4348L7.92328 13.4109C6.88143 12.404 7.6864 10.7852 8.5932 10.1427C9.5 9.50016 13.3451 8.50016 13.3451 13.4345C13.3451 15.1273 12.8704 16.7131 12.0433 18.0489M5 22.0003C6.46053 22.0003 7.82003 21.6256 9 20.9679"
                                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    @endif

                                    @if (
                                        $timeline->type != 'marriage' &&
                                            $timeline->type != 'hobby' &&
                                            $timeline->type != 'school' &&
                                            $timeline->type != 'work' &&
                                            $timeline->type != 'child_birth')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M7.43361 9.90622C5.34288 10.3793 4.29751 10.6158 4.04881 11.4156C3.8001 12.2153 4.51276 13.0487 5.93808 14.7154L6.30683 15.1466C6.71186 15.6203 6.91438 15.8571 7.00548 16.1501C7.09659 16.443 7.06597 16.759 7.00474 17.3909L6.94899 17.9662C6.7335 20.19 6.62575 21.3019 7.27688 21.7962C7.928 22.2905 8.90677 21.8398 10.8643 20.9385L11.3708 20.7053C11.927 20.4492 12.2052 20.3211 12.5 20.3211C12.7948 20.3211 13.073 20.4492 13.6292 20.7053L14.1357 20.9385C16.0932 21.8398 17.072 22.2905 17.7231 21.7962C18.3742 21.3019 18.2665 20.19 18.051 17.9662M19.0619 14.7154C20.4872 13.0487 21.1999 12.2153 20.9512 11.4156C20.7025 10.6158 19.6571 10.3793 17.5664 9.90622L17.0255 9.78384C16.4314 9.64942 16.1343 9.5822 15.8958 9.40114C15.6573 9.22007 15.5043 8.94564 15.1984 8.3968L14.9198 7.89712C13.8432 5.96571 13.3048 5 12.5 5C11.6952 5 11.1568 5.96571 10.0802 7.89712"
                                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path
                                                d="M4.98987 2C4.98987 2 5.2778 3.45771 5.90909 4.08475C6.54037 4.71179 8 4.98987 8 4.98987C8 4.98987 6.54229 5.2778 5.91525 5.90909C5.28821 6.54037 5.01013 8 5.01013 8C5.01013 8 4.7222 6.54229 4.09091 5.91525C3.45963 5.28821 2 5.01013 2 5.01013C2 5.01013 3.45771 4.7222 4.08475 4.09091C4.71179 3.45963 4.98987 2 4.98987 2Z"
                                                stroke="#24cdd5" stroke-linejoin="round"></path>
                                            <path d="M18 5H20M19 6L19 4" stroke="#24cdd5" stroke-width="1.5"
                                                stroke-linecap="round"></path>
                                        </svg>
                                    @endif


                                </div>

                                <div class="tracking-date defaultcolor fs-4 wow fadeIn d-flex justify-content-end mt-1"
                                    data-wow-delay="300ms">
                                    <select name="timelines[{{ $timeline->id }}][date]" class="form-select"
                                        style="max-width: 90px;" required>
                                        <option value=""></option>
                                        @for ($date = date('Y'); $date >= 1900; $date--)
                                            <option value="{{ $date }}"
                                                {{ $timeline->date && \Carbon\Carbon::parse($timeline->date)->format('Y') == $date ? 'selected' : '' }}>
                                                {{ $date }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="border p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="tracking-content defaultcolor fs-6 w-100">
                                            @if (in_array($timeline->type, ['child_birth', 'marriage', 'school', 'work', 'hobby']))
                                                <select name="timelines[{{ $timeline->id }}][type]" class="form-select">
                                                    <option value="child_birth"
                                                        {{ $timeline->type == 'child_birth' ? 'selected' : '' }}>
                                                        {{ __('Child Birth') }}
                                                    </option>
                                                    <option value="marriage"
                                                        {{ $timeline->type == 'marriage' ? 'selected' : '' }}>
                                                        {{ __('Marriage') }}
                                                    </option>
                                                    <option value="school"
                                                        {{ $timeline->type == 'school' ? 'selected' : '' }}>
                                                        {{ __('School') }}
                                                    </option>
                                                    <option value="work"
                                                        {{ $timeline->type == 'work' ? 'selected' : '' }}>
                                                        {{ __('Work') }}
                                                    </option>
                                                    <option value="hobby"
                                                        {{ $timeline->type == 'hobby' ? 'selected' : '' }}>
                                                        {{ __('Hobby') }}
                                                    </option>
                                                </select>
                                            @else
                                                {{-- Кастомный тип --}}
                                                <input type="text" name="timelines[{{ $timeline->id }}][type]"
                                                    class="form-control" value="{{ $timeline->type }}"
                                                    placeholder="{{ __('Enter a name for the timeline') }}" required>
                                            @endif

                                            <input type="text" name="timelines[{{ $timeline->id }}][title]"
                                                class="form-control mt-2" value="{{ $timeline->title }}"
                                                placeholder="{{ __('Enter timeline details') }}" required>
                                        </div>


                                        {{-- Кнопка удаления можно либо через JS --}}
                                        <div class="ms-3">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="deleteTimeline({{ $timeline->id }})">
                                                {{ __('Delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary mt-3">{{ __('Save changes') }}</button>
                        </div> --}}




                </div>
            </div>

            <div class="container col-12 col-md-10">
                <div class="d-flex justify-content-between mt-50 pb-50">
                    <a href="{{ route('family.create', $memorial) }}"
                        class="btn btn-secondary ms-3">{{ __('Back') }}</a>

                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i>
                        {{ __('Next') }}</button>
                </div>
            </div>
            </form>

        @endsection

        @section('js')

            <script>
                function deleteTimeline(timelineId) {
                    if (!confirm('Biztosan törölni szeretnéd ezt az eseményt?')) {
                        return; // если пользователь отменил удаление
                    }

                    // Создаём форму динамически
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/timelines/${timelineId}`; // или замени на нужный роут

                    // Добавляем CSRF токен
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Добавляем метод DELETE
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }

                document.getElementById('typeSelect').addEventListener('change', function() {
                    const selectedType = this.value;
                    const customTypeWrapper = document.getElementById('customTypeWrapper');
                    const dateToWrapper = document.getElementById('dateToWrapper');

                    // Управление полем для своего типа
                    if (selectedType === 'other_properties') {
                        customTypeWrapper.style.display = 'block';
                    } else {
                        customTypeWrapper.style.display = 'none';
                    }

                    // Управление второй датой - показываем только для школы и работы
                    if (selectedType === 'school' || selectedType === 'work') {
                        dateToWrapper.style.display = 'block';
                    } else {
                        dateToWrapper.style.display = 'none';
                        // Очищаем значение второй даты, если скрываем
                        const dateToSelect = document.getElementById('eventYearTo');
                        if (dateToSelect) {
                            dateToSelect.value = '';
                        }
                    }
                });

                document.getElementById('typeSelect').addEventListener('change', function() {
                    const selectedType = this.value;
                    const customTypeWrapper = document.getElementById('customTypeWrapper');
                    const dateToWrapper = document.getElementById('dateToWrapper');
                    const yearFromWrapper = document.getElementById('yearFromWrapper');

                    // Управление полем для своего типа
                    if (selectedType === 'other_properties') {
                        customTypeWrapper.style.display = 'block';
                    } else {
                        customTypeWrapper.style.display = 'none';
                    }

                    // Управление второй датой и шириной первой
                    if (selectedType === 'school' || selectedType === 'work') {
                        dateToWrapper.style.display = 'block';
                        yearFromWrapper.className = 'col-6 mt-2'; // половина ширины
                    } else {
                        dateToWrapper.style.display = 'none';
                        yearFromWrapper.className = 'col-12 mt-2'; // вся ширина
                        // Очищаем значение второй даты
                        const dateToSelect = document.getElementById('eventYearTo');
                        if (dateToSelect) {
                            dateToSelect.value = '';
                        }
                    }
                });
            </script>
            {{-- <script>
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
                        schoolForm.style.display = selected === 'school' ? 'block' :
                        'none'; // Отображение формы школы

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
            </script> --}}


        @endsection
