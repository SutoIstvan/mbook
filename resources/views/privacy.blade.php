@extends('layouts.home')

@section('title', 'Adatvédelmi Tájékoztató - Rememus.com')

@section('css')

@endsection

@section('content')


    <!-- ==================== Start Header ==================== -->

    <header class=" bg-img" data-background="home/imgs/intro/2.jpg" data-overlay-dark="4" style="padding: 130px 0;">

    </header>

    <!-- ==================== End Header ==================== -->

    <!-- ==================== Start Price ==================== -->

    <section class="price section-padding">
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">

      <h2 class="mb-4 text-center">Adatvédelmi Tájékoztató</h2>

      <h3 class="h5 mt-4">1. Az Adatkezelő adatai</h3>
      <ul class="list-unstyled">
        <li><strong>Cégnév:</strong> Paksi Informatikai Bt.</li>
        <li><strong>Székhely:</strong> 7030 Paks, Vácika köz 1.</li>
        <li><strong>Képviselő:</strong> Bizsi Sándor</li>
        <li><strong>Adószám:</strong> 22550242-2-17</li>
        <li><strong>Cégjegyzékszám:</strong> 17-06-006728</li>
        <li><strong>E-mail:</strong> gdpr@rememus.com</li>
        <li><strong>Telefon:</strong> +36707021252</li>
      </ul>

      <h3 class="h5 mt-4">2. Adatvédelmi kapcsolattartó</h3>
      <ul class="list-unstyled">
        <li><strong>Név:</strong> Gáll T. Barna</li>
        <li><strong>E-mail:</strong> adatvedelem@rememus.com</li>
      </ul>

      <h3 class="h5 mt-4">3. Az adatkezelés célja és jogalapja</h3>
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Cél</th>
              <th>Jogalap (GDPR)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Felhasználói fiók regisztrációja és kezelése</td>
              <td>GDPR 6. cikk (1) b) – szerződés teljesítése</td>
            </tr>
            <tr>
              <td>Emlékoldal létrehozása, tartalmak feltöltése</td>
              <td>GDPR 6. cikk (1) b); (1) a) – hozzájárulás az elhunyt adatainak feltöltése esetén</td>
            </tr>
            <tr>
              <td>Számlázás, fizetés kezelése</td>
              <td>GDPR 6. cikk (1) c) – jogi kötelezettség teljesítése</td>
            </tr>
            <tr>
              <td>Kapcsolattartás, ügyfélszolgálat</td>
              <td>GDPR 6. cikk (1) b) – szerződés teljesítése</td>
            </tr>
            <tr>
              <td>Marketing kommunikáció (hírlevél)</td>
              <td>GDPR 6. cikk (1) a) – hozzájárulás</td>
            </tr>
            <tr>
              <td>Jogviták rendezése, jogi igények érvényesítése</td>
              <td>GDPR 6. cikk (1) f) – jogos érdek</td>
            </tr>
          </tbody>
        </table>
      </div>

      <h3 class="h5 mt-4">4. Kezelt személyes adatok köre</h3>
      <ul>
        <li>Felhasználói adatok: név, e-mail cím, jelszó (titkosítva)</li>
        <li>Számlázási adatok: név, cím, adószám (cég esetén)</li>
        <li>Elhunyt személy adatai: név, születési és halálozási dátum, fényképek, videók, életrajzi leírások</li>
        <li>Technikai adatok: IP-cím, böngésző típusa, bejelentkezési naplófájlok</li>
        <li>Fizetési adatok: bankkártya-adatok a fizetési szolgáltató felületén kerülnek megadásra, nálunk nem tárolódnak</li>
      </ul>

      <h3 class="h5 mt-4">5. Adattárolás időtartama</h3>
      <ul>
        <li>Felhasználói fiók adatai: a fiók fennállásáig, törlésig</li>
        <li>Számlázási adatok: számviteli törvény szerint 8 év</li>
        <li>Emlékoldal tartalmai: amíg a szolgáltatás aktív vagy a felhasználó nem kéri törlésüket</li>
        <li>Marketing célú adatkezelés: hozzájárulás visszavonásáig</li>
      </ul>

      <h3 class="h5 mt-4">6. Adatfeldolgozók és adattovábbítás</h3>
      <p>Az adatkezelő igénybe veszi az alábbi adatfeldolgozókat:</p>
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Szolgáltató</th>
              <th>Szolgáltatás</th>
              <th>Adatkezelés jellege</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Contabo</td>
              <td>Webtárhely és email</td>
              <td>Személyes adatok tárolása</td>
            </tr>
            <tr>
              <td>Barion</td>
              <td>Online fizetés</td>
              <td>Fizetési tranzakció lebonyolítása</td>
            </tr>
            <tr>
              <td>Laferrotech Kft.</td>
              <td>Könyvelés</td>
              <td>Számlázási adatok kezelése</td>
            </tr>
            <tr>
              <td>MailerLite</td>
              <td>Marketing email</td>
              <td>Név, email tárolása és kezelése</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p><strong>Adattovábbítás harmadik országba:</strong> NINCS</p>

      <h3 class="h5 mt-4">7. Érintetti jogok</h3>
      <p>Az érintett kérelmezheti:</p>
      <ul>
        <li>hozzáférését személyes adataihoz</li>
        <li>helyesbítést</li>
        <li>törlést („elfeledtetéshez való jog”)</li>
        <li>adatkezelés korlátozását</li>
        <li>tiltakozást az adatkezelés ellen</li>
        <li>adathordozhatóságot</li>
      </ul>
      <p>Kérelmét az <strong>adatvedelem@rememus.com</strong> címre küldheti. Válaszadási határidő: legfeljebb 30 nap.</p>

      <h3 class="h5 mt-4">8. Hozzájárulás visszavonása</h3>
      <p>Amennyiben az adatkezelés hozzájáruláson alapul, az bármikor visszavonható, de ez nem érinti a visszavonás előtti adatkezelés jogszerűségét.</p>

      <h3 class="h5 mt-4">9. Panasz benyújtásának joga</h3>
      <p>Az érintett jogosult panasszal élni a Nemzeti Adatvédelmi és Információszabadság Hatóságnál (NAIH):</p>
      <ul class="list-unstyled">
        <li><strong>Cím:</strong> 1055 Budapest, Falk Miksa utca 9-11.</li>
        <li><strong>Postacím:</strong> 1363 Budapest, Pf. 9.</li>
        <li><strong>Telefon:</strong> +36 (1) 391-1400</li>
        <li><strong>E-mail:</strong> ugyfelszolgalat@naih.hu</li>
        <li><strong>Web:</strong> www.naih.hu</li>
      </ul>

      <h3 class="h5 mt-4">10. Automatizált döntéshozatal / profilalkotás</h3>
      <p>Az adatkezelő nem végez automatizált döntéshozatalt vagy profilalkotást.</p>

      <h3 class="h5 mt-4">11. Cookie-k kezelése</h3>
      <p>A részletes cookie-szabályzat elérhető a weboldalon: <a href="#">[Cookie Policy link]</a></p>

      <h3 class="h5 mt-4">Záró rendelkezések</h3>
      <p>Jelen tájékoztató 2025. július 8. napjától érvényes. Fenntartjuk a jogot annak módosítására. A változásokról a felhasználókat a weboldalon keresztül értesítjük.</p>

    </div>
  </div>
</div>

    </section>



@endsection
