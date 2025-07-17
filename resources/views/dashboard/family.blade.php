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






        .tree {
            min-width: 1200px;
        }

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
            height: 178px;
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


            <div class="">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-12 p-3">
                        <div class="">
                            <div class="row">
                                <form action="{{ route('dashboard.family.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                                    <div class="row mb-3">
                                        <div class="form-group col-12 col-md-5 mt-1">
                                            {{-- <label>{{ __('My loved ones') }}</label> --}}
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
                                            {{-- <label>{{ __('Name') }}</label> --}}
                                            <input type="text" name="name" class="form-control"
                                                placeholder="{{ __('Name') }}" required>
                                        </div>

                                        {{-- <div class="form-group col-12 col-md-2 mt-30"> --}}
                                        <div class="form-group col-12 col-md-2 mt-1">
                                            <button type="submit" class="btn btn-outline-primary mb-4 w-100">
                                                <i class="fa fa-plus"></i> {{ __('Add') }}</button>
                                        </div>

                                    </div>

                                </form>

                                {{-- <div class="mt-50">
                                    <label for="video" class="form-label ">Videó egyedi URL</label>
                                    <input type="text" name="video" id="video" class="form-control py-2"
                                        value="{{ $memorial->video }}">
                                    <small class="text-muted">Ha üresen hagyja, akkor a videó nem lesz megjelenítve</small>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('family.update', $memorial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-12 p-3">


                            <div class="">
                                <!-- Row 1 -->
                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex flex-column">
                                        <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                            {{ __('Father') }}</h6>
                                        <ul class="list-group">
                                            @foreach ($familyMembers['father'] ?? [] as $member)
                                                <li class="mt-2 ms-1 d-flex align-items-center">
                                                    <input class="form-control me-2" type="text"
                                                        name="names[{{ $member->id }}]" value="{{ $member->name }}"
                                                        required>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column">
                                        <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                            {{ __('Mother') }}</h6>
                                        <ul class="list-group">
                                            @foreach ($familyMembers['mother'] ?? [] as $member)
                                                <li class="mt-2 ms-1 d-flex align-items-center">
                                                    <input class="form-control me-2" type="text"
                                                        name="names[{{ $member->id }}]" value="{{ $member->name }}"
                                                        required>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex flex-column">
                                        <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                            {{ __('Partner') }}</h6>
                                        <ul class="list-group">
                                            @foreach ($familyMembers['partner'] ?? [] as $member)
                                                <li class="mt-2 ms-1 d-flex align-items-center">
                                                    <input class="form-control me-2" type="text"
                                                        name="names[{{ $member->id }}]" value="{{ $member->name }}"
                                                        required>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column">
                                        <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                            {{ __('Children') }}</h6>
                                        <ul class="list-group">
                                            @foreach ($familyMembers['children'] ?? [] as $member)
                                                <li class="mt-2 ms-1 d-flex align-items-center">
                                                    <input class="form-control me-2" type="text"
                                                        name="names[{{ $member->id }}]" value="{{ $member->name }}"
                                                        required>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- Row 3 -->
                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex flex-column">
                                        <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                            {{ __('Siblings') }}</h6>
                                        <ul class="list-group">
                                            @foreach ($familyMembers['siblings'] ?? [] as $member)
                                                <li class="mt-2 ms-1 d-flex align-items-center">
                                                    <input class="form-control me-2" type="text"
                                                        name="names[{{ $member->id }}]" value="{{ $member->name }}"
                                                        required>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column">
                                        <h6 class="text-secondary border-bottom pb-2 text-center fs-6">
                                            {{ __('Pets') }}</h6>
                                        <ul class="list-group">
                                            @foreach ($familyMembers['pets'] ?? [] as $member)
                                                <li class="mt-2 ms-1 d-flex align-items-center">
                                                    <input class="form-control me-2" type="text"
                                                        name="names[{{ $member->id }}]" value="{{ $member->name }}"
                                                        required>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $member->id }}').submit();">×</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>


                            </div>



                        </div>
                    </div> --}}

            </div>





            <!-- Family tree -->
            <section id="family-tree" class="position-relative padding_top">

                <div class="col-md-12 text-center wow fadeIn top15" data-wow-delay="300ms">
                    <h2 class="heading bottom45 darkcolor font-light2"> Családfa<span class="font-normal"></span>

                    </h2>
                    <div class="col-md-8 offset-md-2 bottom40">
                        <p>
                            Egy család rokonsági kapcsolatait ábrázoló diagram, amely bemutatja az ember felmenőit és
                            leszármazottait, például szülőket, gyerekeket és nagyszülőket.
                        </p>
                    </div>
                </div>

                <div class="tree-container padding_bottom">
                    <div class="tree wow fadeIn" data-wow-delay="300ms">
                        <ul class="down">
                            {{-- Дедушка по отцовской линии --}}
                            <li class="down">
                                <a class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                    <div class="image-wrapper position-relative" style="cursor: pointer;"
                                        onclick="document.getElementById('image_grandfather_father').click()"
                                        title="Загрузить фото">
                                        <img id="preview_grandfather_father"
                                            src="{{ $grandfatherFather->photo ? asset('memorial/' . $grandfatherFather->photo) : asset('avatar/avatar-father.png') }}"
                                            {{-- src="{{ $grandfatherFather->photo ?? asset('avatar/avatar-father.png') }}" --}}
                                            class="img-fluid rounded-circle" width="90" height="90"
                                            alt="Фото">
                                        <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                    </div>
                                    <input type="file" name="images[grandfather_father]" id="image_grandfather_father"
                                        class="d-none" accept="image/*"
                                        onchange="previewImage(this, 'preview_grandfather_father')">
                                    <input type="text" class="form-control mt-2 text-center"
                                        name="names[grandfather_father]" value="{{ $grandfatherFather->name ?? '' }}"
                                        placeholder="Nagyapa">
                                </a>
                            </li>

                            {{-- Бабушка по отцовской линии --}}
                            <li class="up">
                                <a class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                    <div class="image-wrapper position-relative" style="cursor: pointer;"
                                        onclick="document.getElementById('image_grandmother_father').click()"
                                        title="Загрузить фото">
                                        <img id="preview_grandmother_father"
                                            src="{{ $grandmotherFather->photo ? asset('memorial/' . $grandmotherFather->photo) : asset('avatar/avatar-woman.png') }}"
                                            
                                            class="img-fluid rounded-circle" width="90" height="90"
                                            alt="Фото">
                                        <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                    </div>
                                    <input type="file" name="images[grandmother_father]" id="image_grandmother_father"
                                        class="d-none" accept="image/*"
                                        onchange="previewImage(this, 'preview_grandmother_father')">
                                    <input type="text" class="form-control mt-2 text-center"
                                        name="names[grandmother_father]" value="{{ $grandmotherFather->name ?? '' }}"
                                        placeholder="Nagymama">
                                </a>
                            </li>

                            {{-- Дедушка по материнской линии --}}
                            <li class="down">
                                <a class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                    <div class="image-wrapper position-relative" style="cursor: pointer;"
                                        onclick="document.getElementById('image_grandfather_mother').click()"
                                        title="Загрузить фото">
                                        <img id="preview_grandfather_mother"
                                            src="{{ $grandfatherMother->photo ? asset('memorial/' . $grandfatherMother->photo) : asset('avatar/avatar-father.png') }}"
                                            
                                            class="img-fluid rounded-circle" width="90" height="90"
                                            alt="Фото">
                                        <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                    </div>
                                    <input type="file" name="images[grandfather_mother]" id="image_grandfather_mother"
                                        class="d-none" accept="image/*"
                                        onchange="previewImage(this, 'preview_grandfather_mother')">
                                    <input type="text" class="form-control mt-2 text-center"
                                        name="names[grandfather_mother]" value="{{ $grandfatherMother->name ?? '' }}"
                                        placeholder="Nagyapa">
                                </a>
                            </li>

                            {{-- Бабушка по материнской линии --}}
                            <li class="up">
                                <a class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                    <div class="image-wrapper position-relative" style="cursor: pointer;"
                                        onclick="document.getElementById('image_grandmother_mother').click()"
                                        title="Загрузить фото">
                                        <img id="preview_grandmother_mother"
                                            src="{{ $grandmotherMother->photo ? asset('memorial/' . $grandmotherMother->photo) : asset('avatar/avatar-woman.png') }}"
                                            
                                            class="img-fluid rounded-circle" width="90" height="90"
                                            alt="Фото">
                                        <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                    </div>
                                    <input type="file" name="images[grandmother_mother]" id="image_grandmother_mother"
                                        class="d-none" accept="image/*"
                                        onchange="previewImage(this, 'preview_grandmother_mother')">
                                    <input type="text" class="form-control mt-2 text-center"
                                        name="names[grandmother_mother]" value="{{ $grandmotherMother->name ?? '' }}"
                                        placeholder="Nagymama">
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
                                            onclick="document.getElementById('image_father').click()"
                                            title="Загрузить фото">
                                            <img id="preview_father"
                                                src="{{ $father->photo ? asset('memorial/' . $father->photo) : asset('avatar/avatar-man.png') }}"
                                                class="img-fluid rounded-circle" width="90" height="90"
                                                alt="Фото">
                                            <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                        </div>
                                        <input type="file" name="images[father]" id="image_father" class="d-none"
                                            accept="image/*" onchange="previewImage(this, 'preview_father')">
                                        <input type="text" class="form-control mt-3 text-center" name="names[father]"
                                            value="{{ $father->name }}" placeholder="Apa">
                                    </a>
                                </ul>
                            </li>

                            <!-- Mother -->
                            <li class="up mom">
                                <ul class="apa">
                                    <a
                                        class="d-flex flex-column align-items-center text-decoration-none position-relative">
                                        <div class="image-wrapper position-relative" style="cursor: pointer;"
                                            onclick="document.getElementById('image_mother').click()"
                                            title="Загрузить фото">
                                            <img id="preview_mother"
                                                src="{{ $mother->photo ? asset('memorial/' . $mother->photo) : asset('aavatar/avatar-woman-3.png') }}"

                                                class="img-fluid rounded-circle" width="90" height="90"
                                                alt="Фото">
                                            <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                        </div>
                                        <input type="file" name="images[mother]" id="image_mother" class="d-none"
                                            accept="image/*" onchange="previewImage(this, 'preview_mother')">
                                        <input type="text" class="form-control mt-3 text-center" name="names[mother]"
                                            value="{{ $mother->name }}" placeholder="Anya">
                                    </a>
                                </ul>
                            </li>
                        </ul>


                        <ul>
                            <ul>
                                <li>
                                    <a>
                                        <i class="fa-solid fa-plus rounded-circle fs-5 mt-3 mb-3"></i> <br>
                                        add partner
                                    </a>

                                    <!-- Partner -->
                                    @foreach ($familyMembers['partner'] ?? [] as $index => $member)
                                        <a>
                                            <div class="image-wrapper" style="cursor: pointer;"
                                                onclick="document.getElementById('image_partner_{{ $index }}').click()"
                                                title="Загрузить фото">
                                                <img id="preview_partner_{{ $index }}"
                                                    src="{{ $member->photo ? asset('memorial/' . $member->photo) : asset('avatar/avatar-girl.png') }}"
                                                    {{-- src="{{ $member->image_url ?? asset('avatar/avatar-girl.png') }}" --}}
                                                    class="img-fluid rounded-circle" width="90" height="90">
                                                <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                            </div>
                                            <input type="file" name="images[partner_{{ $index }}]"
                                                id="image_partner_{{ $index }}" class="d-none" accept="image/*"
                                                onchange="previewImage(this, 'preview_partner_{{ $index }}')">
                                            <input class="form-control mt-3" type="text"
                                                name="names[{{ $member->id }}]" value="{{ $member->name }}"
                                                placeholder="Feleség" required>
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
                                            value="{{ $memorial->name }}" placeholder="{{ $memorial->name }}">
                                    </a>

                                    <ul>
                                        <!-- Children -->
                                        @foreach ($familyMembers['children'] ?? [] as $index => $child)
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
                                                    {{-- <input class="form-control mt-2 text-center" type="text"
                                                        name="children[{{ $child->id }}]" value="{{ $child->name }}"
                                                        placeholder="Gyermek" required> --}}


                                                    <input class="form-control mt-2 text-center" type="text"
                                                        name="names[{{ $child->id }}]" value="{{ $child->name }}"
                                                        placeholder="Gyermek" required>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <!-- Siblings -->
                                @foreach ($familyMembers['siblings'] ?? [] as $index => $sibling)
                                    <li class="mb-3">
                                        <a class="d-flex flex-column align-items-center text-decoration-none">
                                            <div class="image-wrapper" style="cursor: pointer;"
                                                onclick="document.getElementById('image_sibling_{{ $index }}').click()"
                                                title="Загрузить фото">
                                                <img id="preview_sibling_{{ $index }}"
                                                    src="{{ $sibling->image_url ?? asset('avatar/avatar-man.png') }}"
                                                    class="img-fluid rounded-circle" width="90" height="90">
                                                <i class="fa-solid fa-camera camera-icon p-1 shadow"></i>
                                            </div>
                                            <input type="file" name="images[sibling_{{ $index }}]"
                                                id="image_sibling_{{ $index }}" class="d-none" accept="image/*"
                                                onchange="previewImage(this, 'preview_sibling_{{ $index }}')">
                                            <input class="form-control mt-2 text-center" type="text"
                                                name="names[{{ $sibling->id }}]" value="{{ $sibling->name }}"
                                                placeholder="Testvér"
                                                required>
                                        </a>
                                    </li>
                                @endforeach
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
