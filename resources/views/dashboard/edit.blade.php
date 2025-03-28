@extends('layouts.dashboard')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        .cropper-modal {
            background-color: rgb(0, 0, 0) !important;
            opacity: 1 !important;
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
            background: #5b5b5b !important;
        }

        .dropzone .dz-preview .dz-remove {
            margin-top: 10px;
        }


        .drag-area {
            position: relative;
            height: 290px;
            border: 1.4px dashed #afb3b6;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 1px auto;
        }

        .drag-area .icon {
            font-size: 50px;
            color: #878787;
        }

        .drag-area .header {
            font-size: 18px;
            font-weight: 500;
            color: #696969;
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

        .existing-photo img {
            width: 100%;
            height: 100%;
            border-radius: 4px;
            object-fit: cover;
        }

        .dexisting-photo {
            position: relative;
            height: 290px;
            border: 1.4px dashed #afb3b6;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 1px auto;
        }

        .deleteBtn:hover {
            background-color: #212121 !important;
            color: #fafafa;
        }

        /* .deleteBtn {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    background: rgba(255, 0, 0, 0.7);
                    color: white;
                    border: none;
                    padding: 5px 10px;
                    font-size: 14px;
                    border-radius: 50%;
                    cursor: pointer;
                    transition: background 0.3s;
                } */

                .deleteBtn {
                    background-color: #f8f9fa; /* Установить одинаковый цвет фона */
                    border: 1px solid #adaeaf; /* Убедиться, что граница установлена */
                    box-shadow: none; /* Удалить тень */
                }

    </style>
@endsection

@section('content')


    <form action="{{ route('memorial.update', $memorial->id) }}" method="POST" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
        <!-- ==================== Start Process ==================== -->
        <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
            <div class="sec-head mb-40">
                <div class="row">
                    <div class="col-lg-12 md-mb15 md-mt35">
                        <h4>{{ __('Edit data') }}</h4>
                    </div>
                    <!-- <div class="col-lg-6">
                                                            <div class="text">
                                                                <p>Business challenges are tough but we.

                                                                </p>
                                                            </div>
                                                        </div> -->
                </div>
            </div>

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


            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="name" class="col-form-label text-md-end">{{ __('Full Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', $memorial->name) }}" required autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="birth_date" class="col-form-label text-md-end">{{ __('Date of Birth') }}</label>
                    <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror"
                        name="birth_date" value="{{ old('name', $memorial->birth_date) }}" required>
                    @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="death_date" class="col-form-label text-md-end">{{ __('Date of Death') }}</label>
                    <input id="death_date" type="date" class="form-control @error('death_date') is-invalid @enderror"
                        name="death_date" value="{{ old('name', $memorial->death_date) }}">
                    @error('death_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>




                <div class="col-md-12">
                    <label for="biography" class="col-form-label text-md-end">{{ __('Biography') }}</label>
                    <textarea id="biography" class="form-control @error('biography') is-invalid @enderror" name="biography" rows="10">{{ old('name', $memorial->biography) }}</textarea>
                    @error('biography')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-lg-12 text-end">
                    <div class="mt-15">

                        <a class="butn butn-md butn-bord butn-rounded disabled">
                            <span class="text">
                                {{ __('AI életrajz generator') }}
                            </span>

                            <span class="icon ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 320">
                                    <path
                                        d="m297.06 130.97c7.26-21.79 4.76-45.66-6.85-65.48-17.46-30.4-52.56-46.04-86.84-38.68-15.25-17.18-37.16-26.95-60.13-26.81-35.04-.08-66.13 22.48-76.91 55.82-22.51 4.61-41.94 18.7-53.31 38.67-17.59 30.32-13.58 68.54 9.92 94.54-7.26 21.79-4.76 45.66 6.85 65.48 17.46 30.4 52.56 46.04 86.84 38.68 15.24 17.18 37.16 26.95 60.13 26.8 35.06.09 66.16-22.49 76.94-55.86 22.51-4.61 41.94-18.7 53.31-38.67 17.57-30.32 13.55-68.51-9.94-94.51zm-120.28 168.11c-14.03.02-27.62-4.89-38.39-13.88.49-.26 1.34-.73 1.89-1.07l63.72-36.8c3.26-1.85 5.26-5.32 5.24-9.07v-89.83l26.93 15.55c.29.14.48.42.52.74v74.39c-.04 33.08-26.83 59.9-59.91 59.97zm-128.84-55.03c-7.03-12.14-9.56-26.37-7.15-40.18.47.28 1.3.79 1.89 1.13l63.72 36.8c3.23 1.89 7.23 1.89 10.47 0l77.79-44.92v31.1c.02.32-.13.63-.38.83l-64.41 37.19c-28.69 16.52-65.33 6.7-81.92-21.95zm-16.77-139.09c7-12.16 18.05-21.46 31.21-26.29 0 .55-.03 1.52-.03 2.2v73.61c-.02 3.74 1.98 7.21 5.23 9.06l77.79 44.91-26.93 15.55c-.27.18-.61.21-.91.08l-64.42-37.22c-28.63-16.58-38.45-53.21-21.95-81.89zm221.26 51.49-77.79-44.92 26.93-15.54c.27-.18.61-.21.91-.08l64.42 37.19c28.68 16.57 38.51 53.26 21.94 81.94-7.01 12.14-18.05 21.44-31.2 26.28v-75.81c.03-3.74-1.96-7.2-5.2-9.06zm26.8-40.34c-.47-.29-1.3-.79-1.89-1.13l-63.72-36.8c-3.23-1.89-7.23-1.89-10.47 0l-77.79 44.92v-31.1c-.02-.32.13-.63.38-.83l64.41-37.16c28.69-16.55 65.37-6.7 81.91 22 6.99 12.12 9.52 26.31 7.15 40.1zm-168.51 55.43-26.94-15.55c-.29-.14-.48-.42-.52-.74v-74.39c.02-33.12 26.89-59.96 60.01-59.94 14.01 0 27.57 4.92 38.34 13.88-.49.26-1.33.73-1.89 1.07l-63.72 36.8c-3.26 1.85-5.26 5.31-5.24 9.06l-.04 89.79zm14.63-31.54 34.65-20.01 34.65 20v40.01l-34.65 20-34.65-20z" />
                                </svg>
                            </span>

                        </a>
                    </div>
                </div>

                <div class="container mt-25 col-12 col-lg-8">
                    <label class="form-label">{{ __('Main image') }}</label>
                    <div class="">
                        <!-- Отображение текущего фото из базы данных -->
                        @if (isset($memorial->photo) && $memorial->photo)
                            <div class="existing-photo mb-3">
                                <div class="drag-area">
                                    <img src="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photo) }}"
                                        alt="Фото" style="max-width: 100%;">

                                        

                                </div>
                                <div class="col-lg-12 mt-15 text-end">
                                    <button type="button" class="deleteBtn butn butn-md butn-danger butn-rounded mt-1" >
                                        <span class="text">
                                            {{ __('Delete image') }}
                                        </span>
                                        <span class="icon">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Область для загрузки и обрезки нового фото -->
                        <div class="drag-area text-white border-secondary" id="imageContainer"
                            style="{{ isset($memorial->photo) && $memorial->photo ? 'display: none;' : '' }}">
                            <div class="default-content text-center">
                                <div class="icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <span class="header">{{ __('Drag your photo here') }}</span>
                                <span class="header">{{ __('or open it in') }}</span>
                                <div class="text-center mb-10 mt-10">
                                    <span class="button butn butn-md butn-bord butn-rounded"
                                        id="fileTrigger">{{ __('browser') }}</span>
                                </div>
                                <span class="support">{{ __('Photo formats: JPEG, JPG, PNG') }}</span>
                            </div>
                            <img id="image" src="" alt="Photo to crop" style="max-width: 100%; display: none;">
                            <input id="photoInput" name="photo" type="file" hidden
                                accept="image/jpeg, image/jpg, image/png" />
                            <input type="hidden" name="crop_x" id="cropX">
                            <input type="hidden" name="crop_y" id="cropY">
                            <input type="hidden" name="crop_width" id="cropWidth">
                            <input type="hidden" name="crop_height" id="cropHeight">
                        </div>

                        <!-- Контейнер для описания и кнопки замены -->
                        <div class="crop-controls mt-2" style="display: none;">
                            <span class="crop-instruction text-dark me-2">
                                <small>
                                    Húzza a vágási területet úgy, hogy a kép középre kerüljön.
                                </small>
                            </span>
                            <button type="button" id="removePhoto" class="btn btn-danger btn-sm">
                                <span class="icon"><i class="fa-solid fa-trash"></i></span>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="container mt-25 col-12 col-lg-4">
                    <label class="form-label">{{ __('QR-Code letöltése') }}</label>
                    <div class="text-center">
                        <img src="{{ asset('storage/qrcodes/' . $memorial->id . '.png') }}"
                            style="height: 293px !important; width: 293px !important; border-radius: 20px;">
                    </div>
                    <div class="col-lg-12 text-end">
                        <div class="mt-15">
                            <a href="{{ asset('storage/qrcodes/' . $memorial->id . '.png') }}"
                                download="qrcode_{{ $memorial->id }}.png" class="butn butn-md butn-bord butn-rounded">
                                <span class="text">
                                    {{ __('QR-Code letöltése') }}
                                </span>
                                <span class="icon">
                                    <i class="fa-regular fa-save"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>



            </div>
        </section>

        <!-- ==================== End Process ==================== -->



        <!-- ==================== Start Numbers ==================== -->

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

                {{-- <div class="col-lg-6">
                                    <div class="mt-60">
                                        <button type="submit" class="butn butn-md butn-bord butn-rounded disabled">
                                            <span class="text">Cancel</span>
                                            <span class="icon invert ml-10">
                                                <img src="common/imgs/icons/arrow-top-right.svg" alt="">
                                            </span>
                                        </button>
                                    </div>
                                </div> --}}
            </div>
        </section>

        <!-- ==================== End Numbers ==================== -->



        <!-- ==================== Start Testimonials ==================== -->

        {{-- <section class="testimonials-ca section-padding radius-20 mt-15">
                            <div class="sec-head mb-80">
                                <div class="row">
                                    <div class="col-lg-6 md-mb15">
                                        <h2>Reviews</h2>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex">
                                            <div class="gl-rate d-flex align-items-center ml-auto">
                                                <div class="icon">
                                                    <img src="admin/imgs/header/logo-clutch.svg" alt="">
                                                </div>
                                                <div class="cont">
                                                    <h6>4.9/5 <span>Rating on <a href="#0">Clutch</a></span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item wow fadeInUp slow" data-wow-delay="0.2s">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info d-flex align-items-center">
                                            <div class="md-mb30">
                                                <div class="img fit-img">
                                                    <img src="admin/imgs/testim/1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="cont">
                                                <h6>CEO at Archin Co.</h6>
                                                <span>Brian Lee</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 offset-lg-1">
                                        <div class="text">
                                            <h6>“Their services aren’t cookie-cutter and are truly specific to us.”</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item wow fadeInUp slow" data-wow-delay="0.2s">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info d-flex align-items-center">
                                            <div class="md-mb30">
                                                <div class="img fit-img">
                                                    <img src="admin/imgs/testim/2.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="cont">
                                                <h6>President, Newz JSC.</h6>
                                                <span>Aaron Beck</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 offset-lg-1">
                                        <div class="text">
                                            <h6>“A rebrand is not typically done in a chaotic, archaic industry like
                                                ours, so their work has really set us apart."</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item wow fadeInUp slow" data-wow-delay="0.2s">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info d-flex align-items-center">
                                            <div class="md-mb30">
                                                <div class="img fit-img">
                                                    <img src="admin/imgs/testim/3.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="cont">
                                                <h6>Marketing Manager, OKG</h6>
                                                <span>Tim Morthy</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 offset-lg-1">
                                        <div class="text">
                                            <h6>"The Hubfolio team truly amplified our messaging through their expert
                                                use of visuals."</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item wow fadeInUp slow" data-wow-delay="0.2s">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info d-flex align-items-center">
                                            <div class="md-mb30">
                                                <div class="img fit-img">
                                                    <img src="admin/imgs/testim/4.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="cont">
                                                <h6>Director, ZumarCons</h6>
                                                <span>Lewis Cook</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 offset-lg-1">
                                        <div class="text">
                                            <h6>"Our experience with Hubfolio was really good."</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item wow fadeInUp slow" data-wow-delay="0.2s">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info d-flex align-items-center">
                                            <div class="md-mb30">
                                                <div class="img fit-img">
                                                    <img src="admin/imgs/testim/5.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="cont">
                                                <h6>CTO, Itech Co.</h6>
                                                <span>Mohamed Moussa</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 offset-lg-1">
                                        <div class="text">
                                            <h6>"They have been excellent at leveraging the wealth of knowledge and
                                                expertise that Hubfolio has across their team members."</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#0" class="butn butn-md butn-bord butn-rounded mt-40">
                                    <div class="d-flex align-items-center">
                                        <span>See All Reviews on Clutch</span>
                                        <span class="icon ml-20">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </section> --}}

        <!-- ==================== End Testimonials ==================== -->


        <!-- ==================== Start Blog ==================== -->

        {{-- <section class="blog-ca section-padding bg-light radius-20 mt-15">
                            <div class="sec-head mb-80">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h2>News</h2>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex">
                                            <a href="../inner_pages/blog-grid.html" class="butn butn-md butn-bord butn-rounded ml-auto">
                                                <div class="d-flex align-items-center">
                                                    <span>All Articles</span>
                                                    <span class="icon ml-20">
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xlg-marg row-bord">
                                <div class="col-lg-6">
                                    <div class="mitem md-mb50 wow fadeInUp slow" data-wow-delay="0.2s">
                                        <div class="info d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="author-img fit-img">
                                                        <img src="admin/imgs/blog/avatar.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="author-info ml-10">
                                                    <span>M Moussa</span>
                                                    <span class="sub-color">editor</span>
                                                </div>
                                            </div>
                                            <div class="date ml-auto">
                                                <span class="sub-color"><i
                                                        class="fa-regular fa-clock mr-15 opacity-7"></i> 12 hours
                                                    ago</span>
                                            </div>
                                        </div>
                                        <div class="img fit-img mt-30">
                                            <img src="admin/imgs/blog/1.jpg" alt="">
                                        </div>
                                        <div class="cont mt-30">
                                            <h5>
                                                <a href="#0">We’re winner SOTY at CSS Award 2023</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp slow" data-wow-delay="0.2s">
                                    <div class="item pb-20 mb-20 bord-thin-bottom">
                                        <span class="date sub-color"><i
                                                class="fa-regular fa-clock mr-15 opacity-7"></i>2 days ago</span>
                                        <h6 class="sub-head">
                                            <a href="#0">Rebrand vs Reresh: 10 Minutes on Brand <br> with Hubfolio</a>
                                        </h6>
                                    </div>
                                    <div class="item pb-20 mb-20 bord-thin-bottom">
                                        <span class="date sub-color"><i
                                                class="fa-regular fa-clock mr-15 opacity-7"></i>15 days ago</span>
                                        <h6 class="sub-head">
                                            <a href="#0">How to build culture for young office?</a>
                                        </h6>
                                    </div>
                                    <div class="item pb-20 mb-20 bord-thin-bottom">
                                        <span class="date sub-color"><i
                                                class="fa-regular fa-clock mr-15 opacity-7"></i>1 month ago</span>
                                        <h6 class="sub-head">
                                            <a href="#0">Case Study: Crafting a UX Strategy for Compelling Messaging</a>
                                        </h6>
                                    </div>
                                    <div class="item pb-20 bord-thin-bottom">
                                        <span class="date sub-color"><i
                                                class="fa-regular fa-clock mr-15 opacity-7"></i>2 month ago</span>
                                        <h6 class="sub-head">
                                            <a href="#0">UI & UX: What is important?</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </section> --}}

        <!-- ==================== End Blog ==================== -->



        <!-- ==================== Start Contact ==================== -->

        {{-- <section class="contact-ca section-padding radius-20 mt-15 mb-15">
                            <div class="sec-head mb-80">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h2>Let’s Chat!</h2>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text">
                                            <p>We will ask the right questions, discuss possibilities and make an action
                                                plan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-form">
                                <form id="contact-form" method="post" action="contact.php">

                                    <div class="messages"></div>

                                    <div class="controls row">

                                        <div class="col-lg-6">
                                            <div class="form-group mb-30">
                                                <label for="form_name">Full Name <span class="star">*</span></label>
                                                <input id="form_name" type="text" name="name"
                                                    placeholder="Your full name" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-30">
                                                <label for="form_email">Email Address <span
                                                        class="star">*</span></label>
                                                <input id="form_email" type="email" name="email"
                                                    placeholder="Your email address" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-30">
                                                <label for="form_subject">Subject <span class="star">*</span></label>
                                                <input id="form_subject" type="text" name="subject"
                                                    placeholder="subject" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-30">
                                                <label for="form_budget">Your Budget <span
                                                        class="opt sub-color">(Optional)</span></label>
                                                <input id="form_budget" type="text" name="budget"
                                                    placeholder="A range of budget for project" required="required">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="form_message">Message</label>
                                                <textarea id="form_message" name="message"
                                                    placeholder="Write your message here..." rows="4"
                                                    required="required"></textarea>
                                            </div>
                                            <div class="mt-60">
                                                <button type="submit" class="butn butn-md butn-bord butn-rounded">
                                                    <span class="text">Send Your Message</span>
                                                    <span class="icon invert ml-10">
                                                        <img src="common/imgs/icons/arrow-top-right.svg" alt="">
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </section> --}}
    </form>
    <!-- ==================== End Contact ==================== -->
@endsection

@section('js')
    <!-- Cropper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        let cropper;
        let originalFile;

        const form = document.getElementById('uploadForm');
        const dragArea = document.getElementById('imageContainer');
        const fileInput = document.getElementById('photoInput');
        const fileTrigger = document.getElementById('fileTrigger');
        const image = document.getElementById('image');
        const defaultContent = dragArea.querySelector('.default-content');
        const cropControls = document.querySelector('.crop-controls');
        const removePhotoBtn = document.getElementById('removePhoto');
        const deleteBtn = document.querySelector('.deleteBtn');
        const existingPhoto = document.querySelector('.existing-photo');
        const cropX = document.getElementById('cropX');
        const cropY = document.getElementById('cropY');
        const cropWidth = document.getElementById('cropWidth');
        const cropHeight = document.getElementById('cropHeight');

        fileTrigger.addEventListener('click', () => fileInput.click());

        function handleFile(file) {
            if (file && file.type.startsWith('image/')) {
                originalFile = file;
                const reader = new FileReader();
                reader.onload = function(event) {
                    image.src = event.target.result;
                    image.style.display = 'block';
                    defaultContent.style.display = 'none';
                    cropControls.style.display = 'flex'; // Показываем описание и кнопку
                    if (existingPhoto) existingPhoto.style.display = 'none'; // Скрываем текущее фото

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(image, {
                        aspectRatio: 1 / 1,
                        viewMode: 1,
                        autoCropArea: 0.97,
                        scalable: false,
                        zoomable: false,
                        movable: true,
                        cropBoxResizable: true,
                        crop: function(event) {
                            const cropData = cropper.getData();
                            cropX.value = Math.round(cropData.x);
                            cropY.value = Math.round(cropData.y);
                            cropWidth.value = Math.round(cropData.width);
                            cropHeight.value = Math.round(cropData.height);
                        }
                    });
                };
                reader.readAsDataURL(file);
            }
        }

        // Удаление нового фото из формы
        removePhotoBtn.addEventListener('click', () => {
            if (cropper) {
                cropper.destroy();
            }
            image.src = '';
            image.style.display = 'none';
            defaultContent.style.display = 'block';
            cropControls.style.display = 'none';
            fileInput.value = '';
            cropX.value = '';
            cropY.value = '';
            cropWidth.value = '';
            cropHeight.value = '';
            if (existingPhoto) existingPhoto.style.display = 'block'; // Показываем текущее фото, если оно есть
        });

        // Удаление фото из базы данных
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => {
                if (confirm('{{ __('Are you sure you want to delete this image?') }}')) {
                    fetch('{{ route('photo.delete', $memorial->id) }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => {
                                    throw new Error(`Server error ${response.status}: ${text}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                existingPhoto.remove();
                                dragArea.style.display = 'block';
                            } else {
                                alert(data.message || 'Error deleting photo');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to delete photo: ' + error.message);
                        });
                }
            });
        }

        dragArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dragArea.classList.add('active');
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('active');
        });

        dragArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dragArea.classList.remove('active');
            const file = e.dataTransfer.files[0];
            handleFile(file);
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            handleFile(file);
        });

        // form.addEventListener('submit', (e) => {
        //     if (cropper) {
        //         const cropData = cropper.getData();
        //         cropX.value = Math.round(cropData.x);
        //         cropY.value = Math.round(cropData.y);
        //         cropWidth.value = Math.round(cropData.width);
        //         cropHeight.value = Math.round(cropData.height);
        //     }
        // });
    </script>
@endsection
