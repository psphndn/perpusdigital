<?php

session_start();

global $conn; 
include 'config.php';
$err = '';

if (isset($_POST["login"])) {
	$username = isset($_POST["username"]) ? $_POST["username"] : "";
	$password = isset($_POST["password"]) ? $_POST["password"] : "";

	$result = mysqli_query($conn, "SELECT * FROM data_user WHERE username = '$username'");

	//cek username
	if ( mysqli_num_rows($result) === 1 ) {
		//cek password
		$row = mysqli_fetch_assoc($result);
		if ( password_verify($password, $row["password"]) ) {
			//set session
			$_SESSION["login"] = true; 
			header("location: tiket_saya.php");
			exit;
		} else{
			$err .= '<script> alert("Username / Password salah"); </script>';
		}
	}


}


echo '
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Login page</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	</head> 
	<body>

	<div class="container-fluid">
		'.$err.'
		<div class="login">

		<div class="avatar">
			<i class="fa fa-user"></i>
		</div>

		<h2>Login Form</h2>
		<div class="login">

		<div class="avatar">
			<i class="fa fa-user"></i>
		</div>

		<h2>Login Form</h2>

		<div class="box-login">
			<i class="fas fa-user"></i>
			<input type="text" placeholder="Username">
		</div>
		<div class="box-login">
			<i class="fas fa-lock"></i>
			<input type="text" placeholder="Password">
		</div>

		<button type="submit" class="btn-login">
			Log in
		</button>

			<ul class="bottom">	
				<li class="bottom">
					<a href="register.php">Register</a>
				</li>
			</ul>

		<div class="bottom">
			<a href="register.php">Register</a> 
		</div> 

	</div>  
	</body>
	</html>
';
?>