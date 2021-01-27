<?php

require "header.php";
require "fungsi.php";

//session_start();

/*if (!isset($_SESSION['username'])) {
	header("location:login.php");
	exit;
}*/
$error = '';
$tglbrkt = isset($_GET['tgl_berangkat']) ? $_GET['tgl_berangkat'] : "";
$berangkat = isset($_GET['keberangkatan']) ? $_GET['keberangkatan'] : "";
$tujuan = isset($_GET['tujuan']) ? $_GET['tujuan'] : "";
$data = getListJadwal($berangkat, $tujuan, $tglbrkt);
$kotaberangkat = getKotaberangkat();
$kotatujuan = getKotatujuan();

$formbrkt ="";
$formtujuan = "";
if (sizeof($kotaberangkat)>0 && sizeof($kotatujuan)>0) {
	foreach ($kotaberangkat as $val) {
		$formbrkt.='<option value="'.$val['berangkat'].'">'.$val['berangkat'].'</option>';
	}
	foreach ($kotatujuan as $val) {
		$formtujuan.='<option value="'.$val['tujuan'].'">'.$val['tujuan'].'</option>';
	}
}

$form='<form action="jadwal.php" method="get">
		      	<div class="row text-center">
		      		<div class="col-lg text-center">
				      	<div style="font-size: 15px">Keberangkatan</div>
					        <select class="selectpicker" data-live-search="true" data-style="button btn-lg btn-success" name="keberangkatan">
							  <option value="1" disabled selected>Keberangkatan</option>
							  '.$formbrkt.'
							</select>
					</div>
					<div class="col-lg text-center">
					      <div style="font-size: 15px">Tujuan</div>
					      	<select class="selectpicker" data-live-search="true" data-style="button btn-lg btn-success" name="tujuan" style="font-size: 15px">
							  <option value="1" disabled selected>Tujuan</option>
							  '.$formtujuan.'
							</select>
					</div>
					<div class="col-lg">
					      <div style="font-size: 15px">Pilih Tanggal Berangkat</div>
					      	<div class="input-group input-group-lg date">
							    <div class="input-group-addon"><span style="font-size: 20px" class="glyphicon glyphicon-th"></span></div>
							       <input placeholder="YYYY-MM-DD" type="text" class="form-control datepicker" name="tgl_berangkat" value="'.$tglbrkt.'" data-date-format="yyyy/mm/dd" container="container" style="font-size: 15px" size="16"></input>
								       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"></script>
									   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
									   <script>
									   jQuery(function($) {
									       $(".datepicker").datepicker();
									   });
									   </script>
							</div>
					</div>
		      	</div>
		      	<br> <br>
		      	<div class="row text-center">
		      		<div class="col-lg text-center">
		      			<input type="submit" class="button btn-success btn-block" style="font-size: 15px" value="Cari Tiket!">
		      		</div>
		      	</div>
		      </form>';

echo '
		'.$error.'<header class="masthead">
		  <div class="container h-100">
		    <div class="row h-50 align-items-center">
		      <div class="col-12 text-center">
		        <h1 style="color:white; font-size:50px;">EasyBus!</h1>
		        <p class="lead" style="color:black; font-size: 15px;">Your travelling partner</p>
		      </div>
		      <div class="col-12 text-center">'.$form.'</div>
		    </div>
		  </div>
		</header>
';

require "footer.php";
?>