<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        
        <a href="index.php?entity=wallet&action=list" class="text-decoration-none text-muted small mb-3 d-block">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center <?= isset($wallet) ? 'bg-warning text-warning' : 'bg-primary text-primary'; ?> bg-opacity-10 rounded-circle mb-3" style="width: 50px; height: 50px;">
                        <i class="fas <?= isset($wallet) ? 'fa-pencil-alt' : 'fa-wallet'; ?> fa-lg"></i>
                    </div>
                    
                    <h4 class="fw-bold" style="font-family: 'Poppins', sans-serif;">
                        <?= isset($wallet) ? 'Edit Wallet' : 'Tambah Wallet'; ?>
                    </h4>
                    <p class="text-muted small">
                        <?= isset($wallet) ? 'Perbarui informasi dompetmu.' : 'Tambahkan sumber dana baru.'; ?>
                    </p>
                </div>

                <form action="index.php?entity=wallet&action=<?= isset($wallet) ? 'update' : 'save'; ?>" method="POST">
                    
                    <?php if (isset($wallet)): ?>
                        <input type="hidden" name="id" value="<?= $wallet['id']; ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">Nama Wallet</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-font"></i></span>
                            <input type="text" 
                                   name="name" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Contoh: BCA, Gopay" 
                                   value="<?= isset($wallet) ? htmlspecialchars($wallet['name']) : ''; ?>" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted fw-bold ls-1">Saldo Awal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">Rp</span>
                            <input type="number" 
                                   name="initial_balance" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="0" 
                                   value="<?= isset($wallet) ? htmlspecialchars($wallet['initial_balance']) : ''; ?>" 
                                   required>
                        </div>
                        <?php if(!isset($wallet)): ?>
                            <div class="form-text small text-secondary fst-italic mt-1">
                                *Saldo saat ini di dompet tersebut.
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn <?= isset($wallet) ? 'btn-warning text-dark' : 'btn-primary'; ?> py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                            <i class="fas fa-save me-2"></i> 
                            <?= isset($wallet) ? 'Update Perubahan' : 'Simpan Wallet'; ?>
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