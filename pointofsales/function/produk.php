<?php
require 'koneksi.php';
session_start();
if(isset($_POST['tambahproduk'])) {
    $namaProduk = $_POST['nama_produk'];
    $hargaProduk = $_POST['harga_produk'];
    $bahanProduk = json_encode($_POST['bahan_produk']);
    $gambarProdukTmp = $_FILES['gambar_produk']['tmp_name'];
    $gambarProdukName = $_FILES['gambar_produk']['name'];
    $img_ext = pathinfo($gambarProdukName, PATHINFO_EXTENSION);
    $img_des = "images/".$namaProduk.".".$img_ext;
    $img_size = $_FILES['gambar_produk']['size']/(1024*1024);
    move_uploaded_file($gambarProdukTmp, "images/".$namaProduk.".".$img_ext);
    $cekProduk = mysqli_query($conn,"SELECT * FROM produk WHERE nama_produk='$namaProduk'");
    if(mysqli_num_rows($cekProduk) > 0) {
        echo "<script>
        alert('Produk Sudah Ada');
        window.location.href = '/produk.php';
        </script>";
    }
    if(($img_ext!='jpg') && ($img_ext!='png') && ($img_ext != 'jpeg')) {
        echo "<script>
        alert(Gambar Harus jpg, png, jpeg');
        window.location.href = '/produk.php';
        </script>";

    }
    if($img_size > 3) {
        echo "<script>
        alert(Gambar Tidak boleh lebih dari 1mb');
        window.location.href = '/produk.php';
        </script>";
    }
    $stmt = mysqli_prepare($conn, "INSERT INTO produk VALUES(?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"ssss",$namaProduk,$bahanProduk,$hargaProduk,$img_des);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo "Error";
    }
}

if(isset($_POST['perbaruiproduk'])) {
    $namaProduk = $_POST['nama_produk'];
    $hargaProduk = $_POST['harga_produk'];
    $bahanProduk = json_encode($_POST['bahan_produk']);
    $gambarProdukTmp = $_FILES['gambar_produk']['tmp_name'];
    $gambarProdukName = $_FILES['gambar_produk']['name'];
    $img_ext = pathinfo($gambarProdukName, PATHINFO_EXTENSION);
    $img_des = "images/".$namaProduk.".".$img_ext;
    $img_size = $_FILES['gambar_produk']['size']/(1024*1024);
    move_uploaded_file($gambarProdukTmp, "images/".$namaProduk.".".$img_ext);
    if(($img_ext!='jpg') && ($img_ext!='png') && ($img_ext != 'jpeg')) {
        echo "<script>
        alert(Gambar Harus jpg, png, jpeg');
        window.location.href = '/produk.php';
        </script>";

    }
    if($img_size > 3) {
        echo "<script>
        alert(Gambar Tidak boleh lebih dari 1mb');
        window.location.href = '/produk.php';
        </script>";
    }
    $stmt = mysqli_prepare($conn, "UPDATE produk SET gambar_produk=?, bahan_produk=?, harga_produk=? WHERE nama_produk=?");
    mysqli_stmt_bind_param($stmt,"ssss",$img_des,$bahanProduk,$hargaProduk,$namaProduk);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo "Error";
    }
}

if(isset($_POST['hapusproduk'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM produk WHERE nama_produk=?");
    $namaProduk = $_POST['nama_produk'];
    mysqli_stmt_bind_param($stmt,"s",$namaProduk);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_error($stmt)) {
        echo "Error";
    }
}

?>
