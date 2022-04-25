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

<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <!-- Meta tags Obrigatórias -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="../css/styleStatus.css"/>
      
      <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" src="js/funcionariosDisponiveis.js"></script>
      <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/gerente.js"></script>

      <title>Bate Volta | Logística</title>
      <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />
  </head>
  <body>
  <header class="bg-info"> 
  </header>
  <div>
    <br>
    <div class="container">
      <div class="form-row">
        <div class="form-group col-lg-6">
          <label>Sede</label>
          <select id="sede" name="sede" class="form-control">
            <option></option>
          </select>
        </div>
      </div>  
    </div>
    <div class="container mt-3" id="msgConsulta"></div>
    <div class="container mt-3" id="tabelaConsulta"></div>
  </div>
    <footer style="position: fixed; bottom: 0; width: 100%;" class="navbar-fixed-bottom text-white bg-info text-center">
    </footer>
  </body>
</html>