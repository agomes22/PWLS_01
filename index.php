<html>
<head></head>
<body>
<form action="index.php" method="POST">
Street: <input type="text" name="rua">
City: <input type="text" name="cidade">
Country: <input type="text" name="pais">
Name: <input type="text" name="nome">
<select name="raio">
	<option value="5000">Raio de Distancia</option>
	<option value="5000">5 Km</option>
	<option value="15000">15 Km</option>
	<option value="50000">50 Km</option>
	<option value="100000">1000 Km</option>


</select>
<select name="tipo">
		<option value="">Tipo</option>
        <option value="airport">Aeroporto</option>
		<option value="aquarium">Aquario</option>
		<option value="art_gallery">Galeria de Arte</option>
		<option value="atm">Caixa Multibanco</option>
		<option value="bakery">Padaria</option>
		<option value="bank">Banco</option>
		<option value="bar">Bar</option>
		<option value="bicycle_store">Loja de Bicicletas</option>
		<option value="book_store">Loja de Livros</option>
		<option value="bus_station">Paragen de Autocarros</option>
		<option value="cafe">Cafe</option>
		<option value="car_dealer">Vendedor de Carros</option>
		<option value="car_rental">Aluguer de Carros</option>
		<option value="car_repair">Oficina</option>
		<option value="casino">Casino</option>
		<option value="cemetery">Cemiterio</option>
		<option value="church">Igreja</option>
		<option value="city_hall">Camara Municipal</option>
		<option value="clothing_store">Loja de roupa</option>
		<option value="dentist">Dentista</option>
		<option value="doctor">Doutor</option>
		<option value="electronics_store">Loja de Eletrodomesticos</option>
		<option value="finance">Finanças</option>
		<option value="fire_station">Bombeiros</option>
		<option value="florist">Florista</option>
		<option value="food">Comida</option>
		<option value="gas_station">Bomba de Gasolina</option>
		<option value="grocery_or_supermarket">Supermercado</option>
		<option value="gym">Ginasio</option>
		<option value="hardware_store">Loja de hardware</option>
		<option value="health">Saude</option>
		<option value="Hospital">Hospital</option>
		<option value="insurance_agency">Agencia de Seguros</option>
		<option value="jewelry_store">Ourivesaria</option>
		<option value="meal_takeaway">Takeaway</option>
		<option value="movie_theater">Cinema</option>
		<option value="moving_company">Mudanças</option>
		<option value="museum">Museu</option>
		<option value="night_club">Discoteca</option>
		<option value="park">Parque</option>
		<option value="pet_store">Loja de animais</option>
		<option value="pharmacy">Farmacia</option>
		<option value="police">Policia</option>
		<option value="post_office">Correios</option>
		<option value="real_estate_agency">Agencia Imobiliaria</option>
		<option value="restaurant">Restaurante</option>
		<option value="school">Escola</option>
		<option value="shoe_store">Sapataria</option>
		<option value="shopping_mall">Shopping</option>
		<option value="stadium">Estadio</option>
		<option value="store">Loja</option>
		<option value="subway_station">Metro</option>
		<option value="train_station">Comboio</option>
		<option value="travel_agency">Agencia de viagem</option>
		<option value="university">Universidade</option>
		<option value="zoo">Zoo</option>
		
		
    </select>
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
$type=$_POST['tipo'];
//-------------------------------
echo $type;
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

$nc=count($arrayc);

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



//vais buscar as cordenadas da morada ------------------------------------------------------
$urlg="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=".$key."";		
$contents=file_get_contents($urlg);
$json=json_decode($contents);
foreach ($json->results as $value)
{
$lat=$value->geometry->location->lat;		//define a variavel lat como a latitude do local

$lng=$value->geometry->location->lng;		//define a variavel lng como a longitude do local

}
//-------------------------------------------------------------------------------------------
//urlg = url do api do geocoding
echo "$urlg</br>";		//teste do url
$address=$lat.",".$lng;			//define a variavel address como a junção das cordenadas separadas por ,
echo $address;		//teste da variavel address


//vai buscar os lugares á volta da morada de um raio definido e que contenha o que é pedido no nome
$urlp="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$address."&radius=".$radius."&name=".$name."&type=".$type."&key=".$key."";
//--------------------------------------------------------------------------------------------------

//urlp = url do api do places
echo $urlp;		//teste do url

$contents=file_get_contents($urlp);
$json=json_decode($contents);
foreach ($json->results as $value)
{
	if(isset($value->name)){
			
			echo $value->name;

			}
	
	
		if(isset($value->types)){
				foreach ($values->types as $typess){
				echo $typess;}
				}
		
	
	if(isset($values->opening_hours->open_now)){
		echo $values->opening_hours->open_now;
	
	}
}

?>