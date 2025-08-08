@extends('layouts.dashboard')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

    <style>
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
            width: 120px;
            text-align: center;
            height: 175px;
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

        /* Hover effects */
        /* .tree li a:hover {
                                                background: #c8e4f8;
                                                color: #000;
                                                border: 1px solid #94a0b4;
                                            } */

        /* Connector styles on hover */
        /* .tree li a:hover~ul li::after,
                                            .tree li a:hover~ul li::before,
                                            .tree li a:hover~ul::before,
                                            .tree li a:hover~ul ul::before,
                                            .parent-pair:hover::after {
                                                border-color: #94a0b4;
                                            } */


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
    </style>
@endsection

@section('content')

    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Family') }}</h4>
                </div>
            </div>
        </div>

        <div class="">

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
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ==================== Start Intro-vid ==================== -->
            {{-- <section class="intro-vid mt-100 pt-50 d-flex justify-content-center">
                <div class="col-12 col-md-9 mt-30">

                </div>
            </section> --}}
            <!-- ==================== End Intro-vid ==================== -->
            <!-- Форма для добавления партнера -->
            <form action="{{ route('dashboard.family.store') }}" id="add-partner-form" method="POST">
                @csrf
                <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                <input type="hidden" name="role" value="partner">


            </form>

            <!-- Форма для добавления детей -->
            <form action="{{ route('dashboard.family.store') }}" id="add-children-form" method="POST">
                @csrf
                <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                <input type="hidden" name="role" value="children">


            </form>

            <!-- Форма для добавления братьев/сестер -->
            <form action="{{ route('dashboard.family.store') }}" id="add-siblings-form" method="POST">
                @csrf
                <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">
                <input type="hidden" name="role" value="siblings">


            </form>





            <form id="family-form" action="{{ route('family.update', $memorial->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                {{-- <button type="submit" name="action" value="add_partner">Добавить партнера</button>
    <button type="submit" name="action" value="add_children">Добавить ребенка</button>
    <button type="submit" name="action" value="add_siblings">Добавить брата/сестру</button> --}}

                <input type="hidden" name="action" id="action-input" value="">

                <!-- Family tree -->
                <section id="family-tree" class="position-relative padding_top">

                    <div class="col-md-12 text-center wow top15" >
                        {{-- <h2 class="heading bottom45 darkcolor font-light2"> Családfa<span class="font-normal"></span> --}}

                        </h2>
                        <div class="col-md-8 offset-md-2 bottom40">
                            <p>
                                {{ __('A diagram depicting the kinship relationships of a family, showing a person\'s ancestors and descendants, such as parents, children, and grandparents.') }}
                            </p>
                        </div>
                    </div>

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
                                    <a class="d-flex flex-column align-items-center text-decoration-none position-relative">
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
                                            id="image_{{ $grandfatherFather->id ?? 'grandfather_father' }}" class="d-none"
                                            accept="image/*"
                                            onchange="previewImage(this, 'preview_{{ $grandfatherFather->id ?? 'grandfather_father' }}')">
                                        <input type="text" class="form-control mt-2 text-center"
                                            name="{{ $grandfatherFather && $grandfatherFather->id ? 'family_members[' . $grandfatherFather->id . '][name]' : 'names[grandfather_father]' }}"
                                            value="{{ $grandfatherFather->name ?? '' }}"
                                            placeholder="{{ __('Grandfather') }}">
                                        @if ($grandfatherFather && $grandfatherFather->id)
                                            <input type="hidden" name="family_members[{{ $grandfatherFather->id }}][id]"
                                                value="{{ $grandfatherFather->id }}">
                                        @endif
                                    </a>
                                </li>

                                {{-- Бабушка по отцовской линии --}}
                                <li class="up">
                                    <a class="d-flex flex-column align-items-center text-decoration-none position-relative">
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
                                            id="image_{{ $grandmotherFather->id ?? 'grandmother_father' }}" class="d-none"
                                            accept="image/*"
                                            onchange="previewImage(this, 'preview_{{ $grandmotherFather->id ?? 'grandmother_father' }}')">
                                        <input type="text" class="form-control mt-2 text-center"
                                            name="{{ $grandmotherFather && $grandmotherFather->id ? 'family_members[' . $grandmotherFather->id . '][name]' : 'names[grandmother_father]' }}"
                                            value="{{ $grandmotherFather->name ?? '' }}"
                                            placeholder="{{ __('Grandmother') }}">
                                        @if ($grandmotherFather && $grandmotherFather->id)
                                            <input type="hidden" name="family_members[{{ $grandmotherFather->id }}][id]"
                                                value="{{ $grandmotherFather->id }}">
                                        @endif
                                    </a>
                                </li>

                                {{-- Дедушка по материнской линии --}}
                                <li class="down">
                                    <a
                                        class="d-flex flex-column align-items-center text-decoration-none position-relative">
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
                                        <input type="text" class="form-control mt-2 text-center"
                                            name="{{ $grandfatherMother && $grandfatherMother->id ? 'family_members[' . $grandfatherMother->id . '][name]' : 'names[grandfather_mother]' }}"
                                            value="{{ $grandfatherMother->name ?? '' }}"
                                            placeholder="{{ __('Grandfather') }}">
                                        @if ($grandfatherMother && $grandfatherMother->id)
                                            <input type="hidden" name="family_members[{{ $grandfatherMother->id }}][id]"
                                                value="{{ $grandfatherMother->id }}">
                                        @endif
                                    </a>
                                </li>

                                {{-- Бабушка по материнской линии --}}
                                <li class="up">
                                    <a
                                        class="d-flex flex-column align-items-center text-decoration-none position-relative">
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
                                        <input type="text" class="form-control mt-2 text-center"
                                            name="{{ $grandmotherMother && $grandmotherMother->id ? 'family_members[' . $grandmotherMother->id . '][name]' : 'names[grandmother_mother]' }}"
                                            value="{{ $grandmotherMother->name ?? '' }}"
                                            placeholder="{{ __('Grandmother') }}">
                                        @if ($grandmotherMother && $grandmotherMother->id)
                                            <input type="hidden" name="family_members[{{ $grandmotherMother->id }}][id]"
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
                                            <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                onclick="document.getElementById('image_{{ $father->id ?? 'father' }}').click()"
                                                title="Загрузить фото">
                                                <img id="preview_{{ $father->id ?? 'father' }}"
                                                    src="{{ isset($father) && $father->photo ? asset('memorial/' . $father->photo) : asset('avatar/avatar-man.png') }}"
                                                    class="img-fluid rounded-circle" width="90" height="90"
                                                    alt="Фото">
                                                <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                            </div>
                                            <input type="file" name="images[{{ $father->id ?? 'father' }}]"
                                                id="image_{{ $father->id ?? 'father' }}" class="d-none" accept="image/*"
                                                onchange="previewImage(this, 'preview_{{ $father->id ?? 'father' }}')">
                                            <input type="text" class="form-control mt-3 text-center"
                                                name="{{ $father && $father->id ? 'family_members[' . $father->id . '][name]' : 'names[father]' }}"
                                                value="{{ optional($father)->name }}" placeholder="{{ __('Father') }}">
                                            @if ($father && $father->id)
                                                <input type="hidden" name="family_members[{{ $father->id }}][id]"
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
                                            <div class="image-wrapper position-relative" style="cursor: pointer;"
                                                onclick="document.getElementById('image_{{ $mother->id ?? 'mother' }}').click()"
                                                title="Загрузить фото">
                                                <img id="preview_{{ $mother->id ?? 'mother' }}"
                                                    src="{{ isset($mother) && $mother->photo ? asset('memorial/' . $mother->photo) : asset('avatar/avatar-woman-3.png') }}"
                                                    class="img-fluid rounded-circle" width="90" height="90"
                                                    alt="Фото">
                                                <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                            </div>
                                            <input type="file" name="images[{{ $mother->id ?? 'mother' }}]"
                                                id="image_{{ $mother->id ?? 'mother' }}" class="d-none" accept="image/*"
                                                onchange="previewImage(this, 'preview_{{ $mother->id ?? 'mother' }}')">
                                            <input type="text" class="form-control mt-3 text-center"
                                                name="{{ $mother && $mother->id ? 'family_members[' . $mother->id . '][name]' : 'names[mother]' }}"
                                                value="{{ optional($mother)->name }}" placeholder="{{ __('Mother') }}">
                                            @if ($mother && $mother->id)
                                                <input type="hidden" name="family_members[{{ $mother->id }}][id]"
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
                                                <div class="image-wrapper" style="cursor: pointer;"
                                                    onclick="document.getElementById('image_{{ $member->id }}').click()"
                                                    title="Загрузить фото">
                                                    <img id="preview_{{ $member->id }}"
                                                        src="{{ isset($member) && $member->photo ? asset('memorial/' . $member->photo) : asset('avatar/avatar-girl.png') }}"
                                                        class="img-fluid rounded-circle" width="90" height="90">
                                                    <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                </div>
                                                <input type="file" name="images[{{ $member->id }}]"
                                                    id="image_{{ $member->id }}" class="d-none" accept="image/*"
                                                    onchange="previewImage(this, 'preview_{{ $member->id }}')">

                                                {{-- Скрытый id --}}
                                                <input type="hidden" name="partners[{{ $index }}][id]"
                                                    value="{{ $member->id }}">
                                                {{-- Поле имени --}}
                                                <input class="form-control mt-3" type="text"
                                                    name="partners[{{ $index }}][name]"
                                                    value="{{ $member->name }}" placeholder="{{ __('Partner') }}">
                                            </a>
                                        @endforeach



                                        <!-- Main Person -->
                                        <a>
                                            <div class="image-wrapper" style="cursor: pointer;"
                                                onclick="document.getElementById('image_main_person').click()"
                                                title="Загрузить фото">
                                                <img id="preview_main_person"
                                                    src="{{ asset('memorial/' . $memorial->slug . '/' . $memorial->photo) }}"
                                                    class="img-fluid rounded-circle" width="90" height="90">
                                                <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                            </div>
                                            <input type="file" name="images[main_person]" id="image_main_person"
                                                class="d-none" accept="image/*"
                                                onchange="previewImage(this, 'preview_main_person')">
                                            <input class="form-control mt-3" type="text" name="names[main_person]"
                                                value="{{ $memorial->name }}" placeholder="{{ $memorial->name }}"
                                                readonly>
                                        </a>


                                        <a href="#"
                                            onclick="event.preventDefault(); setActionAndSubmit('add_partner');"
                                            style="">
                                            <div class="" style="cursor: pointer;">
                                                <img src="{{ asset('avatar/avatar-girl.png') }}" class=" rounded-circle"
                                                    width="90" height="90">
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
                                                    <a class="d-flex flex-column align-items-center text-decoration-none">
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
                                                        <input type="hidden" name="childrens[{{ $index }}][id]"
                                                            value="{{ $member->id }}">
                                                        {{-- Поле имени --}}
                                                        <input class="form-control mt-3" type="text"
                                                            name="childrens[{{ $index }}][name]"
                                                            value="{{ $member->name }}"
                                                            placeholder="{{ __('Children') }}">
                                                        {{-- <input class="form-control mt-3" type="text"
                                                            name="childrens[{{ $index }}][qr_code]"
                                                            value="{{ $member->qr_code }}"
                                                            placeholder="{{ __('QR Code') }}"> --}}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <li class="mb-3">
                                                <a href="#"
                                                    onclick="event.preventDefault(); setActionAndSubmit('add_children');"
                                                    style="">
                                                    <div class="" style="cursor: pointer;">
                                                        <img src="{{ asset('avatar/avatar-girl.png') }}"
                                                            class=" rounded-circle" width="90" height="90">
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
    <button type="button"
            class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1"
            style="transform: translate(30%, -30%);"
            onclick="event.stopPropagation(); if(confirm('Удалить этого брата?')) document.getElementById('delete-form-{{ $member->id }}').submit();">
        <i class="fa-solid fa-trash fa-xs"></i>
    </button>
                                                <div class="image-wrapper" style="cursor: pointer;"
                                                    onclick="document.getElementById('image_{{ $member->id }}').click()"
                                                    title="Загрузить фото">
                                                    <img id="preview_{{ $member->id }}"
                                                        src="{{ isset($member) && $member->photo ? asset('memorial/' . $member->photo) : asset('avatar/avatar-girl.png') }}"
                                                        class="img-fluid rounded-circle" width="90" height="90">
                                                    <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                                </div>
                                                <input type="file" name="images[{{ $member->id }}]"
                                                    id="image_{{ $member->id }}" class="d-none" accept="image/*"
                                                    onchange="previewImage(this, 'preview_{{ $member->id }}')">

                                                {{-- Скрытый id --}}
                                                <input type="hidden" name="siblings[{{ $index }}][id]"
                                                    value="{{ $member->id }}">
                                                {{-- Поле имени --}}
                                                <input class="form-control mt-3" type="text"
                                                    name="siblings[{{ $index }}][name]"
                                                    value="{{ $member->name }}" placeholder="{{ __('Sibling') }}">

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
                                            <div style="cursor: pointer;">
                                                <img src="{{ asset('avatar/avatar-girl.png') }}" class="rounded-circle"
                                                    width="90" height="90">
                                            </div>
                                            {{ __('Add Siblings') }}
                                        </a>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                    </div>

                </section>

                {{-- @dump($familyMembers) --}}

                <!-- Family tree ends -->

    </section>

    <!-- ==================== SAVE BUTTON ==================== -->

    <section class="numbers-ca mb-20">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-60">
                    <button type="submit" class="butn butn-md butn-bord butn-rounded disabled">
                        <span class="text">
                            {{ __('Save changes') }}
                        </span>

                        <span class="icon ">
                            <i class="fa-regular fa-save"></i>
                        </span>

                    </button>
                </div>
            </div>
        </div>
    </section>
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




@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let container = document.getElementById('tree-container');
            container.scrollLeft = (container.scrollWidth - container.clientWidth) / 2;
        });

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

        function setActionAndSubmit(actionValue) {
            document.getElementById('action-input').value = actionValue;
            document.getElementById('family-form').submit();
        }
    </script>
@endsection
