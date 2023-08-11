<?php 
  session_start(); 
  require './function/koneksi.php';
  require './function/login_check.php';
  require './function/restrict_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Fakekopi</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="public/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php
            include('partials/topnav.php');
        ?>
        <div id="layoutSidenav">
            <?php
              include('partials/sidenav.php');
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Laporan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Data Pesanan 
                            <a class="btn btn-success" href="export.php">Excel</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemesan</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Tanggal Pesanan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemesan</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Tanggal Pesanan</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $order = mysqli_query($conn, "SELECT o.nama_pemesan, o.nama_produk, p.harga_produk, o.jumlah_pesanan, o.tanggal_pemesan FROM `order` o, produk p WHERE o.nama_produk = p.nama_produk ORDER BY o.tanggal_pemesan DESC");
                                            $Num = 1;
                                            while($fetchOrder = mysqli_fetch_array($order, MYSQLI_ASSOC)) {
                                                $tanggalPemesanan = date('Y-m-d',strtotime($fetchOrder['tanggal_pemesan']))
                                        ?>
                                        <tr>
                                            <td><?= $Num++ ?></td>
                                            <td><?= $fetchOrder['nama_pemesan'] ?></td>
                                            <td><?= $fetchOrder['nama_produk'] ?></td>
                                            <td><?= $fetchOrder['harga_produk'] ?></td>
                                            <td><?= $fetchOrder['jumlah_pesanan'] ?></td>
                                            <td><?= $tanggalPemesanan ?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- use version 0.20.0 -->
        <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
        <script type="module">

            const xport = document.getElementById('xport');

            xport.addEventListener("click", async() => {
                /* dynamically import the library in the event listener */
                const XLSX = await import("https://cdn.sheetjs.com/xlsx-0.20.0/package/xlsx.mjs");
                const elt = document.getElementById('datatablesSimple');
                const wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
                XLSX.writeFile(wb,('laporan_pesanan.' + 'xlsx'));
            });
        </script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="public/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="public/assets/demo/chart-area-demo.js"></script>
        <script src="public/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="public/js/datatables-simple-demo.js"></script>
    </body>
</html>
