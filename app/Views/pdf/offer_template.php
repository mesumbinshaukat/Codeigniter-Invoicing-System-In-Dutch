<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Offerte <?= $offer_number ?></title>
    <style>
        /* Page setup: A4 with 15mm top/bottom and 20mm left/right margins */
        @page {
            size: A4;
            margin: 15mm 20mm; /* top/bottom left/right */
        }

        /* Reset body to match page margins; we'll layout inside .page containers */
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.35;
            color: #000;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
        }

        /* Each printed page container — height equals A4 minus vertical page margins (297mm - 30mm = 267mm) */
        .page {
            /* Use exact mm to match output devices like wkhtmltopdf */
            min-height: calc(297mm - 30mm);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* header top, footer bottom, content grows */
            page-break-after: always;
            /* avoid accidental page overflow: small padding inside content area */
            padding: 0;
            /* prevent page background or borders from bleeding */
            overflow: hidden;
        }

        /* Header area (kept compact) */
        .header {
            text-align: left;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .header-title {
            font-size: 12pt;
            margin-bottom: 2px;
        }

        .company-info {
            font-size: 9pt;
            line-height: 1.25;
        }

        /* Main content area — will expand between header and footer */
        .main {
            /* Give main area room and consistent spacing */
            padding-top: 6px;
            padding-bottom: 6px;
            flex-grow: 1;
            display: block;
        }

        .client-address {
            margin-top: 6px;
            margin-bottom: 10px;
            font-size: 10pt;
            line-height: 1.25;
        }

        .offer-header {
            text-align: right;
            margin-bottom: 10px;
            font-size: 10pt;
        }

        .greeting {
            margin-bottom: 8px;
        }

        .content-section {
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .project-details {
            margin: 8px 0;
        }

        .project-details p {
            margin: 3px 0;
        }

        .price-line {
            margin: 12px 0;
            font-weight: bold;
            line-height: 1.3;
        }

        .footnote {
            font-size: 9pt;
            font-style: italic;
            margin: 8px 0 10px 0;
        }

        .closing {
            margin-top: 10px;
            line-height: 1.4;
        }

        .signature-section {
            margin-top: 18px; /* reduced from 50+ to avoid large white gaps */
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 220px;
            margin-top: 18px; /* tightened */
            padding-top: 5px;
            font-size: 9pt;
        }

        /* Footer is now in-flow inside .page and will appear at bottom */
        .footer {
            font-size: 9pt;
            text-align: right;
            margin-top: 8px;
            /* ensure footer doesn't push beyond page — kept small */
            line-height: 1;
            padding-top: 6px;
        }

        h3 {
            font-size: 11pt;
            margin: 14px 0 8px 0;
            font-weight: bold;
        }

        .work-description {
            margin: 8px 0;
            line-height: 1.4;
        }

        .work-description p {
            margin: 6px 0;
        }

        .work-description ol {
            margin-left: 18px;
            margin-top: 6px;
            margin-bottom: 8px;
        }

        .work-description li {
            margin: 5px 0;
            line-height: 1.4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 9pt;
            table-layout: fixed;
            word-wrap: break-word;
        }

        table th {
            background-color: #f0f0f0;
            padding: 6px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        table td {
            padding: 6px 8px;
            border: 1px solid #ddd;
        }

        table td.right {
            text-align: right;
        }

        .conditions-section {
            margin-top: 8px;
            line-height: 1.4;
        }

        .conditions-section p {
            margin: 6px 0;
        }

        .bold {
            font-weight: bold;
        }

        /* Small responsive tweaks for long text to avoid overflowing margins */
        .nowrap-fix {
            white-space: normal;
        }

        /* Avoid printing artifacts on some engines: ensure no floats escaping page */
        img, svg { max-width:100%; height:auto; }
    </style>
</head>
<body>

    <!-- PAGE 1 -->
    <div class="page">
        <div class="header">
            <div class="header-title">ASBESTINVENTARISATIE &amp; MILIEUADVIES BV</div>
            <div class="company-info">
                Kerkstraat 41<br>
                5101 BB, Dongen T 0162- 764 024<br>
                E info@aenmbv.nl W www.aenmbv.nl<br>
                KvK 53156145 BTW nr NL 850771870B01<br>
                Van Lanschot 22 74 07 253
            </div>
        </div>

        <div class="main">
            <div class="client-address">
                <?= esc($client_name) ?><br>
                <?php if (!empty($client_address)): ?>
                <?= esc($client_address) ?><br>
                <?php endif ?>
                <?= esc($client_postcode) ?> <?= esc($client_city) ?><br>
                E-mail: <?= esc($client_email) ?><br>
                Tel: <?= esc($client_phone) ?>
            </div>

            <div class="offer-header">
                Offertenummer:&nbsp;<?= $offer_number ?><br>
                Dongen, <?= date('d-m-Y') ?>
            </div>

            <div class="greeting">
                Beste <?= esc($client_name) ?>,
            </div>

            <div class="content-section">
                Naar aanleiding van ons telefoongesprek zend ik u hierbij een offerte voor het uitvoeren van een asbestinventarisatie gelegen aan de <?= esc($project_address) ?> te <?= esc($client_city) ?>.
            </div>

            <div class="project-details">
                <p><strong>Projectgegevens</strong></p>
                <p>Adres:&nbsp;&nbsp; <?= esc($project_address) ?> te <?= esc($client_city) ?>.</p>
                <p>Type gebouw:&nbsp;&nbsp; <?= esc($building_type) ?></p>
                <?php if (!empty($research_area)): ?>
                <p>Onderzoeksgebied:&nbsp;&nbsp; <?= esc($research_area) ?></p>
                <?php endif ?>
                <p>Doel onderzoek:&nbsp;&nbsp; <?= esc($research_purpose) ?></p>
            </div>

            <div class="content-section">
                Het totale onderzoek van bovengenoemde complex wordt u aangeboden voor:
            </div>

            <div class="price-line">
                € <?= number_format($fixed_price, 2, ',', '.') ?> excl. 21% BTW, incl. 100 analyses conform NEN 5896 en rapportage*
            </div>

            <div class="footnote">
                *Specificaties en eventuele verrekentarieven zijn op pagina 2 in de offerte te vinden.
            </div>

            <div class="closing">
                Op deze aanbieding zijn onze algemene leveringsvoorwaarden van toepassing.<br>
                Ik hoop u hiermee voldoende te hebben geïnformeerd, indien u vragen heeft betreffende deze offerte kunt mij telefonisch bereiken op telefoonnummer 0162- 764 024.
            </div>

            <div class="closing">
                Met vriendelijke groet,<br>
                Asbestinventarisatie en Milieuadvies B.V.
            </div>

            <div class="signature-section">
                <div class="signature-line">
                    <?= esc($client_name) ?>
                </div>
            </div>
        </div>

        <div class="footer">
            Offertenummer <?= $offer_number ?> — Pagina 1 van 3
        </div>
    </div>

    <!-- PAGE 2 -->
    <div class="page">
        <div class="header">
            <div class="header-title">ASBESTINVENTARISATIE &amp; MILIEUADVIES BV</div>
            <div class="company-info">
                Kerkstraat 41<br>
                5101 BB, Dongen T 0162- 764 024<br>
                E info@aenmbv.nl W www.aenmbv.nl<br>
                KvK 53156145 BTW nr NL 850771870B01<br>
                Van Lanschot 22 74 07 253
            </div>
        </div>

        <div class="main">
            <h3>Omschrijving werkzaamheden</h3>

            <div class="work-description">
                <p>Een asbestinventarisatie bestaat uit de volgende werkzaamheden:</p>
                <ol>
                    <li><strong>Historisch onderzoek</strong><br>
                    Het uitvoeren van een vooronderzoek door middel van het planmatig voorbereiden, bestuderen van bouwkundige en bestekken/werkomschrijvingen/tekeningen en eventueel wanneer mogelijk en noodzakelijk het interviewen van( ex) werknemers, bewoners, beheerders van gebouwen en objecten op toegepaste asbestverdachte materialen, inclusief het maken van een onderzoeksplan.</li>

                    <li><strong>Visuele inspectie / monstername / analyses</strong><br>
                    Het door middel van een visuele inspectie opsporen (en indien nodig bemonsteren en analyseren) van de asbestverdachte bouwkundige onderdelen; het door middel van een inventarisatie kwantificeren van de aanwezig bouwkundige asbestbronnen.</li>

                    <li><strong>Het uitwerken van de rapportage</strong><br>
                    Inhoudelijk omvat dit: aangeven van de asbestbronnen op de plattegronden en/of geveltekeningen; korte omschrijving van de monsternameplaats + kwantificeren van de brontypes; foto's genummerd naar de monsternameplaats; rapportage digitaal in pdf-formaat per e-mail.</li>
                </ol>
            </div>

            <h3>Tariefstelling</h3>

            <table>
                <thead>
                    <tr>
                        <th>Omschrijving werkzaamheden</th>
                        <th style="width: 140px;">Prijzen excl. 21% BTW</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="nowrap-fix"><?= esc($tarief_description) ?>*</td>
                        <td class="right">€ <?= number_format($fixed_price, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="footnote">
                * Inbegrepen het nemen van monster incl. 100 analyses conform NEN 5896
            </div>

            <h3>Verrekentarieven</h3>

            <table>
                <thead>
                    <tr>
                        <th>Omschrijving werkzaamheden</th>
                        <th style="width: 140px;">Prijzen excl. 21% BTW</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Eventueel extra monster nemen incl. analyse conform NEN 5896 per stuk</td>
                        <td class="right">€ 950,00</td>
                    </tr>
                    <tr>
                        <td>EXTRA 1</td>
                        <td class="right">€ 1,00</td>
                    </tr>
                    <tr>
                        <td>EXTRA 2</td>
                        <td class="right">€ 2,00</td>
                    </tr>
                    <tr>
                        <td>EXTRA 3</td>
                        <td class="right">€ 3,00</td>
                    </tr>
                    <tr>
                        <td>EXTRA 4</td>
                        <td class="right">€ 4,00</td>
                    </tr>
                </tbody>
            </table>

            <div class="content-section">
                Bovengenoemde tarieven zijn exclusief 21% BTW. De aanbieding is tot 2 maanden na datering geldig. Uitvoering en analyse zijn onder voorbehoud van wijzigingen in de wet-en regelgeving.
            </div>
        </div>

        <div class="footer">
            Pagina 2 van 3
        </div>
    </div>

    <!-- PAGE 3 -->
    <div class="page">
        <div class="header">
            <div class="header-title">ASBESTINVENTARISATIE &amp; MILIEUADVIES BV</div>
            <div class="company-info">
                Kerkstraat 41<br>
                5101 BB, Dongen T 0162- 764 024<br>
                E info@aenmbv.nl W www.aenmbv.nl<br>
                KvK 53156145 BTW nr NL 850771870B01<br>
                Van Lanschot 22 74 07 253
            </div>
        </div>

        <div class="main">
            <h3>Algemene Voorwaarden</h3>

            <div class="conditions-section">
                <p><strong>1. Algemeen</strong></p>
                <p>Deze algemene voorwaarden zijn van toepassing op alle aanbiedingen, offertes en overeenkomsten van Asbestinventarisatie en Milieuadvies B.V., hierna te noemen: opdrachtnemer.</p>

                <p><strong>2. Offertes en aanbiedingen</strong></p>
                <p>Alle offertes en aanbiedingen van opdrachtnemer zijn vrijblijvend, tenzij schriftelijk anders is overeengekomen. Een offerte vervalt indien het product waarop de offerte betrekking heeft in de tussentijd niet meer beschikbaar is.</p>

                <p><strong>3. Prijzen</strong></p>
                <p>Alle prijzen die opdrachtnemer hanteert zijn in euro's, zijn exclusief BTW en exclusief eventuele andere heffingen van overheidswege, tenzij anders vermeld.</p>

                <p><strong>4. Betaling</strong></p>
                <p>Betaling dient te geschieden binnen 14 dagen na factuurdatum, tenzij schriftelijk anders is overeengekomen. Bij niet tijdige betaling is de opdrachtgever van rechtswege in verzuim. De opdrachtgever is alsdan een rente verschuldigd van 1% per maand, tenzij de wettelijke rente hoger is, in welk geval de wettelijke rente verschuldigd is.</p>

                <p><strong>5. Aansprakelijkheid</strong></p>
                <p>Opdrachtnemer is niet aansprakelijk voor schade, van welke aard ook, ontstaan doordat opdrachtnemer is uitgegaan van door of namens de opdrachtgever verstrekte onjuiste en/of onvolledige gegevens. Indien opdrachtnemer aansprakelijk mocht zijn voor enigerlei schade, dan is de aansprakelijkheid van opdrachtnemer beperkt tot maximaal het factuurbedrag.</p>
            </div>
        </div>

        <div class="footer">
            Pagina 3 van 3
        </div>
    </div>

</body>
</html>
