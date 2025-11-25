<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Offerte Aanmaken</h2>
    <a href="<?= base_url('admin/submission/view/' . $submission['id']) ?>" class="btn btn-secondary">Terug</a>
</div>

<div class="form-card">
    <form action="<?= base_url('admin/offer/store') ?>" method="post" id="offerForm">
        <?= csrf_field() ?>
        <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">

        <div class="form-section">
            <h3>Klantinformatie</h3>
            <div class="info-grid">
                <p><strong>Naam:</strong> <?= esc($submission['naam']) ?></p>
                <p><strong>E-mail:</strong> <?= esc($submission['email']) ?></p>
                <p><strong>Telefoon:</strong> <?= esc($submission['telefoonnummer']) ?></p>
                <p><strong>Adres:</strong> <?= esc($submission['adres']) ?>, <?= esc($submission['postcode']) ?> <?= esc($submission['woonplaats']) ?></p>
            </div>
        </div>

        <div class="form-section">
            <h3>Offerte Items</h3>
            <div id="itemsContainer">
                <div class="item-row">
                    <div class="form-group">
                        <label>Omschrijving</label>
                        <input type="text" name="items[0][description]" required>
                    </div>
                    <div class="form-group">
                        <label>Aantal</label>
                        <input type="number" name="items[0][quantity]" value="1" min="1" required class="item-quantity">
                    </div>
                    <div class="form-group">
                        <label>Prijs per stuk (€)</label>
                        <input type="number" name="items[0][unit_price]" step="0.01" min="0" required class="item-price">
                    </div>
                    <div class="form-group">
                        <label>Totaal (€)</label>
                        <input type="text" class="item-total" readonly>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addItem()">Item Toevoegen</button>
        </div>

        <div class="form-section">
            <h3>Totalen</h3>
            <div class="totals-grid">
                <div class="total-row">
                    <span>Subtotaal:</span>
                    <span id="subtotal">€ 0.00</span>
                </div>
                <div class="total-row">
                    <span>BTW (21%):</span>
                    <span id="btw">€ 0.00</span>
                </div>
                <div class="total-row total-final">
                    <span>Totaal:</span>
                    <span id="total">€ 0.00</span>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Offerte Opslaan</button>
        </div>
    </form>
</div>

<script>
let itemCount = 1;

function addItem() {
    const container = document.getElementById('itemsContainer');
    const newItem = document.createElement('div');
    newItem.className = 'item-row';
    newItem.innerHTML = `
        <div class="form-group">
            <label>Omschrijving</label>
            <input type="text" name="items[${itemCount}][description]" required>
        </div>
        <div class="form-group">
            <label>Aantal</label>
            <input type="number" name="items[${itemCount}][quantity]" value="1" min="1" required class="item-quantity">
        </div>
        <div class="form-group">
            <label>Prijs per stuk (€)</label>
            <input type="number" name="items[${itemCount}][unit_price]" step="0.01" min="0" required class="item-price">
        </div>
        <div class="form-group">
            <label>Totaal (€)</label>
            <input type="text" class="item-total" readonly>
        </div>
        <button type="button" class="btn-remove" onclick="removeItem(this)">×</button>
    `;
    container.appendChild(newItem);
    itemCount++;
    attachCalculationListeners();
}

function removeItem(button) {
    button.parentElement.remove();
    calculateTotals();
}

function attachCalculationListeners() {
    document.querySelectorAll('.item-quantity, .item-price').forEach(input => {
        input.removeEventListener('input', calculateTotals);
        input.addEventListener('input', calculateTotals);
    });
}

function calculateTotals() {
    let subtotal = 0;
    
    document.querySelectorAll('.item-row').forEach(row => {
        const quantity = parseFloat(row.querySelector('.item-quantity').value) || 0;
        const price = parseFloat(row.querySelector('.item-price').value) || 0;
        const total = quantity * price;
        
        row.querySelector('.item-total').value = '€ ' + total.toFixed(2);
        subtotal += total;
    });
    
    const btw = subtotal * 0.21;
    const total = subtotal + btw;
    
    document.getElementById('subtotal').textContent = '€ ' + subtotal.toFixed(2);
    document.getElementById('btw').textContent = '€ ' + btw.toFixed(2);
    document.getElementById('total').textContent = '€ ' + total.toFixed(2);
}

attachCalculationListeners();
</script>

<?= $this->endSection() ?>
