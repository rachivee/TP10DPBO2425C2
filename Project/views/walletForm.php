<?php
require_once 'views/templates/header.php';

// Helper Logic untuk menentukan Mode (Add vs Edit)
$isEdit = isset($wallet); // Mengecek apakah variabel $wallet dikirim dari controller
?>

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        
        <a href="index.php?entity=wallet&action=list" class="text-decoration-none text-muted small mb-3 d-block">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center <?= $isEdit ? 'bg-warning text-warning' : 'bg-primary text-primary'; ?> bg-opacity-10 rounded-circle mb-3" style="width: 50px; height: 50px;">
                        <i class="fas <?= $isEdit ? 'fa-pencil-alt' : 'fa-wallet'; ?> fa-lg"></i>
                    </div>
                    
                    <h4 class="fw-bold" style="font-family: 'Poppins', sans-serif;">
                        <?php echo $isEdit ? 'Edit Wallet' : 'Tambah Wallet'; ?>
                    </h4>
                    <p class="text-muted small">
                        <?php echo $isEdit ? 'Perbarui informasi Walletmu.' : 'Tambahkan sumber dana baru.'; ?>
                    </p>
                </div>

                <form action="index.php?entity=wallet&action=<?php echo $isEdit ? 'update&id=' . $wallet['id'] : 'save'; ?>" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">Nama Wallet</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-font"></i></span>
                            <input type="text" 
                                   name="name" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Contoh: BCA, Gopay" 
                                   value="<?php echo $isEdit ? htmlspecialchars($wallet['name']) : ''; ?>" 
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
                                   value="<?php echo $isEdit ? htmlspecialchars($wallet['initial_balance']) : ''; ?>" 
                                   required>
                        </div>
                        <?php if(!$isEdit): ?>
                            <div class="form-text small text-secondary fst-italic mt-1">
                                *Saldo saat ini di Wallet tersebut.
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn <?= $isEdit ? 'btn-warning text-dark' : 'btn-primary'; ?> py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                            <i class="fas fa-save me-2"></i> 
                            <?php echo $isEdit ? 'Update Perubahan' : 'Simpan Wallet'; ?>
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