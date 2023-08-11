
<?php
    require './function/koneksi.php';
    require './function/bahan_baku.php';
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
                        <h1 class="mt-4">Bahan Baku</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Bahan Baku</li>
                        </ol>
                        <button class="btn btn-primary mb-2" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">+</button>
                        <div class="collapse" id="collapseForm" aria-labelledby="headingOne">
                        <div class="card mb-4 mt-4 formcard">
                            <div class="card-header">
                                Tambah Bahan Baku
                            </div>
                            <form method="post">
                                <div class="card-body">
                                    <label>Nama Bahan</label>
                                    <input name="nama_bahan" type="text" class="form-control" />
                                    <label>Jumlah Bahan</label>
                                    <input name="jumlah_bahan" type="number" min="1" class="form-control" />
                                    <label>Satuan Bahan</label>
                                    <input name="satuan_bahan" type="text" class="form-control" />
                                    <label>Pemakaian</label>
                                    <input name="pemakaian" type="text" class="form-control" />
                                </div>
                                <div class="card-footer"> 
                                    <button type="submit" class="btn btn-primary" name="tambahbahanbaku">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">Tutup</button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bahan Baku
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bahan</th>
                                            <th>Jumlah Bahan</th>
                                            <th>Satuan Bahan</th>
                                            <th>Pemakaian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bahan</th>
                                            <th>Jumlah Bahan</th>
                                            <th>Satuan Bahan</th>
                                            <th>Pemakaian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                           $bahanbaku = mysqli_query($conn, "SELECT * FROM bahan_baku");
                                           $i = 1;
                                           while($fetchbahanbaku = mysqli_fetch_array($bahanbaku, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><?=$fetchbahanbaku['nama_bahan']?></td>
                                            <td><?=$fetchbahanbaku['jumlah_bahan']?></td>
                                            <td><?=$fetchbahanbaku['satuan_bahan']?></td>
                                            <td><?=$fetchbahanbaku['pemakaian']?></td>
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
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Bahan Baku </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <p><?=$fetchbahanbaku['nama_bahan']?></p>
                                                                <input name="nama_bahan" type="hidden" value="<?=$fetchbahanbaku['nama_bahan']?>"/>
                                                                <label>Jumlah Bahan</label>
                                                                <input name="jumlah_bahan" type="number" min="1" class="form-control" value="<?=$fetchbahanbaku['jumlah_bahan']?>"/>
                                                                <label>Satuan Bahan</label>
                                                                <input name="satuan_bahan" type="text" class="form-control" value="<?=$fetchbahanbaku['satuan_bahan']?>"/>
                                                                <label>Pemakaian</label>
                                                                <input name="pemakaian" type="text" class="form-control" value="<?=$fetchbahanbaku['pemakaian']?>"/>                                                      
                                                            </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary" name="perbaruibahanbaku">Simpan</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="delete<?=$i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post">
                                                        <div class="modal-body">
                                                            <p>Yakin Ingin Hapus <?=$fetchbahanbaku['nama_bahan']?></p> 
                                                            <input name="nama_bahan" type="hidden" value="<?=$fetchbahanbaku['nama_bahan']?>"/> 
                                                        </div>                                                
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Jangan Dulu Deh</button>
                                                            <button type="submit" class="btn btn-primary" name='hapusbahanbaku'>Tentu Saja</button>
                                                        </div>
                                                        </form>
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
