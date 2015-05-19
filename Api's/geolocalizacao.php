<html>
<!-- 
Devido ao facto de não ter conseguido arranjar nenhuma API de filmes de confiança, decidi fazer o trabalho de maneira diferente
Este trabalho consiste em, em redor do utilizador, num raio defenido por ele, encontrar os locais que ele quer, por exemplo:
Encontrar farmacias, num raio de 5km, que estejam abertas agora ou um restaurante, num raio de 2kn etc...
Estou de momento a utilizar 2 APIs para o projecto mas queria implementar mais uma que premitice ao utilizador clicar num botão e obter a sua localização em vez de estar a escrever uma morada
Eu não consegui arranjar nenhuma API para descobrir a localização do utilizador
O google tem uma mas não a consigo usar, diz que o numero de vezes que a posso usar é 0 e ao tentar usar dá error
Optei então por este código em JavaScript
-->
<head>
<meta charset="UTF-8">
</head>
<body>
<p><button onclick="geoFindMe()">Show my location</button></p>
<div id="out"></div>
</body>
<script>
//A função que descobre a localização
function geoFindMe() {
  var output = document.getElementById("out");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
    return;
  }

  function success(position) {
    var latitude  = position.coords.latitude;//as variaveis que eu quero
    var longitude = position.coords.longitude;//as variaveis que eu quero

    output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';

    
    output.appendChild(img);
  };

  function error() {
    output.innerHTML = "Unable to retrieve your location";
  };

  output.innerHTML = "<p>Locating…</p>";

  navigator.geolocation.getCurrentPosition(success, error);
}
//A seguinte função que está em comentário é a maneira que eu encontrei para me enviar os dados para o php mas não está a funcionar
/*
function myJavascriptFunction() { 
  var javascriptVariable = latitude;
  window.location.href = "main.php?name=" + javascriptVariable; 
  
}*/
</script>
</html>

<?php
//Aqui supostamente iria buscar a variavel através do metodo GET
/*
$loc=$_GET['name'];
echo $loc;
*/
?>