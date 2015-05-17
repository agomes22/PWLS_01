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
	<input type="submit" name="submite" value="Executar" />
	</br>
</form>


<?php 
if (isset($_POST['submite']))
{	
	$chave=$_POST['chave'];//chave do formulario
	$tipo=$_POST['tipo'];//tipo do formulario
		
	//COLOCAR EM MAISCULAS
	$chave=strtoupper($chave);
	
	//VARIAVEIS
	$tamChave=strlen($chave)-1;
	$controlador=0;
	$textoCifrado=" ";
	$textoChave=" ";
	
	$controlo=1;//variavel e ciclo para ver se a chave tem outros caracteres sem ser letras
	for ($i=0;$i<=$tamChave;$i++)
	{
		if ($controlo!=0)
		{
			if ($chave[$i]>=chr(65) and $chave[$i]<=chr(90))
			{
				$controlo=1;
			}
			else
			{
				$controlo=0;
			}
		}
	}
	if ($controlo==1)
	{
	 
	//SE TIVER FICHEIRO
	if($_FILES['ficheiro']['name'] != "") 
	{
	
		//VERIFICA SE O FICHEIRO SO TEM TEXTO
		if(isset($_FILES) && $_FILES['ficheiro']['type'] != 'text/plain')
		{
			echo "<b><span>Ficheiro nao pode ser aceite ! Faça o upload de ficheiro com extensao '*.txt'.</span></b>";
			exit();
		}			 
 
		//ARMAZENA TEMPORARIAMENTE O NOME DO FICHEIRO
		$fileName = $_FILES['ficheiro']['tmp_name'];
 
		//MENSAGEM DE ERRO SE NAO CONSEGUIR ABRIR
		$ficheir = fopen($fileName,"r") or exit("<b>Nao é possivel abrir!</b>");
  
		$texto=" ";
		$i=0;
		//COLOCA NA VARIAVEL TEXTO O TEXTO DO FICHEIRO
		while(!feof($ficheir)) 
		{
			$texto[$i]=fgetc($ficheir);
			$i++;
		}
		fclose($ficheir);
	}//SE NAO TIVER FICHEIRO VAI BUSCAR O TEXTO AO FORMULARIO
	else
	{
		$texto=$_POST['texto'];//texto do formulario
	}
	//TRATAMENTO VARIAVEL TEXTO
	$texto=strtoupper($texto);
	$tamTexto=strlen($texto)-1;
	
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
	//Se for para Cifrar
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
		echo "<b>Texto Original: </b>".$texto;
		echo "<br><b>Chave: </b>".$chave;
		echo "<br><b>Texto Decifrado: </b>".$textoCifrado;
		$ficheiro = fopen("TextoCifrado.txt", "w") or die("Não foi possivel criar o ficheiro");
		fwrite($ficheiro, $textoCifrado);
		fclose($ficheiro);
		echo "<a download href='TextoCifrado.txt'> download</a>";
		
	}//Se for para decifrar
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
		echo "<b>Texto Original: </b>".$texto;
		echo "<br><b>Chave: </b>".$chave;
		echo "<br><b>Texto Decifrado: </b>".$textoCifrado;	
		$ficheiro = fopen("TextoCifrado.txt", "w") or die("Não foi possivel criar o ficheiro");
		fwrite($ficheiro, $textoCifrado);
		fclose($ficheiro);
		echo "<br><a download href='TextoCifrado.txt'><img alt='Download Texto Cifrado' height='60' width='210' src='download.png'></a>" ;

		}
else 
{
	echo "<b>A Chave só pode ter letras</b>";
}
}
}
?>


</body>
</html>
