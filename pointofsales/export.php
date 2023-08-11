
<?php

require './function/koneksi.php';

$order = mysqli_query($conn, "SELECT o.nama_pemesan, o.nama_produk, p.harga_produk, o.jumlah_pesanan, o.tanggal_pemesan FROM `order` o, produk p WHERE o.nama_produk = p.nama_produk ORDER BY o.tanggal_pemesan DESC");

$data = "
<table border='1'>
<thead>
    <tr>
        <th>No</th>
        <th>Nama Pemesan</th>
        <th>Nama Produk</th>
        <th>Harga Produk</th>
        <th>Jumlah Pesanan</th>
        <th>Tanggal Pesanan</th>
    </tr>
</thead>
<tbody>
" ;
$num=1;
while($fetchOrder = mysqli_fetch_array($order, MYSQLI_ASSOC)) {
    $tanggalPemesanan = date('Y-m-d',strtotime($fetchOrder['tanggal_pemesan']));
    $data .= "
    <tr>
        <td>$num</td>
        <td>$fetchOrder[nama_pemesan]</td>
        <td>$fetchOrder[nama_produk]</td>
        <td>$fetchOrder[harga_produk]</td>
        <td>$fetchOrder[jumlah_pesanan]</td>
        <td>$tanggalPemesanan</td>
    </tr>
    ";
    $num++;
}

$data .= "
</tbody>
</table>
";

header("Content-Type: application/xlsx");
header("Content-Disposition: attachment; filename=laporan_pesanan.xlsx");

echo $data;

?>