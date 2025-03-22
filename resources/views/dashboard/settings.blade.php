@extends('layouts.dashboard')

@section('content')
<form action="{{ route('dashboard.settings.update', $memorial) }}" method="POST">
    @csrf
    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Settings') }}</h4>
                </div>
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
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="">

            {{-- <div class="row mb-3">
                <div class="col-md-12">
                    <label class="col-form-label text-md-end">{{ __('Private') }}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="private" name="private" {{ old('private', $memorial->private) ? 'checked' : '' }}>
                        <label class="form-check-label" for="private">{{ __('Private') }}</label>
                    </div>
                    <small class="text-muted">
                        {{ __('Make this private') }}
                    </small>
                </div>
            </div> --}}

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="col-form-label text-md-end">{{ __('Private') }}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="private" name="private" {{ old('private', $memorial->history) ? 'checked' : '' }}>
                        <label class="form-check-label" for="private">{{ __('Private') }}</label>
                    </div>
                    <small class="text-muted">
                        {{ __('Make this private') }}
                    </small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="slug" class="col-form-label text-md-end">{{ __('Slug') }}</label>
                    <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $memorial->slug) }}" required>
                    @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="text-muted">
                        Egyedi URL az emlékoldalhoz. Csak kisbetűket, számokat és kötőjeleket használj. Ha üresen hagyod, automatikusan generálódik
                    </small>
                </div>
            </div>
            

            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="map_address" class="col-form-label text-md-end">{{ __('Address on Map') }}</label>
                    <input id="map_address" type="text" class="form-control @error('map_address') is-invalid @enderror" name="map_address" value="{{ old('map_address', $memorial->story) }}">
                    @error('map_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="text-muted">
                        Add meg a pontos Google koordinátákat, hogy az emlékhely könnyen megtalálható legyen a Google Térképen.
                    </small>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="col-form-label text-md-end">{{ __('Theme') }}</label>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="col-5">
                            <label class="theme-option">
                                <img src="{{ asset('light.png') }}" style="border-radius: 15px" alt="Light Theme" class="theme-thumbnail">
                                <span class="mt-2">
                                    <input type="radio" name="theme" value="light" id="lightTheme" {{ $memorial->testimonials === 'light' ? 'checked' : '' }}>
                                    {{ __('Light Theme') }}
                                </span>
                            </label>
                        </div>
        
                        <div class="col-5">
                            <label class="theme-option">
                                <img src="{{ asset('dark.png') }}" style="border-radius: 15px" alt="Dark Theme" class="theme-thumbnail">
                                <span class="mt-2">
                                    <input type="radio" name="theme" value="dark" id="darkTheme" {{ $memorial->testimonials === 'dark' ? 'checked' : '' }}>
                                    {{ __('Dark Theme') }}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <div class="row mb-3 mt-50">
                <div class="col-md-12">
                    <form action="" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this page?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">{{ __('Delete Page') }}</button>
                    </form>
                </div>
            </div> --}}
        </div>


    </section>

    <!-- ==================== SAVE ==================== -->

    <section class="numbers-ca mb-20">
        <div class="row">
            <div class="col-lg-6">
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
        </div>
    </section>
</form>


@endsection
