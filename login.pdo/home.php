<html>
<head>
</head>
<body>
<?php
 	session_start();
 	
	$username = $_SESSION['NOME'];
	echo ("Bem Vindo!".$username);
 ?>
 <form method="POST" action="logout.php">
 <br>
 <input type="submit" value="Logout">
 </form>
</body>
</html>

