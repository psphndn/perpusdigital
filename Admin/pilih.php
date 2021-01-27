<?php


require "fungsi.php";

//session_start();

/*if (!isset($_SESSION['username'])) {
	header("location:login.php");
	exit;
}*/
$error = '';
$form='<form action="jadwal.php" method="get">
		      	<div class="row text-center">
		      		<div class="col-lg text-center">
				      	<div style="font-size: 15px">Driver</div>
					        <select class="selectpicker" data-live-search="true" data-style="button btn-lg btn-success" name="Driver">
							  
							  <option value="1">Driver</option>
							</select>
					</div>
				';

echo '
		'.$error.'<header class="masthead">
		  <div class="container h-100">
		    <div class="row h-50 align-items-center">
		      <div class="col-12 text-center">
		        <h1 style="color:white; font-size:50px;">EasyBus!</h1>
		        <p class="lead" style="color:black; font-size: 15px;">Your travelling partner</p>
		      </div>
		      <div class="col-1 text-center"></div>
		    </div>
		  </div>
		</header>
';


?>