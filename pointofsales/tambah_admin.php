<?php
session_start();
require './function/login_check.php';
require './function/restrict_admin.php';
require './function/pengguna.php';
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
                        <h1 class="mt-4">Tambah Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah Admin</li>
                        </ol>
                        <button class="btn btn-primary mb-2" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">+</button>
                        <div class="collapse" id="collapseForm" aria-labelledby="headingOne">
                        <div class="card mb-4 mt-4 formcard">
                            <div class="card-header">
                                Tambah Admin
                            </div>
                            <form method="post">
                                <div class="card-body">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" required/>
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control" required/>
                                </div>
                                <div class="card-footer"> 
                                    <button type="submit" class="btn btn-primary" name="tambahadmin">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">Tutup</button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Daftar Pengguna
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE `role`='admin'");
                                        $i = 1;
                                        while($fetchpengguna = mysqli_fetch_array($pengguna, MYSQLI_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $fetchpengguna['email'] ?></td>
                                            <td><?= $fetchpengguna['password'] ?></td>
                                            <td><?= $fetchpengguna['role'] ?></td>
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
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input name="id_pengguna" type="hidden" value="<?= $fetchpengguna['id_pengguna'] ?>"/>
                                                                <label>Email</label>
                                                                <input name="email" type="email" class="form-control" value="<?= $fetchpengguna['email'] ?>" required/>
                                                                <label>Password</label>
                                                                <input name="password" type="password" class="form-control" value="<?= $fetchpengguna['password'] ?>" required/>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="perbaruiadmin">Save changes</button>
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
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    <input name="id_pengguna" type="hidden" value="<?= $fetchpengguna['id_pengguna'] ?>"/>
                                                                    <p>Yakin ingin Hapus <?= $fetchpengguna['email'] ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="hapusadmin">Save changes</button>
                                                                </div>
                                                            </form>
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