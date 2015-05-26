<?php
 include ("lig.php");
 


$username = "username";
$password = "";


try{
$DBH= new PDO("mysql:host=localhost",$username,$password);
}catch (PDOException $e){
  echo $e->getMessage();
}
 $query = "select password,salt from users where username='$username';";
 $result = mysqli_query($ligacao,$query);
 $userData = mysqli_fetch_assoc($result);
 $passBD=$userData['password'];
 $salt=$userData['salt'];
 $hash=hash('sha256',$password);
 $hash=hash('sha256',$salt.$hash);
 if($hash!=$passBD)
 {
 echo("LOGIN COM SUCESSO");
 }
 else
 {
 session_start();
 $_SESSION['NOME'] = $username;
 echo("LOGIN ERRADO");
 header('Location: home.php');
 }

 ?>
 
