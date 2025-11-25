<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Offerte <?= $offer_number ?></title>
    <style>
        @page {
            margin: 20mm 15mm;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #000;
        }
        
        .header {
            margin-bottom: 30px;
            position: relative;
        }
        
        .logo {
            position: absolute;
            top: 0;
            right: 0;
            max-width: 150px;
            max-height: 80px;
        }
        
        .company-info {
            font-size: 9pt;
            line-height: 1.3;
        }
        
        .company-name {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .document-title {
            font-size: 18pt;
            font-weight: bold;
            margin: 30px 0 20px 0;
            text-transform: uppercase;
        }
        
        .info-section {
            margin-bottom: 25px;
        }
        
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .info-block {
            margin-bottom: 15px;
        }
        
        .info-label {
            font-weight: bold;
            font-size: 9pt;
            margin-bottom: 3px;
        }
        
        .info-value {
            font-size: 10pt;
            margin-bottom: 2px;
        }
        
        table.items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        table.items-table th {
            background-color: #f0f0f0;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ccc;
            font-size: 9pt;
        }
        
        table.items-table td {
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 9pt;
        }
        
        table.items-table td.number {
            text-align: right;
        }
        
        table.items-table td.center {
            text-align: center;
        }
        
        .totals-table {
            width: 50%;
            margin-left: auto;
            margin-top: 15px;
        }
        
        .totals-table td {
            padding: 5px 10px;
            font-size: 10pt;
        }
        
        .totals-table td.label {
            text-align: right;
            font-weight: bold;
        }
        
        .totals-table td.amount {
            text-align: right;
            width: 120px;
        }
        
        .totals-table tr.total-row {
            border-top: 2px solid #000;
            font-weight: bold;
            font-size: 11pt;
        }
        
        .footer-info {
            margin-top: 30px;
            font-size: 9pt;
            line-height: 1.5;
        }
        
        .footer-info p {
            margin: 5px 0;
        }
        
        .footer-info strong {
            font-weight: bold;
        }
        
        .page-number {
            position: fixed;
            bottom: 10mm;
            right: 15mm;
            font-size: 9pt;
            color: #666;
        }
        
        .terms-section {
            margin-top: 25px;
            page-break-before: auto;
        }
        
        .terms-section h3 {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .terms-section p {
            font-size: 9pt;
            margin-bottom: 8px;
            line-height: 1.5;
        }
        
        .signature-section {
            margin-top: 40px;
        }
        
        .signature-block {
            display: inline-block;
            width: 45%;
            margin-top: 30px;
        }
        
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 5px;
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <div class="header">
        <?php if (file_exists($logo_path ?? '')): ?>
            <img src="<?= $logo_path ?>" alt="Logo" class="logo">
        <?php endif ?>
        
        <div class="company-info">
            <div class="company-name"><?= $company_name ?></div>
            <div><?= $company_address ?></div>
            <div><?= $company_postcode ?> <?= $company_city ?></div>
            <div>Tel: <?= $company_phone ?></div>
            <div>E-mail: <?= $company_email ?></div>
            <div><?= $company_kvk ?></div>
            <div><?= $company_btw ?></div>
        </div>
    </div>

    <div class="document-title">OFFERTE</div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-column">
                <div class="info-block">
                    <div class="info-label">Offertenummer:</div>
                    <div class="info-value"><?= $offer_number ?></div>
                </div>
                <div class="info-block">
                    <div class="info-label">Datum:</div>
                    <div class="info-value"><?= $offer_date ?></div>
                </div>
                <div class="info-block">
                    <div class="info-label">Geldig tot:</div>
                    <div class="info-value"><?= date('d-m-Y', strtotime('+30 days')) ?></div>
                </div>
            </div>
            
            <div class="info-column">
                <div class="info-block">
                    <div class="info-label">Klant:</div>
                    <div class="info-value"><?= esc($client_name) ?></div>
                    <div class="info-value"><?= esc($client_address) ?></div>
                    <div class="info-value"><?= esc($client_postcode) ?> <?= esc($client_city) ?></div>
                    <div class="info-value"><?= esc($client_email) ?></div>
                    <div class="info-value"><?= esc($client_phone) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="info-section">
        <div class="info-block">
            <div class="info-label">Project Adres:</div>
            <div class="info-value"><?= esc($project_address) ?></div>
        </div>
        
        <div class="info-block">
            <div class="info-label">Type Gebouw:</div>
            <div class="info-value"><?= esc($building_type) ?></div>
        </div>
        
        <div class="info-block">
            <div class="info-label">Onderzoeksgebied:</div>
            <div class="info-value"><?= nl2br(esc($research_area)) ?></div>
        </div>
        
        <div class="info-block">
            <div class="info-label">Doel van Onderzoek:</div>
            <div class="info-value"><?= nl2br(esc($research_purpose)) ?></div>
        </div>
        
        <div class="info-block">
            <div class="info-label">Aantal Analyses:</div>
            <div class="info-value"><?= $number_of_analyses ?></div>
        </div>
        
        <?php if (!empty($extra_options)): ?>
        <div class="info-block">
            <div class="info-label">Extra Opties:</div>
            <div class="info-value"><?= nl2br(esc($extra_options)) ?></div>
        </div>
        <?php endif ?>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%;">Omschrijving</th>
                <th style="width: 15%;" class="center">Aantal</th>
                <th style="width: 17%;" class="number">Prijs per stuk</th>
                <th style="width: 18%;" class="number">Totaal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['description']) ?></td>
                    <td class="center"><?= $item['quantity'] ?></td>
                    <td class="number">€ <?= number_format($item['unit_price'], 2, ',', '.') ?></td>
                    <td class="number">€ <?= number_format($item['total_price'], 2, ',', '.') ?></td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td class="label">Subtotaal:</td>
            <td class="amount">€ <?= number_format($subtotal, 2, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="label">BTW (<?= number_format($btw_percentage, 0) ?>%):</td>
            <td class="amount">€ <?= number_format($btw_amount, 2, ',', '.') ?></td>
        </tr>
        <tr class="total-row">
            <td class="label">Totaal:</td>
            <td class="amount">€ <?= number_format($total_amount, 2, ',', '.') ?></td>
        </tr>
    </table>

    <div class="footer-info">
        <p><strong>Betalingsvoorwaarden:</strong> Betaling binnen <?= $payment_terms ?> na factuurdatum.</p>
        <p><strong>IBAN:</strong> <?= $company_iban ?></p>
        <p><strong>Geldigheid offerte:</strong> Deze offerte is geldig tot <?= date('d-m-Y', strtotime('+30 days')) ?>.</p>
    </div>

    <div class="terms-section">
        <h3>Algemene Voorwaarden</h3>
        <p>1. Deze offerte is vrijblijvend en geldig gedurende <?= $validity_period ?>.</p>
        <p>2. Alle prijzen zijn exclusief BTW, tenzij anders vermeld.</p>
        <p>3. Betaling dient te geschieden binnen <?= $payment_terms ?> na factuurdatum.</p>
        <p>4. Bij niet tijdige betaling zijn wij gerechtigd rente in rekening te brengen.</p>
        <p>5. Op alle werkzaamheden zijn onze algemene voorwaarden van toepassing.</p>
    </div>

    <div class="signature-section">
        <div class="signature-block">
            <div class="signature-line">
                Datum en handtekening opdrachtgever
            </div>
        </div>
        <div class="signature-block" style="float: right;">
            <div class="signature-line">
                Datum en handtekening opdrachtnemer
            </div>
        </div>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Pagina {PAGE_NUM} van {PAGE_COUNT}";
            $font = $fontMetrics->get_font("DejaVu Sans", "normal");
            $size = 9;
            $pageWidth = $pdf->get_width();
            $pageHeight = $pdf->get_height();
            $textWidth = $fontMetrics->get_text_width($text, $font, $size);
            $x = $pageWidth - $textWidth - 40;
            $y = $pageHeight - 30;
            $pdf->text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>
