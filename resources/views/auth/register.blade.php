@extends('layouts.home')

@section('title', __('Register account') . ' - rememus.com')


@section('css')
    <style>
        body {
            background-color: #f7f7f7 !important;
        }

        .navbar {
            mix-blend-mode: difference !important;
        }

        .icon {
            color: #fff;
        }
    </style>
@endsection

@section('content')

    <section class="vh-100" style="">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h5 class="mb-5">{{ __('Register account') }}</h5>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    
                                    <div data-mdb-input-init class="form-outline mb-4 mt-4">
                                        <input id="name" type="name"
                                            class="form-control form-control-lg fs-6 rounded-pill @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" style="padding: 12px 15px 12px 15px;"
                                            placeholder="{{ __('Name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4 mt-4">
                                        <input id="email" type="email"
                                            class="form-control form-control-lg fs-6 rounded-pill @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" style="padding: 12px 15px 12px 15px;"
                                            placeholder="{{ __('Email Address') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input id="password" type="password"
                                            class="form-control form-control-lg fs-6 rounded-pill @error('password') is-invalid @enderror"
                                            name="password" placeholder="{{ __('Password') }}"
                                            style="padding: 12px 15px 12px 15px;" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input id="password-confirm" type="password"
                                            class="form-control form-control-lg fs-6 rounded-pill @error('password') is-invalid @enderror"
                                            name="password_confirmation" placeholder="{{ __('Confirm Password') }}"
                                            style="padding: 12px 15px 12px 15px;" required autocomplete="current-password">

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>




                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill"
                                            style="padding: 12px 15px 12px 15px;">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </form>

                            <hr class="mt-4 mb-3">

                            <div class="col-md-12 mt-3">
                                <a href="{{ route('auth.google') }}" class="btn btn-secondary w-100 rounded-pill"
                                    style="padding: 12px 15px 12px 15px; background-color: #b7b7b7;">
                                    <i class="fab fa-google"></i>
                                    Google
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
