<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Alle Offertes</h2>
</div>

<?php if (!empty($offers)): ?>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Offertenummer</th>
                    <th>Klant</th>
                    <th>E-mail</th>
                    <th>Totaalbedrag</th>
                    <th>Status</th>
                    <th>Datum</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($offers as $offer): ?>
                    <tr>
                        <td><strong><?= esc($offer['offer_number']) ?></strong></td>
                        <td><?= esc($offer['client_name']) ?></td>
                        <td><?= esc($offer['client_email']) ?></td>
                        <td>€ <?= number_format($offer['fixed_price'] ?? 0, 2, ',', '.') ?></td>
                        <td>
                            <span class="badge badge-<?= $offer['status'] == 'draft' ? 'warning' : ($offer['status'] == 'sent' ? 'info' : ($offer['status'] == 'accepted' ? 'success' : 'danger')) ?>">
                                <?= ucfirst($offer['status']) ?>
                            </span>
                        </td>
                        <td><?= date('d-m-Y', strtotime($offer['created_at'])) ?></td>
                        <td>
                            <a href="<?= base_url('admin/offer/view/' . $offer['id']) ?>" class="btn btn-sm btn-primary">Bekijken</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="empty-state-card">
        <svg width="64" height="64" viewBox="0 0 20 20" fill="#9ca3af">
            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
        </svg>
        <h3>Geen offertes gevonden</h3>
        <p>Er zijn nog geen offertes aangemaakt.</p>
    </div>
<?php endif ?>

<?= $this->endSection() ?>
