<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        
        <a href="index.php?entity=category&action=list" class="text-decoration-none text-muted small mb-3 d-block">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center <?= isset($category) ? 'bg-warning text-warning' : 'bg-primary text-primary'; ?> bg-opacity-10 rounded-circle mb-3" style="width: 50px; height: 50px;">
                        <i class="fas <?= isset($category) ? 'fa-pencil-alt' : 'fa-tags'; ?> fa-lg"></i>
                    </div>
                    
                    <h4 class="fw-bold" style="font-family: 'Poppins', sans-serif;">
                        <?= isset($category) ? 'Edit Kategori' : 'Tambah Kategori'; ?>
                    </h4>
                    <p class="text-muted small">
                        <?= isset($category) ? 'Ubah detail kategori ini.' : 'Buat kelompok pengeluaran/pemasukan baru.'; ?>
                    </p>
                </div>

                <form action="index.php?entity=category&action=<?= isset($category) ? 'update' : 'save'; ?>" method="POST">
                    
                    <?php if (isset($category)): ?>
                        <input type="hidden" name="id" value="<?= $category['id']; ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">NAMA KATEGORI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-font"></i></span>
                            <input type="text" 
                                   name="name" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Contoh: Makan, Gaji, Laundry" 
                                   value="<?= isset($category) ? htmlspecialchars($category['name']) : ''; ?>" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">TIPE TRANSAKSI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-exchange-alt"></i></span>
                            <select name="type" class="form-select border-start-0 ps-0" required>
                                <option value="" disabled <?= !isset($category) ? 'selected' : ''; ?>>Pilih Tipe...</option>
                                
                                <option value="expense" <?= (isset($category) && $category['type'] == 'expense') ? 'selected' : ''; ?>>
                                    Pengeluaran (Expense)
                                </option>
                                
                                <option value="income" <?= (isset($category) && $category['type'] == 'income') ? 'selected' : ''; ?>>
                                    Pemasukan (Income)
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn <?= isset($category) ? 'btn-warning text-dark' : 'btn-primary'; ?> py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                            <i class="fas fa-save me-2"></i> 
                            <?= isset($category) ? 'Update Perubahan' : 'Simpan Kategori'; ?>
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