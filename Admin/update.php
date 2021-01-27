<?php 
include('template/top.php');

session_start();



include_once "fungsi.php";
$id = $_GET['id'];

// Fetch user data based on id
$bus['data'] = getDataBus($id);

if(isset($_POST['Update'])) {
  updateDataBus($_POST['id_jadwal'], $_POST['id_PO'], $_POST['berangkat'],$_POST['tujuan'], $_POST['harga'], $_POST['jam_berangkat']);
}

echo '';

echo '<div class="container-fluid">
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
        <h2>
          <center> Edit Data </center>
        </h2>

         <form action="update.php" method="post" name="Update">
        <table class="table table-responsive-lg">
            <tr> 
                <td>id_jadwal</td>
                <td><input class="form-control" id="disabledInput" type="text" name="id_jadwal" value= "'.$id.'"</td>
            </tr>
            <tr> 
                <td>id_po</td>
                <td><input class="form-control" type="text" name="id_PO" value="'.$bus['data']['id_PO'].'"></td>
            </tr>
            <tr> 
                <td>berangkat</td>
                <td><input class="form-control" type="text" name="berangkat" value="'.$bus['data']['berangkat'].'"></td>
            </tr>

            <tr> 
                <td>tujuan</td>
                <td><input class="form-control" type="text" name="tujuan" value="'.$bus['data']['tujuan'].'"></td>
            </tr>
		            <tr> 
                <td>harga</td>
                <td><input class="form-control" type="text" name="harga" value="'.$bus['data']['harga'].'"></td>
            </tr>
            <tr> 
                <td>jam_berangkat</td>
                <td><input class="form-control" type="text" name="jam_berangkat" value="'.$bus['data']['jam_berangkat'].'"></td>
            </tr>
            <tr> 
              <td></td>
              <td><input class="btn btn-success" type="submit" name="Update" value="Update"></td>
            </tr>
        </table>
    </form>
    </div>
    <div class="col"></div>
  </div>
  <div class="row">
    <div class="col"></div>
    <div class="col-8">
    </div>
    <div class="col"></div>
  </div>
  </div>';



?>
