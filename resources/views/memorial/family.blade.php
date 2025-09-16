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

        .custom-input {
            border: none;
            /* Убираем все бордеры */
            border-bottom: 1px solid black;
            /* Добавляем бордер только снизу */
            background-color: transparent;
            /* Прозрачный фон */
            outline: none;
            /* Убираем обводку при фокусе (опционально) */
            padding: 5px;
            /* Для удобства ввода */
        }

        .item .img {
            border-radius: 15px;
            height: 255px;
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


        .search-container {
            position: relative;
        }

        .search-input {

            padding-left: 44px;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            font-size: 16px;

        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
        }

        /* --------------- Awards --------------- */
        .intro-vid .bg-img {
            height: 580px;
            border-radius: 30px;
            margin-top: -140px;
            position: relative;
        }

        .intro-vid .bg-img .states {
            position: absolute;
            top: -120px;
            left: 30px;
            background: var(--theme-color);
            padding: 60px 40px;
            border-radius: 30%;
            max-width: 300px;
            z-index: 3;
        }

        .intro-vid .bg-img .states .imgs {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .intro-vid .bg-img .states .imgs .img {
            width: 47px;
            height: 47px;
            border-radius: 50%;
            border: 2px solid var(--bg-color);
        }

        .intro-vid .bg-img .states .imgs .icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--main-color);
            text-align: center;
            line-height: 40px;
            margin-left: -10px;
            z-index: -1;
            -webkit-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }

        .intro-vid .bg-img .states .imgs .icon img {
            width: 15px;
            -webkit-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }

        .intro-vid .bg-img .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }

        .intro-vid .bg-img .play-button a {
            width: 120px;
            height: 120px;
            line-height: 120px;
            font-size: 40px;
            text-align: center;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.7);
            background: rgba(255, 255, 255, 0.1);
        }






        /* .tree {
                                min-width: 1200px;
                            } */

        .tree-container {
            overflow-x: auto;
            width: 100%;

        }

        .tree ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .tree li {
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 30px 0 30px;
            transition: all 0.5s;
        }

        /* Connectors */
        .tree li::before,
        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 196px;
            z-index: -1;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        /* Remove connectors for elements without siblings */
        .tree li:only-child::after,
        .tree li:only-child::before {
            display: none;
        }

        /* Remove space from the top of single children */
        .tree li:only-child {
            padding-top: 0;
        }

        /* Remove left connector from first child and right connector from last child */
        .tree li:first-child::before,
        .tree li:last-child::after {
            border: 0 none;
        }

        /* Add back the vertical connector to the last nodes */
        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            transform: translateX(1px);
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        /* Downward connectors from parents */
        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
            z-index: -1;
        }

        /* Style for <a> elements */
        .tree li a {
            border: 1px solid #a9a9a9;
            padding: 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 14px;
            display: inline-block;
            background: white;
            border-radius: 5px;
            transition: all 0.5s;
            width: 130px;
            text-align: center;
            height: 185px;
        }

        /* Adjust image size and alignment */
        .tree li a img {
            display: block;
            margin: 0 auto 5px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0rem 0.4rem 0.6rem 0rem rgba(32, 46, 66, 0.08);
        }

        /* Parent pair styling */
        .parent-pair {
            display: flex;
            justify-content: center;
            position: relative;
            padding-top: 0 !important;
            margin-bottom: 20px;
        }

        .parent-pair li {
            padding: 0 10px;
        }

        /* Connector between parents */
        .parent-pair li:first-child a::after {
            content: '';
            position: absolute;
            border-top: 1px solid #ccc;
            top: 50%;
            left: 100%;
            width: 20px;
            z-index: -1;
        }

        /* Connector from parents to children */
        .parent-pair::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
            z-index: -1;
        }

        .tree li.down::after {
            content: '';
            position: absolute;
            bottom: -20px;
            top: auto;
            border-top: none;
            border-bottom: 1px solid #ccc;
            width: 50%;
            height: 20px;
            z-index: -1;
        }

        .tree li.up::before {
            content: '';
            position: absolute;
            bottom: -20px;
            top: auto;
            border-top: none;
            border-bottom: 1px solid #ccc;
            width: 50%;
            height: 20px;
            z-index: -1;
        }

        .tree li.down::before {
            right: 50%;
        }

        .tree li.up::before {
            border-right: 1px solid #ccc;
            border-radius: 0 0 5px 0;
            transform: translateX(1px);
        }

        .tree li.down::after {
            left: 50%;
            right: auto;
            border-left: 1px solid #ccc;
            border-radius: 0 0 0 5px;

        }

        .tree li a+a {
            margin-left: 20px;
            position: relative;
        }

        .tree li a+a::before {
            content: '';
            position: absolute;
            border-top: 1px solid #ccc;
            top: 50%;
            left: -25px;
            width: 25px;
        }



        li.up::after {
            content: none !important;
            /* Отменяет содержимое псевдоэлемента */
            display: none !important;
            /* Скрывает псевдоэлемент */
        }

        li.down::before {
            content: none !important;
            /* Отменяет содержимое псевдоэлемента */
            display: none !important;
            /* Скрывает псевдоэлемент */
        }


        .tree ul.down {
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 0px 10px 0 42px;
            transition: all 0.5s;
        }

        .tree ul ul.apa::before {
            content: '';
            position: absolute;
            top: 0px;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
            z-index: -1;
        }

        ul {
            margin-top: 0;
            margin-bottom: 0 !important;
        }

        .img-fluid {
            height: 90px;
            width: 90px;
            object-fit: cover;
        }

        .icon-hover {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        label:hover .icon-hover {
            opacity: 1;
        }

        .image-wrapper {
            position: relative;
            display: inline-block;
        }

        .image-wrapper .camera-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 5px;
            display: none;
            cursor: pointer;
        }

        .image-wrapper:hover .camera-icon {
            display: block;
        }

        /* Предотвращаем автоматический скролл при загрузке */
        html {
            scroll-behavior: auto !important;
        }

        /* Скрываем страницу до восстановления позиции */
        .scroll-loading {
            opacity: 0;
            transition: opacity 0.1s;
        }

        .scroll-ready {
            opacity: 1;
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
                <div class="step-horizontal active">
                    <div class="step-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-title">{{ __('Step 1') }}</div>
                    <div class="step-description">{{ __('Family Tree') }}</div>
                </div>

                <div class="step-horizontal">
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

                {{-- <h1 class="display-5 fw-bold text-white mt-15">Fogadja őszinte részvétünket a veszteségért.</h1> --}}
                <div class="col-lg-8 mx-auto">
                    <p class="fs-5 mt-4 ">
                        {{ __('A diagram depicting the kinship relationships of a family, showing a person\'s ancestors and descendants, such as parents, children, and grandparents.') }}

                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 p-4 mt-30">

                <!-- Форма для добавления партнера -->
                {{-- <form action="{{ route('dashboard.family.store') }}" id="add-partner-form" method="POST">
                    @csrf
                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                    <input type="hidden" name="role" value="partner">
                </form> --}}

                <!-- Форма для добавления детей -->
                {{-- <form action="{{ route('dashboard.family.store') }}" id="add-children-form" method="POST">
                    @csrf
                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                    <input type="hidden" name="role" value="children">
                </form> --}}

                <!-- Форма для добавления братьев/сестер -->
                {{-- <form action="{{ route('dashboard.family.store') }}" id="add-siblings-form" method="POST">
                    @csrf
                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                    <input type="hidden" name="role" value="siblings">
                </form> --}}


                <form id="family-form" action="{{ route('family.treeupdate', $memorial->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="scroll_position" value="0">

                    <div class="">

                        <!-- Family tree -->
                        <section id="family-tree" class="position-relative padding_top">


                            <input type="hidden" name="action" id="action-input" value="">

                            @php
                                // Берём только нужные группы из коллекции
                                $selectedGroups = collect([
                                    'partner' => $familyMembers['partner'] ?? collect(),
                                    'siblings' => $familyMembers['siblings'] ?? collect(),
                                    'children' => $familyMembers['children'] ?? collect(),
                                ]);

                                // Считаем общее количество элементов из выбранных групп
                                $count = $selectedGroups->reduce(function ($carry, $group) {
                                    return $carry + $group->count();
                                }, 0);

                                // Формула ширины: базовая 1000 + 180 за каждого сверх 2
                                $width = 1000 + max(0, $count - 2) * 130;
                            @endphp

                            {{-- @dump($count, $width) --}}

                            <div class="tree-container padding_bottom" id="tree-container">
                                <div class="tree wow" style="min-width: {{ $width }}px">
                                    <ul class="down">
                                        {{-- Дедушка по отцовской линии --}}
                                        <li class="down">
                                            <a
                                                class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                                {{-- Кнопка удалить в углу --}}
                                                @if ($grandfatherFather)
                                                    <button type="button" title="{{ __('Delete') }}"
                                                        class="btn btn-sm position-absolute"
                                                        style="transform: translate(180%, -30%); background: transparent; border: none;"
                                                        onclick="handleDelete(event, 'delete-form-{{ $grandfatherFather->id }}')">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </button>
                                                @endif
                                                <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                    onclick="document.getElementById('image_{{ $grandfatherFather->id ?? 'grandfather_father' }}').click()"
                                                    title="Загрузить фото">
                                                    <img id="preview_{{ $grandfatherFather->id ?? 'grandfather_father' }}"
                                                        src="{{ isset($grandfatherFather) && $grandfatherFather->photo ? asset('memorial/' . $grandfatherFather->photo) : asset('avatar/avatar-father.png') }}"
                                                        class="img-fluid rounded-circle" width="90" height="90"
                                                        alt="Фото">
                                                    <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                </div>
                                                <input type="file"
                                                    name="images[{{ $grandfatherFather->id ?? 'grandfather_father' }}]"
                                                    id="image_{{ $grandfatherFather->id ?? 'grandfather_father' }}"
                                                    class="d-none" accept="image/*"
                                                    onchange="previewImage(this, 'preview_{{ $grandfatherFather->id ?? 'grandfather_father' }}')">
                                                <input type="text" class="form-control form-control-sm mt-1"
                                                    name="{{ $grandfatherFather && $grandfatherFather->id ? 'family_members[' . $grandfatherFather->id . '][name]' : 'names[grandfather_father]' }}"
                                                    value="{{ $grandfatherFather->name ?? '' }}"
                                                    placeholder="{{ __('Grandfather') }}">
                                                {{-- Поле QR Code --}}
                                                <input class="form-control form-control-sm mt-1" type="text"
                                                    name="{{ $grandfatherFather && $grandfatherFather->id ? 'family_members[' . $grandfatherFather->id . '][qr_code]' : 'qr_codes[grandfather_father]' }}"
                                                    value="{{ $grandfatherFather->qr_code ?? '' }}"
                                                    placeholder="{{ __('QR Code') }}">
                                                @if ($grandfatherFather && $grandfatherFather->id)
                                                    <input type="hidden"
                                                        name="family_members[{{ $grandfatherFather->id }}][id]"
                                                        value="{{ $grandfatherFather->id }}">
                                                @endif
                                            </a>
                                        </li>

                                        {{-- Бабушка по отцовской линии --}}
                                        <li class="up">
                                            <a
                                                class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                                {{-- Кнопка удалить в углу --}}
                                                @if ($grandmotherFather)
                                                    <button type="button" title="{{ __('Delete') }}"
                                                        class="btn btn-sm position-absolute"
                                                        style="transform: translate(180%, -30%); background: transparent; border: none;"
                                                        onclick="handleDelete(event, 'delete-form-{{ $grandmotherFather->id }}')">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </button>
                                                @endif
                                                <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                    onclick="document.getElementById('image_{{ $grandmotherFather->id ?? 'grandmother_father' }}').click()"
                                                    title="Загрузить фото">
                                                    <img id="preview_{{ $grandmotherFather->id ?? 'grandmother_father' }}"
                                                        src="{{ isset($grandmotherFather) && $grandmotherFather->photo ? asset('memorial/' . $grandmotherFather->photo) : asset('avatar/avatar-woman.png') }}"
                                                        class="img-fluid rounded-circle" width="90" height="90"
                                                        alt="Фото">
                                                    <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                </div>
                                                <input type="file"
                                                    name="images[{{ $grandmotherFather->id ?? 'grandmother_father' }}]"
                                                    id="image_{{ $grandmotherFather->id ?? 'grandmother_father' }}"
                                                    class="d-none" accept="image/*"
                                                    onchange="previewImage(this, 'preview_{{ $grandmotherFather->id ?? 'grandmother_father' }}')">
                                                <input type="text" class="form-control form-control-sm mt-1"
                                                    name="{{ $grandmotherFather && $grandmotherFather->id ? 'family_members[' . $grandmotherFather->id . '][name]' : 'names[grandmother_father]' }}"
                                                    value="{{ $grandmotherFather->name ?? '' }}"
                                                    placeholder="{{ __('Grandmother') }}">
                                                {{-- Поле QR Code --}}
                                                <input class="form-control form-control-sm mt-1" type="text"
                                                    name="{{ $grandmotherFather && $grandmotherFather->id ? 'family_members[' . $grandmotherFather->id . '][qr_code]' : 'qr_codes[grandmother_father]' }}"
                                                    value="{{ $grandmotherFather->qr_code ?? '' }}"
                                                    placeholder="{{ __('QR Code') }}">
                                                @if ($grandmotherFather && $grandmotherFather->id)
                                                    <input type="hidden"
                                                        name="family_members[{{ $grandmotherFather->id }}][id]"
                                                        value="{{ $grandmotherFather->id }}">
                                                @endif
                                            </a>
                                        </li>

                                        {{-- Дедушка по материнской линии --}}
                                        <li class="down">
                                            <a
                                                class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                                {{-- Кнопка удалить в углу --}}
                                                @if ($grandfatherMother)
                                                    <button type="button" title="{{ __('Delete') }}"
                                                        class="btn btn-sm position-absolute"
                                                        style="transform: translate(180%, -30%); background: transparent; border: none;"
                                                        onclick="handleDelete(event, 'delete-form-{{ $grandfatherMother->id }}')">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </button>
                                                @endif
                                                <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                    onclick="document.getElementById('image_{{ $grandfatherMother->id ?? 'grandfather_mother' }}').click()"
                                                    title="Загрузить фото">
                                                    <img id="preview_{{ $grandfatherMother->id ?? 'grandfather_mother' }}"
                                                        src="{{ isset($grandfatherMother) && $grandfatherMother->photo ? asset('memorial/' . $grandfatherMother->photo) : asset('avatar/avatar-father.png') }}"
                                                        class="img-fluid rounded-circle" width="90" height="90"
                                                        alt="Фото">
                                                    <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                </div>
                                                <input type="file"
                                                    name="images[{{ $grandfatherMother->id ?? 'grandfather_mother' }}]"
                                                    id="image_{{ $grandfatherMother->id ?? 'grandfather_mother' }}"
                                                    class="d-none" accept="image/*"
                                                    onchange="previewImage(this, 'preview_{{ $grandfatherMother->id ?? 'grandfather_mother' }}')">
                                                <input type="text" class="form-control form-control-sm mt-1"
                                                    name="{{ $grandfatherMother && $grandfatherMother->id ? 'family_members[' . $grandfatherMother->id . '][name]' : 'names[grandfather_mother]' }}"
                                                    value="{{ $grandfatherMother->name ?? '' }}"
                                                    placeholder="{{ __('Grandfather') }}">
                                                {{-- Поле QR Code --}}
                                                <input class="form-control form-control-sm mt-1" type="text"
                                                    name="{{ $grandfatherMother && $grandfatherMother->id ? 'family_members[' . $grandfatherMother->id . '][qr_code]' : 'qr_codes[grandfather_mother]' }}"
                                                    value="{{ $grandfatherMother->qr_code ?? '' }}"
                                                    placeholder="{{ __('QR Code') }}">
                                                @if ($grandfatherMother && $grandfatherMother->id)
                                                    <input type="hidden"
                                                        name="family_members[{{ $grandfatherMother->id }}][id]"
                                                        value="{{ $grandfatherMother->id }}">
                                                @endif
                                            </a>
                                        </li>

                                        {{-- Бабушка по материнской линии --}}
                                        <li class="up">
                                            <a
                                                class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                                {{-- Кнопка удалить в углу --}}
                                                @if ($grandmotherMother)
                                                    <button type="button" title="{{ __('Delete') }}"
                                                        class="btn btn-sm position-absolute"
                                                        style="transform: translate(180%, -30%); background: transparent; border: none;"
                                                        onclick="handleDelete(event, 'delete-form-{{ $grandmotherMother->id }}')">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </button>
                                                @endif
                                                <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                    onclick="document.getElementById('image_{{ $grandmotherMother->id ?? 'grandmother_mother' }}').click()"
                                                    title="Загрузить фото">
                                                    <img id="preview_{{ $grandmotherMother->id ?? 'grandmother_mother' }}"
                                                        src="{{ isset($grandmotherMother) && $grandmotherMother->photo ? asset('memorial/' . $grandmotherMother->photo) : asset('avatar/avatar-woman.png') }}"
                                                        class="img-fluid rounded-circle" width="90" height="90"
                                                        alt="Фото">
                                                    <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                </div>
                                                <input type="file"
                                                    name="images[{{ $grandmotherMother->id ?? 'grandmother_mother' }}]"
                                                    id="image_{{ $grandmotherMother->id ?? 'grandmother_mother' }}"
                                                    class="d-none" accept="image/*"
                                                    onchange="previewImage(this, 'preview_{{ $grandmotherMother->id ?? 'grandmother_mother' }}')">
                                                <input type="text" class="form-control form-control-sm mt-1"
                                                    name="{{ $grandmotherMother && $grandmotherMother->id ? 'family_members[' . $grandmotherMother->id . '][name]' : 'names[grandmother_mother]' }}"
                                                    value="{{ $grandmotherMother->name ?? '' }}"
                                                    placeholder="{{ __('Grandmother') }}">
                                                {{-- Поле QR Code --}}
                                                <input class="form-control form-control-sm mt-1" type="text"
                                                    name="{{ $grandmotherMother && $grandmotherMother->id ? 'family_members[' . $grandmotherMother->id . '][qr_code]' : 'qr_codes[grandmother_mother]' }}"
                                                    value="{{ $grandmotherMother->qr_code ?? '' }}"
                                                    placeholder="{{ __('QR Code') }}">
                                                @if ($grandmotherMother && $grandmotherMother->id)
                                                    <input type="hidden"
                                                        name="family_members[{{ $grandmotherMother->id }}][id]"
                                                        value="{{ $grandmotherMother->id }}">
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="down">
                                        <!-- Father -->
                                        <li class="down">
                                            <ul class="apa">
                                                <a
                                                    class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                                    {{-- Кнопка удалить в углу --}}
                                                    @if ($father)
                                                        <button type="button" title="{{ __('Delete') }}"
                                                            class="btn btn-sm position-absolute"
                                                            style="transform: translate(180%, -30%); background: transparent; border: none;"
                                                            onclick="event.stopPropagation(); document.getElementById('delete-form-{{ $father->id }}').submit();">
                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                        </button>
                                                    @endif
                                                    <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                        onclick="document.getElementById('image_{{ $father->id ?? 'father' }}').click()"
                                                        title="Загрузить фото">
                                                        <img id="preview_{{ $father->id ?? 'father' }}"
                                                            src="{{ isset($father) && $father->photo ? asset('memorial/' . $father->photo) : asset('avatar/avatar-man.png') }}"
                                                            class="img-fluid rounded-circle" width="90"
                                                            height="90" alt="Фото">
                                                        <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                    </div>
                                                    <input type="file" name="images[{{ $father->id ?? 'father' }}]"
                                                        id="image_{{ $father->id ?? 'father' }}" class="d-none"
                                                        accept="image/*"
                                                        onchange="previewImage(this, 'preview_{{ $father->id ?? 'father' }}')">
                                                    <input type="text" class="form-control form-control-sm mt-1"
                                                        name="{{ $father && $father->id ? 'family_members[' . $father->id . '][name]' : 'names[father]' }}"
                                                        value="{{ optional($father)->name }}"
                                                        placeholder="{{ __('Father') }}">
                                                    {{-- Поле QR Code --}}
                                                    <input class="form-control form-control-sm mt-1" type="text"
                                                        name="{{ $father && $father->id ? 'family_members[' . $father->id . '][qr_code]' : 'qr_codes[father]' }}"
                                                        value="{{ $father->qr_code ?? '' }}"
                                                        placeholder="{{ __('QR Code') }}">
                                                    @if ($father && $father->id)
                                                        <input type="hidden"
                                                            name="family_members[{{ $father->id }}][id]"
                                                            value="{{ $father->id }}">
                                                    @endif
                                                </a>
                                            </ul>
                                        </li>

                                        <!-- Mother -->
                                        <li class="up mom">
                                            <ul class="apa">
                                                <a
                                                    class="d-flex flex-column align-items-center text-decoration-none position-relative">

                                                    {{-- Кнопка удалить в углу --}}
                                                    @if ($mother)
                                                        <button type="button" title="{{ __('Delete') }}"
                                                            class="btn btn-sm position-absolute"
                                                            style="transform: translate(180%, -30%); background: transparent; border: none;"
                                                            onclick="event.stopPropagation(); document.getElementById('delete-form-{{ $mother->id }}').submit();">
                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                        </button>
                                                    @endif

                                                    <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                        onclick="document.getElementById('image_{{ $mother->id ?? 'mother' }}').click()"
                                                        title="Загрузить фото">
                                                        <img id="preview_{{ $mother->id ?? 'mother' }}"
                                                            src="{{ isset($mother) && $mother->photo ? asset('memorial/' . $mother->photo) : asset('avatar/avatar-woman-3.png') }}"
                                                            class="img-fluid rounded-circle" width="90"
                                                            height="90" alt="Фото">
                                                        <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                    </div>
                                                    <input type="file" name="images[{{ $mother->id ?? 'mother' }}]"
                                                        id="image_{{ $mother->id ?? 'mother' }}" class="d-none"
                                                        accept="image/*"
                                                        onchange="previewImage(this, 'preview_{{ $mother->id ?? 'mother' }}')">
                                                    <input type="text" class="form-control form-control-sm mt-1"
                                                        name="{{ $mother && $mother->id ? 'family_members[' . $mother->id . '][name]' : 'names[mother]' }}"
                                                        value="{{ optional($mother)->name }}"
                                                        placeholder="{{ __('Mother') }}">
                                                    {{-- Поле QR Code --}}
                                                    <input class="form-control form-control-sm mt-1" type="text"
                                                        name="{{ $mother && $mother->id ? 'family_members[' . $mother->id . '][qr_code]' : 'qr_codes[mother]' }}"
                                                        value="{{ $mother->qr_code ?? '' }}"
                                                        placeholder="{{ __('QR Code') }}">
                                                    @if ($mother && $mother->id)
                                                        <input type="hidden"
                                                            name="family_members[{{ $mother->id }}][id]"
                                                            value="{{ $mother->id }}">
                                                    @endif
                                                </a>
                                            </ul>
                                        </li>
                                    </ul>


                                    <ul>
                                        <ul>
                                            <li>
                                                {{-- <a href="#" onclick="event.preventDefault(); document.getElementById('add-partner-form').submit();" style="height: 170px;">
                                        <i class="fa-solid fa-plus rounded-circle fs-5 mt-3 mb-3"></i><br>
                                        add partner
                                    </a> --}}

                                                <!-- Partner -->
                                                @foreach ($familyMembers['partner'] ?? [] as $index => $member)
                                                    <a>
                                                        {{-- Кнопка удалить в углу --}}
                                                        <button type="button" title="{{ __('Delete') }}"
                                                            class="btn btn-sm btn-danger position-absolute"
                                                            style="transform: translate(290%, -30%); background: transparent; border: none; "
                                                            onclick="handleDelete(event, 'delete-form-{{ $member->id }}')">
                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                        </button>
                                                        <div class="image-wrapper" style="cursor: pointer;"
                                                            onclick="document.getElementById('image_{{ $member->id }}').click()"
                                                            title="Загрузить фото">
                                                            <img id="preview_{{ $member->id }}"
                                                                src="{{ isset($member) && $member->photo ? asset('memorial/' . $member->photo) : asset('avatar/avatar-girl.png') }}"
                                                                class="img-fluid rounded-circle" width="90"
                                                                height="90">
                                                            <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                        </div>
                                                        <input type="file" name="images[{{ $member->id }}]"
                                                            id="image_{{ $member->id }}" class="d-none"
                                                            accept="image/*"
                                                            onchange="previewImage(this, 'preview_{{ $member->id }}')">

                                                        {{-- Скрытый id --}}
                                                        <input type="hidden" name="partners[{{ $index }}][id]"
                                                            value="{{ $member->id }}">
                                                        {{-- Поле имени --}}
                                                        <input class="form-control form-control-sm mt-0" type="text"
                                                            name="partners[{{ $index }}][name]"
                                                            value="{{ $member->name }}"
                                                            placeholder="{{ __('Partner') }}">
                                                        {{-- Поле QR Code --}}
                                                        <input class="form-control form-control-sm mt-1" type="text"
                                                            name="partners[{{ $index }}][qr_code]"
                                                            value="{{ old("partners.$index.qr_code", $member->qr_code) }}"
                                                            placeholder="{{ __('QR Code') }}">
                                                    </a>
                                                @endforeach



                                                <!-- Main Person -->
                                                <a>
                                                    <div class="image-wrapper" style="cursor: pointer;"
                                                        onclick="document.getElementById('image_main_person').click()"
                                                        title="Загрузить фото">
                                                        <img id="preview_main_person"
                                                            src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                                                            class="img-fluid rounded-circle" width="90"
                                                            height="90">
                                                    </div>
                                                    <input type="file" name="images[main_person]"
                                                        id="image_main_person" class="d-none" accept="image/*"
                                                        onchange="previewImage(this, 'preview_main_person')">
                                                    <input class="form-control form-control-sm mt-0" type="text"
                                                        name="names[main_person]" value="{{ $memorial->name }}"
                                                        placeholder="{{ $memorial->name }}" readonly>
                                                    <input class="form-control form-control-sm mt-1" type="text"
                                                        name="main" value="{{ $memorial->qr_code }}"
                                                        placeholder="{{ __('QR Code') }}" readonly>
                                                </a>


                                                <a href="#"
                                                    onclick="event.preventDefault(); setActionAndSubmit('add_partner');"
                                                    class="image-wrapper">
                                                    <div class="my-2 mx-2" style="cursor: pointer; min-height: 125px;">
                                                        <img src="{{ asset('avatar/avatar-add-2.png') }}"
                                                            class=" rounded-circle" width="90" height="90">

                                                    </div>
                                                    {{ __('Add Partner') }}
                                                </a>

                                                {{-- <button type="submit" name="action" value="add_partner">Добавить партнера</button> --}}


                                                <ul>
                                                    <!-- Children -->
                                                    {{-- @foreach ($familyMembers['children'] ?? [] as $index => $child)
                                            <li class="mb-3">
                                                <a class="d-flex flex-column align-items-center text-decoration-none">
                                                    <div class="image-wrapper" style="cursor: pointer;"
                                                        onclick="document.getElementById('image_child_{{ $index }}').click()"
                                                        title="Загрузить фото">
                                                        <img id="preview_child_{{ $index }}"
                                                            src="{{ $child->image_url ?? asset('avatar/avatar-boy.png') }}"
                                                            class="img-fluid rounded-circle" width="90"
                                                            height="90">
                                                        <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                    </div>
                                                    <input type="file" name="images[child_{{ $index }}]"
                                                        id="image_child_{{ $index }}" class="d-none"
                                                        accept="image/*"
                                                        onchange="previewImage(this, 'preview_child_{{ $index }}')">

                                                    <input class="form-control mt-2 text-center" type="text"
                                                        name="names[{{ $child->id }}]" value="{{ $child->name }}"
                                                        placeholder="Gyermek" required>
                                                </a>
                                            </li>
                                        @endforeach --}}

                                                    @foreach ($familyMembers['children'] ?? [] as $index => $member)
                                                        <li class="mb-3">
                                                            <a
                                                                class="d-flex flex-column align-items-center text-decoration-none">
                                                                {{-- Кнопка удалить в углу --}}
                                                                <button type="button" title="{{ __('Delete') }}"
                                                                    class="btn btn-sm btn-danger position-absolute"
                                                                    style="transform: translate(180%, -30%); background: transparent; border: none; "
                                                                    onclick="handleDelete(event, 'delete-form-{{ $member->id }}')">
                                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                                </button>
                                                                {{-- Картинка и загрузка фото --}}
                                                                <div class="image-wrapper" style="cursor: pointer;"
                                                                    onclick="document.getElementById('image_{{ $member->id }}').click()"
                                                                    title="Загрузить фото">
                                                                    <img id="preview_{{ $member->id }}"
                                                                        src="{{ isset($member) && $member->photo ? asset('memorial/' . $member->photo) : asset('avatar/avatar-girl.png') }}"
                                                                        class="img-fluid rounded-circle" width="90"
                                                                        height="90">
                                                                    <i
                                                                        class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                                </div>
                                                                <input type="file" name="images[{{ $member->id }}]"
                                                                    id="image_{{ $member->id }}" class="d-none"
                                                                    accept="image/*"
                                                                    onchange="previewImage(this, 'preview_{{ $member->id }}')">

                                                                {{-- Скрытый id --}}
                                                                <input type="hidden"
                                                                    name="childrens[{{ $index }}][id]"
                                                                    value="{{ $member->id }}">
                                                                {{-- Поле имени --}}
                                                                <input class="form-control form-control-sm mt-1"
                                                                    type="text"
                                                                    name="childrens[{{ $index }}][name]"
                                                                    value="{{ $member->name }}"
                                                                    placeholder="{{ __('Children') }}">
                                                                <input class="form-control form-control-sm mt-1"
                                                                    type="text"
                                                                    name="childrens[{{ $index }}][qr_code]"
                                                                    value="{{ $member->qr_code }}"
                                                                    placeholder="{{ __('QR Code') }}">
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                    <li class="mb-3">
                                                        <a href="#"
                                                            onclick="event.preventDefault(); setActionAndSubmit('add_children');"
                                                            style="">
                                                            <div class="my-2 mx-2" style="cursor: pointer;">
                                                                <img src="{{ asset('avatar/avatar-add-2.png') }}"
                                                                    class=" rounded-circle" width="90"
                                                                    height="90">
                                                            </div>
                                                            {{ __('Add Children') }}
                                                        </a>

                                                        {{-- <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('add-children-form').submit();"
                                                    style="height: 175px;">
                                                    <br><br><i
                                                        class="fa-solid fa-plus rounded-circle fs-5 mt-3 mb-3"></i><br>
                                                    {{ __('Add Children') }}
                                                </a> --}}
                                                    </li>
                                                </ul>
                                            </li>

                                            <!-- Siblings -->

                                            @foreach ($familyMembers['siblings'] ?? [] as $index => $member)
                                                <li class="mb-3">
                                                    <a class="d-flex flex-column align-items-center text-decoration-none">
                                                        {{-- Кнопка удалить в углу --}}
                                                        <button type="button" title="{{ __('Delete') }}"
                                                            class="btn btn-sm btn-danger position-absolute"
                                                            style="transform: translate(180%, -30%); background: transparent; border: none; "
                                                            onclick="handleDelete(event, 'delete-form-{{ $member->id }}')">
                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                        </button>
                                                        <div class="image-wrapper" style="cursor: pointer;"
                                                            onclick="document.getElementById('image_{{ $member->id }}').click()"
                                                            title="Загрузить фото">
                                                            <img id="preview_{{ $member->id }}"
                                                                src="{{ isset($member) && $member->photo ? asset('memorial/' . $member->photo) : asset('avatar/avatar-girl.png') }}"
                                                                class="img-fluid rounded-circle" width="90"
                                                                height="90">
                                                            <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                        </div>
                                                        <input type="file" name="images[{{ $member->id }}]"
                                                            id="image_{{ $member->id }}" class="d-none"
                                                            accept="image/*"
                                                            onchange="previewImage(this, 'preview_{{ $member->id }}')">

                                                        {{-- Скрытый id --}}
                                                        <input type="hidden" name="siblings[{{ $index }}][id]"
                                                            value="{{ $member->id }}">
                                                        {{-- Поле имени --}}
                                                        <input class="form-control form-control-sm mt-1" type="text"
                                                            name="siblings[{{ $index }}][name]"
                                                            value="{{ $member->name }}"
                                                            placeholder="{{ __('Sibling') }}">
                                                        {{-- Поле QR Code --}}
                                                        <input class="form-control form-control-sm mt-1" type="text"
                                                            name="siblings[{{ $index }}][qr_code]"
                                                            value="{{ $member->qr_code }}"
                                                            placeholder="{{ __('QR Code') }}">

                                                        {{-- Кнопка удалить --}}
                                                        {{-- <button type="button" class="btn btn-danger btn-sm mt-2"
                                                    onclick="if(confirm('Удалить этого брата?')) document.getElementById('delete-form-{{ $member->id }}').submit();">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button> --}}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <li class="mb-3">
                                                <a href="#"
                                                    onclick="event.preventDefault(); setActionAndSubmit('add_siblings');">
                                                    <div class="my-2 mx-2" style="cursor: pointer;">
                                                        <img src="{{ asset('avatar/avatar-add-2.png') }}"
                                                            class="rounded-circle" width="90" height="90">
                                                    </div>
                                                    {{ __('Add Siblings') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>

                        </section>

                        {{-- <form action="{{ route('family.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                        <div class="row mb-3">
                            <div class="form-group col-12 col-md-5 mt-1">
                                <select name="role" class="form-select" required>
                                    <option value="">{{ __('Select my loved ones') }}</option>
                                    <option value="father">{{ __('Father') }}</option>
                                    <option value="mother">{{ __('Mother') }}</option>
                                    <option value="partner">{{ __('Partner') }}</option>
                                    <option value="children">{{ __('Children') }}</option>
                                    <option value="siblings">{{ __('Siblings') }}</option>
                                    <option value="pets">{{ __('Pets') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-5 mt-1">
                                <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                                    required>
                            </div>

                                <div class="form-group col-12 col-md-2 mt-1">
                                    <button type="submit" class="btn btn-outline-primary mb-4 w-100">
                                        <i class="fa fa-plus"></i> {{ __('Add') }}</button>
                                </div>

                        </div>

                    </form> --}}

                        <!-- Row 1 -->
                        {{-- <div class="row mb-4 mt-40">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                {{ __('Father') }}</h6>
                            <ul class="list-group">
                                @foreach ($familyMembers['father'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}"
                                            action="{{ route('family.delete', $member->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                {{ __('Mother') }}</h6>
                            <ul class="list-group">
                                @foreach ($familyMembers['mother'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}"
                                            action="{{ route('family.delete', $member->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div> --}}

                        <!-- Row 2 -->
                        {{-- <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                {{ __('Partner') }}</h6>
                            <ul class="list-group">
                                @foreach ($familyMembers['partner'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}"
                                            action="{{ route('family.delete', $member->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                {{ __('Children') }}</h6>
                            <ul class="list-group">
                                @foreach ($familyMembers['children'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}"
                                            action="{{ route('family.delete', $member->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div> --}}



                        <!-- Row 3 -->
                        {{-- <div class="row mb-4">
                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                {{ __('Siblings') }}</h6>
                            <ul class="list-group">
                                @foreach ($familyMembers['siblings'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}"
                                            action="{{ route('family.delete', $member->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                {{ __('Pets') }}</h6>
                            <ul class="list-group">
                                @foreach ($familyMembers['pets'] ?? [] as $member)
                                    <li class="mt-2 ms-1">
                                        {{ $member->name }}
                                        <button class="btn btn-sm btn-outline-danger float-end"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                        <form id="delete-form-{{ $member->id }}"
                                            action="{{ route('family.delete', $member->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div> --}}

                        <div class="d-flex justify-content-between mt-50">
                            <a href="{{ route('timeline.create', $memorial) }}" class="btn btn-secondary">{{ __('Skip') }}</a>
                            <a href="#" class="btn btn-primary" onclick="this.closest('form').submit();">
                                <i class="fa fa-save"></i> {{ __('Next') }}
                            </a>

                        </div>

                    </div>
                </form>


                <!-- Формы удаления -->
                @foreach ($familyMembers as $role => $members)
                    @foreach ($members as $member)
                        <form id="delete-form-{{ $member->id }}" action="{{ route('family.delete', $member->id) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('js')

<script>
function handleDelete(event, formId) {
    event.stopPropagation();

    // Сохраняем текущую позицию скролла
    const scrollPosition = window.pageYOffset;
    localStorage.setItem('scroll_position_temp', scrollPosition);

    // Отправляем конкретную форму удаления
    const form = document.getElementById(formId);
    if (form) {
        form.submit();
    } else {
        console.error('Форма удаления не найдена: ' + formId);
    }
}


// Добавляем класс для скрытия контента
document.documentElement.className += ' scroll-loading';

// Восстанавливаем позицию максимально рано
window.addEventListener('DOMContentLoaded', function() {
    const savedPosition = localStorage.getItem('scroll_position_temp');
    
    if (savedPosition && savedPosition > 0) {
        // Немедленно устанавливаем позицию
        window.scrollTo(0, parseInt(savedPosition));
        localStorage.removeItem('scroll_position_temp');
    }
    
    // Показываем контент
    setTimeout(function() {
        document.documentElement.className = document.documentElement.className.replace('scroll-loading', 'scroll-ready');
    }, 50);
    
    // Ваш код для tree-container
    let container = document.getElementById('tree-container');
    if (container) {
        container.scrollLeft = (container.scrollWidth - container.clientWidth) / 2;
    }
});

function setActionAndSubmit(actionValue) {
    const scrollPosition = window.pageYOffset;
    localStorage.setItem('scroll_position_temp', scrollPosition);
    
    document.getElementById('action-input').value = actionValue;
    document.getElementById('family-form').submit();
}

function previewImage(input, previewId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
