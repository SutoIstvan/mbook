@extends('layouts.admin')

@section('content')
    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Memorial List') }}</h4>
                </div>
            </div>
        </div>

        <div class="">
            @if ($memorials->isEmpty())
            <p>{{ __('No memorials found.') }}</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Memorial Name') }}</th>
                        <th>{{ __('Birth date') }}</th>
                        <th>{{ __('Edit link') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($memorials as $memorial)
                        <tr>
                            <td>{{ $memorial->id }}</td>
                            <td>{{ $memorial->name }}</td>
                            <td>{{ $memorial->birth_date }}</td>
                            <td><a href="{{ route('dashboard.edit', $memorial->slug) }}">{{ __('Edit') }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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
