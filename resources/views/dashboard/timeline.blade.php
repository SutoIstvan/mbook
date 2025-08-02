@extends('layouts.dashboard')

@section('css')
    <style>
        .tracking-detail {
            padding: 3rem 0
        }

        #tracking {
            margin-bottom: 1rem
        }

        [class*=tracking-status-] p {
            margin: 0;
            font-size: 1.1rem;
            color: #fff;
            text-transform: uppercase;
            text-align: center
        }

        [class*=tracking-status-] {
            padding: 1.6rem 0
        }

        .tracking-status-intransit {
            background-color: #65aee0
        }

        .tracking-status-outfordelivery {
            background-color: #f5a551
        }

        .tracking-status-deliveryoffice {
            background-color: #f7dc6f
        }

        .tracking-status-delivered {
            background-color: #4cbb87
        }

        .tracking-status-attemptfail {
            background-color: #b789c7
        }

        .tracking-status-error,
        .tracking-status-exception {
            background-color: #d26759
        }

        .tracking-status-expired {
            background-color: #616e7d
        }

        .tracking-status-pending {
            background-color: #ccc
        }

        .tracking-status-inforeceived {
            background-color: #214977
        }

        .tracking-list {
            border: 1px solid #e5e5e5
        }

        .tracking-item {
            border-left: 1px solid #bff4ff;
            position: relative;
            padding: 2rem 1.5rem .5rem 2.5rem;
            font-size: .9rem;
            margin-left: 3rem;
            min-height: 5rem
        }

        .tracking-item:last-child {
            padding-bottom: 4rem
        }

        .tracking-item .tracking-date {
            margin-bottom: .5rem
        }

        .tracking-item .tracking-date span {
            color: #888;
            font-size: 85%;
            padding-left: .4rem
        }

        .tracking-item .tracking-content {
            padding: .5rem .8rem;
            /* background-color:#f4f4f4; */
            border-radius: .5rem;

        }

        .border {
            border: 0px #dee2e6 !important;
            padding: 20px 25px;
            border-radius: 6px;
            background: white;
            filter: drop-shadow(2px 1px 3px rgba(0, 0, 0, 0.1)) drop-shadow(0px 0px 1px rgba(0, 0, 0, 0.01));
        }

        .border:before {
            content: '';
            position: absolute;
            top: 10px;
            left: 0px;
            margin: 0 0 0 -8px;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid #fff;
        }

        .tracking-item .tracking-content span {
            display: block;
            color: #888;
            font-size: 85%
        }

        .tracking-item .tracking-icon {
            line-height: 2.6rem;
            position: absolute;
            left: -1.3rem;
            width: 2.7rem;
            height: 2.7rem;
            text-align: center;
            border-radius: 50%;
            font-size: 1.1rem;
            background-color: #fff;
            color: #fff
        }

        .tracking-item .tracking-icon.status-sponsored {
            background-color: #f68
        }

        .tracking-item .tracking-icon.status-delivered {
            background-color: #4cbb87
        }

        .tracking-item .tracking-icon.status-outfordelivery {
            background-color: #f5a551
        }

        .tracking-item .tracking-icon.status-deliveryoffice {
            background-color: #f7dc6f
        }

        .tracking-item .tracking-icon.status-attemptfail {
            background-color: #b789c7
        }

        .tracking-item .tracking-icon.status-exception {
            background-color: #d26759
        }

        .tracking-item .tracking-icon.status-inforeceived {
            background-color: #214977
        }

        .tracking-item .tracking-icon.status-intransit {
            /* color:#e5e5e5; */
            border: 1px solid #72dfe4;
            font-size: .6rem
        }

        @media(min-width:992px) {
            .tracking-item {
                margin-left: 10rem
            }

            .tracking-item .tracking-date {
                position: absolute;
                left: -10rem;
                width: 7.5rem;
                text-align: right
            }

            .tracking-item .tracking-date span {
                display: block
            }

            .tracking-item .tracking-content {
                padding: 0;
                background-color: transparent
            }
        }
    </style>
@endsection

@section('content')
    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Timeline') }}</h4>
                </div>
            </div>
        </div>

        <div class="">



            @if ($errors->any())
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-10 col-md-10 p-4">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="container">
                <div class=" text-secondary text-center">
                    <div class="pt-10">
                        <div class="col-lg-8 mx-auto">
                            <p class="fs-5">
                                {{ __('On this page you can enter your important events on a timeline. Select the event type, enter the details and date, then click the \'Add\' button.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>



            {{-- <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-10 p-4 mt-30">

                        <div class="container">



                            <div class="row mb-3">


                                <select id="eventType" class="form-select">
                                    <option value="">Válassz</option>
                                    <option value="child_birth">Gyermek születése</option>
                                    <option value="marriage">Házasság</option>
                                    <option value="school">Iskola</option>
                                    <option value="work">Munkahely</option>
                                    <option value="hobby">Hobbija</option>
                                    <option value="other_properties">Egyéb tulajdonságai</option>
                                </select>

                                <form action="{{ route('timelines.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                                    <div id="childrenInputs" class="mt-3" style="display: none;">
                                        <div id="existingChildren mt-4">
                                            @foreach ($children as $child)
                                                <input type="hidden" name="children[{{ $loop->index }}][id]"
                                                    value="{{ $child->id }}">

                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control"
                                                            name="children[{{ $loop->index }}][name]"
                                                            value="{{ $child->name }}" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="date" class="form-control"
                                                            name="children[{{ $loop->index }}][birth_date]"
                                                            value="{{ $child->birth_date }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div id="newChildren"></div>

                                        <button type="button" class="btn btn-outline-primary mt-2" id="addChild">+ Új
                                            gyermek
                                            hozzáadása</button>

                                        <button type="submit" class="btn btn-outline-primary mt-2">Hozzáadás</button>
                                </form>




                            </div>

                            <form action="{{ route('timelines.storeMarriage') }}" method="POST">
                                @csrf
                                <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                                <div id="marriageInputs" class="mt-3" style="display: none;">
                                    <div id="existingMarriages" class="mt-4">
                                        @foreach ($partners as $marriage)
                                            <input type="hidden" name="marriages[{{ $loop->index }}][id]"
                                                value="{{ $marriage->id }}">

                                            <div class="row mb-2">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        name="marriages[{{ $loop->index }}][name]"
                                                        value="{{ $marriage->name }}" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control"
                                                        name="marriages[{{ $loop->index }}][marriage_date]"
                                                        value="{{ $marriage->birth_date }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div id="newMarriages"></div>

                                    <button type="button" class="btn btn-outline-primary mt-2" id="addMarriage">+ Új
                                        házasság
                                        hozzáadása</button>
                                    <button type="submit" class="btn btn-outline-primary mt-2">Hozzáadás</button>
                                </div>
                            </form>

                            <div id="schoolForm" class="event-form" style="display: none;">
                                <form action="{{ route('timelines.addSchool') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="text" name="school_name" class="form-control"
                                                placeholder="Iskola neve" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="school_date">School date from</label>

                                            <input type="date" name="school_date" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="school_date_to">School date to</label>
                                            <input type="date" name="school_date_to" class="form-control" required>
                                        </div>
                                        <div class="col-md-12 mb-3 mt-3 text-center">
                                            <button type="submit" class="btn btn-outline-primary">Mentés</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="workForm" class="event-form" style="display: none;">
                                <form action="{{ route('timelines.addWork') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="text" name="work_name" class="form-control"
                                                placeholder="Munka neve" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="work_date">Work date from</label>

                                            <input type="date" name="work_date" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="work_date_to">Work date to</label>
                                            <input type="date" name="work_date_to" class="form-control" required>
                                        </div>
                                        <div class="col-md-12 mb-3 mt-3 text-center">
                                            <button type="submit" class="btn btn-outline-primary">Mentés</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="hobbyForm" class="event-form" style="display: none;">
                                <form action="{{ route('timelines.addHobby') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="text" name="hobby_name" class="form-control"
                                                placeholder="Munka neve" required>
                                        </div>

                                        <div class="col-md-12 mb-3 mt-3 text-center">
                                            <button type="submit" class="btn btn-outline-primary">Mentés</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>



                    <br><br>
                    @foreach ($timelines as $timeline)
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-10 col-md-10">
                                    <ul class="timeline-3">
                                        <li class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small>{{ $timeline->date }} </small>
                                                @if ($timeline->date_to)
                                                    <small>- {{ $timeline->date_to }}</small>
                                                @endif
                                                @if ($timeline->type)
                                                    - {{ __('aigenerate.timeline_types.' . $timeline->type) }}
                                                @endif
                                                <a>{{ $timeline->title }}</a>
                                            </div>

                                            <form action="{{ route('timelines.destroy', $timeline->id) }}" method="POST"
                                                onsubmit="return confirm('Biztosan törölni szeretnéd ezt az eseményt?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">Törlés</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div> --}}

            <form action="{{ route('timelines.newstore') }}" method="POST">
                @csrf

                <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">


                <div class="tracking-item mt-4">

                    <div class="tracking-icon status-intransit">


                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M7.43361 9.90622C5.34288 10.3793 4.29751 10.6158 4.04881 11.4156C3.8001 12.2153 4.51276 13.0487 5.93808 14.7154L6.30683 15.1466C6.71186 15.6203 6.91438 15.8571 7.00548 16.1501C7.09659 16.443 7.06597 16.759 7.00474 17.3909L6.94899 17.9662C6.7335 20.19 6.62575 21.3019 7.27688 21.7962C7.928 22.2905 8.90677 21.8398 10.8643 20.9385L11.3708 20.7053C11.927 20.4492 12.2052 20.3211 12.5 20.3211C12.7948 20.3211 13.073 20.4492 13.6292 20.7053L14.1357 20.9385C16.0932 21.8398 17.072 22.2905 17.7231 21.7962C18.3742 21.3019 18.2665 20.19 18.051 17.9662M19.0619 14.7154C20.4872 13.0487 21.1999 12.2153 20.9512 11.4156C20.7025 10.6158 19.6571 10.3793 17.5664 9.90622L17.0255 9.78384C16.4314 9.64942 16.1343 9.5822 15.8958 9.40114C15.6573 9.22007 15.5043 8.94564 15.1984 8.3968L14.9198 7.89712C13.8432 5.96571 13.3048 5 12.5 5C11.6952 5 11.1568 5.96571 10.0802 7.89712"
                                stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                            <path
                                d="M4.98987 2C4.98987 2 5.2778 3.45771 5.90909 4.08475C6.54037 4.71179 8 4.98987 8 4.98987C8 4.98987 6.54229 5.2778 5.91525 5.90909C5.28821 6.54037 5.01013 8 5.01013 8C5.01013 8 4.7222 6.54229 4.09091 5.91525C3.45963 5.28821 2 5.01013 2 5.01013C2 5.01013 3.45771 4.7222 4.08475 4.09091C4.71179 3.45963 4.98987 2 4.98987 2Z"
                                stroke="#24cdd5" stroke-linejoin="round" />
                            <path d="M18 5H20M19 6L19 4" stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                        </svg>

                    </div>

                    <div class="tracking-date defaultcolor fs-4 wow fadeIn text-end" data-wow-delay="300ms">
                        <select id="eventYear" name="year" class="form-select"
                            style="max-width: 90px; overflow-y: auto;" required>
                            <option value=""></option>
                            @for ($year = date('Y'); $year >= 1900; $year--)
                                <option value="{{ $year }}"
                                    {{ old('year', date('Y')) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                        {{-- <span class="fs-6">m d</span> --}}
                    </div>
                    <div class="border">
                        <div class="tracking-content defaultcolor fs-6">
                            <select name="type" class="form-select">
                                <option value="">{{ __('Select event type') }}</option>
                                <option value="child_birth">{{ __('Child Birth') }}</option>
                                <option value="marriage">{{ __('Marriage') }}</option>
                                <option value="school">{{ __('School') }}</option>
                                <option value="work">{{ __('Work') }}</option>
                                <option value="hobby">{{ __('Hobby') }}</option>
                                <option value="other_properties">{{ __('Other Properties') }}</option>
                            </select>

                            <span>
                                <span class="pt-2 fs-6">
                                    <div class="mb-2">
                                        <input type="text" name="title" class="form-control"
                                            placeholder="{{ __('Enter timeline details') }}" required="">
                                    </div>
                                </span>
                            </span>

                            <button type="submit" class="btn btn-outline-primary mt-2">{{ __('Add') }}</button>

                        </div>

                    </div>
                </div>
            </form>

            @foreach ($timelines as $timeline)
                <div class="tracking-item ">

                    <div class="tracking-icon status-intransit">

                        @if ($timeline->type == 'marriage')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M8.96173 18.9109L9.42605 18.3219L8.96173 18.9109ZM12 5.50063L11.4596 6.02073C11.601 6.16763 11.7961 6.25063 12 6.25063C12.2039 6.25063 12.399 6.16763 12.5404 6.02073L12 5.50063ZM15.0383 18.9109L15.5026 19.4999L15.0383 18.9109ZM7.00061 16.4209C6.68078 16.1577 6.20813 16.2036 5.94491 16.5234C5.68169 16.8432 5.72758 17.3159 6.04741 17.5791L7.00061 16.4209ZM2.34199 13.4115C2.54074 13.7749 2.99647 13.9084 3.35988 13.7096C3.7233 13.5108 3.85677 13.0551 3.65801 12.6917L2.34199 13.4115ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55954 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219ZM9.42605 18.3219C8.63014 17.6945 7.82129 17.0963 7.00061 16.4209L6.04741 17.5791C6.87768 18.2624 7.75472 18.9144 8.49742 19.4999L9.42605 18.3219ZM3.65801 12.6917C3.0968 11.6656 2.75 10.5033 2.75 9.1371H1.25C1.25 10.7746 1.66995 12.1827 2.34199 13.4115L3.65801 12.6917Z"
                                    fill="#24cdd5" />
                            </svg>
                        @endif

                        @if ($timeline->type == 'school')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M9.78272 3.49965C11.2037 2.83345 12.7962 2.83345 14.2172 3.49965L20.9084 6.63664C22.3639 7.31899 22.3639 9.68105 20.9084 10.3634L14.2173 13.5003C12.7963 14.1665 11.2038 14.1665 9.78281 13.5003L3.0916 10.3634C1.63613 9.68101 1.63614 7.31895 3.0916 6.63659L6 5.27307"
                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M2 8.5V14" stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M12 21C10.204 21 7.8537 19.8787 6.38533 19.0656C5.5035 18.5772 5 17.6334 5 16.6254V11.5M19 11.5V16.6254C19 17.6334 18.4965 18.5772 17.6147 19.0656C17.0843 19.3593 16.4388 19.6932 15.7459 20"
                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        @endif

                        @if ($timeline->type == 'child_birth')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M8.00012 16.6066C9.1493 17.4664 10.5185 17.9874 12 17.9998C16.142 18.0343 19.5937 14.0798 19.5603 9.8043C19.5268 5.52875 16.142 2.03476 12 2.00026C7.858 1.96576 4.52734 5.4038 4.56077 9.67936C4.56976 10.8295 4.81252 11.9605 5.24326 13"
                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M15.5 9C15.4867 7.35641 14.1436 6.01326 12.5 6" stroke="#24cdd5"
                                    stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M12 20.3502C12.3212 20.3502 12.4818 20.3502 12.5933 20.3283C13.2466 20.1999 13.6441 19.5557 13.4511 18.9384C13.4181 18.833 13.342 18.6962 13.1896 18.4227M12 20.3502C11.6788 20.3502 11.5182 20.3502 11.4067 20.3283C10.7534 20.1999 10.3559 19.5557 10.5489 18.9384C10.5819 18.833 10.658 18.6962 10.8104 18.4227M12 20.3502V22.5"
                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        @endif

                        @if ($timeline->type == 'work')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M2 14C2 10.2288 2 8.34315 3.17157 7.17157C4.34315 6 6.22876 6 10 6H14C17.7712 6 19.6569 6 20.8284 7.17157C21.4816 7.82475 21.7706 8.69989 21.8985 10M22 14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22878 22 4.34314 22 3.17157 20.8284C2.51839 20.1752 2.22937 19.3001 2.10149 18"
                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M16 6C16 4.11438 16 3.17157 15.4142 2.58579C14.8284 2 13.8856 2 12 2C10.1144 2 9.17157 2 8.58579 2.58579C8 3.17157 8 4.11438 8 6"
                                    stroke="#24cdd5" stroke-width="1.5" />
                                <path
                                    d="M17 9C17 9.55228 16.5523 10 16 10C15.4477 10 15 9.55228 15 9C15 8.44772 15.4477 8 16 8C16.5523 8 17 8.44772 17 9Z"
                                    fill="#24cdd5" />
                                <path
                                    d="M9 9C9 9.55228 8.55228 10 8 10C7.44772 10 7 9.55228 7 9C7 8.44772 7.44772 8 8 8C8.55228 8 9 8.44772 9 9Z"
                                    fill="#24cdd5" />
                            </svg>
                        @endif

                        @if ($timeline->type == 'hobby')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"
                                fill="none">
                                <circle cx="14.5" cy="4.5" r="2.5" stroke="#24cdd5" stroke-width="1.5" />
                                <path
                                    d="M19 21.9959V18.0489C19 16.273 17.395 14.9199 15.6265 15.2047M7.94806 13.4348L7.92328 13.4109C6.88143 12.404 7.6864 10.7852 8.5932 10.1427C9.5 9.50016 13.3451 8.50016 13.3451 13.4345C13.3451 15.1273 12.8704 16.7131 12.0433 18.0489M5 22.0003C6.46053 22.0003 7.82003 21.6256 9 20.9679"
                                    stroke="#24cdd5" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        @endif


                        <!-- <i class="fas fa-circle"></i> -->
                    </div>

                    <div class="tracking-date defaultcolor fs-4 wow fadeIn" data-wow-delay="300ms">
                        {{ \Carbon\Carbon::parse($timeline->date)->format('Y') }}<span
                            class="fs-6">{{ \Carbon\Carbon::parse($timeline->date)->format('M d') }}</span>
                    </div>
                    <div class="border p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- Левая часть: заголовок + подзаголовок --}}
                            <div class="tracking-content defaultcolor fs-6">
                                <div class="fw-semibold">
                                    {{ __('aigenerate.timeline_types.' . $timeline->type) }}
                                </div>
                                @if ($timeline->title)
                                    <span class="pt-2 fs-6">
                                        {{ $timeline->title }}
                                    </span>
                                @endif
                            </div>

                            {{-- Правая часть: кнопка удаления --}}
                            <form action="{{ route('timelines.destroy', $timeline->id) }}" method="POST"
                                onsubmit="return confirm('Biztosan törölni szeretnéd ezt az eseményt?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach


    </section>

    <!-- ==================== SAVE BUTTON ==================== -->

    {{-- <section class="numbers-ca">
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
        </div>
    </section> --}}




@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eventType = document.getElementById('eventType');
            const childrenInputs = document.getElementById('childrenInputs');
            const addChildBtn = document.getElementById('addChild');
            const newChildrenContainer = document.getElementById('newChildren');
            let newChildIndex = 0;

            const marriageInputs = document.getElementById('marriageInputs');
            const addMarriageBtn = document.getElementById('addMarriage');
            const newMarriagesContainer = document.getElementById('newMarriages');
            let marriageIndex = 0;

            const schoolForm = document.getElementById('schoolForm'); // Форма для школы
            const schoolInputs = document.getElementById('schoolInputs');
            const addSchoolBtn = document.getElementById('addSchool');
            const newSchoolContainer = document.getElementById('newSchool');
            let schoolIndex = 0;

            const workForm = document.getElementById('workForm'); // Форма для школы
            const workInputs = document.getElementById('workInputs');
            const addWorkBtn = document.getElementById('addWork');
            const newWorkContainer = document.getElementById('newWork');
            let workIndex = 0;

            const hobbyInputs = document.getElementById('hobbyInputs');
            const addHobbyBtn = document.getElementById('addHobby');
            const newHobbyContainer = document.getElementById('newHobby');
            let hobbyIndex = 0;

            // Слушатель для изменения значения в селекте
            eventType.addEventListener('change', function() {
                const selected = this.value;

                console.log("Selected event type:", selected); // Тест для проверки, что срабатывает

                // Скрытие или отображение форм в зависимости от выбора
                childrenInputs.style.display = selected === 'child_birth' ? 'block' : 'none';
                marriageInputs.style.display = selected === 'marriage' ? 'block' : 'none';
                schoolForm.style.display = selected === 'school' ? 'block' :
                    'none'; // Отображение формы школы

                workForm.style.display = selected === 'work' ? 'block' : 'none'; //
                // schoolInputs.style.display = selected === 'school' ? 'block' : 'none';
                hobbyForm.style.display = selected === 'hobby' ? 'block' : 'none'; //

                hobbyInputs.style.display = selected === 'hobby' ? 'block' : 'none';
            });

            // Добавление новой записи о ребенке
            addChildBtn.addEventListener('click', function() {
                const row = document.createElement('div');
                row.classList.add('row', 'mb-2');
                row.innerHTML = `
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="new_children[${newChildIndex}][name]" placeholder="Gyermek neve">
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-control" name="new_children[${newChildIndex}][birth_date]">
                        </div>
                    `;
                newChildrenContainer.appendChild(row);
                newChildIndex++;
            });

            // Добавление новой записи о браке
            if (addMarriageBtn) {
                addMarriageBtn.addEventListener('click', function() {
                    const row = document.createElement('div');
                    row.classList.add('row', 'mb-2');
                    row.innerHTML = `
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="new_marriages[${marriageIndex}][partner_name]" placeholder="Partner neve">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="new_marriages[${marriageIndex}][marriage_date]">
                            </div>
                        `;
                    newMarriagesContainer.appendChild(row);
                    marriageIndex++;
                });
            }

            // Добавление новой записи о школе
            if (addSchoolBtn) {
                addSchoolBtn.addEventListener('click', function() {
                    const row = document.createElement('div');
                    row.classList.add('row', 'mb-2');
                    row.innerHTML = `
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="new_schools[${schoolIndex}][school_name]" placeholder="Iskola neve">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="new_schools[${schoolIndex}][start_date]">
                            </div>
                        `;
                    newSchoolContainer.appendChild(row);
                    schoolIndex++;
                });
            }

            // Добавление новой записи о хобби
            if (addHobbyBtn) {
                addHobbyBtn.addEventListener('click', function() {
                    const row = document.createElement('div');
                    row.classList.add('row', 'mb-2');
                    row.innerHTML = `
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="new_hobbies[${hobbyIndex}][hobby_name]" placeholder="Hobbi neve">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="new_hobbies[${hobbyIndex}][start_date]">
                            </div>
                        `;
                    newHobbyContainer.appendChild(row);
                    hobbyIndex++;
                });
            }

        });
    </script>

    <script>
        let relativeCount = 1;

        function addRelative() {
            relativeCount++;
            const objTo = document.getElementById('relative_fields');
            const divtest = document.createElement("div");
            divtest.setAttribute("class", `row g-2 removeclass${relativeCount}`);
            const rdiv = `removeclass${relativeCount}`;
            divtest.innerHTML = `
        <div class="col-md-4 mt-3">
          <div class="form-group">
            <select class="form-select" name="role[]">
              <option value="">Select Role</option>
              <option value="Parent">Parent</option>
              <option value="Brother">Brother</option>
              <option value="Children">Children</option>
            </select>
          </div>
        </div>
        <div class="col-md-4 mt-3">
          <div class="form-group">
            <input type="text" class="form-control" name="name[]" placeholder="Name">
          </div>
        </div>
        <div class="col-md-3 mt-3">
          <div class="form-group">
            <input type="date" class="form-control" name="dateFrom[]" placeholder="From">
          </div>
        </div>

        <div class="col-md-1 mt-3">
          <div class="form-group">
            <button class="btn btn-danger w-100" type="button" onclick="removeRelative(${relativeCount});">
              <span>-</span>
            </button>
          </div>
        </div>`;

            objTo.appendChild(divtest);
        }

        function removeRelative(rid) {
            const element = document.querySelector(`.removeclass${rid}`);
            if (element) {
                element.remove();
            }
        }
    </script>
@endsection
