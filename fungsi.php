<?php
require_once "config.php";

function cekLogin($user="", $pass="") {
	global $conn;
	
	$sql = "SELECT * FROM data_user WHERE NIM = '$user' and password = '$pass'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		return true;
	} else {
		return false;
	}
}

function getListJadwal($keberangkatan ="", $tujuan = "", $tanggal) {
	global $conn;
	$data = array();
	
	$sql = "SELECT j.id_jadwal, o.nama, j.berangkat, j.tujuan, j.jam_berangkat, j.harga, o.seat_max, (SELECT COUNT(no_seat) FROM data_seat WHERE tanggal_berangkat = '$tanggal' AND id_jadwal = j.id_jadwal) KursiTersedia FROM data_jadwal j JOIN data_po o WHERE j.id_po = o.id_po AND berangkat = '$keberangkatan' AND tujuan = '$tujuan'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['id_jadwal'] = $row['id_jadwal'];
			$data[$i]['po'] = $row['nama'];
			$data[$i]['berangkat'] = $row['berangkat'];
			$data[$i]['tujuan'] = $row['tujuan'];
			$data[$i]['jambrk'] = $row['jam_berangkat'];
			$data[$i]['harga'] = $row['harga'];
			$data[$i]['seat_max'] = $row['seat_max'];
			$data[$i]['KursiTersedia'] = $row['seat_max']-$row['KursiTersedia'];
			$data[$i]['statuskursi'] = '';
				if ($data[$i]['KursiTersedia'] < 1) {
					$data[$i]['statuskursi'] .= 'disabled';
				}
			$i++;
		}
	}
	
	return $data;
}

function getKotaberangkat() {
	global $conn;
	$data = array();
	
	$sql = "SELECT DISTINCT berangkat FROM data_jadwal";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['berangkat'] = $row['berangkat'];
			$i++;
		}
	}
	
	return $data;
}

function getKotatujuan() {
	global $conn;
	$data = array();
	
	$sql = "SELECT DISTINCT tujuan FROM data_jadwal";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['tujuan'] = $row['tujuan'];
			$i++;
		}
	}
	
	return $data;
}

function getJadwalbyid($id="",$tanggal="") {
	global $conn;
	$data = array();
	
	$sql = "SELECT j.id_jadwal,o.nama, j.berangkat,j.tujuan,j.jam_berangkat,j.jam_berangkat,(SELECT COUNT(no_seat) FROM data_seat WHERE tanggal_berangkat = '$tanggal' AND id_jadwal = '$id') KursiTersedia, o.seat_max, j.harga FROM data_jadwal j JOIN data_po o WHERE j.id_PO=o.id_PO AND j.id_jadwal='$id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['id_jadwal'] = $row['id_jadwal'];
			$data[$i]['nama'] = $row['nama'];
			$data[$i]['berangkat'] = $row['berangkat'];
			$data[$i]['tujuan'] = $row['tujuan'];
			$data[$i]['jambrk'] = $row['jam_berangkat'];
			$data[$i]['harga'] = $row['harga'];
			$data[$i]['seat_max'] = $row['seat_max'];
			$data[$i]['KursiTersedia'] = $row['seat_max']-$row['KursiTersedia'];
			$i++;
		}
	}
	
	return $data;
}

function getBookingbyuser($username="") {
	global $conn;
	$data = array();
	
	$sql = "SELECT b.id_booking, b.username, o.nama, j.berangkat, j.tujuan, s.tanggal_berangkat, j.jam_berangkat, s.no_seat, b.status_bayar FROM data_booking b JOIN data_seat s ON b.id_seat=s.id_seat JOIN data_jadwal j ON s.id_jadwal = j.id_jadwal JOIN data_po o ON j.id_PO=o.id_PO WHERE b.username='$username'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['id_booking'] = $row['id_booking'];
			$data[$i]['username'] = $row['username'];
			$data[$i]['nama'] = $row['nama'];
			$data[$i]['berangkat'] = $row['berangkat'];
			$data[$i]['tujuan'] = $row['tujuan'];
			$data[$i]['tanggal_berangkat'] = $row['tanggal_berangkat'];
			$data[$i]['jambrk'] = $row['jam_berangkat'];
			$data[$i]['no_seat'] = $row['no_seat'];
			$data[$i]['status_bayar'] = $row['status_bayar'];
			$i++;
		}
	}
	
	return $data;
}

function getBookingbyuserkursi($username="", $kursi=0) {
	global $conn;
	$data = array();
	
	$sql = "SELECT b.id_booking, b.username, o.nama, j.berangkat, j.tujuan, s.tanggal_berangkat, j.jam_berangkat, j.harga, s.no_seat, b.status_bayar FROM data_booking b JOIN data_seat s ON b.id_seat=s.id_seat JOIN data_jadwal j ON s.id_jadwal = j.id_jadwal JOIN data_po o ON j.id_PO=o.id_PO WHERE b.username='$username' ORDER BY b.id_booking DESC LIMIT $kursi";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['id_booking'] = $row['id_booking'];
			$data[$i]['username'] = $row['username'];
			$data[$i]['nama'] = $row['nama'];
			$data[$i]['berangkat'] = $row['berangkat'];
			$data[$i]['tujuan'] = $row['tujuan'];
			$data[$i]['tanggal_berangkat'] = $row['tanggal_berangkat'];
			$data[$i]['jambrk'] = $row['jam_berangkat'];
			$data[$i]['no_seat'] = $row['no_seat'];
			$data[$i]['harga'] = $row['harga'];
			$data[$i]['status_bayar'] = $row['status_bayar'];
			$i++;
		}
	}
	
	return $data;
}

function getBookingbykode($kodebooking=0) {
	global $conn;
	$data = array();
	
	$sql = "SELECT b.id_booking, b.username, o.nama, j.berangkat, j.tujuan, s.tanggal_berangkat, j.jam_berangkat, s.no_seat, j.harga, b.status_bayar FROM data_booking b JOIN data_seat s ON b.id_seat=s.id_seat JOIN data_jadwal j ON s.id_jadwal = j.id_jadwal JOIN data_po o ON j.id_PO=o.id_PO WHERE b.id_booking=$kodebooking";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['id_booking'] = $row['id_booking'];
			$data[$i]['username'] = $row['username'];
			$data[$i]['nama'] = $row['nama'];
			$data[$i]['berangkat'] = $row['berangkat'];
			$data[$i]['tujuan'] = $row['tujuan'];
			$data[$i]['tanggal_berangkat'] = $row['tanggal_berangkat'];
			$data[$i]['jambrk'] = $row['jam_berangkat'];
			$data[$i]['no_seat'] = $row['no_seat'];
			$data[$i]['harga'] = $row['harga'];
			$data[$i]['status_bayar'] = $row['status_bayar'];
			$i++;
		}
	}
	
	return $data;
}

function getSeat($id_jadwal="",$tanggal="") {
	global $conn;
	$data = array();
	
	$sql = "SELECT s.id_seat, s.no_seat, p.seat_max FROM data_seat s JOIN data_jadwal j ON s.id_jadwal = j.id_jadwal JOIN data_po p ON j.id_PO = p.id_PO WHERE s.tanggal_berangkat='$tanggal' AND s.id_jadwal='$id_jadwal'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['id_seat'] = $row['id_seat'];
			$data[$i]['no_seat'] = $row['no_seat'];
			$data[$i]['seat_max'] = $row['seat_max'];
			$data[$i]['seat_map']= '';
				if (((int)$data[$i]['seat_max']) == 40) {
					if (((int)$data[$i]['no_seat']) / 4 <= 1) {
						$data[$i]['seat_map'] .= '1_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 2) {
						$data[$i]['seat_map'] .= '2_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 3) {
						$data[$i]['seat_map'] .= '3_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 4) {
						$data[$i]['seat_map'] .= '4_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 5) {
						$data[$i]['seat_map'] .= '5_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 6) {
						$data[$i]['seat_map'] .= '6_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 7) {
						$data[$i]['seat_map'] .= '7_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 8) {
						$data[$i]['seat_map'] .= '8_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 9) {
						$data[$i]['seat_map'] .= '9_';
					}elseif (((int)$data[$i]['no_seat']) / 4 <= 10) {
						$data[$i]['seat_map'] .= '10_';
					}

					if (((int)$data[$i]['no_seat']) % 4 == 1) {
						$data[$i]['seat_map'] .= '1';
					}elseif (((int)$data[$i]['no_seat']) % 4 == 2) {
						$data[$i]['seat_map'] .= '2';
					}elseif (((int)$data[$i]['no_seat']) % 4 == 3) {
						$data[$i]['seat_map'] .= '4';
					}elseif (((int)$data[$i]['no_seat']) % 4 == 0) {
						$data[$i]['seat_map'] .= '5';
					}
				} else{
					if (((int)$data[$i]['no_seat']) / 3 < 6) {
						if (((int)$data[$i]['no_seat']) / 6 < 5) {
							if (((int)$data[$i]['no_seat']) / 6 < 4) {
								if (((int)$data[$i]['no_seat']) / 6 < 3) {
									if (((int)$data[$i]['no_seat']) / 6 < 2) {
										$data[$i]['seat_map'] .= '1_';
									}else{
										$data[$i]['seat_map'] .= '2_';
									}
								}else{
									$data[$i]['seat_map'] .= '3_';
								}
							}else{
								$data[$i]['seat_map'] .= '4_';
							}
						}else{
							$data[$i]['seat_map'] .= '5_';
						}
					}else{
						$data[$i]['seat_map'] .= '6_';
					}

					if ((((int)$data[$i]['no_seat']) == 1) OR (((int)$data[$i]['no_seat']) % 3 == 0)) {
						$data[$i]['seat_map'] .= '1';
					} elseif ((((int)$data[$i]['no_seat'])+1 == 1) OR (((int)$data[$i]['no_seat'])+1 % 3 == 0)) {
						$data[$i]['seat_map'] .= '2';
					} elseif ((((int)$data[$i]['no_seat'])+2 == 1) OR (((int)$data[$i]['no_seat'])+2 % 3 == 0)) {
						$data[$i]['seat_map'] .= '3';
					}
				}
			$i++;
		}
	}
	
	return $data;
}

function newSeat($id_jadwal, $seat, $tanggal){
	global $conn;
	
	$sql = "INSERT INTO data_seat(id_jadwal, no_seat, tanggal_berangkat) VALUES ('$id_jadwal', '$seat', '$tanggal')";
	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
		return false;
	}
}

function getSeatforBooking($id_jadwal, $seat, $tanggal){
	global $conn;
	$data = array();
	
	$sql = "SELECT id_seat FROM data_seat WHERE id_jadwal='$id_jadwal' AND no_seat='$seat' AND tanggal_berangkat='$tanggal'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['id_seat'] = $row['id_seat'];
			$i++;
		}
	}
	
	return $data;
}

function newBook($id_seat, $username){
	global $conn;

	$sql = "INSERT INTO data_booking(id_seat, username) VALUES ('$id_seat', '$username')";
	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
		return false;
	}
}

function deleteSeat($id_seat){
	global $conn;
	
	$sql = "DELETE FROM data_seat WHERE id_seat = '$id_seat'";
	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
		return false;
	}
}

function getDataUser($username){
	global $conn;
	$data = array();
	
	$sql = "SELECT username, nama, no_telp FROM data_user WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['username'] = $row['username'];
			$data[$i]['nama'] = $row['nama'];
			$data[$i]['no_telp'] = $row['no_telp'];
			$i++;
		}
	}
	
	return $data;
}

?>