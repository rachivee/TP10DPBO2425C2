<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Daftar Wallet</h4>
                <p class="text-muted small mb-0">Atur sumber dana (Cash, Bank, E-Wallet) di sini.</p>
            </div>
            
            <a href="index.php?entity=wallet&action=add" class="btn btn-primary shadow-sm px-3 py-2" style="border-radius: 10px;">
                <i class="fas fa-plus me-2"></i>Tambah Wallet
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Nama Wallet</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold ls-1">Saldo Awal</th>
                            <th class="text-end pe-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if (empty($walletList)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="fas fa-wallet fa-3x text-light"></i>
                                    </div>
                                    Belum ada data wallet.<br>
                                    <small>Klik tombol tambah di atas untuk mulai.</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($walletList as $wallet): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <?= htmlspecialchars($wallet['name']); ?>
                                    </div>
                                </td>
                                
                                <td class="text-secondary fw-bold">
                                    <span style="font-family: 'Inter', monospace;">
                                        Rp <?= number_format($wallet['initial_balance'], 0, ',', '.'); ?>
                                    </span>
                                </td>
                                
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        
                                        <a href="index.php?entity=wallet&action=edit&id=<?= $wallet['id']; ?>" 
                                           class="btn btn-light text-primary btn-sm border-0" 
                                           title="Edit Wallet">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        
                                        <a href="index.php?entity=wallet&action=delete&id=<?= $wallet['id']; ?>" 
                                           class="btn btn-light text-danger btn-sm border-0"
                                           onclick="return confirm('Yakin hapus Wallet <?= $wallet['name']; ?>? Semua transaksi di dalamnya akan ikut terhapus!');"
                                           title="Hapus Wallet">
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