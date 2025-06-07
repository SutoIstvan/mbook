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

                <form action="{{ route('family.update') }}" method="POST">
                    @csrf
                    <div class="row d-flex justify-content-center">
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
                    </div>

            </div>

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
