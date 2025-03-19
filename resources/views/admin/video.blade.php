@extends('layouts.admin')

@section('content')
    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>Video</h4>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="name" class="col-form-label text-md-end">{{ __('Full Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror"
                    name="birth_date" value="{{ old('birth_date') }}" required>
                @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="death_date" class="col-form-label text-md-end">{{ __('Date of Death') }}</label>
                <input id="death_date" type="date" class="form-control @error('death_date') is-invalid @enderror"
                    name="death_date" value="{{ old('death_date') }}">
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
        </div>
    </section>

    <!-- ==================== SAVE ==================== -->

    <section class="numbers-ca">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-60">
                    <button type="submit" class="butn butn-md butn-bord butn-rounded disabled">
                        <span class="text">Módosítások mentése</span>

                        <span class="icon ">
                            <i class="fa-regular fa-save"></i>
                        </span>

                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
