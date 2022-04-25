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

//Basicamente carrega a página de consulta e retorna o objeto json

require_once '../modules/consultas/consultaPrecos.php';

$json = json_encode($myArray);

echo $json;

?>