@extends('layouts.dashboard')

@section('css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
            background: rgba(255, 0, 0, 0.7); /* Полупрозрачный красный фон */
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s;
        }
    </style>
@endsection

@section('content')



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

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="col-form-label text-md-end">{{ __('Full Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $memorial->name) }}" required autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="birth_date" class="col-form-label text-md-end">{{ __('Date of Birth') }}</label>
                                    <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('name', $memorial->birth_date) }}" required>
                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12 mb-3">
                                    <label for="death_date" class="col-form-label text-md-end">{{ __('Date of Death') }}</label>
                                    <input id="death_date" type="date" class="form-control @error('death_date') is-invalid @enderror" name="death_date" value="{{ old('name', $memorial->death_date) }}">
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



                                <div class="container mt-25">
                                    <label for="photo" class="form-label">Fő emlékkép feltöltése</label>
                                    <div class="drag-area bg-dark text-white border-secondary">
                                        <!-- Если фото существует, отображаем его -->
                                        @if(isset($memorial->photo) && $memorial->photo)
                                            <img src="{{ asset('storage/images/memorials/' . $memorial->id . '/' . $memorial->photo) }}" alt="Фото">
                                            <button type="button" class="deleteBtn butn butn-md butn-danger butn-rounded">
                                                Kép törlése
                                            </button>
                                        @else
                                            <!-- Если фото нет, показываем стандартную форму загрузки -->
                                            <div class="icon">
                                                <i class="fas fa-images"></i>
                                            </div>
                                            <span class="header">Húzza ide a fényképet</span>
                                            <span class="header">vagy nyissa meg a </span>
                                            <div class="text-center mb-10 mt-10">
                                                <span class="button butn butn-md butn-bord butn-rounded">böngészőben</span>
                                            </div>
                                            <span class="support">Fényképformátum: JPEG, JPG, PNG</span>
                                        @endif
                                        <input name="photo" type="file" hidden />
    
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

                        <!-- ==================== End Contact ==================== -->
@endsection

@section('js')
<script>
    const dropArea = document.querySelector('.drag-area');
    const dragText = document.querySelector('.header');
    let button = dropArea.querySelector('.button');
    let input = dropArea.querySelector('input');
    let file;

    // Функция инициализации всех обработчиков событий
    function initializeEventListeners() {
        button = dropArea.querySelector('.button');
        input = dropArea.querySelector('input');

        // Если кнопка загрузки существует, назначаем обработчик
        if (button) {
            button.onclick = () => {
                input.click();
            };
        }

        // Обработчик для выбора файла
        input.addEventListener('change', function() {
            file = this.files[0];
            dropArea.classList.add('active');
            displayFile();
        });

        // Обработчики для drag-and-drop
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('active');
            dragText.textContent = 'Release to Upload';
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('active');
            dragText.textContent = 'Drag & Drop';
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            file = event.dataTransfer.files[0];
            displayFile();
        });

        // Обработчик для кнопки удаления фото
        const deleteBtn = dropArea.querySelector('.deleteBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => {
                resetDropArea();
            });
        }
    }

    // Инициализируем обработчики при загрузке страницы
    initializeEventListeners();

    // Функция для отображения загруженного файла
    function displayFile() {
        let fileType = file.type;
        let validExtensions = ['image/jpeg', 'image/jpg', 'image/png'];

        if (validExtensions.includes(fileType)) {
            let fileReader = new FileReader();

            fileReader.onload = () => {
                let fileURL = fileReader.result;
                dropArea.innerHTML = `
                    <img src="${fileURL}" alt="">
                    <button type="button" class="deleteBtn butn butn-md butn-danger butn-rounded">
                        Kép törlése
                    </button>
                    <span class="button"></span>
                    <input name="photo" type="file" hidden />
                `;

                // Переназначаем элементы
                button = dropArea.querySelector('.button');
                input = dropArea.querySelector('input');

                // Обработчик для кнопки удаления
                const deleteBtn = dropArea.querySelector('.deleteBtn');
                deleteBtn.addEventListener('click', () => {
                    resetDropArea();
                });

                // Восстанавливаем обработчик для кнопки выбора файла
                button.onclick = () => {
                    input.click();
                };

                // Устанавливаем файл в input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;
            };
            fileReader.readAsDataURL(file);
        } else {
            alert('This is not an Image File');
            dropArea.classList.remove('active');
        }
    }

    // Функция для сброса dropArea
    function resetDropArea() {
        dropArea.innerHTML = `
            <div class="icon">
                <i class="fas fa-images"></i>
            </div>
            <span class="header">Húzza ide a fényképet</span>
            <span class="header">vagy nyissa meg a </span>
            <div class="text-center mb-10 mt-10">
                <span class="button butn butn-md butn-bord butn-rounded">böngészőben</span>
            </div>
            <input name="photo" type="file" hidden/>
            <span class="support">Fényképformátum: JPEG, JPG, PNG</span>
        `;

        // Переназначаем элементы после сброса
        button = dropArea.querySelector('.button');
        input = dropArea.querySelector('input');

        // Восстанавливаем обработчик клика для кнопки выбора файла
        button.onclick = () => {
            input.click();
        };

        // Удаляем класс active
        dropArea.classList.remove('active');

        // Заново инициализируем все обработчики событий
        initializeEventListeners();
    }
</script>

@endsection