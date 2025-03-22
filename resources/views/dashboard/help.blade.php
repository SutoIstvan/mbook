@extends('layouts.dashboard')

@section('content')
    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Gyakran Ismételt Kérdések') }}</h4>
                </div>
            </div>
        </div>

        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Van-e folyamatos költsége a weboldal fenntartásának?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body" style="padding: 0px !important">
                                    <p>
                                        Nem! Elkötelezettek vagyunk a megfizethetőség mellett, egyszeri vásárlást kínálunk egy személyre szabható Tisztelgésünk emlékművünkhöz. Ez a szolgáltatás akár 50 fénykép, korlátlan számú videó és szöveges tárolást is tartalmaz az online tiszteletadáshoz. Azok számára, akik még több emléket szeretnének felvenni, éves előfizetéssel extra fotótárhelyet biztosítanak, így szerettei digitális emlékhelye átfogó és naprakész.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Nem váltja fel végül a QR-kódokat egy másik technológia?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body" style="padding: 0px !important">
                                    <p>
                                        A szakértők úgy vélik, hogy a QR-kódok még hosszú ideig léteznek, ipari gyökereiktől kezdve jelentős szerepük lesz az emlékművekben. Ezek a kódok nem tárolják szeretett személyének adatait; ehelyett közvetlen linkként működnek a Tributes weboldalunkon található személyes oldalukra. Biztos lehet benne, hogy az információkat biztonságosan tároljuk és könnyen hozzáférhetők. A QR-kódokat tartós technológiának tekintik, amely biztosítja, hogy még az új technológiák megjelenésével is, a digitális emlékmű elérhető és biztonságos online maradjon.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    Megajándékozhatom e a qr code a családomnak vagy a barátoknak?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body" style="padding: 0px !important">
                                    <p>
                                        Igen, rugalmasan létrehozhat egy digitális emlékoldalt valakinek, majd átruházhatja annak tulajdonjogát egy másik személyre. A címzettnek egyszerűen létre kell hoznia egy fiókot a ourtributes.com oldalon. Miután fiókjuk aktív lett, küldjön e-mailben egy átviteli kérelmet, amely tartalmazza mindkét fél e-mail címét és a szeretett személy nevét. Csapatunk hatékonyan kezeli az online tribute oldal átadását.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    Használható-e egyetlen oldal 2 személyre, például egy párra?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body" style="padding: 0px !important">
                                    <p>
                                        Igen, egy emlékoldal használható egy pár, például egy szülő vagy nagyszülő számára. Jelenleg az egyetlen korlátozás az, hogy csak egy hely van a születési és halálozási dátumoknak. Ezeket üresen hagyhatja a promptokban, és manuálisan beillesztheti az „Életrajz” szakaszba, hogy mindkét dátum szerepeljen.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    A tábla megsérti vagy megrongálja a sírkövet? Mi van, ha később el kell távolítanom?
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body" style="padding: 0px !important">
                                    <p>
                                        A Tributes plakettjeink nem sértik meg a kopjafát! A 3M permanens szalag tartósan tapad a felülethez súlyos körülmények között, például esőben, hóban, erős napsütésben stb. Ennek ellenére, ha szükséges, a lepedéket óvatosan el lehet távolítani a sírkőről egy kemény lapos tárggyal, például lapos csavarhúzóval, hogy a plakk széleit a tapadási felületről lefeszítse. Az eltávolítás után használjon megfelelő sírkőtisztítót a megmaradt ragacsos maradékok eltávolítására.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <!-- ==================== SAVE ==================== -->

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
