<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Budget Bulanan</h4>
                <p class="text-muted small mb-0">Batasi pengeluaran agar tidak boncos.</p>
            </div>
            
            <a href="index.php?entity=budget&action=add" class="btn btn-primary shadow-sm px-3 py-2" style="border-radius: 10px;">
                <i class="fas fa-plus me-2"></i>Set Budget
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Kategori</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold ls-1">Periode</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold ls-1">Batas Maksimal</th>
                            <th class="text-end pe-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if (empty($budgetList)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="fas fa-chart-pie fa-3x text-light"></i>
                                    </div>
                                    Belum ada budget diatur.<br>
                                    <small>Klik tombol tambah di atas.</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($budgetList as $budget): ?>
                                
                                <?php 
                                    // Format Periode: "2023-12" -> "Desember 2023"
                                    $dateObj = DateTime::createFromFormat('Y-m', $budget['month_year']);
                                    $periodeLabel = $dateObj ? $dateObj->format('F Y') : $budget['month_year'];
                                    
                                    // Ambil ikon kategori (jika ada join) atau default
                                    $iconClass = !empty($budget['category_icon']) ? $budget['category_icon'] : 'fas fa-tag';
                                ?>

                            <tr>
                                <td class="ps-4 fw-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="<?= $iconClass; ?>"></i>
                                        </div>
                                        <?= htmlspecialchars($budget['category_name']); ?>
                                    </div>
                                </td>
                                
                                <td>
                                    <span class="badge bg-light text-dark border border-secondary border-opacity-25 px-3 py-2 rounded-pill">
                                        <i class="fas fa-calendar-alt me-1 text-muted"></i> 
                                        <?= $periodeLabel; ?>
                                    </span>
                                </td>
                                
                                <td class="fw-bold text-dark">
                                    <span style="font-family: 'Inter', monospace;">
                                        Rp <?= number_format($budget['amount_limit'], 0, ',', '.'); ?>
                                    </span>
                                </td>
                                
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="index.php?entity=budget&action=edit&id=<?= $budget['id']; ?>" 
                                           class="btn btn-light text-primary btn-sm border-0" 
                                           title="Edit Budget">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        
                                        <a href="index.php?entity=budget&action=delete&id=<?= $budget['id']; ?>" 
                                           class="btn btn-light text-danger btn-sm border-0"
                                           onclick="return confirm('Yakin hapus budget ini?');"
                                           title="Hapus Budget">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php
require_once 'views/templates/footer.php';
?>