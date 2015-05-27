<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <title>Trabalho Segurança</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="wrapper">
        <form enctype="multipart/form-data" action="index.php" method="post">
            <fieldset>
                <legend>Cifrar E Decifrar Vigenère</legend>
                 <div>
                    <textarea name="texto" placeholder="Texto a cifrar ou insira um ficheiro .txt abaixo"></textarea>
                    <input type="file" name="ficheiro" accept="txt"/>
                </div>  
                <div>
                    <input type="text" name="chave" placeholder="Chave da Cifra ou insira um ficheiro .txt abaixo"/>
                    <input type="file" name="ficheiroChave" accept="txt"/>
                </div>  
                <div class="small"><input type="radio" name="tipo" value="cifrar" checked>Cifrar</div>
                <div class="small"> <input type="radio" name="tipo" value="decifrar">Decifrar</div>
                <input type="submit" name="submite" value="Executar"/>
                <p>

<?php 
if (isset($_POST['submite']))
{   
    
    $tipo=$_POST['tipo'];//tipo do formulario
        
    
    //VARIAVEIS
    $controlador=0;
    $textoCifrado=" ";
    $textoChave=" ";
    if($_FILES['ficheiroChave']['name'] != "") 
    {
    
        //VERIFICA SE O FICHEIRO SO TEM TEXTO
        if(isset($_FILES) && $_FILES['ficheiroChave']['type'] != 'text/plain')
        {
            echo "<b><span>Ficheiro nao pode ser aceite ! Faça o upload de ficheiro com extensao '*.txt'.</span></b>";
            exit();
        }            
 
        //ARMAZENA TEMPORARIAMENTE O NOME DO FICHEIRO
        $fileName = $_FILES['ficheiroChave']['tmp_name'];
 
        //MENSAGEM DE ERRO SE NAO CONSEGUIR ABRIR
        $ficheir = fopen($fileName,"r") or exit("<b>Nao é possivel abrir!</b>");
        $linhas = count(file($fileName));
        $chave=" ";
        $i=0;
        if ($linhas==1)
        {
           while(!feof($ficheir)) 
            {
                $chave[$i]=fgetc($ficheir);
                $i++;
            }
        fclose($ficheir);
        }
          //TRATAMENTO VARIAVEL CHAVE se tiver no ficheiro
        $chave=strtoupper($chave);
        $tamChave=strlen($chave)-2;
    }//SE NAO TIVER FICHEIRO VAI BUSCAR A CHAVE AO FORMULARIO
    else
    {
        $chave=$_POST['chave'];//chave do formulario
          //TRATAMENTO VARIAVEL CHAVE se tiver no formulario
        $chave=strtoupper($chave);
        $tamChave=strlen($chave)-1;
    }
   

    $controlo=1;//variavel e ciclo para ver se a chave tem outros caracteres sem ser letras
 
    for ($i=0;$i<=$tamChave;$i++)
    {
        if ($controlo!=0)
        {
             echo $chave[$i];
            if (ord($chave[$i])>=65 and ord($chave[$i])<=90)
            {
                $controlo=1;
            }
            else
            {
                $controlo=0;
            }
        }
    }
   echo $controlo;
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
        //COLOCA NA VARIAVEL $TEXTO O TEXTO DO FICHEIRO
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
        echo " <div class='small'><b>Texto Original: </b>".$texto."</div>";
        echo "<div class='small'><b>Chave: </b>".$chave."</div>";
        echo "<div class='small'><b>Texto Decifrado: </b>".$textoCifrado."</div>";
        $ficheiro = fopen("TextoCifrado.txt", "w") or die("<div class='small'><b>Não foi possivel criar o ficheiro");
        fwrite($ficheiro, $textoCifrado);
        fclose($ficheiro);          
        echo "<br><a download href='TextoCifrado.txt'><img alt='Download Texto Cifrado' height='60' width='210' src='download.png'></a>" ;

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
        echo "<div class='small'><b>Texto Original: </b>".$texto."</div>";
        echo "<div class='small'><b>Chave: </b>".$chave."</div>";
        echo "<div class='small'><b>Texto Decifrado: </b>".$textoCifrado."</div>";  
        $ficheiro = fopen("TextoCifrado.txt", "w") or die("<div class='small'><b>Não foi possivel criar o ficheiro");
        fwrite($ficheiro, $textoCifrado);
        fclose($ficheiro);
        echo "<br><a download href='TextoCifrado.txt'><img alt='Download Texto Cifrado' height='60' width='210' src='download.png'></a>" ;

    }
}
else 
{
    echo "<b>A Chave só pode ter letras</b>";
}


}
?>

</p>
</fieldset> 
</form>
</div>
</body>
</html>
