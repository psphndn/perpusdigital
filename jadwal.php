<?php

require_once "header.php";
require_once "fungsi.php";

//session_start();

/*if (!isset($_SESSION['username'])) {
	header("location:login.php");
	exit;
}*/

$tglbrkt = '';
if (isset($_GET['tgl_berangkat']) != '') {
	$tglbrkt = $_GET['tgl_berangkat'];
} else {
	echo '<script>alert("Tanggal Berangkat belum terisi!")</script>';
}

$berangkat = '';
if (isset($_GET['keberangkatan']) != '') {
	$berangkat = $_GET['keberangkatan'];
} else {
	echo '<script>alert("Tanggal Berangkat belum terisi!")</script>';
}

$tujuan = '';
if (isset($_GET['tujuan']) != '') {
	$tujuan = $_GET['tujuan'];
} else {
	echo '<script>alert("Tanggal Berangkat belum terisi!")</script>';
}

$data = getListJadwal($berangkat, $tujuan, $tglbrkt);
$kotaberangkat = getKotaberangkat();
$kotatujuan = getKotatujuan();
$kursi = '';

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
							<script>
								jQuery(function($) {
								      $(".selectpicker").selectpicker("val", "'.$_GET["keberangkatan"].'");
								});
							</script>
					</div>
					<div class="col-lg text-center">
					      <div style="font-size: 15px">Tujuan</div>
					      	<select class="selectpicker" data-live-search="true" data-style="button btn-lg btn-success" name="tujuan" style="font-size: 15px">
							  <option value="1" disabled selected>Tujuan</option>
							  '.$formtujuan.'
							</select>
							<script>
								jQuery(function($) {
								      $(".selectpicker").selectpicker("val", "'.$_GET["tujuan"].'");
								});
							</script>
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
		<header>
			<div class="container h-100">
			<br>
				'.$form.'
			</div>
		</header>
		<br><br><br>
';

echo '
		<div class="col-12" style="font-size: 15px">
';
if (sizeof($data) > 0) {
	echo '
				<table class="table table-bordered table-hover">	
					<tr class="table-success">
						<td valign="middle"><center>Perusahaan Otobus</center></td>
						<td valign="middle"><center>Rute</center></td>
						<td valign="middle"><center>Jam Berangkat</center></td>
						<td valign="middle">Kursi Tersedia</td>
						<td valign="middle"><center>Harga</center></td>
						<td></td>

					</tr>
			';

	foreach ($data as $val) {
				if ($val['statuskursi'] == 'disabled') {
					echo '<tr class="table-danger">
						<td width="30%" nowrap valign="middle"><center><img src="'.$val['po'].'.png" alt="'.$val['po'].'" style="width:100px;"></center></td> 
						<td valign="center"><center>'.$val['berangkat'].' -> '.$val['tujuan'].'</center></td>
						<td width="5%" nowrap valign="middle"><center>'.$val['jambrk'].'.00</center></td>
						<td width="5%" nowrap valign="middle"><center>'.$val['KursiTersedia'].'</center></td>
						<td valign="middle"><center>Rp'.$val['harga'].'</center></td>
						<td valign="middle"><a href="#" class="btn btn-success disabled" role="button">Pesan</a></td> <!-- saat klik ini = Pesan -->
						</tr>
					';
				} else
				{
					echo '<tr>
						<td width="30%" nowrap valign="middle"><center><img src="'.$val['po'].'.png" alt="'.$val['po'].'" style="width:100px;"></center></td> 
						<td valign="center"><center>'.$val['berangkat'].' -> '.$val['tujuan'].'</center></td>
						<td width="5%" nowrap valign="middle"><center>'.$val['jambrk'].'.00</center></td>
						<td width="5%" nowrap valign="middle"><center>'.$val['KursiTersedia'].'</center></td>
						<td valign="middle"><center>Rp'.$val['harga'].'</center></td>
						<td valign="middle"><a href="pesan.php?jadwal='.$val['id_jadwal'].'&tanggal='.$tglbrkt.'" class="btn btn-success" role="button">Pesan</a></td> <!-- saat klik ini = Pesan -->
						</tr>
					';
				}
			}

			echo '
				</table>
			';
		} else {
			echo '<div class="alert alert-danger"><h3>TIDAK ADA DATA</h3></div>';
		}

echo '</div>';

require_once "footer.php";
?>