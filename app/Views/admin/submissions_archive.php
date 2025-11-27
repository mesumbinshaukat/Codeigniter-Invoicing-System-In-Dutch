<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Gearchiveerde Inzendingen</h2>
    <a href="<?= base_url('admin/submissions') ?>" class="btn btn-secondary">Terug naar actieve inzendingen</a>
</div>

<?php if (!empty($submissions)): ?>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>E-mail</th>
                    <th>Status</th>
                    <th>Laatst bijgewerkt</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $submission): ?>
                    <tr>
                        <td>#<?= $submission['id'] ?></td>
                        <td><?= esc($submission['naam']) ?></td>
                        <td><?= esc($submission['email']) ?></td>
                        <td>
                            <span class="badge badge-secondary">Archived</span>
                        </td>
                        <td><?= date('d-m-Y H:i', strtotime($submission['updated_at'] ?? $submission['created_at'])) ?></td>
                        <td class="table-actions">
                            <a href="<?= base_url('admin/submission/view/' . $submission['id']) ?>" class="btn btn-sm btn-primary">Bekijken</a>
                            <form action="<?= base_url('admin/submission/restore/' . $submission['id']) ?>" method="post" class="inline-form">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-success">Herstellen</button>
                            </form>
                            <form action="<?= base_url('admin/submission/delete/' . $submission['id']) ?>" method="post" class="inline-form" onsubmit="return confirm('Definitief verwijderen?');">
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
            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
        </svg>
        <h3>Geen gearchiveerde inzendingen</h3>
        <p>Archief is momenteel leeg.</p>
    </div>
<?php endif ?>

<?= $this->endSection() ?>
