<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Panel</div>
                <?php 
                    if(isset($_SESSION['user']) && $_SESSION['user'][2] == 'superadmin') {
                ?>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Bahan Baku
                </a>
                <a class="nav-link" href="produk.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Produk
                </a>
                <a class="nav-link" href="laporan.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Laporan
                </a>
                <a class="nav-link" href="tambah_admin.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tambah Admin 
                </a>
                <?php 
                    } else {                           
                ?>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Transaksi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="pesan.php">Pesan</a>
                        <?php 
                            $count=0;
                            if(isset($_SESSION['cart'])) {
                                $count = count($_SESSION['cart']);
                            }
                        ?>
                        <a class="nav-link" href="keranjang.php">Keranjang(<?php echo $count; ?>)</a>
                    </nav>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: <?= $_SESSION['user'][1]; ?></div>
            <div class="small">Role: <?= $_SESSION['user'][2]; ?></div>
        </div>
    </nav>
</div>