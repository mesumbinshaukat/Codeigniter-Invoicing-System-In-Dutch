<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Offerte <?= esc($offer['offer_number']) ?></h2>
    <div class="header-actions">
        <a href="<?= base_url('admin/offers') ?>" class="btn btn-secondary">Terug</a>
        <?php if (!$offer['pdf_path']): ?>
            <a href="<?= base_url('admin/offer/generate-pdf/' . $offer['id']) ?>" class="btn btn-primary">PDF Genereren</a>
        <?php else: ?>
            <a href="<?= base_url('admin/offer/download/' . $offer['id']) ?>" class="btn btn-success">PDF Downloaden</a>
            <a href="<?= base_url('admin/offer/email/' . $offer['id']) ?>" class="btn btn-info">E-mail Verzenden</a>
        <?php endif ?>
    </div>
</div>

<div class="detail-card">
    <h3>Offerte Informatie</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <label>Offertenummer</label>
            <p><strong><?= esc($offer['offer_number']) ?></strong></p>
        </div>
        <div class="detail-item">
            <label>Datum</label>
            <p><?= date('d-m-Y', strtotime($offer['created_at'])) ?></p>
        </div>
        <div class="detail-item">
            <label>Status</label>
            <p>
                <span class="badge badge-<?= $offer['status'] == 'draft' ? 'warning' : ($offer['status'] == 'sent' ? 'info' : ($offer['status'] == 'accepted' ? 'success' : 'danger')) ?>">
                    <?= ucfirst($offer['status']) ?>
                </span>
            </p>
        </div>
    </div>
</div>

<div class="detail-card">
    <h3>Klantgegevens</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <label>Naam</label>
            <p><?= esc($offer['client_name']) ?></p>
        </div>
        <div class="detail-item">
            <label>E-mail</label>
            <p><?= esc($offer['client_email']) ?></p>
        </div>
        <div class="detail-item">
            <label>Telefoonnummer</label>
            <p><?= esc($offer['client_phone']) ?></p>
        </div>
        <div class="detail-item">
            <label>Postcode</label>
            <p><?= esc($offer['client_postcode']) ?></p>
        </div>
        <div class="detail-item">
            <label>Woonplaats</label>
            <p><?= esc($offer['client_city']) ?></p>
        </div>
        <?php if (!empty($offer['client_address'])): ?>
        <div class="detail-item">
            <label>Adres</label>
            <p><?= esc($offer['client_address']) ?></p>
        </div>
        <?php endif ?>
    </div>
</div>

<div class="detail-card">
    <h3>Projectgegevens</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <label>Project Adres</label>
            <p><?= esc($offer['project_address']) ?></p>
        </div>
        <div class="detail-item">
            <label>Type Gebouw</label>
            <p><?= esc($offer['building_type']) ?></p>
        </div>
        <?php if (!empty($offer['research_area'])): ?>
        <div class="detail-item">
            <label>Onderzoeksgebied</label>
            <p><?= esc($offer['research_area']) ?></p>
        </div>
        <?php endif ?>
        <div class="detail-item">
            <label>Doel Onderzoek</label>
            <p><?= nl2br(esc($offer['research_purpose'])) ?></p>
        </div>
    </div>
</div>

<div class="detail-card">
    <h3>Offerte Details</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <label>Vaste Prijs (excl. BTW)</label>
            <p><strong>€ <?= number_format($offer['fixed_price'] ?? 0, 2, ',', '.') ?></strong></p>
        </div>
        <div class="detail-item">
            <label>Omschrijving Tariefstelling</label>
            <p><?= nl2br(esc($offer['tarief_description'] ?? '')) ?></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
