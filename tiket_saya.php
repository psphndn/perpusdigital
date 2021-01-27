<?php 

//session_start();

/*if (!isset($_SESSION["login"])) {
	header("location:login.php");
	exit;
}*/


require_once "header.php";
require_once "fungsi.php";


$username = 'dionisiusjovan@easybus.com';
$data = getBookingbyuser($username);
$booking='';

echo '	<div class="col-12"><h1>Tiket Saya</h1></div><br>
		<div class="col-12">';

if (sizeof($data) > 0) {
	echo '
				<table class="table table-borderless table-hover">	
			';

	foreach ($data as $val) {				
		if ($val['status_bayar'] == "LUNAS") {
			echo '<tr class="table-success">';
		} else
		{
			echo '<tr class="table-danger">';
		}

		if (strlen($val['id_booking']) == 1) {
			$booking='00000'.$val['id_booking'];
		} elseif (strlen($val['id_booking']) == 2) {
			$booking='0000'.$val['id_booking'];
		} elseif (strlen($val['id_booking']) == 3) {
			$booking='000'.$val['id_booking'];
		} else {
			$booking='00'.$val['id_booking'];
		}
				echo '	<td valign="middle" style="font-size: 15px"><center>EBUST'.$booking.'</center></td>
						<td width="30%" nowrap valign="middle"><center><img src="'.$val['nama'].'.png" alt="'.$val['nama'].'" style="width:100px;"></center></td> 
						<td valign="middle" style="font-size: 15px"><center>'.$val['berangkat'].' -> '.$val['tujuan'].'</center></td>
						<td width="5%" nowrap valign="middle" style="font-size: 15px"><center>'.date('d F Y', strtotime($val['tanggal_berangkat'])).' '.$val['jambrk'].'.00</center></td>
						<td valign="middle" style="font-size: 15px"><center>Nomor Kursi: '.$val['no_seat'].'</center></td>
						<td valign="middle" style="font-size: 15px"><center>Status: '.$val['status_bayar'].'</center></td>
				';
		if ($val['status_bayar'] != 'LUNAS') {
			echo '		<td valign="middle"> <a href="pembayaran.php?id='.$val['id_booking'].'" class="btn 					btn-success" role="button">Rincian</a></td>
						
					</tr>';
		} else
		{
			echo '		<td valign="middle"><a href="cetak.php?booking='.$val['id_booking'].'" class="btn 					btn-success" role="button">Cetak Tiket</a></td> <!-- saat klik ini = Pesan -->
						
					</tr>';
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