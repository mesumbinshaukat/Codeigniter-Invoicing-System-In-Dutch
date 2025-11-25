<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanvraag Verzonden</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/public.css') ?>">
</head>
<body>
    <div class="container">
        <div class="success-wrapper">
            <div class="success-icon">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                    <circle cx="40" cy="40" r="38" stroke="#10b981" stroke-width="4"/>
                    <path d="M25 40L35 50L55 30" stroke="#10b981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1>Bedankt voor uw aanvraag!</h1>
            <p>Uw offerte aanvraag is succesvol verzonden. Wij nemen zo spoedig mogelijk contact met u op.</p>
            <div class="success-actions">
                <a href="<?= base_url('/') ?>" class="btn btn-primary">Terug naar Home</a>
                <a href="<?= base_url('form') ?>" class="btn btn-secondary">Nieuwe Aanvraag</a>
            </div>
        </div>
    </div>
</body>
</html>
