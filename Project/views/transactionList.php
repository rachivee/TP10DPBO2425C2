<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Riwayat Transaksi</h4>
                <p class="text-muted small mb-0">Pantau arus kas masuk dan keluar secara detail.</p>
            </div>
            
            <a href="index.php?entity=transaction&action=add" class="btn btn-primary shadow-sm px-3 py-2" style="border-radius: 10px;">
                <i class="fas fa-plus me-2"></i>Catat Transaksi
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Tanggal</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold ls-1">Kategori & Ket</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold ls-1">Wallet</th>
                            <th class="text-end py-3 text-secondary small text-uppercase fw-bold ls-1">Nominal</th>
                            <th class="text-end pe-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if (empty($transactionList)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="fas fa-receipt fa-3x text-light"></i>
                                    </div>
                                    Belum ada transaksi tercatat.<br>
                                    <small>Mulai catat pengeluaranmu hari ini.</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($transactionList as $trx): ?>
                                <?php 
                                    $isExpense = ($trx['category_type'] == 'expense');
                                    $colorClass = $isExpense ? 'text-danger' : 'text-success';
                                    $bgClass    = $isExpense ? 'bg-danger' : 'bg-success';
                                    $operator   = $isExpense ? '- ' : '+ ';
                                    $dateFormatted = date('d M Y', strtotime($trx['transaction_date']));
                                    $iconClass = !empty($trx['category_icon']) ? $trx['category_icon'] : 'fas fa-exchange-alt';
                                ?>
                            <tr>
                                <td class="ps-4 text-secondary small fw-bold">
                                    <?= $dateFormatted; ?>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle <?= $bgClass; ?> bg-opacity-10 <?= $colorClass; ?> d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="<?= $iconClass; ?>"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($trx['category_name']); ?></div>
                                            <div class="small text-muted fst-italic">
                                                <?= !empty($trx['description']) ? htmlspecialchars($trx['description']) : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <span class="badge bg-light text-secondary border border-secondary border-opacity-25 rounded-pill px-3">
                                        <?= htmlspecialchars($trx['wallet_name']); ?>
                                    </span>
                                </td>

                                <td class="text-end fw-bold <?= $colorClass; ?>">
                                    <span style="font-family: 'Inter', monospace;">
                                        <?= $operator; ?>Rp <?= number_format($trx['amount'], 0, ',', '.'); ?>
                                    </span>
                                </td>
                                
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        
                                        <a href="index.php?entity=transaction&action=edit&id=<?= $trx['id']; ?>" 
                                           class="btn btn-light text-primary btn-sm border-0" 
                                           title="Edit Transaksi">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        
                                        <a href="index.php?entity=transaction&action=delete&id=<?= $trx['id']; ?>" 
                                           class="btn btn-light text-danger btn-sm border-0"
                                           onclick="return confirm('Apakah anda yakin hapus transaksi ini? Saldo wallet akan dikembalikan.');"
                                           title="Hapus Transaksi">
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