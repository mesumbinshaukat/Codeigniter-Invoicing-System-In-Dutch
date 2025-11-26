<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Offerte <?= $offer_number ?></title>
    <style>
        @page {
            margin: 15mm 20mm;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #000;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .header {
            margin-bottom: 20px;
        }
        
        .logo {
            float: left;
            max-width: 120px;
            max-height: 60px;
        }
        
        .company-info {
            float: right;
            text-align: right;
            font-size: 9pt;
            line-height: 1.4;
        }
        
        .clear {
            clear: both;
        }
        
        .client-address {
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 10pt;
        }
        
        .offer-header {
            text-align: right;
            margin-bottom: 30px;
            font-size: 10pt;
        }
        
        .greeting {
            margin-bottom: 15px;
        }
        
        .content-section {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        
        .project-details {
            margin: 20px 0;
        }
        
        .project-details p {
            margin: 5px 0;
        }
        
        .price-line {
            margin: 20px 0;
            font-weight: bold;
        }
        
        .footnote {
            font-size: 9pt;
            font-style: italic;
            margin: 10px 0;
        }
        
        .closing {
            margin-top: 30px;
            line-height: 1.6;
        }
        
        .signature-section {
            margin-top: 50px;
        }
        
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 60px;
            padding-top: 5px;
            font-size: 9pt;
        }
        
        .footer {
            position: fixed;
            bottom: 10mm;
            left: 20mm;
            right: 20mm;
            font-size: 9pt;
        }
        
        .footer-left {
            float: left;
        }
        
        .footer-right {
            float: right;
        }
        
        h3 {
            font-size: 11pt;
            margin: 20px 0 10px 0;
        }
        
        .work-description {
            margin: 15px 0;
        }
        
        .work-description ol {
            margin-left: 20px;
        }
        
        .work-description li {
            margin: 8px 0;
            line-height: 1.6;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        table th {
            background-color: #f0f0f0;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #000;
            font-size: 9pt;
        }
        
        table td {
            padding: 8px;
            border: 1px solid #000;
            font-size: 9pt;
        }
        
        table td.right {
            text-align: right;
        }
        
        .conditions-section {
            margin-top: 20px;
        }
        
        .conditions-section p {
            margin: 8px 0;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="header">
        <?php if (file_exists(FCPATH . 'uploads/logo/aenm-logo.png')): ?>
            <img src="<?= FCPATH . 'uploads/logo/aenm-logo.png' ?>" alt="Logo" class="logo">
        <?php endif ?>
        <div class="company-info">
            Kerkstraat 41<br>
            5101 BB Dongen<br>
            T 0162 - 764 024<br>
            E info@aenmbv.nl<br>
            W www.aenmbv.nl<br>
            KvK 53156145<br>
            BTW nr NL 850771870B01<br>
            Van Lanschot 22 74 07 253
        </div>
        <div class="clear"></div>
    </div>

    <div class="client-address">
        <?= esc($client_name) ?><br>
        <?php if (!empty($client_address)): ?>
        <?= esc($client_address) ?><br>
        <?php endif ?>
        <?= esc($client_postcode) ?> <?= esc($client_city) ?><br>
        <?= esc($client_email) ?><br>
        <?= esc($client_phone) ?>
    </div>

    <div class="offer-header">
        Offertenummer : <?= $offer_number ?><br>
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
        <p>Adres : <?= esc($project_address) ?> te <?= esc($client_city) ?>.</p>
        <p>Type gebouw : <?= esc($building_type) ?></p>
        <?php if (!empty($research_area)): ?>
        <p>Onderzoeksgebied : <?= esc($research_area) ?></p>
        <?php endif ?>
        <p>Doel onderzoek : <?= esc($research_purpose) ?></p>
    </div>

    <div class="content-section">
        Het totale onderzoek van bovengenoemde complex wordt u aangeboden voor:
    </div>

    <div class="price-line">
        € <?= number_format($fixed_price, 2, ',', '') ?>,00 excl. 21% BTW, incl. 100 analyses conform NEN 5896 en rapportage*
    </div>

    <div class="footnote">
        *Specificaties en eventuele verrekentarieven zijn op pagina 2 in de offerte te vinden.
    </div>

    <div class="closing">
        Op deze aanbieding zijn onze algemene leveringsvoorwaarden van toepassing. Ik hoop u hiermee voldoende te hebben geïnformeerd, indien u vragen heeft betreffende deze offerte kunt mij telefonisch bereiken op telefoonnummer 0162 - 764 024.
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

    <div class="footer">
        <div class="footer-left">Offertenummer <?= $offer_number ?></div>
        <div class="footer-right">Pagina 1 van 3</div>
        <div class="clear"></div>
    </div>

    <div class="page-break"></div>

    <div class="header">
        <?php if (file_exists(FCPATH . 'uploads/logo/aenm-logo.png')): ?>
            <img src="<?= FCPATH . 'uploads/logo/aenm-logo.png' ?>" alt="Logo" class="logo">
        <?php endif ?>
        <div class="company-info">
            Kerkstraat 41<br>
            5101 BB Dongen<br>
            T 0162 - 764 024<br>
            E info@aenmbv.nl<br>
            W www.aenmbv.nl<br>
            KvK 53156145<br>
            BTW nr NL 850771870B01<br>
            Van Lanschot 22 74 07 253
        </div>
        <div class="clear"></div>
    </div>

    <h3>Omschrijving werkzaamheden</h3>

    <div class="work-description">
        <ol>
            <li>Het inventariseren van asbest en asbesthoudende materialen in het gebouw conform NEN 2991 en NEN 2990.</li>
            <li>Het nemen van monsters en het laten analyseren van deze monsters door een geaccrediteerd laboratorium conform NEN 5896.</li>
            <li>Het opstellen van een asbestinventarisatierapport conform NEN 2991 en NEN 2990.</li>
        </ol>
    </div>

    <h3>Tariefstelling</h3>

    <table>
        <thead>
            <tr>
                <th>Omschrijving werkzaamheden</th>
                <th style="width: 200px;">Prijzen excl. 21% BTW</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= esc($tarief_description) ?></td>
                <td class="right">€ <?= number_format($fixed_price, 2, ',', '') ?>,00</td>
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
                <th style="width: 200px;">Prijzen excl. 21% BTW</th>
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

    <div class="footer">
        <div class="footer-right">Pagina 2 van 3</div>
        <div class="clear"></div>
    </div>

    <div class="page-break"></div>

    <div class="header">
        <?php if (file_exists(FCPATH . 'uploads/logo/aenm-logo.png')): ?>
            <img src="<?= FCPATH . 'uploads/logo/aenm-logo.png' ?>" alt="Logo" class="logo">
        <?php endif ?>
        <div class="company-info">
            Kerkstraat 41<br>
            5101 BB Dongen<br>
            T 0162 - 764 024<br>
            E info@aenmbv.nl<br>
            W www.aenmbv.nl<br>
            KvK 53156145<br>
            BTW nr NL 850771870B01<br>
            Van Lanschot 22 74 07 253
        </div>
        <div class="clear"></div>
    </div>

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

    <div class="footer">
        <div class="footer-right">Pagina 3 van 3</div>
        <div class="clear"></div>
    </div>
</body>
</html>
