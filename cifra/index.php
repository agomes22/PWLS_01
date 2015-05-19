<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html>
<head>
    <meta charset="UTF-8">
    <title>Trabalho Segurança</title>
</head>
<style type="text/css">
    #wrapper {
        width:450px;
        margin:0 auto;
        font-family:Verdana, sans-serif;
    }
    legend {
        color:#0481b1;
        font-size:16px;
        padding:0 10px;
        background:#fff;
        -moz-border-radius:4px;
        box-shadow: 0 1px 5px rgba(4, 129, 177, 0.5);
        padding:5px 10px;
        text-transform:uppercase;
        font-family:Helvetica, sans-serif;
        font-weight:bold;
    }
    fieldset {
        border-radius:4px;
        background: #fff; 
        background: -moz-linear-gradient(#fff, #f9fdff);
        background: -o-linear-gradient(#fff, #f9fdff);
        background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fff), to(#f9fdff)); /
        background: -webkit-linear-gradient(#fff, #f9fdff);
        padding:20px;
        border-color:rgba(4, 129, 177, 0.4);
    }
    input,
    textarea {
        color: #373737;
        background: #fff;
        border: 1px solid #CCCCCC;
        color: #aaa;
        font-size: 14px;
        line-height: 1.2em;
        margin-bottom:15px;

        -moz-border-radius:4px;
        -webkit-border-radius:4px;
        border-radius:4px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset, 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    input[type="text"],
    input[type="password"]{
        padding: 8px 6px;
        height: 22px;
        width:280px;
    }
    input[type="text"]:focus,
    input[type="password"]:focus {
        background:#f5fcfe;
        text-indent: 0;
        z-index: 1;
        color: #373737;
        -webkit-transition-duration: 400ms;
        -webkit-transition-property: width, background;
        -webkit-transition-timing-function: ease;
        -moz-transition-duration: 400ms;
        -moz-transition-property: width, background;
        -moz-transition-timing-function: ease;
        -o-transition-duration: 400ms;
        -o-transition-property: width, background;
        -o-transition-timing-function: ease;
        width: 380px;
        
        border-color:#ccc;
        box-shadow:0 0 5px rgba(4, 129, 177, 0.5);
        opacity:0.6;
    }
    input[type="submit"]{
        background: #222;
        border: none;
        text-shadow: 0 -1px 0 rgba(0,0,0,0.3);
        text-transform:uppercase;
        color: #eee;
        cursor: pointer;
        font-size: 15px;
        margin: 5px 0;
        padding: 5px 22px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-border-radius:4px;
        -webkit-box-shadow: 0px 1px 2px rgba(0,0,0,0.3);
        -moz-box-shadow: 0px 1px 2px rgba(0,0,0,0.3);
        box-shadow: 0px 1px 2px rgba(0,0,0,0.3);
    }
    textarea {
        padding:3px;
        width:96%;
        height:100px;
    }
    textarea:focus {
        background:#ebf8fd;
        text-indent: 0;
        z-index: 1;
        color: #373737;
        opacity:0.6;
        box-shadow:0 0 5px rgba(4, 129, 177, 0.5);
        border-color:#ccc;
    }
    .small {
        line-height:14px;
        font-size:16px;
        color:#999898;
        margin-bottom:3px;
    }
</style>

<body>
    <div id="wrapper">
        <form enctype="multipart/form-data" action="index.php" method="post">
            <fieldset>
                <legend>Cifrar E Decifrar</legend>
                 <div>
                    <textarea name="texto" placeholder="Texto a cifrar ou insira um ficheiro .txt abaixo"></textarea>
                    <input type="file" name="ficheiro" accept="txt"/>
                </div>  
                <div>
                    <input type="text" name="chave" placeholder="Chave da Cifra" required/>
                </div>  
                <div class="small"><input type="radio" name="tipo" value="cifrar" checked>Cifrar</div>
                <div class="small"> <input type="radio" name="tipo" value="decifrar">Decifrar</div>
                <input type="submit" name="submite" value="Executar"/>
                <p>

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
else 
{
    echo "<b>A Chave só pode ter letras</b>";
}
}
}
?>

</p>
</fieldset> 
</form>
</div>
</body>
</html>
