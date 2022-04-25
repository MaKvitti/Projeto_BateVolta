<?php
    require('config/db.php');

    $objDB = new db();
    $linkConexao = $objDB->mysqlConnect();

    $querySelect = "SELECT precoKm, precoPeso, precoVolume, precoFixo FROM preco where idPreco = 1;";

    $runQuery = mysqli_query($linkConexao, $querySelect);

    $dados = null;
    $myArray = array();
    if ($runQuery){

        while($row = $runQuery->fetch_array(MYSQLI_ASSOC))
            $myArray[] = $row;
        

    }
    else {
        echo 'Falha ao buscar informações!';
    }
    
?>