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
            <label>Adres</label>
            <p><?= esc($offer['client_address']) ?>, <?= esc($offer['client_postcode']) ?> <?= esc($offer['client_city']) ?></p>
        </div>
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
        <div class="detail-item">
            <label>Aantal Analyses</label>
            <p><?= $offer['number_of_analyses'] ?></p>
        </div>
    </div>
</div>

<div class="detail-card">
    <h3>Offerte Items</h3>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Omschrijving</th>
                    <th>Aantal</th>
                    <th>Prijs per stuk</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($offer['items'])): ?>
                    <?php foreach ($offer['items'] as $item): ?>
                        <tr>
                            <td><?= esc($item['description']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>€ <?= number_format($item['unit_price'], 2, ',', '.') ?></td>
                            <td>€ <?= number_format($item['total_price'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Subtotaal:</strong></td>
                    <td><strong>€ <?= number_format($offer['subtotal'], 2, ',', '.') ?></strong></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"><strong>BTW (<?= $offer['btw_percentage'] ?>%):</strong></td>
                    <td><strong>€ <?= number_format($offer['btw_amount'], 2, ',', '.') ?></strong></td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" class="text-right"><strong>Totaal:</strong></td>
                    <td><strong>€ <?= number_format($offer['total_amount'], 2, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
