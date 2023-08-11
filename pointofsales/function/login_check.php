<?php
if(!isset($_SESSION['user'][0])) {
    header('location:index.php');
} 
?>