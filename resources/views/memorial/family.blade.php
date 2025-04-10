@extends('layouts.memorial')

@section('content')
    <div class="container">
        <h2>Добавить члена семьи к мемориалу: {{ $memorial->name }}</h2>

        <form action="{{ route('family.store', $memorial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Отец --}}
            <div class="row mb-4">
                <div class="form-group col-4">
                    <label>Имя отца</label>
                    <input type="text" name="family[father][name]" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>Дата рождения</label>
                    <input type="date" name="family[father][birth_date]" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>Фото</label>
                    <input type="file" name="family[father][photo]" class="form-control" accept="image/*">
                </div>
                <input type="hidden" name="family[father][role]" value="father">
            </div>

            {{-- Мать --}}
            <div class="row mb-4">
                <div class="form-group col-4">
                    <label>Имя матери</label>
                    <input type="text" name="family[mother][name]" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>Дата рождения</label>
                    <input type="date" name="family[mother][birth_date]" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>Фото</label>
                    <input type="file" name="family[mother][photo]" class="form-control" accept="image/*">
                </div>
                <input type="hidden" name="family[mother][role]" value="mother">
            </div>

            {{-- Один партнёр по умолчанию --}}
            <div id="partners-container">
                <div class="row mb-3">
                    <div class="form-group col-4">
                        <label>Имя партнёра</label>
                        <input type="text" name="family[partners][0][name]" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label>Дата рождения</label>
                        <input type="date" name="family[partners][0][birth_date]" class="form-control">
                    </div>
                    <div class="form-group col-3">
                        <label>Фото</label>
                        <input type="file" name="family[partners][0][photo]" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="partner_role_0">Роль</label>
                        <select name="family[partners][0][role]" id="partner_role_0" class="form-control" required>
                            <option value="">Выберите роль</option>
                            <option value="муж">Муж</option>
                            <option value="жена">Жена</option>
                            <option value="партнёр">Партнёр</option>
                            <option value="бывший партнёр">Бывший партнёр</option>
                            <option value="иное">Иное</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary mb-4" onclick="addPartner()">Добавить ещё
                партнёра</button>

            {{-- Один ребёнок по умолчанию --}}
            <div id="children-container">
                <div class="row mb-3">
                    <div class="form-group col-4">
                        <label>Имя ребёнка</label>
                        <input type="text" name="family[children][0][name]" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label>Дата рождения</label>
                        <input type="date" name="family[children][0][birth_date]" class="form-control">
                    </div>
                    <div class="form-group col-3">
                        <label>Фото</label>
                        <input type="file" name="family[children][0][photo]" class="form-control" accept="image/*">
                    </div>
                    <input type="hidden" name="family[children][0][role]" value="child">
                </div>
            </div>
            <button type="button" class="btn btn-outline-success mb-4" onclick="addChild()">Добавить ещё ребёнка</button>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

        <script>
            let partnerIndex = 1;
            let childIndex = 1;

            function addPartner() {
                const container = document.getElementById('partners-container');
                container.insertAdjacentHTML('beforeend', `
                <div class="row mb-3">
                    <div class="form-group col-4">
                        <label>Имя партнёра</label>
                        <input type="text" name="family[partners][${partnerIndex}][name]" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label>Дата рождения</label>
                        <input type="date" name="family[partners][${partnerIndex}][birth_date]" class="form-control">
                    </div>
                    <div class="form-group col-3">
                        <label>Фото</label>
                        <input type="file" name="family[partners][${partnerIndex}][photo]" class="form-control" accept="image/*">
                    </div>
                        <label for="partner_role_0">Роль</label>
                        <select name="family[partners][${partnerIndex}][role]" id="partner_role_0" class="form-control" required>
                            <option value="">Выберите роль</option>
                            <option value="муж">Муж</option>
                            <option value="жена">Жена</option>
                            <option value="партнёр">Партнёр</option>
                            <option value="бывший партнёр">Бывший партнёр</option>
                            <option value="иное">Иное</option>
                        </select>
                </div>
            `);
                partnerIndex++;
            }

            function addChild() {
                const container = document.getElementById('children-container');
                container.insertAdjacentHTML('beforeend', `
                <div class="row mb-3">
                    <div class="form-group col-4">
                        <label>Имя ребёнка</label>
                        <input type="text" name="family[children][${childIndex}][name]" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label>Дата рождения</label>
                        <input type="date" name="family[children][${childIndex}][birth_date]" class="form-control">
                    </div>
                    <div class="form-group col-3">
                        <label>Фото</label>
                        <input type="file" name="family[children][${childIndex}][photo]" class="form-control" accept="image/*">
                    </div>
                    <input type="hidden" name="family[children][${childIndex}][role]" value="child">
                </div>
            `);
                childIndex++;
            }
        </script>

    </div>
@endsection
