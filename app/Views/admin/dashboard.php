<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #dbeafe;">
            <svg width="32" height="32" viewBox="0 0 20 20" fill="#3b82f6">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="stat-content">
            <h3>Totaal Inzendingen</h3>
            <p class="stat-number"><?= $total_submissions ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7;">
            <svg width="32" height="32" viewBox="0 0 20 20" fill="#f59e0b">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="stat-content">
            <h3>In Behandeling</h3>
            <p class="stat-number"><?= $pending_submissions ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: #d1fae5;">
            <svg width="32" height="32" viewBox="0 0 20 20" fill="#10b981">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="stat-content">
            <h3>Totaal Offertes</h3>
            <p class="stat-number"><?= $total_offers ?></p>
        </div>
    </div>
</div>

<div class="recent-section">
    <h2>Recente Inzendingen</h2>
    <?php if (!empty($recent_submissions)): ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>E-mail</th>
                        <th>Type Gebouw</th>
                        <th>Status</th>
                        <th>Datum</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_submissions as $submission): ?>
                        <tr>
                            <td><?= esc($submission['naam']) ?></td>
                            <td><?= esc($submission['email']) ?></td>
                            <td><?= esc($submission['type_gebouw']) ?></td>
                            <td>
                                <span class="badge badge-<?= $submission['status'] == 'pending' ? 'warning' : 'success' ?>">
                                    <?= ucfirst($submission['status']) ?>
                                </span>
                            </td>
                            <td><?= date('d-m-Y H:i', strtotime($submission['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/submission/view/' . $submission['id']) ?>" class="btn btn-sm btn-primary">Bekijken</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="empty-state">Geen recente inzendingen</p>
    <?php endif ?>
</div>

<?= $this->endSection() ?>
