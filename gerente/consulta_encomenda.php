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
        <script type="text/javascript" src="js/consultaEncomenda.js"></script>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/gerente.js"></script>

        <title>Bate Volta | Logística</title>
        <link rel="shortcut icon" type="image/icon" href="src/icon.ico" />
    </head>
    <body>
        <header class="bg-info">

        </header>
        <div class="container">
            <h1>Atualize aqui o status da encomenda</h1>
            <form method="POST" target= "_self" action="c_encomenda.php">
                <div class="field">    
                        status:<br> <input type="text" id="FK_status" name="FK_status" required>
                </div>
        
                <div class="field">    
                        idRotaEncomenda:<br> <input type="number" id="idRotaEncomenda" name="idRotaEncomenda" required>
                        <br><br>
                </div>
        
                    <input type="submit" value="Concluir" id="bot1">
            </form>
        </div>
    </body>
    <footer class="navbar-fixed-bottom text-white bg-info text-center">
    </footer>
</html>
