@extends('layouts.admin')

@section('content')

    <form method="POST" action="{{ route('generate.qrcodes') }}" class="mt-2 mb-15">
        @csrf


        <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
            <div class="sec-head mb-40">
                <div class="row">
                    <div class="col-lg-12 md-mb15 md-mt35">
                        <h4>{{ __('Qr code generate') }}</h4>
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

                <!-- Форма -->

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1"
                        required>
                    @error('quantity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">

                    <label for="mod" class="form-label">Mód</label>
                    <select class="form-select" id="mod" name="mod" required>
                        <option value="1">Gyártásra generált</option>
                        <option value="2">Első fizikai internetes vásárlás</option>
                        <option value="3">További fizikai vásárlás az oldalon</option>
                        <option value="4">Neten digitális első</option>
                        <option value="5">Neten digitális további</option>
                        <option value="5">Reputációs</option>
                    </select>
                    @error('mod')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select class="form-select" id="country" name="country" required>
                        <option value="1">Magyarország</option>
                        <option value="2">Slovákia</option>
                        <option value="3">Románia</option>
                        <option value="4">Finnország</option>
                        <option value="5">Csehország</option>
                    </select>
                    @error('country')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                {{-- <button type="submit" class="btn btn-primary">Generate QR Codes</button> --}}

            </div>


        </section>

        <!-- ==================== SAVE ==================== -->

        <section class="numbers-ca">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mt-60">
                        <button type="submit" class="butn butn-md butn-bord butn-rounded disabled">
                            <span class="text">{{ __('Generate QR Codes') }}</span>

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
