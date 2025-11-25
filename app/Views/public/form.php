<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offerte Aanvraag Formulier</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/public.css') ?>">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header">
                <h1>Offerte Aanvraag</h1>
                <p>Vul onderstaand formulier in om een offerte aan te vragen</p>
            </div>

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="<?= base_url('form/submit') ?>" method="post" class="offer-form">
                <?= csrf_field() ?>

                <div class="form-section">
                    <h2>Persoonlijke Gegevens</h2>
                    
                    <div class="form-group">
                        <label for="naam">Naam *</label>
                        <input type="text" id="naam" name="naam" value="<?= old('naam') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="adres">Adres *</label>
                        <input type="text" id="adres" name="adres" value="<?= old('adres') ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="postcode">Postcode *</label>
                            <input type="text" id="postcode" name="postcode" value="<?= old('postcode') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="woonplaats">Woonplaats *</label>
                            <input type="text" id="woonplaats" name="woonplaats" value="<?= old('woonplaats') ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">E-mail *</label>
                            <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="telefoonnummer">Telefoonnummer *</label>
                            <input type="tel" id="telefoonnummer" name="telefoonnummer" value="<?= old('telefoonnummer') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Project Informatie</h2>
                    
                    <div class="form-group">
                        <label for="project_adres">Project Adres *</label>
                        <input type="text" id="project_adres" name="project_adres" value="<?= old('project_adres') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="type_gebouw">Type Gebouw *</label>
                        <select id="type_gebouw" name="type_gebouw" required>
                            <option value="">Selecteer type gebouw</option>
                            <option value="Woonhuis" <?= old('type_gebouw') == 'Woonhuis' ? 'selected' : '' ?>>Woonhuis</option>
                            <option value="Appartement" <?= old('type_gebouw') == 'Appartement' ? 'selected' : '' ?>>Appartement</option>
                            <option value="Kantoor" <?= old('type_gebouw') == 'Kantoor' ? 'selected' : '' ?>>Kantoor</option>
                            <option value="Winkel" <?= old('type_gebouw') == 'Winkel' ? 'selected' : '' ?>>Winkel</option>
                            <option value="Bedrijfspand" <?= old('type_gebouw') == 'Bedrijfspand' ? 'selected' : '' ?>>Bedrijfspand</option>
                            <option value="Anders" <?= old('type_gebouw') == 'Anders' ? 'selected' : '' ?>>Anders</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="onderzoeksgebied">Onderzoeksgebied *</label>
                        <textarea id="onderzoeksgebied" name="onderzoeksgebied" rows="4" required><?= old('onderzoeksgebied') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="doel_onderzoek">Doel van Onderzoek *</label>
                        <textarea id="doel_onderzoek" name="doel_onderzoek" rows="4" required><?= old('doel_onderzoek') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="aantal_analyses">Aantal Analyses *</label>
                        <input type="number" id="aantal_analyses" name="aantal_analyses" min="1" value="<?= old('aantal_analyses') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="extra_opties">Eventuele Extra Opties</label>
                        <textarea id="extra_opties" name="extra_opties" rows="4"><?= old('extra_opties') ?></textarea>
                        <small>Optioneel: vermeld hier eventuele aanvullende wensen of opmerkingen</small>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Aanvraag Verzenden</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
