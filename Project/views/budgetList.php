<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Monitoring Budget</h4>
                <p class="text-muted small mb-0">Pantau realisasi anggaran bulan ini.</p>
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
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Kategori & Periode</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold ls-1" style="width: 30%;">Progress Pemakaian</th>
                            <th class="py-3 text-end text-secondary small text-uppercase fw-bold ls-1">Sisa Budget</th>
                            <th class="text-end pe-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if (empty($budgetList)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="mb-3"><i class="fas fa-chart-pie fa-3x text-light"></i></div>
                                    Belum ada budget.<br><small>Ayo atur keuanganmu!</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($budgetList as $budget): ?>
                                
                                <?php 
                                    $dateObj = DateTime::createFromFormat('Y-m', $budget['month_year']);
                                    $periodeLabel = $dateObj ? $dateObj->format('M Y') : $budget['month_year'];
                                    
                                    $limit = $budget['amount_limit'];
                                    $spent = $budget['total_spent']; 
                                    $remaining = $limit - $spent;
                                    
                                    $percent = ($limit > 0) ? ($spent / $limit) * 100 : 0;
                                    
                                    if ($percent == 100) {
                                        $barColor = 'bg-danger';
                                        $textColor = 'text-danger fw-bold';
                                        $statusText = 'Habis';
                                    } elseif ($percent >= 100) {
                                        $barColor = 'bg-danger';
                                        $textColor = 'text-danger fw-bold';
                                        $statusText = 'Over Budget';
                                    } elseif ($percent >= 80) {
                                        $barColor = 'bg-warning';
                                        $textColor = 'text-warning fw-bold';
                                        $statusText = 'Hampir Habis';
                                    } else {
                                        $barColor = 'bg-success';
                                        $textColor = 'text-success fw-bold';
                                        $statusText = 'Aman';
                                    }
                                    
                                    $iconClass = !empty($budget['category_icon']) ? $budget['category_icon'] : 'fas fa-tag';
                                ?>

                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                            <i class="<?= $iconClass; ?>"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($budget['category_name']); ?></div>
                                            <span class="badge bg-light text-secondary border border-secondary border-opacity-25 rounded-pill" style="font-size: 0.7rem;">
                                                <?= $periodeLabel; ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span class="text-muted">Terpakai: Rp <?= number_format($spent, 0, ',', '.'); ?></span>
                                        <span class="text-muted">Batas: Rp <?= number_format($limit, 0, ',', '.'); ?></span>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 10px;">
                                        <div class="progress-bar <?= $barColor; ?>" role="progressbar" 
                                             style="width: <?= min($percent, 100); ?>%;" 
                                             aria-valuenow="<?= $percent; ?>" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="<?= $textColor; ?>" style="font-size: 0.7rem;">
                                        <?= number_format($percent, 1); ?>% (<?= $statusText; ?>)
                                    </small>
                                </td>
                                
                                <td class="text-end fw-bold">
                                    <?php if ($remaining < 0): ?>
                                        <span class="text-danger">
                                            - Rp <?= number_format(abs($remaining), 0, ',', '.'); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-success">
                                            Rp <?= number_format($remaining, 0, ',', '.'); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="text-end pe-4">
                                    <a href="index.php?entity=budget&action=edit&id=<?= $budget['id']; ?>" class="btn btn-light text-primary btn-sm border-0"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="index.php?entity=budget&action=delete&id=<?= $budget['id']; ?>" class="btn btn-light text-danger btn-sm border-0" onclick="return confirm('Apakah anda yakin hapus budget?');"><i class="fas fa-trash"></i></a>
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

<?php require_once 'views/templates/footer.php'; ?>