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
    </style>
@endsection

@section('title', 'Adat mentés - mbook.hu')

@section('content')

    <div class="container pt-100">
        <div class="stepper__row">
            <div class="stepper--horizontal">
                <div class="stepper--horizontal__circle ms-3">
                    <span class="stepper--horizontal__circle__text">
                        1
                    </span>
                </div>
                <div class="stepper--horizontal__details">
                    {{-- <h3 class="heading__three">
                        {{ __('Loved Ones') }}
                    </h3> --}}
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
                    {{-- <h3 class="heading__three">
                        {{ __('Life Events') }}
                    </h3> --}}
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
                        {{-- {{ __('Pictures and videos') }} --}}
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
                        {{-- {{ __('Pictures and videos') }} --}}
                    </h3>
                    <p class="paragraph d-none d-md-block">
                        {{ __('Nyughely adatok megadása') }}
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

    <div class="container">
        <div class="text-center">


            <div class="mt-80">
                {{-- <h3>Elhunyt adatai</h3> --}}
                <p class="mt-2">Kérjük, tüntesd fel a következő információkat: Teljes név, Születési dátum,
                    Elhalálozás dátum.</p>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 p-4 mt-30">

                <div class="container">

                    <form action="{{ route('family.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                        <div class="row mb-3">
                            <div class="form-group col-12 col-md-5 mt-1">
                                <label>{{ __('Relationship') }}</label>
                                <select name="role" class="form-select" required>
                                    <option value="">{{ __('Select relationship') }}</option>
                                    <option value="parents">{{ __('SZÜLŐK') }}</option>
                                    <option value="spouse">{{ __('HÁZASTÁRS') }}</option>
                                    <option value="children">{{ __('GYERMEKEK') }}</option>
                                    <option value="grandchildren">{{ __('UNOKÁK') }}</option>
                                    <option value="grandparents">{{ __('NAGYSZÜLŐK') }}</option>
                                    <option value="siblings">{{ __('TESTVÉREK') }}</option>
                                    <option value="cousins">{{ __('UNOKATESTVÉREK') }}</option>
                                    <option value="pets">{{ __('HÁZIÁLLAT') }}</option>
                                    <option value="other">{{ __('Other') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-5 mt-1">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            {{-- <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mt-4 w-100">{{ __('Add') }}</button>
                            </div> --}}

                            <div class="form-group col-12 col-md-2 mt-30">
                                <button type="submit" class="btn btn-outline-primary mb-4 w-100">
                                    <i class="fa fa-plus"></i> {{ __('Add') }}</button>
                            </div>
                        </div>
                    </form>

                    <!-- Вывод списка родственников -->
                    <div class="row mt-80">
                        <!-- Row 1: SZÜLŐK & HÁZASTÁRS(OK) -->
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('SZÜLŐK') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['parents'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['parents']->isEmpty())
                                    <li class="list-group-item text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('HÁZASTÁRS') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['spouse'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['spouse']->isEmpty())
                                    <li class="mt-2 ms-1 text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                
                    <!-- Row 2: GYERMEKEK & UNOKÁK -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('GYERMEKEK') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['child'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['child']->isEmpty())
                                    <li class="mt-2 ms-1 text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('UNOKÁK') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['grandchildren'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['grandchildren']->isEmpty())
                                    <li class="mt-2 ms-1 text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                
                    <!-- Row 3: NAGYSZÜLŐK & TESTVÉREK -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('NAGYSZÜLŐK') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['grandparents'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['grandparents']->isEmpty())
                                    <li class="mt-2 ms-1 text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('TESTVÉREK') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['siblings'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['siblings']->isEmpty())
                                    <li class="mt-2 ms-1 text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                
                    <!-- Row 4: UNOKATESTVÉREK & HÁZIÁLLAT(OK) -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('UNOKATESTVÉREK') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['cousins'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['cousins']->isEmpty())
                                    <li class="mt-2 ms-1 text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">{{ __('HÁZIÁLLAT') }}</h6>
                            <ul class="list-group">
                                @foreach($familyMembers['pets'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                
                                {{-- @if ($familyMembers['pets']->isEmpty())
                                    <li class="list-group-item text-muted">{{ __('No family members added') }}</li>
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button href="#" class="btn btn-secondary">{{ __('Skip') }}</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                            {{ __('Next') }}</button>
                    </div>

                </div>
                {{-- <div class="container mt-50">
                    <!-- Row 1: SZÜLŐK & HÁZASTÁRS(OK) -->
                    <div class="row mb-4 ">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2  text-center fs-6">SZÜLŐK</h6>

                            <div class="bg-light p-2 mb-1 d-flex justify-content-between">
                                <div>Magdolna <small class="text-muted">SZÜLŐ</small></div>
                                <button class="btn btn-sm btn-outline-dark">×</button>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">HÁZASTÁRS</h6>
                            <!-- Пустой список -->
                        </div>
                    </div>

                    <!-- Row 2: GYERMEKEK & UNOKÁK -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">GYERMEKEK</h6>


                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">UNOKÁK</h6>
                            <!-- Пустой список -->
                        </div>
                    </div>

                    <!-- Row 3: NAGYSZÜLŐK & TESTVÉREK -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">NAGYSZÜLŐK</h6>
                            <!-- Пустой список -->
                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">TESTVÉREK</h6>
                            <!-- Пустой список -->
                        </div>
                    </div>



                    <!-- Row 5: UNOKATESTVÉREK & HÁZIÁLLAT(OK) -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">UNOKATESTVÉREK
                            </h6>
                            <!-- Пустой список -->
                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom border-secondary pb-2 text-center fs-6">HÁZIÁLLAT</h6>
                            <!-- Пустой список -->
                        </div>
                    </div>
                </div> --}}



            @endsection

            @section('js')



            @endsection
