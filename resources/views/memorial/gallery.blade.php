@extends('layouts.memorial')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/formstone/dist/css/upload.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>

        .item .img {
            border-radius: 15px;
            height: 175px;
            overflow: hidden;
        }

        .fit-img img {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
            -o-object-position: center center;
            object-position: center center;
        }

        img {
            width: 100%;
            height: auto;
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

                        <i class="fas fa-user"></i>
                    </div>
                    <div class="step-title">Step 1</div>
                    <div class="step-description">Személyes adatok</div>
                </div>

                <div class="step-horizontal complete">
                    <div class="step-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="step-title">Step 2</div>
                    <div class="step-description">Életesemények időpontjai</div>
                </div>
                <div class="step-horizontal active">
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

                {{-- <h1 class="display-5 fw-bold text-white mt-15">Fogadja őszinte részvétünket a veszteségért.</h1> --}}
                <div class="col-lg-8 mx-auto">
                    <p class="fs-5 mt-4 ">
                        Válaszd ki a megfelelő fület (Képek, Videók vagy Linkek), majd töltsd fel vagy illeszd be a kívánt
                        tartalmat. A feltöltött anyagok segítenek megőrizni az emlékeket és bemutatni az elhunyt életének
                        fontos pillanatait.
                    </p>
                </div>
            </div>
        </div>
    </div>






    <div class="container mt-30">
    <div class="col-9 mx-auto text-center">

        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Images</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos"
                    type="button" role="tab" aria-controls="pills-videos" aria-selected="false">Video</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-music-tab" data-bs-toggle="pill" data-bs-target="#pills-music"
                    type="button" role="tab" aria-controls="pills-music" aria-selected="false">Music</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-link-tab" data-bs-toggle="pill" data-bs-target="#pills-link"
                    type="button" role="tab" aria-controls="pills-link" aria-selected="false">Link</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!-- Images Tab -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                {{-- <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="imageFile" class="form-label">Fénykép feltöltése</label>
                        <input class="form-control" type="file" name="image" id="imageFile" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="imageDescription" class="form-label">Leírás (nem kötelező)</label>
                        <input class="form-control" type="text" name="description" id="imageDescription" placeholder="Pl. családi nyaralás 1998-ban">
                    </div>
                    <button type="submit" class="btn btn-primary">Feltöltés</button>
                </form> --}}



                


                <div class="mt-30">
                    <div class="row d-flex justify-content-center">
                        <form id="form" action="{{ route('memorial.images.upload', $memorial->id) }}" method="POST"
                            enctype="multipart/form-data" class="px-3 rounded">
                            @csrf
                            {{-- <label for="images" class="form-label ">Képek feltöltése</label> --}}
                            <div class="d-flex justify-content-center">
                                <div class="col-8 mt-20">
                                    <input type="file" name="images[]" multiple class="form-control" required>
                                    <small class="text-muted">
                                        {{ __('A maximum of 30 images can be uploaded to a memorial page. Photo format: JPEG, JPG, PNG') }}
                                    </small>
                                </div>
                            </div>
                            

    
                            {{-- <button type="submit" class="btn btn-secondary mt-3 w-100">Feltöltés</button> --}}
                            <section class="text-center">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-30 mb-20">
                                            <button type="submit" id="submitBtn" class="butn butn-md butn-bord butn-rounded">
                                                <span class="text">
                                                    {{ __('Feltöltés') }}
                                                </span>
                                                <span id="btnIcon" class="icon">
                                                    <i class="fa-regular fa-save"></i>
                                                </span>
                                                <span id="btnSpinner" class="icon d-none">
                                                    <i class="fa-solid fa-spinner fa-spin"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </section>
    
                        </form>
                    </div>
                </div>
                @if ($memorial->memorialimages->isNotEmpty())
                <form action="{{ route('memorial.images.update', $memorial->id) }}" method="POST">
                    @csrf
                    <section class="process-ca bg-light radius-20 ontop">
                        <div class="sec-head">
                            <div class="row">
                                <div class="col-lg-12 md-mb15 md-mt35 ms-3">
                                    <h6>{{ __('Photos') }} <small>{{ $photoCount = $memorial->memorialimages()->count() }} /
                                            30</small></h6>
        
                                </div>
                            </div>
                        </div>
        
        
        
                        <div class="">
        
                            <div class="container">
                                <div class="row d-flex justify-content-center">
        
                                    <div class="">
                                        <div class="row">
        
                                            @foreach ($memorial->memorialimages as $image)
                                                <input type="hidden" name="images[{{ $loop->index }}][id]"
                                                    value="{{ $image->id }}">
                                                <div class="col-lg-3 bord mt-20">
                                                    <div class="item">
        
                                                        <div class="img fit-img mt-10 position-relative">
                                                            <img src="{{ asset('memorial/' . $image->image_path) }}"
                                                                alt="">
        
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm delete-btn position-absolute"
                                                                style="top: 10px; right: 10px;"
                                                                data-url="{{ route('memorial.images.destroy', [$memorial, $image]) }}">
                                                                <span class="icon ">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </button>
                                                        </div>
        
                                                        <div class="cont mt-10">
                                                            <div class="">
                                                                <input id="death_date" type="date"
                                                                    class="form-control @error('death_date') is-invalid @enderror"
                                                                    name="images[{{ $loop->index }}][image_date]"
                                                                    value="{{ old('name', $image->image_date) }}">
                                                            </div>
        
                                                            <h6 class="mt-10">
                                                                <input name="images[{{ $loop->index }}][image_description]"
                                                                    type="text" value="{{ $image->image_description }}"
                                                                    class="form-control " placeholder="A fénykép leírása">
                                                            </h6>
        
        
        
        
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
        
                                        </div>
                                    </div>
        
        
                                </div>
                            </div>
        
                        </div>
        
        
                    </section>
        

        
                </form>
            @endif
                

            </div>
        
            <!-- Video Tab (YouTube link) -->
            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab" tabindex="0">
                <form action="{{ route('video.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                    
                    <div class="mb-3">
                        <label for="youtubeLink" class="form-label">YouTube videó linkje</label>
                        <input class="form-control" type="url" name="youtube_link" id="youtubeLink" placeholder="https://www.youtube.com/watch?v=..." required>
                    </div>
                    <div class="mb-3">
                        <label for="videoDescription" class="form-label">Leírás (nem kötelező)</label>
                        <input class="form-control" type="text" name="description" id="videoDescription" placeholder="Pl. születésnapi videó 2005-ből">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Hozzáadás</button>
                    </div>
                </form>

                @if($videos->isEmpty())
                <p>Nincsenek videók.</p>
                @else
                    <div class="row mt-50">
                        @foreach($videos as $video)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="ratio ratio-16x9">
                                        <iframe 
                                        src="{{ $video['url'] }}" 
                                        title="YouTube video player" 
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen>
                                    </iframe>

                                </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video['title'] }}</h5>
                                        @if($video['description'])
                                            <p class="card-text text-muted">{{ $video['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        
            <!-- Music Tab – You can customize later -->
            <div class="tab-pane fade" id="pills-music" role="tabpanel" aria-labelledby="pills-music-tab" tabindex="0">
                <form action="{{ route('music.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                    
                    <div class="mb-3">
                        <label for="youtubeLink" class="form-label">YouTube videó linkje</label>
                        <input class="form-control" type="url" name="youtube_link" id="youtubeLink" placeholder="https://www.youtube.com/watch?v=..." required>
                    </div>
                    <div class="mb-3">
                        <label for="videoDescription" class="form-label">Leírás (nem kötelező)</label>
                        <input class="form-control" type="text" name="description" id="videoDescription" placeholder="Pl. születésnapi videó 2005-ből">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Hozzáadás</button>
                    </div>
                </form>

                @if($music->isEmpty())
                <p>Nincsenek videók.</p>
                @else
                    <div class="row mt-50">
                        @foreach($music as $video)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="ratio ratio-16x9">
                                        <iframe 
                                        src="{{ $video['url'] }}" 
                                        title="YouTube video player" 
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen>
                                    </iframe>

                                </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video['title'] }}</h5>
                                        @if($video['description'])
                                            <p class="card-text text-muted">{{ $video['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        
            <!-- Link Tab (Other site links) -->
            <div class="tab-pane fade" id="pills-link" role="tabpanel" aria-labelledby="pills-link-tab" tabindex="0">

                    <form action="{{ route('link.store') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                        
                        <div class="mb-3">
                            <label for="youtubeLink" class="form-label">Weboldal linkje</label>
                            <input class="form-control" type="url" name="youtube_link" id="youtubeLink" placeholder="https://www ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="videoDescription" class="form-label">Leírás (nem kötelező)</label>
                            <input class="form-control" type="text" name="description" id="videoDescription" placeholder="Pl. életrajz másik oldalról">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Link hozzáadása</button>
                        </div>
                    </form>
                    @if($link->isEmpty())
                    <p>Nincsenek videók.</p>
                    @else
                        <div class="row mt-50">
                            @foreach($link as $video)
                                <div class="col-md-6 mb-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $video['description'] }}</h5>

                                            <a href="{{ $video['url'] }}">
                                                {{ Str::limit(parse_url($video['url'], PHP_URL_HOST), 20) }}
                                            </a>
                                            {{-- @if($video['description'])
                                                <p class="card-text text-muted">{{ $video['description'] }}</p>
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
            </div>
        </div>
        

        {{-- <nav>
            <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
              <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false" disabled>Disabled</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">...</div>
          </div> --}}




        <div class="d-flex justify-content-between mt-50 pb-50">
            <a href="{{ route('timeline.create', $memorial) }}" class="btn btn-secondary">{{ __('Back') }}</a>
            <a href="{{ route('place', $memorial) }}" class="btn btn-primary">
                <i class="fa fa-save"></i> {{ __('Next') }}
            </a>

        </div>
    </div>

    </div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const activeTab = "{{ session('tab') }}";
        if (activeTab) {
            const tabTrigger = document.querySelector(`[data-bs-target="#pills-${activeTab}"]`);
            if (tabTrigger) {
                const tab = new bootstrap.Tab(tabTrigger);
                tab.show();
            }
        }
    });
</script>

@endsection
