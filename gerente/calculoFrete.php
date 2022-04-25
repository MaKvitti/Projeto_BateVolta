<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: ../index.php');
        exit();
    }
    elseif($_SESSION['cargos']=='funcionario')
    {
        header('Location: ../funcionario/templateFun.php');
        exit();
    }
?>
<?php

require_once '../config/config.php';
require_once '../modules/APIs/dm_api.php';
require '../modules/consultas/consultaPrecos.php';

//API para calculo de distancia
$DM_API = new G_API(Google_DM_API_KEY); //Criando um objeto API e passando a Chave de restrição da api

//Recebendo as entradas do usuário via POST
$peso = $_POST['peso'];
$comprimento  =$_POST['comprimento'];
$largura = $_POST['largura'];
$altura = $_POST['altura'];

$origem = $_POST['cep1'];
$destino = $_POST['cep2'];



//calculando o volume
$volume = $comprimento * $largura * $altura;



$distance = $DM_API->distance_calc('cep '. $origem, 'cep '.$destino);

//$myArray = Consulta dos precos no banco pelo arquivo consultaPrecos.php
//ESTRUTURA: array(array(["precoKm"], ["precoPeso"], ["precoVolume"], ["precoFixo"]))

//Separando as variáveis
$precoKm = $myArray[0]["precoKm"];
$precoPeso = $myArray[0]["precoPeso"];
$precoVolume = $myArray[0]["precoVolume"];
$precoFixo = $myArray[0]["precoFixo"];

$custoFrete = ($precoKm * $distance / 1000) + ($precoPeso * $peso) + ($precoVolume * $volume) + ($precoFixo); //Calculando o custo

$results = array(
            "volume" => $volume,          
            "cotacao" => $custoFrete
        );

echo json_encode($results);

?>