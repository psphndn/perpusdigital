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

function getListJadwal($keberangkatan ="", $tujuan = "") {
	global $conn;
	$data = array();
	
	$sql = "SELECT j.id_jadwal, o.nama, j.berangkat, j.tujuan, j.jam_berangkat, j.harga, o.seat_max FROM data_jadwal j JOIN data_po o WHERE j.id_po = o.id_po AND berangkat = '$keberangkatan' AND tujuan = '$tujuan'";
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
			$i++;
		}
	}

function getDataJadwal($id_jadwal){
	global $conn;

	$sql = "SELECT id_jadwal, id_PO, berangkat, tujuan, harga, jam_berangkat FROM data_jadwal WHERE id_jadwal = '$id_jadwal'";
	$result = mysqli_query($conn, $sql);

	$data = array();
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$data['id_jadwal'] = $row['id_jadwal'];
		$data['id_PO'] = $row['id_PO'];
		$data['berangkat'] = $row['berangkat'];
		$data['tujuan'] = $row['tujuan'];
		$data['harga'] = $row['harga'];
		$data['jam_berangkat'] = $row['jam_berangkat'];
	} 

return $data;
}
function getAllDataJadwal() {
	global $conn;
	
	$sql = "SELECT id_jadwal, id_PO, berangkat, tujuan, harga, jam_berangkat FROM data_jadwal";
	$result = mysqli_query($conn, $sql);
	
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while($row = mysqli_fetch_array($result)) {
			$data['id_jadwal'] = $row['id_jadwal'];
			$data[$i]['id_PO'] = $row['id_PO'];
			$data[$i]['berangkat'] = $row['berangkat'];
			$data[$i]['tujuan'] = $row['tujuan'];
			$data[$i]['harga'] = $row['harga'];
			$data[$i]['jam_berangkat'] = $row['jam_berangkat'];
		}
	}
	
	return $data;
}

function insertDataJadwal($id_jadwal, $id_PO, $berangkat, $tujuan, $harga, $jam_berangkat) {
	global $conn;
	
	$sql = "INSERT INTO data_jadwal (id_jadwal, id_PO, berangkat, tujuan, harga, jam_berangkat )
	VALUES ('$id_jadwal', '$id_PO', '$berangkat, '$tujuan', '$harga','$jam_berangkat')";
	
	if (mysqli_query($conn, $sql)) {
		header('Location: konten_admin.php?status=sukses');
		echo '<div class="alert alert-success">Berhasil Input! </div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.$sql.'<br>'.mysqli_error($conn).'</div>';
	}
	
}
	return $data;
	
}
function getDataPO($id_PO){
	global $conn;

	$sql = "SELECT id_PO, nama, seat_max FROM data_PO WHERE id_PO = '$id_PO'";
	$result = mysqli_query($conn, $sql);
	$data = array();
	$row = mysqli_fetch_array($result);
	$data['id_PO'] = $row['id_PO'];
	$data['nama'] = $row['nama'];
	$data['seat_max'] = $row['seat_max'];
	
	

return $data;
}
function getAllDataPO() {
	global $conn;
	
	$sql = "SELECT id_PO, nama, seat_max FROM data_PO";
	$result = mysqli_query($conn, $sql);
	
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while($row = mysqli_fetch_array($result)) {
			$data[$i]['id_PO'] = $row['id_PO'];
			$data[$i]['nama'] = $row['nama'];
			$data[$i]['seat_max'] = $row['seat_max'];
			$i++;
		}
	}
	
	return $data;
}
function insertDataPO($id_PO, $nama, $seat_max) {
	global $conn;
	
	$sql = "INSERT INTO data_PO (id_PO, nama, seat_max) VALUES ('$id_PO', '$nama', '$seat_max')";
	
	if (mysqli_query($conn, $sql)) {
		header('Location: tambahPO.php?status=sukses');
		echo '<div class="alert alert-success">Berhasil Input! </div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.$sql.'<br>'.mysqli_error($conn).'</div>';
	}
	

	return $data;
	
}
function updateDataPO($id_PO, $nama, $seat_max) {
	global $conn;
	
	$sql = "UPDATE data_po SET nama='$nama', seat_max = '$seat_max' WHERE id_PO = '$id_PO'";
	
	if (mysqli_query($conn, $sql)) {
		header('Location: konten-admin.php?status=sukses');
		echo '<div class="alert alert-success">Berhasil Update!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.mysqli_error($conn).'</div>';
	}
	
}
function deleteDataPO($id_PO) {
	global $conn;
	
	$sql = "DELETE FROM data_PO WHERE id_PO = '$id_PO'";
	
	if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success">Berhasil Delete!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.mysqli_error($conn).'</div>';
	}
	
}
function getDataPesan($id_booking){
	global $conn;

	$sql = "SELECT id_booking, id_seat, username, status_bayar FROM data_booking WHERE id_booking = '$id_booking'";
	$result = mysqli_query($conn, $sql);
	$data = array();
	$row = mysqli_fetch_array($result);
	$data['id_booking'] = $row['id_booking'];
	$data['id_seat'] = $row['id_seat'];
	$data['username'] = $row['username'];
	$data['status_bayar'] = $row['status_bayar'];
	
	

return $data;
}
function getAllDataPesan() {
	global $conn;
	
	$sql = "SELECT id_booking, id_seat, username, status_bayar FROM data_booking";
	$result = mysqli_query($conn, $sql);
	
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while($row = mysqli_fetch_array($result)) {
			$data[$i]['id_booking'] = $row['id_booking'];
			$data[$i]['id_seat'] = $row['id_seat'];
			$data[$i]['username'] = $row['username'];
			$data[$i]['status_bayar'] = $row['status_bayar'];
			$i++;
		}
	}
	
	return $data;
}
function updateDataPesan($id_booking, $id_seat, $username, $status_bayar) {
	global $conn;
	
	$sql = "UPDATE data_booking SET id_seat='$id_seat', username = '$username', status_bayar = '$status_bayar' WHERE id_booking = '$id_booking'";
	
	if (mysqli_query($conn, $sql)) {
		header('Location: pemesanan.php?status=sukses');
		echo '<div class="alert alert-success">Berhasil Update!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.mysqli_error($conn).'</div>';
	}
	
}
function deleteDataPesan($id_booking) {
	global $conn;
	
	$sql = "DELETE FROM data_booking WHERE id_booking = '$id_booking'";
	
	if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success">Berhasil Delete!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.mysqli_error($conn).'</div>';
	}
	
}
function getDataPenumpang($id_jadwal, $tanggal_berangkat){
	global $conn;
	$data = array();

	$sql = "SELECT s.no_seat, u.nama FROM data_booking b JOIN data_seat s ON b.id_seat = s.id_seat JOIN data_user u ON b.username = u.username JOIN data_jadwal j ON s.id_jadwal = j.id_jadwal WHERE s.id_jadwal = '$id_jadwal' AND s.tanggal_berangkat='$tanggal_berangkat' ORDER BY s.no_seat ASC";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['no_seat'] = $row['no_seat'];
			$data[$i]['nama'] = $row['nama'];
			$i++;
		}
	}
	return $data;
}
function getAllDataPenumpang() {
	global $conn;
	$data = array();
	
	$sql = "SELECT o.no_seat,n.username FROM data_seat o JOIN data_jadwal j JOIN data_po p JOIN data_booking n JOIN data_user m WHERE j.id_jadwal=o.id_jadwal AND p.id_po = j.id_po AND j.id_PO = 'EF' AND tanggal_berangkat = '2019-12-02' AND m.username=n.username ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['no_seat'] = $row['no_seat'];
			$data[$i]['username'] = $row['username'];
			$i++;
		}
	}
	return $data;
}
function getAllDataPenumpang2() {
	global $conn;
	$data = array();
	
	$sql = "SELECT o.no_seat,n.username FROM data_seat o JOIN data_jadwal j JOIN data_po p JOIN data_booking n JOIN data_user m WHERE j.id_jadwal=o.id_jadwal AND p.id_po = j.id_po AND j.id_PO = 'SA' AND m.username=n.username" ;
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$data[$i]['no_seat'] = $row['no_seat'];
			$data[$i]['username'] = $row['username'];
			$i++;
		}
	}
	return $data;
}
function insertDataBus($id_jadwal, $id_po, $berangkat,$tujuan, $harga, $jam_berangkat) {
	global $conn;
	
	$sql = "INSERT INTO data_jadwal (id_jadwal, id_po,berangkat,tujuan,harga,jam_berangkat)
	VALUES ('$id_jadwal', '$id_po', '$berangkat','$tujuan', '$harga', '$jam_berangkat')";
	
	if (mysqli_query($conn, $sql)) {
		header('Location: admin_jadwal.php?status=sukses');
		echo '<div class="alert alert-success">Berhasil Input! </div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.$sql.'<br>'.mysqli_error($conn).'</div>';
	}
	
}
function updateDataBus($id_jadwal, $id_po, $berangkat,$tujuan, $harga, $jam_berangkat) {
	global $conn;
	
	$sql = "UPDATE data_jadwal SET id_po='$id_po', berangkat = '$berangkat',tujuan='$tujuan',harga='$harga', jam_berangkat = '$jam_berangkat' WHERE id_jadwal = '$id_jadwal'";
	
	if (mysqli_query($conn, $sql)) {
		header('Location: admin_jadwal.php?status=sukses');
		echo '<div class="alert alert-success">Berhasil Update!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.mysqli_error($conn).'</div>';
	}
	
}

function deleteDataBus($id_jadwal) {
	global $conn;
	
	$sql = "DELETE FROM data_jadwal WHERE id_jadwal = '$id_jadwal'";
	
	if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success">Berhasil Delete!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: '.mysqli_error($conn).'</div>';
	}
	
}

function getDataBus($id_jadwal) {
	global $conn;
	
	$sql = "SELECT id_jadwal, id_PO, berangkat,tujuan,harga,jam_berangkat FROM data_jadwal WHERE id_jadwal = '$id_jadwal'";
	$result = mysqli_query($conn, $sql);
	
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$data['id_jadwal'] = $row['id_jadwal'];
		$data['id_PO'] = $row['id_PO'];
		$data['berangkat'] = $row['berangkat'];
				$data['tujuan'] = $row['tujuan'];
		$data['harga'] = $row['harga'];
		$data['jam_berangkat'] = $row['jam_berangkat'];
	}
	
	return $data;
}

function getAllDataBus() {
	global $conn;
	
	$sql = "SELECT id_jadwal, id_po, berangkat,tujuan,harga,jam_berangkat FROM data_jadwal";
	$result = mysqli_query($conn, $sql);
	
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while($row = mysqli_fetch_array($result)) {
			$data[$i]['id_jadwal'] = $row['id_jadwal'];
			$data[$i]['id_po'] = $row['id_po'];
			$data[$i]['berangkat'] = $row['berangkat'];
			$data[$i]['tujuan'] = $row['tujuan'];
			$data[$i]['harga'] = $row['harga'];
			$data[$i]['jam_berangkat'] = $row['jam_berangkat'];
			$i++;
		}
	}
	
	return $data;
}
function getAllDataJadwal() {
	global $conn;
	
	$sql = "SELECT id_jadwal FROM data_jadwal";
	$result = mysqli_query($conn, $sql);
	
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while($row = mysqli_fetch_array($result)) {
			$data[$i]['id_jadwal'] = $row['id_jadwal'];
			$i++;
		}
	}
	
	return $data;
}
?>