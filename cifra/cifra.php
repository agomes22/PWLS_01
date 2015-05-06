<?php 
if (isset($_POST['submite']))
{	
	//VARIAVEIS FORMULARIO
	$texto=$_POST['texto'];
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
		
		if ($texto[$i]!=' ')
		{
			$textoChave[$i]=$chave[$controlador];
			$controlador++;
		}
		else
		{
			$textoChave[$i]=$texto[$i];
		}
	}
	
	if ($tipo="cifrar")
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
			
			if ($texto[$i]!=' ')
			{
				$textoCifrado[$i]=chr($total);
			}
		}
		echo "<b>Texto Cifrado: </b>".$textoCifrado;
	}
	else if ($tipo=="decifrar")
	{
		$intTexto=ord($texto[$i])-65;
		$intChave=ord($textoChave[$i])-65;
		$total=$intTexto-$intChave+26;
		echo $total;
		if ($total>25)
		{
			$total=$total-26;
		}
		$total=$total+65;
		
		if ($texto[$i]!=' ')
		{
			$textoCifrado[$i]=chr($total);
		}
	echo "<b>Texto Decifrado: </b>".$textoCifrado;
	}





	
}

?>