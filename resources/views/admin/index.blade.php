@extends('layouts.admin')

@section('content')
                        <!-- ==================== Start Process ==================== -->

                        <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
                            <div class="sec-head mb-40">
                                <div class="row">
                                    <div class="col-lg-12 md-mb15 md-mt35">
                                        <h4>Adatok szerkesztése</h4>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="text">
                                            <p>Business challenges are tough but we.

                                            </p>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="col-form-label text-md-end">{{ __('Full Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                    <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12 mb-3">
                                    <label for="death_date" class="col-form-label text-md-end">{{ __('Date of Death') }}</label>
                                    <input id="death_date" type="date" class="form-control @error('death_date') is-invalid @enderror" name="death_date" value="{{ old('death_date') }}">
                                    @error('death_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12">
                                    <label for="bio" class="col-form-label text-md-end">{{ __('Biography') }}</label>
                                    <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="7">{{ old('bio') }}</textarea>
                                    @error('bio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                        </section>

                        <!-- ==================== End Process ==================== -->



                        <!-- ==================== Start Numbers ==================== -->



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
