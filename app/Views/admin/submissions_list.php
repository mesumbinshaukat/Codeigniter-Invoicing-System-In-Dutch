<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Alle Inzendingen</h2>
</div>

<?php if (!empty($submissions)): ?>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>E-mail</th>
                    <th>Telefoonnummer</th>
                    <th>Type Gebouw</th>
                    <th>Aantal Analyses</th>
                    <th>Status</th>
                    <th>Datum</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $submission): ?>
                    <tr>
                        <td>#<?= $submission['id'] ?></td>
                        <td><?= esc($submission['naam']) ?></td>
                        <td><?= esc($submission['email']) ?></td>
                        <td><?= esc($submission['telefoonnummer']) ?></td>
                        <td><?= esc($submission['type_gebouw']) ?></td>
                        <td><?= $submission['aantal_analyses'] ?? '-' ?></td>
                        <td>
                            <?php
                                $badgeMap = [
                                    'pending' => 'warning',
                                    'processed' => 'success',
                                    'archived' => 'secondary',
                                ];
                                $status = $submission['status'] ?? 'pending';
                                $badgeClass = $badgeMap[$status] ?? 'secondary';
                            ?>
                            <span class="badge badge-<?= $badgeClass ?>">
                                <?= ucfirst($status) ?>
                            </span>
                        </td>
                        <td><?= date('d-m-Y H:i', strtotime($submission['created_at'])) ?></td>
                        <td class="table-actions">
                            <a href="<?= base_url('admin/submission/view/' . $submission['id']) ?>" class="btn btn-sm btn-primary">Bekijken</a>
                            <a href="<?= base_url('admin/submission/edit/' . $submission['id']) ?>" class="btn btn-sm btn-secondary">Bewerken</a>
                            <form action="<?= base_url('admin/submission/copy/' . $submission['id']) ?>" method="post" class="inline-form">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-info">Kopiëren</button>
                            </form>
                            <form action="<?= base_url('admin/submission/archive/' . $submission['id']) ?>" method="post" class="inline-form" onsubmit="return confirm('Weet u zeker dat u deze inzending wilt archiveren?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-warning">Archiveren</button>
                            </form>
                            <form action="<?= base_url('admin/submission/delete/' . $submission['id']) ?>" method="post" class="inline-form" onsubmit="return confirm('Definitief verwijderen? Deze actie kan niet ongedaan gemaakt worden.');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-danger">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="empty-state-card">
        <svg width="64" height="64" viewBox="0 0 20 20" fill="#9ca3af">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
        </svg>
        <h3>Geen inzendingen gevonden</h3>
        <p>Er zijn nog geen formulierinzendingen ontvangen.</p>
    </div>
<?php endif ?>

<?= $this->endSection() ?>
