<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Offerte <?= esc($offer['offer_number']) ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7fafc; color: #1a202c; margin: 0; padding: 24px; }
        .email-card { max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 12px; padding: 32px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        h1 { font-size: 20px; margin-bottom: 12px; }
        p { line-height: 1.5; margin: 0 0 16px 0; }
        .btn { display: inline-block; padding: 14px 32px; border-radius: 999px; text-decoration: none; font-weight: bold; }
        .btn-accept { background: #16a34a; color: #ffffff; }
        .btn-reject { background: #f87171; color: #ffffff; }
        .btn-secondary { background: #e5e7eb; color: #1f2937; }
        .actions { margin: 24px 0; display: flex; flex-wrap: wrap; gap: 12px; }
        .footer { font-size: 12px; color: #718096; margin-top: 24px; }
        .details { border-top: 1px solid #edf2f7; padding-top: 16px; font-size: 14px; }
        @media only screen and (max-width: 480px) {
            body { padding: 12px; }
            .email-card { padding: 20px; }
            .actions { flex-direction: column; }
            .btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="email-card">
        <h1>Offerte <?= esc($offer['offer_number']) ?></h1>
        <p>Beste <?= esc($offer['client_name']) ?>,</p>
        <p>Bedankt voor uw aanvraag. In de bijlage vindt u de offerte voor het project op <?= esc($offer['project_address']) ?>. U kunt de offerte hieronder direct accepteren of afwijzen.</p>

        <div class="actions">
            <a href="<?= esc($acceptUrl) ?>" class="btn btn-accept">✔ Offerte accepteren</a>
            <a href="<?= esc($rejectUrl) ?>" class="btn btn-reject">✖ Offerte afwijzen</a>
            <a href="<?= esc($detailsUrl) ?>" class="btn btn-secondary">Meer details</a>
        </div>

        <div class="details">
            <p><strong>Bedrag:</strong> € <?= number_format($offer['fixed_price'] ?? 0, 2, ',', '.') ?> (excl. BTW)</p>
            <p><strong>Projectadres:</strong> <?= esc($offer['project_address']) ?></p>
            <p><strong>Contactpersoon:</strong> <?= esc($offer['client_name']) ?> - <?= esc($offer['client_email']) ?></p>
        </div>

        <p>Als u vragen heeft, reageer gerust op deze e-mail.</p>

        <div class="footer">
            <p>Verzonden door het Offerte Systeem.</p>
        </div>
    </div>
</body>
</html>
