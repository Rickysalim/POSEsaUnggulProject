<?php 
 require './function/koneksi.php';
 session_start();
 if($_SERVER["REQUEST_METHOD"]=="POST") { 
    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $checkUserStmt = mysqli_prepare($conn, "SELECT email, password, role FROM pengguna WHERE email=? AND password=?");
        mysqli_stmt_bind_param($checkUserStmt,"ss",$email,$password);
        mysqli_stmt_execute($checkUserStmt);
        $userResult = mysqli_stmt_get_result($checkUserStmt);
        $getUserData = mysqli_fetch_assoc($userResult);
        if($getUserData) {
            if($getUserData['role'] == "superadmin") {
                $_SESSION['user'][0] = 'True';
                $_SESSION['user'][1] = $getUserData['email'];
                $_SESSION['user'][2] = $getUserData['role'];
                header('location:bahan_baku.php');
            } else {
                $_SESSION['user'][0] = 'True';
                $_SESSION['user'][1] = $getUserData['email'];
                $_SESSION['user'][2] = $getUserData['role'];
                header('location:pesan.php');
            }
        } else {
           $_SESSION['user'][0] = 'False';
           header('location:index.php');
        }
    }
 }

 if(isset($_SESSION['user']) && $_SESSION['user'][0] == 'True') {
    if($_SESSION['user'][2] == "superadmin") {
        header('location:bahan_baku.php');
    } else {
        header('location:pesan.php');
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
        <title>Login - SB Admin</title>
        <link href="public/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input name="email" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <?php 
                                                if(isset($_SESSION['user']) && $_SESSION['user'][0] == 'False') {
                                            ?>
                                              <p class="text-danger">Pengguna Tidak ditemukan</p>
                                            <?php
                                                }
                                            ?>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button name="login" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
    </body>
</html>
