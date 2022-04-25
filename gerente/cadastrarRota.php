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

  $idSede = $_POST['idSede'];
  $idStatus = $_POST['idStatus'];
  $idFuncionario = $_POST['idFuncionario'];
  $dataPostagem = $_POST['dataPostagem'];
  $vet = $_POST['check_list'];

  $objDB = new db();
  $linkDeConexao = $objDB->mysqlConnect();

  $queryRotas = $linkDeConexao ->prepare("INSERT INTO rotas(FK_funcionario,data) VALUES($idFuncionario,'$dataPostagem');");
  $runQueryRotas = $queryRotas->execute();

  $idrota = mysqli_insert_id($linkDeConexao);

  $queryUpdateFuncionario = $linkDeConexao ->prepare("UPDATE funcionarios SET ativo = false WHERE idFuncionario = $idFuncionario;");
  $runUpdateFuncionario = $queryUpdateFuncionario->execute();
  
  $queryVerificacao  = $linkDeConexao->
  prepare("SELECT FK_encomendas FROM rotas_encomendas WHERE FK_encomendas= ?;");
  
  $queryVerificacao->bind_param("i", $idEnco);

  $runQueryEncomenda = $queryVerificacao->execute();

  $result = $queryVerificacao->get_result();



  if($runQueryEncomenda)
  {
    if($row = $result->fetch_array(MYSQLI_ASSOC))
    {
      if($row['FK_encomendas']==$idEnco){
        echo "<script> window.alert('Encomenda ja cadastrada!') </script>"; 
        echo "<meta http-equiv='refresh' content='1;URL=cadastroRota.php'>";
        exit();
      }
      else
      {
        foreach($vet as $encomenda)
        {
          $encomenda = (int) $encomenda;
          cadastrar($linkDeConexao,$encomenda,$idrota,$idStatus,$idSede,$dataPostagem);
        }     
      }
    }
    else
    {
      foreach($vet as $encomenda)
      {
        $encomenda = (int) $encomenda;
        cadastrar($linkDeConexao,$encomenda,$idrota,$idStatus,$idSede,$dataPostagem);
      }
    }

  }
  else
  {
    session_destroy();
    echo '<script>window.alert("Erro ao executar query! "'.mysqli_error($linkDeConexao).');</script>'; 
  }
?>

<?php
  function cadastrar($linkDeConexao,$idEnco,$idRota,$idStatus,$idSede,$dataPostagem)
  {
    $queryStatement  = $linkDeConexao->
    prepare("INSERT INTO rotas_encomendas(FK_encomendas,FK_rotas,status,FK_endereco,data)
                                        VALUES (?,?,?,?,?);");
  
    //Arrumar o parametro
    $queryStatement->bind_param("iisis", $idEnco,$idRota,$idStatus,$idSede,$dataPostagem);
    $runQuery = $queryStatement->execute();

    $queryUpdateEncomenda = $linkDeConexao ->prepare("UPDATE encomendas SET ativo = false WHERE idEncomenda = $idEnco;");
    $runUpdateEncomenda = $queryUpdateEncomenda->execute();
    
    if($runQuery && $runUpdateEncomenda){
      session_write_close();
      echo "<script> window.alert('Rota encomenda cadastrada com sucesso!') </script>";
      echo "<meta http-equiv='refresh' content='1;URL=cadastroRota.php'>";
      exit();
    }
    else
    {
      session_write_close();
      echo "<script> window.alert('Erro ao cadastrar, Campos nulos identificados!') </script>";
      echo "<meta http-equiv='refresh' content='1;URL=cadastroRota.php'>";
    }
  }
?>
