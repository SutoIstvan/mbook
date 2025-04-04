@extends('layouts.dashboard')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

    <style>
        :before,
        :after {
            margin: 0;
            padding: 0;
            word-break: break-all;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        .progress-wrap {
            display: none !important;
            /* или visibility: hidden !important; */
        }

        .holder {
            background-image: url('../../circle.png');
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
            width: 22px;
            height: 60px;
            border-radius: 50% 50% 35% 35%;
            left: 50%;
            top: -48px;
            transform: translateX(-50%);
            background: rgba(0, 132, 255, 0.207);
            box-shadow: 0 -40px 30px 0 #dc8a0c, 0 40px 50px 0 #dc8a0c, inset 3px 0 2px 0 rgba(0, 133, 255, .6), inset -3px 0 2px 0 rgba(0, 133, 255, .6);
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
            color: #a4a4a4;
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

        .position-relative {
            position: relative;
        }

        .position-absolute {
            position: absolute;
        }
    </style>
@endsection

@section('content')

    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Képek feltöltése') }}</h4>
                </div>
            </div>
        </div>

        <div class="">


            <div class="container mb-4">

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
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="container">
                <div class="row d-flex justify-content-center">
                    <form id="form" action="{{ route('memorial.images.upload', $memorial->id) }}" method="POST"
                        enctype="multipart/form-data" class="px-3 rounded">
                        @csrf
                        {{-- <label for="images" class="form-label ">Képek feltöltése</label> --}}
                        <input type="file" name="images[]" multiple class="form-control" required>
                        <small class="text-muted">Maximum 30 kép tölthető fel egy emlékoldalhoz. Fényképformátum: JPEG, JPG,
                            PNG</small>

                        {{-- <button type="submit" class="btn btn-secondary mt-3 w-100">Feltöltés</button> --}}
                        <section class="text-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-40">
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
        </div>
    </section>


    @if ($memorial->memorialimages->isNotEmpty())
        <form action="{{ route('memorial.images.update', $memorial->id) }}" method="POST">
            @csrf
            <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
                <div class="sec-head mb-40">
                    <div class="row">
                        <div class="col-lg-12 md-mb15 md-mt35">
                            <h4>{{ __('Photos') }} <small>{{ $photoCount = $memorial->memorialimages()->count() }} /
                                    30</small></h4>

                        </div>
                    </div>
                </div>



                <div class="">

                    <div class="container">
                        <div class="row d-flex justify-content-center">

                            <div class="container">
                                <div class="row">

                                    @foreach ($memorial->memorialimages as $image)
                                        <input type="hidden" name="images[{{ $loop->index }}][id]"
                                            value="{{ $image->id }}">
                                        <div class="col-lg-4 bord mt-20">
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

            <!-- ==================== SAVE BUTTON ==================== -->

            <section class="numbers-ca mb-20">
                <div class="row">
                    <div class="col-6 col-lg-6">
                        <div class="mt-60">
                            <button type="submit" class="butn butn-md butn-bord butn-rounded">
                                <span class="text">
                                    {{ __('Save changes') }}
                                </span>

                                <span class="icon ">
                                    <i class="fa-regular fa-save"></i>
                                </span>

                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6">
                        <div class="mt-60 text-end">
                            <button type="button" class="butn btn-danger butn-md butn-bord butn-rounded deleteall-btn"
                                data-url="{{ route('memorials.images.destroyAll', $memorial) }}">
                                <span class="text">
                                    {{ __('Delete All Image') }}
                                </span>

                                <span class="icon ">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </form>
    @endif

    @if (isset($image))
        <form id="delete-form" action="{{ route('memorial.images.destroy', [$memorial, $image]) }}" method="POST"
            style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endif

    @if (isset($image))
        <form id="deleteall-form" action="{{ route('memorials.images.destroyAll', $memorial) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete all images?');" style="display: none;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete All Images</button>
        </form>
    @endif

@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function() {
                    if (confirm("{{ __('Are you sure you want to delete this image?') }}")) {
                        let form = document.getElementById("delete-form");
                        form.action = this.getAttribute("data-url");
                        form.submit();
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".deleteall-btn").forEach(button => {
                button.addEventListener("click", function() {
                    if (confirm("{{ __('Are you sure you want to delete this image?') }}")) {
                        let form = document.getElementById("deleteall-form");
                        form.action = this.getAttribute("data-url");
                        form.submit();
                    }
                });
            });
        });


        document.getElementById("form").addEventListener("submit", function(event) {
            let button = document.getElementById("submitBtn");
            let btnIcon = document.getElementById("btnIcon");
            let btnSpinner = document.getElementById("btnSpinner");

            // Отключаем кнопку
            button.disabled = true;

            // Скрываем иконку сохранения, показываем спиннер
            btnIcon.classList.add("d-none");
            btnSpinner.classList.remove("d-none");
        });
    </script>
@endsection
