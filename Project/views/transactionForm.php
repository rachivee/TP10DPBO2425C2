<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        
        <a href="index.php?entity=transaction&action=list" class="text-decoration-none text-muted small mb-3 d-block">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat
        </a>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center <?= isset($transaction) ? 'bg-warning text-warning' : 'bg-primary text-primary'; ?> bg-opacity-10 rounded-circle mb-3" style="width: 50px; height: 50px;">
                        <i class="fas <?= isset($transaction) ? 'fa-pencil-alt' : 'fa-receipt'; ?> fa-lg"></i>
                    </div>
                    
                    <h4 class="fw-bold" style="font-family: 'Poppins', sans-serif;">
                        <?= isset($transaction) ? 'Edit Transaksi' : 'Catat Transaksi'; ?>
                    </h4>
                    <p class="text-muted small">
                        <?= isset($transaction) ? 'Koreksi data transaksi.' : 'Masukkan pengeluaran atau pemasukan baru.'; ?>
                    </p>
                </div>

                <form action="index.php?entity=transaction&action=<?= isset($transaction) ? 'update' : 'save'; ?>" method="POST">
                    
                    <?php if (isset($transaction)): ?>
                        <input type="hidden" name="id" value="<?= $transaction['id']; ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">TANGGAL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" 
                                   name="transaction_date" 
                                   class="form-control border-start-0 ps-0" 
                                   value="<?= isset($transaction) ? $transaction['transaction_date'] : date('Y-m-d'); ?>" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">SUMBER DANA (WALLET)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-wallet"></i></span>
                            <select name="wallet_id" class="form-select border-start-0 ps-0" required>
                                <option value="" disabled <?= !isset($transaction) ? 'selected' : ''; ?>>Pilih Dompet...</option>

                                <?php if (!empty($walletList)): ?>
                                    <?php foreach ($walletList as $wallet): ?>
                                        <option value="<?= $wallet['id']; ?>" 
                                            <?= (isset($transaction) && $transaction['wallet_id'] == $wallet['id']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($wallet['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">KATEGORI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-tags"></i></span>
                            <select name="category_id" class="form-select border-start-0 ps-0" required>
                                <option value="" disabled <?= !isset($transaction) ? 'selected' : ''; ?>>Pilih Kategori...</option>
                                
                                <?php if (!empty($categoryList)): ?>
                                    <?php foreach ($categoryList as $category): ?>
                                        <option value="<?= $category['id']; ?>" 
                                            <?= (isset($transaction) && $transaction['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                            
                                            <?= htmlspecialchars($category['name']); ?> 
                                            (<?= ucfirst($category['type']); ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">TOTAL NOMINAL</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-end-0 text-primary fw-bold">Rp</span>
                            <input type="number" 
                                   name="amount" 
                                   class="form-control border-start-0 ps-0 fw-bold text-dark" 
                                   placeholder="0" 
                                   value="<?= isset($transaction) ? $transaction['amount'] : ''; ?>" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted fw-bold ls-1">KETERANGAN (OPSIONAL)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-pen"></i></span>
                            <textarea name="description" 
                                      class="form-control border-start-0 ps-0" 
                                      rows="2" 
                                      placeholder="Contoh: Makan Siang, Bensin, Gaji Bulanan"><?= isset($transaction) ? htmlspecialchars($transaction['description']) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="d-grid">    
                        <button type="submit" class="btn <?= isset($transaction) ? 'btn-warning text-dark' : 'btn-primary'; ?> py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                            <i class="fas fa-save me-2"></i> 
                            <?= isset($transaction) ? 'Update Transaksi' : 'Simpan Transaksi'; ?>
                        </button>
                    </div>

                </form>
                </div>
        </div>
    </div>
</div>

<?php
require_once 'views/templates/footer.php';
?>