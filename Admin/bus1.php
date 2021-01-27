<?php 

include('template/top.php');

include_once "fungsi.php";

$list_pg = '';
$listjadwal = '';
$tanggal_berangkat = isset($_GET['tanggal_berangkat']) ? $_GET['tanggal_berangkat'] : date("Y-m-d");
$id_jadwal = isset($_GET['id_jadwal']) ? $_GET['id_jadwal'] : "";
$jadwal = getAllDataJadwal();
$pg = array();
$sopir = isset($_GET['sopir']) ? $_GET['sopir'] : '';

if (isset($_GET['id_jadwal']) && isset($_GET['tanggal_berangkat'])) {
  $pg = getDataPenumpang($id_jadwal, $tanggal_berangkat);

  if (sizeof($pg) > 0) {
    foreach ($pg as $val) {
      $list_pg .= '
        <tr>
          <td width="10%" nowrap><center>'.$val['no_seat'].'</center></td>
          <td>'.$val['nama'].'</td>
        </tr>
      ';
    }
  } else {
    $list_pg = '<tr class="table-danger"><td colspan="3">No Data</td></tr>';
  }
}

if (sizeof($jadwal) > 0) {
    foreach ($jadwal as $val) {
      $listjadwal .= '
        <option value="'.$val['id_jadwal'].'">'.$val['id_jadwal'].'</option>
      ';
    }
} 

  

echo '
<div class="container-fluid">
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
      <br>
        <h2>
          <center> Manifest Penumpang </center>
        </h2>
        <form action="bus1.php" method="get">
        <table class="table table-borderless">
          <tr>
              <td>Jadwal</td>
              <td><select class="form-control" name="id_jadwal" id="id_jadwal">
                              '.$listjadwal.'
              </select>
              </td>
          </tr>
          <tr>
                <td>Pengemudi</td>
                <td><input class="form-control" type="text" name="sopir" value="'.$sopir.'"></td>
          </tr>
          <tr>
                <td>Tanggal Berangkat</td>
                <td><input class="form-control" type="text" name="tanggal_berangkat" value="'.date("Y-m-d").'" label="YYYY-MM-DD"></td>
          </tr>
          <tr>
                <td><input class="btn btn-success" type="submit" name="Submit" value="Submit">
                <a href="index.php"><button type="button" class="btn btn-danger">Home</button>
                </td>
          </tr>
        </table>
        </form>

        <table class="table table-bordered table-hover">
        <tr class="table-success">
          <th width="10%" nowrap><center>No Seat</center></th>
          <th>Username</th>
        </tr>
        '.$list_pg.'
      </table>
      </div>';



?>