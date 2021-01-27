<?php 


include('template/top.php');


include_once "fungsi.php";
$id = $_GET['id'];

// Fetch user data based on id
$po['data'] = getDataPO($id);

if(isset($_POST['Update'])) {
  updateDataPO($_POST['id_PO'], $_POST['nama'], $_POST['seat_max']);
}

echo '';

echo '<div class="container-fluid">
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
        <h2>
          <center> Edit Data </center>
        </h2>

         <form action="editPO.php" method="post" name="Update">
        <table class="table table-responsive-lg">
            <tr> 
                <td>ID PO</td>
                <td><input class="form-control" id="disabledInput" type="text" name="id_PO" value= "'.$id.'"</td>
            </tr>
            <tr> 
                <td>Nama</td>
                <td><input class="form-control" type="text" name="nama" value="'.$po['data']['nama'].'"></td>
            </tr>
            <tr> 
                <td>Seat Max</td>
                <td><input class="form-control" type="text" name="seat_max" value="'.$po['data']['seat_max'].'"></td>
            </tr>
            <tr> 
              <td></td>
              <td><input class="btn btn-success" type="submit" name="Update" value="Update"></td>

            </tr>

        </table>
    </form>
       <
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
