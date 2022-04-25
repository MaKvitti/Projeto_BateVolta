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

    require('../config/db.php'); 

    
    $precoKM = $_POST['km'];
    $precoPeso  =$_POST['peso'];
    $precoVolume = $_POST['volume'];
    $precoFixo = $_POST['fixo'];


    $objDB = new db();
    $linkDeConexao = $objDB->mysqlConnect();

    //Neste caso essa tabela só possui 1 registro que são os valores a serem cobrados
    $queryStatement  = $linkDeConexao->prepare("UPDATE preco set precoKM = ?, precoPeso = ?, precoVolume = ?, precoFixo =? 
                                                WHERE idPreco = 1"); //Query para atualzar os valores

 
    $queryStatement->bind_param("dddd", $precoKM, $precoPeso,$precoVolume, $precoFixo);

    //Agora estamos de fato mandando a query para o SGBD
    $runQuery = $queryStatement->execute();

    //Status da atualização
    if($runQuery){
        session_write_close();
        include "atualizarPrecos.php";
        echo "<script> window.alert('Operação concluida com sucesso!') </script>"; 
        echo "<meta http-equiv='refresh' content='1;URL=atualizarPrecos.php'>";
    }
    else
    {
        session_write_close();
        include "atualizarPrecos.php";
        echo "<script> alert('ERRO - Não foi possível realizar a operação, tente novamente!') </script>";  
        echo "<meta http-equiv='refresh' content='2;URL=atualizarPrecos.php'>";
    }

    
?>
