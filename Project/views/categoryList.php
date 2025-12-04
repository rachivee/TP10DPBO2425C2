<?php
require_once 'views/templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Daftar Kategori</h4>
                <p class="text-muted small mb-0">Atur kategori pengeluaran dan pemasukan di sini.</p>
            </div>
            
            <a href="index.php?entity=category&action=add" class="btn btn-primary shadow-sm px-3 py-2" style="border-radius: 10px;">
                <i class="fas fa-plus me-2"></i>Tambah Kategori
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Nama Kategori</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold ls-1">Tipe</th>
                            <th class="text-end pe-4 py-3 text-secondary small text-uppercase fw-bold ls-1">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if (empty($categoryList)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="fas fa-tags fa-3x text-light"></i>
                                    </div>
                                    Belum ada data kategori.<br>
                                    <small>Klik tombol tambah di atas untuk mulai.</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($categoryList as $category): ?>
                                
                                <?php 
                                    $isExpense = ($category['type'] == 'expense');
                                    $badgeClass = $isExpense ? 'bg-danger bg-opacity-10 text-danger' : 'bg-success bg-opacity-10 text-success';
                                    $typeLabel = $isExpense ? 'Pengeluaran' : 'Pemasukan';
                                    $iconClass = !empty($category['icon']) ? $category['icon'] : 'fas fa-money-bill'; 
                                ?>

                            <tr>
                                <td class="ps-4 fw-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle <?= $badgeClass; ?> d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="<?= $iconClass; ?>"></i>
                                        </div>
                                        <?= htmlspecialchars($category['name']); ?>
                                    </div>
                                </td>
                                
                                <td>
                                    <span class="badge <?= $badgeClass; ?> px-3 py-2 rounded-pill fw-bold border border-opacity-10" style="text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">
                                        <?= $typeLabel; ?>
                                    </span>
                                </td>
                                
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        
                                        <a href="index.php?entity=category&action=edit&id=<?= $category['id']; ?>" 
                                           class="btn btn-light text-primary btn-sm border-0" 
                                           title="Edit Kategori">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        
                                        <a href="index.php?entity=category&action=delete&id=<?= $category['id']; ?>" 
                                           class="btn btn-light text-danger btn-sm border-0"
                                           onclick="return confirm('Apakah anda yakin hapus Kategori <?= $category['name']; ?>?');"
                                           title="Hapus Kategori">
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