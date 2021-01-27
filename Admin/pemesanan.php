<?php 

include('template/top.php');
include_once "fungsi.php";
$list_psn = '';
$psn = getAllDataPesan();

  if (sizeof($psn) > 0) {
    foreach ($psn as $val) {
      $list_psn .= '
        <tr>
          <td width="10%" nowrap><center>'.$val['id_booking'].'</center></td>
          <td>'.$val['id_seat'].'</td>
          <td>'.$val['username'].'</td>
          <td>'.$val['status_bayar'].'</td>
          
          <td>
            <a href="editPsn.php?id='.$val['id_booking'].'"><i class="material-icons d-inline-block align-top" style="font-size:20px;"></i>Edit</a> | <a href="deletePsn.php?id='.$val['id_booking'].'" style="color:red;"><i class="material-icons d-inline-block align-top" style="font-size:20px; color:red;"></i>Delete</a>
          </td>

        </tr>

      ';
    }
  } else {
    $list_psn = '<tr class="table-danger"><td colspan="3">No Data</td></tr>';
  }

  if (isset($_GET['status'])) {
    if ($_GET['status']=='sukses') {
      echo '<div class="alert alert-success">Berhasil! </div>';
    }
  }

echo '';

echo '<div class="container-fluid">
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
        <h2>
        <br>
          <center> Status Pemesanan </center>
          <br>
        </h2>

        <table class="table table-bordered table-hover">
        <tr class="table-success">
          <th width="10%" nowrap><center>ID Booking</center></th>
          <th>ID Seat</th>
          <th>Username</th>
          <th>Status Bayar</th>
          <th> </th>
        </tr>
        '.$list_psn.'
      </table>
      </div>
    <div class="col"></div>
  </div>
  <div class="row">
    <div class="col"></div>
    <div class="col-8">
      <tr>
      <td><a href="index.php"><button type="button" class="btn btn-primary">Home</button></td>
        <a href="tambahPO.php"><i class="material-icons d-inline-block align-top" style="font-size:20px;"></i>Tambah data baru</a>
      </tr>
    </div>
    <div class="col"></div>
  </div>
  </div>';



?>