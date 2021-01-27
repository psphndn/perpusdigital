<?php 

include('template/top.php');
include_once "fungsi.php";

$list_po = '';
$po = getAllDataPO();

  if (sizeof($po) > 0) {
    foreach ($po as $val) {
      $list_po .= '
        <tr>
          <td width="10%" nowrap><center>'.$val['id_PO'].'</center></td>
          <td>'.$val['nama'].'</td>
          <td>'.$val['seat_max'].'</td>
          
          <td>
            <a href="editPO.php?id='.$val['id_PO'].'"><i class="material-icons d-inline-block align-top" style="font-size:20px;"></i>Edit</a> | <a href="deletePO.php?id='.$val['id_PO'].'" style="color:red;"><i class="material-icons d-inline-block align-top" style="font-size:20px; color:red;"></i>Delete</a>
          </td>
        </tr>
      ';
    }
  } else {
    $list_po = '<tr class="table-danger"><td colspan="3">No Data</td></tr>';
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
          <center> Data PO </center>
          <br>
        </h2>

        <table class="table table-bordered table-hover">
        <tr class="table-success">
          <th width="10%" nowrap><center>ID PO</center></th>
          <th>Nama</th>
          <th>Seat_max</th>
          <th> </th>
        </tr>
        '.$list_po.'
      </table>
      </div>
    <div class="col"></div>
  </div>
  <div class="row">
    <div class="col"></div>
    <div class="col-8">
      <tr>

        <a href="tambahPO.php"><button type="button" class="btn btn-primary">Tambahkan Data PO</button>
        <td><a href="index.php"><button type="button" class="btn btn-primary">Home</button></td>
      </tr>
    </div>
    <div class="col"></div>
  </div>
  </div>';



?>