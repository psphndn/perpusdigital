<?php 

include('template/top.php');


session_start();


include_once "fungsi.php";
    if(isset($_POST['Submit'])) {
        $id_jadwal = $_POST['id_jadwal'];
        $id_PO = $_POST['id_PO'];
        $berangkat = $_POST['berangkat'];
        $tujuan = $_POST['tujuan'];
        $harga = $_POST['harga'];
        $jam_berangkat = $_POST['jam_berangkat'];
        insertDataBus($id_jadwal, $id_PO, $berangkat,$tujuan, $harga, $jam_berangkat);

        // Show message when user added

    }

$dataPO = getAllDataPO();
$listIdPO = '';

if (sizeof($dataPO) > 0) {
    foreach ($dataPO as $val) {
        $listIdPO .= '
            <option value="'.$val['id_PO'].'">'.$val['nama'].'</option>
        ';
    }
}

echo '';

echo '<div class="container-fluid">
   <div class="row">
    <div class="col"></div>
    <div class="col-8">
      <h2>
        <center> Input Data </center>
      </h2>
    </div>
    <div class="col"></div>
  </div>
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
        <form action="crud.php" method="post" name="insert_data">
        <table class="table table-responsive-lg table-lg">
            <tr> 
                <td>id_jadwal</td>
                <td><input class="form-control" type="text" name="id_jadwal"></td>
            </tr>
            <tr> 
                <td>id_PO</td>
                <td><select class="form-control" name="id_PO">
                        '.$listIdPO.'
                    </select>
                </td>
            </tr>
            <tr> 
                <td>berangkat</td>
                <td><input class="form-control" type="text" name="berangkat"></td>
            </tr>
                        <tr> 
                <td>tujuan</td>
                <td><input class="form-control" type="text" name="tujuan"></td>
            </tr>
            <tr> 
                <td>harga</td>
                <td><input class="form-control" type="text" name="harga"></td>
            </tr>
            <tr> 
                <td>jam_berangkat</td>
                <td><input class="form-control" type="text" name="jam_berangkat"></td>
            </tr>
            <tr> 
                <td><a href="admin_jadwal.php"><button type="button" class="btn btn-primary">Kembali</button></td>
                <td><input class="btn btn-success" type="submit" name="Submit" value="Update"></td>
            </tr>
        </table>
    </form>
    </div>
    <div class="col"></div>
  </div>
  <div class="row">
    <div class="col"></div>
    <div class="col-8"></div>
    <div class="col"></div>
  </div>
  </div>';



?>

    