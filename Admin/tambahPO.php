<?php 

include('template/top.php');


include_once "fungsi.php";
    if(isset($_POST['Submit'])) {
        $id_PO = $_POST['id_PO'];
        $nama = $_POST['nama'];
        $seat_max = $_POST['seat_max'];

        insertDataPO($id_PO, $nama, $seat_max);

        // Show message when user added

    }

echo '';

echo '<div class="container-fluid">
   <div class="row">
    <div class="col"></div>
    <div class="col-8">
      <h2>
      <br>
        <center> Input Data PO </center>
      <br>
      </h2>
    </div>
    <div class="col"></div>
  </div>
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
        <form action="tambahPO.php" method="post" name="insert_data">
        <table class="table table-responsive-lg table-lg">
            <tr> 
                <td>ID PO</td>
                <td><input class="form-control" type="text" name="id_PO"></td>
            </tr>
            <tr> 
                <td>Nama</td>
                <td><input class="form-control" type="text" name="nama"></td>
            </tr>
            <tr> 
                <td>Seat Max</td>
                <td><input class="form-control" type="text" name="seat_max"></td>
            </tr>
            <tr> 
                <td><a href="konten-admin.php"><button type="button" class="btn btn-primary">Kembali</button></td>
                <td><input class="btn btn-success" type="submit" name="Submit" value="Submit"></td>
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
<?php include('template/footer.php'); ?>
    