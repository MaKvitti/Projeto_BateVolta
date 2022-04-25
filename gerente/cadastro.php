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

  require ("../config/db.php");

    $objDb = new db();
    $link = $objDb->mysqlConnect();

    $selectSedes = "SELECT sedes.idSede, sedes.nome, enderecos.cep, enderecos.cidade, enderecos.estado FROM sedes INNER JOIN enderecos ON enderecos.idEndereco = sedes.FK_enderecos ORDER BY sedes.nome";
    $idSede = "idSede";
    $NomeSede= "nome";
    $CEPSede = "cep";
    $sedeCidade = "cidade";
    $sedeEstado = "estado";

    $RSelectSedes = mysqli_query($link,$selectSedes);

    $selectEnd = "SELECT sedes.idSede, sedes.nome, enderecos.cep, enderecos.cidade, enderecos.estado FROM sedes INNER JOIN enderecos ON enderecos.idEndereco = sedes.FK_enderecos ORDER BY sedes.nome";
    $idEndereco = "idSede";
    $CEP= "cep";
    $Nome = "nome";
    $cidade = "cidade";
    $estado = "estado";

    $RSelectEnd2 = mysqli_query($link,$selectEnd);
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
      <script type="text/javascript" src="js/gerente.js"></script>

      <title>Bate Volta | Logística</title>
      <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />
    </head>
<body>
  <header class="bg-info"> 
  </header>
  <div class="container">
    <div class="col-md">
      <br>
      <h4 class="mb-3">Cadastro de Encomendas</h4>
      <br>
      <form class="needs-validation" action="cadastrar.php" method="post">
        <fieldset>
          <div class="row g-5">

            <div class="col-sm-6">
              <a class="my-4">Codigo de Rastreio:</a><br>
              <input class="form-control" placeholder="--------------" type="text" name="codRastreio"><br>
            </div>

            <div class="col-sm-6">
              <a class="my-4">Peso:</a><br>
              <input class="form-control" placeholder="--------------" type="text" name="peso" id="peso"><br>
            </div>

            <div class="col-sm-6">
              <a class="my-4">Comprimento:</a><br>
              <input class="form-control" placeholder="--------------" type="text" name="comprimento" id="comprimento"><br>
            </div>

            <div class="col-sm-6">
              <a class="my-4">Largura:</a><br>
              <input class="form-control" placeholder="--------------" type="text" name="largura" id="largura"><br>
            </div>

            <div class="col-sm-6">
              <a class="my-4">Altura:</a><br>
              <input class="form-control" placeholder="--------------" type="text" name="altura" id="altura"><br>
            </div>
            <div class="col-sm-6">
              <a class="my-4">Volume:</a><br>
              <input class="form-control" placeholder="--------------" type="text" name="volume" id="volume"><br>
            </div>
          </div>
                  <!-- Calculo do frete
                      Fazer form separado-->
          <div class="row g-5">
            <div class="col-sm-9">
              <a class="my-4">Valor Entrega:</a><br>
              <input class="form-control" placeholder="--------------" type="text" name="valorEntrega" id="cotacao"><br>
            </div>

            <div class="col-sm-3">
              <br>
              <button class="w-50 btn btn-primary btn-info" id="button_calcular">Calcular</button><br>
            </div>

          </div>

          <a class="my-4">Data Postagem:</a><br>
          <input class="form-control" type="datetime-local" name="dataPostagem"><br>

          <!--Mexer nas abas -->
          <div class="">
            <a class="my-4">Endereço de Destino:</a><br>
            <select class="form-control" name="idEndereco2" id="destino">
              <option>Escolha...</option>
              <?php while ($result = mysqli_fetch_array($RSelectEnd2)) {?>
                <option value="<?php echo $result[$idEndereco].'&'.$result[$CEP]?>"><?php  echo $result[$Nome].", ".$result[$cidade]." - ".$result[$estado]?></option>
              <?php }?>
            </select><br>
          </div>

          <div class="">
            <a class="my-4">Endereço da Sede:</a><br>
              <select class="form-control" name="idSede" id="remetente">
                      <option>Escolha...</option>
                      <?php while ($result = mysqli_fetch_array($RSelectSedes)) {?>
                        <option value="<?php echo $result[$idSede].'&'.$result[$CEPSede]?>"><?php echo $result[$NomeSede].", ".$result[$sedeCidade]." - ".$result[$sedeEstado]?></option>
                      <?php }?>
              </select>
          </div><br>
          <input class="w-100 btn btn-primary btn-info" type="submit" value="Cadastrar"><br><br>
        </fieldset>
      </form>
    </div>
  </div>

  <footer class="navbar-fixed-bottom text-white bg-info text-center">
  </footer>
</body>
</html>
