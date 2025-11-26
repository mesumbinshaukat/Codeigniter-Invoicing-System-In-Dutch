<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asbestinventarisatie & Milieuadvies B.V.</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/public.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
                <img src="<?= base_url('uploads/logo/aenm-logo.png') ?>" alt="A&M Logo" onerror="this.style.display='none'">
            </div>
            <nav class="main-nav">
                <a href="#" class="nav-link active">Home</a>
                <a href="#" class="nav-link">Wat kost een asbestrapport?</a>
                <a href="#" class="nav-link">Wat is asbest?</a>
                <a href="#" class="nav-link">Wetgeving</a>
                <a href="#" class="nav-link">Contact</a>
            </nav>
            <div class="sca-badge">
                <img src="<?= base_url('uploads/sca-badge.png') ?>" alt="SCA-code" onerror="this.style.display='none'">
                <div class="sca-text">SCA-code 07-9070089.01</div>
            </div>
        </div>
    </header>

    <div class="success-banner">
        <div class="container">
            <div class="success-text">SUCCESVOL AFGERONDE PROJECTEN</div>
            <div class="success-counters">
                <div class="counter-box">1</div>
                <div class="counter-box">5</div>
                <div class="counter-box">1</div>
                <div class="counter-box">2</div>
                <div class="counter-box">2</div>
            </div>
        </div>
    </div>

    <main class="main-content">
        <div class="container">
            <div class="content-grid">
                <div class="content-left">
                    <h1>Asbestinventarisatierapport binnen 5 werkdagen</h1>
                    <div class="content-text">
                        <p>Asbestinventarisatie & Milieuadvies B.V. uit Dongen is een gespecialiseerd en gecertificeerd asbestinventarisatiebedrijf. Wij zijn een onafhankelijk milieukundig-en adviesbureau. Ons onderzoeksteam bestaat uit 3 ervaren adviseurs met minimaal 10 jaar ervaring in de asbestbranche.</p>
                        <p>Asbestinventarisatie & Milieuadvies B.V. is in het bezit van het procescertificaat asbestinventarisatie. A&M helpt mensen met een asbestprobleem snel en verantwoord. Onder normale omstandigheden levert A&M binnen wij verzorgen een asbestinventarisatierapport conform de geldende wetgeving. Op vertraging van uw plannen zit u tenslotte niet te wachten.</p>
                        <p class="cta-link"><a href="#offerteaanvraag">Vraag direct offerte aan</a></p>
                    </div>
                    <div class="content-image">
                        <img src="<?= base_url('uploads/house-magnifier.png') ?>" alt="Asbestinventarisatie" onerror="this.style.display='none'">
                    </div>
                </div>

                <div class="content-right">
                    <div class="form-box" id="offerteaanvraag">
                        <h2>Offerteaanvraag</h2>
                        <p class="form-intro">Vraag een offerte aan en wij streven er naar binnen 1 werkdag contact met u op te nemen.</p>

                        <?php if (session()->has('errors')): ?>
                            <div class="alert alert-error">
                                <ul>
                                    <?php foreach (session('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>

                        <form action="<?= base_url('form/submit') ?>" method="post" class="offerte-form">
                            <?= csrf_field() ?>

                            <input type="text" name="naam" placeholder="Klantnaam" value="<?= old('naam') ?>" required>
                            <input type="email" name="email" placeholder="E-mailadres" value="<?= old('email') ?>" required>
                            <input type="tel" name="telefoonnummer" placeholder="Telefoon" value="<?= old('telefoonnummer') ?>" required>
                            <input type="text" name="postcode" placeholder="Postcode" value="<?= old('postcode') ?>" required>
                            <input type="text" name="project_adres" placeholder="Onderzoeksadres" value="<?= old('project_adres') ?>" required>
                            <input type="text" name="woonplaats" placeholder="Woonplaats" value="<?= old('woonplaats') ?>" required>
                            <input type="text" name="adres" placeholder="Adres (optioneel)" value="<?= old('adres') ?>">
                            
                            <select name="type_gebouw" required>
                                <option value="">Type Gebouw</option>
                                <option value="Woonhuis" <?= old('type_gebouw') == 'Woonhuis' ? 'selected' : '' ?>>Woonhuis</option>
                                <option value="Garage" <?= old('type_gebouw') == 'Garage' ? 'selected' : '' ?>>Garage</option>
                                <option value="Schuur" <?= old('type_gebouw') == 'Schuur' ? 'selected' : '' ?>>Schuur</option>
                                <option value="Bedrijfspand" <?= old('type_gebouw') == 'Bedrijfspand' ? 'selected' : '' ?>>Bedrijfspand</option>
                                <option value="Appartement" <?= old('type_gebouw') == 'Appartement' ? 'selected' : '' ?>>Appartement</option>
                                <option value="Anders" <?= old('type_gebouw') == 'Anders' ? 'selected' : '' ?>>Anders</option>
                            </select>

                            <input type="text" name="onderzoeksgebied" placeholder="Onderzoeksgebied (optioneel)" value="<?= old('onderzoeksgebied') ?>">
                            <textarea name="doel_onderzoek" rows="3" placeholder="Doel onderzoek / opmerking" required><?= old('doel_onderzoek') ?></textarea>

                            <button type="submit" class="btn-submit">VERZENDEN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="info-sections">
        <div class="container">
            <div class="info-grid">
                <div class="info-column">
                    <h3>Diensten</h3>
                    <ul>
                        <li>Asbest-onderzoek</li>
                        <li>Globale inventarisatie</li>
                        <li>Risico inventarisatie</li>
                        <li>Laboratorium onderzoek</li>
                        <li>Voorlichting</li>
                    </ul>
                    <p class="info-link"><a href="#">Inlegvellen i.v.m. gewijzigde risicoklassen</a></p>
                </div>

                <div class="info-column">
                    <h3>Inlegvellen</h3>
                    <p>Sinds 1 januari 2017 gelden nieuwe grenswaarde voor asbest. De grenswaarde voor asbest is verlaagd van 10.000 naar 2.000 vezels / m3. Hiermee is ook de indeling van de risicoklassen gewijzigd. Om te mogen saneren vanaf 1 maart 2017 met een asbestinventarisatierapport van voor de gewijzigde grenswaarden, dient het weergegeven op het inlegvel bij het asbestinventarisatierapport. Indien een risicoklasse wijzigt, staat dit weergegeven op het inlegvel en wordt er een nieuwe SMA of bijgewerkt kan worden.</p>
                </div>

                <div class="info-column">
                    <h3>Voor wie werken wij?</h3>
                    <ul>
                        <li>Particulieren / MKB</li>
                        <li>Woningbouw/aannemers/saneerders</li>
                        <li>Agrarische bedrijven</li>
                        <li>Overheidsinstellingen</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <h4>A & M Asbestinventarisatie en Milieuadvies B.V.</h4>
                <p>Contactpersoon: Stein van der Sanden</p>
                <p>Hoge Ham 15 B</p>
                <p>5104 JA Dongen</p>
                <div class="footer-contact">
                    <div class="contact-item">
                        <span>T</span> <a href="tel:+31016276024">+31 (0)162 764 024</a>
                    </div>
                    <div class="contact-item">
                        <span>M</span> <a href="tel:+31651764902">+31 (0)6 51 76 49 02</a>
                    </div>
                    <div class="contact-item">
                        <span>F</span> <a href="mailto:info@aenmbv.nl">info@aenmbv.nl</a>
                    </div>
                    <div class="contact-item">
                        <span>W</span> <a href="http://www.aenmbv.nl">www.aenmbv.nl</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
