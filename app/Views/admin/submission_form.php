<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Inzending Bewerken</h2>
    <a href="<?= base_url('admin/submission/view/' . $submission['id']) ?>" class="btn btn-secondary">Annuleren</a>
</div>

<div class="form-card">
    <form action="<?= base_url('admin/submission/update/' . $submission['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-section">
            <h3>Klantgegevens</h3>
            <div class="detail-grid">
                <div class="form-group">
                    <label for="naam">Naam *</label>
                    <input type="text" id="naam" name="naam" value="<?= old('naam', $submission['naam']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" value="<?= old('email', $submission['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefoonnummer">Telefoonnummer *</label>
                    <input type="text" id="telefoonnummer" name="telefoonnummer" value="<?= old('telefoonnummer', $submission['telefoonnummer']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="adres">Adres</label>
                    <input type="text" id="adres" name="adres" value="<?= old('adres', $submission['adres']) ?>">
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode *</label>
                    <input type="text" id="postcode" name="postcode" value="<?= old('postcode', $submission['postcode']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="woonplaats">Woonplaats *</label>
                    <input type="text" id="woonplaats" name="woonplaats" value="<?= old('woonplaats', $submission['woonplaats']) ?>" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Projectgegevens</h3>
            <div class="detail-grid">
                <div class="form-group">
                    <label for="project_adres">Projectadres *</label>
                    <input type="text" id="project_adres" name="project_adres" value="<?= old('project_adres', $submission['project_adres']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="type_gebouw">Type gebouw *</label>
                    <input type="text" id="type_gebouw" name="type_gebouw" value="<?= old('type_gebouw', $submission['type_gebouw']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="aantal_analyses">Aantal analyses</label>
                    <input type="number" id="aantal_analyses" name="aantal_analyses" value="<?= old('aantal_analyses', $submission['aantal_analyses']) ?>" min="0">
                </div>
                <div class="form-group full-width">
                    <label for="onderzoeksgebied">Onderzoeksgebied</label>
                    <textarea id="onderzoeksgebied" name="onderzoeksgebied" rows="2"><?= old('onderzoeksgebied', $submission['onderzoeksgebied']) ?></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="doel_onderzoek">Doel onderzoek *</label>
                    <textarea id="doel_onderzoek" name="doel_onderzoek" rows="3" required><?= old('doel_onderzoek', $submission['doel_onderzoek']) ?></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="extra_opties">Extra opties</label>
                    <textarea id="extra_opties" name="extra_opties" rows="3"><?= old('extra_opties', $submission['extra_opties']) ?></textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Status</h3>
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="pending" <?= old('status', $submission['status']) === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="processed" <?= old('status', $submission['status']) === 'processed' ? 'selected' : '' ?>>Processed</option>
                    <option value="archived" <?= old('status', $submission['status']) === 'archived' ? 'selected' : '' ?>>Archived</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
