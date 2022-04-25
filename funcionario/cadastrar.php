<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: ../index.php');
        exit();
    }
    elseif($_SESSION['cargos']=='gerente')
    {
        header('Location: ../gerente/template.php');
        exit();
    }
?>
<?php

    require('../config/db.php');
    $codRastreio = $_POST['codRastreio'];
    $peso = $_POST['peso'];
    $comprimento  =$_POST['comprimento'];
    $largura = $_POST['largura'];
    $altura = $_POST['altura'];
    $volume = $_POST['volume'];
    $valorEntrega = $_POST['valorEntrega'];
    $dataPostagem = $_POST['dataPostagem'];

    $idDest = $_POST['idEndereco2'];
    $idEndereco2 = explode("&", $idDest);
    $idDestinario = (int) $idEndereco2[0];

    $idSede = $_POST['idSede'];
    $idEndereco1 = explode("&", $idSede);
    $idRem = (int) $idEndereco1[0];

    $objDB = new db();
    $linkDeConexao = $objDB->mysqlConnect();

    $queryStatement  = $linkDeConexao->
    prepare("INSERT INTO encomendas(codRastreio,peso,comprimento,largura,altura,volume,valorEntrega,dataPostagem,FK_enderecoDestinatario,FK_enderecoSede, ativo)
                                        VALUES (?,?,?,?,?,?,?,?,?,?,?);");
    $ativo = true;
    //Arrumar o parametro
    $queryStatement->bind_param("sidddddsiis", $codRastreio,$peso,$comprimento,$largura,$altura,$volume,$valorEntrega,$dataPostagem,$idDestinario,$idRem,$ativo);
    $runQuery = $queryStatement->execute();
    $idEnco = mysqli_insert_id($linkDeConexao);

    if(!$runQuery)
    {
      session_destroy();
      echo '<script>window.alert("Erro ao executar query! "'.mysqli_error($linkDeConexao).');</script>'; 
    }else{
      $queryStatement  = $linkDeConexao->
      prepare("INSERT INTO rotas_encomendas(FK_encomendas,FK_rotas,status,FK_endereco,data)
                                          VALUES (?,?,?,?,?);");
      $idRota = null;
      $idStatus = "Objeto postado";
      //Arrumar o parametro
      $queryStatement->bind_param("iisis", $idEnco,$idRota,$idStatus,$idSede,$dataPostagem);
      $runQuery2 = $queryStatement->execute();
      
      //Verificar erro
      if($runQuery2){
        session_write_close();
        header("Location: cadastro.php");
        exit();
      }
      else
      {
        echo 'Erro ao cadastrar';
        echo '<script>window.alert("Erro ao executar query! "'.mysqli_error($linkDeConexao).');</script>';
      }
    }

   


?>
