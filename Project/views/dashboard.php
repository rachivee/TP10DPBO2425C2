<?php require_once 'views/templates/header.php'; ?>

<div class="row g-4 mb-5">
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-wallet fa-lg"></i>
                    </div>
                </div>
                <p class="mb-1 opacity-75 small text-uppercase ls-1">Saldo Saat Ini</p>
                <h2 class="fw-bold mb-0" style="font-family: 'Inter', monospace;">
                    Rp <?= number_format($totalAssets, 0, ',', '.'); ?>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <h6 class="fw-bold mb-0 text-secondary">Pemasukan</h6>
                </div>
                <h3 class="fw-bold text-dark mb-0">
                    Rp <?= number_format($monthlyStats['income'], 0, ',', '.'); ?>
                </h3>
                <p class="text-muted small mt-2 mb-0">Total masuk bulan ini</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <h6 class="fw-bold mb-0 text-secondary">Pengeluaran</h6>
                </div>
                <h3 class="fw-bold text-dark mb-0">
                    Rp <?= number_format($monthlyStats['expense'], 0, ',', '.'); ?>
                </h3>
                <p class="text-muted small mt-2 mb-0">Total keluar bulan ini</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Transaksi Terakhir</h5>
            <a href="index.php?entity=transaction&action=list" class="text-decoration-none small fw-bold">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if (empty($recentTransactions)): ?>
                        <div class="text-center py-5 text-muted">Belum ada transaksi.</div>
                    <?php else: ?>
                        <?php foreach ($recentTransactions as $trx): 
                            $isExpense = ($trx['category_type'] == 'expense');
                            $colorClass = $isExpense ? 'text-danger' : 'text-success';
                            $operator   = $isExpense ? '- ' : '+ ';
                        ?>
                        <div class="list-group-item p-3 border-light action-hover">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3 text-secondary" style="width: 40px; height: 40px;">
                                        <i class="<?= $trx['category_icon'] ?? 'fas fa-tag'; ?>"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark"><?= htmlspecialchars($trx['category_name']); ?></h6>
                                        <small class="text-muted">
                                            <?= date('d M', strtotime($trx['transaction_date'])); ?> &bull; 
                                            <?= htmlspecialchars($trx['wallet_name']); ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="fw-bold <?= $colorClass; ?>">
                                    <?= $operator; ?>Rp <?= number_format($trx['amount'], 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Dompet Saya</h5>
            <a href="index.php?entity=wallet&action=add" class="btn btn-sm btn-light text-primary rounded-circle" style="width:32px; height:32px;"><i class="fas fa-plus"></i></a>
        </div>
        
        <?php foreach ($walletList as $wallet): ?>
            <?php $balClass = $wallet['current_balance'] < 0 ? 'text-danger' : 'text-dark'; ?>
            
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold text-dark"><?= htmlspecialchars($wallet['name']); ?></p>
                            <small class="text-muted">Saldo Saat Ini</small>
                        </div>
                    </div>
                    <span class="fw-bold <?= $balClass; ?>">
                        Rp <?= number_format($wallet['current_balance'], 0, ',', '.'); ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="d-grid mt-4">
            <a href="index.php?entity=transaction&action=add" class="btn btn-primary py-3 rounded-4 fw-bold shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Catat Transaksi Baru
            </a>
        </div>
    </div>
</div>

<?php require_once 'views/templates/footer.php'; ?>