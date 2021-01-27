<?php
include_once("fungsi.php");

$id = $_GET['id'];
deleteDataPO($id);
header("Location:konten-admin.php");
?>