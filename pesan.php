<?php 

require_once "header.php";
require_once "fungsi.php";

//session_start();

/*if (!isset($_SESSION['username'])) {
	header("location:login.php");
	exit;
}*/

$username = 'dionisiusjovan@easybus.com';
$id_jadwal = isset($_GET['jadwal']) ? $_GET['jadwal'] : "";
$tglberangkat = isset($_GET['tanggal']) ? $_GET['tanggal'] : "";

$seatmax = 0;
$harga = 0;

$data = getJadwalbyid($id_jadwal, $tglberangkat);
$seating = getSeat($id_jadwal, $tglberangkat);
$seating_map="[";
if (sizeof($seating)>0) {
	for ($i=0; $i <sizeof($seating) ; $i++) { 
		$seating_map .= "'".$seating[$i]['seat_map']."'";
		if ($i < sizeof($seating)-1) {
			$seating_map .= ",";
		}
	}
}
$seating_map.="]";


echo '<div class="container" style="font-size: 15px">';
if (sizeof($data) > 0) {
	foreach ($data as $val) {				
				echo '
				<div class="row">
					<div class="col-6">
					<br><br>
						<table class="table table-borderless">	
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
								<td>'.date('d F Y', strtotime($tglberangkat)).' '.$val['jambrk'].'.00</td>
							</tr>
							<tr>
								<td>Kursi Tersedia</td>
								<td>:</td>
								<td>'.$val['KursiTersedia'].'</td>
							</tr>
							<tr>
								<td>Harga Tiket</td>
								<td>:</td>
								<td>Rp'.$val['harga'].',-</td>
							</tr>	
						</table>						
					</div>
				';
				$harga = (int)$val['harga'];
				$seatmax = (int)$val['seat_max'];
			}

			echo '<div class="col-6"> <br><br>';
?>

				<div class="wrapper">
					<div class="container">
						<div class="booking-details">
							<h2>Detail Pemesanan</h2>
							<form action="pesan.php?konfirmasi=1" method="POST">
			<?php	echo   '<input type="text" name="id_jadwal" value="'.$id_jadwal.'" />
							<input type="text" name="tglberangkat" value="'.$tglberangkat.'" /> '; ?>
							<h3> Denah Kursi (<span id="counter">0</span>):</h3>
								<ul id="selected-seats"></ul>
									
								Total: <b>Rp<span id="total">0</span></b>
									
								<!--<button id="button" class="checkout-button" data-role="buton">Checkout &raquo;</button>-->
								<input type="submit" name="checkout" value="checkout"></input>
							</form>					
							<div id="legend"></div>
						</div>
						<div id="seat-map" style="font-size: 25px">
							<div class="front-indicator">Depan</div>
						</div>
					</div>
				</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="jQuery-Seat-Charts/jquery.seat-charts.js"></script>
		<script>
			var firstSeatLabel = 1;
		
			jQuery(function($) {
				var $cart = $('#selected-seats'),
					$counter = $('#counter'),
					$total = $('#total'),
					sc = $('#seat-map').seatCharts({
					map: [
						<?php 
							if ($seatmax == 40) {
								echo "
									'ee_ee',
									'ee_ee',
									'ee_ee',
									'ee_ee',
									'ee_ee',
									'ee_ee',
									'ee_ee',
									'ee_ee',
									'ee_ee',
									'ee_ee'
								";
							} else {
								echo "
									'ee_',
									'eee',
									'eee',
									'eee',
									'eee',
									'eee'
								";
							}
						?>
					],
					seats: {
						e: {
							price   : <?php echo $harga;?>,
							classes : 'executive-class', //your custom CSS class
							category: 'Executive Class'
						}					
					
					},
					naming : {
						top : false,
						getLabel : function (character, row, column) {
							return firstSeatLabel++;
						},
					},
					legend : {
						node : $('#legend'),
					    items : [
							[ 'e', 'available',   'Masih Tersedia'],
							[ 'e', 'unavailable', 'Telah Dipesan']
					    ]					
					},
					click: function () {
						if (this.status() == 'available') {
							//let's create a new <li> which we'll add to the cart items
							//$('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>Rp'+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
							//	.attr('id', 'cart-item-'+this.settings.id)
							//	.data('seatId', this.settings.id)
							//	.appendTo($cart);

							$('<li> Seat # <input type="text" name="seat[]" value="'+this.settings.label+'" size="5" /></b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
								.attr('id', 'cart-item-'+this.settings.id)
								.data('seatId', this.settings.id)
								.appendTo($cart);
							
							/*
							 * Lets update the counter and total
							 *
							 * .find function will not find the current seat, because it will change its stauts only after return
							 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
							 */
							$counter.text(sc.find('selected').length+1);
							$total.text(recalculateTotal(sc)+this.data().price);

							
							return 'selected';
						} else if (this.status() == 'selected') {
							//update the counter
							$counter.text(sc.find('selected').length-1);
							//and total
							$total.text(recalculateTotal(sc)-this.data().price);
						
							//remove the item from our cart
							$('#cart-item-'+this.settings.id).remove();
						
							//seat has been vacated
							return 'available';
						} else if (this.status() == 'unavailable') {
							//seat has been already booked
							return 'unavailable';
						} else {
							return this.style();
						}
					}
				});

				//this will handle "[cancel]" link clicks
				$('#selected-seats').on('click', '.cancel-cart-item', function () {
					//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
					sc.get($(this).parents('li:first').data('seatId')).click();
				});

				//let's pretend some seats have already been booked
				sc.get(<?php echo $seating_map;?>).status('unavailable');

		
		});

		function recalculateTotal(sc) {
			var total = 0;
		
			//basically find every selected seat and sum its price
			sc.find('selected').each(function () {
				total += this.data().price;
			});
			
			return total;
		}
		
		</script>

<?php
			echo '</div>';
			echo '
				</table>

			</div>
			';

		} else {
			echo '<div class="alert alert-danger"><h3>TIDAK ADA DATA</h3></div>';
		}

echo '</div>';

$konfirmasi = isset($_GET['konfirmasi']) ? $_GET['konfirmasi'] : 0;
$kursidipesan = array();
$id_seat = 0;

if ($konfirmasi == 1) {
	$username = 'dionisiusjovan@easybus.com';
	$id_jadwal = isset($_POST['id_jadwal']) ? $_POST['id_jadwal'] : "";
	$tglberangkat = isset($_POST['tglberangkat']) ? $_POST['tglberangkat'] : "";
	$kursidipesan = isset($_POST['seat']) ? $_POST['seat'] : [null];
	if (sizeof($kursidipesan)>0) {
		foreach ($kursidipesan as $val) {
			if (newSeat($id_jadwal, $val, $tglberangkat) == true) {
				$data = getSeatforBooking($id_jadwal, $val, $tglberangkat);

				if (sizeof($data)>0) {
					foreach ($data as $vl) {
						$id_seat = $vl['id_seat'];
					}
				}
				if (newBook($id_seat, $username) == true) {
					header("location:pembayaran.php?kursi=".sizeof($kursidipesan)."");
				}
				else{
					echo '<div class="alert alert-danger"> Gagal membuat Booking! </div>';
					deleteSeat($id_seat);
				}
			} else{
				echo '<div class="alert alert-danger"> Gagal memesan kursi! </div>';
				deleteSeat($id_seat);
			}
		}
	}
}









require_once "footer.php";

 ?>