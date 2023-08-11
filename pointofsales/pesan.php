<?php
require './function/koneksi.php';
require './function/produk.php';
require './function/restrict_superadmin.php';

if(isset($_POST['addtocart'])) {
    if(isset($_SESSION['cart'])) {
        $myItems = array_column($_SESSION['cart'],'nama_produk');
        if(in_array($_POST['nama_produk'],$myItems)) {
            echo "
            <script>
                alert('Item Already Added');
                window.location.href = '/pesan.php';
            </script>
            ";
        } else {
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = array('gambar_produk'=>$_POST['gambar_produk'],'nama_produk'=>$_POST['nama_produk'],'harga_produk'=>$_POST['harga_produk'],'jumlah_beli'=>'1');
        }
    } else {
        $_SESSION['cart'][0] = array('gambar_produk'=>$_POST['gambar_produk'],'nama_produk'=>$_POST['nama_produk'],'harga_produk'=>$_POST['harga_produk'],'jumlah_beli'=>'1');
    }
}
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
                        <h1 class="mt-4">Order</h1>
                        <div class="row">
                            <?php
                                $produk = mysqli_query($conn, "SELECT nama_produk, harga_produk, gambar_produk FROM produk");
                                while($fetchproduk = mysqli_fetch_array($produk, MYSQLI_ASSOC)) {
                            ?>
                            <div class="col-lg-3 mb-5">
                                <div class="card" style="width: 18rem;">
                                <form method="post">
                                    <div class="card-body">
                                        <img src="<?=$fetchproduk['gambar_produk']?>" class="img-thumbnail" width="200px" height="200px"/>
                                        <h5 class="card-title"><?=$fetchproduk['nama_produk']?></h5>
                                        <p class="card-text"><?="Rp.".$fetchproduk['harga_produk']?></p>
                                        <input type="hidden" name="gambar_produk" value="<?=$fetchproduk['gambar_produk']?>"/>
                                        <input type="hidden" name="nama_produk" value="<?=$fetchproduk['nama_produk']?>"/>
                                        <input type="hidden" name="harga_produk" value="<?=$fetchproduk['harga_produk']?>"/>
                                        <button type="submit" name="addtocart" class="btn btn-success">add to cart</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <?php 
                                }
                            ?>
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
