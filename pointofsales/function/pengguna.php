<?php
require 'koneksi.php';
if(isset($_POST['tambahadmin'])) {
    $stmt = mysqli_prepare($conn, "INSERT INTO pengguna(`email`,`password`,`role`) VALUES(?,?,?)");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "admin";
    mysqli_stmt_bind_param($stmt,"sss",$email,$password,$role);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo 'ERROR';
    }
}

if(isset($_POST['perbaruiadmin'])) {
    $stmt = mysqli_prepare($conn, "UPDATE pengguna SET `email`=?,`password`=? WHERE id_pengguna=?");
    $idPengguna = $_POST['id_pengguna'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    mysqli_stmt_bind_param($stmt,"sss",$email,$password,$idPengguna);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo 'ERROR';
    }
}

if(isset($_POST['hapusadmin'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM pengguna  WHERE id_pengguna=?");
    $idPengguna = $_POST['id_pengguna'];
    mysqli_stmt_bind_param($stmt,"s",$idPengguna);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo 'ERROR';
    }
}
?>