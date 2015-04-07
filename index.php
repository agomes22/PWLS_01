<html>
<head></head>
<body>
<form action="index.php" method="POST">
Street: <input type="text" name="rua">
City: <input type="text" name="cidade">
Country: <input type="text" name="pais">
Name: <input type="text" name="nome">
Raido de Pesquisa <input type="text" name="raio">
<input type="submit" name="submeter">
</form>

</body>
</html>

<?php
//key = AIzaSyAN0fFPOx-3IhMk05pz0_qAVyz5cijvqc4
//url places = https://maps.googleapis.com/maps/api/place/nearbysearch/output?parameters
//exemplo places = https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&types=food&name=cruise&key=AddYourOwnKeyHere
//url geocoding = https://maps.googleapis.com/maps/api/geocode/output?parameters
//exemplo geocoding = https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=API_KEY



//busca dos valores do formulario
$street=$_POST['rua'];
$city=$_POST['cidade'];
$name=$_POST['nome'];
$country=$_POST['pais'];
$radius=$_POST['raio'];
//-------------------------------

$key="AIzaSyAN0fFPOx-3IhMk05pz0_qAVyz5cijvqc4";		//chave

//converte a rua em array
$arrayr=explode(' ',$street);
$nr=count($arrayr);
$street=$arrayr[0];
//-----------------------

//trata a rua, mete os mais e a , no fim
for($i=1;$i<=$nr;$i++)
{
	if($i==$nr)
	{
		$street=$street.",";
	}
	else
	{
		$street=$street."+".$arrayr[$i];
	}
}
//--------------------------------------

//converte o pais em array
$arrayc=explode(' ',$country);
echo "</br>pais-".$country."</br>";
$nc=count($arrayc);
echo "</br>contador do pais-".$nc."</br>";
$country=$arrayc[0];
//-----------------------

//trata o pais, mete os mais 
if($nc!=1){
for($i=1;$i<$nc;$i++)
{
		$country=$country."+".$arrayc[$i];
}
}
//--------------------------------------

//converte cidade em array
$arrayc=explode(' ',$city);
$nc=count($arrayc);
$city=$arrayc[0];
//-----------------------

//trata a cidade, mete os mais e a , no fim
for($i=1;$i<=$nc;$i++)
{
	if($i==$nc)
	{
		$city=$city.",";
	}
	else
	{
		$city=$city."+".$arrayc[$i];
	}
}
//--------------------------------------

$address=$street.$city.$country;		//define a variavel address como a junção da rua + cidade + pais
echo $address;


//vais buscar as cordenadas da morada ------------------------------------------------------
$urlg="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=".$key."";		
$contents=file_get_contents($urlg);
$json=json_decode($contents);
foreach ($json->results as $value)
{
$lat=$value->geometry->location->lat;		//define a variavel lat como a latitude do local
echo"$lat</br>";
$lng=$value->geometry->location->lng;		//define a variavel lng como a longitude do local
echo"$lng</br>";
}
//-------------------------------------------------------------------------------------------
//urlg = url do api do geocoding
echo "$urlg</br>";		//teste do url
$address=$lat.",".$lng;			//define a variavel address como a junção das cordenadas separadas por ,
echo $address;		//teste da variavel address


//vai buscar os lugares á volta da morada de um raio definido e que contenha o que é pedido no nome
$urlp="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$address."&radius=".$radius."&name=".$name."&key=".$key."";
//--------------------------------------------------------------------------------------------------

//urlp = url do api do places
echo $urlp;		//teste do url



?>