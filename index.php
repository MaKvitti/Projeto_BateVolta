<?php
    session_start();
    if(isset($_SESSION['id'])){
      if($_SESSION['cargos']=='gerente'){

        header("Location: gerente/template.php");
        exit();
      }
      elseif($_SESSION['cargos']=='funcionario'){
        
        header("Location: funcionario/templateFun.php");
        exit();
      }

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="src/icon.ico">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/styles.css" rel="stylesheet">
      <script src="js/script.js"></script>
      <title>Bate Volta</title>
      
  </head>

  <body class="text-center bg-info">
    
    <div class = "container">
    <a style = "padding:15px;color:#fff;text-decoration:none; font-size:40px;position: absolute;left :0; top:0;" href="index.html"> < </a>
    <form class="form-signin" action="login.php" method="POST" target="_self">
        
        <img class="mb-4" src="src/logo.png" alt="Logo" width="100%" >
        <h1 class="h3 mb-3 font-weight-normal text-white">Faça login</h1>
        
        <div class ="form-label-group">
          <label for="inputCPF" class="sr-only">CPF</label>
          <input type="text" id="inputCPF" class="form-control" name="usuario" placeholder="CPF" required autofocus>
      
        </div>
        <div class ="form-label-group">
          <label for="inputPassword" class="sr-only">Senha</label>
          <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" required>
          <small class="form-text text-danger" id="erroCadastro" style="display: none;">Senha ou CPF inválido!</small>
        </div>
        <input class="btn btn-lg btn-info btn-block text-uppercase" type="submit" value="Logar"/>
        <p class="mt-5 mb-3 text-dark">&copy; 2021</p>
      </form>
    </div>

  </body>
</html>
