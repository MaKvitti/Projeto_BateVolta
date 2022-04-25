<?php
    /* Este código recebe as informações do HTML e usa a conexão para enviar
    dados para o banco. */

    require('../config/db.php'); 

    $fk_status = $_POST['FK_status'];
    $idRotaEncomenda = $_POST['idRotaEncomenda'];
    
    $objDB = new db();
    $linkDeConexao = $objDB->mysqlConnect();

    $queryUpdate = "UPDATE Rotas_Encomendas SET status = '$fk_status' WHERE idRotaEncomenda = '$idRotaEncomenda'";
    $runQuery = mysqli_query($linkDeConexao, $queryUpdate);

    if($runQuery)
         echo '<h1>Status da encomenda atualizado</h1>';



    else
    {
         echo '<h1>Erro ao atualizar o status da encomenda!</h1>'.mysqli_error($linkDeConexao);
    }
?>
    