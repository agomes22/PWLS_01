<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<form enctype="multipart/form-data" action="index.php" method="post">

	<textarea name="texto" cols="40" rows="5"></textarea>ou
	<input type="file" name="ficheiro" accept="txt"/></br>
	Chave<input type="text" name="chave"required/></br>
	Cifrar<input type="radio" name="tipo" value="cifrar" checked></br>
	Decifrar<input type="radio" name="tipo" value="decifrar"></br>
	<input type="submit" name="submite" value="Executar"/>
	</br>
</form>

</body>
</html>

<?php 
if (isset($_POST['submite']))
{	
	if($_FILES['ficheiro']['name'] != "") 
	{
	
		//VERIFICA SE O FICHEIRO SO TEM TEXTO
	if(isset($_FILES) && $_FILES['ficheiro']['type'] != 'text/plain')
	{
		echo "<span>Ficheiro nao pode ser aceite ! Faça o upload de ficheiro com extensao '*.txt'.</span>";
		exit();
	}		 
 
	//ARMAZENA TEMPORARIAMENTE O NOME DO FICHEIRO
	$fileName = $_FILES['ficheiro']['tmp_name'];
 
	//MENSAGEM DE ERRO SE NAO CONSEGUIR ABRIR
	$ficheir = fopen($fileName,"r") or exit("Nao é possivel abrir!");
  
	$texto=" ";
	$i=0;
	//COLOCA NA VARIAVEL TEXTO O TEXTO DO FICHEIRO
	while(!feof($ficheir)) {
	$texto[$i]=fgetc($ficheir);
	$i++;
	}
	fclose($ficheir);
	}
	else
	{
		//VARIAVEIS FORMULARIO
		$texto=$_POST['texto'];
	}
	
	$chave=$_POST['chave'];
	$tipo=$_POST['tipo'];
		
	//COLOCAR EM MAISCULAS
	$texto=strtoupper($texto);
	$chave=strtoupper($chave);
	
	//VARIAVEIS
	$tamTexto=strlen($texto)-1;
	$tamChave=strlen($chave)-1;
	$controlador=0;
	$textoCifrado=" ";
	$textoChave=" ";
	
	//CICLO PARA COLOCAR A CHAVE NO TAMANHO DO TEXTO
	for ($i=0;$i<=$tamTexto;$i++)
	{
		if ($controlador>$tamChave)
		{
			$controlador=0;
		}
		
		if ($texto[$i]>=chr(65) and $texto[$i]<=chr(90))
		{
			$textoChave[$i]=$chave[$controlador];
			$controlador++;
			
		}
		else
		{
			$textoChave[$i]=$texto[$i];	
		}
	}
	
	if ($tipo=="cifrar")
	{		
		for ($i=0;$i<=$tamTexto;$i++)
		{
			$intTexto=ord($texto[$i])-65;
			$intChave=ord($textoChave[$i])-65;
			$total=$intTexto+$intChave;
			
			if ($total>25)
			{
				$total=$total-26;
			}
			$total=$total+65;
			
			if ($texto[$i]>=chr(65) and $texto[$i]<=chr(90))
			{
				$textoCifrado[$i]=chr($total);
			}
			else
			{
				$textoCifrado[$i]=$texto[$i];	
			}
		}
		echo "<b>Texto Cifrado: </b>".$textoCifrado;
	}
	else if ($tipo=="decifrar")
	{
		for ($i=0;$i<=$tamTexto;$i++)
		{
			$intTexto=ord($texto[$i])-65;
			$intChave=ord($textoChave[$i])-65;
			$total=$intTexto-$intChave+26;
			if ($total>25)
			{
				$total=$total-26;
			}
			$total=$total+65;
			
			if ($texto[$i]>=chr(65) and $texto[$i]<=chr(90))
			{
				$textoCifrado[$i]=chr($total);
			}
		}
		echo "<b>Texto Decifrado: </b>".$textoCifrado;
	}	
}

?>
