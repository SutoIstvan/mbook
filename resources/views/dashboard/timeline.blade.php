@extends('layouts.dashboard')

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
                    <div class="pt-30">
                        <div class="col-lg-8 mx-auto">
                            <p class="fs-5 mt-4 ">
                                Ezen az oldalon megadhatod a fontos eseményeit az időskálán. Válaszd ki az esemény
                                típusát, írd be a részleteket és a dátumot, majd kattints a 'Hozzáadás' gombra.
                            </p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-10 p-4 mt-30">

                        <div class="container">



                            <div class="row mb-3">
                                {{-- <div class="form-group col-12 col-md-12 mt-1">
                                        <select name="role" class="form-select" required>
                                            <option value="">{{ __('Select a life event') }}</option>
                                            <option value="father">{{ __('Father') }}</option>
                                            <option value="mother">{{ __('Mother') }}</option>
                                            <option value="partner">{{ __('Partner') }}</option>
                                            <option value="children">{{ __('Children') }}</option>
                                            <option value="siblings">{{ __('Siblings') }}</option>
                                            <option value="pets">{{ __('Pets') }}</option>
                                        </select>
                                    </div> --}}
                                {{-- <div class="form-group col-12 col-md-6 mt-1">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                                            required>
                                    </div> --}}

                                {{-- @dump($children) --}}


                                <select id="eventType" class="form-select">
                                    <option value="">Válassz</option>
                                    <option value="child_birth">Gyermek születése</option>
                                    <option value="marriage">Házasság</option>
                                    <option value="school">Iskola</option>
                                    <option value="work">Munkahely</option>
                                    <option value="hobby">Hobbija</option>
                                    {{-- <option value="favorite_music">Kedvenc zenéi</option> --}}
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

                            <!-- Форма школы (по умолчанию скрыта) -->
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

                            <!-- Форма work (по умолчанию скрыта) -->
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

                            <!-- Форма Hobby (по умолчанию скрыта) -->
                            <div id="hobbyForm" class="event-form" style="display: none;">
                                <form action="{{ route('timelines.addHobby') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="memorial_id" value="{{ $memorial->id }}">

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="text" name="hobby_name" class="form-control"
                                                placeholder="Munka neve" required>
                                        </div>
                                        {{-- <div class="col-md-6 mb-2">
                                                                <label for="hobby_date">hobby date from</label>
                            
                                                                <input type="date" name="hobby_date" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label for="hobby_date_to">hobby date to</label>
                                                                <input type="date" name="hobby_date_to" class="form-control" required>
                                                            </div> --}}
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


                {{-- <div class="container mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Dynamic Form Fields - Add & Remove Multiple Fields</h5>
                            <h6>Family Information</h6>
                        </div>
                        <div class="card-body">
                            <div id="relative_fields"></div>
                            <div class="row g-2">
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
                                        <button class="btn btn-success w-100" type="button" onclick="addRelative();">
                                            <span>+</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small>Press <span>+</span> to add another form field :)</small>,
                            <small>Press <span>-</span> to remove form field :)</small>
                        </div>

                    </div>
                </div> --}}
            </div>



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
