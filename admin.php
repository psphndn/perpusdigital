<?php
// memulai session
session_start();
error_reporting(0);
if (isset($_SESSION['level']))
{
	// jika level admin
	if ($_SESSION['level'] == "admin")
   {   
      //include 'konten-admin.php';
      echo 'admin level';
   }
   // jika kondisi level user maka akan diarahkan ke halaman lain
   else if ($_SESSION['level'] == "")
   {
       //include 'konten-user.php';
      echo 'user level';
   }
}
if (!isset($_SESSION['level']))
{
	header('location:index.php');
}
 ?>