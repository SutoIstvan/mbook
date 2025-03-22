@extends('layouts.dashboard')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

    <style>
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
<form action="{{ route('dashboard.video.upload', $memorial->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Video') }}</h4>
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
            <section class="intro-vid mt-100 pt-50">
                <div class="container col-9 mt-30">
                            @if (!empty($memorial->photos))
                        <div class="bg-img" style="height: 400px" data-background="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photos) }}">
                            @else
                            <div class="bg-img" style="height: 400px"
                                    data-background="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photo) }}">
                            @endif
                            <div class="play-button">
                                <a href="{{ $memorial->video }}" class="vid">
                                    <i class="fas fa-play fa-inverse"></i>
                                </a>
                            </div>
                        </div>
                </div>
            </section>
            <!-- ==================== End Intro-vid ==================== -->


            <div class="container">
                <div class="row d-flex justify-content-center">

                    <div class="col-12 col-md-12 p-3">
                        <div class="container">
                            <div class="row">
                                <div class="mt-50">
                                    <label for="video" class="form-label ">Videó egyedi URL</label>
                                    <input type="text" name="video" id="video" class="form-control py-2"
                                        value="{{ $memorial->video }}">
                                    <small class="text-muted">Ha üresen hagyja, akkor a videó nem lesz megjelenítve</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-12 p-3">
                        <div class="container">
                            <div class="row">
                                <div class="mt-50">
                                    <label for="video_photos" class="form-label">Videó kép (opcionális)</label>
                                    <input type="file" name="video_photos" id="video_photos" class="form-control py-2">
                                    <small class="text-muted">
                                        Alapértelmezés szerint a videó blokk háttérképe az emlékoldal fő képe.
                                        Itt külön képet tölthetsz fel a videó előnézetéhez, ha szeretnéd testreszabni.
                                    </small>
                                </div>
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
@endsection
