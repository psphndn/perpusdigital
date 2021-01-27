<?php  
echo '
<html>
<head>
	<title>Admin Area</title>
</head>
<body>
 
	<div style="text-align:center">
		<h2>Admin Area</h2>
		<p><a href="index.php">Home</a> / <a href="logout.php">Logout</a></p>
 
		<p>Selamat datang di Admin Area, Anda Login dengan username '. $_SESSION['username']'.</p>
	</div>
 
</body>
</html>
';

?>

