<?php
require './function/koneksi.php';
require './function/produk.php';
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
                        <h1 class="mt-4">Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                        <button class="btn btn-primary mb-2" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">+</button>
                        <div class="collapse" id="collapseForm" aria-labelledby="headingOne">
                        <div class="card mb-4 mt-4 formcard">
                            <div class="card-header">
                                Tambah Produk
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <label>Nama Produk</label>
                                    <input name="nama_produk" type="text" class="form-control" required/>
                                    <label>Harga Produk</label>
                                    <input name="harga_produk" type="number" class="form-control" required/>
                                    <label class="d-block">Bahan Produk</label>
                                    <?php
                                        $bahanbaku = mysqli_query($conn, "SELECT nama_bahan FROM bahan_baku");
                                        while($fetchbahanbaku = mysqli_fetch_array($bahanbaku, MYSQLI_ASSOC)) {
                                    ?>
                                    <div class="d-block">
                                        <input name="bahan_produk[]" class="form-check-input" type="checkbox" value="<?=$fetchbahanbaku['nama_bahan']?>" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           <?=$fetchbahanbaku['nama_bahan']?>
                                        </label>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                    <label>Gambar</label>
                                    <input name="gambar_produk" type="file" class="form-control" required/>
                                </div>
                                <div class="card-footer"> 
                                    <button type="submit" class="btn btn-primary" name="tambahproduk">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">Tutup</button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Produk
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Bahan Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Bahan Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $produk = mysqli_query($conn, "SELECT * FROM produk");
                                        $i = 1;
                                        while($fetchproduk = mysqli_fetch_array($produk, MYSQLI_ASSOC)) {
                                            $arr = json_decode($fetchproduk['bahan_produk']);
                                            $implodeBahanProduk = implode(" , ",$arr);
                                    ?>
                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><img src="<?=$fetchproduk['gambar_produk']?>" class="img-thumbnail" width="200px" height="200px"/></td>
                                            <td><?=$fetchproduk['nama_produk']?></td>
                                            <td><?= 'Rp'.$fetchproduk['harga_produk']?></td>
                                            <td><?=$implodeBahanProduk?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$i?>">
                                                 Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$i?>">
                                                 Delete
                                                </button>
                                                <!-- Modal -->

                                                <div class="modal fade" id="edit<?=$i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Produk</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <p><?=$fetchproduk['nama_produk']?></p>
                                                                <input name="nama_produk" type="hidden" value="<?= $fetchproduk['nama_produk']?>" required/>
                                                                <label>Harga Produk</label>
                                                                <input name="harga_produk" type="text" class="form-control" value="<?=$fetchproduk['harga_produk']?>" required/>
                                                                <label class="d-block">Bahan Produk</label>
                                                                <?php
                                                                    $bahanbaku = mysqli_query($conn, "SELECT nama_bahan FROM bahan_baku");
                                                                    while($fetchbahanbaku = mysqli_fetch_array($bahanbaku, MYSQLI_ASSOC)) {
                                                                ?>
                                                                <div class="d-block">
                                                                    <input name="bahan_produk[]" class="form-check-input" type="checkbox" value="<?=$fetchbahanbaku['nama_bahan']?>" id="flexCheckDefault" <?php in_array ($fetchbahanbaku['nama_bahan'], $arr) ? print "checked" : "";?> >
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                     <?=$fetchbahanbaku['nama_bahan']?>
                                                                    </label>
                                                                </div>
                                                                <?php 
                                                                    }
                                                                ?>
                                                                 <label>Gambar</label>
                                                                 <input name="gambar_produk" type="file" class="form-control" required/>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="perbaruiproduk" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="delete<?=$i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Produk</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <p><?=$fetchproduk['nama_produk']?></p>
                                                                <input name="nama_produk" type="hidden" value="<?= $fetchproduk['nama_produk']?>"/>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="hapusproduk" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="public/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="public/assets/demo/chart-area-demo.js"></script>
        <script src="public/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="public/js/datatables-simple-demo.js"></script>
    </body>
</html>
