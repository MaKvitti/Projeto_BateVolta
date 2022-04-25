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
<html>

    <head>
        <title>Atualização de Rotas</title>
        <meta charset="UTF-8">
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
    <h1>Atualize aqui o campo de status das Rotas</h1>
    <form method="POST" target= "_self" action="Atualizacao_de_Rotas.php">
        <div class="field">    
                Ativo: <input type="text" id="ativo" name="ativo" required>
        </div>

        <div class="field">    
                IdRota: <input type="text" id="idRota" name="idRota" required>
        </div>

            <input type="submit" value="Concluir" id="bot1">
    </form>

    <footer class="navbar-fixed-bottom text-white bg-info text-center">

    </footer>
</body>

</html>