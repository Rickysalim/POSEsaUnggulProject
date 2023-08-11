<?php
require 'koneksi.php';
session_start();

if(isset($_POST['tambahbahanbaku'])) {
    $namaBahan = $_POST['nama_bahan'];
    $cekBahan = mysqli_query($conn, "SELECT * FROM bahan_baku WHERE nama_bahan='$namaBahan'");
    if($cekBahan) {
        echo "<script>
        alert('Bahan Baku Sudah Ada');
        window.location.href = '/bahan_baku.php';
        </script>";
        exit();
    }
    
    $stmt = mysqli_prepare($conn, "INSERT INTO bahan_baku VALUES(?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"sisi",$_POST['nama_bahan'],$_POST['jumlah_bahan'],$_POST['satuan_bahan'],$_POST['pemakaian']);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo 'ERROR';
    }
}

if(isset($_POST['perbaruibahanbaku'])){
    $stmt = mysqli_prepare($conn, "UPDATE bahan_baku SET jumlah_bahan=?, satuan_bahan=?, pemakaian=? WHERE nama_bahan=?");
    mysqli_stmt_bind_param($stmt,"isis",$_POST['jumlah_bahan'],$_POST['satuan_bahan'],$_POST['pemakaian'],$_POST['nama_bahan']);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo 'ERROR';
    }
}

if(isset($_POST['hapusbahanbaku'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM bahan_baku WHERE nama_bahan=?");
    mysqli_stmt_bind_param($stmt,"s",$_POST['nama_bahan']);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo 'ERROR';
    }
}

?>
