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
    <h1>Cadastre aqui as sedes da empresa</h1>
<form method="POST" target= "_self" action="Cadastro_de_Sede.php">
	<div class="field">    
            Rua: <input type="text" id="rua" name="rua" required>
	</div>

           
	<div class="field">		
            Número: <input type="text" id="numero" name="numero" required>
	</div>	


        <div class="field">    
	    Bairro: <input type="text" id="bairro"  name="bairro" required>
	</div>


        <div class="field">
            Cidade: <input type="text" id="cidade" name="cidade" required>
	</div>

        <div class="field">	
            Estado: <input type="text" id="estado" name="estado" required>
	</div>

        <div class="field">
            CEP: <input type="text" id="cep" name="cep" required>
	</div>

        <div class="field">
            Complemento: <input type="text" id="complemento" name="complemento" required>
	</div>

        <div class="field">
            Telefone: <input type="text" id="telefone" name="telefone" required>
	</div>

        <div class="field">
            Email: <input type="text" id="email" name="email" required>
	</div>

        <div class="field">
            Site: <input type="text" id="site" name="site" required>
	</div>

        <div class="field">
            Nome: <input type="text" id="nome" name="nome" required>
	</div>


	    <input type="submit" value="Concluir" id="bot1">
</form>
<footer class="navbar-fixed-bottom text-white bg-info text-center">

</footer>
</body>
        
</html>