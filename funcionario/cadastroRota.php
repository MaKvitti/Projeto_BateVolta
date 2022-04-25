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

  require ("../config/db.php");

    $objDb = new db();
    $link = $objDb->mysqlConnect();


    #buscando endereços
    $selectSedes = "SELECT sedes.idSede, sedes.nome, enderecos.cep FROM sedes INNER JOIN enderecos ON enderecos.idEndereco = sedes.FK_enderecos ORDER BY sedes.nome";
    $idSede = "idSede";
    $CEPsede= "cep";
    $sedeNome = "nome";

    $RSelectSedes = mysqli_query($link,$selectSedes);
    
    #buscando encomendas
    $selectEnc = "SELECT idEncomenda,codRastreio FROM encomendas WHERE ativo = true ORDER BY idEncomenda";
    $idEncomenda = "idEncomenda";
    $codRastreio = "codRastreio";
    $RSelectEncomendas = mysqli_query($link,$selectEnc);

    $selectFun = "SELECT idFuncionario,nome FROM funcionarios
                  WHERE cargo = 'funcionario' AND ativo = true
                  ORDER BY nome";
    $idFuncionario = "idFuncionario";
    $nomeFun = "nome";
    $RSelectFun = mysqli_query($link,$selectFun);


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
      <!-- Meta tags Obrigatórias -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
      
      <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../js/script.js"></script>
      <script src="../js/receberCotacao.js"></script>
      <script type="text/javascript" src="js/funcionario.js"></script>

      <title>Bate Volta | Logística</title>
      <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />
    </head>
<body>
  <header class="bg-info"> 
  </header>
  <div class="container">
    <div class="col-md">
      <br>
      <h4 class="mb-3">Cadastro de Rotas das Encomendas</h4>
      <br>
      <form class="needs-validation" action="cadastrarRota.php" method="post">
        <fieldset>
            <div class="col-sm-6">
                <a class="my-4">Encomenda</a><br>
                <?php while ($result = mysqli_fetch_array($RSelectEncomendas)) {?>

                  <input type="checkbox" name="check_list[]" value="<?php echo $result[$idEncomenda]?>">

                  <label for="check_list[]"><?php echo $result[$codRastreio]?></label><br>

                <?php }?>
              <br>
            </div>
            <div class="row g-5">
                <div class="col-sm-6">
                    <a class="my-4">Endereço Destino</a><br>
                    <select class="form-control" name="idSede" id="sede">
                            <option>Escolha...</option>
                            <?php while ($result = mysqli_fetch_array($RSelectSedes)) {?>
                                <option value="<?php echo $result[$idSede]?>"><?php echo $result[$sedeNome]?></option>
                            <?php }?>
                    </select>
                </div>

                <div class="col-sm-6">
                    <a class="my-4">Status</a><br>
                    <select class="form-control" name="idStatus" id="status">
                      <option>Escolha...</option>
                      <option value="Objeto em trânsito">Objeto em trânsito</option>
                      <option value="Objeto saiu para entrega">Objeto saiu para entrega</option>
                      <option value="Objeto entregue">Objeto entregue</option>
                    </select>
                </div>

                <div class="col-sm-6">
                    <a class="my-4">Funcionario</a><br>
                    <select class="form-control" name="idFuncionario" id="rota">
                            <option>Escolha...</option>
                            <?php while ($result = mysqli_fetch_array($RSelectFun)) {?>
                                <option value="<?php echo $result[$idFuncionario]?>"><?php echo $result[$nomeFun]?></option>
                            <?php }?>
                    </select>
                </div>

                <div class="col-sm-6">
                    <a class="my-4">Data Postagem</a><br>
                    <input class="form-control" type="datetime-local" name="dataPostagem"><br>
                </div>
            </div>
            <input class="w-100 btn btn-primary btn-info" type="submit" value="Cadastrar"><br><br>
        </fieldset>
      </form>
    </div>
  </div>
  <footer class="navbar-fixed-bottom text-white bg-info text-center">
  </footer>
</body>
</html>