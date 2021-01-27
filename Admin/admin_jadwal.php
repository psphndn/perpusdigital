<?php 

include('template/top.php');
include_once "fungsi.php";




include_once "fungsi.php";
$form = '';
$bus = getAllDataBus();

  if (sizeof($bus) > 0) {
    foreach ($bus as $val) {
      $form .= '
        <tr>
          <td width="10%" nowrap><center>'.$val['id_jadwal'].'</center></td>
          <td>'.$val['id_po'].'</td>
          <td>'.$val['berangkat'].'</td>
		   <td>'.$val['tujuan'].'</td>
          <td>'.$val['harga'].'</td>
          <td>'.$val['jam_berangkat'].'</td>
          <td>
            <a href="update.php?id='.$val['id_jadwal'].'"><i class="material-icons d-inline-block align-top" style="font-size:20px;"></i>Edit</a> | 
			<a href="delete.php?id='.$val['id_jadwal'].'" style="color:red;"> <i class="material-icons d-inline-block align-top" style="font-size:20px; color:red;"></i>Delete</a>
          </td>
        </tr>
      ';
    }
  } else {
    $form = '<tr class="table-danger"><td colspan="3">No Data</td></tr>';
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
          <center> List data BUS </center>
        </h2>

        <table class="table table-bordered table-hover">
        <tr class="table-success">
          <th width="10%" nowrap><center>id_jadwal</center></th>
          <th>id_po</th>
		  <th>berangkat</th>
          <th>tujuan</th>
		  <th>harga</th>
          <th>jam_berangkat</th>
          <th> </th>
        </tr>
        '.$form.'
      </table>
      </div>
    <div class="col"></div>
  </div>
  <div class="row">
    <div class="col"></div>
    <div class="col-8">
      <tr>
        <a href="crud.php"><button type="button" class="btn btn-primary">Tambahkan Data Jadwal</button>
         <td><a href="index.php"><button type="button" class="btn btn-primary">Home</button></td>
      </tr>
    </div>
    <div class="col"></div>
  </div>
  </div>';



?>