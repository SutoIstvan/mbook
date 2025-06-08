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
                            <td><a href="{{ route('memorial.show', $memorial->slug) }}">{{ $memorial->name }}</a></td>
                            <td>{{ $memorial->birth_date }}</td>
                            <td>
                                <a href="{{ route('dashboard.edit', $memorial->slug) }}" class="btn btn-sm btn-primary" title="{{ __('Edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.destroy', $memorial->slug) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this memorial?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ __('Delete') }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>

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
