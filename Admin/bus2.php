<?php 

include('template/top.php');

include_once "fungsi.php";

$list_pg = '';
$pg = getAllDataPenumpang2();

  if (sizeof($pg) > 0) {
    foreach ($pg as $val) {
      $list_pg .= '
        <tr>
          <td width="10%" nowrap><center>'.$val['no_seat'].'</center></td>
          <td>'.$val['username'].'</td>
        </tr>
      ';
    }
  } else {
    $list_pg = '<tr class="table-danger"><td colspan="3">No Data</td></tr>';
  }

  if (isset($_GET['status'])) {
    if ($_GET['status']=='sukses') {
      echo '<div class="alert alert-success">Berhasil! </div>';
    }
  }

echo '';
  
echo '


<div class="container-fluid">
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
      <br>
        <h2>
          <center> Data Penumpang Bus Efisiensi </center>
        </h2>
<p class="text-primary">Berangkat : Semarang</b></p>
<p class="text-primary">Tujuan : Cilacap</b></p>

<form action="bus1.php" method="get">
            <div class="row text-center">
              <div class="col-lg text-center">
                <div style="font-size: 15px">Driver</div>
                  <select class="selectpicker" data-live-search="true" data-style="button btn-lg btn-success" name="Driver">
                
                <option value="1" disabled selected>--Pilih Driver--</option>
                <option value="2">Suharno</option>
                <option value="3">Bagus</option>
                <option value="4">Rendi</option>
                <option value="5">Roni</option>
                <option value="6">Bima</option>
              </select>
          </div>
          <br>
          <br>
          <div class="col-lg">
                <div style="font-size: 15px">Pilih Tanggal Berangkat</div>
                  <div class="input-group input-group-lg date">
                  <div class="input-group-addon"><span style="font-size: 20px" class="glyphicon glyphicon-th"></span></div>
                     <input placeholder="YYYY-MM-DD" type="text" class="form-control datepicker" name="tgl_berangkat" value="" data-date-format="yyyy/mm/dd" container="container" style="font-size: 15px" size="16"></input>
                       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"></script>
                     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
                     <script>
                     jQuery(function($) {
                         $(".datepicker").datepicker();
                     });
                     </script>
        <table class="table table-bordered table-hover">
        <tr class="table-success">
          <th width="10%" nowrap><center>No Seat</center></th>
          <th>Username</th>
        </tr>
        '.$list_pg.'
      </table>
      </div>
  </div>';



?>