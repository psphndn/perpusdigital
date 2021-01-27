<?php 
require_once "header.php";
require_once "fungsi.php";

require_once "header.php";
require_once "library/fpdf.php";

$username = 'dionisiusjovan@easybus.com';
$kodebooking = isset($_GET['booking']) ? $_GET['booking'] : 0;
$data = getBookingbykode($kodebooking);
$datauser = getDataUser($username);
$nama_penumpang = '';
$no_telp = '';

$pdf = new FPDf('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B', 18);
$pdf->Cell(190,7,'EasyBus!',0,1,'C');
$pdf->Line(20,19,190,19);
$pdf->ln();

$pdf->SetFont('Arial','',12);

if (sizeof($datauser) > 0) {
	foreach ($datauser as $val) {
		$nama_penumpang .= $val['nama'];
		$no_telp .= $val['no_telp'];
	}
}

if (sizeof($data) > 0) {
	$i = 0;
	foreach ($data as $val) {
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(100,6,'Perusahaan Otobus',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(100,6,'Harga Tiket',0,1);

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(100,6,$val['nama'],0,0);


		$pdf->SetFont('Arial','',12);
		$pdf->Cell(100,6,'Rp'.$val['harga'],0,0);

		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,6,'Rute Perjalanan',0,1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(30,6,$val['berangkat'],0,0);
		$pdf->Cell(10,6,' -> ',0,0);
		$pdf->Cell(30,6,$val['tujuan'],0,0);
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(100,6,'Waktu Perjalanan',0,0);

		$pdf->Cell(0,8,'No. Kursi:',0,1);

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(45,6,date('d F Y', strtotime($val['tanggal_berangkat'])),0,0);
		$pdf->Cell(90,6,$val['jambrk'].'.00',0,0);

		$pdf->SetFont('Arial','',40);
		$pdf->Cell(100,6,$val['no_seat'],0,0);

		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'Nama Penumpang',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(100,6,$nama_penumpang,0,0);
		$pdf->SetFont('Arial','',10);

		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'No Telpon',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(100,6,$no_telp,0,1);
	}

} 
$pdf->Line(20,80,190,80);
$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,6,'Perhatian: Tiket ini merupakan tiket resmi. Tunjukkan kepada kru bus yang bertugas saat pengecekan.',0,1);
$pdf->Cell(100,6,'Pastikan Anda datang ke tempat pemberangkatan 30 menit sebelum perjalanan untuk check-in di counter Easybus!',0,1);
$pdf->Cell(100,6,'Apabila penumpang gagal hadir atau terlambat datang, tiket ini menjadi hangus dan tidak dapat digunakan lagi.',0,0);


ob_start();
$pdf->OutPut();

ob_end_flush();






require_once "footer.php";
 ?>