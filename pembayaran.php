<?php 
require_once "header.php";
require_once "fungsi.php";

$username = 'dionisiusjovan@easybus.com';
$jmlkursi = isset($_GET['kursi']) ? $_GET['kursi'] : 0;
$id = isset($_GET['id']) ? $_GET['id'] : 0;
if (isset($_GET['kursi'])) {
	$data = getBookingbyuserkursi($username, $jmlkursi);
	$booking='';

	$total = 0;
	$detil = '';

	if (sizeof($data) > 0) {
		foreach ($data as $val) {				
			if (strlen($val['id_booking']) == 1) {
				$booking='00000'.$val['id_booking'];
			} elseif (strlen($val['id_booking']) == 2) {
				$booking='0000'.$val['id_booking'];
			} elseif (strlen($val['id_booking']) == 3) {
				$booking='000'.$val['id_booking'];
			} else {
				$booking='00'.$val['id_booking'];
			}
					$detil .= '<div class="row" style="font-size: 15px">
								<div class="col-6">
								<br><br>
									<table class="table table-borderless">	
										<tr>
											<td>ID Booking</td>
											<td>:</td>
											<td>'.$booking.'</td>
										</tr>
										<tr>
											<td>Perusahaan Otobus</td>
											<td>:</td>
											<td>'.$val['nama'].'</td>
										</tr>
										<tr>
											<td>Berangkat dari</td>
											<td>:</td>
											<td>'.$val['berangkat'].'</td>
										</tr>
										<tr>
											<td>Tujuan</td>
											<td>:</td>
											<td>'.$val['tujuan'].'</td>
										</tr>
										<tr>
											<td>Waktu Keberangkatan</td>
											<td>:</td>
											<td>'.date('d F Y', strtotime($val['tanggal_berangkat'])).' '.$val['jambrk'].'.00</td>
										</tr>
										<tr>
											<td>Nomor Kursi:</td>
											<td>:</td>
											<td>'.$val['no_seat'].'</td>
										</tr>
										<tr>
											<td>Total Pembayaran</td>
											<td>:</td>
											<td>Rp'.$val['harga'].',-</td>
										</tr>	
									</table>						
								</div>
							</div>

					';
					$total += ((int)$val['harga']);
				}
			} else {
				echo '<div class="alert alert-danger"><h3>TIDAK ADA DATA</h3></div>';
			}

	echo '					<br><br>
							<div class="container">
								<div class="text-lg">
									<h2>Booking Tiket Anda berhasil!</h2><br>
									<div style="font-size: 15px">Silakan melakukan pembayaran sejumlah Rp'.$total.'. Kemudian Petugas kami akan menghubungi Anda melalui WhatsApp untuk melakukan validasi pembayaran dengan mengirimkan Kode Booking dan Bukti Transfer. <br> Apabila terjadi gangguan teknis, Anda dapat melakukan validasi pembayaran tiket Anda melalui email kami validasi@easybus.com.<br>
										Anda dapat melakukan pembayaran melalui transfer ke rekening kami:
										<table class="table table-hover table-borderless">
											<tr>
												<td>Bank BNI A/N Easybus</td>
												<td>:</td>
												<td>7324823719</td>
											</tr>
											<tr>
												<td>Bank BCA A/N Easybus</td>
												<td>:</td>
												<td>737192284</td>
											</tr>
											<tr>
												<td>Bank BRI A/N Easybus</td>
												<td>:</td>
												<td>4235564719</td>
											</tr>
											<tr>
												<td>Bank Mandiri A/N Easybus</td>
												<td>:</td>
												<td>31958399</td>
											</tr>
										</table>
									</div>
								</div>
							</div>'.$detil;


	echo '</div>';
} else {
	$data = getBookingbykode(16);
	$booking='';

	$total = 0;
	$detil = '';

	if (sizeof($data) > 0) {
		foreach ($data as $val) {				
			if (strlen($val['id_booking']) == 1) {
				$booking='00000'.$val['id_booking'];
			} elseif (strlen($val['id_booking']) == 2) {
				$booking='0000'.$val['id_booking'];
			} elseif (strlen($val['id_booking']) == 3) {
				$booking='000'.$val['id_booking'];
			} else {
				$booking='00'.$val['id_booking'];
			}
					$detil .= '<div class="row" style="font-size: 15px">
								<div class="col-6">
								<br><br>
									<table class="table table-borderless">	
										<tr>
											<td>ID Booking</td>
											<td>:</td>
											<td>'.$booking.'</td>
										</tr>
										<tr>
											<td>Perusahaan Otobus</td>
											<td>:</td>
											<td>'.$val['nama'].'</td>
										</tr>
										<tr>
											<td>Berangkat dari</td>
											<td>:</td>
											<td>'.$val['berangkat'].'</td>
										</tr>
										<tr>
											<td>Tujuan</td>
											<td>:</td>
											<td>'.$val['tujuan'].'</td>
										</tr>
										<tr>
											<td>Waktu Keberangkatan</td>
											<td>:</td>
											<td>'.date('d F Y', strtotime($val['tanggal_berangkat'])).' '.$val['jambrk'].'.00</td>
										</tr>
										<tr>
											<td>Nomor Kursi:</td>
											<td>:</td>
											<td>'.$val['no_seat'].'</td>
										</tr>
										<tr>
											<td>Total Pembayaran</td>
											<td>:</td>
											<td>Rp'.$val['harga'].',-</td>
										</tr>	
									</table>						
								</div>
							</div>

					';
					$total += ((int)$val['harga']);
				}
			} else {
				echo '<div class="alert alert-danger"><h3>TIDAK ADA DATA</h3></div>';
			}

	echo '					<br><br>
							<div class="container">
								<div class="text-lg">
									<h2>Booking Tiket Anda berhasil!</h2><br>
									<div style="font-size: 15px">Silakan melakukan pembayaran sejumlah Rp'.$total.'. Kemudian Petugas kami akan menghubungi Anda melalui WhatsApp untuk melakukan validasi pembayaran dengan mengirimkan Kode Booking dan Bukti Transfer. <br> Apabila terjadi gangguan teknis, Anda dapat melakukan validasi pembayaran tiket Anda melalui email kami validasi@easybus.com.<br>
										Anda dapat melakukan pembayaran melalui transfer ke rekening kami:
										<table class="table table-hover table-borderless">
											<tr>
												<td>Bank BNI A/N Easybus</td>
												<td>:</td>
												<td>7324823719</td>
											</tr>
											<tr>
												<td>Bank BCA A/N Easybus</td>
												<td>:</td>
												<td>737192284</td>
											</tr>
											<tr>
												<td>Bank BRI A/N Easybus</td>
												<td>:</td>
												<td>4235564719</td>
											</tr>
											<tr>
												<td>Bank Mandiri A/N Easybus</td>
												<td>:</td>
												<td>31958399</td>
											</tr>
										</table>
									</div>
								</div>
							</div>'.$detil;


	echo '</div>';
}












require_once "footer.php";
 ?>