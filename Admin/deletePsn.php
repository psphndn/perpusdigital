<?php
include_once("fungsi.php");

$id = $_GET['id'];
deleteDataPesan($id);
header("Location:pemesanan.php");
?>