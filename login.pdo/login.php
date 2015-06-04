<?php
 include ("lig.php");
 
$db = new lig();

$username = $_POST["username"];
$password = $_POST['password'];
 
 $salt=$db->login($username);
 
foreach($salt as $linha){

	$hash=hash('sha256',$password);
	echo $hash.'<br>';
	$hash=hash('sha256',$linha['salt'].$hash);
 
	echo 'hash: '.$hash.' pass bd: '.$linha['password'];
	
	 if($hash!=$linha['password'])
	 {
		echo("LOGIN SEM SUCESSO");
	 }
	 else
	 {
		 session_start();
		 $_SESSION['NOME'] = $username;
		 echo("LOGIN EFETUADO");
		 header('Location: home.php');
	 }
 }

 ?>
 
