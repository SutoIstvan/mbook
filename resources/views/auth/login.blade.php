@extends('layouts.home')

@section('css')
<style>
.navbar {
    mix-blend-mode: difference !important;
}
.icon {
    color: #fff;
}
</style>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="info about-ca">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                    <div class="card-body">
                        <div class="mt-120 text-center">
                            <h5>{{ __('Register account') }}</h5>
                            <div>

                            </div>
                            <p class="px-1 mt-2">
                                {{ __('If you have never registred a rememus sing before, please register first.') }}
                            </p>
                        </div>
                        <div class="mt-30 text-center">
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                {{ __('Register') }}
                            </a>
                        </div>

                        <div class="form-group row mb-0 mt-4 text-center">
                            <div class="col-md-12 ">
                                <a href="{{ route('auth.google') }}" class="btn btn-primary">
                                    <i class="fab fa-google"></i>
                                    Google
                                </a>
                            </div>
                        </div>

                        <div class="mt-50 text-center">
                            <h5>{{ __('Login to account') }}</h5>
                            <p class="px-4 mt-2">
                                {{ __('if you have already registered an account please login here') }}
                            </p>

                        </div>


                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3 mt-30">
                                {{-- <label for="email" class="col-md-12 col-form-label">{{ __('Email Address') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required
                                        autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="{{ __('Password') }}" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            <small>
                                                {{ __('Remember Me') }}
                                            </small>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0 mt-30">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="col-md-12 mt-2 text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
