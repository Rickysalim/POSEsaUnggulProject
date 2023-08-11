<?php 
   if($_SESSION['user'][2] == "superadmin") {
      header('location:bahan_baku.php');
   } 
?>