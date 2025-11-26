<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Offerte Aanmaken</h2>
    <a href="<?= base_url('admin/submission/view/' . $submission['id']) ?>" class="btn btn-secondary">Terug</a>
</div>

<div class="form-card">
    <form action="<?= base_url('admin/offer/store') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">

        <div class="form-section">
            <h3>Klantinformatie</h3>
            <div class="info-grid">
                <p><strong>Naam:</strong> <?= esc($submission['naam']) ?></p>
                <p><strong>E-mail:</strong> <?= esc($submission['email']) ?></p>
                <p><strong>Telefoon:</strong> <?= esc($submission['telefoonnummer']) ?></p>
                <p><strong>Postcode:</strong> <?= esc($submission['postcode']) ?></p>
                <p><strong>Woonplaats:</strong> <?= esc($submission['woonplaats']) ?></p>
                <?php if (!empty($submission['adres'])): ?>
                <p><strong>Adres:</strong> <?= esc($submission['adres']) ?></p>
                <?php endif ?>
            </div>
        </div>

        <div class="form-section">
            <h3>Projectinformatie</h3>
            <div class="info-grid">
                <p><strong>Project Adres:</strong> <?= esc($submission['project_adres']) ?></p>
                <p><strong>Type Gebouw:</strong> <?= esc($submission['type_gebouw']) ?></p>
                <?php if (!empty($submission['onderzoeksgebied'])): ?>
                <p><strong>Onderzoeksgebied:</strong> <?= esc($submission['onderzoeksgebied']) ?></p>
                <?php endif ?>
                <p><strong>Doel Onderzoek:</strong> <?= nl2br(esc($submission['doel_onderzoek'])) ?></p>
            </div>
        </div>

        <div class="form-section">
            <h3>Offerte Details</h3>
            
            <div class="form-group">
                <label for="fixed_price">Vaste prijs (excl. BTW) *</label>
                <input type="number" id="fixed_price" name="fixed_price" step="0.01" min="0" required placeholder="350.00">
            </div>

            <div class="form-group">
                <label for="tarief_description">Omschrijving voor tariefstelling *</label>
                <textarea id="tarief_description" name="tarief_description" rows="3" required placeholder="Inventarisatie van Garage ( zie punt 1 t/m 3 )*"></textarea>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Offerte Opslaan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
