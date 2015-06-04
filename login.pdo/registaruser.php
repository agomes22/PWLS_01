<?php
	include ("lig.php");
	
	$db = new lig();
	
	$username = $_POST['username'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	
	
	
	if ($pass1 != $pass2)
    {
	header ('Location: registar.php');
	}
	$hash=hash('sha256',$pass1);
	function createsalt()
	{
	 $string= md5(rand());
	 return substr($string,0,3);
	}
	$salt =createsalt();
	
	$db->registar_user($username, $pass1, $salt);
	header('Location: index.php');
	?>


	