<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        
        <a href="index.php?entity=budget&action=list" class="text-decoration-none text-muted small mb-3 d-block">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center <?= isset($budget) ? 'bg-warning text-warning' : 'bg-primary text-primary'; ?> bg-opacity-10 rounded-circle mb-3" style="width: 50px; height: 50px;">
                        <i class="fas <?= isset($budget) ? 'fa-pencil-alt' : 'fa-chart-pie'; ?> fa-lg"></i>
                    </div>
                    
                    <h4 class="fw-bold" style="font-family: 'Poppins', sans-serif;">
                        <?= isset($budget) ? 'Edit Budget' : 'Set Budget Baru'; ?>
                    </h4>
                    <p class="text-muted small">
                        <?= isset($budget) ? 'Ubah batasan pengeluaran.' : 'Tentukan batas maksimal per kategori.'; ?>
                    </p>
                </div>

                <form action="index.php?entity=budget&action=<?= isset($budget) ? 'update' : 'save'; ?>" method="POST">
                    
                    <?php if (isset($budget)): ?>
                        <input type="hidden" name="id" value="<?= $budget['id']; ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">KATEGORI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-tag"></i></span>
                            <select name="category_id" class="form-select border-start-0 ps-0" required>
                                <option value="" disabled <?= !isset($budget) ? 'selected' : ''; ?>>Pilih Kategori...</option>
                                
                                <?php if (!empty($categoryList)): ?>
                                    <?php foreach ($categoryList as $category): ?>
                                        <?php if ($category['type'] == 'expense'): ?>
                                            <option value="<?= $category['id']; ?>" 
                                                <?= (isset($budget) && $budget['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($category['name']); ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold ls-1">PERIODE BULAN</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="fas fa-calendar-alt"></i></span>
                            <input type="month" 
                                   name="month_year" 
                                   class="form-control border-start-0 ps-0" 
                                   value="<?= isset($budget) ? $budget['month_year'] : date('Y-m'); ?>" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted fw-bold ls-1">BATAS MAKSIMAL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">Rp</span>
                            <input type="number" 
                                   name="amount_limit" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Contoh: 500000" 
                                   value="<?= isset($budget) ? $budget['amount_limit'] : ''; ?>" 
                                   required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn <?= isset($budget) ? 'btn-warning text-dark' : 'btn-primary'; ?> py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                            <i class="fas fa-save me-2"></i> 
                            <?= isset($budget) ? 'Update Budget' : 'Simpan Budget'; ?>
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