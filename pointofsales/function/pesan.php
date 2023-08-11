<?php 
session_start();
require 'koneksi.php';

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if(isset($_POST['buatpesanan'])) {
        mysqli_autocommit($conn,FALSE);

        $insertOrderStmt = mysqli_prepare($conn, "INSERT INTO `order` (nama_produk, nama_pemesan, jumlah_pesanan) VALUES(?,?,?)");
        $customerName =  $_POST['nama_pemesan'];

        if($insertOrderStmt) {
            mysqli_stmt_bind_param($insertOrderStmt,"ssi", $productName, $customerName, $totalBuy);
            foreach($_SESSION['cart'] as $key => $value) {
            $productName = $value['nama_produk'];
            $totalBuy = $value['jumlah_beli'];
            mysqli_stmt_execute($insertOrderStmt);
            }
        }

        foreach($_SESSION['cart'] as $key => $value) {
            $findProductStmt = mysqli_prepare($conn, "SELECT * FROM produk WHERE nama_produk = ?");
            if($findProductStmt) {
                mysqli_stmt_bind_param($findProductStmt,"s", $productName);
                $productName = $value['nama_produk'];
                mysqli_stmt_execute($findProductStmt);
            }

            $resultProduct = mysqli_stmt_get_result($findProductStmt);
            $getDataProduct = mysqli_fetch_assoc($resultProduct);
            $implodeDataProduct = implode("','",json_decode($getDataProduct['bahan_produk']));

            $findRawMaterial = mysqli_query($conn, "SELECT * FROM bahan_baku WHERE nama_bahan IN ('$implodeDataProduct') ");
        
            while($getRawMaterialData =  mysqli_fetch_assoc($findRawMaterial)) {
            if($getRawMaterialData['jumlah_bahan'] == 0) {
                    mysqli_rollback($conn);
                    echo"
                    <script>
                    alert('Bahan Baku Habis');
                    window.location.href = '/keranjang.php';
                    </script>
                    ";
            } else {
                $updateRawMaterialStmt = mysqli_prepare($conn, "UPDATE bahan_baku SET jumlah_bahan = jumlah_bahan - ? WHERE nama_bahan = ?");
                if($updateRawMaterialStmt) {
                    $rawMaterial = $getRawMaterialData['nama_bahan'];
                    $totalUsed = ($getRawMaterialData['pemakaian']*$value['jumlah_beli']);
                    mysqli_stmt_bind_param($updateRawMaterialStmt,"is", $totalUsed ,$rawMaterial);
                    if($getRawMaterialData['jumlah_bahan'] < $totalUsed) {
                        mysqli_rollback($conn);
                        echo "
                        <script>
                        alert('Bahan Baku Ga Cukup');
                        window.location.href = '/keranjang.php';
                        </script>
                        ";
                    } else {
                        mysqli_stmt_execute($updateRawMaterialStmt);
                    }
                }
            }
        }
        if (!mysqli_commit($conn)) {
            echo "Commit transaction failed";
            exit();
        }
        

        unset($_SESSION['cart']);
        echo "
        <script>
        alert('Transaksi Berhasil');
        window.location.href = '/keranjang.php';
        </script>
        ";
        }
    }
}

?>
