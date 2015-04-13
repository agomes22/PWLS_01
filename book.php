<html>
<head>
<meta charset="UTF-8">
<style>
#corpo{
background-image:url(https://d1zqayhc1yz6oo.cloudfront.net/s/feel_resources/modern2/backgrounds/images/zzz-legacy-wood.jpg?_v=2);
}
#divi
{
	color:bloack;
	height:500px;
	width:485px;
	border:1px solid;
	border-radius:5px;
	float:left;
	margin:15px;
}
#texto
{
	float:left; 
	margin-left:15px;
	margin-top:15px;
	height: 320px;
	width: 220px;
}
#desc
{
	float:left; 
	margin-left:15px; 
	margin-right:15px;
	margin-top:15px; 
	height: 135px; 
	width: 455px;
}
#topo
{
height:50px;
width:100%;
border:1px solid;
border-radius:5px;
}

</style>
</head>
<body id="corpo">

<form action="main.php" method="POST">
<div id="topo">
<p>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAuthor: <input type="text" name="author">
&nbsp&nbsp&nbsp&nbsp&nbspAnything: <input type="text" name="anything">
&nbsp&nbsp&nbsp&nbsp&nbspISBN: <input type="text" name="isbn">
&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Submit">
</p>
</div>
</form>

</body>

</html>
<?php
if(!empty($_POST['author'])||!empty($_POST['isbn'])||!empty($_POST['anything']))
{
$author="";
if(!empty($_POST['author']))
{
$author="+inauthor:".$_POST['author'];
}
$isbn="";
if(!empty($_POST['isbn']))
{
$isbn="+isbn:".$_POST['isbn'];
}
@$anything=$_POST['anything'];
@$key="AIzaSyAN0fFPOx-3IhMk05pz0_qAVyz5cijvqc4";
$author=urlencode($author);
$anything=urlencode($anything);
$isbn=urlencode($isbn);
$start=0;
for ($i = 0;$i < 2;$i++){
$url = "https://www.googleapis.com/books/v1/volumes?q=".$anything.$author.$isbn."&key=".$key."&fields=items(volumeInfo(title,authors,pageCount,description,publisher,publishedDate,industryIdentifiers(type,identifier),imageLinks(smallThumbnail)))&prettyprint=true&maxResults=40&startIndex=".$start."";
echo $url;
$contents=file_get_contents($url);
$json=json_decode($contents);
foreach ($json->items as $value)
		{
			echo'<div id="divi">';		//abre a div principal
			
			//imagens
			if(isset($value->volumeInfo->imageLinks)){
			foreach($value->volumeInfo->imageLinks as $linkImagem)
			{
			echo "<div style='float:left; background-image: url(".$linkImagem."); background-size:100%; background-repeat:no-repeat; margin-left:15px; margin-top:15px; height: 320px; width: 220px;'></div>";
			}
			}
			else{
			echo "<div style='float:left; background-image: url(http://vertex-uae.com/images/no-image-found.jpg); background-size:100%; background-repeat:no-repeat; margin-left:15px; margin-top:15px; height: 320px; width: 220px;'></div>";
			}
			
			
			echo'<div id="texto">';		//abre a div das informações
			
			echo "</br></br><b>Title: </b><i>".$value->volumeInfo->title."</i> <br>";		//titulo
			
			if(!empty($value->volumeInfo->authors))		//autores
			{
			foreach($value->volumeInfo->authors as $name)
			{
			echo "<b>Author: </b><i>".$name."</i><br> ";
			}
			}
			
			
			//numero de paginas
			if(!empty($value->volumeInfo->pageCount)){
			echo "<b>Page Count: </b><i>".$value->volumeInfo->pageCount."</i><br> ";
			}
			
			//editora
			if(!empty($value->volumeInfo->publisher)){
			echo "<b>Publisher: </b><i>".$value->volumeInfo->publisher."</i><br> ";
			}
			
			//data de lançamento 
			if(!empty($value->volumeInfo->publishedDate)){
			echo "<b>Published Date: </b><i>".$value->volumeInfo->publishedDate."</i><br> ";
			}
			
			
			//isbn
			if(!empty($value->volumeInfo->industryIdentifiers))
			{
			foreach($value->volumeInfo->industryIdentifiers as $isbn_1)
			{
			if ($isbn_1->type=='ISBN_10')
			{
			echo "<b>ISBN: </b><i>".$isbn_1->identifier."</i><br> ";
			}
			}
			}
		
			echo'</div>';	//feicha a div com as informações
			
			echo'<div id="desc">';		//descrição
			
			if(isset($value->volumeInfo->description)){
			echo "<b>Description: </b>";
			echo'<textarea rows="6" cols="59" readonly>'.$value->volumeInfo->description.'</textarea>';
			}
			else{
			echo "<b>No description available </b>";
			}
						
			echo'</div>';    //feixa a div com a descrição
			
			echo'</div>';    //feixa a div principal
}
$start=$start+20;
}
}
?>