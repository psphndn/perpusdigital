<?php 


include('template/top.php');

include_once "fungsi.php";
$id = $_GET['id'];

// Fetch user data based on id
$psn['data'] = getDataPesan($id);

if(isset($_POST['Update'])) {
  updateDataPesan($_POST['id_booking'], $_POST['id_seat'], $_POST['username'], $_POST['status_bayar']);
}

echo '';

echo '<div class="container-fluid">
  <div class="row">
    <div class="col"></div>
      <div class="col-8">
        <h2>
          <center> Edit Data </center>
        </h2>

         <form action="editPsn.php" method="post" name="Update">
        <table class="table table-responsive-lg">
            <tr> 
                <td>ID Booking</td>
                <td><input class="form-control" id="disabledInput" type="text" name="id_booking" value= "'.$id.'"</td>
            </tr>
            <tr> 
                <td>ID Seat</td>
                <td><input class="form-control" type="text" name="id_seat" value="'.$psn['data']['id_seat'].'"></td>
            </tr>
            <tr> 
                <td>Username</td>
                <td><input class="form-control" type="text" name="username" value="'.$psn['data']['username'].'"></td>
            </tr>
            <tr> 
                <td>Status Bayar</td>
                <td><input class="form-control" type="text" name="status_bayar" value="'.$psn['data']['status_bayar'].'"></td>
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
