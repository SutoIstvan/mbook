@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.codelink') }}" class="mt-2 mb-15">
        @csrf
        <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
            <div class="sec-head mb-40">
                <div class="row">
                    <div class="col-lg-12 md-mb15 md-mt35">
                        <h4>{{ __('Link QR Code to Memorial Page') }}</h4>
                    </div>
                </div>
            </div>

            <div class="">
                <!-- Сообщения об успехе или ошибке -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                        @if (session('file_path'))
                            <br>
                            <a href="{{ route('download.qrcodes', ['filename' => basename(session('file_path'))]) }}"
                                target="_blank">Download QR codes file</a>
                        @endif
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Форма для привязки QR-кода к мемориальной странице -->

                <div class="mb-3">
                    <label for="token" class="form-label">Token</label>
                    <input type="text" class="form-control" id="token" name="token" value="{{ old('token') }}"
                        required>
                    @error('token')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="memorial_id" class="form-label">Memorial ID</label>
                    <input type="text" class="form-control" id="memorial_id" name="memorial_id"
                        value="{{ old('memorial_id') }}" required>
                    @error('memorial_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <button type="submit" class="btn btn-success">Link QR Code</button> --}}
            </div>


        </section>

        <!-- ==================== SAVE ==================== -->

        <section class="numbers-ca">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mt-60">
                        <button type="submit" class="butn butn-md butn-bord butn-rounded disabled">
                            <span class="text">{{ __('Link QR Code') }}</span>

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
