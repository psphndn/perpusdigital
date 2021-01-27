<?php
include_once("fungsi.php");

$id = $_GET['id'];
deleteDataBus($id);
header("Location:admin_jadwal.php");
?>