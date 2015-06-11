<?php

 class lig{ 
  private $servidor='localhost';
  private $dbnome='cat';
  private $user='root';
  private $pass='';
  public $liga;
  
  public function __construct(){
	  try{
		$this ->liga= new PDO('mysql:host='.$this->servidor.';dbname='.$this->dbnome, $this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"set names utf8"));
	  }catch(PDOExecption $e){
		echo 'Error'. $e->getMessage();
		die();
	  }
  }
  
  function login($id){
  
		  $select= "select * from utilizador where username like ?";
		  $stnt=$this->liga->prepare($select);
		  $stnt->bindValue(1,$id);
		  $stnt->execute();
		  
		  return $stnt->fetchAll();
  }
  
  function registar_user($username, $pass, $salt){
	$hash=hash('sha256',$pass);
	$hash=hash ('sha256', $salt.$hash);
	
	$stnt=$this->liga->prepare('Insert into utilizador(username,nome, password,salt, email, morada,dataNascimento, tipo) values (?,?,?,?,?,?,?,?)');
	$stnt->bindValue(1,$username);
	$stnt->bindValue(2,'c');
	$stnt->bindValue(3,$hash);
	$stnt->bindValue(4,$salt);
	$stnt->bindValue(5,'c');
	$stnt->bindValue(6,'c');
	$stnt->bindValue(7,'c');
	$stnt->bindValue(8,'c');
	$stnt->execute();
	
	if($stnt ===false){
		var_dump($stnt->errorInfo());
	}
  }
 }
?>

