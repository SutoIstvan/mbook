@extends('layouts.home')

@section('title', 'Kapcsolat - Rememus.com')

@section('css')
    <style>
        .contact-hed .caption h1 {
        font-size: 120px;
        font-weight: 600;
        text-transform: uppercase; }

        .contact-hed .google-map {
        height: 540px;
        width: 100%;
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
        border-radius: 15px;
        overflow: hidden; }
        .contact-hed .google-map iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%; }

        .contact-pg input,
        .contact-pg textarea {
        width: 100%;
        border: 0;
        border-bottom: 1px solid rgba(14, 14, 14, 0.2);
        background: transparent;
        color: #282828;
        padding: 15px 0;
        -webkit-transition: all .4s;
        -o-transition: all .4s;
        transition: all .4s; }
        .contact-pg input:focus,
        .contact-pg textarea:focus {
            border-color: #959595; }

        .contact-pg textarea {
        min-height: 180px; }

        .contact-pg .butn:hover {
        background: var(--main-color) !important; }





    </style>
@endsection

@section('content')

    {{-- <header class="pricing-hed">
        <div class="container section-padding bord-thin-bottom-light">
            <div class="caption text-center">
                <h1>Kapcsolat</h1>
            </div>
        </div>
    </header> --}}

        <!-- ==================== Start Header ==================== -->

        <header class=" bg-img" data-background="home/imgs/intro/5.png" data-overlay-dark="4" style="padding: 130px 0;">

        </header>
    
        <!-- ==================== End Header ==================== -->



    <section class="contact-pg section-padding" style="background-color: #fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 valign">
                    <div class="full-width md-mb80">
                        <div class="sec-head md-mb80">
                            <h2 class="text-u">
                                Kérdésed van? <br> hívj  <span class="fw-200">
                                    nyugodtan!</span>
                            </h2>
                            <p class="mt-20 mb-20">Ha szeretne velünk dolgozni, vagy csak kapcsolatba lépni velünk, írjon nekünk bátran!</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="morinfo mt-30">
                                        <h6 class="mb-15">Cím</h6>
                                        <p>Budapest, Fehérvári út 84/A, 1117</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="morinfo mt-30">
                                        <h6 class="mb-15">Email</h6>
                                        <p>info@rememus.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="phone fz-30 fw-600 mt-30 underline main-color">
                                <a href="#0" style="    color: black;">+36 20 841 25</a>
                            </div>
                        </div>
                        <ul class="rest social-text d-flex mt-60 fz-16">
                            <li class="mr-30">
                                <a href="#0" class="hover-this"><span class="hover-anim">Facebook</span></a>
                            </li>
                            <li class="mr-30">
                                <a href="#0" class="hover-this"><span class="hover-anim">Twitter</span></a>
                            </li>
                            <li class="mr-30">
                                <a href="#0" class="hover-this"><span class="hover-anim">LinkedIn</span></a>
                            </li>
                            <li>
                                <a href="#0" class="hover-this"><span
                                        class="hover-anim">Instagram</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 valign">
                    <div class="full-width">
                        <div class="sec-head mb-50">
                            <h6 class=" mt-45">Üzenet <span class="fw-200">küldése</span></h6>
                        </div>
                        <form id="contact-form" method="post" action="contact.php">

                            <div class="messages"></div>

                            <div class="controls row">

                                <div class="col-lg-6">
                                    <div class="form-group mb-30">
                                        <input id="form_name" type="text" name="name" placeholder="Név"
                                            required="required">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-30">
                                        <input id="form_email" type="email" name="email" placeholder="Email"
                                            required="required">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-30">
                                        <input id="form_subject" type="text" name="subject"
                                            placeholder="Téma">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea id="form_message" name="message" placeholder="Üzenet"
                                            rows="3" required="required"></textarea>
                                    </div>
                                    <div class="mt-30">
                                        <button type="submit" class="butn butn-md butn-bord butn-rounded">
                                            <div class="d-flex align-items-center">
                                                <span>Üzenet küldése</span>
                                                <span class="icon ml-10">
                                                    <img src="../common/imgs/icons/arrow-top-right.svg"
                                                        alt="">
                                                </span>
                                            </div>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
