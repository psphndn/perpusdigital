<?php

require "header.php";
require "fungsi.php";

$seating = getSeat($id_jadwal, $tglberangkat);

echo '			<div class="col-12">
					<form action="konfirmasi.php" method="POST" onsubmit="return validatecheckbox();">
';



for ($i=1; $i <= $seatmax/4 ; $i++) { 
	for ($j=1; $j <= 4 ; $j++) { 
				echo '<div class="form-check form-check-inline">';
		if (sizeof($seating) > 0) {
			foreach ($seating as $val) {
				if ($val['no_seat'] != $j+($seatmax/4) ) {
					echo '
							<input class="form-check-input" type="checkbox" id="ch'.$j+($seatmax/4).'" value="'.$j+($seatmax/4).'">
							<label class="form-check-label" for="ch'.$j+($seatmax/4).'">'.$j+($seatmax/4).'</label>
					';
					if ($j+($seatmax/4) % 2 == 0 ) {
						echo '
							&nbsp&nbsp
						';
					}
				} else
				{
					echo '
							<input class="form-check-input" type="checkbox" id="ch'.$j+($seatmax/4).'" value="'.$j+($seatmax/4).'" disabled>
							<label class="form-check-label" for="ch'.$j+($seatmax/4).'">'.$j+($seatmax/4).'</label>
					';
					if ($j+($seatmax/4) % 2 == 0 ) {
						echo '
							&nbsp&nbsp
						';
					}
				}
			}
		}
		echo '</div>';
	}
	echo '<br>';
}

echo '
					</form>
				</div>

';

require "footer.php";
?>