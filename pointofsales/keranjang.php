<?php 
session_start();
require './function/login_check.php';
require './function/restrict_superadmin.php';


if(isset($_POST['removeitem'])) {
    foreach($_SESSION['cart'] as $key=> $value) {
        if($value['nama_produk']==$_POST['nama_produk']) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
}

if(isset($_POST['modquantity'])) {
    foreach($_SESSION['cart'] as $key=> $value) {
        if($value['nama_produk']==$_POST['nama_produk']) {
            $_SESSION['cart'][$key]['jumlah_beli']=$_POST['modquantity'];
        }
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
                        <h1 class="mt-4">Keranjang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Keranjang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Produk
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Gambar Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah Beli</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Gambar Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah Beli</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if(isset($_SESSION['cart'])) {
                                            foreach($_SESSION['cart'] as $key => $value) {
                                                echo 
                                                "
                                                <tr>
                                                    <td><img src='$value[gambar_produk]' class='img-thumbnail' width='200px' height='200px'/></td>
                                                    <td>$value[nama_produk]</td>
                                                    <td>Rp.$value[harga_produk]<input class='iprice' type='hidden' value='$value[harga_produk]'/></td>
                                                    <td>
                                                        <form method='post'>
                                                            <input class='form-control iquantity' name='modquantity' onchange='this.form.submit()' type='number' value='$value[jumlah_beli]' min='1'/>
                                                            <input type='hidden' name='nama_produk' value='$value[nama_produk]'/>
                                                        </form>
                                                    </td>
                                                    <td class='itotal'></td>
                                                    <td>
                                                      <form  method='post'>
                                                        <button name='removeitem' type='submit' class='btn btn-danger'>remove</button>
                                                        <input type='hidden' name='nama_produk' value='$value[nama_produk]'/>
                                                      </form>
                                                    </td>
                                                </tr>
                                                ";
                                             }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php 
                                 if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                ?>
                                    <form action="/function/pesan.php" method="post">
                                        <div class="card-mb-4">
                                            <div class="card-header">Total Harga</div>
                                            <div class="card-body" id="gtotal"></div>
                                            <div class="card-footer">
                                                <label>Nama Pemesan</label>
                                                <input name="nama_pemesan" type="text" class="form-control mb-3" />
                                                <button type="submit" name="buatpesanan" class="btn btn-success">Buat Pesanan</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php 
                                 }
                                ?>
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
        <script>
            var gt = 0
            var iprice = document.getElementsByClassName('iprice')
            var iquantity = document.getElementsByClassName('iquantity')
            var itotal = document.getElementsByClassName('itotal')
            var gtotal = document.getElementById('gtotal')

            function subTotal() {
                gt=0;
                for(i=0; i<iprice.length;i++) {
                    itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
                    gt=gt+(iprice[i].value) * (iquantity[i].value)
                }
                gtotal.innerText=gt;
                this.form.submit()
            }

            subTotal();
        </script>
    </body>
</html>
