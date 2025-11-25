<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Inzending Details</h2>
    <div class="header-actions">
        <a href="<?= base_url('admin/submissions') ?>" class="btn btn-secondary">Terug</a>
        <?php if (!$offer): ?>
            <a href="<?= base_url('admin/offer/create/' . $submission['id']) ?>" class="btn btn-primary">Offerte Aanmaken</a>
        <?php else: ?>
            <a href="<?= base_url('admin/offer/view/' . $offer['id']) ?>" class="btn btn-success">Bekijk Offerte</a>
        <?php endif ?>
    </div>
</div>

<div class="detail-card">
    <h3>Klantgegevens</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <label>Naam</label>
            <p><?= esc($submission['naam']) ?></p>
        </div>
        <div class="detail-item">
            <label>E-mail</label>
            <p><?= esc($submission['email']) ?></p>
        </div>
        <div class="detail-item">
            <label>Telefoonnummer</label>
            <p><?= esc($submission['telefoonnummer']) ?></p>
        </div>
        <div class="detail-item">
            <label>Adres</label>
            <p><?= esc($submission['adres']) ?></p>
        </div>
        <div class="detail-item">
            <label>Postcode</label>
            <p><?= esc($submission['postcode']) ?></p>
        </div>
        <div class="detail-item">
            <label>Woonplaats</label>
            <p><?= esc($submission['woonplaats']) ?></p>
        </div>
    </div>
</div>

<div class="detail-card">
    <h3>Projectgegevens</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <label>Project Adres</label>
            <p><?= esc($submission['project_adres']) ?></p>
        </div>
        <div class="detail-item">
            <label>Type Gebouw</label>
            <p><?= esc($submission['type_gebouw']) ?></p>
        </div>
        <div class="detail-item">
            <label>Aantal Analyses</label>
            <p><?= $submission['aantal_analyses'] ?></p>
        </div>
        <div class="detail-item full-width">
            <label>Onderzoeksgebied</label>
            <p><?= nl2br(esc($submission['onderzoeksgebied'])) ?></p>
        </div>
        <div class="detail-item full-width">
            <label>Doel van Onderzoek</label>
            <p><?= nl2br(esc($submission['doel_onderzoek'])) ?></p>
        </div>
        <?php if ($submission['extra_opties']): ?>
            <div class="detail-item full-width">
                <label>Extra Opties</label>
                <p><?= nl2br(esc($submission['extra_opties'])) ?></p>
            </div>
        <?php endif ?>
    </div>
</div>

<div class="detail-card">
    <h3>Status Informatie</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <label>Status</label>
            <p>
                <span class="badge badge-<?= $submission['status'] == 'pending' ? 'warning' : ($submission['status'] == 'processed' ? 'success' : 'secondary') ?>">
                    <?= ucfirst($submission['status']) ?>
                </span>
            </p>
        </div>
        <div class="detail-item">
            <label>Ingediend op</label>
            <p><?= date('d-m-Y H:i', strtotime($submission['created_at'])) ?></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
